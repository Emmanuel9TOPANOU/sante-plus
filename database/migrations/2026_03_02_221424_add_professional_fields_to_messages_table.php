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
    Schema::table('messages', function (Blueprint $table) {
        $table->foreignId('consultation_id')->nullable()->after('receiver_id')->constrained()->onDelete('set null');
        $table->string('file_path')->nullable()->after('content');
        $table->enum('priority', ['normal', 'urgent'])->default('normal')->after('file_path');
    });
}

public function down(): void
{
    Schema::table('messages', function (Blueprint $table) {
        $table->dropForeign(['consultation_id']);
        $table->dropColumn(['consultation_id', 'file_path', 'priority']);
    });
}
};
