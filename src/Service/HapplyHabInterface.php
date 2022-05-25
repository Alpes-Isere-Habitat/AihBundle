<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

interface HapplyHabInterface
{
    /**
     * Retourne la liste des habilitations d'un utilisateur.
     */
    public function getRoles(string $email): array;
}
