<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SkillCategorySeeder::class,
            PortfolioCategorySeeder::class,
            BlogCategorySeeder::class,
            TagSeeder::class,
            SocialMediaSeeder::class,
        ]);
    }
}
