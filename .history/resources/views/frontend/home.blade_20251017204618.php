@extends('layouts.frontend')

@section('content')
<!-- Hero Section - UNIB Exact Style -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 80px 0; position: relative; overflow: hidden;">
    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <!-- Left Content -->
            <div style="color: #fff;">
                <h1 style="font-size: 48px; font-weight: 900; margin-bottom: 20px; line-height: 1.2;">
                    PROFIL <span style="color: #fbbf24;">LULUSAN</span>
                </h1>
                <p style="font-size: 16px; line-height: 1.8; margin-bottom: 30px; color: rgba(255,255,255,0.95);">
                    Selamat datang di platform kami! Kami adalah program studi terkemuka yang menghasilkan lulusan berkualitas
                    dengan kompetensi tinggi di bidangnya, siap menghadapi tantangan dunia kerja dan berkontribusi bagi masyarakat.
                </p>

                <!-- Features Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px;">
                    <div style="display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fas fa-check-circle" style="color: #fbbf24; font-size: 20px; margin-top: 2px;"></i>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Programming</div>
                            <div style="font-size: 13px; opacity: 0.9;">Software & Teknologi</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fas fa-check-circle" style="color: #fbbf24; font-size: 20px; margin-top: 2px;"></i>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Terakreditasi</div>
                            <div style="font-size: 13px; opacity: 0.9;">Unggul & Internasional</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fas fa-check-circle" style="color: #fbbf24; font-size: 20px; margin-top: 2px;"></i>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Informatika</div>
                            <div style="font-size: 13px; opacity: 0.9;">Bidang Teknologi</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fas fa-check-circle" style="color: #fbbf24; font-size: 20px; margin-top: 2px;"></i>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Akreditasi</div>
                            <div style="font-size: 13px; opacity: 0.9;">Sistem Informasi</div>
                        </div>
                    </div>
                </div>

                <!-- Social -->
                <div style="display: flex; gap: 12px; font-size: 18px;">
                    <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: all 0.3s;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: all 0.3s;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: all 0.3s;">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: all 0.3s;">
                        <i class="fab fa-telegram"></i>
                    </a>
                </div>
            </div>

            <!-- Right Illustration -->
            <div style="text-align: center;">
                <div style="width: 400px; height: 400px; margin: 0 auto; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px);">
                    <i class="fas fa-user-graduate" style="font-size: 180px; color: rgba(255,255,255,0.3);"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative Wave -->
    <div style="position: absolute; bottom: 0; left: 0; width: 100%; overflow: hidden; line-height: 0;">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: 100%; height: 60px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#fff"></path>
        </svg>
    </div>
</section>

<!-- Berita Terkini Section - UNIB Exact Style -->
<section style="padding: 60px 0; background: #f8fafc;">
    <div class="container">
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 50px;">
            <div style="display: inline-block; padding: 6px 20px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 15px;">
                BERITA TERKINI
            </div>
            <h2 style="font-size: 36px; font-weight: 900; color: #1e293b; margin: 0;">Informasi Terbaru</h2>
        </div>

        <!-- News Grid - 4 columns -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; margin-bottom: 40px;">
            @forelse($latestPosts->take(8) as $post)
                <article style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: all 0.3s; cursor: pointer;">
                    <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: inherit; display: block;">
                        <!-- Image -->
                        <div style="position: relative; height: 200px; overflow: hidden; background: #e2e8f0;">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1e3a8a, #3b82f6); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 60px;">
                                    <i class="fas fa-image" style="opacity: 0.3;"></i>
                                </div>
                            @endif

                            <!-- Date Badge -->
                            <div style="position: absolute; top: 12px; left: 12px; background: #fff; padding: 8px 12px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); text-align: center;">
                                <div style="font-size: 11px; color: #f97316; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $post->published_at->format('M') }}
                                </div>
                                <div style="font-size: 22px; font-weight: 900; color: #1e293b; line-height: 1;">
                                    {{ $post->published_at->format('d') }}
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div style="padding: 20px;">
                            <h3 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $post->title }}
                            </h3>

                            @if($post->excerpt)
                                <p style="font-size: 13px; color: #64748b; margin: 0 0 15px 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ Str::limit($post->excerpt, 100) }}
                                </p>
                            @endif

                            <div style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #94a3b8;">
                                <i class="fas fa-user"></i>
                                <span>{{ $post->author->name }}</span>
                            </div>
                        </div>
                    </a>
                </article>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
                    <i class="fas fa-newspaper" style="font-size: 60px; color: #cbd5e1; margin-bottom: 15px;"></i>
                    <p style="color: #94a3b8; font-size: 16px;">Belum ada berita tersedia</p>
                </div>
            @endforelse
        </div>

        <!-- Arsip Button -->
        @if($latestPosts->count() > 0)
            <div style="text-align: center;">
                <a href="{{ route('blog.index') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 35px; background: #1e3a8a; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s; box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);">
                    ARSIP BERITA
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Info Banner PMB -->
<section style="padding: 40px 0; background: #fff;">
    <div class="container">
        <div style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); padding: 35px 40px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 8px 24px rgba(30, 58, 138, 0.2);">
            <div style="color: #fff;">
                <h3 style="font-size: 24px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3;">
                    Kunjungi Laman Informasi Penerimaan Mahasiswa Baru Tahun {{ date('Y') }}
                </h3>
                <p style="font-size: 14px; margin: 0; opacity: 0.95;">
                    Program Studi {{ $siteSettings['name'] ?? 'Sistem Informasi' }}
                </p>
            </div>
            <a href="{{ route('contact.index') }}" style="padding: 14px 35px; background: #f97316; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 15px; white-space: nowrap; transition: all 0.3s; box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);">
                Klik Disini
            </a>
        </div>
    </div>
