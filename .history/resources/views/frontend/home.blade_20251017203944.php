@extends('layouts.frontend')

@section('content')
<!-- Hero Section - UNIB Style -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content-wrapper">
            <div class="hero-text">
                <h1>PROFIL <span>LULUSAN</span></h1>
                <p>
                    Selamat datang di platform kami! Kami adalah program studi terkemuka yang menghasilkan lulusan berkualitas
                    dengan kompetensi tinggi di bidangnya, siap menghadapi tantangan dunia kerja dan berkontribusi bagi masyarakat.
                </p>

                <div class="hero-features">
                    <div class="hero-feature">
                        <i class="fas fa-check-circle"></i>
                        <div class="hero-feature-text">
                            <h4>Programming</h4>
                            <p>Software & Teknologi</p>
                        </div>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-check-circle"></i>
                        <div class="hero-feature-text">
                            <h4>Terakreditasi</h4>
                            <p>Unggul & Internasional</p>
                        </div>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-check-circle"></i>
                        <div class="hero-feature-text">
                            <h4>Informatika</h4>
                            <p>Bidang Teknologi</p>
                        </div>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-check-circle"></i>
                        <div class="hero-feature-text">
                            <h4>Akreditasi</h4>
                            <p>Sistem Informasi</p>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 10px; font-size: 20px; margin-top: 20px;">
                    @if($socialLinks['facebook'])
                        <a href="{{ $socialLinks['facebook'] }}" style="color: #fff; opacity: 0.8;" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($socialLinks['twitter'])
                        <a href="{{ $socialLinks['twitter'] }}" style="color: #fff; opacity: 0.8;" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if($socialLinks['instagram'])
                        <a href="{{ $socialLinks['instagram'] }}" style="color: #fff; opacity: 0.8;" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                </div>
            </div>

            <div class="hero-illustration">
                <div class="hero-illustration-shape"></div>
                <div class="hero-illustration-content">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section - UNIB Style -->
<section class="section" style="background: #f9fafb;">
    <div class="container">
        <div class="section-header">
            <div class="section-label">BERITA TERKINI</div>
            <h2 class="section-title">Informasi Terbaru</h2>
        </div>

        <div class="news-grid">
            @forelse($latestPosts->take(6) as $post)
                <article class="news-card">
                    <div class="news-image">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x300/1e3a8a/ffffff?text={{ urlencode(substr($post->title, 0, 20)) }}" alt="{{ $post->title }}">
                        @endif

                        <div class="news-date">
                            <span class="news-date-day">{{ $post->published_at->format('d') }}</span>
                            <span class="news-date-month">{{ $post->published_at->format('M') }}</span>
                        </div>
                    </div>

                    <div class="news-content">
                        <h3 class="news-title">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>

                        @if($post->excerpt)
                            <p class="news-excerpt">{{ Str::limit($post->excerpt, 120) }}</p>
                        @endif

                        <div class="news-meta">
                            <i class="fas fa-user"></i> {{ $post->author->name }}
                        </div>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
                    <p style="color: #999; font-size: 16px;">Belum ada berita tersedia</p>
                </div>
            @endforelse
        </div>

        @if($latestPosts->count() > 0)
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('blog.index') }}" style="display: inline-block; padding: 12px 30px; background: #1e3a8a; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 14px; text-transform: uppercase;">
                    ARSIP BERITA >>>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Info Banner -->
<section class="section" style="background: #fff; padding: 40px 0;">
    <div class="container">
        <div style="background: #1e3a8a; padding: 30px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div style="color: #fff;">
                <h3 style="font-size: 24px; font-weight: 700; margin-bottom: 5px;">Kunjungi Laman Informasi Penerimaan Mahasiswa Baru Tahun {{ date('Y') }}</h3>
                <p style="font-size: 14px; margin: 0; opacity: 0.9;">Program Studi {{ $siteSettings['name'] }}</p>
            </div>
            <a href="{{ route('contact.index') }}" style="padding: 12px 30px; background: #f97316; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; white-space: nowrap;">
                Klik Disini
            </a>
        </div>
    </div>
