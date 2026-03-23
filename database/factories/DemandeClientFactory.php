<?php

namespace Database\Factories;

use App\Models\DemandeClient;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DemandeClient>
 */
class DemandeClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'email' => $this->faker->unique()->safeEmail(),
            'sujet' => $this->faker->sentence(3),
            'message' => $this->faker->paragraph(),
            'statut' => $this->faker->randomElement(['en attente', 'traitée', 'refusée']),
        ];
    }
}
