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
        // 1. Table des Produits (Le catalogue)
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

// 2. Table des Opportunités (Le cycle de vente)
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('client_id')->constrained();
            $table->foreignId('user_id')->constrained(); // Le commercial
            $table->string('stage'); // ex: 'Prospection', 'Négociation', 'Gagné'
            $table->integer('probability'); // 0 à 100
            $table->date('expected_closing_date');
            $table->timestamps();
        });

// 3. Table Pivot (Lien Produit <-> Opportunité)
        Schema::create('opportunity_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opportunity_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained();
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2); // Prix au moment de la vente (fixe)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunity_product');
    }
};
