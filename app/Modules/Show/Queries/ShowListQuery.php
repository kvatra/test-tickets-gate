<?php

declare(strict_types=1);

namespace App\Modules\Show\Queries;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Provider as TestApiTicketsProvider;
use App\Modules\Show\DTO\ShowListItemDTO;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Helpers\ResponseFormatter;
use Illuminate\Support\Collection;

class ShowListQuery
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

    public function fetch(): Collection
    {
        $apiResponse = $this->provider->getShows();

        return $this->responseFormatter
            ->format($apiResponse, fn(array $item) => new ShowListItemDTO($item['id'], $item['name']));
    }
}