</section>

<!-- Informasi Akademik -->
<section style="padding: 60px 0; background: #f8fafc;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 50px;">
            <div style="display: inline-block; padding: 6px 20px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 15px;">
                INFORMASI AKADEMIK
            </div>
            <h2 style="font-size: 36px; font-weight: 900; color: #1e293b; margin: 0;">Serah Terima Mahasiswa Kerja Praktik</h2>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <div style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-file-alt" style="font-size: 140px; color: #1e3a8a; opacity: 0.15;"></i>
            </div>

            <div style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 18px 0; line-height: 1.4;">
                    Serah Terima Mahasiswa Kerja Praktik Program Studi Sistem Informasi Tahun {{ date('Y') }}
                </h3>
                <p style="font-size: 15px; line-height: 1.8; color: #64748b; margin: 0 0 20px 0; text-align: justify;">
                    Bengkulu, 30 Juni {{ date('Y') }} — Program Studi Sistem Informasi Universitas kembali melepas mahasiswa untuk mengikuti
                    kegiatan Kerja Praktik (Magang) di berbagai instansi, sebagai bagian dari upaya peningkatan kompetensi dan pengalaman di dunia kerja.
                </p>
                <a href="{{ route('blog.index') }}" style="display: inline-block; padding: 12px 28px; background: #f97316; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 14px; transition: all 0.3s;">
                    Baca Selengkapnya
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Dosen Section -->
@if($services->count() > 0)
<section style="padding: 60px 0; background: #fff;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 50px;">
            <div style="display: inline-block; padding: 6px 20px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 15px;">
                DOSEN SISTEM INFORMASI
            </div>
            <h2 style="font-size: 36px; font-weight: 900; color: #1e293b; margin: 0;">Tenaga Pengajar</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px;">
            @foreach($services->take(4) as $service)
                <div style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 30px 20px; border-radius: 12px; text-align: center; box-shadow: 0 4px 12px rgba(30, 58, 138, 0.2);">
                    <div style="width: 100px; height: 100px; border-radius: 50%; border: 4px solid #fff; margin: 0 auto 20px; overflow: hidden; background: #fff;">
                        @if($service->image)
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 40px;">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #fff; margin: 0 0 5px 0;">{{ $service->title }}</h4>
                    <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin: 0;">S.T., M.Kom.</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Video Section -->
