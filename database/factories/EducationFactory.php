<?php

namespace Database\Factories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    protected $model = Education::class;

    public function definition(): array
    {
        return [
            'university_name' => $this->faker->university(),
            'field_of_study' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'start_date' => $this->faker->dateTimeBetween('-10 years', '-5 years'),
            'end_date' => $this->faker->dateTimeBetween('-5 years', '-2 years'),
            'order' => $this->faker->randomNumber(1),
        ];
    }
}
