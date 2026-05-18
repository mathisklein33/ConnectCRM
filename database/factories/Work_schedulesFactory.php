<?php

namespace Database\Factories;

use App\Models\Work_schedules;
use App\Models\Team; // Assuming you have a Team model
use App\Models\User; // Assuming you have a User model
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Work_schedules>
 */
class Work_schedulesFactory extends Factory
{
    /**x
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Creates a new user/team or picks an existing ID
            'user_id'     => User::factory(),
            'team_id'     => Team::factory(),

            'title'       => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'date'        => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),

            // Generates a logical time range
            'start_time'  => '09:00:00',
            'end_time'    => '17:00:00',
        ];
    }
}
