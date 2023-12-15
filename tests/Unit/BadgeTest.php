<?php

namespace Tests\Unit;

use App\Events\BadgeUnlockedEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class BadgeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_user_belong_to_badge()
    {
        $user = User::factory()->create();

        Event::dispatch(new BadgeUnlockedEvent('INTERMEDIATE', $user));

        $this->assertInstanceOf(BelongsToMany::class, $user->badges());
    }
}
