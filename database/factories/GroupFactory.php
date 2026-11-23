<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'visibility' => $this->faker->randomElement(['public', 'private']),
            'invitation_code' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
            'competition_id' => Competition::factory(),
            'created_by' => User::factory(),
        ];
    }
}
