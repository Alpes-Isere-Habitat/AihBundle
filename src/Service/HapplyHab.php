<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Exception;

class HapplyHab extends AbstractHapply implements HapplyHabInterface
{
    private string $serviceContainerUserParameter = 'aih_aih.happlyhab.user';
    private string $serviceContainerPasswordParameter = 'aih_aih.happlyhab.password';
    private string $serviceContainerUrlParameter = 'aih_aih.happlyhab.url';
    private string $serviceContainerApplicationParameter = 'aih_aih.happlyhab.application';

    protected function getRequiredParameters(): array
    {
        return [
            $this->serviceContainerUserParameter,
            $this->serviceContainerPasswordParameter,
            $this->serviceContainerUrlParameter,
            $this->serviceContainerApplicationParameter,
        ];
    }

    public function getRoles(string $email): array
    {
        $token = $this->getTokenFromCache(
            $this->params->get($this->serviceContainerUserParameter),
            $this->params->get($this->serviceContainerPasswordParameter),
            $this->params->get($this->serviceContainerUrlParameter)
        );

        $options = $this->makeOptionsWithToken($token);

        $response = $this->makeRequest(
            'GET',
            $this->params->get($this->serviceContainerUrlParameter).'/roles/'.$email.'/'.$this->params->get($this->serviceContainerApplicationParameter),
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
