<?php

declare(strict_types=1);

namespace App\Providers;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\ApiClient;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\ResponseDataRetriever;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Provider;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\ResponseValidator;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class TestApiTicketGateServiceProvider extends ServiceProvider
{
    public function register()
    {
        $config = config('test_api_ticket_gate');

        $guzzle = new Client(['base_uri' => $config['base_url']]);

        $responseRetriever = new ResponseDataRetriever();
        $responseValidator = new ResponseValidator($responseRetriever);
        $apiClient = new ApiClient($guzzle, $responseValidator, $config['token']);

        $this->app->bind(Provider::class, fn() => new Provider($apiClient));
    }
}
