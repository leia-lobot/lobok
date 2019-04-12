<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Services\Google\GoogleClient;

class GoogleServiceProvider extends ServiceProvider implements DeferrableProvider
{
    protected $defer = true;

    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('App\Services\Google\Contracts\Client', function () {
            return new GoogleClient(config('google'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }

    public function provides()
    {
        return [GoogleClient::class];
    }
}
