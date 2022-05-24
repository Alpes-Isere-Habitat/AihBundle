<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Exception;

class HapplyHab extends AbstractHapply implements HapplyHabInterface
{
    public function getRoles(string $email): array
    {
        $token = $this->getToken($this->params->get('aih_aih.happlyhab.user'), $this->params->get('aih_aih.happlyhab.password'));

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'User-Agent' => 'HapplyHab client',
                'Authorization' => 'Bearer '.$token,
            ],
        ];

        $response = $this->client->request(
            'GET',
            $this->params->get('aih_aih.happlyhab.url').'/roles/'.$email.'/'.$this->params->get('aih_aih.happlyhab.application'),
            $options
        );

        try {
            $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }

        return $data;
    }

    public function getToken(string $username, string $password): ?string
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept: */*',
                'User-Agent' => 'HapplyHab login_check',
            ],
            'body' => json_encode([
                'username' => $username,
                'password' => $password,
            ], JSON_THROW_ON_ERROR),
        ];

        $data = null;

        try {
            $response = $this->client->request(
                'POST',
                $this->params->get('aih_aih.happlyhab.url').'/api/login_check',
                $options
            );
            $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR)['token'];
        } catch (Exception) {
        }

        return $data;
    }
}
