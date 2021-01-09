<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands;

abstract class BaseCommand
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';

    public abstract function getMethod(): string;
    public abstract function getPath(): string;

    public function getBody(): array
    {
        return [];
    }
}
