<?php

declare(strict_types=1);

namespace Aih\AihBundle\Ressources\config;

use Aih\AihBundle\Service\HapplyApi;
use Aih\AihBundle\Service\HapplyApiInterface;
use Aih\AihBundle\Service\HapplyHab;
use Aih\AihBundle\Service\HapplyHabInterface;
use Aih\AihBundle\Service\HapplySms;
use Aih\AihBundle\Service\HapplySmsInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $container->services()->defaults()
        ->public()
        ->autoconfigure()
        ->autowire()
            ->set('happlyapi', HapplyApi::class)
            ->alias(HapplyApiInterface::class, 'happlyapi')
            ->set('happlyhab', HapplyHab::class)
            ->alias(HapplyHabInterface::class, 'happlyhab')
            ->set('happlysms', HapplySms::class)
            ->alias(HapplySmsInterface::class, 'happlysms')
    ;
};
