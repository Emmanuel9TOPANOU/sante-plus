<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Import important

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // On force le HTTPS uniquement en production (sur Railway)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
} // Vérifie bien que cette dernière accolade est présente !