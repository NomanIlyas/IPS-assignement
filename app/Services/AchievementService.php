<?php

namespace App\Services;

use App\Models\User;
use App\Models\Achievement;
use Illuminate\Database\Eloquent\Collection;

class AchievementService
{
    public function getAchievementsAndBadgeData(User $user): array
    {
        $unlockedAchievements = $this->getUnlockedAchievements($user);

        $currentValueForLessonWatched = $user->achievements()
            ->where('type', config('achievements.constants.LESSON_WATCHED'))
            ->latest('id')
            ->first();

        $nextValueForLessonWatched = $this->getNextAchievementValue(
            config('achievements.constants.LESSON_WATCHED'),
            $currentValueForLessonWatched);

        $currentValueForCommentWritten = $user->achievements()
            ->where('type', config('achievements.constants.COMMENT_WRITTEN'))
            ->latest('id')
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

    public function getUnlockedAchievements(User $user): Collection
    {
        return $user->unlocked_achievements()->get();
    }

    public function getNextAchievementValue($type, $currentValue)
    {
        return Achievement::where('type', $type)
            ->where('value', '>', $currentValue ? $currentValue->value : 0)
            ->min('value');
    }

    public function getAchievementByValueAndType($value, $type)
    {
        return Achievement::where(['value' => $value, 'type' => $type])->first();
    }

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
