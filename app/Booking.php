<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    public function extras()
    {
        return $this->hasMany('App\Extras');
    }
}
