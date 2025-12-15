@extends('layouts.frontend')

@section('content')
<!-- Hero Section - EXACT UNIB Style (NO WAVE!) -->
<section style="background: linear-gradient(to right, #1e3a8a, #2563eb); padding: 60px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div style="color: #fff;">
                <h1 style="font-size: 48px; font-weight: 700; margin: 0 0 20px 0; line-height: 1.2;">
                    PROFIL <span style="color: #fbbf24;">LULUSAN</span>
                </h1>
                <p style="font-size: 16px; line-height: 1.8; margin-bottom: 30px;">
                    Selamat datang di platform kami! Kami adalah program studi terkemuka yang menghasilkan lulusan berkualitas
                    dengan kompetensi tinggi di bidangnya, siap menghadapi tantangan dunia kerja dan berkontribusi bagi masyarakat.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle" style="color: #fbbf24; font-size: 20px;"></i>
                        <div>
                            <div style="font-weight: 700; font-size: 14px;">Programming</div>
                            <div style="font-size: 12px; opacity: 0.9;">Software & Teknologi</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle" style="color: #fbbf24; font-size: 20px;"></i>
                        <div>
                            <div style="font-weight: 700; font-size: 14px;">Terakreditasi</div>
                            <div style="font-size: 12px; opacity: 0.9;">Unggul & Internasional</div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 10px;">
                    <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none;">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div style="text-align: center;">
                <div style="width: 350px; height: 350px; margin: 0 auto; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-graduate" style="font-size: 150px; color: rgba(255,255,255,0.3);"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terkini - EXACT UNIB Grid -->
<section style="padding: 50px 0; background: #f9fafb;">
    <div class="container">
        <h2 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0 0 30px 0; text-align: center;">BERITA TERKINI</h2>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px;">
            @forelse($latestPosts->take(8) as $post)
                <article style="background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s;">
                    <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: inherit; display: block;">
                        <div style="position: relative; height: 180px; overflow: hidden; background: #e5e7eb;">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; background: #3b82f6; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="font-size: 50px; color: rgba(255,255,255,0.3);"></i>
                                </div>
                            @endif

                            <div style="position: absolute; top: 10px; left: 10px; background: #fff; padding: 8px 12px; border-radius: 5px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); text-align: center; min-width: 50px;">
                                <div style="font-size: 10px; color: #f97316; font-weight: 700; text-transform: uppercase;">
                                    {{ $post->published_at->format('M') }}
                                </div>
                                <div style="font-size: 20px; font-weight: 700; color: #1e293b; line-height: 1;">
                                    {{ $post->published_at->format('d') }}
                                </div>
                            </div>
                        </div>

                        <div style="padding: 15px;">
                            <h3 style="font-size: 14px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 40px;">
                                {{ $post->title }}
                            </h3>

                            @if($post->excerpt)
                                <p style="font-size: 12px; color: #64748b; margin: 0 0 10px 0; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ Str::limit($post->excerpt, 80) }}
                                </p>
                            @endif

                            <div style="font-size: 11px; color: #94a3b8;">
                                <i class="fas fa-user"></i> {{ $post->author->name }}
                            </div>
                        </div>
                    </a>
                </article>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
                    <p style="color: #94a3b8;">Belum ada berita tersedia</p>
                </div>
            @endforelse
        </div>

        @if($latestPosts->count() > 0)
            <div style="text-align: center;">
                <a href="{{ route('blog.index') }}" style="display: inline-block; padding: 10px 30px; background: #1e3a8a; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 14px;">
                    ARSIP BERITA >>>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Info Banner PMB -->
<section style="padding: 30px 0; background: #fff;">
    <div class="container">
        <div style="background: #1e3a8a; padding: 25px 30px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div style="color: #fff;">
                <h3 style="font-size: 20px; font-weight: 700; margin: 0 0 5px 0;">
                    Kunjungi Laman Informasi Penerimaan Mahasiswa Baru Tahun {{ date('Y') }}
                </h3>
                <p style="font-size: 13px; margin: 0;">Program Studi Sistem Informasi Universitas Bengkulu</p>
            </div>
            <a href="{{ route('contact.index') }}" style="padding: 12px 30px; background: #f97316; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; white-space: nowrap;">
                Klik Disini
            </a>
        </div>
    </div>
</section>

<!-- Informasi Akademik -->
<section style="padding: 50px 0; background: #f9fafb;">
    <div class="container">
        <h2 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0 0 30px 0; text-align: center;">Informasi Akademik</h2>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div style="background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-briefcase" style="font-size: 120px; color: #1e3a8a; opacity: 0.15;"></i>
            </div>

            <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 15px 0;">
                    Serah Terima Mahasiswa Kerja Praktik Program Studi Sistem Informasi Tahun {{ date('Y') }}
                </h3>
                <p style="font-size: 14px; line-height: 1.7; color: #475569; margin: 0 0 20px 0; text-align: justify;">
                    Bengkulu, 30 Juni {{ date('Y') }} — Program Studi Sistem Informasi Universitas Bengkulu kembali melepas mahasiswa untuk mengikuti
                    kegiatan Kerja Praktik (Magang) di berbagai instansi, sebagai bagian dari upaya peningkatan kompetensi dan pengalaman di dunia kerja.
                    Salah satu lokasi penempatan tahun ini adalah Dinas Komunikasi, Informatika, dan Statistik (Diskominfotik) Provinsi Bengkulu.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- IKATAN ALUMNI ILUSI -->
