<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AbstractHapply
{
    public function __construct(
        public ContainerBagInterface $params,
        public HttpClientInterface $client,
    ) {
    }
}
