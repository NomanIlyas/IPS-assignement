<?php

namespace App\Listeners;

use App\Events\AchievementUnlockedEvent;
use App\Events\BadgeUnlockedEvent;
use App\Models\Achievement;
use App\Models\Badge;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class AchievementUnlocked
{
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

        $achievement_count = $event->user->achievements()->count();

        if(in_array($achievement_count, config('badges.constants.BADGES_WON'))) {
            $badge_name = Badge::where('value', '=', $achievement_count)->first()->name;
            // dispatch the event
            Event::dispatch(
                new BadgeUnlockedEvent($badge_name, $event->user)
            );
        }
    }
}
