<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractHapply implements AbstractHapplyInterface
{
    protected string $apiLoginUrl = '/api/login_check';

    public function __construct(
        public ContainerBagInterface $params,
        public HttpClientInterface $client,
        private CacheInterface $cache
    ) {}

    public function getTokenFromCache(string $username, string $password, string $url): ?string
    {
        $cleanUrl = $this->cleanInput($url);

        return $this->cache->get('token for '.$cleanUrl, function (ItemInterface $item) use ($username, $password, $url): string {
            $item->expiresAfter(3600);

            return $this->getToken($username, $password, $url);
        });
    }

    public function cleanInput(string $input): string
    {
        return preg_replace('/[{}()\/\@:"]/', '', $input);
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
            $response = $this->client->request('POST', $url.$this->apiLoginUrl, $options);
            $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR)['token'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }

        return $data;
    }

    public function makeOptionsWithToken(string $token): HttpOptions
    {
        $options = new HttpOptions();

        $options->setHeaders([
            'Content-Type' => 'application/json',
            'User-Agent' => 'HapplyBundle client',
            'Authorization' => 'Bearer '.$token,
        ]);

        return $options;
    }

    public function addJsonToOptions(HttpOptions $options, array $json): HttpOptions
    {
        $options->setJson($json);

        return $options;
    }

    public function makeRequest(string $method, string $url, HttpOptions $options): ResponseInterface
    {
        try {
            $response = $this->client->request($method, $url, $options->toArray());
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }

        return $response;
    }
}
