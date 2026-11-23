<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teams = fake()->randomElements(
            ['FC Bâle', 'Young Boys', 'Servette', 'Lugano', 'FC Zurich', 'Lausanne-Sport', 'St-Gall', 'Sion'],
            2
        );

        return [
                'api_id' => $this->faker->unique()->numberBetween(1, 1000),
                'competition_id' => Competition::factory(),
                'home_team' => $teams[0],
                'away_team' => $teams[1],
                'home_team_logo' => null,
                'away_team_logo' => null,
                'status' => 'scheduled',
                'kickoff_at' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
                'home_score' => null,
                'away_score' => null,

        ];
    }

    public function finished(): static {
        return $this->state(fn() => [
            'status' => 'finished',
            'kickoff_at' => $this->faker->dateTimeBetween('-1 month', '-1 week'),
            'home_score' => $this->faker->numberBetween(0, 5),
            'away_score' => $this->faker->numberBetween(0, 5),
        ]);
    }
}
