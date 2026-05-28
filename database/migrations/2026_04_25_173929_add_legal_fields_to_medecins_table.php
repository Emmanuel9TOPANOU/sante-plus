<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->string('rpps')->nullable()->unique()->after('matricule');
            $table->string('adeli')->nullable()->unique()->after('rpps');
            $table->string('cabinet_nom')->nullable()->after('adeli');
            $table->string('cabinet_adresse')->nullable()->after('cabinet_nom');
            $table->string('cabinet_telephone')->nullable()->after('cabinet_adresse');
        });
    }

    public function down()
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->dropColumn(['rpps', 'adeli', 'cabinet_nom', 'cabinet_adresse', 'cabinet_telephone']);
        });
    }
};