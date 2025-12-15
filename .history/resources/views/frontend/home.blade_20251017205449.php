@extends('layouts.frontend')

@section('content')
<!-- Hero Section - Natural & Flowing -->
<section style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%); padding: 100px 0 120px; position: relative; overflow: hidden;">
    <!-- Animated Background Shapes -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; opacity: 0.1;">
        <div style="position: absolute; top: -50%; right: -5%; width: 500px; height: 500px; background: white; border-radius: 50%; filter: blur(100px);"></div>
        <div style="position: absolute; bottom: -30%; left: -10%; width: 600px; height: 600px; background: white; border-radius: 50%; filter: blur(120px);"></div>
    </div>

    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 80px; align-items: center;">
            <div style="color: white;">
                <div style="display: inline-block; padding: 8px 20px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50px; font-size: 13px; font-weight: 600; margin-bottom: 25px; letter-spacing: 1px;">
                    PROGRAM STUDI SISTEM INFORMASI
                </div>

                <h1 style="font-size: 56px; font-weight: 900; line-height: 1.1; margin-bottom: 25px; text-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    PROFIL<br>
                    <span style="background: linear-gradient(to right, #fbbf24, #f59e0b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">LULUSAN</span>
                </h1>

                <p style="font-size: 17px; line-height: 1.8; margin-bottom: 35px; opacity: 0.95; max-width: 90%;">
                    Selamat datang di platform kami! Kami adalah program studi terkemuka yang menghasilkan lulusan berkualitas
                    dengan kompetensi tinggi di bidangnya.
                </p>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 35px;">
                    <div style="display: flex; align-items: center; gap: 12px; padding: 15px 20px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 12px;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #fbbf24, #f59e0b); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-code" style="font-size: 18px; color: white;"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Programming</div>
                            <div style="font-size: 12px; opacity: 0.8;">Software & Tech</div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 12px; padding: 15px 20px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 12px;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #fbbf24, #f59e0b); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-certificate" style="font-size: 18px; color: white;"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Terakreditasi</div>
                            <div style="font-size: 12px; opacity: 0.8;">Unggul & Internasional</div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 12px;">
                    <a href="#" style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; font-size: 18px; transition: all 0.3s;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; font-size: 18px; transition: all 0.3s;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; font-size: 18px; transition: all 0.3s;">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div style="position: relative;">
                <div style="width: 100%; aspect-ratio: 1; background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); border-radius: 30px; display: flex; align-items: center; justify-content: center; box-shadow: 0 20px 60px rgba(0,0,0,0.2);">
                    <i class="fas fa-user-graduate" style="font-size: 160px; color: rgba(255,255,255,0.3);"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave -->
    <svg style="position: absolute; bottom: 0; left: 0; width: 100%; height: 80px;" viewBox="0 0 1440 80" preserveAspectRatio="none">
        <path fill="#ffffff" d="M0,32L48,37.3C96,43,192,53,288,58.7C384,64,480,64,576,56C672,48,768,32,864,29.3C960,27,1056,37,1152,42.7C1248,48,1344,48,1392,48L1440,48L1440,80L1392,80C1344,80,1248,80,1152,80C1056,80,960,80,864,80C768,80,672,80,576,80C480,80,384,80,288,80C192,80,96,80,48,80L0,80Z"></path>
    </svg>
</section>

