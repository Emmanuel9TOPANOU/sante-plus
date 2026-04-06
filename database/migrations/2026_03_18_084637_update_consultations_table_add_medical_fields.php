<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up(): void
{
    Schema::table('consultations', function (Blueprint $table) {
        // On vérifie si 'patient_id' n'existe pas AVANT de l'ajouter
        if (!Schema::hasColumn('consultations', 'patient_id')) {
            $table->foreignId('patient_id')->after('rendezvous_id')->constrained('users')->onDelete('cascade');
        }

        // On vérifie pour 'doctor_id'
        if (!Schema::hasColumn('consultations', 'doctor_id')) {
            $table->foreignId('doctor_id')->after('patient_id')->constrained('users')->onDelete('cascade');
        }

        // On ajoute la température (souvent oubliée)
        if (!Schema::hasColumn('consultations', 'temperature')) {
            $table->decimal('temperature', 4, 1)->nullable()->after('poids');
        }
    });
}

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['doctor_id']);
            $table->dropColumn(['patient_id', 'doctor_id', 'temperature']);
        });
    }
};