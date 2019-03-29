<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    public function bookings()
    {
        return $this->belongsToMany('App\Booking');
    }
}
