@extends('layouts.frontend')

@section('content')
<!-- Hero Section - Modern Gradient with Animation -->
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #3b82f6 100%); padding: 100px 0; position: relative; overflow: hidden;">
    <!-- Animated Background Shapes -->
    <div class="hero-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 80px; align-items: center;">
            <div style="color: #fff;" data-aos="fade-right">
                <div style="display: inline-block; padding: 8px 20px; background: rgba(251, 191, 36, 0.2); backdrop-filter: blur(10px); border-radius: 50px; border: 1px solid rgba(251, 191, 36, 0.3); margin-bottom: 25px;">
                    <span style="font-size: 13px; font-weight: 700; color: #fbbf24; letter-spacing: 1px;">🎓 PROGRAM STUDI TERAKREDITASI</span>
                </div>

                <h1 style="font-size: 56px; font-weight: 900; margin: 0 0 25px 0; line-height: 1.1;">
                    {{ $homeSettings['home_hero_title'] ?? 'PROFIL' }} <br>
                    <span style="background: linear-gradient(to right, #fbbf24, #f97316); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">LULUSAN</span>
                </h1>

                <p style="font-size: 18px; line-height: 1.8; margin-bottom: 35px; color: rgba(255,255,255,0.9);">
                    {{ $homeSettings['home_hero_subtitle'] ?? 'Selamat datang di platform kami! Kami adalah program studi terkemuka yang menghasilkan lulusan berkualitas dengan kompetensi tinggi di bidangnya.' }}
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 35px;">
                    <div style="display: flex; align-items: center; gap: 15px; padding: 20px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.2);">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #fbbf24, #f97316); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                            💻
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Programming</div>
                            <div style="font-size: 13px; opacity: 0.8;">Software & Teknologi</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px; padding: 20px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.2);">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                            🏆
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Terakreditasi</div>
                            <div style="font-size: 13px; opacity: 0.8;">Unggul & Internasional</div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 15px; align-items: center;">
                    <a href="{{ route('contact.index') }}" style="padding: 16px 35px; background: linear-gradient(135deg, #fbbf24, #f97316); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; box-shadow: 0 8px 24px rgba(251, 191, 36, 0.4); transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px;" class="btn-hover">
                        <span>Daftar Sekarang</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>

                    <div style="display: flex; gap: 12px;">
                        <a href="#" style="width: 50px; height: 50px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" class="social-hover">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" style="width: 50px; height: 50px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" class="social-hover">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" style="width: 50px; height: 50px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" class="social-hover">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div style="position: relative;" data-aos="fade-left">
                <div style="width: 100%; aspect-ratio: 1; background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); border-radius: 30px; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255,255,255,0.2); box-shadow: 0 20px 60px rgba(0,0,0,0.3); position: relative; overflow: hidden;">
                    <!-- Decorative circles -->
                    <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: linear-gradient(135deg, #fbbf24, #f97316); border-radius: 50%; opacity: 0.2; filter: blur(40px);"></div>
                    <div style="position: absolute; bottom: -50px; left: -50px; width: 200px; height: 200px; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 50%; opacity: 0.2; filter: blur(40px);"></div>

                    <i class="fas fa-user-graduate" style="font-size: 180px; color: rgba(255,255,255,0.2); position: relative; z-index: 1;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terkini - Modern Slider -->
<section style="padding: 80px 0; background: linear-gradient(to bottom, #f8fafc, #ffffff); position: relative;">
    <div class="container">
        <!-- Dynamic Title & Subtitle -->
        <div style="text-align: center; margin-bottom: 60px;" data-aos="fade-up">
            <div style="margin-bottom: 20px;">
                <div style="display: inline-block; padding: 8px 20px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); border-radius: 50px;">
                    <span style="font-size: 13px; font-weight: 700; color: #1e40af; letter-spacing: 1px;">📰 INFORMASI TERKINI</span>
                </div>
            </div>
            
            <h2 style="font-size: 42px; font-weight: 900; color: #0f172a; margin: 0 0 20px 0;">
                {{ $homeSettings['home_news_title'] ?? 'BERITA TERKINI' }}
            </h2>
            
            <div style="width: 100px; height: 5px; background: linear-gradient(to right, #1e3a8a, #f97316); margin: 0 auto 25px; border-radius: 10px;"></div>
            
            @if(($homeSettings['home_news_show_subtitle'] ?? '1') == '1' && !empty($homeSettings['home_news_subtitle']))
                <p style="font-size: 17px; color: #64748b; margin: 0 auto; max-width: 650px; line-height: 1.7;">
                    {{ $homeSettings['home_news_subtitle'] }}
                </p>
            @endif
        </div>

        @if($latestPosts->count() > 0)
            <!-- News Slider Container -->
            <div style="position: relative; margin-bottom: 60px;" data-aos="fade-up" data-aos-delay="100">
                <div class="news-slider" style="position: relative; overflow: hidden; border-radius: 20px;">
                    <div class="news-slides" style="display: flex; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);">
                        @php
                            $chunks = $latestPosts->chunk(3);
                        @endphp

                        @foreach($chunks as $chunkIndex => $chunk)
                            <div class="news-slide" style="min-width: 100%; box-sizing: border-box; padding: 0 10px;">
                                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                                    @foreach($chunk as $post)
                                        <article class="news-card" style="background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; border: 1px solid #e5e7eb;" onclick="window.location='{{ route('blog.show', $post->slug) }}'">
                                            <!-- Image -->
                                            <div style="position: relative; height: 280px; overflow: hidden; background: linear-gradient(135deg, #f3f4f6, #e5e7eb);">
                                                @if($post->featured_image)
                                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;">
                                                @else
                                                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #3b82f6, #60a5fa); display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-newspaper" style="font-size: 70px; color: rgba(255,255,255,0.3);"></i>
                                                    </div>
                                                @endif

                                                <!-- Overlay gradient -->
                                                <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.4), transparent); opacity: 0; transition: opacity 0.4s;" class="card-overlay"></div>

                                                <!-- Date Badge -->
                                                <div style="position: absolute; top: 20px; right: 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 10px 14px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); text-align: center;">
                                                    <div style="font-size: 11px; color: #f97316; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                                                        {{ $post->published_at->format('M') }}
                                                    </div>
                                                    <div style="font-size: 24px; font-weight: 900; color: #1e293b; line-height: 1;">
                                                        {{ $post->published_at->format('d') }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Content -->
                                            <div style="padding: 28px;">
                                                <h3 style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 14px 0; line-height: 1.4; min-height: 52px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                    {{ $post->title }}
                                                </h3>

                                                @if($post->excerpt)
                                                    <p style="font-size: 14px; color: #64748b; margin: 0 0 20px 0; line-height: 1.7; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                        {{ $post->excerpt }}
                                                    </p>
                                                @endif

                                                <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 18px; border-top: 2px solid #f1f5f9;">
                                                    <div style="display: flex; align-items: center; gap: 10px; font-size: 13px; color: #94a3b8;">
                                                        <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 12px;">
                                                            {{ substr($post->author->name, 0, 1) }}
                                                        </div>
                                                        <span style="font-weight: 600;">{{ Str::limit($post->author->name, 18) }}</span>
                                                    </div>
                                                    <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #1e3a8a, #1e40af); display: flex; align-items: center; justify-content: center; transition: all 0.3s;" class="arrow-icon">
                                                        <i class="fas fa-arrow-right" style="color: #fff; font-size: 14px;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Dots -->
                <div class="slider-dots" style="display: flex; justify-content: center; gap: 12px; margin-top: 40px;">
                    @foreach($chunks as $index => $chunk)
                        <button class="slider-dot" data-slide="{{ $index }}" style="width: {{ $index === 0 ? '40px' : '12px' }}; height: 12px; border-radius: 10px; border: none; background: {{ $index === 0 ? 'linear-gradient(to right, #1e3a8a, #f97316)' : '#cbd5e1' }}; cursor: pointer; transition: all 0.4s;"></button>
                    @endforeach
                </div>
            </div>

            <div style="text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('blog.index') }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 16px 40px; background: linear-gradient(135deg, #1e3a8a, #1e40af); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; letter-spacing: 0.5px; box-shadow: 0 8px 24px rgba(30, 58, 138, 0.3); transition: all 0.3s;" class="btn-hover">
                    <span>ARSIP BERITA</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @else
            <div style="text-align: center; padding: 100px 20px; background: #fff; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <i class="fas fa-newspaper" style="font-size: 80px; color: #cbd5e1; margin-bottom: 25px;"></i>
                <p style="color: #94a3b8; font-size: 17px;">Belum ada berita tersedia</p>
            </div>
        @endif
    </div>
</section>

<!-- Info Banner PMB - Modern -->
<section style="padding: 40px 0; background: #fff;">
    <div class="container" data-aos="fade-up">
        <div style="background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); padding: 40px 50px; border-radius: 24px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 12px 40px rgba(30, 58, 138, 0.2); position: relative; overflow: hidden;">
            <!-- Decorative elements -->
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(251, 191, 36, 0.1); border-radius: 50%; filter: blur(40px);"></div>

            <div style="color: #fff; position: relative; z-index: 1;">
                <div style="display: inline-block; padding: 6px 16px; background: rgba(251, 191, 36, 0.2); border-radius: 50px; margin-bottom: 12px;">
                    <span style="font-size: 12px; font-weight: 700; color: #fbbf24; letter-spacing: 0.5px;">🎓 PENERIMAAN MAHASISWA BARU</span>
                </div>
                <h3 style="font-size: 24px; font-weight: 700; margin: 0 0 10px 0;">
                    Kunjungi Laman Informasi PMB Tahun {{ date('Y') }}
                </h3>
                <p style="font-size: 15px; margin: 0; opacity: 0.95;">Program Studi Sistem Informasi Universitas Bengkulu</p>
            </div>
            <a href="{{ route('contact.index') }}" style="padding: 16px 40px; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; white-space: nowrap; box-shadow: 0 8px 24px rgba(249, 115, 22, 0.4); transition: all 0.3s; position: relative; z-index: 1;" class="btn-hover">
                Klik Disini →
            </a>
        </div>
    </div>
</section>

<!-- Rest of sections with similar modern styling... -->
<!-- For brevity, I'll continue with key sections -->

<!-- CTA Section - Modern -->
<section style="padding: 100px 0; background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #3b82f6 100%); color: #fff; text-align: center; position: relative; overflow: hidden;">
    <!-- Animated shapes -->
    <div class="hero-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>

    <div class="container" style="position: relative; z-index: 2;" data-aos="zoom-in">
        <div style="display: inline-block; padding: 8px 20px; background: rgba(251, 191, 36, 0.2); backdrop-filter: blur(10px); border-radius: 50px; margin-bottom: 20px;">
            <span style="font-size: 13px; font-weight: 700; color: #fbbf24; letter-spacing: 1px;">🚀 BERGABUNGLAH DENGAN KAMI</span>
        </div>

        <h2 style="font-size: 48px; font-weight: 900; margin: 0 0 20px 0;">
            {{ $homeSettings['home_cta_title'] ?? 'Siap Bergabung Bersama Kami?' }}
        </h2>
        <p style="font-size: 19px; margin: 0 0 40px 0; opacity: 0.95; max-width: 700px; margin-left: auto; margin-right: auto;">
            {{ $homeSettings['home_cta_subtitle'] ?? 'Daftar sekarang dan raih masa depan cemerlang di bidang Sistem Informasi' }}
        </p>

        <div style="display: flex; gap: 20px; justify-content: center;">
            <a href="{{ route('contact.index') }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 45px; background: linear-gradient(135deg, #fbbf24, #f97316); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 17px; box-shadow: 0 12px 32px rgba(251, 191, 36, 0.4); transition: all 0.3s;" class="btn-hover">
                <i class="fas fa-user-plus"></i>
                <span>Daftar Sekarang</span>
            </a>
            <a href="{{ route('page.show', 'about') }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 45px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 17px; transition: all 0.3s;" class="btn-hover-outline">
                <i class="fas fa-info-circle"></i>
                <span>Pelajari Lebih Lanjut</span>
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
$(document).ready(function() {
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Slider functionality
    let currentSlide = 0;
    const slides = $('.news-slide');
    const dots = $('.slider-dot');
    const totalSlides = slides.length;

    function goToSlide(index) {
        currentSlide = index;
        $('.news-slides').css('transform', `translateX(-${currentSlide * 100}%)`);

        // Update dots
        dots.each(function(i) {
            if (i === currentSlide) {
                $(this).css({
                    'width': '40px',
                    'background': 'linear-gradient(to right, #1e3a8a, #f97316)'
                });
            } else {
                $(this).css({
                    'width': '12px',
                    'background': '#cbd5e1'
                });
            }
        });
    }

    dots.on('click', function() {
        goToSlide($(this).data('slide'));
    });

    // Auto slide
    setInterval(function() {
        currentSlide = (currentSlide + 1) % totalSlides;
        goToSlide(currentSlide);
    }, 5000);

    // Card hover effects
    $('.news-card').hover(
        function() {
            $(this).css({
                'transform': 'translateY(-12px)',
                'box-shadow': '0 20px 40px rgba(0,0,0,0.15)'
            });
            $(this).find('img').css('transform', 'scale(1.1)');
            $(this).find('.card-overlay').css('opacity', '1');
            $(this).find('.arrow-icon').css({
                'transform': 'translateX(4px)',
                'background': 'linear-gradient(135deg, #f97316, #ea580c)'
            });
        },
        function() {
            $(this).css({
                'transform': 'translateY(0)',
                'box-shadow': '0 4px 20px rgba(0,0,0,0.08)'
            });
            $(this).find('img').css('transform', 'scale(1)');
            $(this).find('.card-overlay').css('opacity', '0');
            $(this).find('.arrow-icon').css({
                'transform': 'translateX(0)',
                'background': 'linear-gradient(135deg, #1e3a8a, #1e40af)'
            });
        }
    );

    // Button hover effects
    $('.btn-hover').hover(
        function() {
            $(this).css({
                'transform': 'translateY(-2px)',
                'box-shadow': '0 12px 32px rgba(251, 191, 36, 0.5)'
            });
        },
        function() {
            $(this).css({
                'transform': 'translateY(0)',
                'box-shadow': '0 8px 24px rgba(251, 191, 36, 0.4)'
            });
        }
    );

    $('.btn-hover-outline').hover(
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.2)',
                'transform': 'translateY(-2px)'
            });
        },
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.1)',
                'transform': 'translateY(0)'
            });
        }
    );

    $('.social-hover').hover(
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.2)',
                'transform': 'translateY(-3px)'
            });
        },
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.1)',
                'transform': 'translateY(0)'
            });
        }
    );
});
</script>
@endpush

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    /* Animated background shapes */
    .hero-shapes {
        position: absolute;
        inset: 0;
        overflow: hidden;
        z-index: 1;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        animation: float 20s infinite ease-in-out;
    }

    .shape-1 {
        width: 400px;
        height: 400px;
        background: rgba(251, 191, 36, 0.15);
        top: -100px;
        right: -100px;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 300px;
        height: 300px;
        background: rgba(59, 130, 246, 0.15);
        bottom: -50px;
        left: -50px;
        animation-delay: 5s;
    }

    .shape-3 {
        width: 250px;
        height: 250px;
        background: rgba(249, 115, 22, 0.15);
        top: 50%;
        left: 50%;
        animation-delay: 10s;
    }

    @keyframes float {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        33% {
            transform: translate(50px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-50px, 50px) scale(0.9);
        }
    }

    /* Smooth transitions */
    * {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        [style*="grid-template-columns: repeat(3"] {
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
