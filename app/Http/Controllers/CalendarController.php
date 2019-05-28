<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\Reservation;
use function GuzzleHttp\json_encode;

class CalendarController extends Controller
{
    public function index()
    {
        $resources = Resource::all();
        $reservations = Reservation::all();

        $transformedResources = $resources->map(function ($resource) {
            return [
                'resourceId' => $resource->id,
                'resourceTitle' => $resource->name
            ];
        });

        $transformedReservations = $reservations->map(function ($reservation) {
            return [
                'id' => $reservation->id,
                'title' => $reservation->title,
                'start' => date($reservation->start_time),
                'end' => date($reservation->end_time),
                'resourceId' => $reservation->resource_id
            ];
        });

        return response(json_encode(['resources' => $transformedResources, 'reservations' => $transformedReservations]), 200);
    }
}
