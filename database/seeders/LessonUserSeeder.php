<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Lesson;

class LessonUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate random user and lesson IDs
        $users = User::all();
        $lessons = Lesson::all();

        foreach ($users as $user) {
            // Assign a random number of lessons to each user (adjust as needed)
            $assignedLessons = $lessons->random(random_int(1, 3));

            foreach ($assignedLessons as $lesson) {
                $user->lessons()->attach($lesson, ['watched' => false]); // Set watched to false by default
            }
        }
    }
}
