<?php

namespace App\Services;

use App\Models\User;
use App\Models\Achievement;

class AchievementService
{
    /**
     * @param User $user
     * @return array
     */
    public function getAchievementsAndBadgeData(User $user): array
    {
        $unlockedAchievements = $user->achievements()->get();

        $currentValueForLessonWatched = $user->achievements()
            ->where('type', config('achievements.constants.LESSON_WATCHED'))
            ->orderByDesc('value')
            ->first();

        $nextValueForLessonWatched = $this->getNextAchievementValue(
            config('achievements.constants.LESSON_WATCHED'),
            $currentValueForLessonWatched
        );

        $currentValueForCommentWritten = $user->achievements()
            ->where('type', config('achievements.constants.COMMENT_WRITTEN'))
            ->orderByDesc('value')
            ->first();

        $nextValueForCommentWritten = $this->getNextAchievementValue(
            config('achievements.constants.COMMENT_WRITTEN'),
            $currentValueForCommentWritten
        );

        $nextAvailableAchievements = $this->getNextAvailableAchievements(
            $nextValueForLessonWatched,
            $nextValueForCommentWritten,
            config('achievements.constants.LESSON_WATCHED'),
            config('achievements.constants.COMMENT_WRITTEN')
        );

        return [
            'unlocked_achievements' => $unlockedAchievements->pluck('name'),
            'next_available_achievements' => $nextAvailableAchievements,
        ];
    }

    /**
     * @param $type
     * @param $currentValue
     * @return mixed
     */
    public function getNextAchievementValue($type, $currentValue): mixed
    {
        return Achievement::where('type', $type)
            ->where('value', '>', $currentValue ? $currentValue->value : 0)
            ->min('value');
    }

    /**
     * @param $value
     * @param $type
     * @return mixed
     */
    public function getAchievementByValueAndType($value, $type): mixed
    {
        return Achievement::where(['value' => $value, 'type' => $type])->first();
    }

    /**
     * @param $nextValueForLessonWatched
     * @param $nextValueForCommentWritten
     * @param $lessonWatchType
     * @param $commentWrittenType
     * @return array
     */
    public function getNextAvailableAchievements(
        $nextValueForLessonWatched,
        $nextValueForCommentWritten,
        $lessonWatchType,
        $commentWrittenType
    ): array {

        $nextAchievementForComments = $this->getAchievementByValueAndType(
            $nextValueForLessonWatched,
            $lessonWatchType
        );

        $nextAchievementForLessons = $this->getAchievementByValueAndType(
            $nextValueForCommentWritten,
            $commentWrittenType
        );

        $nextAvailableAchievements = [];

        if ($nextAchievementForComments) {
            $nextAvailableAchievements[] = $nextAchievementForComments->name;
        }

        if ($nextAchievementForLessons) {
            $nextAvailableAchievements[] = $nextAchievementForLessons->name;
        }

        return $nextAvailableAchievements;
    }


}
