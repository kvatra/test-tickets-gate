<?php

declare(strict_types=1);

namespace App\Modules\Show\Queries;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Provider as TestApiTicketsProvider;
use App\Modules\Show\DTO\ShowEventDTO;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Helpers\ResponseFormatter;
use Illuminate\Support\Collection;

class ShowEventsQuery
{
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

    public function fetch($showId): Collection
    {
        $apiResponse = $this->provider->getShowEvents($showId);

        return $this->responseFormatter
            ->format($apiResponse, fn(array $item) => new ShowEventDTO($item['id'], $item['date']));
    }
}
