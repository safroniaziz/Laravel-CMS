<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class TeacherSettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // Page Layout & Display
            ['key' => 'teacher_page_layout', 'value' => 'grid', 'type' => 'select'], // Options: grid, stats_cards, featured_grid
            ['key' => 'teacher_page_title', 'value' => 'Tim Pengajar Kami', 'type' => 'text'],
            ['key' => 'teacher_page_subtitle', 'value' => 'Dosen berpengalaman dan berkualitas siap membimbing Anda', 'type' => 'textarea'],
            ['key' => 'teacher_page_per_page', 'value' => '8', 'type' => 'number'],
            
            // Hero Section
            ['key' => 'teacher_hero_enabled', 'value' => '1', 'type' => 'boolean'],
            ['key' => 'teacher_hero_gradient_start', 'value' => '#1e3a8a', 'type' => 'color'],
            ['key' => 'teacher_hero_gradient_end', 'value' => '#60a5fa', 'type' => 'color'],
            
            // Card Styling
            ['key' => 'teacher_card_bg_color', 'value' => '#ffffff', 'type' => 'color'],
            ['key' => 'teacher_card_border_radius', 'value' => '16', 'type' => 'number'],
            ['key' => 'teacher_card_shadow', 'value' => '0 4px 20px rgba(0,0,0,0.1)', 'type' => 'text'],
            ['key' => 'teacher_card_hover_shadow', 'value' => '0 12px 35px rgba(0,0,0,0.15)', 'type' => 'text'],
            ['key' => 'teacher_card_primary_color', 'value' => '#3b82f6', 'type' => 'color'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
