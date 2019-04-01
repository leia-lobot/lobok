<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Company extends Model
{
    use Sluggable;

    protected $guarded = [];

    public function path()
    {
        return "/companies/{$this->slug}";
    }

    public function reservations() {
        return $this->hasMany('App\Reservation');
    }

    public function users() {
        return $this->hasMany('App\User');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
