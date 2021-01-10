<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\TicketProviders\TestApi\Api;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands\BaseCommand;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class ApiClient
{
    private Client $guzzle;
    private ResponseValidator $responseValidator;
    private string $token;

    public function __construct(Client $guzzle, ResponseValidator $responseValidator, string $token)
    {
        $this->guzzle = $guzzle;
        $this->responseValidator = $responseValidator;
        $this->token = $token;
    }

    public function sendCommandRequest(BaseCommand $command): ResponseInterface
    {
        $method = $command->getMethod();
        $uri = $command->getPath();
        $headers = [
            'Authorization' => "token={$this->token}"
        ];

        $options = [
            'form_params' => $command->getBody(),
            'headers' => $headers,
        ];

        $response = $this->guzzle
            ->request($method, $uri, $options);

        return $this->responseValidator
            ->validateResponse($response);
    }
}
