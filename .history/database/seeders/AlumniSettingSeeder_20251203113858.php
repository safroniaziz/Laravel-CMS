<?php

namespace Database\Seeders;

use App\Models\AlumniSetting;
use Illuminate\Database\Seeder;

class AlumniSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Layout configuration
            ['key' => 'layout_style', 'value' => 'current'], // current/grid/carousel/testimonial_cards
            
            // Section header
            ['key' => 'section_icon', 'value' => '🎓'],
            ['key' => 'section_badge_text', 'value' => 'IKATAN ALUMNI'],
            ['key' => 'section_title', 'value' => 'IKATAN ALUMNI'],
            ['key' => 'section_title_highlight', 'value' => 'SISTEM INFORMASI'],
            ['key' => 'section_subtitle', 'value' => 'Testimoni dari para alumni yang telah sukses berkarir di berbagai bidang'],
            
            // Background colors
            ['key' => 'bg_gradient_start', 'value' => '#f8fafc'],
            ['key' => 'bg_gradient_end', 'value' => '#ffffff'],
            
            // Accent colors (orange theme)
            ['key' => 'accent_color', 'value' => '#ff6b35'],
            ['key' => 'accent_gradient_start', 'value' => '#ff6b35'],
            ['key' => 'accent_gradient_end', 'value' => '#f7931e'],
            
            // Card styling
            ['key' => 'card_bg_color', 'value' => 'rgba(255,255,255,0.9)'],
            ['key' => 'card_border_color', 'value' => 'rgba(255,107,53,0.08)'],
            
            // Decoration colors
            ['key' => 'decoration_color_1', 'value' => 'rgba(255, 107, 53, 0.1)'],
            ['key' => 'decoration_color_2', 'value' => 'rgba(26, 36, 106, 0.1)'],
            
            // CTA Button
            ['key' => 'cta_text', 'value' => 'Lihat Semua Alumni'],
            ['key' => 'cta_link', 'value' => '/alumni'],
        ];

        foreach ($settings as $setting) {
            AlumniSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
