<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;

class ReservationsController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();

        return view('reservations.index', compact('reservations'));
    }

    public function store()
    {
        // Validation
        $validation = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'resource_id' => 'required|exists:resources,id',
            'start_time' => 'required|date|after:yesterday',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Creation
        $user = auth()->user();

        $attributes = request(['title', 'description', 'resource_id', 'start_time', 'end_time']);
        $attributes['user_id'] = $user->id;

        if ($user->company instanceof \App\Company) {
            $user->company->reservations()->create($attributes);
        } else {
            return response('Need to belong to a company to add a reservation', 403);
        }
    }

    public function update($id)
    {
        $reservation = Reservation::where('id', $id)->first();

        // Validate
        $validate = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'resource_id' => 'required|exists:resources,id',
            'start_time' => 'required|date|after:yesterday',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Update

        $reservation->update(request([
            'title',
            'description',
            'resource_id',
            'start_time',
            'end_time',
        ]));

        // Redirect
        return redirect('/resources');
    }
}
