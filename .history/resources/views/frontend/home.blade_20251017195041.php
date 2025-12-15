@extends('layouts.frontend')

@section('content')
<!-- Hero Section with Character Illustration -->
<section class="hero-section" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #1e40af 100%); min-height: 650px; position: relative; overflow: hidden;">
    <!-- Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    
    <!-- Decorative Elements -->
    <div style="position: absolute; top: 10%; right: 5%; width: 400px; height: 400px; background: rgba(245, 158, 11, 0.1); border-radius: 50%; filter: blur(80px);"></div>
    <div style="position: absolute; bottom: 10%; left: 5%; width: 300px; height: 300px; background: rgba(59, 130, 246, 0.2); border-radius: 50%; filter: blur(60px);"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; min-height: 650px; padding: 60px 0;">
            <!-- Left Content -->
            <div style="color: white;" data-aos="fade-right">
                <div style="display: inline-block; padding: 8px 20px; background: rgba(245, 158, 11, 0.2); border-radius: 30px; margin-bottom: 20px;">
                    <span style="font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">{{ $siteSettings['name'] }}</span>
                </div>
                
                <h1 style="font-size: 56px; font-weight: 900; line-height: 1.1; margin-bottom: 24px;">
                    PROFIL <span style="background: linear-gradient(to right, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">LULUSAN</span>
                </h1>
                
                <p style="font-size: 18px; line-height: 1.8; opacity: 0.95; margin-bottom: 32px;">
                    Selamat datang di platform kami! Kami adalah program studi terkemuka yang menghasilkan lulusan berkualitas dengan kompetensi tinggi di bidangnya.
                </p>

                <!-- Info Boxes -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 32px;">
                    <div style="display: flex; align-items: center; gap: 12px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 16px 20px; border-radius: 12px;">
                        <div style="width: 40px; height: 40px; background: #f59e0b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-code" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Programming</div>
                            <div style="font-size: 12px; opacity: 0.8;">Software & Web</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 12px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 16px 20px; border-radius: 12px;">
                        <div style="width: 40px; height: 40px; background: #f59e0b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-graduation-cap" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Terakreditasi</div>
                            <div style="font-size: 12px; opacity: 0.8;">Baik Sekali</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 12px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 16px 20px; border-radius: 12px;">
                        <div style="width: 40px; height: 40px; background: #f59e0b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-database" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Informatika</div>
                            <div style="font-size: 12px; opacity: 0.8;">Bidang Teknologi</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 12px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 16px 20px; border-radius: 12px;">
                        <div style="width: 40px; height: 40px; background: #f59e0b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-certificate" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Akreditasi</div>
                            <div style="font-size: 12px; opacity: 0.8;">Unggul & Internasional</div>
                        </div>
                    </div>
                </div>

                <div class="hero-buttons" style="display: flex; gap: 16px;">
                    <a href="{{ route('page.show', 'about') }}" class="btn btn-primary" style="font-size: 16px; padding: 14px 32px;">
                        <i class="fas fa-info-circle"></i> Tentang Kami
                    </a>
                    <a href="{{ route('contact.index') }}" class="btn btn-outline" style="font-size: 16px; padding: 14px 32px;">
                        <i class="fas fa-phone"></i> Hubungi Kami
                    </a>
                </div>

                <!-- Social Proof -->
                <div style="display: flex; gap: 12px; margin-top: 32px; font-size: 14px;">
                    <a href="#" style="color: white; opacity: 0.8; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" style="color: white; opacity: 0.8; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" style="color: white; opacity: 0.8; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" style="color: white; opacity: 0.8; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Right Illustration -->
            <div data-aos="fade-left">
                <div style="position: relative;">
                    <!-- Orange/Yellow Accent Shape -->
                    <div style="position: absolute; right: -50px; top: 50%; transform: translateY(-50%); width: 300px; height: 500px; background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); clip-path: polygon(30% 0%, 100% 0%, 100% 100%, 0% 100%); z-index: 1;"></div>
                    
                    <!-- Character Illustration Placeholder -->
                    <div style="position: relative; z-index: 2; text-align: center;">
                        <div style="width: 100%; max-width: 450px; margin: 0 auto; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 20px; padding: 40px; border: 2px solid rgba(255,255,255,0.2);">
                            <i class="fas fa-user-graduate" style="font-size: 200px; color: #f59e0b; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));"></i>
                            <h3 style="color: white; margin-top: 20px; font-size: 24px; font-weight: 700;">Lulusan Berkualitas</h3>
                            <p style="color: rgba(255,255,255,0.8); margin-top: 8px;">Siap Menghadapi Dunia Kerja</p>
                        </div>
                    </div>

                    <!-- Decorative Circles -->
                    <div style="position: absolute; top: 10%; left: 10%; width: 60px; height: 60px; background: #f59e0b; border-radius: 50%; opacity: 0.6; animation: float 3s ease-in-out infinite;"></div>
                    <div style="position: absolute; bottom: 15%; right: 15%; width: 40px; height: 40px; background: #fbbf24; border-radius: 50%; opacity: 0.6; animation: float 4s ease-in-out infinite;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Slider Dots -->
    @if($sliders->count() > 1)
    <div style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); display: flex; gap: 12px; z-index: 3;">
        @foreach($sliders as $index => $slider)
            <div style="width: {{ $index === 0 ? '40px' : '12px' }}; height: 12px; background: {{ $index === 0 ? '#f59e0b' : 'rgba(255,255,255,0.3)' }}; border-radius: 6px; transition: all 0.3s ease; cursor: pointer;"></div>
        @endforeach
    </div>
    @endif
