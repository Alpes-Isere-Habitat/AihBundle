<?php

namespace Aih\AihBundle\Service;

class HapplyHab extends AbstractHapply implements HapplyHabInterface
{   
    public function getTest(): string
    {
        return $this->params->get('aih_aih.happlyapi.url');
    }
}