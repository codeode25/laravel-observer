<?php

namespace App\Providers;

use App\Services\LogUserCreation;
use App\Services\SendWelcomeEmail;
use App\Services\RegistrationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RegistrationService::class, function ($app) {
            $service = new RegistrationService();

            $service->attach(new LogUserCreation());
            $service->attach(new SendWelcomeEmail());

            return $service;
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