<section style="padding: 50px 0; background: #fff;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; align-items: center;">
            <div>
                <div style="display: inline-block; padding: 5px 15px; background: #dbeafe; color: #1e40af; border-radius: 5px; font-size: 11px; font-weight: 700; margin-bottom: 10px;">
                    IKATAN ALUMNI SISTEM INFORMASI (ILUSI)
                </div>
                <h2 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0 0 15px 0;">Informasi Akademik</h2>
                <p style="font-size: 14px; line-height: 1.7; color: #475569; margin: 0 0 15px 0; text-align: justify;">
                    Ikatan Alumni Sistem Informasi adalah wadah bagi para lulusan untuk tetap terhubung, berbagi pengalaman,
                    dan memberikan kontribusi bagi perkembangan program studi.
                </p>
                <ul style="font-size: 14px; line-height: 1.8; color: #475569; margin: 0 0 20px 20px;">
                    <li>Visiting Lecture: Peluang dan Tantangan AI di Sistem Informasi</li>
                    <li>Pelatihan Keterampilan Public Speaking bagi Mahasiswa SI</li>
                    <li>General Lecture Hadirkan Pembicara Internasional</li>
                </ul>
                <a href="{{ route('blog.index') }}" style="display: inline-block; padding: 10px 25px; background: #1e3a8a; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 14px;">
                    Lihat Semua
                </a>
            </div>

            <div style="background: linear-gradient(135deg, #1e3a8a, #2563eb); padding: 50px; border-radius: 8px; text-align: center; color: #fff;">
                <i class="fas fa-users" style="font-size: 80px; margin-bottom: 15px; opacity: 0.9;"></i>
                <h3 style="font-size: 20px; font-weight: 700; margin: 0;">IKATAN ALUMNI<br>SISTEM INFORMASI</h3>
            </div>
        </div>
    </div>
</section>

<!-- Dosen -->
@if($services->count() > 0)
<section style="padding: 50px 0; background: #f9fafb;">
    <div class="container">
        <h2 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0 0 30px 0; text-align: center;">DOSEN SISTEM INFORMASI</h2>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
            @foreach($services->take(4) as $service)
                <div style="background: linear-gradient(135deg, #1e3a8a, #2563eb); padding: 25px 20px; border-radius: 8px; text-align: center; box-shadow: 0 4px 12px rgba(30, 58, 138, 0.2);">
                    <div style="width: 90px; height: 90px; border-radius: 50%; border: 3px solid #fff; margin: 0 auto 15px; overflow: hidden; background: #fff;">
                        @if($service->image)
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: #e5e7eb; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 35px;">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <h4 style="font-size: 14px; font-weight: 700; color: #fff; margin: 0 0 3px 0;">{{ $service->title }}</h4>
                    <p style="font-size: 12px; color: rgba(255,255,255,0.9); margin: 0;">S.T., M.Kom.</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Video -->
