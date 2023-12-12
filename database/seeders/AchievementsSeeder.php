<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;
use Illuminate\Support\Facades\Config;

class AchievementsSeeder extends Seeder
{
    public function run(): void
    {
        // Get all achievements from config
        $achievements = Config::get('achievements.achievements');


        // Create and save achievement models
        foreach ($achievements as $achievementConfig) {
            Achievement::create([
                'name' => $achievementConfig['name'],
                'type' => $achievementConfig['type'],
                'value' => $achievementConfig['value'],
            ]);
        }
    }
}
