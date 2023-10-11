<?php

declare(strict_types=1);

namespace Aih\AihBundle\Resources\config;

use Aih\AihBundle\Service\CmtApi;
use Aih\AihBundle\Service\CmtApiInterface;
use Aih\AihBundle\Service\HapplyApi;
use Aih\AihBundle\Service\HapplyApiGd;
use Aih\AihBundle\Service\HapplyApiGdInterface;
use Aih\AihBundle\Service\HapplyApiInterface;
use Aih\AihBundle\Service\HapplyHab;
use Aih\AihBundle\Service\HapplyHabInterface;
use Aih\AihBundle\Service\HapplySms;
use Aih\AihBundle\Service\HapplySmsInterface;
use Aih\AihBundle\Service\MicrosoftGraph;
use Aih\AihBundle\Service\MicrosoftGraphInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $container->services()->defaults()
        ->public()
        ->autoconfigure()
        ->autowire()
            ->set('happlyapi', HapplyApi::class)
            ->alias(HapplyApiInterface::class, 'happlyapi')

            ->set('happlyapigd', HapplyApiGd::class)
            ->alias(HapplyApiGdInterface::class, 'happlyapigd')

            ->set('cmtapi', CmtApi::class)
            ->alias(CmtApiInterface::class, 'cmtapi')

            ->set('happlyhab', HapplyHab::class)
            ->alias(HapplyHabInterface::class, 'happlyhab')

            ->set('happlysms', HapplySms::class)
            ->alias(HapplySmsInterface::class, 'happlysms')

            ->set('microsoftgraph', MicrosoftGraph::class)
            ->alias(MicrosoftGraphInterface::class, 'microsoftgraph')

            ->set('Aih\AihBundle\Controller\HealthCheckController')
            ->tag('controller.service_arguments')
    ;
};
