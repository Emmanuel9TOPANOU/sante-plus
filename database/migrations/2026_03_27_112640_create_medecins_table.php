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
    Schema::create('medecins', function (Blueprint $table) {
        $table->id();
        
        // Relation avec la table users (Le compte de connexion)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Relation avec la table spécialités
        $table->foreignId('specialite_id')->constrained()->onDelete('restrict');

        // Informations professionnelles obligatoires
        $table->string('matricule')->unique(); // Numéro d'ordre national des médecins
        $table->string('telephone_pro')->nullable();
        $table->text('biographie')->nullable(); // Présentation du parcours
        
        // Localisation dans la clinique
        $table->string('cabinet_numero')->nullable(); // Ex: Bureau A12, 1er étage
        
        // Sécurité : L'admin doit valider l'inscription
        $table->boolean('est_valide')->default(false); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecins');
    }
};
