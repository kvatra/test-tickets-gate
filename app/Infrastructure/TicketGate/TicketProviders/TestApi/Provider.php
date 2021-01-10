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
use Psr\Http\Message\ResponseInterface;

class Provider implements TicketProvider
{
    private ApiClient $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getShows(): ResponseInterface
    {
        return $this->apiClient
            ->sendCommandRequest(new GetShowsCommand());
    }

    public function getShowEvents(int $showId): ResponseInterface
    {
        $command = new GetShowEventsCommand($showId);

        return $this->apiClient
            ->sendCommandRequest($command);
    }

    public function getEventPlaces(int $eventId): ResponseInterface
    {
        $command = new GetEventPlacesCommand($eventId);

        return $this->apiClient
            ->sendCommandRequest($command);
    }

    public function reservePlaces(int $eventId, string $customerName, array $places): ResponseInterface
    {
        $command = new ReserveEventPlaceCommand($eventId, $customerName, $places);

        return $this->apiClient
            ->sendCommandRequest($command);
    }
}
