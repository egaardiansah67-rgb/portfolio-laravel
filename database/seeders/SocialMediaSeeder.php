<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialMedia;

class SocialMediaSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            ['platform' => 'Facebook', 'icon' => 'fab fa-facebook'],
            ['platform' => 'Instagram', 'icon' => 'fab fa-instagram'],
            ['platform' => 'LinkedIn', 'icon' => 'fab fa-linkedin'],
            ['platform' => 'Github', 'icon' => 'fab fa-github'],
            ['platform' => 'Youtube', 'icon' => 'fab fa-youtube'],
            ['platform' => 'TikTok', 'icon' => 'fab fa-tiktok'],
            ['platform' => 'WhatsApp', 'icon' => 'fab fa-whatsapp'],
        ];

        foreach ($platforms as $platform) {
            SocialMedia::firstOrCreate(['platform' => $platform['platform']], $platform);
        }
    }
}
