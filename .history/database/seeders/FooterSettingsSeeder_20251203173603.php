<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class FooterSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $footerSettings = [
            // ===== FOOTER BRANDING =====
            ['key' => 'footer_logo_text', 'value' => 'SISTEM INFORMASI', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_logo_subtext', 'value' => 'UNIVERSITAS BENGKULU', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_description', 'value' => 'Leading the future of digital innovation and information systems education in Indonesia.', 'type' => 'text', 'group' => 'footer'],

            // ===== FOOTER CONTACT =====
            ['key' => 'footer_address', 'value' => 'Jl. W.R. Supratman Kandang Limun Bengkulu 38371', 'type' => 'text', 'group' => 'footer'],
            ['key' => 'footer_phone', 'value' => '(0737) 21118', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_email', 'value' => 'si@unib.ac.id', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_website', 'value' => 'si.unib.ac.id', 'type' => 'string', 'group' => 'footer'],

            // ===== FOOTER SUBSCRIBE =====
            ['key' => 'footer_subscribe_title', 'value' => 'SUBSCRIBE', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_subscribe_text', 'value' => 'Get the latest updates and news from our Information Systems program', 'type' => 'text', 'group' => 'footer'],
            ['key' => 'footer_subscribe_placeholder', 'value' => 'Email address', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_subscribe_button', 'value' => 'Subscribe Now', 'type' => 'string', 'group' => 'footer'],

            // ===== FOOTER QUICK LINKS =====
            ['key' => 'footer_quicklinks_title', 'value' => 'QUICK LINKS', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_contact_title', 'value' => 'CONTACT', 'type' => 'string', 'group' => 'footer'],

            // ===== FOOTER SOCIAL MEDIA =====
            ['key' => 'footer_facebook_url', 'value' => '#', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_instagram_url', 'value' => '#', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_linkedin_url', 'value' => '#', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_youtube_url', 'value' => '#', 'type' => 'string', 'group' => 'footer'],

            // ===== FOOTER COLORS =====
            ['key' => 'footer_bg_gradient_start', 'value' => '#0f172a', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_bg_gradient_mid', 'value' => '#1a246a', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_bg_gradient_end', 'value' => '#151945', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_text_color', 'value' => '#d0d0d0', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_heading_color', 'value' => '#ffffff', 'type' => 'string', 'group' => 'footer'],
            ['key' => 'footer_accent_color', 'value' => '#4c5db5', 'type' => 'string', 'group' => 'footer'],
        ];

        foreach ($footerSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                ]
            );
        }

        $this->command->info('Footer settings seeded successfully!');
        $this->command->info('Total footer settings added: ' . count($footerSettings));
    }
}
