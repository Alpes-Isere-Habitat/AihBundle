<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

interface GraphQlClientInterface
{
    /**
     * Permet d'éxécuter une requête "libre" GraphQL sur l'API.
     */
    public function execute(string $query): array;

    /**
     * Permet de récupérer une collection d'entités de l'API.
     */
    public function getEntities(string $entity, string $params): array;

    /**
     * Permet de récupérer une entité de l'API.
     */
    public function getEntity(string $entity, string $id, string $param): array;

    /**
     * Permet de récupérer une entité de l'API.
     */
    public function getEntityBy(string $entity, array $fields, string $params): array;
}