<section style="padding: 60px 0; background: #f8fafc;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
            <div style="position: relative; padding-top: 56.25%; background: #000; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.15);">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, rgba(30, 58, 138, 0.95), rgba(59, 130, 246, 0.95));">
                    <div style="text-align: center; color: #fff;">
                        <i class="fab fa-youtube" style="font-size: 70px; color: #ff0000; margin-bottom: 20px;"></i>
                        <div style="font-size: 18px; font-weight: 700;">VIDEO PROFIL</div>
                        <div style="font-size: 14px; margin-top: 8px; opacity: 0.95;">Program Studi Sistem Informasi</div>
                    </div>
                </div>
            </div>

            <div>
                <div style="display: inline-block; padding: 6px 20px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 15px;">
                    VIDEO
                </div>
                <h2 style="font-size: 32px; font-weight: 900; color: #1e293b; margin: 0 0 20px 0; line-height: 1.3;">
                    KENALI SISTEM INFORMASI LEBIH DEKAT!
                </h2>
                <p style="font-size: 15px; line-height: 1.8; color: #64748b; margin: 0 0 25px 0;">
                    Tonton video profil kami untuk mengetahui lebih lanjut tentang program studi,
                    fasilitas, prestasi mahasiswa, dan peluang karir lulusan kami.
                </p>
                <a href="https://www.youtube.com" target="_blank" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 28px; background: #f97316; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 14px; transition: all 0.3s;">
                    <i class="fab fa-youtube"></i>
                    Tonton di YouTube
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Info Program Studi -->
<section style="padding: 60px 0; background: #fff;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 50px;">
            <div style="display: inline-block; padding: 6px 20px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 15px;">
                INFORMASI PROGRAM STUDI
            </div>
            <h2 style="font-size: 36px; font-weight: 900; color: #1e293b; margin: 0;">Apa itu Sistem Informasi?</h2>
        </div>

        <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 40px; align-items: start;">
            <div style="background: #f8fafc; padding: 40px; border-radius: 12px;">
                <p style="font-size: 15px; line-height: 1.8; color: #475569; margin: 0 0 20px 0; text-align: justify;">
                    Disiplin ilmu <strong style="color: #1e293b;">Sistem Informasi</strong> adalah sebuah disiplin ilmu yang mempelajari berbagai aspek
                    saat Teknologi Informasi bertemu dan berinteraksi dengan Sistem Sosial (Organisasi, Bisnis, Masyarakat).
                </p>

                <h4 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 25px 0 15px;">Prospek Karir Sistem Informasi:</h4>

                <div style="display: flex; flex-direction: column; gap: 18px;">
                    <div style="padding: 18px; background: #fff; border-radius: 8px; border-left: 4px solid #1e3a8a;">
                        <h5 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0;">
                            1. Pengembang Sistem Informasi (IS Developer)
                        </h5>
                        <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.6;">
                            Lulusan mampu merancang, menguji, mengevaluasi sistem informasi.
                        </p>
                    </div>

                    <div style="padding: 18px; background: #fff; border-radius: 8px; border-left: 4px solid #f97316;">
                        <h5 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0;">
                            2. Wirausahawan Berbasis Teknologi (Technopreneur)
                        </h5>
                        <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.6;">
                            Lulusan mampu menghasilkan inovasi bidang kewirausahaan berbasis TI.
                        </p>
                    </div>

                    <div style="padding: 18px; background: #fff; border-radius: 8px; border-left: 4px solid #1e3a8a;">
                        <h5 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0;">
                            3. Konsultan & Integrator e-Business
                        </h5>
                        <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.6;">
                            Lulusan mampu melakukan supervisi dan konsultasi solusi TI.
                        </p>
                    </div>

                    <div style="padding: 18px; background: #fff; border-radius: 8px; border-left: 4px solid #f97316;">
                        <h5 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0;">
                            4. Akademisi SI (IS Academician)
                        </h5>
                        <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.6;">
                            Lulusan mampu menghasilkan karya ilmiah di bidang sistem informasi.
                        </p>
                    </div>
                </div>
            </div>

            <div style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); text-align: center;">
                <i class="fas fa-laptop-code" style="font-size: 100px; color: #1e3a8a; opacity: 0.2; margin-bottom: 25px;"></i>
                <h4 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 15px 0; line-height: 1.3;">
                    Kenapa Harus Memilih Sistem Informasi?
                </h4>
                <p style="font-size: 14px; color: #64748b; line-height: 1.7; margin: 0;">
                    Program studi Sistem Informasi telah <strong style="color: #1e293b;">terakreditasi Baik Sekali</strong> oleh BAN-PT
                    dan <strong style="color: #1e293b;">terakreditasi internasional ACQUIN</strong>.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Persyaratan Masuk -->
