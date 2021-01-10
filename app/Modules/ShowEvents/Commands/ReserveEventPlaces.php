<?php

declare(strict_types=1);

namespace App\Modules\ShowEvents\Commands;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Helpers\ResponseFormatter;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Provider;

class ReserveEventPlaces
{
    private int $eventId;
    private string $customerName;
    private array $places;

    public function __construct(int $eventId, string $customerName, array $places)
    {
        $this->eventId = $eventId;
        $this->customerName = $customerName;
        $this->places = $places;
    }

    public function handle(Provider $provider, ResponseFormatter $responseFormatter)
    {
        $apiResponse = $provider->reservePlaces(
            $this->eventId,
            $this->customerName,
            $this->places
        );

        return $responseFormatter->format($apiResponse)['reservation_id'];
    }
}
