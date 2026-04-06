<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            // On lie à la table users (le médecin)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->date('date'); // Ex: 2026-03-20
            $table->time('start_time'); // Ex: 08:00:00
            $table->time('end_time'); // Ex: 12:00:00
            
            // Statut pour savoir si le créneau est encore libre
            $table->boolean('is_booked')->default(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};