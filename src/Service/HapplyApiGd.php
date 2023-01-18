<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Exception;

class HapplyApiGd extends AbstractHapply implements HapplyApiGdInterface
{
    public function getEntities(string $entity, string $params): array
    {
        $query = '{ '.$entity.' { '.$params.' } }';
        $data = $this->execute($query);

        return $data[$entity];
    }

    public function getEntity(string $entity, string $id, string $param): array
    {
        $query = '{'.$entity.'(id:'.$id.') { '.$param.' } }';
        $data = $this->execute($query);

        return $data[$entity];
    }

    public function execute(string $query): array
    {
        $token = $this->getTokenFromCache(
            $this->params->get('aih_aih.happlyapigd.user'),
            $this->params->get('aih_aih.happlyapigd.password'),
            $this->params->get('aih_aih.happlyapigd.url')
        );

        $options = $this->makeOptionsWithToken($token);

        $options = $this->addJsonToOptions($options, [
            'query' => $query,
        ]);

        $response = $this->makeRequest(
            'POST',
            $this->params->get('aih_aih.happlyapigd.url'),
            $options
        );

        try {
            return json_decode($response->getContent(), true)['data'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
