<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('lab_results', function (Blueprint $table) {
        // On ne crée la colonne que si elle n'existe pas encore
        if (!Schema::hasColumn('lab_results', 'laboratoire_nom')) {
            $table->string('laboratoire_nom')->default('Laboratoire Interne')->after('norme');
        }
        
        if (!Schema::hasColumn('lab_results', 'date_prelevement')) {
            $table->dateTime('date_prelevement')->nullable()->after('laboratoire_nom');
        }

        if (!Schema::hasColumn('lab_results', 'biologiste_nom')) {
            $table->string('biologiste_nom')->nullable()->after('interpretation');
        }

        if (!Schema::hasColumn('lab_results', 'date_validation')) {
            $table->dateTime('date_validation')->nullable()->after('biologiste_nom');
        }

        if (!Schema::hasColumn('lab_results', 'pdf_path')) {
            $table->string('pdf_path')->nullable()->after('statut');
        }
    });
}

public function down()
{
    Schema::table('lab_results', function (Blueprint $table) {
        $table->dropColumn(['laboratoire_nom', 'date_prelevement', 'biologiste_nom', 'date_validation', 'pdf_path']);
    });
}
};
