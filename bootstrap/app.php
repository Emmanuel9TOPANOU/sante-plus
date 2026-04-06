<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // Nettoyage complet des alias pour stopper l'erreur de chargement
        $middleware->alias([
            // Garde uniquement ce qui existe réellement et ce qu'on utilise
            'role' => \App\Http\Middleware\CheckRole::class,
            'check.medecin' => \App\Http\Middleware\CheckMedecinValidation::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();