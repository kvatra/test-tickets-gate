<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\TicketProviders\TestApi\Api;

use Psr\Http\Message\ResponseInterface;

class ResponseValidator
{
    private ResponseDataRetriever $responseRetriever;

    public function __construct(ResponseDataRetriever $responseRetriever)
    {
        $this->responseRetriever = $responseRetriever;
    }

    public function validateResponse(ResponseInterface $response): ResponseInterface
    {
        if (!$this->isSuccessStatusCode($response->getStatusCode())) {
            throw new TestApiException('Failed TestApi call');
        }

        $body = $this->responseRetriever->retrieve($response);

        if ($error = $body['error'] ?? null) {
            throw new TestApiException($error);
        }

        return $response;
    }

    private function isSuccessStatusCode(int $statusCode): bool
    {
        if ($statusCode >= 200 && $statusCode < 300) {
            return true;
        }

        return false;
    }
}
