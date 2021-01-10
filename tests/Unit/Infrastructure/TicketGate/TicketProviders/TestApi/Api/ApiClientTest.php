<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\TicketGate\TicketProviders\TestApi\Api;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\ApiClient;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands\BaseCommand;
use GuzzleHttp\Client;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;
use Tests\Helpers\TestApiTicketGateHelper;
use Tests\TestCase;

class ApiClientTest extends TestCase
{
    use TestApiTicketGateHelper;

    private string $token = 'fds14';

    /** @test */
    public function correctRequestBuilt(): void
    {
        $command = $this->makeCommand();

        $response = $this->makeSuccessResponse();

        $guzzleClient = $this->mockGuzzleClient($command, $response);

        /** @var ApiClient $apiClient */
        $apiClient = $this->app->make(ApiClient::class, [
            'guzzle' => $guzzleClient,
            'token' => $this->token
        ]);

        $apiClient->sendCommandRequest($command);
    }

    private function mockGuzzleClient(BaseCommand $command, ResponseInterface $response): MockObject
    {
        $mock = $this->createMock(Client::class);

        $expectedOptions = [
            'form_params' => $command->getBody(),
            'headers' => [
                'Authorization' => "token={$this->token}"
            ],
        ];
        $mock->expects($this->once())
            ->method('request')
            ->with(
                $command->getMethod(),
                $command->getPath(),
                $expectedOptions
            )
            ->willReturn($response);

        return $mock;
    }

    private function makeCommand(): BaseCommand
    {
        return new class extends BaseCommand
        {
            public function getMethod(): string
            {
                return BaseCommand::METHOD_POST;
            }

            public function getPath(): string
            {
                return 'some/path';
            }

            public function getBody(): array
            {
                return [
                    'data' => [1,2,3],
                ];
            }
        };
    }
}
