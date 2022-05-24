<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

interface HapplyHabInterface
{
    public function getRoles(string $email): array;

    public function getToken(string $username, string $password): ?string;
}
