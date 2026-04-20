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
    Schema::create('documents', function (Blueprint $table) {
        $table->id();
        
        // On lie le patient à la table 'users'
        $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
        
        $table->string('nom');
        $table->string('type'); // analyse, radio, courrier, etc.
        $table->string('chemin_fichier');
        
        // On lie celui qui a ajouté le fichier à la table 'users'
        $table->foreignId('uploaded_by')->constrained('users');
        
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('documents');
}
};
