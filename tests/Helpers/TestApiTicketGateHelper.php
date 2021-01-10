<?php

declare(strict_types=1);

namespace Tests\Helpers;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

trait TestApiTicketGateHelper
{
    private function makeSuccessResponse(array $data = ['data']): ResponseInterface
    {
        $responseData = json_encode(['response' => $data]);

        return new Response(200, [], $responseData);
    }
}
