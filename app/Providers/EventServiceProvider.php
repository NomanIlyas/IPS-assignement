<?php

namespace App\Providers;

use App\Events\AchievementUnlockedEvent;
use App\Events\BadgeUnlockedEvent;
use App\Events\CommentWrittenEvent;
use App\Events\LessonWatchedEvent;
use App\Listeners\AchievementUnlocked;
use App\Listeners\BadgeUnlocked;
use App\Listeners\CommentWritten;
use App\Listeners\LessonWatched;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(
            CommentWrittenEvent::class,
            CommentWritten::class,
        );

        Event::listen(
            LessonWatchedEvent::class,
            LessonWatched::class,
        );

        Event::listen(
            AchievementUnlockedEvent::class,
            AchievementUnlocked::class,
        );

        Event::listen(
            BadgeUnlockedEvent::class,
            BadgeUnlocked::class,
        );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
