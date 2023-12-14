<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badges;
use Illuminate\Database\Eloquent\Collection;

class BadgeService
{
    /**
     * @param User $user
     * @param int $unlockedAchievementCount
     * @return array
     */
    public function getAchievementAndBadgeData(User $user, int $unlockedAchievementCount = 0): array
    {
        $badges = $this->getUnlockedBadges($user);
        $currentBadge = $this->getCurrentBadge($badges);
        $badgeValue = $this->getNextBadgeValue($badges);
        $lastBadgeValue = $this->getLastBadgeValue();

        // Here is termination conditions for Badges
        if ($lastBadgeValue == $badgeValue) {
            $nextBadgeValue = $lastBadgeValue;
            $nextBadge = '';
        } else {
            $nextBadgeValue = Badges::where('value', '>', $badgeValue)->min('value');
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
     * @param User $user
     * @return Collection
     */
    public function getUnlockedBadges(User $user): Collection
    {
        return $user->unlocked_badges()->get();
    }

    /**
     * @param $badges
     * @return mixed
     */
    public function getCurrentBadge($badges)
    {
        return $badges->last() ? $badges->last()->name :
            Badges::getBadgesByValue(config('badges.constants.BEGINNER'))->name;
    }

    /**
     * @param $badges
     * @return mixed
     */
    public function getNextBadgeValue($badges): mixed
    {
        return $badges->last() ? $badges->last()->value :
            Badges::getBadgesByValue(config('badges.constants.BEGINNER'))->name;
    }

    /**
     * @param $nextBadgeValue
     * @return string|null
     */
    public function getNextBadge($nextBadgeValue): ?string
    {
        return Badges::getBadgesByValue($nextBadgeValue)->name;
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
        return Badges::max('value');
    }
}
