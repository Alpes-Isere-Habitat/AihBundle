<?php

declare(strict_types=1);

namespace Aih\AihBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class AihExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.php');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $this->setParameterIfNotNull($container, 'aih_aih.happlyhab.application', $config['HAPPLYHAB_APPLICATION']);
        $this->setParameterIfNotNull($container, 'aih_aih.happlyhab.password', $config['HAPPLYHAB_PASSWORD']);
        $this->setParameterIfNotNull($container, 'aih_aih.happlyhab.url', $config['HAPPLYHAB_URL']);
        $this->setParameterIfNotNull($container, 'aih_aih.happlyhab.user', $config['HAPPLYHAB_USER']);

        $this->setParameterIfNotNull($container, 'aih_aih.happlyapi.url', $config['HAPPLYAPI_URL']);
        $this->setParameterIfNotNull($container, 'aih_aih.happlyapi.password', $config['HAPPLYAPI_PASSWORD']);
        $this->setParameterIfNotNull($container, 'aih_aih.happlyapi.user', $config['HAPPLYAPI_USER']);

        $this->setParameterIfNotNull($container, 'aih_aih.happlyapigd.url', $config['HAPPLYAPIGD_URL']);
        $this->setParameterIfNotNull($container, 'aih_aih.happlyapigd.password', $config['HAPPLYAPIGD_PASSWORD']);
        $this->setParameterIfNotNull($container, 'aih_aih.happlyapigd.user', $config['HAPPLYAPIGD_USER']);

        $this->setParameterIfNotNull($container, 'aih_aih.cmtapi.url', $config['CMTAPI_URL']);
        $this->setParameterIfNotNull($container, 'aih_aih.cmtapi.password', $config['CMTAPI_PASSWORD']);
        $this->setParameterIfNotNull($container, 'aih_aih.cmtapi.user', $config['CMTAPI_USER']);

        $this->setParameterIfNotNull($container, 'aih_aih.happlysms.url', $config['HAPPLYSMS_URL']);
        $this->setParameterIfNotNull($container, 'aih_aih.happlysms.user', $config['HAPPLYSMS_USER']);
        $this->setParameterIfNotNull($container, 'aih_aih.happlysms.password', $config['HAPPLYSMS_PASSWORD']);

        $this->setParameterIfNotNull($container, 'aih_aih.azure.tenantid', $config['AZURE_TENANT_ID']);
        $this->setParameterIfNotNull($container, 'aih_aih.azure.clientid', $config['AZURE_CLIENT_ID']);
        $this->setParameterIfNotNull($container, 'aih_aih.azure.clientsecret', $config['AZURE_CLIENT_SECRET']);
        $this->setParameterIfNotNull($container, 'aih_aih.azure.alluser', $config['AZURE_GROUP_ALL_USER']);

        $this->setParameterIfNotNull($container, 'aih_aih.bucket.backup.name', $config['BUCKET_BACKUP_NAME']);
        $this->setParameterIfNotNull($container, 'aih_aih.bucket.backup.access_key', $config['BUCKET_BACKUP_ACCESS_KEY']);
        $this->setParameterIfNotNull($container, 'aih_aih.bucket.backup.secret_key', $config['BUCKET_BACKUP_SECRET_KEY']);
        $this->setParameterIfNotNull($container, 'aih_aih.bucket.path', $config['BUCKET_PATH']);
        $this->setParameterIfNotNull($container, 'aih_aih.database.type', $config['DATABASE_TYPE']);
        $this->setParameterIfNotNull($container, 'aih_aih.database.user', $config['DATABASE_USER']);
        $this->setParameterIfNotNull($container, 'aih_aih.database.name', $config['DATABASE_NAME']);
        $this->setParameterIfNotNull($container, 'aih_aih.container.name', $config['CONTAINER_NAME']);
        $this->setParameterIfNotNull($container, 'aih_aih.bucket.endpoint', $config['BUCKET_ENDPOINT']);
    }

    public function getConfiguration(array $config, ContainerBuilder $container): Configuration
    {
        return new Configuration();
    }

    private function setParameterIfNotNull(ContainerBuilder $container, string $key, ?string $value): void
    {
        if (null !== $value) {
            $container->setParameter($key, $value);
        }
    }
}
