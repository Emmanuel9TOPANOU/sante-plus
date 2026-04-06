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
        // On ajoute la colonne après le champ 'role'
        // nullable() est important car les patients n'ont pas de spécialité
        $table->foreignId('specialite_id')
              ->nullable()
              ->after('role')
              ->constrained('specialites')
              ->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['specialite_id']);
        $table->dropColumn('specialite_id');
    });
}
};
