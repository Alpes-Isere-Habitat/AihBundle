<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Exception;

class HapplySms extends AbstractHapply implements HapplySmsInterface
{
    public function sendSms(array $dest, string $message): array
    {
        $user = $this->params->get('aih_aih.happlysms.user');
        $password = $this->params->get('aih_aih.happlysms.password');
        $response = $this->client->request('POST', $this->params->get('aih_aih.happlysms.url').'/sms/simple', [
            'json' => [
                'dest' => $dest,
                'message' => $message,
            ],
        ]);

        if (200 !== $response->getStatusCode()) {
            throw new Exception('Erreur lors de l\'utilisation de HapplySms');
        }

        return $response->toArray();
    }
}
