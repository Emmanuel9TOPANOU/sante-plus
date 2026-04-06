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
    Schema::table('consultations', function (Blueprint $table) {
        // Ajout des colonnes manquantes
        $table->decimal('temperature', 4, 1)->nullable()->after('poids'); 
        $table->integer('frequence_cardiaque')->nullable()->after('temperature');
        $table->text('notes_privees')->nullable()->after('observations');
        
        // Si tu veux ajouter les relations directes pour plus de rapidité
        $table->foreignId('patient_id')->nullable()->constrained('users')->onDelete('cascade');
        $table->foreignId('doctor_id')->nullable()->constrained('users')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('consultations', function (Blueprint $table) {
        $table->dropColumn(['temperature', 'frequence_cardiaque', 'notes_privees', 'patient_id', 'doctor_id']);
    });
}
};
