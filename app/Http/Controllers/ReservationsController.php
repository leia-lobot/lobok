<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Company;
use Carbon\Carbon;

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
        /*      $validation = request()->validate([
            'company' => 'required|exists:companies,id',
            'resource' => 'required|exists:resources,id',
            'start_time' => 'required|date|after:yesterday',
            'end_time' => 'required|date|after:start_time',
            'attendants' => 'required|numeric',
            'extras' => 'nullable'
        ]); */


        // Creation
        $user = auth()->user();

        $stuff = request();
        //dd($stuff);
        //$attributes['user_id'] = 1;

        $company = Company::where('id', $stuff['company'])->first();

        $attributes = [
            'user_id' => $user->id,
            'resource_id' => $stuff['resource'],
            //'title' => $company->name + '-' + $stuff['resource'],
            'date' => Carbon::parse($stuff['date']),
            'start_time' => Carbon::parse($stuff['start-time']),
            'end_time' => Carbon::parse($stuff['end-time']),
            'attendants' => $stuff['attendants'],
            //'extras' => $stuff['extras']
        ];



        $reservation = $company->reservations()->create($attributes);

        $reservation->save();

        return redirect('/home');

        /*$attributes['user_id'] = $user->id;

        if ($user->company instanceof \App\Company) {
            $user->company->reservations()->create($attributes);
        } else {
            return response('Need to belong to a company to add a reservation', 403);
        }
        */
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

    public function destroy($id)
    {
        $reservation = Reservation::where('id', $id)->first();
        $reservation->delete();
    }

    public function create()
    {
        return view('reservations.create');
    }
}
