<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

interface HapplySmsInterface
{
    /**
     * Permet d'envoyer des SMS à une liste de destinataires.
     *
     * @param array<string> $dest
     *
     * @return array<string, mixed>
     */
    public function sendSms(array $dest, string $message): array;

    /** @return array<string, mixed> */
    public function getCommunication(int $id): array;

    /**
     * @param array<int> $ids
     *
     * @return array<string, mixed>
     */
    public function getCommunicationsByIds(array $ids): array;

    /** @return array<string, mixed> */
    public function getCommunications(): array;

    public function getSmsCount(): int;
}
