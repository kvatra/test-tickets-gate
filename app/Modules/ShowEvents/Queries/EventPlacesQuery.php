<?php

declare(strict_types=1);

namespace App\Modules\ShowEvents\Queries;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Helpers\ResponseFormatter;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Provider as TestApiTicketsProvider;
use App\Modules\Show\DTO\ShowEventDTO;
use App\Modules\ShowEvents\DTO\EventPlaceDTO;
use Illuminate\Support\Collection;

class EventPlacesQuery
{
    private const EXCLUDED_PARAM_KEYS = ['id'];

    private TestApiTicketsProvider $provider;
    private ResponseFormatter $responseFormatter;

    public function __construct(
        TestApiTicketsProvider $provider,
        ResponseFormatter $responseFormatter
    )
    {
        $this->provider = $provider;
        $this->responseFormatter = $responseFormatter;
    }

    public function fetch($eventId): Collection
    {
        $apiResponse = $this->provider->getEventPlaces($eventId);

        return $this->responseFormatter
            ->format($apiResponse, \Closure::fromCallable([$this, 'format']));
    }

    private function format(array $item): EventPlaceDTO
    {
        $params = collect($item)
            ->reject(fn($value, $key) => in_array($key, self::EXCLUDED_PARAM_KEYS, true))
            ->toArray();

        return new EventPlaceDTO($item['id'], $params);
    }
}
