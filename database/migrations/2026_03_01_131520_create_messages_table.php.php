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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            // L'utilisateur qui envoie (Patient, Médecin ou Secrétaire)
            $table->foreignId('sender_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // L'utilisateur qui reçoit
            $table->foreignId('receiver_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->text('content'); // Le corps du message
            
            // Pour le Point 9 : Gérer les notifications de messages non lus
            $table->boolean('is_read')->default(false);
            
            $table->timestamps();

            // Index pour accélérer le chargement des discussions
            $table->index(['sender_id', 'receiver_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};