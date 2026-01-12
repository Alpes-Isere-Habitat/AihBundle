<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Aih\AihBundle\Trait\GraphQlClientTrait;

class CmtApi extends AbstractHapply implements CmtApiInterface
{
    use GraphQlClientTrait;

    private string $serviceContainerUserParameter = 'aih_aih.cmtapi.user';
    private string $serviceContainerPasswordParameter = 'aih_aih.cmtapi.password';
    private string $serviceContainerUrlParameter = 'aih_aih.cmtapi.url';

    protected string $apiLoginUrl = 'login_check';

    /** @var array<string> */
    protected array $requiredParameters = [
        'aih_aih.cmtapi.user',
        'aih_aih.cmtapi.password',
        'aih_aih.cmtapi.url',
    ];
}
