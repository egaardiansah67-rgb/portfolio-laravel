<?php

namespace Database\Factories;

use App\Models\Hero;
use Illuminate\Database\Eloquent\Factories\Factory;

class HeroFactory extends Factory
{
    protected $model = Hero::class;

    public function definition(): array
    {
        return [
            'name' => 'John Doe',
            'profession' => 'Full Stack Developer',
            'description' => 'Passionate about building scalable web applications',
            'button_hire_text' => 'Hire Me',
            'button_cv_text' => 'Download CV',
        ];
    }
}