<section style="padding: 50px 0; background: #fff;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; align-items: center;">
            <div style="position: relative; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                <div style="padding-top: 56.25%; background: linear-gradient(135deg, #1e3a8a, #2563eb); position: relative;">
                    <div style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #fff;">
                        <i class="fab fa-youtube" style="font-size: 60px; color: #ff0000; margin-bottom: 15px;"></i>
                        <div style="font-size: 16px; font-weight: 700;">VIDEO PROFIL</div>
                        <div style="font-size: 12px; opacity: 0.9;">Program Studi Sistem Informasi</div>
                    </div>
                </div>
            </div>

            <div>
                <h2 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0 0 15px 0;">
                    KENALI<br>SISTEM INFORMASI<br>LEBIH DEKAT!
                </h2>
                <p style="font-size: 14px; line-height: 1.7; color: #475569; margin: 0 0 20px 0;">
                    Tonton video profil kami untuk mengetahui lebih lanjut tentang program studi,
                    fasilitas, prestasi mahasiswa, dan peluang karir lulusan kami.
                </p>
                <a href="https://www.youtube.com" target="_blank" style="display: inline-block; padding: 10px 25px; background: #f97316; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 14px;">
                    <i class="fab fa-youtube"></i> Tonton di YouTube
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Info Program Studi -->
<section style="padding: 50px 0; background: #f9fafb;">
    <div class="container">
        <h2 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0 0 30px 0; text-align: center;">Informasi Program Studi</h2>

        <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px;">
            <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 15px 0;">Apa itu Sistem Informasi?</h3>
                <p style="font-size: 14px; line-height: 1.7; color: #475569; margin: 0 0 15px 0; text-align: justify;">
                    Disiplin ilmu <strong>Sistem Informasi</strong> adalah sebuah disiplin ilmu yang mempelajari berbagai aspek
                    saat Teknologi Informasi bertemu dan berinteraksi dengan Sistem Sosial (Organisasi, Bisnis, Masyarakat).
                </p>

                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 20px 0 10px;">Prospek Karir Sistem Informasi:</h4>

                <div style="font-size: 14px; line-height: 1.8; color: #475569;">
                    <p style="margin: 0 0 10px 0;"><strong>1. Pengembang Sistem Informasi (IS Developer)</strong><br>
                    Lulusan mampu merancang, menguji, mengevaluasi sistem informasi.</p>

                    <p style="margin: 0 0 10px 0;"><strong>2. Wirausahawan Berbasis Teknologi (Technopreneur)</strong><br>
                    Lulusan mampu menghasilkan inovasi bidang kewirausahaan berbasis TI.</p>

                    <p style="margin: 0 0 10px 0;"><strong>3. Konsultan & Integrator e-Business</strong><br>
                    Lulusan mampu melakukan supervisi dan konsultasi solusi TI.</p>

                    <p style="margin: 0;"><strong>4. Akademisi SI (IS Academician)</strong><br>
                    Lulusan mampu menghasilkan karya ilmiah di bidang sistem informasi.</p>
                </div>
            </div>

            <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;">
                <i class="fas fa-laptop-code" style="font-size: 100px; color: #1e3a8a; opacity: 0.15; margin-bottom: 20px;"></i>
                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0;">
                    Kenapa Harus Memilih Sistem Informasi?
                </h4>
                <p style="font-size: 13px; color: #475569; line-height: 1.6;">
                    Program studi Sistem Informasi telah <strong>terakreditasi Baik Sekali</strong> oleh BAN-PT
                    dan <strong>terakreditasi internasional ACQUIN</strong>.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Persyaratan Masuk -->
<section style="padding: 50px 0; background: #fff;">
    <div class="container">
        <h2 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0 0 30px 0; text-align: center;">Persyaratan Masuk</h2>

        <div style="max-width: 800px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div style="background: #f9fafb; padding: 25px; border-radius: 8px; border-left: 4px solid #1e3a8a;">
                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0;">
                    <i class="fas fa-check-circle" style="color: #1e3a8a;"></i> Lulusan SMA/MA
                </h4>
                <ul style="font-size: 13px; color: #475569; line-height: 1.8; margin: 0; padding-left: 20px;">
                    <li>Jurusan IPA</li>
                    <li>Jurusan IPS</li>
                </ul>
            </div>

            <div style="background: #f9fafb; padding: 25px; border-radius: 8px; border-left: 4px solid #f97316;">
                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0;">
                    <i class="fas fa-check-circle" style="color: #f97316;"></i> Lulusan SMK
                </h4>
                <ul style="font-size: 13px; color: #475569; line-height: 1.8; margin: 0; padding-left: 20px;">
                    <li>Teknik Komputer</li>
                    <li>Teknik Informatika</li>
                    <li>Rekayasa Perangkat Lunak</li>
                    <li>Jurusan lain yang relevan</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni -->
@if($testimonials->count() > 0)
<section style="padding: 50px 0; background: #f9fafb;">
    <div class="container">
        <h2 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0 0 30px 0; text-align: center;">Apa Kata Alumni Kami</h2>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            @foreach($testimonials->take(3) as $testimonial)
                <div style="background: #fff; padding: 25px; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <div style="width: 80px; height: 80px; border-radius: 50%; border: 3px solid #1e3a8a; margin: 0 auto 15px; overflow: hidden; background: #1e3a8a;">
                        @if($testimonial->image)
                            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 28px; font-weight: 700;">
                                {{ substr($testimonial->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <p style="font-size: 13px; font-style: italic; color: #475569; line-height: 1.6; margin: 0 0 15px 0;">
                        "{{ Str::limit($testimonial->content, 120) }}"
                    </p>

                    <h4 style="font-size: 14px; font-weight: 700; color: #1e293b; margin: 0 0 3px 0;">{{ $testimonial->name }}</h4>
                    <p style="font-size: 12px; color: #94a3b8; margin: 0;">Alumni - Sistem Informasi</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA -->
<section style="padding: 60px 0; background: linear-gradient(to right, #1e3a8a, #2563eb); color: #fff; text-align: center;">
    <div class="container">
        <h2 style="font-size: 32px; font-weight: 700; margin: 0 0 15px 0;">Siap Bergabung Bersama Kami?</h2>
        <p style="font-size: 16px; margin: 0 0 25px 0;">
            Daftar sekarang dan raih masa depan cemerlang di bidang Sistem Informasi
        </p>
        <div style="display: flex; gap: 15px; justify-content: center;">
            <a href="{{ route('contact.index') }}" style="display: inline-block; padding: 12px 35px; background: #f97316; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 15px;">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </a>
            <a href="{{ route('page.show', 'about') }}" style="display: inline-block; padding: 12px 35px; background: transparent; border: 2px solid #fff; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 700; font-size: 15px;">
                <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    article:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    }

    article:hover img {
        transform: scale(1.05);
    }

    @media (max-width: 1024px) {
        [style*="grid-template-columns: repeat(4"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        [style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush
