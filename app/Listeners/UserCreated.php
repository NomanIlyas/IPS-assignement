<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Models\Badge;

class UserCreated
{
    public function handle(UserCreatedEvent $event): void
    {
        // Get the first badge (you might need to adjust the query based on your badge structure)
        $beginner_badge = Badge::where('name', 'BEGINNER')->first();
        if ($beginner_badge instanceof Badge) {
            // Assign the first badge to the user
            $event->user->badges()->attach($beginner_badge);
        }
    }
}
