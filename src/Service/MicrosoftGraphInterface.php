<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Microsoft\Graph\Model\User;

interface MicrosoftGraphInterface
{
    /**
     * Retourne un utilisateur (via son adresse mail).
     */
    public function getUser(string $user): User;

    /**
     * Retourne le service (au sens RH) d'un utilisateur (via son adresse mail).
     */
    public function getUserDepartement(string $user): ?string;

    /**
     * Retourne tous les groupes d'un utilisateur (via son adresse mail).
     *
     * @return array<User>
     */
    public function getUserMemberOf(string $user): array;

    /**
     * Retourne la liste des utilisateurs d'un groupe (via son id).
     *
     * @return array<User>
     */
    public function getAllUsersByGroupId(string $groupId): array;

    /**
     * Retourne la liste de tous les utilisateurs Office 365.
     *
     * @return array<User>
     */
    public function getAllUsers(): array;

    /**
     * Retourne le manager d'un utilisateur (via son adresse mail).
     */
    public function getManager(string $user): User;

    /**
     * Retourne la ville d'un utilisateur (via son adresse mail).
     */
    public function getUserCity(string $user): ?string;
}
