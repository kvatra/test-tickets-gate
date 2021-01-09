<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands\ReserveEventPlaceCommand;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ReserveEventPlaceCommandTest extends TestCase
{
    /** @test */
    public function correctCommand(): void
    {
        $command = new ReserveEventPlaceCommand(13, 'Name', [14]);

        $this->assertSame('POST', $command->getMethod());
        $this->assertSame("events/13/reserve", $command->getPath());
        $this->assertSame([
            'name' => 'Name',
            'places' => [14],
        ], $command->getBody());
    }

    /**
     * @test
     * @dataProvider failedValidationDataProvider
     */
    public function failedValidation(string $name, array $placesIds): void
    {
        $this->expectException(ValidationException::class);
        new ReserveEventPlaceCommand(13, $name, $placesIds);
    }

    public function failedValidationDataProvider(): array
    {
        return [
            'empty name' => [
                'name' => '',
                'places' => [14]
            ],
            'empty places' => [
                'name' => 'Name',
                'places' => []
            ],
            'null in places' => [
                'name' => 'Name',
                'places' => [13, null]
            ],
            'only null in places' => [
                'name' => 'Name',
                'places' => [null]
            ],
        ];
    }
}
