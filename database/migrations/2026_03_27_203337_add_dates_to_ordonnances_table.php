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
        // On ajoute les colonnes de dates si elles n'existent pas
        if (!Schema::hasColumn('ordonnances', 'date_emission')) {
            $table->date('date_emission')->nullable()->after('contenu_prescription');
        }
        if (!Schema::hasColumn('ordonnances', 'date_expiration')) {
            $table->date('date_expiration')->nullable()->after('date_emission');
        }
    });
}

public function down(): void
{
    Schema::table('ordonnances', function (Blueprint $table) {
        $table->dropColumn(['date_emission', 'date_expiration']);
    });
}
};
