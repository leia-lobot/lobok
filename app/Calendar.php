<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jobs\SynchronizeGoogleEvents;

class Calendar extends Model
{
    protected $fillable = ['google_id', 'name', 'color', 'timezone'];

    public static function boot()
    {
        parent::boot();

        static::created(function($calendar) {
            SynchronizeGoogleEvents::dispatch($calendar);
        });
    }

    public function googleAccount()
    {
        return $this->belongsTo(GoogleAccount::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
