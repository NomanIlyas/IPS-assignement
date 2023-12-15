<?php

namespace Tests\Feature;

use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AchievementEndpointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_format(): void
    {
        $user = User::factory()->create();

        $this->get("/users/{$user->id}/achievements")
            ->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->whereAllType([
                    'unlocked_achievements' => 'array',
                    'next_available_achievements' => 'array',
                    'current_badge' => 'string',
                    'next_badge' => 'string',
                    'remaining_to_unlock_next_badge' => 'integer',
                ]);
            });
    }

    // Test for unlocked achievements based on user level (Beginner)
    public function test_beginner_user_has_no_unlocked_achievements(): void
    {
        $user = User::factory()->create();
        $this->get("/users/{$user->id}/achievements")
            ->assertJson(fn (AssertableJson $json) =>
            $json->where('unlocked_achievements', [])
                ->etc());
    }
}
