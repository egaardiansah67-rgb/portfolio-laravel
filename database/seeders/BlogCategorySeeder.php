<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology'],
            ['name' => 'Programming'],
            ['name' => 'Web Development'],
            ['name' => 'Tips & Tricks'],
            ['name' => 'Career'],
        ];

        foreach ($categories as $category) {
            BlogCategory::firstOrCreate(['name' => $category['name']]);
        }
    }
}
