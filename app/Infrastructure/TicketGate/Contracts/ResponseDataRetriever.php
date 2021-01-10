<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\Contracts;

use Psr\Http\Message\ResponseInterface;

interface ResponseDataRetriever
{
    public function retrieve(ResponseInterface $response): array;
}
