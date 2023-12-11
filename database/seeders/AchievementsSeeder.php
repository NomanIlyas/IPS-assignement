<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementsSeeder extends Seeder
{
    public function run(): void
    {
        Achievement::factory(10)->create();
    }
}
