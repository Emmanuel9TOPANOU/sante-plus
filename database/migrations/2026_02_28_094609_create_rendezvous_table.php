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
        Schema::create('rendezvous', function (Blueprint $table) {
            $table->id();
            
            // Relation avec la table users pour le patient et le médecin
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medecin_id')->constrained('users')->onDelete('cascade');
            
            // Qui a créé le RDV (Patient lui-même ou Secrétaire)
            $table->foreignId('cree_par')->nullable()->constrained('users')->onDelete('set null');
            
            $table->date('date_rdv');
            $table->time('heure_rdv');
            $table->string('motif')->nullable();
            
            $table->enum('statut', ['en_attente', 'confirme', 'termine', 'annule'])->default('en_attente');
            $table->timestamps();
        });
    } // L'accolade était mal placée ici dans votre version

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendezvous');
    }
};