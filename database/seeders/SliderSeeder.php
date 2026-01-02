<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Selamat Datang di Program Studi Sistem Informasi',
                'subtitle' => 'Program Studi Terakreditasi',
                'description' => 'Bergabunglah dengan kami dan raih masa depan cemerlang di bidang teknologi informasi. Kami menghasilkan lulusan berkualitas dengan kompetensi tinggi.',
                'image' => 'https://picsum.photos/seed/slider1/600/500',
                'image_position' => 'right',
                'badge_text' => 'UNGGUL',
                'badge_subtext' => 'Terakreditasi',
                'badge_show' => true,
                'button_text' => 'Daftar Sekarang',
                'button_link' => '/contact',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pendidikan Berkualitas dengan Akreditasi Unggul',
                'subtitle' => 'Akreditasi Internasional',
                'description' => 'Program studi kami telah terakreditasi Baik Sekali oleh BAN-PT dan terakreditasi internasional ACQUIN, menjamin kualitas pendidikan terbaik.',
                'image' => 'https://picsum.photos/seed/slider2/600/500',
                'image_position' => 'left',
                'badge_text' => 'A+',
                'badge_subtext' => 'BAN-PT',
                'badge_show' => true,
                'button_text' => 'Pelajari Lebih Lanjut',
                'button_link' => '/page/about',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Fasilitas Modern & Dosen Berkompeten',
                'subtitle' => 'Infrastruktur Terbaik',
                'description' => 'Dilengkapi dengan laboratorium komputer modern, perpustakaan digital, dan dosen-dosen berpengalaman yang siap membimbing Anda.',
                'image' => 'https://picsum.photos/seed/slider3/600/500',
                'image_position' => 'right',
                'badge_text' => 'TOP',
                'badge_subtext' => 'Fasilitas',
                'badge_show' => true,
                'button_text' => 'Lihat Fasilitas',
                'button_link' => '/services',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}

