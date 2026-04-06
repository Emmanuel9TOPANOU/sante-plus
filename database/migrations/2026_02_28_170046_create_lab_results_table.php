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
        Schema::create('lab_results', function (Blueprint $table) {
            $table->id();
            // Relation directe avec l'utilisateur (Patient)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Détails de l'analyse
            $table->string('type_analyse'); // ex: Glycémie
            $table->string('valeur')->nullable(); // ex: 1.2
            $table->string('unite')->nullable();  // ex: g/L
            $table->string('norme')->nullable();  // ex: 0.70 - 1.10
            
            // État et fichiers
            $table->enum('statut', ['en_attente', 'termine', 'annule'])->default('termine');
            $table->string('pdf_path')->nullable(); 
            $table->text('commentaire_medecin')->nullable();
            
            $table->timestamp('date_prelevement')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_results');
    }
};