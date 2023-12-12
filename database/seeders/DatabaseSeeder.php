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

        /*
         * These seeder for self testing purpose and these entities are interlink with each other
         *  like if you add more achievements and according to achievements number badges also update
         */
//        $this->call(UserToBadgeSeeder::class);
//        $this->call(UserToAchievementsSeeder::class);
//        $this->call(LessonUserSeeder::class);
    }
}
