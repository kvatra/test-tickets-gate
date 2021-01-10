<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\Contracts;

use Psr\Http\Message\ResponseInterface;

interface TicketProvider
{
    public function getShows(): ResponseInterface;
    public function getShowEvents(int $showId): ResponseInterface;
    public function getEventPlaces(int $eventId): ResponseInterface;
    public function reservePlaces(int $eventId, string $customerName, array $places): ResponseInterface;
}
