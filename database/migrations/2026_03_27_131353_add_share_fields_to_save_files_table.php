<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('save_files', function (Blueprint $table) {
            $table->string('share_token')->nullable()->unique()->after('size');
            $table->boolean('is_public')->default(false)->after('share_token');
        });
    }

    public function down(): void
    {
        Schema::table('save_files', function (Blueprint $table) {
            $table->dropColumn(['share_token', 'is_public']);
        });
    }
};
