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

        // Execute essential seeders first
        $this->call(AchievementsSeeder::class);
        $this->call(BadgesSeeder::class);

        // Optional seeder
        $this->call(UserSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(CommentSeeder::class);

        /*
         * These seeder for self testing purpose and these entities are interlink with each other
         *  like if you add more achievements and according to achievements number badges also update
         */
//        $this->call(UnlockBadgeSeeder::class);
//        $this->call(UnlockAchievementsSeeder::class);
//        $this->call(LessonUserSeeder::class);
    }
}
