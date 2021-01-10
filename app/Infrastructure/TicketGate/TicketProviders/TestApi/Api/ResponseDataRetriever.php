<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\TicketProviders\TestApi\Api;

use App\Infrastructure\TicketGate\Contracts\ResponseDataRetriever as ResponseRetrieverContract;
use Psr\Http\Message\ResponseInterface;

class ResponseDataRetriever implements ResponseRetrieverContract
{
    public function retrieve(ResponseInterface $response): array
    {
        $content = $response->getBody()->getContents();
        $response->getBody()->rewind();

        return json_decode($content, true);
    }
}
