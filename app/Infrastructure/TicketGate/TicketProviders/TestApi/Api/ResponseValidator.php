<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\TicketProviders\TestApi\Api;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\TestApiException;
use Psr\Http\Message\ResponseInterface;

class ResponseValidator
{
    public function validateResponse(ResponseInterface $response): array
    {
        $content = $response->getBody()->getContents();
        $decodedContent = json_decode($content, true);

        if ($error = $decodedContent['error'] ?? null) {
            throw new TestApiException($error);
        }

        return $decodedContent['response'];
    }
}
