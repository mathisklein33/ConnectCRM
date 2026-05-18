<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('interactions', function (Blueprint $table) {
            // Ajout du statut avec une valeur par défaut pour les futurs schedules
            // On utilise 'planifie' par défaut
            if (!Schema::hasColumn('interactions', 'statut')) {
                $table->string('statut')->default('planifie')->after('type');
            }

        });
    }

    public function down(): void
    {

    }
};
