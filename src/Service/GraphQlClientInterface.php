<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

interface GraphQlClientInterface
{
    /**
     * Permet d'éxécuter une requête "libre" GraphQL sur l'API.
     *
     * @return array<string, mixed>|null
     */
    public function execute(string $query): ?array;

    /**
     * Permet de récupérer une collection d'entités de l'API.
     *
     * @return array<string, mixed>|null
     */
    public function getEntities(string $entity, string $params): ?array;

    /**
     * Permet de récupérer une entité de l'API.
     *
     * @return array<string, mixed>|null
     */
    public function getEntity(string $entity, string $id, string $param): ?array;

    /**
     * Permet de récupérer une ou plusieurs entité de l'API selon un tableau de critères.
     *
     * @param array<string, mixed> $fields
     *
     * @return array<string, mixed>|null
     */
    public function getEntityBy(string $entity, array $fields, string $params): ?array;
}
