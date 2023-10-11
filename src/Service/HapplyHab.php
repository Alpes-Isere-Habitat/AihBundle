<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Exception;

class HapplyHab extends AbstractHapply implements HapplyHabInterface
{
    public function getRoles(string $email): array
    {
        $token = $this->getTokenFromCache(
            $this->params->get('aih_aih.happlyhab.user'),
            $this->params->get('aih_aih.happlyhab.password'),
            $this->params->get('aih_aih.happlyhab.url')
        );

        $options = $this->makeOptionsWithToken($token);

        $response = $this->makeRequest(
            'GET',
            $this->params->get('aih_aih.happlyhab.url').'/roles/'.$email.'/'.$this->params->get('aih_aih.happlyhab.application'),
            $options
        );

        try {
            $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }

        return $data;
    }
}
