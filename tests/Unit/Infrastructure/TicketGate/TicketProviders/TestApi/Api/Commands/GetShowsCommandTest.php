<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands\GetShowsCommand;
use Tests\TestCase;

class GetShowsCommandTest extends TestCase
{
    /** @test */
    public function correctCommand(): void
    {
        $command = new GetShowsCommand();

        $this->assertSame('GET', $command->getMethod());
        $this->assertSame('shows', $command->getPath());
        $this->assertEmpty($command->getBody());
    }
}
