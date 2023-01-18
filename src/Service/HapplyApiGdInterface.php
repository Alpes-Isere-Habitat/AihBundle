<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

interface HapplyApiGdInterface
{
    /**
     * Permet d'éxécuter une requête "libre" GraphQL sur l'API HapplyApiGd.
     */
    public function execute(string $query): array;

    /**
     * Permet de récupérer une collection d'entités de l'API HapplyApiGd.
     */
    public function getEntities(string $entity, string $params): array;

    /**
     * Permet de récupérer une entité de l'API HapplyApiGd.
     */
    public function getEntity(string $entity, string $id, string $param): array;
}
