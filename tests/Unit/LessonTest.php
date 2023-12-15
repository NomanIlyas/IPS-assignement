<?php

namespace Tests\Unit;

use App\Events\LessonWatchedEvent;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_user_belong_to_lesson()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();

        Event::dispatch(new LessonWatchedEvent($lesson, $user));

        $this->assertInstanceOf(BelongsToMany::class, $user->lessons());
    }
}
