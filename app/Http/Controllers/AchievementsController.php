<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AchievementService;
use App\Services\BadgeService;
use Illuminate\Http\JsonResponse;

class AchievementsController extends Controller
{
    /**
     * @param AchievementService $achievementService
     * @param BadgeService $badgeService
     */
    public function __construct(
        public AchievementService $achievementService,
        public BadgeService $badgeService
    ) {}

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function index(User $user): JsonResponse
    {
        $data = $this->achievementService->getAchievementsAndBadgeData($user);

        $data = array_merge(
            $data,
            $this->badgeService->getAchievementAndBadgeData(
                $user,
                count($data['unlocked_achievements'])
            )
        );

        return response()->json([
            'unlocked_achievements' => $data['unlocked_achievements'],
            'next_available_achievements' => $data['next_available_achievements'],
            'current_badge' => $data['currentBadge'],
            'next_badge' => $data['nextBadge'],
            'remaining_to_unlock_next_badge' => $data['remainingToUnlockNextBadge']
        ]);
    }
}
