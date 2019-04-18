<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jobs\SynchronizeGoogleCalendars;

class GoogleAccount extends Model
{
    protected $fillable = ['google_id', 'name', 'token'];
    protected $casts = ['token' => 'json'];

    public static function boot()
    {
        parent::boot();

        static::created(function($googleAccount) {
            SynchronizeGoogleCalendars::dispatch($googleAccount);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }
}
