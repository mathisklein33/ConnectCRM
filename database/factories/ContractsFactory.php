<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends Factory<Model>
 */
class ContractsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => \App\Models\Client::factory(),
            'number' => $this->faker->unique()->numerify('CTR-#####'),
            'title' => $this->faker->sentence(3),
            'total' => $this->faker->randomFloat(2, 100, 10000),
            'content' => $this->faker->paragraphs(3, true),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
    }
}
