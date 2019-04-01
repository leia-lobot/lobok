<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();

        return view('bookings.index', compact('bookings'));
    }

    public function store()
    {
        // Validation
        $validation = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'resource_id' => 'required|exists:resources,id',
            'company_id' => 'required|exists:companies,id',
            'start_time' => 'required|date|after:yesterday',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Creation
        $user = auth()->user();
        $user->bookings()->create(request(['title', 'description', 'resource_id', 'company_id', 'start_time', 'end_time']));

        // Redirect
        return redirect('/bookings');
    }
}
