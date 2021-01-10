<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\TicketProviders\TestApi\Helpers;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\ResponseDataRetriever;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

class ResponseFormatter
{
    private ResponseDataRetriever $responseDataRetriever;

    public function __construct(ResponseDataRetriever $responseDataRetriever)
    {
        $this->responseDataRetriever = $responseDataRetriever;
    }

    public function format(ResponseInterface $response, ?callable $formatFunction = null): Collection
    {
        $body = $this->responseDataRetriever->retrieve($response);
        $result =  collect($body['response']);

        if ($formatFunction) {
            $result = $result->map($formatFunction);
        }

        return $result;
    }
}
