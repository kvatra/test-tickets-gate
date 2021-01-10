<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReservePlacesRequest;
use App\Infrastructure\TicketGate\TicketProviders\TestApi\Provider;

class EventController extends Controller
{
    public function getPlaces(int $eventId, Provider $provider)
    {
        $places = collect($provider->getEventPlaces($eventId))
            ->keyBy('id')
            ->toArray();

        return view('event_places', compact('places'));
    }

    public function reservePlaces(int $eventId, ReservePlacesRequest $request, Provider $provider)
    {
        $params = $request->validated();

        $result = $provider->reservePlaces($eventId, $params['customer_name'], $params['places']);

        return response()->json(compact('result'));
    }
}
