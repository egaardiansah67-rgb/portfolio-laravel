<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AchievementFactory extends Factory
{
    protected $model = Achievement::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'count' => $this->faker->numberBetween(1, 500),
            'icon' => 'fas fa-star',
            'order' => $this->faker->randomNumber(1),
        ];
    }
}
