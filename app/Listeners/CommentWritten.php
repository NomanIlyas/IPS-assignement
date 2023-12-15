<?php

namespace App\Listeners;

use App\Events\AchievementUnlockedEvent;
use App\Events\BadgeUnlockedEvent;
use App\Events\CommentWrittenEvent;
use App\Models\Achievement;
use App\Models\Badge;

class CommentWritten
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
    public function handle(CommentWrittenEvent $event): void
    {
        $user = $event->comment->user;

        // Check if comment count matches any achievement value
        foreach (config('achievement.constants') as $constant => $value) {
            if ($value === $event->comment->count() && str_contains($constant, 'COMMENT')) {
                $achievement_name = Achievement::where([
                    'value' => $value,
                    'type' => 'Comments Written'
                ])->first('name');
                // dispatch the event
                AchievementUnlockedEvent::dispatch(
                    new AchievementUnlockedEvent($achievement_name, $user)
                );
                break;
            }
        }

        $user_achievements = $user->badges()->where('user_id', '=', $user->id)->get();

        // Check if number of achievements matches any badge value
        foreach (config('badges.constants') as $constant => $value) {
            if ($value === $user_achievements->count()) {
                $badge_name = Badge::where('value', '=', $value)->first('name');
                // dispatch the event
                BadgeUnlockedEvent::dispatch(
                    new BadgeUnlockedEvent($badge_name, $user)
                );
                break;
            }
        }
    }
}
