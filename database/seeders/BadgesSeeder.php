<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\Badges;

class BadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $badgeConstants = Config::get('badges.constants');

        // Ignore the `BADGES_WON` array
        unset($badgeConstants['BADGES_WON']);

        foreach ($badgeConstants as $name => $value) {
            Badges::create([
                'name' => $name,
                'value' => $value,
            ]);
        }
    }
}
