<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CheckUserRole;
use PharIo\Manifest\Application;
use Illuminate\Foundation\Application as IlluminateApplication;
use Illuminate\Contracts\Foundation\Application as IlluminateContractsApplication;
use App\Role\RoleChecker;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CheckUserRole::class, function(IlluminateContractsApplication $app) {
            return new CheckUserRole(
                $app->make(RoleChecker::class)
            );
        });
    }

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
