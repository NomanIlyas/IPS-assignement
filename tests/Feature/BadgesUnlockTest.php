<?php

namespace Tests\Feature;

use App\Events\AchievementUnlockedEvent;
use App\Models\User;
use Database\Seeders\AchievementsSeeder;
use Database\Seeders\BadgesSeeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class BadgesUnlockTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    #[NoReturn] public function test_beginner_badge_unlock()
    {
        $user = User::factory()->create();
        $this->assertSame($user->badges()->first()->name, 'BEGINNER');
    }

    /**
     * @test
     */
    #[NoReturn] public function test_intermediate_badge_unlock()
    {
        $user = User::factory()->create();
        $no_of_unlock_achievements = 4;

        $achievements_for_intermediate = array_slice(
            Config::get('achievements.achievements'),
            0, $no_of_unlock_achievements
        );

        foreach ($achievements_for_intermediate as $achievement) {
            Event::dispatch(new AchievementUnlockedEvent($achievement['name'], $user));
        }
        $badgeNames = $user->badges()->orderByDesc('id')->first()->name;

        $this->assertSame($no_of_unlock_achievements, $user->achievements()->count());
        $this->assertSame($badgeNames, 'INTERMEDIATE');
    }

    /**
     * @test
     */
    #[NoReturn] public function test_advance_badge_unlock()
    {
        $user = User::factory()->create();
        $no_of_unlock_achievements = 8;

        $achievements_for_intermediate = array_slice(
            Config::get('achievements.achievements'),
            0, $no_of_unlock_achievements
        );

        foreach ($achievements_for_intermediate as $achievement) {
            Event::dispatch(new AchievementUnlockedEvent($achievement['name'], $user));
        }
        $badgeNames = $user->badges()->orderByDesc('id')->first()->name;

        $this->assertSame($no_of_unlock_achievements, $user->achievements()->count());
        $this->assertSame($badgeNames, 'ADVANCED');
    }

    /**
     * @test
     */
    #[NoReturn] public function test_master_badge_unlock()
    {
        $user = User::factory()->create();
        $no_of_unlock_achievements = 10;

        $achievements_for_intermediate = array_slice(
            Config::get('achievements.achievements'),
            0, $no_of_unlock_achievements
        );

        foreach ($achievements_for_intermediate as $achievement) {
            Event::dispatch(new AchievementUnlockedEvent($achievement['name'], $user));
        }
        $badgeNames = $user->badges()->orderByDesc('id')->first()->name;

        $this->assertSame($no_of_unlock_achievements, $user->achievements()->count());
        $this->assertSame($badgeNames, 'MASTER');
    }
}
