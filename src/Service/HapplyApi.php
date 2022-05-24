<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

class HapplyApi extends AbstractHapply implements HapplyApiInterface
{
    public function getTest(): string
    {
        return 'Ceci est un test héhé';
    }
}
