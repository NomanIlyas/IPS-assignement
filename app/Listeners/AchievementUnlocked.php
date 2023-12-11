<?php

namespace App\Listeners;

use App\Events\AchievementUnlockedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\Achievement;
use App\Models\UserToAchievements;
use Illuminate\Support\Facades\Log;

class AchievementUnlocked
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AchievementUnlockedEvent $event): void
    {
        $user_id = $event->user->id;
        $achievement_id = Achievement::where('name', '=', $event->achievement_name)->first()->id;

        if ($achievement_id) {
            UserToAchievements::create([
                'user_id' => $user_id,
                'achievement_id' => $achievement_id,
                'unlocked' => true,
            ]);
        } else {
            // Handle error scenario (missing achievement)
            Log::error("Achievement with name {$event->achievement_name} not found.");
        }
    }
}
