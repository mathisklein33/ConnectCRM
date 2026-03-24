<?php

namespace Database\Factories;

use App\Models\Opportunity;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityProductFactory extends Factory
{
    public function definition(): array
    {
        // On récupère un produit au hasard pour copier son prix de base initialement
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();

        return [
            'opportunity_id' => Opportunity::factory(),
            'product_id'     => $product->id,
            'quantity'       => $this->faker->numberBetween(1, 10),
            // On simule une petite remise ou augmentation par rapport au prix de base
            'unit_price'     => $product->price * $this->faker->randomFloat(2, 0.8, 1.1),
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }
}