</section>

<!-- Stats Section -->
<section style="background: white; padding: 0; margin-top: -60px; position: relative; z-index: 10;">
    <div class="container">
        <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); border-radius: 20px; box-shadow: 0 20px 50px rgba(0,0,0,0.15); padding: 48px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; text-align: center;">
                <div data-aos="zoom-in" data-aos-delay="0">
                    <div style="font-size: 56px; font-weight: 900; color: #f59e0b; margin-bottom: 8px;">
                        <span class="counter" data-target="500">0</span>+
                    </div>
                    <div style="font-size: 16px; color: white; font-weight: 600;">Mahasiswa Aktif</div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="100">
                    <div style="font-size: 56px; font-weight: 900; color: #f59e0b; margin-bottom: 8px;">
                        <span class="counter" data-target="1000">0</span>+
                    </div>
                    <div style="font-size: 16px; color: white; font-weight: 600;">Alumni Sukses</div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="200">
                    <div style="font-size: 56px; font-weight: 900; color: #f59e0b; margin-bottom: 8px;">
                        <span class="counter" data-target="25">0</span>+
                    </div>
                    <div style="font-size: 16px; color: white; font-weight: 600;">Dosen Profesional</div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="300">
                    <div style="font-size: 56px; font-weight: 900; color: #f59e0b; margin-bottom: 8px;">
                        <span class="counter" data-target="50">0</span>+
                    </div>
                    <div style="font-size: 16px; color: white; font-weight: 600;">Penghargaan</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section (Like UNIB) -->