<section style="padding: 60px 0; background: #f8fafc;">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 40px;">
                <div style="display: inline-block; padding: 6px 20px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 15px;">
                    PERSYARATAN MASUK
                </div>
                <h2 style="font-size: 36px; font-weight: 900; color: #1e293b; margin: 0;">Persyaratan Pendaftaran</h2>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-top: 4px solid #1e3a8a;">
                    <h4 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 15px 0; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle" style="color: #1e3a8a;"></i>
                        Lulusan SMA/MA
                    </h4>
                    <ul style="font-size: 14px; color: #64748b; line-height: 2; margin: 0; padding-left: 20px;">
                        <li>Jurusan IPA</li>
                        <li>Jurusan IPS</li>
                    </ul>
                </div>

                <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-top: 4px solid #f97316;">
                    <h4 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 15px 0; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle" style="color: #f97316;"></i>
                        Lulusan SMK
                    </h4>
                    <ul style="font-size: 14px; color: #64748b; line-height: 2; margin: 0; padding-left: 20px;">
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
<section style="padding: 60px 0; background: #fff;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 50px;">
            <div style="display: inline-block; padding: 6px 20px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 15px;">
                TESTIMONI
            </div>
            <h2 style="font-size: 36px; font-weight: 900; color: #1e293b; margin: 0;">Apa Kata Alumni Kami</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px;">
            @foreach($testimonials->take(3) as $testimonial)
                <div style="background: #f8fafc; padding: 35px 30px; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    <div style="width: 90px; height: 90px; border-radius: 50%; border: 4px solid #1e3a8a; margin: 0 auto 20px; overflow: hidden; background: #fff;">
                        @if($testimonial->image)
                            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1e3a8a, #3b82f6); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 32px; font-weight: 700;">
                                {{ substr($testimonial->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <p style="font-size: 14px; font-style: italic; color: #64748b; line-height: 1.8; margin: 0 0 20px 0; text-align: center;">
                        "{{ Str::limit($testimonial->content, 150) }}"
                    </p>

                    <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0 0 5px 0;">{{ $testimonial->name }}</h4>
                    <p style="font-size: 13px; color: #94a3b8; margin: 0;">
                        @if($testimonial->position){{ $testimonial->position }}@else Alumni @endif
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: #fff; text-align: center; position: relative; overflow: hidden;">
    <div class="container" style="position: relative; z-index: 2;">
        <h2 style="font-size: 42px; font-weight: 900; margin: 0 0 18px 0;">Siap Bergabung Bersama Kami?</h2>
        <p style="font-size: 18px; margin: 0 0 35px 0; opacity: 0.95;">
            Daftar sekarang dan raih masa depan cemerlang di bidang Sistem Informasi
        </p>
        <div style="display: flex; gap: 18px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('contact.index') }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: #f97316; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 16px; box-shadow: 0 8px 24px rgba(249, 115, 22, 0.4); transition: all 0.3s;">
                <i class="fas fa-user-plus"></i>
                Daftar Sekarang
            </a>
            <a href="{{ route('page.show', 'about') }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: transparent; border: 2px solid #fff; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 16px; transition: all 0.3s;">
                <i class="fas fa-info-circle"></i>
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>

    <!-- Decorative circles -->
    <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
    <div style="position: absolute; bottom: -100px; left: -100px; width: 400px; height: 400px; border-radius: 50%; background: rgba(255,255,255,0.05);"></div>
</section>
@endsection

@push('styles')
<style>
    /* Hover Effects */
    article:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
    }

    article:hover img {
        transform: scale(1.05);
    }

    a[style*="background: #1e3a8a"]:hover,
    a[style*="background: #f97316"]:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    a[style*="border: 2px solid #fff"]:hover {
        background: rgba(255,255,255,0.1);
    }

    @media (max-width: 1024px) {
        section > div > div[style*="grid-template-columns: repeat(4"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        section > div > div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }

        h1[style*="font-size: 48px"] {
            font-size: 32px !important;
        }

        h2[style*="font-size: 36px"] {
            font-size: 28px !important;
        }
    }
</style>
@endpush
