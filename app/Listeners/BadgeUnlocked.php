<?php

namespace App\Listeners;

use App\Events\BadgeUnlockedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\UserToBadges;
use App\Models\Badges;
use Illuminate\Support\Facades\Log;

class BadgeUnlocked
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
    public function handle(BadgeUnlockedEvent $event): void
    {
        $user_id = $event->user->id;
        $badge_id = Badges::where('name', '=', $event->badge_name)->first()->id;

        if ($badge_id) {
            UserToBadges::create([
                'user_id' => $user_id,
                'badges_id' => $badge_id,
                'unlocked' => true,
            ]);
        } else {
            // Handle error scenario (missing badge)
            Log::error("Badge with name {$event->badge_name} not found.");
        }
    }
}
