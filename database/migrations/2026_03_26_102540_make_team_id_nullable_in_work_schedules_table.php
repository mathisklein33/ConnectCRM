<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_schedules', function (Blueprint $table) {
            // On rend la colonne nullable pour permettre les événements globaux
            $table->foreignId('team_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('work_schedules', function (Blueprint $table) {
            // On revient en arrière si besoin (attention, nécessite que la table soit vide ou sans NULL)
            $table->foreignId('team_id')->nullable(false)->change();
        });
    }
};
