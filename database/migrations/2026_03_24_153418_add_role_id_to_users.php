<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. On ajoute la colonne role_id en permettant le NULL au début
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->foreignId('role_id')->nullable()->constrained()->onDelete('cascade');
            }
        });

        // 2. On s'assure qu'un rôle par défaut existe pour ne pas casser la contrainte
        // On vérifie si un rôle existe, sinon on en crée un (ID 1)
        if (DB::table('roles')->count() === 0) {
            DB::table('roles')->insert([
                'name' => 'Admin',
                'slug' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. On assigne le rôle ID 1 à tous les utilisateurs actuels
        DB::table('users')->whereNull('role_id')->update(['role_id' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
