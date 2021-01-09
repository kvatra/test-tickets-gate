<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands\GetShowEventsCommand;
use Tests\TestCase;

class GetShowEventsCommandTest extends TestCase
{
    /** @test */
    public function correctCommand(): void
    {
        $command = new GetShowEventsCommand(13);

        $this->assertSame('GET', $command->getMethod());
        $this->assertSame('shows/13/events', $command->getPath());
        $this->assertEmpty($command->getBody());
    }
}
