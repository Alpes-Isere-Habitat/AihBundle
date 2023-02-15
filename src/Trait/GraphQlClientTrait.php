<?php

declare(strict_types=1);

namespace Aih\AihBundle\Trait;

use Exception;

use function get_class;

trait GraphQlClientTrait
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
            $this->params->get($this->serviceContainerUserParameter),
            $this->params->get($this->serviceContainerPasswordParameter),
            $this->params->get($this->serviceContainerUrlParameter)
        );

        $options = $this->makeOptionsWithToken($token);

        $options = $this->addJsonToOptions($options, [
            'query' => $query,
        ]);

        $response = $this->makeRequest(
            'POST',
            $this->params->get($this->serviceContainerUrlParameter),
            $options
        );

        try {
            $response = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

            if (!isset($response['data'])) {
                if (isset($response['errors'])) {
                    $messages = array_map(fn ($error) => $error['message'], $response['errors']);
                } else {
                    $messages = ['Erreur inconnue'];
                }

                throw new Exception(get_class($this).' : '.implode('; ', $messages), 1);
            }

            return $response['data'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
