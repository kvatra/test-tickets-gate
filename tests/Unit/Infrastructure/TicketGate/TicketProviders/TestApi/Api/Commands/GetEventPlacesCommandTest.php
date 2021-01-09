<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands\GetEventPlacesCommand;
use Tests\TestCase;

class GetEventPlacesCommandTest extends TestCase
{
    /** @test */
    public function correctCommand(): void
    {
        $command = new GetEventPlacesCommand(14);

        $this->assertSame('GET', $command->getMethod());
        $this->assertSame('events/14/places', $command->getPath());
        $this->assertEmpty($command->getBody());
    }
}
