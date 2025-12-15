<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Media;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UGMDummySeeder extends Seeder
{
    public function run()
    {
        // Ensure we have a user
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // 1. Create Categories
        $categories = [
            'Berita' => 'berita',
            'Prestasi' => 'prestasi',
            'Akademik' => 'akademik',
            'Penelitian' => 'penelitian',
        ];

        $catIds = [];
        foreach ($categories as $name => $slug) {
            $cat = Category::firstOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
            $catIds[$slug] = $cat->id;
        }
        
        // Get seeded media
        $mediaImages = Media::all();
        $useMedia = $mediaImages->isNotEmpty();

        // 2. Create Dummy Posts
        
        // --- BERITA TERBARU (Main News) ---
        $beritaTitles = [
            'Grand Launching Majalah Equilibrium 2025 Bahas Krisis Bumi dan Masa Depan Generasi',
            'UNIB dan APCOVE Gelar Lokakarya Epidemiologi untuk Perkuat Kapasitas Kesehatan',
            'UNIB Dampingi Petani Ubah Limbah Biomassa Kayu Jadi Energi Terbarukan',
            'Fakultas Psikologi UNIB Raih Akreditasi Internasional ASIIN',
        ];

        foreach ($beritaTitles as $index => $title) {
            Post::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                'excerpt' => 'Grand Launching Majalah Equilibrium 2025 menyoroti urgensi menjaga keberlanjutan bumi di tengah berbagai proyek transisi energi yang berpotensi menimbulkan dampak ekologis baru.',
                'category_id' => $catIds['berita'],
                'author_id' => $user->id,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays($index),
                'featured_image' => $useMedia ? asset('storage/media/large/' . $mediaImages->random()->file_name) : 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80',
            ]);
        }

        // --- PRESTASI ---
        $prestasiTitles = [
            'Fakultas Psikologi Juara, Wajah-Wajah Baru Mendominasi Lomba Tenis',
            'Tim Fakultas Teknik Juara Panahan PORSENIB 2025',
            'Mahasiswa UNIB Raih Medali Emas di Olimpiade Sains Nasional',
        ];

        foreach ($prestasiTitles as $index => $title) {
            Post::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => '<p>Prestasi membanggakan kembali diraih oleh civitas akademika UNIB...</p>',
                'excerpt' => 'Prestasi membanggakan kembali diraih oleh civitas akademika UNIB dalam ajang bergengsi tingkat nasional.',
                'category_id' => $catIds['prestasi'],
                'author_id' => $user->id,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays($index),
                'featured_image' => $useMedia ? asset('storage/media/large/' . $mediaImages->random()->file_name) : 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80', // Sport/Achievement image
            ]);
        }

        // --- AKADEMIK (Mapped to Pendidikan in View) ---
        $akademikTitles = [
            'Workshop Machine Learning untuk Pemula' => 'Pelajari dasar-dasar Machine Learning dengan praktik langsung menggunakan Python dan TensorFlow dalam workshop interaktif.',
            'Seminar Web Development Modern' => 'Eksplorasi teknologi terkini dalam pengembangan web: React, Next.js, dan Cloud Deployment untuk developer masa depan.',
            'Kuliah Tamu: Data Science in Industry' => 'Praktisi industri berbagi pengalaman implementasi Data Science di perusahaan teknologi terkemuka Indonesia.',
            'Lomba AI & Robotics Competition' => 'Kompetisi pengembangan sistem AI dan Robotics tingkat universitas dengan hadiah menarik dan kesempatan magang.',
            'Pelatihan Cloud Computing AWS' => 'Panduan lengkap deployment aplikasi menggunakan Amazon Web Services dengan sertifikasi resmi AWS Academy.',
        ];

        foreach ($akademikTitles as $title => $excerpt) {
            Post::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => '<p>Kegiatan akademik di lingkungan UNIB terus berjalan dengan dinamis...</p>',
                'excerpt' => $excerpt,
                'category_id' => $catIds['akademik'],
                'author_id' => $user->id,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(array_search($title, array_keys($akademikTitles))),
                'featured_image' => $useMedia ? asset('storage/media/large/' . $mediaImages->random()->file_name) : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80', // Academic/Graduation image
            ]);
        }

        // --- PENELITIAN ---
        $penelitianTitles = [
            'Mahasiswa UNIB Ciptakan Smart Kitchen System (SIKE) dengan Teknologi AI',
            'Beras Presokazi: Inovasi Pangan Premium Bergizi dari Laboratorium UNIB',
            'Peneliti UNIB Temukan Metode Baru Pengolahan Limbah Plastik Ramah Lingkungan',
        ];

        foreach ($penelitianTitles as $index => $title) {
            Post::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => '<p>Inovasi dan penelitian terus dikembangkan untuk memberikan dampak positif bagi masyarakat...</p>',
                'excerpt' => 'Tim peneliti UNIB kembali meluncurkan inovasi terbaru yang bermanfaat bagi masyarakat luas.',
                'category_id' => $catIds['penelitian'],
                'author_id' => $user->id,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays($index),
                'featured_image' => $useMedia ? asset('storage/media/large/' . $mediaImages->random()->file_name) : 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=800&q=80', // Research/Lab image
            ]);
        }
    }
}
