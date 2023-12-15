<?php

namespace Tests\Feature;

use App\Events\LessonWatchedEvent;
use App\Models\Lesson;
use App\Models\User;
use Database\Seeders\AchievementsSeeder;
use Database\Seeders\BadgesSeeder;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class LessonWatchedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    #[NoReturn] public function test_single_lesson_watched()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();

        Event::dispatch(new LessonWatchedEvent($lesson, $user));

        // to check user watch the lesson or not
        $this->assertSame(1, $user->lessons()->count());

        // to associated achievement unlock or not
        $this->assertSame(1, $user->achievements()->count());
    }

    /**
     * @test
     */
    #[NoReturn] public function test_multiple_lesson_watched()
    {
        $user = User::factory()->create();
        $lessons = Lesson::factory(5)->create();

        foreach ($lessons as $lesson) {
            Event::dispatch(new LessonWatchedEvent($lesson, $user));
        }

        // to check user watch the lesson or not
        $this->assertSame(5, $user->lessons()->count());

        // to associated achievement unlock or not
        $this->assertSame(2, $user->achievements()->count());
    }
}
