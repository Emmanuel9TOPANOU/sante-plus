<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Ajout des colonnes manquantes
            $table->foreignId('patient_id')->after('id')->constrained('patients')->onDelete('cascade');
            $table->string('nom')->after('patient_id');
            $table->string('type')->after('nom'); // analyse, radio, courrier, autre
            $table->string('chemin_fichier')->after('type');
            $table->foreignId('uploaded_by')->after('chemin_fichier')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Suppression des colonnes en cas de rollback
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['uploaded_by']);
            $table->dropColumn(['patient_id', 'nom', 'type', 'chemin_fichier', 'uploaded_by']);
        });
    }
};