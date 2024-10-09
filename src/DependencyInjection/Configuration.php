<?php

declare(strict_types=1);

namespace Aih\AihBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('aih');
        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('HAPPLYAPI_USER')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un compte pour HapplyApi.'
                    )
                ->end()
                ->scalarNode('HAPPLYAPI_PASSWORD')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un mot de passe pour HapplyApi.'
                    )
                ->end()
                ->scalarNode('HAPPLYAPI_URL')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'URL de l\'API de HapplyApi.'
                    )
                ->end()
                ->scalarNode('HAPPLYAPIGD_USER')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un compte pour HapplyApiGD.'
                    )
                ->end()
                ->scalarNode('HAPPLYAPIGD_PASSWORD')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un mot de passe pour HapplyApiGD.'
                    )
                ->end()
                ->scalarNode('HAPPLYAPIGD_URL')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'URL de l\'API de HapplyApiGD.'
                    )
                ->end()
                ->scalarNode('CMTAPI_USER')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un compte l\'API de CMT.'
                    )
                ->end()
                ->scalarNode('CMTAPI_PASSWORD')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un mot de passe l\'API de CMT.'
                    )
                ->end()
                ->scalarNode('CMTAPI_URL')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'URL de l\'API de HapplyApi.'
                    )
                ->end()
                ->scalarNode('HAPPLYHAB_APPLICATION')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'application pour laquelle vous souhaitez utiliser HapplyHab.'
                    )
                ->end()
                ->scalarNode('HAPPLYHAB_USER')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un compte pour HapplyHab.'
                    )
                ->end()
                ->scalarNode('HAPPLYHAB_PASSWORD')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un mot de passe pour HapplyHab.'
                    )
                ->end()
                ->scalarNode('HAPPLYHAB_URL')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'URL de l\'API de HapplyHab.'
                    )
                ->end()
                ->scalarNode('HAPPLYSMS_URL')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'URL de l\'API de HapplySms.'
                    )
                ->end()
                ->scalarNode('HAPPLYSMS_USER')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un compte pour HapplySms.'
                    )
                ->end()
                ->scalarNode('HAPPLYSMS_PASSWORD')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier un mot de passe pour HapplySms.'
                    )
                ->end()
                ->scalarNode('AZURE_TENANT_ID')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'ID de l\'organisation Azure.'
                    )
                ->end()
                ->scalarNode('AZURE_CLIENT_ID')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier l\'ID du client Azure.'
                    )
                ->end()
                ->scalarNode('AZURE_CLIENT_SECRET')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier le secret du client Azure.'
                    )
                ->end()
                ->scalarNode('AZURE_GROUP_ALL_USER')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier le nom du groupe d\'utilisateurs Azure.'
                    )
                ->end()
                ->scalarNode('BUCKET_BACKUP_NAME')
                    ->isRequired()
                    ->info(
                        'Vous devez spécifier le nom du bucket de sauvegarde.'
                    )
                ->end()
                ->scalarNode('BUCKET_BACKUP_ACCESS_KEY')
                    ->info(
                        'Vous devez spécifier la clé d\'accès du bucket de sauvegarde.'
                    )
                ->end()
                ->scalarNode('BUCKET_BACKUP_SECRET_KEY')
                    ->info(
                        'Vous devez spécifier le secret de la clé d\'accès du bucket de sauvegarde.'
                    )
                ->end()
                ->scalarNode('BUCKET_PATH')
                    ->info(
                        'Vous devez spécifier le chemin du bucket de sauvegarde.'
                    )
                ->end()
                ->scalarNode('DATABASE_TYPE')
                    ->info(
                        'Vous devez spécifier le type de base de données.'
                    )
                ->end()
                ->scalarNode('DATABASE_USER')
                    ->info(
                        'Vous devez spécifier l\'utilisateur de la base de données.'
                    )
                ->end()
                ->scalarNode('DATABASE_NAME')
                    ->info(
                        'Vous devez spécifier le nom de la base de données.'
                    )
                ->end()
                ->scalarNode('CONTAINER_NAME')
                    ->info(
                        'Vous devez spécifier le nom du container Docker.'
                    )
                ->end()
                ->scalarNode('BUCKET_ENDPOINT')
                    ->info(
                        'Vous devez spécifier l\'URL de l\'endpoint S3.'
                    )
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
