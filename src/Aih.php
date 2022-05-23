<?php

namespace Aih\AihBundle;

class Aih implements AihInterface
{
    public function getTest(): string
    {
        return 'Ceci est un test héhé';
    }
}