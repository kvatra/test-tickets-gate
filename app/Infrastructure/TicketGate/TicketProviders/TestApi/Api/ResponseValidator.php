<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\TicketProviders\TestApi\Api;

use Psr\Http\Message\ResponseInterface;

class ResponseValidator
{
    public function validateResponse(ResponseInterface $response): array
    {
        if (!$this->isSuccessStatusCode($response->getStatusCode())) {
            throw new TestApiException('Failed TestApi call');
        }

        $content = $response->getBody()->getContents();
        $decodedContent = json_decode($content, true);

        if ($error = $decodedContent['error'] ?? null) {
            throw new TestApiException($error);
        }

        return $decodedContent['response'];
    }

    private function isSuccessStatusCode(int $statusCode): bool
    {
        if ($statusCode >= 200 && $statusCode < 300) {
            return true;
        }

        return false;
    }
}
