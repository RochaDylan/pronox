<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Competition;
use App\Models\Game;
use App\Models\Group;
use App\Models\GroupUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@pronox.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Dylan',
            'email' => 'dylan@pronox.com',
            'password' => bcrypt('dylan'),
            'role' => 'user',
            'points' => 100,
        ]);

        User::factory(5)->create();

        $superLeague = Competition::factory()->create([
            'name' => 'Super League',
            'api_id' => 1,
            'country' => 'Switzerland',
        ]);

        $championsLeague = Competition::factory()->create([
            'name' => 'Champions League',
            'api_id' => 2,
            'country' => 'Europe',
        ]);

        Game::factory(8)->finished()->for($superLeague)->create();
        Game::factory(2)->withoutScore()->for($superLeague)->create();  
        Game::factory(1)->postponed()->for($superLeague)->create();      
        Game::factory(1)->live()->for($superLeague)->create();
        Game::factory(2)->today()->for($superLeague)->create();
        Game::factory(6)->for($superLeague)->create();  

        Game::factory(5)->finished()->for($championsLeague)->create();
        Game::factory(1)->postponed()->for($championsLeague)->create();  
        Game::factory(1)->today()->for($championsLeague)->create();
        Game::factory(6)->for($championsLeague)->create();

        Group::factory(5)->create()->each(function ($group) {
            $users = User::inRandomOrder()->take(rand(2, 5))->get();
            foreach ($users as $user) {
                GroupUser::create([
                    'group_id' => $group->id,
                    'user_id' => $user->id,
                    'role' => 'member',
                    'points' => rand(0, 100),
                    'joined_at' => now(),
                ]);
            }
        });

    }
}
