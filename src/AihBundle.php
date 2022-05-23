<?php

namespace Aih\AihBundle;

use Aih\AihBundle\DependencyInjection\AihExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AihBundle extends Bundle
{
    public function getContainerExtension() : ?AihExtension
    {
        if (null === $this->extension) {
            $this->extension = new AihExtension();
        }

        return $this->extension ?: null;
    }
}