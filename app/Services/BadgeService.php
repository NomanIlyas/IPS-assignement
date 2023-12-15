<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;

class BadgeService
{
    /**
     * @param User $user
     * @param int $unlockedAchievementCount
     * @return array
     */
    public function getAchievementAndBadgeData(
        User $user,
        int $unlockedAchievementCount = 0
    ): array {
        $badges = $user->badges()->get();
        $currentBadge = $this->getCurrentBadge($badges);
        $badgeValue = $this->getNextBadgeValue($badges);
        $lastBadgeValue = $this->getLastBadgeValue();

        // Here is termination conditions for Badge
        if ($lastBadgeValue == $badgeValue) {
            $nextBadgeValue = $lastBadgeValue;
            $nextBadge = '';
        } else {
            $nextBadgeValue = Badge::where('value', '>', $badgeValue)->min('value');
            $nextBadge = $this->getNextBadge($nextBadgeValue);
        }

        $remainingToUnlockNextBadge = $this->getRemainingToUnlockNextBadge(
            $nextBadgeValue,
            $unlockedAchievementCount
        );

        return [
            'currentBadge' => $currentBadge,
            'nextBadge' => $nextBadge,
            'remainingToUnlockNextBadge' => $remainingToUnlockNextBadge,
        ];
    }

    /**
     * @param $badges
     * @return mixed
     */
    public function getCurrentBadge($badges): mixed
    {
        return $badges->last() ? $badges->last()->name :
            Badge::getBadgesByValue(config('badges.constants.BEGINNER'))->name;
    }

    /**
     * @param $badges
     * @return mixed
     */
    public function getNextBadgeValue($badges): mixed
    {
        return $badges->last() ? $badges->last()->value :
            Badge::getBadgesByValue(config('badges.constants.BEGINNER'))->name;
    }

    /**
     * @param $nextBadgeValue
     * @return string|null
     */
    public function getNextBadge($nextBadgeValue): ?string
    {
        return Badge::getBadgesByValue($nextBadgeValue)->name;
    }

    /**
     * @param int $nextBadgeValue
     * @param int $achievementsCount
     * @return mixed
     */
    public function getRemainingToUnlockNextBadge(int $nextBadgeValue, int $achievementsCount): int
    {
        return $nextBadgeValue - $achievementsCount;
    }

    /**
     * @return mixed
     */
    private function getLastBadgeValue(): int
    {
        return Badge::max('value');
    }
}
