<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Laravel'],
            ['name' => 'PHP'],
            ['name' => 'JavaScript'],
            ['name' => 'React'],
            ['name' => 'Vue.js'],
            ['name' => 'Web Development'],
            ['name' => 'Tutorial'],
            ['name' => 'Best Practices'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['name' => $tag['name']]);
        }
    }
}
