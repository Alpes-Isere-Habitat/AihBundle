<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface AbstractHapplyInterface
{
    public function getToken(string $username, string $password, string $url): ?string;

    public function getTokenFromCache(string $username, string $password, string $url): ?string;

    public function makeRequest(string $method, string $url, array $options = []): ResponseInterface;

    public function makeOptionsWithToken(string $token): array;

    public function addJsonToOptions(array $options, array $json): array;
}