<section class="section">
    <div class="container">
        <div style="text-align: center; margin-bottom: 48px;" data-aos="fade-up">
            <div style="display: inline-block; padding: 8px 20px; background: #eff6ff; color: #1e40af; border-radius: 30px; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px;">
                BERITA TERKINI
            </div>
            <h2 style="font-size: 42px; font-weight: 900; color: #1f2937; margin-bottom: 16px;">
                Informasi & <span style="color: #1e40af;">Berita</span> Terbaru
            </h2>
        </div>

        <!-- News Grid (3 Large Cards) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 32px;">
            @forelse($latestPosts->take(3) as $index => $post)
                <article data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.07); transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-12px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.07)'">
                    <!-- Large Image -->
                    <div style="position: relative; padding-top: 65%; overflow: hidden; background: #f3f4f6;">
                        @if($post->featured_image)
                            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                        @else
                            <img src="https://via.placeholder.com/600x400/3b82f6/ffffff?text={{ urlencode(substr($post->title, 0, 30)) }}" alt="{{ $post->title }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                        @endif
                        
                        <!-- Date Badge -->
                        <div style="position: absolute; top: 20px; left: 20px; background: #1e40af; color: white; padding: 12px 16px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); text-align: center;">
                            <div style="font-size: 32px; font-weight: 900; line-height: 1;">{{ $post->created_at->format('d') }}</div>
                            <div style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">{{ $post->created_at->format('M') }}</div>
                        </div>

                        @if($post->category)
                            <div style="position: absolute; top: 20px; right: 20px; background: #f59e0b; color: white; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                                {{ $post->category->name }}
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div style="padding: 28px;">
                        <h3 style="font-size: 22px; font-weight: 800; line-height: 1.3; margin-bottom: 12px; color: #1f2937;">
                            <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#1e40af'" onmouseout="this.style.color='#1f2937'">
                                {{ $post->title }}
                            </a>
                        </h3>
                        
                        @if($post->excerpt)
                            <p style="color: #6b7280; line-height: 1.7; margin-bottom: 20px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $post->excerpt }}
                            </p>
                        @endif

                        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                            <div style="display: flex; align-items: center; gap: 8px; color: #6b7280; font-size: 14px;">
                                <i class="fas fa-user"></i>
                                <span>{{ $post->author->name }}</span>
                            </div>
                            <a href="{{ route('blog.show', $post->slug) }}" style="display: flex; align-items: center; gap: 6px; color: #1e40af; font-weight: 700; font-size: 14px; text-decoration: none; transition: gap 0.3s;" onmouseover="this.style.gap='10px'" onmouseout="this.style.gap='6px'">
                                Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 80px 20px;">
                    <i class="fas fa-newspaper" style="font-size: 100px; color: #e5e7eb; margin-bottom: 24px;"></i>
                    <h3 style="font-size: 24px; font-weight: 700; color: #6b7280; margin-bottom: 12px;">Belum Ada Berita</h3>
                    <p style="color: #9ca3af; margin-bottom: 24px;">Berita dan artikel akan segera hadir</p>
                </div>
            @endforelse
        </div>

        @if($latestPosts->count() > 0)
            <div style="text-align: center; margin-top: 48px;" data-aos="fade-up">
                <a href="{{ route('blog.index') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; background: #1e40af; color: white; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 16px; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(30, 64, 175, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(30, 64, 175, 0.3)'">
                    ARSIP BERITA <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Team/Dosen Section -->
@if($services->count() > 0)
<section class="section" style="background: #f9fafb;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 48px;" data-aos="fade-up">
            <div style="display: inline-block; padding: 8px 20px; background: #eff6ff; color: #1e40af; border-radius: 30px; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px;">
                DOSEN SISTEM INFORMASI
            </div>
            <h2 style="font-size: 42px; font-weight: 900; color: #1f2937; margin-bottom: 16px;">
                Tenaga <span style="color: #1e40af;">Pengajar</span> Profesional
            </h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 32px;">
            @foreach($services->take(4) as $index => $service)
                <div data-aos="flip-left" data-aos-delay="{{ $index * 100 }}" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 16px; overflow: hidden; text-align: center; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.15); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)'">
                    <!-- Profile Photo -->
                    <div style="padding: 32px 32px 0;">
                        @if($service->image)
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 5px solid white; box-shadow: 0 8px 20px rgba(0,0,0,0.2); margin: 0 auto;">
                        @else
                            <div style="width: 150px; height: 150px; border-radius: 50%; background: rgba(255,255,255,0.2); border: 5px solid white; display: flex; align-items: center; justify-content: center; margin: 0 auto; box-shadow: 0 8px 20px rgba(0,0,0,0.2);">
                                <i class="fas fa-user" style="font-size: 60px; color: white;"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Info -->
                    <div style="padding: 24px 32px 32px; color: white;">
                        <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 4px;">{{ $service->title }}</h3>
                        @if($service->description)
                            <p style="font-size: 14px; opacity: 0.9; margin-bottom: 16px;">{{ Str::limit($service->description, 80) }}</p>
                        @endif
                        <div style="font-size: 13px; opacity: 0.8;">S.T., M.Kom.</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Video Profile Section -->
