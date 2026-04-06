<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lab_results', function (Blueprint $table) {
            // On vérifie chaque colonne avant de l'ajouter
            if (!Schema::hasColumn('lab_results', 'unite')) {
                $table->string('unite')->nullable()->after('valeur');
            }
            
            if (!Schema::hasColumn('lab_results', 'norme')) {
                $table->string('norme')->nullable()->after('unite');
            }

            if (!Schema::hasColumn('lab_results', 'laboratoire_nom')) {
                $table->string('laboratoire_nom')->default('Laboratoire Central Santé+')->after('norme');
            }

            if (!Schema::hasColumn('lab_results', 'date_prelevement')) {
                $table->timestamp('date_prelevement')->nullable()->after('laboratoire_nom');
            }

            if (!Schema::hasColumn('lab_results', 'date_validation')) {
                $table->timestamp('date_validation')->nullable()->after('date_prelevement');
            }

            if (!Schema::hasColumn('lab_results', 'interpretation')) {
                $table->text('interpretation')->nullable()->after('date_validation');
            }

            if (!Schema::hasColumn('lab_results', 'biologiste_nom')) {
                $table->string('biologiste_nom')->nullable()->after('interpretation');
            }

            if (!Schema::hasColumn('lab_results', 'signature_path')) {
                $table->string('signature_path')->nullable()->after('biologiste_nom');
            }
        });
    }

    public function down(): void
    {
        Schema::table('lab_results', function (Blueprint $table) {
            $table->dropColumn([
                'unite', 'norme', 'laboratoire_nom', 'date_prelevement', 
                'date_validation', 'interpretation', 'biologiste_nom', 'signature_path'
            ]);
        });
    }
};