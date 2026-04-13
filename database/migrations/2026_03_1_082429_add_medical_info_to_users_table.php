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
    Schema::table('users', function (Blueprint $table) {
        $table->string('telephone')->nullable();
        $table->date('date_naissance')->nullable();
        $table->string('sexe')->nullable();
        $table->text('adresse')->nullable();
        $table->string('numero_securite_sociale')->nullable();
        $table->string('groupe_sanguin', 5)->nullable();
        $table->text('antecedents')->nullable();
        $table->text('allergies')->nullable();
        $table->text('observations_medicales')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
