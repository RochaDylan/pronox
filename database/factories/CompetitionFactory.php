<?php

namespace Database\Factories;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Competition>
 */
class CompetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'api_id' => $this->faker->unique()->numberBetween(1, 1000),
            'name' => $this->faker->company(),
            'country' => $this->faker->country(),
        ];
    }
}
