<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Company;
use App\Resource;
use Carbon\Carbon;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return Inertia::render('Dashboard/Index');
    }

    public function welcome()
    {
        return Inertia::render('Welcome');
    }

    public function overview()
    {
        $rawResources = Resource::all();
        // TODO: Don't fetch all events, just upcoming and maybe 1 week old?
        $rawEvents = Reservation::all();




        $events = $rawEvents->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => Carbon::parse("{$event->start_time}")->toW3cString(),
                'end' => Carbon::parse("{$event->end_time}")->toW3cString(),
                'resourceId' => $event->resource_id
            ];
        });

        $resources = $rawResources->map(function ($resource) {
            return [
                'resourceId' => $resource->id,
                'resourceTitle' => $resource->name
            ];
        });

        return Inertia::render('Dashboard/Overview', compact(['resources', 'events']));
    }

    public function reservation()
    {
        $companies = Company::all();
        $resources = Resource::all();

        return Inertia::render('Dashboard/Reservation', compact(['companies', 'resources']));
    }
}
