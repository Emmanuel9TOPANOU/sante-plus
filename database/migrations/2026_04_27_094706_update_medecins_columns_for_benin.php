<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('medecins', function (Blueprint $table) {
            // Supprimer les colonnes RPPS et ADELI (spécifiques à la France)
            if (Schema::hasColumn('medecins', 'rpps')) {
                $table->dropColumn('rpps');
            }
            if (Schema::hasColumn('medecins', 'adeli')) {
                $table->dropColumn('adeli');
            }
            
            // Ajouter le numéro d'inscription à l'Ordre des Médecins du Bénin
            if (!Schema::hasColumn('medecins', 'numero_ordre')) {
                $table->string('numero_ordre')->nullable()->unique()->after('matricule');
            }
        });
    }

    public function down()
    {
        Schema::table('medecins', function (Blueprint $table) {
            if (Schema::hasColumn('medecins', 'numero_ordre')) {
                $table->dropColumn('numero_ordre');
            }
            $table->string('rpps')->nullable()->after('matricule');
            $table->string('adeli')->nullable()->after('rpps');
        });
    }
};