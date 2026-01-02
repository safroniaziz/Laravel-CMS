<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Media;
use App\Models\Tag;
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
        // Get admin user as author - with better error handling
        $author = User::where('email', 'admin@cms.com')->first();
        
        if (!$author) {
            // Fallback to first user or create one
            $author = User::first();
            if (!$author) {
                $this->command->warn('No users found. Creating default author...');
                $author = User::create([
                    'name' => 'Admin CMS',
                    'email' => 'admin@cms.com',
                    'password' => bcrypt('password'),
                    'role' => 'admin',
                ]);
            }
        }
        
        $this->command->info('Using author: ' . $author->name . ' (ID: ' . $author->id . ')');

        // Get or create "Berita" category
        $category = Category::firstOrCreate(
            ['slug' => 'berita'],
            [
                'name' => 'Berita',
                'description' => 'Berita terkini seputar program studi'
            ]
        );
        
        // Get seeded media for featured images
        $mediaImages = Media::all();
        
        if ($mediaImages->isEmpty()) {
            $this->command->warn('No media found. Using placeholder URLs instead.');
            $useMedia = false;
        } else {
            $this->command->info('Using ' . $mediaImages->count() . ' seeded media images for posts.');
            $useMedia = true;
        }

        $posts = [
            [
                'title' => 'Serah Terima Mahasiswa Kerja Praktik Program Studi Sistem Informasi Tahun 2025',
                'slug' => 'serah-terima-mahasiswa-kerja-praktik-2025',
                'excerpt' => 'Bengkulu, 30 Juni 2025 — Program Studi Sistem Informasi Universitas kembali melepas mahasiswa untuk mengikuti kegiatan Kerja Praktik (Magang) di berbagai instansi, sebagai bagian dari upaya peningkatan kompetensi dan pengalaman di dunia kerja.',
                'content' => '<h2>Pelaksanaan Serah Terima</h2>

<p>Bengkulu, 30 Juni 2025 — Program Studi Sistem Informasi Universitas kembali melepas mahasiswa untuk mengikuti kegiatan Kerja Praktik (Magang) di berbagai instansi, sebagai bagian dari upaya peningkatan kompetensi dan pengalaman di dunia kerja.</p>

<p>Kegiatan serah terima dilaksanakan di Aula Fakultas dengan dihadiri oleh Ketua Program Studi, dosen pembimbing, dan perwakilan dari instansi mitra. Mahasiswa yang mengikuti program ini akan ditempatkan di berbagai perusahaan teknologi, startup digital, hingga instansi pemerintahan.</p>

<h3>Tujuan Program Kerja Praktik</h3>

<p>"Kerja praktik merupakan kesempatan berharga bagi mahasiswa untuk mengaplikasikan ilmu yang telah dipelajari di kelas ke dalam dunia kerja nyata," ujar Ketua Program Studi dalam sambutannya.</p>

<p>Program ini memiliki beberapa tujuan utama:</p>

<ul>
    <li>Memberikan pengalaman praktis kepada mahasiswa dalam mengimplementasikan ilmu yang telah dipelajari</li>
    <li>Membangun soft skills seperti komunikasi, teamwork, dan problem solving</li>
    <li>Memperluas jaringan profesional dan koneksi industri</li>
    <li>Meningkatkan daya saing lulusan di pasar kerja</li>
    <li>Memberikan gambaran nyata tentang dunia kerja di bidang Sistem Informasi</li>
</ul>

<h3>Mitra Industri</h3>

<p>Tahun ini, Program Studi Sistem Informasi berhasil menjalin kerjasama dengan lebih dari 35 instansi mitra yang tersebar di berbagai kota besar di Indonesia. Beberapa mitra unggulan antara lain:</p>

<ul>
    <li><strong>Perusahaan Teknologi:</strong> Tokopedia, Bukalapak, Shopee, dan berbagai startup teknologi terkemuka</li>
    <li><strong>Perbankan Digital:</strong> BCA Digital, Bank Mandiri, BNI, dan fintech companies</li>
    <li><strong>Instansi Pemerintahan:</strong> Kementerian Komunikasi dan Informatika, Diskominfo berbagai daerah</li>
    <li><strong>Konsultan IT:</strong> Berbagai perusahaan konsultan sistem informasi dan digital transformation</li>
</ul>

<blockquote>
    "Kerja sama dengan industri ini sangat penting untuk memastikan kurikulum kami tetap relevan dengan kebutuhan pasar kerja. Melalui program magang ini, kami juga mendapatkan masukan berharga untuk pengembangan kurikulum ke depan." - Koordinator Kerja Praktik
</blockquote>

<h3>Persiapan dan Pembekalan</h3>

<p>Sebelum diterjunkan ke lapangan, mahasiswa telah mengikuti serangkaian pembekalan yang mencakup:
</p>

<ol>
    <li>Workshop professional ethics dan workplace communication</li>
    <li>Technical skills refresher sesuai bidang penempatan</li>
    <li>Bimbingan penyusunan proposal dan laporan kerja praktik</li>
    <li>Pengenalan tools dan metodologi yang umum digunakan di industri</li>
</ol>

<h3>Harapan dan Dukungan</h3>

<p>Ketua Program Studi mengharapkan agar mahasiswa dapat memanfaatkan kesempatan ini sebaik-baiknya. "Tunjukkan dedikasi dan profesionalisme kalian. Jadilah pembelajar yang aktif dan jangan takut untuk bertanya. Ini adalah kesempatan emas untuk belajar dari para praktisi yang berpengalaman," pesannya.</p>

<p>Program Studi akan terus memberikan dukungan penuh selama proses kerja praktik berlangsung melalui:
</p>

<ul>
    <li>Monitoring berkala oleh dosen pembimbing</li>
    <li>Konsultasi online untuk kendala yang dihadapi</li>
    <li>Evaluasi progress secara periodik</li>
    <li>Support system 24/7 untuk emergency</li>
</ul>

<p>Program Kerja Praktik diharapkan dapat diselesaikan dalam waktu 3-4 bulan dan akan diakhiri dengan presentasi hasil serta penyerahan laporan akhir kepada Program Studi.</p>',
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

        // Get all tags for random assignment
        $allTags = Tag::all();
        
        foreach ($posts as $index => $post) {
            // Get random media or use placeholder
            if ($useMedia && $mediaImages->count() > 0) {
                $randomMedia = $mediaImages->random();
                $featuredImageUrl = asset('storage/media/large/' . $randomMedia->file_name);
            } else {
                $featuredImageUrl = $post['featured_image'];
            }
            
            $createdPost = Post::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'featured_image' => $featuredImageUrl,
                    'status' => $post['status'],
                    'published_at' => $post['published_at'],
                    'category_id' => $category->id,
                    'author_id' => $author->id,
                    'views' => rand(50, 500), // Add random views for testing
                ]
            );
            
            // Attach random tags (2-4 tags per post)
            if ($allTags->isNotEmpty()) {
                $randomTags = $allTags->random(min(rand(2, 4), $allTags->count()));
                $createdPost->tags()->sync($randomTags->pluck('id'));
            }
        }

        // ===== POSTS FOR OTHER CATEGORIES =====
        
        // Prestasi Category
        $prestasiCategory = Category::firstOrCreate(['slug' => 'prestasi'], ['name' => 'Prestasi']);
        $prestasiPosts = [
            [
                'title' => 'Mahasiswa SI UNIB Raih Juara 1 Hackathon Nasional 2025',
                'slug' => 'mahasiswa-si-unib-juara-hackathon-2025',
                'excerpt' => 'Tim mahasiswa Sistem Informasi UNIB berhasil meraih juara pertama dalam kompetisi Hackathon Nasional 2025 yang diselenggarakan di Jakarta.',
                'content' => '<p>Tim mahasiswa Sistem Informasi UNIB yang terdiri dari 4 orang berhasil meraih juara pertama dalam kompetisi Hackathon Nasional 2025. Mereka mengembangkan aplikasi smart campus yang inovatif.</p><p>Kompetisi ini diikuti oleh lebih dari 100 tim dari berbagai universitas di Indonesia. Tim SI UNIB berhasil unggul dengan solusi yang kreatif dan implementasi yang baik.</p>',
            ],
            [
                'title' => 'Dosen SI UNIB Raih Best Paper Award di Konferensi Internasional',
                'slug' => 'dosen-si-unib-best-paper-award-2025',
                'excerpt' => 'Dr. Ahmad Rifai, dosen Program Studi Sistem Informasi, meraih penghargaan Best Paper Award di konferensi internasional IEEE.',
                'content' => '<p>Dr. Ahmad Rifai berhasil meraih Best Paper Award untuk penelitiannya tentang implementasi AI dalam sistem informasi manajemen. Penghargaan ini diberikan dalam konferensi IEEE yang diselenggarakan di Singapura.</p>',
            ],
        ];

        foreach ($prestasiPosts as $post) {
            $img = $useMedia && $mediaImages->count() > 0 ? asset('storage/media/large/' . $mediaImages->random()->file_name) : 'https://picsum.photos/seed/prestasi/800/500';
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'featured_image' => $img,
                    'status' => 'published',
                    'published_at' => now()->subDays(rand(1, 30)),
                    'category_id' => $prestasiCategory->id,
                    'author_id' => $author->id,
                    'views' => rand(50, 300),
                ]
            );
        }

        // Akademik Category
        $akademikCategory = Category::firstOrCreate(['slug' => 'akademik'], ['name' => 'Akademik']);
        $akademikPosts = [
            [
                'title' => 'Pendaftaran Mata Kuliah Semester Genap 2025/2026 Dibuka',
                'slug' => 'pendaftaran-matkul-genap-2025-2026',
                'excerpt' => 'Program Studi Sistem Informasi membuka pendaftaran mata kuliah untuk semester genap tahun akademik 2025/2026.',
                'content' => '<p>Mahasiswa dapat melakukan pendaftaran mata kuliah melalui portal akademik mulai tanggal 15 Januari 2026. Pastikan telah melunasi pembayaran UKT sebelum melakukan pendaftaran.</p>',
            ],
            [
                'title' => 'Workshop Pengembangan Kurikulum Berbasis KKNI',
                'slug' => 'workshop-kurikulum-kkni-2025',
                'excerpt' => 'Program Studi mengadakan workshop pengembangan kurikulum berbasis Kerangka Kualifikasi Nasional Indonesia.',
                'content' => '<p>Workshop ini bertujuan untuk menyesuaikan kurikulum dengan kebutuhan industri dan standar KKNI. Dihadiri oleh seluruh dosen dan stakeholder industri.</p>',
            ],
        ];

        foreach ($akademikPosts as $post) {
            $img = $useMedia && $mediaImages->count() > 0 ? asset('storage/media/large/' . $mediaImages->random()->file_name) : 'https://picsum.photos/seed/akademik/800/500';
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'featured_image' => $img,
                    'status' => 'published',
                    'published_at' => now()->subDays(rand(1, 30)),
                    'category_id' => $akademikCategory->id,
                    'author_id' => $author->id,
                    'views' => rand(50, 300),
                    'event_location' => 'Gedung C, Ruang Sidang Utama',
                    'event_status' => 'open',
                    'event_participants' => rand(20, 100),
                    'event_cta_type' => collect(['register', 'detail', 'download'])->random(),
                ]
            );
        }

        // Penelitian Category
        $penelitianCategory = Category::firstOrCreate(['slug' => 'penelitian'], ['name' => 'Penelitian']);
        $penelitianPosts = [
            [
                'title' => 'Hibah Penelitian DIKTI 2025 untuk Riset AI dan Big Data',
                'slug' => 'hibah-penelitian-dikti-ai-bigdata-2025',
                'excerpt' => 'Tim peneliti SI UNIB berhasil mendapatkan hibah penelitian dari DIKTI untuk pengembangan sistem berbasis AI dan Big Data.',
                'content' => '<p>Penelitian ini fokus pada pengembangan sistem prediksi berbasis machine learning untuk analisis data pendidikan. Dana hibah sebesar 500 juta rupiah akan digunakan untuk pengembangan selama 2 tahun.</p>',
            ],
            [
                'title' => 'Publikasi Jurnal Internasional Q1 oleh Dosen SI UNIB',
                'slug' => 'publikasi-jurnal-q1-dosen-si-2025',
                'excerpt' => 'Dosen Program Studi Sistem Informasi berhasil mempublikasikan penelitiannya di jurnal internasional bereputasi Q1.',
                'content' => '<p>Penelitian tentang implementasi blockchain dalam sistem informasi kesehatan berhasil dipublikasikan di Journal of Medical Informatics yang merupakan jurnal Q1.</p>',
            ],
        ];

        foreach ($penelitianPosts as $post) {
            $img = $useMedia && $mediaImages->count() > 0 ? asset('storage/media/large/' . $mediaImages->random()->file_name) : 'https://picsum.photos/seed/penelitian/800/500';
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'featured_image' => $img,
                    'status' => 'published',
                    'published_at' => now()->subDays(rand(1, 30)),
                    'category_id' => $penelitianCategory->id,
                    'author_id' => $author->id,
                    'views' => rand(50, 300),
                ]
            );
        }

        // Kegiatan Category
        $kegiatanCategory = Category::firstOrCreate(['slug' => 'kegiatan'], ['name' => 'Kegiatan']);
        $kegiatanPosts = [
            [
                'title' => 'Seminar Nasional Teknologi Informasi 2025',
                'slug' => 'seminar-nasional-ti-2025',
                'excerpt' => 'Program Studi Sistem Informasi menyelenggarakan Seminar Nasional Teknologi Informasi dengan tema transformasi digital.',
                'content' => '<p>Seminar ini menghadirkan pembicara dari berbagai perusahaan teknologi terkemuka dan akademisi. Lebih dari 500 peserta mengikuti kegiatan ini baik secara offline maupun online.</p>',
            ],
            [
                'title' => 'Workshop Sertifikasi IT Professional untuk Mahasiswa',
                'slug' => 'workshop-sertifikasi-it-2025',
                'excerpt' => 'Program Studi mengadakan workshop persiapan sertifikasi IT professional untuk meningkatkan daya saing mahasiswa.',
                'content' => '<p>Workshop ini mempersiapkan mahasiswa untuk mengikuti sertifikasi internasional seperti AWS, Google Cloud, dan Microsoft Azure. Peserta mendapatkan voucher ujian gratis.</p>',
            ],
        ];

        foreach ($kegiatanPosts as $post) {
            $img = $useMedia && $mediaImages->count() > 0 ? asset('storage/media/large/' . $mediaImages->random()->file_name) : 'https://picsum.photos/seed/kegiatan/800/500';
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'featured_image' => $img,
                    'status' => 'published',
                    'published_at' => now()->subDays(rand(1, 30)),
                    'category_id' => $kegiatanCategory->id,
                    'author_id' => $author->id,
                    'views' => rand(50, 300),
                ]
            );
        }

        $this->command->info('Posts seeded for all categories: Berita, Prestasi, Akademik, Penelitian, Kegiatan');
    }
}
