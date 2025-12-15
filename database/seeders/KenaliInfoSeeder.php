<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KenaliInfo;

class KenaliInfoSeeder extends Seeder
{
    public function run(): void
    {
        $infos = [
            [
                'order' => 1,
                'icon' => 'fa-lightbulb',
                'title' => 'Apa itu SI?',
                'description' => 'Disiplin ilmu yang mempelajari interaksi antara Teknologi Informasi dengan Sistem Sosial untuk menciptakan solusi digital yang efektif.',
                'color' => '#fbbf24',
                'active' => true,
            ],
            [
                'order' => 2,
                'icon' => 'fa-rocket',
                'title' => 'Prospek Karir',
                'description' => 'IS Developer, Technopreneur, Konsultan e-Business, Akademisi SI. Lulusan siap menghadapi tantangan industri 4.0 dan era digital.',
                'color' => '#10b981',
                'active' => true,
            ],
            [
                'order' => 3,
                'icon' => 'fa-award',
                'title' => 'Keunggulan',
                'description' => 'Terakreditasi A oleh BAN-PT dan terakreditasi internasional ACQUIN. Sertifikasi pelatihan internasional untuk mahasiswa.',
                'color' => '#8b5cf6',
                'active' => true,
            ],
        ];

        foreach ($infos as $info) {
            KenaliInfo::updateOrCreate(
                ['title' => $info['title']],
                $info
            );
        }
    }
}
