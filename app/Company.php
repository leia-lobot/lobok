<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/companies/{$this->id}";
    }

    public function reservations() {
        return $this->hasMany('App\Reservation');
    }

    public function users() {
        return $this->hasMany('App\User');
    }
}
