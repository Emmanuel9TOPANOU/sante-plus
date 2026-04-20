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
        if (!Schema::hasColumn('users', 'telephone')) {
            $table->string('telephone')->nullable();
        }
        if (!Schema::hasColumn('users', 'date_naissance')) {
            $table->date('date_naissance')->nullable();
        }
        if (!Schema::hasColumn('users', 'sexe')) {
            $table->string('sexe')->nullable();
        }
        if (!Schema::hasColumn('users', 'adresse')) {
            $table->text('adresse')->nullable();
        }
        if (!Schema::hasColumn('users', 'numero_securite_sociale')) {
            $table->string('numero_securite_sociale')->nullable();
        }
        if (!Schema::hasColumn('users', 'groupe_sanguin')) {
            $table->string('groupe_sanguin', 5)->nullable();
        }
        if (!Schema::hasColumn('users', 'antecedents')) {
            $table->text('antecedents')->nullable();
        }
        if (!Schema::hasColumn('users', 'allergies')) {
            $table->text('allergies')->nullable();
        }
        if (!Schema::hasColumn('users', 'observations_medicales')) {
            $table->text('observations_medicales')->nullable();
        }
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
