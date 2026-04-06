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
    Schema::create('consultations', function (Blueprint $table) {
        $table->id();
        // Relation avec le rendez-vous (clé étrangère)
        $table->foreignId('rendezvous_id')->constrained('rendezvous')->onDelete('cascade');
        
        // Informations médicales
        $table->text('diagnostic');
        $table->text('observations')->nullable();
        $table->string('tension')->nullable();
        $table->integer('poids')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
