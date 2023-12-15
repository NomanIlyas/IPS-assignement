<?php

namespace Tests\Unit;

use App\Events\CommentWrittenEvent;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_user_has_a_comment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        Event::dispatch(new CommentWrittenEvent($comment, $user));

        $this->assertInstanceOf(HasMany::class, $user->comments());
    }
}
