<?php

namespace App\Listeners;

use App\Events\AchievementUnlockedEvent;
use App\Models\Achievement;
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
        $achievement = Achievement::where('name', '=', $event->achievement_name)->first();

        if ($achievement instanceof Achievement) {
            $event->user->achievements()->attach($achievement);
        } else {
            Log::error("Achievement with name {$event->achievement_name} not found.");
        }
    }
}
