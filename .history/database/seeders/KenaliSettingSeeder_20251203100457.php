<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KenaliSetting;

class KenaliSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Layout
            ['key' => 'layout_style', 'value' => 'current'],
            
            // Video
            ['key' => 'video_id', 'value' => 'PrH05mBgdd4'],
            
            // Background Colors
            ['key' => 'bg_gradient_start', 'value' => '#1a246a'],
            ['key' => 'bg_gradient_end', 'value' => '#151945'],
            
            // CTA Settings
            ['key' => 'cta_text', 'value' => 'Pelajari Lebih Lanjut'],
            ['key' => 'cta_link', 'value' => '/about'],
            ['key' => 'cta_icon', 'value' => 'fa-arrow-right'],
            ['key' => 'cta_gradient_start', 'value' => '#fbbf24'],
            ['key' => 'cta_gradient_end', 'value' => '#f97316'],
            
            // Section Header
            ['key' => 'section_icon', 'value' => '🎯'],
            ['key' => 'section_badge_text', 'value' => 'KENALI LEBIH DEKAT'],
            ['key' => 'section_title', 'value' => 'SISTEM INFORMASI'],
            ['key' => 'section_title_highlight', 'value' => 'UNIB'],
            ['key' => 'section_subtitle', 'value' => 'Program studi yang mempersiapkan lulusan berkualitas di era digital dengan fokus pada teknologi informasi dan sistem bisnis'],
            
            // Theme Colors
            ['key' => 'accent_color', 'value' => '#fbbf24'],
            ['key' => 'decoration_color_1', 'value' => 'rgba(251, 191, 36, 0.1)'],
            ['key' => 'decoration_color_2', 'value' => 'rgba(249, 115, 22, 0.1)'],
        ];

        foreach ($settings as $setting) {
            KenaliSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
