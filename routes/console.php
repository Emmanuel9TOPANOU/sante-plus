<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
*/

// Commande d'inspiration par défaut
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

/**
 * PLANIFICATION DES RAPPELS SANTÉ+
 * Le système vérifiera chaque jour à 08h00 quels patients ont un RDV demain.
 */
Schedule::command('app:send-reminders')
    ->dailyAt('08:00')
    ->appendOutputTo(storage_path('logs/rappels_automatiques.log')); 

/** * TEST RAPIDE (À commenter après vérification) :
 * Décommente la ligne ci-dessous pour tester l'envoi toutes les minutes.
 */
// Schedule::command('app:send-reminders')->everyMinute();