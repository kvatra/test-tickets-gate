<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Infrastructure\TicketGate\TicketProviders\TestApi\Provider;

class ShowController extends Controller
{
    public function getList(Provider $provider)
    {
        $shows = collect($provider->getShows())
            ->keyBy('id')
            ->map->name
            ->toArray();

        return view('shows', compact('shows'));
    }

    public function getShow(int $showId, Provider $provider)
    {
        $events = collect($provider->getShowEvents($showId))
            ->keyBy('id')
            ->map->date
            ->toArray();

        return view('show', compact('events'));
    }
}
