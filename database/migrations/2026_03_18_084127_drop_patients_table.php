<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // N'oublie pas d'ajouter DB ici

return new class extends Migration
{
    public function up(): void
    {
        // 1. On désactive les contraintes pour éviter l'erreur 1451
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2. On supprime la table
        Schema::dropIfExists('patients');

        // 3. On les réactive immédiatement après
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down(): void
    {
        // Pas besoin de toucher au down si tu l'as déjà rempli, 
        // mais pense à réactiver les checks ici aussi si tu recrées la table.
    }
};