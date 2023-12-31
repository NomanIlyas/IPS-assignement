<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Lesson::factory(10)->create();
    }
}
