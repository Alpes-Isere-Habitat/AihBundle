<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Aih\AihBundle\Trait\GraphQlClientTrait;

class HapplyApi extends AbstractHapply implements HapplyApiInterface
{
    use GraphQlClientTrait;

    private string $serviceContainerUserParameter = 'aih_aih.happlyapi.user';
    private string $serviceContainerPasswordParameter = 'aih_aih.happlyapi.password';
    private string $serviceContainerUrlParameter = 'aih_aih.happlyapi.url';

    protected function getRequiredParameters(): array
    {
        return [
            $this->serviceContainerUserParameter,
            $this->serviceContainerPasswordParameter,
            $this->serviceContainerUrlParameter,
        ];
    }
}
