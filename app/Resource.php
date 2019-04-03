<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Resource extends Model
{
    use Sluggable;

    protected $guarded = [];

    public function bookings()
    {
        return $this->belongsToMany('App\Booking');
    }

    public function extras()
    {
        return $this->belongsToMany('App\Extras');
    }

    public function path()
    {
        return "/resources/{$this->slug}";
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
