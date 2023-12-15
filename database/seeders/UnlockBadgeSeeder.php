<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Badge;

class UnlockBadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate random user and badge IDs
        $users = User::all();
        $badges = Badge::all();

        for ($i = 0; $i < 10; $i++) { // Generate 10 sample entries
            $user = $users->random();
            $badge = $badges->random();

            // Check if the relation already exists
            if (!$user->badges->contains($badge)) {
                $user->badges()->attach($badge);
            }
        }
    }
}