<!-- News Section - More Natural -->
<section style="padding: 80px 0; background: white;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <span style="display: inline-block; padding: 8px 24px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; border-radius: 50px; font-size: 13px; font-weight: 700; letter-spacing: 1px; margin-bottom: 15px;">
                BERITA TERKINI
            </span>
            <h2 style="font-size: 42px; font-weight: 900; color: #0f172a; margin: 0; letter-spacing: -0.5px;">
                Informasi Terbaru
            </h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; margin-bottom: 50px;">
            @forelse($latestPosts->take(8) as $index => $post)
                <article style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; border: 1px solid #f1f5f9;">
                    <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: inherit; display: block;">
                        <div style="position: relative; height: 220px; overflow: hidden;">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, {{ ['#3b82f6', '#f59e0b', '#10b981', '#8b5cf6'][$index % 4] }}, {{ ['#60a5fa', '#fbbf24', '#34d399', '#a78bfa'][$index % 4] }}); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-newspaper" style="font-size: 50px; color: rgba(255,255,255,0.3);"></i>
                                </div>
                            @endif

                            <div style="position: absolute; top: 15px; left: 15px; background: white; padding: 10px 14px; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.15);">
                                <div style="font-size: 11px; color: #f59e0b; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1;">
                                    {{ $post->published_at->format('M') }}
                                </div>
                                <div style="font-size: 24px; font-weight: 900; color: #0f172a; line-height: 1;">
                                    {{ $post->published_at->format('d') }}
                                </div>
                            </div>
                        </div>

                        <div style="padding: 24px;">
                            <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 12px 0; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 48px;">
                                {{ $post->title }}
                            </h3>

                            @if($post->excerpt)
                                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.7; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 48px;">
                                    {{ Str::limit($post->excerpt, 90) }}
                                </p>
                            @endif

                            <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 16px; border-top: 1px solid #f1f5f9;">
                                <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #94a3b8;">
                                    <i class="fas fa-user"></i>
                                    <span>{{ $post->author->name }}</span>
                                </div>
                                <i class="fas fa-arrow-right" style="color: #3b82f6; font-size: 14px;"></i>
                            </div>
                        </div>
                    </a>
                </article>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 80px 20px;">
                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 120px; height: 120px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0); border-radius: 50%; margin-bottom: 24px;">
                        <i class="fas fa-newspaper" style="font-size: 50px; color: #cbd5e1;"></i>
                    </div>
                    <h3 style="font-size: 20px; font-weight: 700; color: #64748b; margin: 0 0 8px;">Belum Ada Berita</h3>
                    <p style="color: #94a3b8; font-size: 15px; margin: 0;">Berita akan segera hadir</p>
                </div>
            @endforelse
        </div>

        @if($latestPosts->count() > 0)
            <div style="text-align: center;">
                <a href="{{ route('blog.index') }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 16px 40px; background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 15px; letter-spacing: 0.5px; box-shadow: 0 8px 24px rgba(30, 64, 175, 0.25); transition: all 0.3s;">
                    ARSIP BERITA
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Info Banner -->
<section style="padding: 60px 0; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    <div class="container">
        <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); padding: 50px 60px; border-radius: 24px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 20px 60px rgba(30, 64, 175, 0.2); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%; filter: blur(60px);"></div>
            <div style="position: relative; z-index: 1; color: white; max-width: 70%;">
                <h3 style="font-size: 28px; font-weight: 800; margin: 0 0 10px 0; line-height: 1.3;">
                    Kunjungi Laman Informasi Penerimaan Mahasiswa Baru Tahun {{ date('Y') }}
                </h3>
                <p style="font-size: 15px; margin: 0; opacity: 0.9;">
                    Program Studi Sistem Informasi Universitas Bengkulu
                </p>
            </div>
            <a href="{{ route('contact.index') }}" style="position: relative; z-index: 1; padding: 18px 40px; background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; box-shadow: 0 8px 24px rgba(245, 158, 11, 0.3); transition: all 0.3s; white-space: nowrap;">
                Klik Disini
            </a>
        </div>
    </div>
</section>