</section>

<!-- Informasi Akademik Section -->
<section class="section" style="background: #f9fafb;">
    <div class="container">
        <div class="section-header">
            <div class="section-label">INFORMASI AKADEMIK</div>
            <h2 class="section-title">Serah Terima Mahasiswa Kerja Praktik</h2>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <!-- Left: Image/Icon -->
            <div style="background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;">
                <i class="fas fa-file-alt" style="font-size: 120px; color: #1e3a8a; opacity: 0.2;"></i>
            </div>

            <!-- Right: Content -->
            <div style="background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 22px; font-weight: 700; color: #1e3a8a; margin-bottom: 15px;">
                    Serah Terima Mahasiswa Kerja Praktik Program Studi Sistem Informasi Tahun {{ date('Y') }}
                </h3>
                <p style="font-size: 15px; line-height: 1.8; color: #666; margin-bottom: 20px; text-align: justify;">
                    Bengkulu, 30 Juni {{ date('Y') }} — Program Studi Sistem Informasi Universitas kembali melepas mahasiswa untuk mengikuti
                    kegiatan Kerja Praktik (Magang) di berbagai instansi, sebagai bagian dari upaya peningkatan kompetensi dan pengalaman di dunia kerja.
                </p>
                <a href="{{ route('blog.index') }}" style="display: inline-block; padding: 10px 25px; background: #f97316; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 14px;">
                    Baca Selengkapnya
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Ikatan Alumni Section -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
            <!-- Left: Content -->
            <div>
                <div class="section-label" style="margin-bottom: 15px;">IKATAN ALUMNI SISTEM INFORMASI (ILUSI)</div>
                <h2 style="font-size: 28px; font-weight: 900; color: #1e3a8a; margin-bottom: 20px;">
                    Informasi Akademik
                </h2>
                <p style="font-size: 15px; line-height: 1.8; color: #666; margin-bottom: 15px; text-align: justify;">
                    Ikatan Alumni Sistem Informasi adalah wadah bagi para lulusan untuk tetap terhubung, berbagi pengalaman,
                    dan memberikan kontribusi bagi perkembangan program studi.
                </p>
                <ul style="font-size: 15px; line-height: 2; color: #666; margin: 20px 0 20px 20px;">
                    <li>Visiting Lecture: Peluang dan Tantangan AI di Sistem Informasi</li>
                    <li>Pelatihan Keterampilan Public Speaking bagi Mahasiswa SI</li>
                    <li>General Lecture Hadirkan Pembicara Internasional</li>
                </ul>
                <a href="{{ route('blog.index') }}" style="display: inline-block; padding: 12px 30px; background: #1e3a8a; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 14px;">
                    Lihat Semua
                </a>
            </div>

            <!-- Right: Image -->
            <div style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); padding: 60px 40px; border-radius: 8px; text-align: center; color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                <i class="fas fa-users" style="font-size: 100px; margin-bottom: 20px; opacity: 0.9;"></i>
                <h3 style="font-size: 24px; font-weight: 700; margin-bottom: 10px;">IKATAN ALUMNI</h3>
                <p style="font-size: 16px; opacity: 0.9;">SISTEM INFORMASI</p>
            </div>
        </div>
    </div>
</section>

