<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Aih\AihBundle\Trait\GraphQlClientTrait;

class HapplyApiGd extends AbstractHapply implements HapplyApiGdInterface
{
    use GraphQlClientTrait;

    private string $serviceContainerUserParameter = 'aih_aih.happlyapigd.user';
    private string $serviceContainerPasswordParameter = 'aih_aih.happlyapigd.password';
    private string $serviceContainerUrlParameter = 'aih_aih.happlyapigd.url';

    protected array $requiredParameters = [
        'aih_aih.happlyapigd.user',
        'aih_aih.happlyapigd.password',
        'aih_aih.happlyapigd.url',
    ];
}
