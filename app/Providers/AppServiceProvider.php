<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\AuthenticationServiceContract;
use App\Services\Auth\DefaultAuthenticationService;
use App\Services\Auth\AuthenticationManager;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // register Authentication service provider and interface
        $this->app->bind(AuthenticationServiceContract::class, DefaultAuthenticationService::class);

        $this->app->singleton(AuthenticationManager::class, function ($app) {
            return new AuthenticationManager($app->make(AuthenticationServiceContract::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
