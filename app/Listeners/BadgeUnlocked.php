<?php

namespace App\Listeners;

use App\Events\BadgeUnlockedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Badge;
use Illuminate\Support\Facades\Log;

class BadgeUnlocked
{
    /**
     * Handle the event.
     */
    public function handle(BadgeUnlockedEvent $event): void
    {
        $badge = Badge::where('name', '=', $event->badge_name)->first();

        if ($badge instanceof Badge) {
            $event->user->badges()->attach($badge);
        } else {
            Log::error("Badge with name {$event->badge_name} not found.");
        }
    }
}
