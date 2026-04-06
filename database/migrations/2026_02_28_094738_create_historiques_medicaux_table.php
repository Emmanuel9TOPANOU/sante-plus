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
    Schema::create('historiques_medicaux', function (Blueprint $table) {
        $table->id();
        // Lié au patient
        $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
        
        $table->text('antecedents')->nullable();
        $table->text('allergies')->nullable();
        $table->text('maladies_chroniques')->nullable();
        $table->text('traitements_en_cours')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiques_medicaux');
    }
};
