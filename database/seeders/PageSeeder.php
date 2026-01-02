<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $pages = [
            [
                'title' => 'Kata Alumni',
                'slug' => 'kata-alumni',
                'content' => '<div class="alumni-page">
                    <h1>Kata Alumni Sistem Informasi</h1>
                    <p class="lead">Testimoni dan cerita sukses dari para alumni yang telah berkarir di berbagai bidang industri.</p>
                    
                    <div class="alumni-intro" style="margin: 40px 0; padding: 30px; background: linear-gradient(135deg, #ff6b35, #f7931e); border-radius: 15px; color: white;">
                        <h2 style="margin-bottom: 15px;">🎓 Jaringan Alumni Kami</h2>
                        <p>Program Studi Sistem Informasi telah menghasilkan ribuan alumni yang tersebar di berbagai perusahaan teknologi terkemuka, instansi pemerintah, dan startup inovatif.</p>
                    </div>
                    
                    <div class="alumni-stats" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 40px 0; text-align: center;">
                        <div style="padding: 30px; background: #f8f9fa; border-radius: 10px;">
                            <h3 style="color: #ff6b35; font-size: 2.5rem; margin: 0;">500+</h3>
                            <p style="margin: 10px 0 0;">Total Alumni</p>
                        </div>
                        <div style="padding: 30px; background: #f8f9fa; border-radius: 10px;">
                            <h3 style="color: #ff6b35; font-size: 2.5rem; margin: 0;">95%</h3>
                            <p style="margin: 10px 0 0;">Tingkat Employment</p>
                        </div>
                        <div style="padding: 30px; background: #f8f9fa; border-radius: 10px;">
                            <h3 style="color: #ff6b35; font-size: 2.5rem; margin: 0;">50+</h3>
                            <p style="margin: 10px 0 0;">Perusahaan Mitra</p>
                        </div>
                    </div>
                    
                    <h2 style="margin-top: 50px;">📢 Testimoni Alumni</h2>
                    <p>Baca cerita inspiratif dari para alumni yang telah sukses di berbagai bidang karir.</p>
                    
                    <div style="margin-top: 30px; padding: 20px; border-left: 4px solid #ff6b35; background: #fff8f5;">
                        <p style="font-style: italic; font-size: 1.1rem;">"Ilmu yang saya dapat selama kuliah sangat applicable di dunia kerja. Saya bangga menjadi bagian dari keluarga besar Sistem Informasi."</p>
                        <p style="margin-bottom: 0; font-weight: bold;">— Alumni Angkatan 2018</p>
                    </div>
                    
                    <div style="margin-top: 50px; padding: 30px; background: #1a246a; border-radius: 15px; color: white; text-align: center;">
                        <h3>🤝 Bergabung dengan Komunitas Alumni</h3>
                        <p>Tetap terhubung dengan sesama alumni dan dapatkan informasi terbaru seputar karir dan networking.</p>
                        <a href="#" style="display: inline-block; margin-top: 15px; padding: 12px 30px; background: #ff6b35; color: white; text-decoration: none; border-radius: 8px; font-weight: bold;">Hubungi Kami</a>
                    </div>
                </div>',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Tentang Kami',
                'slug' => 'tentang-kami',
                'content' => '<div class="about-page">
                    <h1>Tentang Program Studi Sistem Informasi</h1>
                    <p class="lead">Mencetak lulusan yang kompeten di bidang teknologi informasi dan sistem bisnis.</p>
                    
                    <h2>Visi</h2>
                    <p>Menjadi program studi unggulan dalam pengembangan sistem informasi yang inovatif dan berdaya saing global.</p>
                    
                    <h2>Misi</h2>
                    <ul>
                        <li>Menyelenggarakan pendidikan berkualitas di bidang sistem informasi</li>
                        <li>Melaksanakan penelitian yang bermanfaat bagi pengembangan ilmu pengetahuan</li>
                        <li>Menjalin kerjasama dengan industri dan institusi terkait</li>
                        <li>Menghasilkan lulusan yang berakhlak mulia dan profesional</li>
                    </ul>
                </div>',
                'status' => 'published',
                'published_at' => now(),
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                array_merge($pageData, ['user_id' => $user->id ?? 1])
            );
        }
    }
}

