<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class FooterSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $footerSettings = [
            // Visibility Control
            ['key' => 'footer_show', 'value' => '1'],
            
            // Footer Logo & Description
            ['key' => 'footer_logo_text', 'value' => 'SISTEM INFORMASI'],
            ['key' => 'footer_logo_subtext', 'value' => 'UNIVERSITAS BENGKULU'],
            ['key' => 'footer_description', 'value' => 'Leading the future of digital innovation and information systems education in Indonesia.'],
            
            // Contact Information
            ['key' => 'footer_address', 'value' => 'Jl. W.R. Supratman Kandang Limun Bengkulu 38371'],
            ['key' => 'footer_phone', 'value' => '(0737) 21118'],
            ['key' => 'footer_email', 'value' => 'si@unib.ac.id'],
            ['key' => 'footer_website', 'value' => 'si.unib.ac.id'],
            
            // Operating Hours / Jam Operasional
            ['key' => 'footer_hours_title', 'value' => 'JAM OPERASIONAL'],
            ['key' => 'footer_hours_weekday_label', 'value' => 'Senin - Jumat'],
            ['key' => 'footer_hours_weekday_time', 'value' => '08:00 - 16:00 WIB'],
            ['key' => 'footer_hours_saturday_label', 'value' => 'Sabtu'],
            ['key' => 'footer_hours_saturday_time', 'value' => '08:00 - 12:00 WIB'],
            ['key' => 'footer_hours_holiday_label', 'value' => 'Minggu & Hari Libur'],
            ['key' => 'footer_hours_holiday_time', 'value' => 'Tutup'],
            
            // Section Titles
            ['key' => 'footer_quicklinks_title', 'value' => 'QUICK LINKS'],
            ['key' => 'footer_contact_title', 'value' => 'CONTACT'],
            
            // Copyright Text
            ['key' => 'footer_copyright_text', 'value' => 'All Rights Reserved'],
            
            // Color Settings
            ['key' => 'footer_bg_gradient_start', 'value' => '#0f172a'],
            ['key' => 'footer_bg_gradient_mid', 'value' => '#1a246a'],
            ['key' => 'footer_bg_gradient_end', 'value' => '#151945'],
            ['key' => 'footer_text_color', 'value' => '#d0d0d0'],
            ['key' => 'footer_heading_color', 'value' => '#ffffff'],
            ['key' => 'footer_accent_color', 'value' => '#4c5db5'],
            
            // Social Media URLs
            ['key' => 'footer_facebook_url', 'value' => 'https://facebook.com/unib'],
            ['key' => 'footer_instagram_url', 'value' => 'https://instagram.com/unib'],
            ['key' => 'footer_linkedin_url', 'value' => 'https://linkedin.com/school/unib'],
            ['key' => 'footer_youtube_url', 'value' => 'https://youtube.com/@unib'],
        ];

        foreach ($footerSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
