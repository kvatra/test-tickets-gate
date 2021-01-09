<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\Contracts;

interface TicketProvider
{
    public function getShows(): array;
    public function getShowEvents(int $showId): array;
    public function getEventPlaces(int $eventId): array;
    public function reservePlaces(int $eventId, string $customerName, array $places): array;
}
