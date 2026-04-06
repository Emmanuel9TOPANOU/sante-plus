<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::table('rendezvous', function (Blueprint $table) {
        // Ajoute la colonne et la clé étrangère
        $table->foreignId('availability_id')->nullable()->constrained('availabilities')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('rendezvous', function (Blueprint $table) {
        $table->dropForeign(['availability_id']);
        $table->dropColumn('availability_id');
    });
}
};
