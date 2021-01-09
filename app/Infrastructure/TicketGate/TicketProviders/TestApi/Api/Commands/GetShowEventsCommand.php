<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands;

class GetShowEventsCommand extends BaseCommand
{
    private int $showId;

    public function __construct(int $showId)
    {
        $this->showId = $showId;
    }

    public function getMethod(): string
    {
        return self::METHOD_GET;
    }

    public function getPath(): string
    {
        return "shows/{$this->showId}/events";
    }
}
