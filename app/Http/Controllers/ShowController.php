<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\Show\Queries\ShowEventsQuery;
use App\Modules\Show\Queries\ShowListQuery;

class ShowController extends Controller
{
    public function getList(ShowListQuery $query)
    {
        $shows = $query->fetch()
            ->keyBy->getId()
            ->map->getName();

        return view('shows', compact('shows'));
    }

    public function getShowEvents(int $showId, ShowEventsQuery $query)
    {
        $events = $query->fetch($showId)
            ->keyBy->getId()
            ->map->getDate();

        return view('show', compact('events'));
    }
}
