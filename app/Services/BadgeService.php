<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badges;
use Illuminate\Database\Eloquent\Collection;

class BadgeService
{
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

    public function getUnlockedBadges(User $user): Collection
    {
        return $user->unlocked_badges()->get();
    }

    public function getCurrentBadge($badges)
    {
        return $badges->last() ? $badges->last()->name :
            Badges::getBadgesByValue(config('badges.constants.BEGINNER'))->name;
    }

    public function getNextBadgeValue($badges)
    {
        return $badges->last() ? $badges->last()->value :
            Badges::getBadgesByValue(config('badges.constants.BEGINNER'))->name;
    }

    public function getNextBadge($nextBadgeValue)
    {
        return Badges::getBadgesByValue($nextBadgeValue)->name;
    }

    public function getRemainingToUnlockNextBadge($nextBadgeValue, $achievementsCount)
    {
        return $nextBadgeValue - $achievementsCount;
    }

    private function getLastBadgeValue()
    {
        return Badges::max('value');
    }
}
