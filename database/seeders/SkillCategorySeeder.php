<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SkillCategory;

class SkillCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Frontend', 'order' => 1],
            ['name' => 'Backend', 'order' => 2],
            ['name' => 'Database', 'order' => 3],
            ['name' => 'DevOps', 'order' => 4],
            ['name' => 'Tools', 'order' => 5],
        ];

        foreach ($categories as $category) {
            SkillCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