<!-- Team/Dosen Section - UNIB Style -->
@if($services->count() > 0)
<section class="section" style="background: #f9fafb;">
    <div class="container">
        <div class="section-header">
            <div class="section-label">DOSEN SISTEM INFORMASI</div>
            <h2 class="section-title">Tenaga Pengajar</h2>
        </div>

        <div class="team-grid">
            @foreach($services->take(4) as $service)
                <div class="team-card">
                    <div class="team-photo">
                        @if($service->image)
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                        @else
                            <div class="team-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <div class="team-name">{{ $service->title }}</div>
                    <div class="team-title">S.T., M.Kom.</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Video Section -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
            <div>
                <div style="position: relative; padding-top: 56.25%; background: #000; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, rgba(30, 58, 138, 0.9), rgba(37, 99, 235, 0.9));">
                        <div style="text-align: center; color: #fff;">
                            <i class="fab fa-youtube" style="font-size: 60px; color: #ff0000; margin-bottom: 15px;"></i>
                            <div style="font-size: 16px; font-weight: 700;">VIDEO PROFIL</div>
                            <div style="font-size: 13px; margin-top: 5px; opacity: 0.9;">Program Studi {{ $siteSettings['name'] }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div style="background: #f9fafb; padding: 40px; border-radius: 8px; border-left: 4px solid #f97316;">
                    <h3 style="font-size: 28px; font-weight: 900; color: #1e3a8a; margin-bottom: 20px;">
                        KENALI SISTEM INFORMASI LEBIH DEKAT!
                    </h3>
                    <p style="font-size: 15px; line-height: 1.8; color: #666; margin-bottom: 20px;">
                        Tonton video profil kami untuk mengetahui lebih lanjut tentang program studi,
                        fasilitas, prestasi mahasiswa, dan peluang karir lulusan kami.
                    </p>
                    <a href="https://www.youtube.com" target="_blank" style="display: inline-block; padding: 12px 25px; background: #f97316; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 14px;">
                        <i class="fab fa-youtube"></i> Tonton di YouTube
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Program Studi -->
<section class="section" style="background: #f9fafb;">
    <div class="container">
        <div class="section-header">
            <div class="section-label">INFORMASI PROGRAM STUDI</div>
            <h2 class="section-title">Apa itu Sistem Informasi?</h2>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
            <div>
                <p style="font-size: 15px; line-height: 1.8; color: #666; margin-bottom: 20px; text-align: justify;">
                    Disiplin ilmu <strong>Sistem Informasi</strong> adalah sebuah disiplin ilmu yang mempelajari berbagai aspek
                    saat Teknologi Informasi bertemu dan berinteraksi dengan Sistem Sosial (Organisasi, Bisnis, Masyarakat).
                </p>
                <p style="font-size: 15px; line-height: 1.8; color: #666; margin-bottom: 20px; text-align: justify;">
                    Mahasiswa Program Studi Sistem Informasi mempelajari berbagai aspek dari disiplin ilmu Sistem Informasi
                    yang mencakup PERENCANAAN, PERANCANGAN, PEMBANGUNAN, OPERASIONAL, dan EVALUASI Sistem Informasi.
                </p>

                <h4 style="font-size: 18px; font-weight: 700; color: #1e3a8a; margin: 25px 0 15px;">Prospek Karir Sistem Informasi:</h4>
                <ul style="font-size: 15px; line-height: 2; color: #666; margin-left: 20px;">
                    <li><strong>1. Pengembang Sistem Informasi (IS Developer)</strong><br>
                        <span style="font-size: 14px;">Lulusan mampu merancang, menguji, mengevaluasi sistem informasi.</span>
                    </li>
                    <li><strong>2. Wirausahawan Berbasis Teknologi (Technopreneur)</strong><br>
                        <span style="font-size: 14px;">Lulusan mampu menghasilkan inovasi bidang kewirausahaan berbasis TI.</span>
                    </li>
                    <li><strong>3. Konsultan & Integrator e-Business</strong><br>
                        <span style="font-size: 14px;">Lulusan mampu melakukan supervisi dan konsultasi solusi TI.</span>
                    </li>
                    <li><strong>4. Akademisi SI (IS Academician)</strong><br>
                        <span style="font-size: 14px;">Lulusan mampu menghasilkan karya ilmiah di bidang sistem informasi.</span>
                    </li>
                </ul>
            </div>

            <div style="text-align: center;">
                <div style="background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <i class="fas fa-laptop-code" style="font-size: 120px; color: #1e3a8a; opacity: 0.2; margin-bottom: 20px;"></i>
                    <h4 style="font-size: 20px; font-weight: 700; color: #1e3a8a; margin-bottom: 10px;">Kenapa Harus Memilih Sistem Informasi?</h4>
                    <p style="font-size: 14px; color: #666; line-height: 1.6;">
                        Program studi Sistem Informasi telah <strong>terakreditasi Baik Sekali</strong> oleh BAN-PT
                        dan <strong>terakreditasi internasional ACQUIN</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Persyaratan Masuk -->
<section class="section" style="background: #fff;">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto; text-align: center;">
            <div class="section-label" style="margin-bottom: 15px;">PERSYARATAN MASUK</div>
            <h2 style="font-size: 32px; font-weight: 900; color: #1e3a8a; margin-bottom: 30px;">
                Persyaratan Pendaftaran
            </h2>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; text-align: left; margin-top: 30px;">
                <div style="background: #f9fafb; padding: 25px; border-radius: 8px; border-left: 4px solid #1e3a8a;">
                    <h4 style="font-size: 18px; font-weight: 700; color: #1e3a8a; margin-bottom: 15px;">
                        <i class="fas fa-check-circle" style="color: #f97316;"></i> Lulusan SMA/MA
                    </h4>
                    <ul style="font-size: 14px; color: #666; line-height: 1.8; margin-left: 20px;">
                        <li>Jurusan IPA</li>
                        <li>Jurusan IPS</li>
                    </ul>
                </div>

                <div style="background: #f9fafb; padding: 25px; border-radius: 8px; border-left: 4px solid #f97316;">
                    <h4 style="font-size: 18px; font-weight: 700; color: #1e3a8a; margin-bottom: 15px;">
                        <i class="fas fa-check-circle" style="color: #f97316;"></i> Lulusan SMK
                    </h4>
                    <ul style="font-size: 14px; color: #666; line-height: 1.8; margin-left: 20px;">
                        <li>Teknik Komputer</li>
                        <li>Teknik Informatika</li>
                        <li>Rekayasa Perangkat Lunak</li>
                        <li>Jurusan lain yang relevan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni Alumni -->
@if($testimonials->count() > 0)
<section class="section" style="background: #f9fafb;">
    <div class="container">
        <div class="section-header">
            <div class="section-label">TESTIMONI</div>
            <h2 class="section-title">Apa Kata Alumni Kami</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            @foreach($testimonials->take(3) as $testimonial)
                <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; border: 4px solid #1e3a8a; margin: 0 auto 20px; overflow: hidden;">
                        @if($testimonial->image)
                            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: #1e3a8a; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 28px; font-weight: 700;">
                                {{ substr($testimonial->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <p style="font-size: 14px; font-style: italic; color: #666; line-height: 1.8; margin-bottom: 20px; text-align: justify;">
                        "{{ $testimonial->content }}"
                    </p>

                    <h4 style="font-size: 16px; font-weight: 700; color: #1e3a8a; margin-bottom: 5px;">{{ $testimonial->name }}</h4>
                    @if($testimonial->position || $testimonial->company)
                        <p style="font-size: 13px; color: #999;">
                            @if($testimonial->position){{ $testimonial->position }}@endif
                            @if($testimonial->position && $testimonial->company) - @endif
                            @if($testimonial->company){{ $testimonial->company }}@endif
                        </p>
                    @else
                        <p style="font-size: 13px; color: #999;">ALUMNI - {{ $siteSettings['name'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); color: #fff; text-align: center;">
    <div class="container">
        <h2 style="font-size: 36px; font-weight: 900; margin-bottom: 15px;">Siap Bergabung Bersama Kami?</h2>
        <p style="font-size: 16px; margin-bottom: 30px; opacity: 0.95;">
            Daftar sekarang dan raih masa depan cemerlang di bidang Sistem Informasi
        </p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('contact.index') }}" style="display: inline-block; padding: 15px 40px; background: #f97316; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </a>
            <a href="{{ route('page.show', 'about') }}" style="display: inline-block; padding: 15px 40px; background: transparent; border: 2px solid #fff; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 16px;">
                <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    @media (max-width: 768px) {
        .hero-content-wrapper,
        .news-grid,
        .team-grid,
        section > .container > div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }

        .hero-text h1 {
            font-size: 32px !important;
        }
    }
</style>
@endpush
