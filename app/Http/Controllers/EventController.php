<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReservePlacesRequest;
use App\Modules\ShowEvents\Commands\ReserveEventPlaces;
use App\Modules\ShowEvents\Queries\EventPlacesQuery;

class EventController extends Controller
{
    public function getPlaces(int $eventId, EventPlacesQuery $query)
    {
        $places = $query->fetch($eventId)
            ->keyBy->getId()
            ->map->getParams();

        return view('event_places', compact('places'));
    }

    public function reservePlaces(int $eventId, ReservePlacesRequest $request)
    {
        $params = $request->validated();
        $command = new ReserveEventPlaces($eventId, $params['customer_name'], $params['places']);
        $reservationId = $this->dispatchNow($command);

        return response()->json(['id' => $reservationId]);
    }
}
