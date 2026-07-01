<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'position' => $this->faker->jobTitle(),
            'content' => $this->faker->paragraph(),
            'rating' => $this->faker->numberBetween(4, 5),
            'order' => $this->faker->randomNumber(1),
        ];
    }
}
