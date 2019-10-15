<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Company;
use App\Reservation;
use App\Resource;

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
        $this->validate(request(), [
            'company' => 'required|exists:companies,id',
            'resource' => 'required|exists:resources,id',
            'start' => 'required|date|after:yesterday',
            'end' => 'required|date|after:start',
            'request_help' => '',
            'preliminary' => ''
        ]);


        // Creation
        $user = auth()->user();

        $stuff = request();

        $company = Company::where('id', $stuff['company'])->first();
        //if($company)

        $attributes = [
            'user_id' => $user->id,
            'resource_id' => $stuff['resource'],
            'start' => Carbon::parse($stuff['start']),
            'end' => Carbon::parse($stuff['end']),
            'request_help' => $stuff['request_help'],
            'preliminary' => $stuff['preliminary'],
        ];



        $reservation = $company->reservations()->create($attributes);

        $reservation->save();

        return redirect()->back()->with('success', ['message here']);
    }

    public function update($id)
    {
        $reservation = Reservation::where('id', $id)->first();

        // Validate
        $validate = request()->validate([
            'resource_id' => 'required|exists:resources,id',
            'start' => 'required|date|after:yesterday',
            'end' => 'required|date|after:start_time',
        ]);

        // Update

        $reservation->update(request([
            'resource',
            'start',
            'end',
        ]));

        // Redirect
        return redirect('/resources');
    }

    public function destroy($id)
    {
        $reservation = Reservation::where('id', $id)->first();
        $reservation->delete();
    }

    public function create()
    {
        $companies = Company::all();
        $resources = Resource::all();

        $companies = $companies->map(function ($company) {
            return [
                'value' => $company->id,
                'key' => $company->id,
                'text' => $company->name
            ];
        });
        $resources = $resources->map(function ($resource) {
            return [
                'value' => $resource->id,
                'key' =>  100 + $resource->id,
                'text' => $resource->name
            ];
        });

        return Inertia::render('Dashboard/Reservations/CreateReservation', compact(['companies', 'resources']));
    }
}
