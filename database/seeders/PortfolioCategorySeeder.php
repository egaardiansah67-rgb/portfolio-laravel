<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortfolioCategory;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Web', 'order' => 1],
            ['name' => 'Mobile', 'order' => 2],
            ['name' => 'UI UX', 'order' => 3],
            ['name' => 'Desktop', 'order' => 4],
        ];

        foreach ($categories as $category) {
            PortfolioCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
