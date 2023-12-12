<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Achievement;
use App\Models\Badges;
use App\Services\AchievementService;
use App\Services\BadgeService;

class AchievementsController extends Controller
{
    private AchievementService $achievementService;
    private BadgeService $badgeService;

    public function __construct(
        AchievementService $achievementService,
        BadgeService $badgeService
    ) {
        $this->achievementService = $achievementService;
        $this->badgeService = $badgeService;
    }

    public function index(User $user)
    {

        $unlocked_achievements = [];
        $next_available_achievements = [];

        // Use constants for achievement types
        $lesson_watch_type = config('achievements.constants.LESSON_WATCHED');
        $comment_written_type = config('achievements.constants.COMMENT_WRITTEN');

        // The next available achievements are First lesson watched and First Comments Written by default.
        $next_value_1 = Achievement::where('type', '=', $lesson_watch_type)->first()->value;
        $next_value_2 = Achievement::where('type', '=', $comment_written_type)->first()->value;
//        dd($next_value_2);
        $current_badge_value = 0;

        $achievements = $user->unlocked_achievements()->get(); //getting all user unlocked achievements

//        dd($achievements);

        /* Looping through user achievements to get names and update the
        next achievement for each type of achievement
         */

        foreach ($achievements as $achievement) {
            array_push($unlocked_achievements, $achievement->name);

            //getting the next achievement according to type.
            if($achievement->type == $lesson_watch_type) {
                $next_value_1 = Achievement::where('value', '>', $achievement->value)->min('value');
                $lesson_watch_type = $achievement->type;
            }
            elseif($achievement->type == $comment_written_type) {
                $next_value_2 = Achievement::where('value', '>', $achievement->value)->min('value');
                $comment_written_type = $achievement->type;
            }
        }

        //using the values and type to fetch the next achievements.
        // It is certain that next available achievement will be two as there are two types of achievement.
        // If more a for loop would be a better solution to avoid repititon of codes.

//        dd($next_value_1);

        // Use service methods instead of direct model access
//        $next_achievement_for_comments = $this->achievementService->getAchievementByValueAndType($next_value_1, $lesson_watch_type);
//        $next_achievement_for_lessons = $this->achievementService->getAchievementByValueAndType($next_value_2, $comment_written_type);
//
//        // Use service methods instead of direct model access
//        $current_badge = $badges->last() ? $badges->last()->name : $this->badgeService->getBadgesByValue($current_badge_value)->name;

        $next_achievement_for_comments = Achievement::getAchievementByValueAndType($next_value_1, $lesson_watch_type);
        $next_achievement_for_lessons = Achievement::getAchievementByValueAndType($next_value_2, $comment_written_type);
        if($next_achievement_for_comments && $next_achievement_for_lessons)
            array_push($next_available_achievements, $next_achievement_for_comments, $next_achievement_for_lessons);


        //geting all user badges
        $badges = $user->unlocked_badges()->get();

        //current badge is the last badge gotten by the user, since 0 achievement is Beginner then
        //the current badge is Beginner.
        $current_badge = $badges->last() ? $badges->last()->name : Badges::getBadgesByValue($current_badge_value)->name;

        //getting next badge value, then getting the badge name
        $badge_value = $badges->last() ? $badges->last()->value : $current_badge_value;
        $next_badge_value = Badges::where('value', '>', $badge_value)->min('value');

        //  getting next badge by the next badge value
        $next_badge = Badges::getBadgesByValue($next_badge_value)->name;

        // Since badges are gotten by number of achievements, then subtracting the current number achievement from the
        //next_badge_value is a simple way of getting remaining_to_unock_next_badge.
        $remaining_to_unlock_next_badge =  $next_badge_value - count($achievements);

        return response()->json([
            'unlocked_achievements' => $unlocked_achievements,
            'next_available_achievements' => $next_available_achievements,
            'current_badge' => $current_badge,
            'next_badge' => $next_badge,
            'remaining_to_unlock_next_badge' => $remaining_to_unlock_next_badge
        ]);
    }
}