<!-- Informasi Akademik -->
<section style="padding: 80px 0; background: white;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <span style="display: inline-block; padding: 8px 24px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; border-radius: 50px; font-size: 13px; font-weight: 700; letter-spacing: 1px; margin-bottom: 15px;">
                INFORMASI AKADEMIK
            </span>
            <h2 style="font-size: 42px; font-weight: 900; color: #0f172a; margin: 0; letter-spacing: -0.5px;">
                Serah Terima Mahasiswa Kerja Praktik
            </h2>
        </div>

        <div style="display: grid; grid-template-columns: 0.9fr 1.1fr; gap: 50px; align-items: center;">
            <div style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); padding: 60px; border-radius: 24px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
                <i class="fas fa-briefcase" style="font-size: 140px; color: #3b82f6; opacity: 0.12;"></i>
            </div>

            <div>
                <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0 0 20px 0; line-height: 1.4;">
                    Serah Terima Mahasiswa Kerja Praktik Program Studi Sistem Informasi Tahun {{ date('Y') }}
                </h3>
                <p style="font-size: 16px; line-height: 1.8; color: #475569; margin: 0 0 24px 0; text-align: justify;">
                    Bengkulu, 30 Juni {{ date('Y') }} — Program Studi Sistem Informasi Universitas kembali melepas mahasiswa untuk mengikuti
                    kegiatan Kerja Praktik (Magang) di berbagai instansi, sebagai bagian dari upaya peningkatan kompetensi dan pengalaman di dunia kerja.
                </p>
                <a href="{{ route('blog.index') }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 32px; background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 15px; box-shadow: 0 8px 24px rgba(245, 158, 11, 0.25); transition: all 0.3s;">
                    Baca Selengkapnya
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Video & Kenali SI -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; margin-bottom: 80px;">
            <div style="position: relative; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                <div style="padding-top: 56.25%; background: linear-gradient(135deg, #1e40af, #3b82f6); position: relative;">
                    <div style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white;">
                        <i class="fab fa-youtube" style="font-size: 80px; color: #ff0000; margin-bottom: 20px;"></i>
                        <div style="font-size: 20px; font-weight: 700; margin-bottom: 8px;">VIDEO PROFIL</div>
                        <div style="font-size: 14px; opacity: 0.9;">Program Studi Sistem Informasi</div>
                    </div>
                </div>
            </div>

            <div>
                <span style="display: inline-block; padding: 8px 24px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; border-radius: 50px; font-size: 13px; font-weight: 700; letter-spacing: 1px; margin-bottom: 15px;">
                    VIDEO PROFIL
                </span>
                <h2 style="font-size: 38px; font-weight: 900; color: #0f172a; margin: 0 0 20px 0; line-height: 1.3; letter-spacing: -0.5px;">
                    KENALI SISTEM INFORMASI LEBIH DEKAT!
                </h2>
                <p style="font-size: 16px; line-height: 1.8; color: #475569; margin: 0 0 28px 0;">
                    Tonton video profil kami untuk mengetahui lebih lanjut tentang program studi,
                    fasilitas, prestasi mahasiswa, dan peluang karir lulusan kami.
                </p>
                <a href="https://www.youtube.com" target="_blank" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 32px; background: #ff0000; color: white; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 15px; box-shadow: 0 8px 24px rgba(255, 0, 0, 0.25); transition: all 0.3s;">
                    <i class="fab fa-youtube"></i>
                    Tonton di YouTube
                </a>
            </div>
        </div>

        <!-- Prospek Karir -->
        <div style="text-align: center; margin-bottom: 50px;">
            <span style="display: inline-block; padding: 8px 24px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; border-radius: 50px; font-size: 13px; font-weight: 700; letter-spacing: 1px; margin-bottom: 15px;">
                PROSPEK KARIR
            </span>
            <h2 style="font-size: 42px; font-weight: 900; color: #0f172a; margin: 0; letter-spacing: -0.5px;">
                Peluang Karir Lulusan
            </h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px;">
            <div style="background: white; padding: 35px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-left: 5px solid #3b82f6; transition: all 0.3s;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6, #60a5fa); border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <i class="fas fa-laptop-code" style="font-size: 28px; color: white;"></i>
                </div>
                <h4 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 12px 0;">
                    1. Pengembang Sistem Informasi
                </h4>
                <p style="font-size: 14px; color: #64748b; margin: 0; line-height: 1.7;">
                    Lulusan mampu merancang, menguji, dan mengevaluasi sistem informasi dengan teknologi terkini.
                </p>
            </div>

            <div style="background: white; padding: 35px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-left: 5px solid #f59e0b; transition: all 0.3s;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b, #fbbf24); border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <i class="fas fa-rocket" style="font-size: 28px; color: white;"></i>
                </div>
                <h4 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 12px 0;">
                    2. Technopreneur
                </h4>
                <p style="font-size: 14px; color: #64748b; margin: 0; line-height: 1.7;">
                    Lulusan mampu menghasilkan inovasi bidang kewirausahaan berbasis teknologi informasi.
                </p>
            </div>

            <div style="background: white; padding: 35px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-left: 5px solid #10b981; transition: all 0.3s;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981, #34d399); border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <i class="fas fa-users-cog" style="font-size: 28px; color: white;"></i>
                </div>
                <h4 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 12px 0;">
                    3. Konsultan e-Business
                </h4>
                <p style="font-size: 14px; color: #64748b; margin: 0; line-height: 1.7;">
                    Lulusan mampu melakukan supervisi dan konsultasi solusi teknologi informasi enterprise.
                </p>
            </div>

            <div style="background: white; padding: 35px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-left: 5px solid #8b5cf6; transition: all 0.3s;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5cf6, #a78bfa); border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <i class="fas fa-graduation-cap" style="font-size: 28px; color: white;"></i>
                </div>
                <h4 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 12px 0;">
                    4. Akademisi SI
                </h4>
                <p style="font-size: 14px; color: #64748b; margin: 0; line-height: 1.7;">
                    Lulusan mampu menghasilkan karya ilmiah di bidang sistem informasi pada jenjang S2/S3.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="padding: 100px 0; background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%); position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; opacity: 0.1;">
        <div style="position: absolute; top: -20%; left: 10%; width: 400px; height: 400px; background: white; border-radius: 50%; filter: blur(100px);"></div>
        <div style="position: absolute; bottom: -20%; right: 10%; width: 500px; height: 500px; background: white; border-radius: 50%; filter: blur(120px);"></div>
    </div>

    <div class="container" style="position: relative; z-index: 2; text-align: center; color: white;">
        <h2 style="font-size: 48px; font-weight: 900; margin: 0 0 20px 0; letter-spacing: -0.5px;">
            Siap Bergabung Bersama Kami?
        </h2>
        <p style="font-size: 19px; margin: 0 0 40px 0; opacity: 0.95; max-width: 600px; margin-left: auto; margin-right: auto;">
            Daftar sekarang dan raih masa depan cemerlang di bidang Sistem Informasi
        </p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('contact.index') }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 45px; background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; box-shadow: 0 12px 32px rgba(245, 158, 11, 0.4); transition: all 0.3s;">
                <i class="fas fa-user-plus"></i>
                Daftar Sekarang
            </a>
            <a href="{{ route('page.show', 'about') }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 45px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border: 2px solid white; color: white; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; transition: all 0.3s;">
                <i class="fas fa-info-circle"></i>
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    article:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.12) !important;
    }

    article:hover img {
        transform: scale(1.08);
    }

    a[href]:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15) !important;
    }

    [style*="border-left: 5px"]:hover {
        transform: translateX(8px);
    }

    @media (max-width: 1024px) {
        [style*="grid-template-columns: repeat(auto-fill"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        [style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }

        h1 {
            font-size: 36px !important;
        }

        h2 {
            font-size: 28px !important;
        }
    }
</style>
@endpush
