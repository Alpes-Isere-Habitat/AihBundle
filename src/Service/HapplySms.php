<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Exception;

class HapplySms extends AbstractHapply implements HapplySmsInterface
{
    private string $serviceContainerUserParameter = 'aih_aih.happlysms.user';
    private string $serviceContainerPasswordParameter = 'aih_aih.happlysms.password';
    private string $serviceContainerUrlParameter = 'aih_aih.happlysms.url';

    protected function getRequiredParameters(): array
    {
        return [
            $this->serviceContainerUserParameter,
            $this->serviceContainerPasswordParameter,
            $this->serviceContainerUrlParameter,
        ];
    }

    public function sendSms(array $dest, string $message): array
    {
        $token = $this->getTokenFromCache(
            $this->params->get('aih_aih.happlysms.user'),
            $this->params->get('aih_aih.happlysms.password'),
            $this->params->get('aih_aih.happlysms.url')
        );

        $options = $this->makeOptionsWithToken($token);

        $options = $this->addJsonToOptions($options, [
            'dest' => $dest,
            'message' => $message,
        ]);

        $response = $this->makeRequest(
            'POST',
            $this->params->get('aih_aih.happlysms.url').'/sms/simple',
            $options
        );

        if (200 !== $response->getStatusCode()) {
            throw new Exception('Erreur lors de l\'utilisation de HapplySms');
        }

        return $response->toArray();
    }

    public function getCommunication(int $id): array
    {
        $token = $this->getTokenFromCache(
            $this->params->get('aih_aih.happlysms.user'),
            $this->params->get('aih_aih.happlysms.password'),
            $this->params->get('aih_aih.happlysms.url')
        );

        $options = $this->makeOptionsWithToken($token);

        $response = $this->makeRequest(
            'GET',
            $this->params->get('aih_aih.happlysms.url').'/communication/'.$id,
            $options
        );

        if (200 !== $response->getStatusCode()) {
            throw new Exception('Erreur lors de l\'utilisation de HapplySms');
        }

        return $response->toArray();
    }

    public function getCommunications(): array
    {
        $token = $this->getTokenFromCache(
            $this->params->get('aih_aih.happlysms.user'),
            $this->params->get('aih_aih.happlysms.password'),
            $this->params->get('aih_aih.happlysms.url')
        );

        $options = $this->makeOptionsWithToken($token);

        $response = $this->makeRequest(
            'GET',
            $this->params->get('aih_aih.happlysms.url').'/communication',
            $options
        );

        if (200 !== $response->getStatusCode()) {
            throw new Exception('Erreur lors de l\'utilisation de HapplySms');
        }

        return $response->toArray();
    }

    public function getSmsCount(): int
    {
        $token = $this->getTokenFromCache(
            $this->params->get('aih_aih.happlysms.user'),
            $this->params->get('aih_aih.happlysms.password'),
            $this->params->get('aih_aih.happlysms.url')
        );

        $options = $this->makeOptionsWithToken($token);

        $response = $this->makeRequest(
            'GET',
            $this->params->get('aih_aih.happlysms.url').'/account/info/sms-count',
            $options
        );

        if (200 !== $response->getStatusCode()) {
            throw new Exception('Erreur lors de l\'utilisation de HapplySms');
        }

        return $response->toArray()['data']['smsCount'];
    }
}
