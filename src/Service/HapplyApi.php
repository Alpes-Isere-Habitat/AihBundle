<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Exception;

class HapplyApi extends AbstractHapply implements HapplyApiInterface
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
            $this->params->get('aih_aih.happlyapi.user'),
            $this->params->get('aih_aih.happlyapi.password'),
            $this->params->get('aih_aih.happlyapi.url')
        );

        $options = $this->makeOptionsWithToken($token);

        $options = $this->addJsonToOptions($options, [
            'query' => $query,
        ]);

        $response = $this->makeRequest(
            'POST',
            $this->params->get('aih_aih.happlyapi.url'),
            $options
        );

        try {
            return json_decode($response->getContent(), true)['data'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
