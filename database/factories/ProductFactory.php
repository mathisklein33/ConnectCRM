<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name'      => $this->faker->unique()->words(2, true), // ex: "Licence Cloud"
            'sku'       => $this->faker->unique()->bothify('PROD-####-??'), // ex: "PROD-1234-XY"
            'price'     => $this->faker->randomFloat(2, 50, 5000), // Prix entre 50€ et 5000€
            'is_active' => $this->faker->boolean(90), // 90% de produits actifs
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
