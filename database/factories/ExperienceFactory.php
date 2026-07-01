<?php

namespace Database\Factories;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    protected $model = Experience::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-5 years', '-1 years');
        $endDate = $this->faker->boolean(70) ? $this->faker->dateTimeBetween($startDate, 'now') : null;

        return [
            'job_title' => $this->faker->jobTitle(),
            'company_name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_current' => $endDate === null,
            'order' => $this->faker->randomNumber(1),
        ];
    }
}
