<?php

namespace Database\Factories;

use App\Models\Interaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Interaction>
 */
class InteractionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_id' => 1,
            'type' => fake()->randomElement(['appel', 'email', 'rdv']),
            'date' => now(),
            'sujet' => fake()->sentence(),
            'contenu' => fake()->paragraph(),
            'statut' => 'terminé',
        ];
    }
}
