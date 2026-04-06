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
    Schema::table('prescriptions', function (Blueprint $table) {
        $table->integer('age')->nullable()->after('patient_id');
        $table->decimal('poids', 5, 2)->nullable()->after('age');
    });
}

public function down(): void
{
    Schema::table('prescriptions', function (Blueprint $table) {
        $table->dropColumn(['age', 'poids']);
    });
}
};
