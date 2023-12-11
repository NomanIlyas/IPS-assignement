<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Achievement;
use App\Models\UserToAchievements;

class UserToAchievementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate random user and achievement IDs
        $users = User::all();
        $achievements = Achievement::all();

        for ($i = 0; $i < 50; $i++) { // Generate 50 sample entries
            $user = $users->random();
            $achievement = $achievements->random();

            // Check if the relation already exists
            if (!$user->unlocked_achievements->contains($achievement)) {
                UserToAchievements::insert([
                    'user_id' => $user->id,
                    'achievement_id' => $achievement->id,
                    'unlocked' => false, // Change this to true for unlocked achievements
//                    'unlocked_on' => now(),
                ]);
            }
        }
    }
}
