<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get superadmin user as author
        $author = User::where('email', 'superadmin@cms.com')->first();

        // Get or create "Berita" category
        $category = Category::firstOrCreate(
            ['slug' => 'berita'],
            [
                'name' => 'Berita',
                'description' => 'Berita terkini seputar program studi'
            ]
        );

        $posts = [
            [
                'title' => 'Serah Terima Mahasiswa Kerja Praktik',
                'slug' => 'serah-terima-mahasiswa-kerja-praktik-2025',
                'excerpt' => 'Program Studi Sistem Informasi kembali melepas mahasiswa untuk mengikuti kegiatan Kerja Praktik di berbagai instansi sebagai upaya peningkatan kompetensi.',
                'content' => '<p>Bengkulu, 30 Juni 2025 — Program Studi Sistem Informasi Universitas kembali melepas mahasiswa untuk mengikuti kegiatan Kerja Praktik (Magang) di berbagai instansi, sebagai bagian dari upaya peningkatan kompetensi dan pengalaman di dunia kerja.</p>

<p>Kegiatan serah terima dilaksanakan di Aula Fakultas dengan dihadiri oleh Ketua Program Studi, dosen pembimbing, dan perwakilan dari instansi mitra. Mahasiswa yang mengikuti program ini akan ditempatkan di berbagai perusahaan teknologi, startup digital, hingga instansi pemerintahan.</p>

<p>"Kerja praktik merupakan kesempatan berharga bagi mahasiswa untuk mengaplikasikan ilmu yang telah dipelajari di kelas ke dalam dunia kerja nyata," ujar Ketua Program Studi dalam sambutannya.</p>',
                'featured_image' => 'https://picsum.photos/seed/graduation1/800/500',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Visiting Lecture: Peluang dan Tantangan Artificial Intelligence di Bidang Sistem Informasi',
                'slug' => 'visiting-lecture-ai-sistem-informasi',
                'excerpt' => 'Program Studi Sistem Informasi menggelar Visiting Lecture dengan tema "Peluang dan Tantangan AI" yang menghadirkan praktisi industri teknologi terkemuka. Kegiatan ini bertujuan memberikan wawasan terkini kepada mahasiswa.',
                'content' => '<p>Program Studi Sistem Informasi menggelar Visiting Lecture dengan tema "Peluang dan Tantangan Artificial Intelligence di Bidang Sistem Informasi" yang menghadirkan praktisi industri teknologi terkemuka.</p>

<p>Kegiatan yang diselenggarakan pada hari Rabu, 15 Oktober 2025 ini diikuti oleh seluruh mahasiswa dan dosen program studi. Pembicara dalam acara ini adalah seorang AI Engineer yang telah berpengalaman lebih dari 10 tahun di industri teknologi.</p>

<p>Materi yang disampaikan mencakup perkembangan AI terkini, implementasi machine learning dalam sistem informasi, serta peluang karir di bidang AI untuk lulusan Sistem Informasi.</p>',
                'featured_image' => 'https://picsum.photos/seed/ai-tech2/800/500',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Pelatihan Keterampilan Public Speaking bagi Mahasiswa Sistem Informasi',
                'slug' => 'pelatihan-public-speaking-mahasiswa-si',
                'excerpt' => 'Mahasiswa Program Studi Sistem Informasi mengikuti pelatihan public speaking untuk meningkatkan kemampuan komunikasi dan presentasi. Kegiatan ini merupakan bagian dari soft skills development.',
                'content' => '<p>Mahasiswa Program Studi Sistem Informasi mengikuti pelatihan public speaking untuk meningkatkan kemampuan komunikasi dan presentasi. Kegiatan ini merupakan bagian dari soft skills development yang menjadi fokus program studi.</p>

<p>Pelatihan yang berlangsung selama 2 hari ini mengajarkan teknik berbicara di depan umum, cara menyampaikan presentasi yang efektif, hingga mengelola rasa gugup dan meningkatkan kepercayaan diri.</p>

<p>"Kemampuan public speaking sangat penting bagi lulusan Sistem Informasi, karena mereka tidak hanya dituntut memiliki hard skills teknis, tapi juga mampu mengkomunikasikan ide dan solusi dengan baik," jelas koordinator kegiatan.</p>',
                'featured_image' => 'https://picsum.photos/seed/speaking3/800/500',
                'status' => 'published',
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'General Lecture Program Studi Sistem Informasi Hadirkan Pembicara Internasional',
                'slug' => 'general-lecture-pembicara-internasional',
                'excerpt' => 'Program Studi Sistem Informasi sukses menyelenggarakan General Lecture dengan menghadirkan pembicara internasional dari Singapura. Acara ini membahas tren teknologi global dan peluang kolaborasi riset.',
                'content' => '<p>Program Studi Sistem Informasi sukses menyelenggarakan General Lecture dengan menghadirkan pembicara internasional dari Singapura. Acara ini membahas tren teknologi global dan peluang kolaborasi riset internasional.</p>

<p>Dr. Michael Chen, seorang profesor di bidang Information Systems dari National University of Singapore, berbagi pengalaman dan pengetahuannya tentang perkembangan sistem informasi di Asia Tenggara.</p>

<p>Acara yang dihadiri oleh lebih dari 200 peserta ini juga menjadi ajang networking antara mahasiswa, dosen, dan praktisi industri. Diharapkan kegiatan ini dapat membuka peluang kerjasama riset dan pertukaran mahasiswa di masa mendatang.</p>',
                'featured_image' => 'https://picsum.photos/seed/lecture4/800/500',
                'status' => 'published',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Mahasiswa Sistem Informasi Raih Juara 1 Kompetisi Hackathon Nasional',
                'slug' => 'juara-1-hackathon-nasional',
                'excerpt' => 'Tim mahasiswa Sistem Informasi berhasil meraih juara 1 dalam kompetisi hackathon tingkat nasional dengan mengembangkan aplikasi smart city berbasis IoT dan AI.',
                'content' => '<p>Tim mahasiswa Sistem Informasi berhasil meraih juara 1 dalam kompetisi hackathon tingkat nasional yang diselenggarakan oleh Kementerian Komunikasi dan Informatika.</p>

<p>Tim yang terdiri dari 4 mahasiswa ini mengembangkan aplikasi smart city berbasis IoT dan AI yang mampu mengoptimalkan pengelolaan sampah di perkotaan. Solusi yang mereka tawarkan dinilai inovatif dan applicable untuk diterapkan di berbagai kota di Indonesia.</p>

<p>"Kami sangat bangga dengan prestasi mahasiswa kami. Ini membuktikan bahwa kurikulum dan pembelajaran di Program Studi Sistem Informasi mampu menghasilkan lulusan yang kompeten dan inovatif," ujar Ketua Program Studi.</p>',
                'featured_image' => 'https://picsum.photos/seed/hackathon5/800/500',
                'status' => 'published',
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'Kunjungan Industri ke Perusahaan Teknologi Terkemuka Jakarta',
                'slug' => 'kunjungan-industri-perusahaan-teknologi',
                'excerpt' => 'Mahasiswa Sistem Informasi melakukan kunjungan industri ke beberapa perusahaan teknologi terkemuka di Jakarta untuk melihat langsung implementasi sistem informasi di dunia kerja.',
                'content' => '<p>Mahasiswa Sistem Informasi semester 6 melakukan kunjungan industri ke beberapa perusahaan teknologi terkemuka di Jakarta. Kegiatan ini bertujuan memberikan gambaran nyata tentang dunia kerja dan penerapan ilmu Sistem Informasi di industri.</p>

<p>Selama 3 hari, mahasiswa mengunjungi berbagai perusahaan mulai dari startup unicorn, perusahaan e-commerce, hingga bank digital. Mereka berkesempatan berinteraksi dengan alumni yang telah bekerja dan melihat langsung project-project yang sedang dikerjakan.</p>

<p>"Kunjungan industri ini sangat bermanfaat karena kami bisa melihat bagaimana teori yang kami pelajari di kampus diterapkan dalam project nyata," ungkap salah satu peserta.</p>',
                'featured_image' => 'https://picsum.photos/seed/industry6/800/500',
                'status' => 'published',
                'published_at' => now()->subDays(20),
            ],
        ];

        foreach ($posts as $post) {
            Post::create([
                'title' => $post['title'],
                'slug' => $post['slug'],
                'excerpt' => $post['excerpt'],
                'content' => $post['content'],
                'featured_image' => $post['featured_image'],
                'status' => $post['status'],
                'published_at' => $post['published_at'],
                'author_id' => $author->id,
                'category_id' => $category->id,
                'views' => rand(50, 500),
            ]);
        }
    }
}
