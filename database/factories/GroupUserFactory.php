<?php

namespace Database\Factories;

use App\Models\GroupUser;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GroupUser>
 */
class GroupUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_id' => Group::factory(),
            'user_id' => User::factory(),
            'role' => $this->faker->randomElement(['member', 'admin']),
            'points' => $this->faker->numberBetween(0, 100),
            'joined_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
