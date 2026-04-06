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
    Schema::create('ordonnances', function (Blueprint $table) {
        $table->id();
        // Lié au rendez-vous (ou à une consultation si tu as la table)
        $table->foreignId('rendezvous_id')->constrained('rendezvous')->onDelete('cascade');
        
        $table->text('contenu_prescription'); // Médicaments, doses...
        $table->date('date_emission');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordonnances');
    }
};
