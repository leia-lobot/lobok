<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Rules\ReservationStateRule;
use Illuminate\Support\Facades\Validator;

class ReservationsStateController extends Controller
{
    public function changeState($id) {

        // Validate

        $validator = Validator::make(request()->all(),[
            'state' => [
                'required',
                new ReservationStateRule
            ],
        ])->validate();

        // Fetch
        $reservation = Reservation::where('id', $id)->first();

        // Update
        $reservation->update([
            'state' => request('state')
        ]);

         // TODO: Fire some kind of event to do stuffs
    }
}
