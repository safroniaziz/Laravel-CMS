<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class InfoCardSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $infoCardSettings = [
            // Visibility Control
            ['key' => 'info_card_show', 'value' => '1'],
            
            // Layout Style
            ['key' => 'info_card_layout_style', 'value' => 'current'], // current, compact, gradient, modern, premium
            
            // Content
            ['key' => 'info_card_badge_text', 'value' => 'INFORMASI PENTING'],
            ['key' => 'info_card_badge_icon', 'value' => 'fa-info-circle'],
            ['key' => 'info_card_title', 'value' => 'Informasi Terkini Tahun {{year}}'],
            ['key' => 'info_card_subtitle', 'value' => 'Program Studi Sistem Informasi Universitas Bengkulu'],
            ['key' => 'info_card_button_text', 'value' => 'Info Selengkapnya'],
            ['key' => 'info_card_button_link', 'value' => '/contact'],
            ['key' => 'info_card_button_icon', 'value' => 'fa-arrow-right'],
            
            // Styling Options
            ['key' => 'info_card_bg_color', 'value' => '#f8fafc'],
            ['key' => 'info_card_border_color', 'value' => '#e5e7eb'],
            ['key' => 'info_card_badge_bg', 'value' => '#f1f5f9'],
            ['key' => 'info_card_badge_dot_color', 'value' => '#f59e0b'],
            ['key' => 'info_card_title_color', 'value' => '#1e293b'],
            ['key' => 'info_card_subtitle_color', 'value' => '#64748b'],
            ['key' => 'info_card_button_bg', 'value' => '#1a246a'],
            ['key' => 'info_card_button_text_color', 'value' => '#ffffff'],
            ['key' => 'info_card_button_border_color', 'value' => '#1a246a'],
            
            // Campus Identity (for premium layout)
            ['key' => 'info_card_campus_logo', 'value' => ''],
            ['key' => 'info_card_campus_name', 'value' => 'Universitas Bengkulu'],
            ['key' => 'info_card_campus_short_name', 'value' => 'UNIB'],
            
            // Gradient Colors (for modern layouts)
            ['key' => 'info_card_gradient_start', 'value' => '#1a246a'],
            ['key' => 'info_card_gradient_end', 'value' => '#3b82f6'],
        ];

        foreach ($infoCardSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
