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
        Schema::table('demande_clients', function (Blueprint $table) {
            // On ajoute user_id, il peut être NULL (si pas encore assigné)
            // On le place après client_id pour garder une table propre
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->after('client_id');
        });
    }

    public function down(): void
    {
        Schema::table('demande_clients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
