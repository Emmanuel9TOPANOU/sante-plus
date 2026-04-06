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
        // 'pending' = pré-inscrit (en attente), 'active' = validé par la secrétaire
        $table->string('status')->default('pending')->after('role');
        
        // Traces pour l'audit
        $table->timestamp('validated_at')->nullable();
        $table->foreignId('validated_by')->nullable()->constrained('users');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['status', 'validated_at', 'validated_by']);
    });
}
};
