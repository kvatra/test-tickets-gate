<?php

declare(strict_types=1);

namespace App\Infrastructure\TicketGate\TicketProviders\TestApi\Api\Commands;

use Illuminate\Support\Facades\Validator;

class ReserveEventPlaceCommand extends BaseCommand
{
    private int $eventId;
    private array $body;

    public function __construct(int $eventId, string $customerName, array $placesIds)
    {
        $this->eventId = $eventId;
        $this->body = $this->makeBody($customerName, $placesIds);
    }

    public function getMethod(): string
    {
        return self::METHOD_POST;
    }

    public function getPath(): string
    {
        return "events/{$this->eventId}/reserve";
    }

    public function getBody(): array
    {
        return $this->body;
    }

    private function makeBody(string $customerName, array $placesIds): array
    {
        $data = [
            'name' => $customerName,
            'places' => $placesIds,
        ];

        return $this->validateData($data);
    }

    private function validateData(array $data): array
    {
        $rules = [
            'name' => 'string|required',
            'places' => 'required',
            'places.*' => 'integer',
        ];

        return Validator::make($data, $rules)->validate();
    }
}
