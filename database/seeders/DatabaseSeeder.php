<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Commitment is everything :)
        // Order of execution

        $this->call(UserSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(AchievementsSeeder::class);
        $this->call(BadgesSeeder::class);

        // Seed user-badge relationships after both are seeded
        $this->call(UserToBadgeSeeder::class);

        // Seed user-achievement relationships after both are seeded
        $this->call(UserToAchievementsSeeder::class);

        // Seed lesson-user relationships after both are seeded
        $this->call(LessonUserSeeder::class);
    }
}
