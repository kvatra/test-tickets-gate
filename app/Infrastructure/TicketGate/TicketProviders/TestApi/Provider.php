<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\TicketProviders\TestApi;

use App\Infrastructure\TicketGate\Contracts\TicketProvider;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\ApiClient;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands\{
    GetEventPlacesCommand,
    GetShowEventsCommand,
    GetShowsCommand,
    ReserveEventPlaceCommand
};

class Provider implements TicketProvider
{
    private ApiClient $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getShows(): array
    {
        return $this->apiClient
            ->sendCommandRequest(new GetShowsCommand());
    }

    public function getShowEvents(int $showId): array
    {
        $command = new GetShowEventsCommand($showId);

        return $this->apiClient
            ->sendCommandRequest($command);
    }

    public function getEventPlaces(int $eventId): array
    {
        $command = new GetEventPlacesCommand($eventId);

        return $this->apiClient
            ->sendCommandRequest($command);
    }

    public function reservePlaces(int $eventId, string $customerName, array $places): array
    {
        $command = new ReserveEventPlaceCommand($eventId, $customerName, $places);

        return $this->apiClient
            ->sendCommandRequest($command);
    }
}
