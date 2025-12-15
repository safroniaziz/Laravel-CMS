<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class VideoSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $videoSettings = [
            // ===== VIDEO PROFIL SETTINGS =====
            ['key' => 'video_title', 'value' => 'Video Profil Program Studi Sistem Informasi', 'type' => 'string', 'group' => 'video'],
            ['key' => 'video_title_short', 'value' => 'Video Profil Sistem Informasi', 'type' => 'string', 'group' => 'video'],
            ['key' => 'video_description', 'value' => 'Kenali lebih dekat Program Studi Sistem Informasi Universitas Bengkulu', 'type' => 'text', 'group' => 'video'],
            ['key' => 'video_description_short', 'value' => 'Kenali Lebih Dekat', 'type' => 'string', 'group' => 'video'],
            ['key' => 'video_iframe_title', 'value' => 'Video Profil Program Studi Sistem Informasi UNIB', 'type' => 'string', 'group' => 'video'],

            // ===== KENALI VIDEO SETTINGS =====
            ['key' => 'kenali_video_title', 'value' => 'Video Profil Sistem Informasi', 'type' => 'string', 'group' => 'kenali'],
            ['key' => 'kenali_video_description', 'value' => 'Kenali Lebih Dekat', 'type' => 'string', 'group' => 'kenali'],
        ];

        foreach ($videoSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                ]
            );
        }

        $this->command->info('Video settings seeded successfully!');
        $this->command->info('Total video settings added: ' . count($videoSettings));
    }
}