<section class="section">
    <div class="container">
        <div style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 24px; padding: 64px; box-shadow: 0 20px 50px rgba(0,0,0,0.15); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(245, 158, 11, 0.1); border-radius: 50%; filter: blur(60px);"></div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                <div data-aos="fade-right" style="color: white;">
                    <div style="display: inline-block; padding: 8px 20px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 30px; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">
                        VIDEO PROFIL
                    </div>
                    <h2 style="font-size: 42px; font-weight: 900; margin-bottom: 20px; line-height: 1.2;">
                        Kenali <span style="color: #f59e0b;">Sistem Informasi</span> Lebih Dekat!
                    </h2>
                    <p style="font-size: 18px; line-height: 1.8; opacity: 0.95; margin-bottom: 32px;">
                        Tonton video profil kami untuk mengetahui lebih lanjut tentang program studi, fasilitas, dan prestasi yang telah kami raih.
                    </p>
                    <a href="https://www.youtube.com" target="_blank" style="display: inline-flex; align-items: center; gap: 12px; padding: 14px 32px; background: #f59e0b; color: white; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 16px; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(245, 158, 11, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.4)'">
                        <i class="fab fa-youtube"></i> Tonton di YouTube
                    </a>
                </div>

                <div data-aos="fade-left" style="position: relative;">
                    <div style="position: relative; padding-top: 56.25%; background: rgba(0,0,0,0.2); border-radius: 16px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.3);">
                        <!-- YouTube Embed Placeholder -->
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, rgba(30, 58, 138, 0.9), rgba(59, 130, 246, 0.9));">
                            <div style="text-align: center;">
                                <i class="fab fa-youtube" style="font-size: 80px; color: #ff0000; margin-bottom: 16px;"></i>
                                <div style="color: white; font-size: 18px; font-weight: 700;">Video Profil</div>
                                <div style="color: rgba(255,255,255,0.8); font-size: 14px; margin-top: 8px;">Fakultas Teknik - Prodi Sistem Informasi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <div style="text-align: center; color: white; max-width: 800px; margin: 0 auto;" data-aos="zoom-in">
            <div style="display: inline-block; padding: 8px 20px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 30px; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px;">
                BERGABUNGLAH BERSAMA KAMI
            </div>
            <h2 style="font-size: 48px; font-weight: 900; margin-bottom: 24px; line-height: 1.2;">
                Siap Menjadi Bagian dari <span style="color: #f59e0b;">Lulusan Terbaik</span>?
            </h2>
            <p style="font-size: 20px; line-height: 1.8; opacity: 0.95; margin-bottom: 40px;">
                Daftar sekarang dan raih masa depan cemerlang bersama kami. Kami siap membimbing Anda menuju kesuksesan!
            </p>
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('contact.index') }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: #f59e0b; color: white; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 18px; box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 30px rgba(245, 158, 11, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 20px rgba(245, 158, 11, 0.4)'">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </a>
                <a href="{{ route('page.show', 'about') }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 2px solid white; color: white; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 18px; transition: all 0.3s ease;" onmouseover="this.style.background='white'; this.style.color='#1e40af'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.color='white'">
                    <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    @media (max-width: 768px) {
        .hero-section > .container > div {
            grid-template-columns: 1fr !important;
            gap: 40px !important;
        }
        
        .hero-section h1 {
            font-size: 36px !important;
        }
        
        section h2 {
            font-size: 32px !important;
        }
        
        .section {
            padding: 60px 0 !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Animated Counter
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const inc = target / speed;

        if (count < target) {
            counter.innerText = Math.ceil(count + inc);
            setTimeout(() => animateCounter(counter), 1);
        } else {
            counter.innerText = target;
        }
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                if (!counter.classList.contains('animated')) {
                    counter.classList.add('animated');
                    animateCounter(counter);
                }
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => {
        observer.observe(counter);
    });
</script>
@endpush
