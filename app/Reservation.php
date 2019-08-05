<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reservation\State;

class Reservation extends Model
{
    protected $guarded = [];
    protected $attributes = [
        'state' => State::STATE_PENDING,
        'title' => 'test',
        'description' => 'testing testing'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'date' => 'date'
    ];

    public function extras()
    {
        return $this->hasMany('App\Extras');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    public function path()
    {
        return "/reservations/{$this->id}";
    }

    public function getStartedAtAttribute($start)
    {
        return $this->asDateTime($start)->setTimezone(config('app.timezone'));
    }

    public function getEndedAtAttribute($end)
    {
        return $this->asDateTime($end)->setTimezone(config('app.timezone'));
    }

    public function getDurationAttribute()
    {
        return $this->started_at->diffForHumans($this->ended_at, true);
    }
}
