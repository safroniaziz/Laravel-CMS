<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class CompleteHardcodeFixSeeder extends Seeder
{
    public function run(): void
    {
        $completeSettings = [
            // ===== BASIC COLORS =====
            ['key' => 'color_white', 'value' => '#ffffff', 'type' => 'string', 'group' => 'colors'],
            ['key' => 'color_black', 'value' => '#000000', 'type' => 'string', 'group' => 'colors'],
            ['key' => 'color_gray_100', 'value' => '#f8fafc', 'type' => 'string', 'group' => 'colors'],
            ['key' => 'color_gray_200', 'value' => '#f1f5f9', 'type' => 'string', 'group' => 'colors'],
            ['key' => 'color_gray_300', 'value' => '#e2e8f0', 'type' => 'string', 'group' => 'colors'],
            ['key' => 'color_gray_400', 'value' => '#cbd5e1', 'type' => 'string', 'group' => 'colors'],
            ['key' => 'color_gray_500', 'value' => '#94a3b8', 'type' => 'string', 'group' => 'colors'],
            ['key' => 'color_gray_600', 'value' => '#64748b', 'type' => 'string', 'group' => 'colors'],
            ['key' => 'color_gray_700', 'value' => '#475569', 'type' => 'string', 'group' => 'colors'],
            ['key' => 'color_gray_800', 'value' => '#1e293b', 'type' => 'string', 'group' => 'colors'],
            ['key' => 'color_gray_900', 'value' => '#0f172a', 'type' => 'string', 'group' => 'colors'],

            // ===== BODY & LAYOUT COLORS =====
            ['key' => 'body_text_color', 'value' => '#333333', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'body_bg_color', 'value' => '#ffffff', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'dropdown_bg_color', 'value' => '#1a2547', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'mobile_toggle_bg', 'value' => '#f97316', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'mobile_nav_bg', 'value' => '#1e3a8a', 'type' => 'string', 'group' => 'layout'],

            // ===== OPACITY COLORS (RGBA) =====
            ['key' => 'white_opacity_10', 'value' => 'rgba(255,255,255,0.1)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'white_opacity_15', 'value' => 'rgba(255,255,255,0.15)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'white_opacity_20', 'value' => 'rgba(255,255,255,0.2)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'white_opacity_30', 'value' => 'rgba(255,255,255,0.3)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'white_opacity_80', 'value' => 'rgba(255,255,255,0.8)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'white_opacity_90', 'value' => 'rgba(255,255,255,0.9)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'black_opacity_10', 'value' => 'rgba(0,0,0,0.1)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'black_opacity_15', 'value' => 'rgba(0,0,0,0.15)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'black_opacity_20', 'value' => 'rgba(0,0,0,0.2)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'black_opacity_30', 'value' => 'rgba(0,0,0,0.3)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'black_opacity_50', 'value' => 'rgba(0,0,0,0.5)', 'type' => 'string', 'group' => 'opacity'],

            // ===== BRAND SPECIFIC OPACITY =====
            ['key' => 'primary_opacity_10', 'value' => 'rgba(26, 36, 106, 0.1)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'primary_opacity_15', 'value' => 'rgba(26, 36, 106, 0.15)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'primary_opacity_30', 'value' => 'rgba(26, 36, 106, 0.3)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'primary_opacity_90', 'value' => 'rgba(26, 36, 106, 0.9)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'accent_opacity_08', 'value' => 'rgba(251, 191, 36, 0.08)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'accent_opacity_30', 'value' => 'rgba(251, 191, 36, 0.3)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'secondary_opacity_15', 'value' => 'rgba(30, 58, 138, 0.15)', 'type' => 'string', 'group' => 'opacity'],
            ['key' => 'orange_opacity_15', 'value' => 'rgba(249, 115, 22, 0.15)', 'type' => 'string', 'group' => 'opacity'],

            // ===== GRADIENT BACKGROUNDS =====
            ['key' => 'gradient_news_fallback', 'value' => 'linear-gradient(135deg, #1a246a, #2563eb)', 'type' => 'string', 'group' => 'gradients'],
            ['key' => 'gradient_placeholder_gray', 'value' => 'linear-gradient(135deg, #e2e8f0, #cbd5e1)', 'type' => 'string', 'group' => 'gradients'],
            ['key' => 'gradient_thumbnail_bg', 'value' => 'linear-gradient(135deg, #e8eaf6, #c5cae9)', 'type' => 'string', 'group' => 'gradients'],
            ['key' => 'gradient_card_header', 'value' => 'linear-gradient(135deg, #f8fafc, #ffffff)', 'type' => 'string', 'group' => 'gradients'],
            ['key' => 'gradient_decorative_bg', 'value' => 'linear-gradient(135deg, rgba(251, 191, 36, 0.1), rgba(249, 115, 22, 0.1))', 'type' => 'string', 'group' => 'gradients'],

            // ===== SPECIFIC BRAND COLORS =====
            ['key' => 'brand_primary_dark', 'value' => '#0f4c81', 'type' => 'string', 'group' => 'brand'],
            ['key' => 'brand_secondary_dark', 'value' => '#151945', 'type' => 'string', 'group' => 'brand'],
            ['key' => 'news_category_color', 'value' => '#1a246a', 'type' => 'string', 'group' => 'brand'],

            // ===== UTILITY COLORS =====
            ['key' => 'utility_gray_light', 'value' => '#666666', 'type' => 'string', 'group' => 'utility'],
            ['key' => 'utility_gray_lighter', 'value' => '#999999', 'type' => 'string', 'group' => 'utility'],
            ['key' => 'utility_gray_333', 'value' => '#333333', 'type' => 'string', 'group' => 'utility'],
        ];

        foreach ($completeSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                ]
            );
        }

        $this->command->info('Complete hardcode fix settings seeded successfully!');
        $this->command->info('Total settings added: ' . count($completeSettings));
    }
}
