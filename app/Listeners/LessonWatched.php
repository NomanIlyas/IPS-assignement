<?php

namespace App\Listeners;

use App\Events\AchievementUnlockedEvent;
use App\Events\BadgeUnlockedEvent;
use App\Events\LessonWatchedEvent;
use App\Models\Achievement;
use App\Models\Badge;
use Illuminate\Support\Facades\Event;

class LessonWatched
{
    /**
     * Handle the event.
     */
    public function handle(LessonWatchedEvent $event): void
    {
        $user = $event->user;
        $user->lessons()->attach($event->lesson);
        $lesson_count = $event->user->lessons()->count();

        // Check for achievement unlocks based on watched lessons
        if (in_array($lesson_count, config('achievements.constants.LESSON_WATCHED_SERIES')))
        {
            $achievement = Achievement::where('value', $lesson_count)
                ->where('type', config('achievements.constants.LESSON_WATCHED'))
                ->first();

            if ($achievement instanceof Achievement) {
                Event::dispatch(
                    new AchievementUnlockedEvent($achievement->name, $user)
                );
            }
        }

        $achievement_count = $event->user->achievements()->count();

        if(in_array($achievement_count, config('badges.constants.BADGES_WON'))) {

            $badge_name = Badge::where('value', '=', $achievement_count)->first()->name;
            // dispatch the event
            Event::dispatch(
                new BadgeUnlockedEvent($badge_name, $user)
            );
        }
    }
}
