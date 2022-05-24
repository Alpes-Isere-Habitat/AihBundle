<?php

namespace Aih\AihBundle\Service;

class HapplyApi extends AbstractHapply implements HapplyApiInterface
{
    public function getTest(): string
    {
        return 'Ceci est un test héhé';
    }
}