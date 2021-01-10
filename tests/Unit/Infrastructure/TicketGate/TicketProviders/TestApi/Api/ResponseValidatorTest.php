<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\TicketGate\TicketProviders\TestApi\Api;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\ResponseValidator;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\TestApiException;
use Tests\Helpers\TestApiTicketGateHelper;
use Tests\TestCase;
use GuzzleHttp\Psr7\Response;

class ResponseValidatorTest extends TestCase
{
    use TestApiTicketGateHelper;

    private ResponseValidator $responseValidator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->responseValidator = $this->app->make(ResponseValidator::class);
    }

    /** @test */
    public function failedForResponseWithErrorMessage(): void
    {
        $errorMessageText = 'Bad response';
        $responseData = json_encode(['error' => $errorMessageText]);
        $response = new Response(200, [], $responseData);

        $this->expectException(TestApiException::class);
        $this->expectExceptionMessage($errorMessageText);
        $this->responseValidator->validateResponse($response);
    }

    /** @test */
    public function failedForNotSuccessResponse(): void
    {
        $response = new Response(404);

        $this->expectException(TestApiException::class);
        $this->expectExceptionMessage('Failed TestApi call');
        $this->responseValidator->validateResponse($response);
    }
}
