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
    Schema::create('prescriptions', function (Blueprint $table) {
        $table->id();
        $table->string('reference')->unique(); // Ex: ORD-5A2B
        
        // Liens avec les autres tables
        $table->foreignId('medecin_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
        
        // La consultation est optionnelle (nullable) au cas où on crée une ordonnance directe
        $table->foreignId('consultation_id')->nullable()->constrained('consultations')->onDelete('set null');
        
        $table->text('contenu'); // Médicaments, posologie, etc.
        $table->date('date_emission');
        
        $table->timestamps(); // created_at et updated_at
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
