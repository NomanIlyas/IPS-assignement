<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AchievementService;
use App\Services\BadgeService;
use Illuminate\Http\JsonResponse;

class AchievementsController extends Controller
{
    protected AchievementService $achievementService;
    protected BadgeService $badgeService;

    public function __construct(AchievementService $achievementService, BadgeService $badgeService)
    {
        $this->achievementService = $achievementService;
        $this->badgeService = $badgeService;
    }

    public function index(User $user): JsonResponse
    {
        $achievementData = $this->achievementService->getAchievementsAndBadgeData($user);

        $data = $this->badgeService->getAchievementAndBadgeData(
            $user,
            count($achievementData['unlocked_achievements'])
        );

        return response()->json([
            'unlocked_achievements' => $achievementData['unlocked_achievements'],
            'next_available_achievements' => $achievementData['next_available_achievements'],
            'current_badge' => $data['currentBadge'],
            'next_badge' => $data['nextBadge'],
            'remaining_to_unlock_next_badge' => $data['remainingToUnlockNextBadge']
        ]);
    }
}
