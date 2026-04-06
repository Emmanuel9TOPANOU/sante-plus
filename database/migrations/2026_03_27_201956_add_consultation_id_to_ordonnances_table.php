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
    Schema::table('ordonnances', function (Blueprint $table) {
        // Ajoute la colonne et la clé étrangère
        $table->foreignId('consultation_id')->after('id')->constrained()->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('ordonnances', function (Blueprint $table) {
        $table->dropForeign(['consultation_id']);
        $table->dropColumn('consultation_id');
    });
}
};
