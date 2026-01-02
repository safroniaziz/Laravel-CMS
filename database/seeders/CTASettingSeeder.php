<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class CTASettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ctaSettings = [
            // Visibility Control
            ['key' => 'cta_show', 'value' => '1'],
            
            // Icon
            ['key' => 'cta_icon', 'value' => 'fas fa-rocket'],
            
            // Layout Style
            ['key' => 'cta_layout_style', 'value' => 'current'], // current, minimal, split, centered
            
            // Badge
            ['key' => 'cta_badge_text', 'value' => 'JADILAH BAGIAN DARI REVOLUSI DIGITAL'],
            ['key' => 'cta_badge_show', 'value' => '1'],
            
            // Content
            ['key' => 'cta_title', 'value' => 'Siap Bergabung Bersama Kami?'],
            ['key' => 'cta_subtitle', 'value' => 'Daftar sekarang dan raih masa depan cemerlang di bidang Sistem Informasi'],
            
            // Background Gradient
            ['key' => 'cta_bg_gradient_start', 'value' => '#0f172a'],
            ['key' => 'cta_bg_gradient_mid', 'value' => '#1a246a'],
            ['key' => 'cta_bg_gradient_end', 'value' => '#1a246a'],
            
            // Accent Colors
            ['key' => 'cta_accent_color', 'value' => '#fbbf24'],
            ['key' => 'cta_accent_color_2', 'value' => '#f97316'],
            
            // Primary Button
            ['key' => 'cta_primary_button_text', 'value' => 'Mulai Sekarang'],
            ['key' => 'cta_primary_button_link', 'value' => '/contact'],
            ['key' => 'cta_primary_button_icon', 'value' => 'fa-rocket'],
            
            // Secondary Button
            ['key' => 'cta_secondary_button_text', 'value' => 'Jelajahi Program'],
            ['key' => 'cta_secondary_button_link', 'value' => '/about'],
            ['key' => 'cta_secondary_button_icon', 'value' => 'fa-compass'],
            
            // Feature 1
            ['key' => 'cta_feature_1_icon', 'value' => 'fa-graduation-cap'],
            ['key' => 'cta_feature_1_title', 'value' => 'Pendidikan Berkualitas'],
            ['key' => 'cta_feature_1_description', 'value' => 'Kurikulum modern dan relevan dengan industri'],
            
            // Feature 2
            ['key' => 'cta_feature_2_icon', 'value' => 'fa-laptop-code'],
            ['key' => 'cta_feature_2_title', 'value' => 'Praktik Terbaik'],
            ['key' => 'cta_feature_2_description', 'value' => 'Pembelajaran berbasis proyek dan kasus nyata'],
            
            // Feature 3
            ['key' => 'cta_feature_3_icon', 'value' => 'fa-briefcase'],
            ['key' => 'cta_feature_3_title', 'value' => 'Karir Cemerlang'],
            ['key' => 'cta_feature_3_description', 'value' => 'Jaringan alumni dan peluang kerja luas'],
            
            // Features Show/Hide
            ['key' => 'cta_features_show', 'value' => '1'],
        ];

        foreach ($ctaSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'group' => 'homepage',
                    'type' => 'string'
                ]
            );
        }
    }
}
