<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute la migration.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajout de la colonne après le mot de passe
            // true = doit changer / false = déjà fait
            $table->boolean('must_change_password')->default(false)->after('password');
        });
    }

    /**
     * Annule la migration.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // On supprime la colonne si on annule la migration
            if (Schema::hasColumn('users', 'must_change_password')) {
                $table->dropColumn('must_change_password');
            }
        });
    }
};