<?php

namespace Database\Factories;

use App\Models\Opportunity;
use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityFactory extends Factory
{
    protected $model = Opportunity::class;

    public function definition(): array
    {
        // Liste des étapes standards du cycle de vente
        $stages = [
            'Qualification' => 10,
            'Analyse des besoins' => 30,
            'Proposition' => 50,
            'Négociation' => 80,
            'Gagné' => 100,
            'Perdu' => 0
        ];

        $stageName = $this->faker->randomElement(array_keys($stages));

        return [
            'title' => $this->faker->sentence(3),
            // On lie à un client et un commercial existants (ou créés à la volée)
            'client_id' => Client::factory(),
            'user_id' => User::factory(),
            // On définit un chef d'équipe (peut être surchargé dans le Seeder)
            'team_leader_id' => User::factory(),
            'stage' => $stageName,
            'probability' => $stages[$stageName],
            // Création de "schedules" de clôture : entre -1 mois et +3 mois
            'expected_closing_date' => $this->faker->dateTimeBetween('-1 month', '+3 months'),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }
}
