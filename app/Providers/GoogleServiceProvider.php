<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Services\GoogleClient;
use App\Services\GoogleCalendar;

class GoogleServiceProvider extends ServiceProvider implements DeferrableProvider
{
    protected $defer = true;

    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('App\Services\Contracts\GoogleClientContract', function () {
            return new GoogleClient(config('google'));
        });

        $this->app->bind('App\Services\Contracts\GoogleCalendarContract', GoogleCalendar::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    { }

    public function provides()
    {
        return [GoogleClient::class, GooglCalendar::class];
    }
}
