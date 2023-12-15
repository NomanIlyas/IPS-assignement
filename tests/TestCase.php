<?php

namespace Tests;

use Database\Seeders\AchievementsSeeder;
use Database\Seeders\BadgesSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed the database with common test cases
        $this->artisan('db:seed', ['--class' => AchievementsSeeder::class]);
        $this->artisan('db:seed', ['--class' => BadgesSeeder::class]);
    }
}
