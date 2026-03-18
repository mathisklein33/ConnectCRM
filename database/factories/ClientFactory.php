<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = \App\Models\Client::class;

    public function definition(): array
    {

        return [
            'nom' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(), // si tu as ce champ
            'adresse' => $this->faker->address(),       // si tu as ce champ
        ];
    }
}
