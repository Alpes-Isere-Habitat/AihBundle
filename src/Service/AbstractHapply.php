<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractHapply implements AbstractHapplyInterface
{
    public function __construct(
        public ContainerBagInterface $params,
        public HttpClientInterface $client,
    ) {
    }

    public function getToken(string $username, string $password, string $url): ?string
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept: */*',
                'User-Agent' => 'HapplyBundle login_check',
            ],
            'body' => json_encode([
                'username' => $username,
                'password' => $password,
            ], JSON_THROW_ON_ERROR),
        ];

        $data = null;

        try {
            $response = $this->client->request('POST', $url.'/api/login_check', $options);
            $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR)['token'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }

        return $data;
    }

    public function makeOptionsWithToken(string $token): array
    {
        $options = [];

        $options['headers'] = [
            'Content-Type' => 'application/json',
            'User-Agent' => 'HapplyBundle client',
            'Authorization' => 'Bearer '.$token,
        ];

        return $options;
    }

    public function addJsonToOptions(array $options, array $json): array
    {
        $options['json'] = $json;

        return $options;
    }

    public function makeRequest(string $method, string $url, array $options = []): ResponseInterface
    {
        try {
            $response = $this->client->request($method, $url, $options);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }

        return $response;
    }
}
