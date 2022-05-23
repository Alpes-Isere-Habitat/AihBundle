<?php

namespace Aih\AihBundle\Ressources\config;

use Aih\AihBundle\Aih;
use Aih\AihBundle\AihInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $container->services()->defaults()
        ->public()
        ->autoconfigure()
        ->autowire()
            ->set('aih', Aih::class)
            ->alias(AihInterface::class, 'aih')
    ;
};