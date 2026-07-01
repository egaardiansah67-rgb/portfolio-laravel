<?php

namespace Database\Factories;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioFactory extends Factory
{
    protected $model = Portfolio::class;

    public function definition(): array
    {
        return [
            'portfolio_category_id' => 1,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'full_description' => $this->faker->paragraphs(3, true),
            'client_name' => $this->faker->company(),
            'technologies' => implode(', ', $this->faker->words(5)),
            'github_url' => $this->faker->url(),
            'live_url' => $this->faker->url(),
            'project_date' => $this->faker->date(),
            'is_featured' => $this->faker->boolean(50),
            'order' => $this->faker->randomNumber(1),
        ];
    }
}
