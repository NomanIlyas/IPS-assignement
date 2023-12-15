<?php

namespace App\Listeners;

use App\Events\AchievementUnlockedEvent;
use App\Events\BadgeUnlockedEvent;
use App\Events\CommentWrittenEvent;
use App\Models\Achievement;
use App\Models\Badge;
use Illuminate\Support\Facades\Event;

class CommentWritten
{
    /**
     * Handle the event.
     */
    public function handle(CommentWrittenEvent $event): void
    {
        $user = $event->user;

        $user->comments()->save($event->comment);
        $comment_count = $user->comments()->count();

        // Check if comment count matches any achievement value
        if (in_array($comment_count, config('achievements.constants.COMMENT_WRITTEN_SERIES')))
        {
            $achievement_name = Achievement::where([
                'value' => $comment_count,
                'type' => 'Comments Written'
                ])->first()->name;

            // dispatch the event
                Event::dispatch(
                    new AchievementUnlockedEvent($achievement_name, $user)
                );
        }

        $achievement_count = $user->achievements()->count();
        // Check if number of achievements matches any badge value
        if(in_array($achievement_count, config('badges.constants.BADGES_WON'))) {
            $badge_name = Badge::where('value', '=', $achievement_count)->first('name');
            // dispatch the event
            Event::dispatch(
                new BadgeUnlockedEvent($badge_name, $user)
            );
        }
    }
}
