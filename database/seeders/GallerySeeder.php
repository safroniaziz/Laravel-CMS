<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing galleries
        Gallery::truncate();
        
        // Create gallery directory if not exists
        $galleryPath = public_path('gallery-images');
        if (!file_exists($galleryPath)) {
            mkdir($galleryPath, 0755, true);
        }
        
        // Clean old files
        $files = File::glob($galleryPath . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        $galleries = [
            // Using Picsum for consistent images
            ['title' => 'Wisuda Sarjana Angkatan 2024', 'description' => 'Momen kebahagiaan para wisudawan dan wisudawati Program Studi Sistem Informasi.', 'category' => 'Wisuda', 'seed' => 1],
            ['title' => 'Prosesi Wisuda Semester Genap', 'description' => 'Acara wisuda yang diselenggarakan di Gedung Serba Guna Universitas.', 'category' => 'Wisuda', 'seed' => 2],
            ['title' => 'Foto Bersama Wisudawan Terbaik', 'description' => 'Mahasiswa dengan IPK tertinggi berfoto bersama Rektor dan Dekan.', 'category' => 'Wisuda', 'seed' => 3],
            
            ['title' => 'Seminar Nasional Teknologi Informasi', 'description' => 'Kegiatan seminar nasional dengan tema Transformasi Digital.', 'category' => 'Seminar', 'seed' => 4],
            ['title' => 'Webinar Cyber Security', 'description' => 'Webinar tentang keamanan siber untuk mahasiswa dan dosen.', 'category' => 'Seminar', 'seed' => 5],
            ['title' => 'Talkshow Startup Digital', 'description' => 'Diskusi dengan founder startup unicorn Indonesia.', 'category' => 'Seminar', 'seed' => 6],
            
            ['title' => 'Praktikum Pemrograman Web', 'description' => 'Mahasiswa melakukan praktikum dengan bahasa PHP dan Laravel.', 'category' => 'Akademik', 'seed' => 7],
            ['title' => 'Ujian Tengah Semester', 'description' => 'Pelaksanaan UTS di ruang ujian Fakultas Teknik.', 'category' => 'Akademik', 'seed' => 8],
            ['title' => 'Sidang Tugas Akhir', 'description' => 'Mahasiswa mempresentasikan hasil penelitian skripsi.', 'category' => 'Akademik', 'seed' => 9],
            ['title' => 'Kuliah Tamu dari Industri', 'description' => 'Praktisi IT memberikan kuliah kepada mahasiswa.', 'category' => 'Akademik', 'seed' => 10],
            
            ['title' => 'Juara 1 Hackathon Nasional', 'description' => 'Tim mahasiswa meraih juara 1 kompetisi hackathon.', 'category' => 'Prestasi', 'seed' => 11],
            ['title' => 'Kompetisi ICPC Regional', 'description' => 'Tim competitive programming berpartisipasi di ICPC.', 'category' => 'Prestasi', 'seed' => 12],
            ['title' => 'Juara 2 Gemastik', 'description' => 'Mahasiswa meraih penghargaan di ajang Gemastik.', 'category' => 'Prestasi', 'seed' => 13],
            
            ['title' => 'Laboratorium Jaringan Komputer', 'description' => 'Fasilitas lab dengan peralatan Cisco dan Mikrotik.', 'category' => 'Fasilitas', 'seed' => 14],
            ['title' => 'Gedung Kuliah Fakultas Teknik', 'description' => 'Tampak depan gedung perkuliahan yang modern.', 'category' => 'Fasilitas', 'seed' => 15],
            ['title' => 'Ruang Kelas Multimedia', 'description' => 'Kelas dengan fasilitas proyektor dan AC.', 'category' => 'Fasilitas', 'seed' => 16],
            
            ['title' => 'Pelantikan Himpunan Mahasiswa', 'description' => 'Prosesi pelantikan pengurus HIMA periode baru.', 'category' => 'Kemahasiswaan', 'seed' => 17],
            ['title' => 'Ospek Mahasiswa Baru', 'description' => 'Kegiatan pengenalan kampus untuk maba.', 'category' => 'Kemahasiswaan', 'seed' => 18],
            ['title' => 'Bakti Sosial Mahasiswa', 'description' => 'Kegiatan sosial di panti asuhan.', 'category' => 'Kemahasiswaan', 'seed' => 19],
            
            ['title' => 'Workshop Data Science', 'description' => 'Workshop tentang Data Science dan Machine Learning.', 'category' => 'Workshop', 'seed' => 20],
            ['title' => 'Pelatihan Web Development', 'description' => 'Pelatihan membuat website dengan React dan Laravel.', 'category' => 'Workshop', 'seed' => 21],
        ];

        $order = 1;
        foreach ($galleries as $data) {
            // Download image from Picsum
            $seed = 1100 + $data['seed']; // Start from 1100 to avoid conflict with media
            $imageUrl = "https://picsum.photos/seed/{$seed}/800/600";
            $filename = "gallery_{$seed}.jpg";
            $filepath = $galleryPath . '/' . $filename;
            
            try {
                $imageContent = @file_get_contents($imageUrl);
                if ($imageContent !== false) {
                    file_put_contents($filepath, $imageContent);
                    $this->command->info("Downloaded: {$filename}");
                } else {
                    $this->command->warn("Failed to download: {$filename}");
                    continue;
                }
            } catch (\Exception $e) {
                $this->command->error("Error downloading {$filename}: " . $e->getMessage());
                continue;
            }
            
            Gallery::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'type' => 'image',
                'file_path' => asset('gallery-images/' . $filename),
                'category' => $data['category'],
                'order' => $order++,
                'is_active' => true,
            ]);
        }

        $this->command->info('Gallery seeded successfully with ' . count($galleries) . ' items!');
    }
}
