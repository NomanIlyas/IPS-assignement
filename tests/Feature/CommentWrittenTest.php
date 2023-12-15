<?php

namespace Tests\Feature;

use App\Events\CommentWrittenEvent;
use App\Models\Comment;
use App\Models\User;
use Database\Seeders\AchievementsSeeder;
use Database\Seeders\BadgesSeeder;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class CommentWrittenTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    #[NoReturn] public function test_single_comment_written()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        Event::dispatch(new CommentWrittenEvent($comment, $user));

        // to check user watch the lesson or not
        $this->assertSame(1, $user->comments()->count());

        // to associated achievement unlock or not
        $this->assertSame(1, $user->achievements()->count());
    }

    /**
     * @test
     */
    #[NoReturn] public function test_multiple_comment_written()
    {
        $user = User::factory()->create();
        $comments = Comment::factory(3)->create();

        foreach ($comments as $comment) {
            Event::dispatch(new CommentWrittenEvent($comment, $user));
        }

        // to check user watch the lesson or not
        $this->assertSame(3, $user->comments()->count());

        // to associated achievement unlock or not
        $this->assertSame(2, $user->achievements()->count());
    }

}
