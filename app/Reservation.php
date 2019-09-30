<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reservation\State;

class Reservation extends Model
{
    protected $guarded = [];
    protected $attributes = [
        'state' => State::STATE_PENDING
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'request_help' => 'boolean',
        'preliminary' => 'boolean'
    ];

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

    public function getTitleAttribute()
    {
        return $this->company->name . ' - ' . $this->user->name;
    }
}
