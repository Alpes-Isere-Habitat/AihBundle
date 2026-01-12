<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\ResponseInterface;

interface AbstractHapplyInterface
{
    public function getToken(string $username, string $password, string $url): ?string;

    public function getTokenFromCache(string $username, string $password, string $url): ?string;

    public function cleanInput(string $input): string;

    public function makeRequest(string $method, string $url, HttpOptions $options): ResponseInterface;

    public function makeOptionsWithToken(string $token): HttpOptions;

    /** @param array<string, mixed> $json */
    public function addJsonToOptions(HttpOptions $options, array $json): HttpOptions;
}
