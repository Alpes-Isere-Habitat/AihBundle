<?php

declare(strict_types=1);

namespace Aih\AihBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AihExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.php');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('aih_aih.happlyhab.application', $config['HAPPLYHAB_APPLICATION']);
        $container->setParameter('aih_aih.happlyhab.password', $config['HAPPLYHAB_PASSWORD']);
        $container->setParameter('aih_aih.happlyhab.url', $config['HAPPLYHAB_URL']);
        $container->setParameter('aih_aih.happlyhab.user', $config['HAPPLYHAB_USER']);

        $container->setParameter('aih_aih.happlyapi.url', $config['HAPPLYAPI_URL']);
        $container->setParameter('aih_aih.happlyapi.password', $config['HAPPLYAPI_PASSWORD']);
        $container->setParameter('aih_aih.happlyapi.user', $config['HAPPLYAPI_USER']);

        $container->setParameter('aih_aih.happlyapigd.url', $config['HAPPLYAPIGD_URL']);
        $container->setParameter('aih_aih.happlyapigd.password', $config['HAPPLYAPIGD_PASSWORD']);
        $container->setParameter('aih_aih.happlyapigd.user', $config['HAPPLYAPIGD_USER']);

        $container->setParameter('aih_aih.cmtapi.url', $config['CMTAPI_URL']);
        $container->setParameter('aih_aih.cmtapi.password', $config['CMTAPI_PASSWORD']);
        $container->setParameter('aih_aih.cmtapi.user', $config['CMTAPI_USER']);

        $container->setParameter('aih_aih.happlysms.url', $config['HAPPLYSMS_URL']);
        $container->setParameter('aih_aih.happlysms.user', $config['HAPPLYSMS_USER']);
        $container->setParameter('aih_aih.happlysms.password', $config['HAPPLYSMS_PASSWORD']);

        $container->setParameter('aih_aih.azure.tenantid', $config['AZURE_TENANT_ID']);
        $container->setParameter('aih_aih.azure.clientid', $config['AZURE_CLIENT_ID']);
        $container->setParameter('aih_aih.azure.clientsecret', $config['AZURE_CLIENT_SECRET']);
        $container->setParameter('aih_aih.azure.alluser', $config['AZURE_GROUP_ALL_USER']);
    }

    public function getConfiguration(array $config, ContainerBuilder $container): Configuration
    {
        return new Configuration();
    }

    public function getAlias(): string
    {
        return parent::getAlias();
    }
}
