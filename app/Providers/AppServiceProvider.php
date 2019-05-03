<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PharIo\Manifest\Application;
use Illuminate\Foundation\Application as IlluminateApplication;
use Illuminate\Contracts\Foundation\Application as IlluminateContractsApplication;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
