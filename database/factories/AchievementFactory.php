<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AchievementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Achievement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $types = Achievement::getTypes();

        return [
            'name' => $this->faker->jobTitle,
            'type' => $types[array_rand($types)],
            'value' => $this->faker->numberBetween(1, 25),
        ];
    }

}
