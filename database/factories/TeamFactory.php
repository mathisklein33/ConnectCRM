<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'    => $this->faker->company(),
            'user_id' => \App\Models\User::factory(), // Creates an owner for the team
            'role'    => $this->faker->randomElement(['admin', 'editor', 'viewer']),
        ];
    }
}
