<?php

namespace Tests\Unit;

use App\Events\AchievementUnlockedEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AchievementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */

    public function test_user_belong_to_achievement()
    {
        $user = User::factory()->create();

        Event::dispatch(new AchievementUnlockedEvent('First Comment Written', $user));

        $this->assertInstanceOf(BelongsToMany::class, $user->achievements());
    }
}
