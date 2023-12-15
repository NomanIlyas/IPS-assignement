<?php

namespace App\Listeners;

use App\Events\AchievementUnlockedEvent;
use App\Events\BadgeUnlockedEvent;
use App\Events\LessonWatchedEvent;
use App\Models\Achievement;
use App\Models\Badge;

class LessonWatched
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
    public function handle(LessonWatchedEvent $event): void
    {
        $count = $event->user->watched()->count();
        $user = $event->user;

        // Check for achievement unlocks based on watched lessons
        if (in_array($count, config('achievement.constants.LESSON_WATCHED'))) {
            $achievementName = Achievement::where('value', $count)
                ->where('type', config('achievement.constants.LESSON_WATCHED'))
                ->first('name');

            if ($achievementName) {
                AchievementUnlockedEvent::dispatch(
                    new AchievementUnlockedEvent($achievementName, $user)
                );
            }
        }

        $user_achievements = $user->badges()->where('user_id', '=', $user->id)->get();
        $achievements_count = $user_achievements->count();

        if(in_array($achievements_count, config('badges.constants.BADGES_WON'))) {

            $badge_name = Badge::where('value', '=', $achievements_count)->first('name');

            // dispatch the event
            BadgeUnlockedEvent::dispatch(
                new BadgeUnlockedEvent($badge_name, $user)
            );
        }
    }
}
