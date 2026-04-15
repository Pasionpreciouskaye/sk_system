<?php

namespace App\Providers;

use App\Services\Auth\AuthLogger;
use App\Services\Auth\LoginService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AuthLogger::class);

        $this->app->singleton(LoginService::class, function ($app) {
            return new LoginService($app->make(AuthLogger::class));
        });
    }

    public function boot(): void
    {
        //
    }
}
