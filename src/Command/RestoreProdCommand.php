<?php

declare(strict_types=1);

namespace Aih\AihBundle\Command;

use Aws\S3\S3Client;

use function count;

use Exception;

use function sprintf;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'app:restore-prod',
    description: 'Restauration du dernier backup de production',
)]
/**
 * Class de restauration de la base de données de production sur un env de développement.
 */
class RestoreProdCommand extends Command
{
    private const BUCKET_REGION = 'fr-par';
    private const BUCKET_VERSION = 'latest';
    private const DUMP_PATH = 'var/dump.sql';
    private const DUMP_PATH_GZ = 'var/dump.sql.gz';

    public function __construct(
        private ParameterBagInterface $parameterBag,
    ) {
        parent::__construct();

        $this->validateServiceConfiguration([
            'aih_aih.bucket.backup.name',
            'aih_aih.bucket.backup.access_key',
            'aih_aih.bucket.backup.secret_key',
            'aih_aih.bucket.path',
            'aih_aih.database.type',
            'aih_aih.database.user',
            'aih_aih.database.name',
        ]);
    }

    /**
     * Méthode utilitaire qui simplifie la validation des paramètres de configuration du service.
     *
     * @param array<string> $requiredParameters Liste des paramètres requis
     *
     * @throws Exception Si un paramètre requis n'est pas défini
     */
    private function validateServiceConfiguration(array $requiredParameters): void
    {
        $missingParameters = [];

        foreach ($requiredParameters as $param) {
            if (!$this->parameterBag->has($param)) {
                $missingParameters[] = $param;
            }
        }

        if ([] !== $missingParameters) {
            throw new Exception(sprintf('%s -> Missing parameters %s', $this::class, implode(', ', $missingParameters)));
        }
    }

    /**
     * Lancement le processus de restauration.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Restauration du dernier backup de production');

        // Cleanup
        $this->cleanup();

        // Poser la question de confirmation
        if (!$this->confirm($io)) {
            return Command::SUCCESS;
        }

        // Setup the S3 client
        $s3 = $this->createS3Client();

        // Get the most recent dump from S3
        $dumpKey = $this->getMostRecentDumpKey($s3, $io);
        if (null === $dumpKey) {
            $io->error('Aucun dump trouvé');

            return Command::SUCCESS;
        }

        // Download and extract the dump
        $io->note('Téléchargement du dump');
        $this->downloadS3Object($s3, $dumpKey, self::DUMP_PATH_GZ);

        // Extract the dump
        $io->note('Extraction du dump');
        $this->runProcess(['gzip', '-d', self::DUMP_PATH]);

        // Drop and recreate the database
        $io->note('Suppression et recréation de la base de données');
        $this->runProcess(['symfony', 'console', 'd:d:d', '--force']);
        $this->runProcess(['symfony', 'console', 'd:d:c']);

        // Import the dump into the database
        $io->note('Import du dump dans la base de données');
        $containerId = $this->getDockerContainerId($this->parameterBag->get('aih_aih.container.name'));
        $this->copyDumpToContainer($containerId, self::DUMP_PATH);
        $this->importDumpIntoDatabase($containerId);

        // Cleanup
        $io->note('Nettoyage des fichiers');
        $this->cleanup();

        $io->success('Restauration du dernier backup de production terminée');

        return Command::SUCCESS;
    }

    /**
     * Cleanup des fichiers.
     */
    private function cleanup(): void
    {
        foreach ([self::DUMP_PATH, self::DUMP_PATH_GZ] as $file) {
            if (file_exists($file)) {
                try {
                    unlink($file);
                } catch (Exception $e) {
                    // Ignorer les exceptions
                }
            }
        }
    }

    /**
     * Création d'un client S3.
     */
    private function createS3Client(): S3Client
    {
        return new S3Client([
            'version' => self::BUCKET_VERSION,
            'region' => self::BUCKET_REGION,
            'endpoint' => $this->parameterBag->get('aih_aih.bucket.endpoint'),
            'bucket' => $this->parameterBag->get('aih_aih.bucket.backup.name'),
            'credentials' => [
                'key' => $this->parameterBag->get('aih_aih.bucket.backup.access_key'),
                'secret' => $this->parameterBag->get('aih_aih.bucket.backup.secret_key'),
            ],
        ]);
    }

    /**
     * Récupération du dernier dump de la base de données.
     */
    private function getMostRecentDumpKey(S3Client $s3, SymfonyStyle $io): ?string
    {
        $path = $this->parameterBag->get('aih_aih.bucket.path');
        $objects = $s3->listObjectsV2([
            'Bucket' => $this->parameterBag->get('aih_aih.bucket.backup.name'),
            'Prefix' => $path,
        ]);

        $dumps = $objects['Contents'] ?? [];
        if (0 === count($dumps)) {
            return null;
        }

        usort($dumps, fn ($a, $b) => $b['LastModified'] <=> $a['LastModified']);

        $io->note('Dernier dump disponible : '.$dumps[0]['LastModified']);

        return $dumps[0]['Key'];
    }

    /**
     * Confirmation de la restauration.
     */
    private function confirm(SymfonyStyle $io): bool
    {
        $question = new ConfirmationQuestion('Voulez-vous vraiment restaurer la base de données de production ?', false);
        $response = $io->askQuestion($question);
        if (true !== $response) {
            $io->error('Restauration annulée');

            return false;
        }

        return true;
    }

    /**
     * Téléchargement d'un objet S3 dans un fichier local.
     */
    private function downloadS3Object(S3Client $s3, string $key, string $saveAs): void
    {
        $s3->getObject([
            'Bucket' => $this->parameterBag->get('aih_aih.bucket.backup.name'),
            'Key' => $key,
            'SaveAs' => $saveAs,
        ]);
    }

    /**
     * Exécution d'une commande en ligne de commande.
     */
    private function runProcess(array $command): void
    {
        $process = new Process($command);
        $process->mustRun();
    }

    /**
     * Récupération de l'ID d'un conteneur Docker.
     */
    private function getDockerContainerId(string $serviceName): string
    {
        $process = new Process(['docker', 'compose', 'ps', '-q', $serviceName]);
        $process->mustRun();

        return mb_trim($process->getOutput());
    }

    /**
     * Copie d'un fichier dans un conteneur Docker.
     */
    private function copyDumpToContainer(string $containerId, string $dumpPath): void
    {
        exec("docker cp {$dumpPath} {$containerId}:/tmp/dump.sql");
    }

    /**
     * Import d'un dump dans la base de données.
     */
    private function importDumpIntoDatabase(string $containerId): void
    {
        $databaseType = $this->parameterBag->get('aih_aih.database.type');
        $user = $this->parameterBag->get('aih_aih.database.user');
        $name = $this->parameterBag->get('aih_aih.database.name');

        match ($databaseType) {
            'postgresql' => exec("docker exec -i {$containerId} bash -c 'psql -U {$user} -d {$name} -f /tmp/dump.sql' > /dev/null 2>&1"),
            'mysql' => exec("docker exec -i {$containerId} bash -c 'mysql -u {$user} -p {$name} < /tmp/dump.sql' > /dev/null 2>&1"),
            default => throw new Exception('Type de base de données inconnu'),
        };
    }
}
