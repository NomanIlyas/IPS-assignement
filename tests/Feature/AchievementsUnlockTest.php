<?php

namespace Tests\Feature;

use App\Events\CommentWrittenEvent;
use App\Events\LessonWatchedEvent;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class AchievementsUnlockTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    #[NoReturn] public function test_single_achievement_unlock()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();

        Event::dispatch(new LessonWatchedEvent($lesson, $user));

        // to associated achievement unlock or not
        $this->assertSame(1, $user->achievements()->count());
    }

    /**
     * @test
     */
    #[NoReturn] public function test_multiple_achievement_unlock()
    {
        $user = User::factory()->create();
        $comments = Comment::factory(3)->create();
        $lessons = Lesson::factory(5)->create();

        foreach ($lessons as $lesson) {
            Event::dispatch(new LessonWatchedEvent($lesson, $user));
        }

        foreach ($comments as $comment) {
            Event::dispatch(new CommentWrittenEvent($comment, $user));
        }

        // to check user comments the lesson the exact
        $this->assertSame(3, $user->comments()->count());

        // to check user watch the lesson the exact
        $this->assertSame(5, $user->lessons()->count());

        // to associated achievement unlock or not
        $this->assertSame(4, $user->achievements()->count());
    }
}
