<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition(): array
    {
        return [
            'skill_category_id' => 1,
            'name' => $this->faker->word(),
            'percentage' => $this->faker->numberBetween(50, 100),
            'color' => $this->faker->hexColor(),
            'icon' => 'fab fa-' . $this->faker->randomElement(['php', 'laravel', 'react', 'vue', 'python']),
            'order' => $this->faker->randomNumber(1),
        ];
    }
}
