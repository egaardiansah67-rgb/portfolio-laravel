<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $services = [
            ['name' => 'Web Development', 'icon' => 'fas fa-globe'],
            ['name' => 'Mobile App Development', 'icon' => 'fas fa-mobile-alt'],
            ['name' => 'UI/UX Design', 'icon' => 'fas fa-palette'],
            ['name' => 'Backend Development', 'icon' => 'fas fa-server'],
            ['name' => 'Database Design', 'icon' => 'fas fa-database'],
            ['name' => 'DevOps & Deployment', 'icon' => 'fas fa-cloud'],
        ];

        $service = $this->faker->randomElement($services);

        return [
            'name' => $service['name'],
            'description' => $this->faker->paragraph(),
            'icon' => $service['icon'],
            'order' => $this->faker->randomNumber(1),
        ];
    }
}
