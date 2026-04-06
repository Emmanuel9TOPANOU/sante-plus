<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lab_results', function (Blueprint $table) {
            // On ajoute la colonne consultation_id après user_id
            // nullable() est important si tu as déjà des analyses sans consultation en base
            $table->foreignId('consultation_id')
                  ->after('user_id') 
                  ->nullable()
                  ->constrained('consultations')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lab_results', function (Blueprint $table) {
            // On supprime la contrainte de clé étrangère puis la colonne
            $table->dropForeign(['consultation_id']);
            $table->dropColumn('consultation_id');
        });
    }
};