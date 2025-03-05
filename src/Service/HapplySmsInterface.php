<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

interface HapplySmsInterface
{
    /**
     * Permet d'envoyer des SMS à une liste de destinataires.
     */
    public function sendSms(array $dest, string $message): array;

    public function getCommunication(int $id): array;

    /**
     * @param int[] $ids
     */
    public function getCommunicationsByIds(array $ids): array;

    public function getCommunications(): array;

    public function getSmsCount(): int;
}
