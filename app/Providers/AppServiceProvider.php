<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Import important
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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


        // Création de ton admin (à supprimer après le premier succès)
        User::updateOrCreate(
            ['email' => 'admin@exemple.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin@exemple.com'),
                'role' => 'admin', 
                'email_verified_at' => now(),
            ]
        );
    }
} // Vérifie bien que cette dernière accolade est présente !