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
        Schema::table('internal_collaborations', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('internal_collaborations', function (Blueprint $table) {
            DB::statement('UPDATE internal_collaborations SET team_id = 1 WHERE team_id IS NULL');
            $table->unsignedBigInteger('team_id')->nullable(false)->change();
        });
    }
};
