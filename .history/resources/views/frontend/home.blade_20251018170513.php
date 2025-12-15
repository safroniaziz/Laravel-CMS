@extends('layouts.frontend')

@section('content')
<!-- Hero Slider - SPECTACULAR Full Height -->
<section style="position: relative; overflow: hidden; margin: 0; padding: 0;">
    @if($sliders->count() > 0)
        <div class="hero-slider" style="position: relative;">
            <div class="hero-slides" style="display: flex; transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);">
                @foreach($sliders as $index => $slider)
                    <div class="hero-slide" style="min-width: 100%; height: calc(100vh - 80px); background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 40%, #3b82f6 100%); position: relative; display: flex; align-items: center;">
                        <!-- Animated Background Shapes -->
                        <div style="position: absolute; inset: 0; overflow: hidden; pointer-events: none;">
                            <div style="position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(251, 191, 36, 0.15) 0%, transparent 70%); top: -200px; {{ $slider->image_position === 'left' ? 'left: -200px;' : 'right: -200px;' }} border-radius: 50%; animation: pulse 4s ease-in-out infinite;"></div>
                            <div style="position: absolute; width: 300px; height: 300px; background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%); bottom: -100px; {{ $slider->image_position === 'left' ? 'right: 10%;' : 'left: 10%;' }} border-radius: 50%; animation: pulse 6s ease-in-out infinite 1s;"></div>
                        </div>

                        <div class="container" style="position: relative; z-index: 2; width: 100%;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; {{ $slider->image_position === 'left' ? 'direction: rtl;' : '' }}">
                                <!-- Content Side -->
                                <div style="color: #fff; {{ $slider->image_position === 'left' ? 'direction: ltr;' : '' }}" data-aos="fade-{{ $slider->image_position === 'left' ? 'left' : 'right' }}" data-aos-duration="1000">
                                    @if($slider->subtitle)
                                        <div style="display: inline-flex; align-items: center; gap: 10px; padding: 10px 24px; background: linear-gradient(135deg, rgba(251, 191, 36, 0.25), rgba(249, 115, 22, 0.25)); backdrop-filter: blur(10px); border-radius: 50px; border: 2px solid rgba(251, 191, 36, 0.4); margin-bottom: 25px; box-shadow: 0 4px 16px rgba(251, 191, 36, 0.2);">
                                            <div style="width: 8px; height: 8px; background: #fbbf24; border-radius: 50%; box-shadow: 0 0 10px #fbbf24;"></div>
                                            <span style="font-size: 13px; font-weight: 700; background: linear-gradient(to right, #fbbf24, #f97316); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: 1.5px;">{{ strtoupper($slider->subtitle) }}</span>
                                        </div>
                                    @endif

                                    <h1 style="font-size: 56px; font-weight: 900; margin: 0 0 25px 0; line-height: 1.1; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                                        @php
                                            $words = explode(' ', $slider->title);
                                            $lastWord = array_pop($words);
                                            $restWords = implode(' ', $words);
                                        @endphp
                                        @if($restWords)
                                            {{ $restWords }}
                                            <span style="background: linear-gradient(135deg, #fbbf24, #f97316); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">{{ $lastWord }}</span>
                                        @else
                                            {{ $slider->title }}
                                        @endif
                                    </h1>

                                    @if($slider->description)
                                        <p style="font-size: 18px; line-height: 1.8; margin-bottom: 35px; color: rgba(255,255,255,0.9); text-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                                            {{ $slider->description }}
                                        </p>
                                    @endif

                                    @if($slider->button_text && $slider->button_link)
                                        <div style="display: flex; gap: 15px; align-items: center;">
                                            <a href="{{ $slider->button_link }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 40px; background: linear-gradient(135deg, #fbbf24, #f97316); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 17px; box-shadow: 0 10px 30px rgba(251, 191, 36, 0.5); transition: all 0.3s; position: relative; overflow: hidden;" class="cta-button">
                                                <span style="position: relative; z-index: 1;">{{ $slider->button_text }}</span>
                                                <i class="fas fa-arrow-right" style="position: relative; z-index: 1; transition: transform 0.3s;"></i>
                                                <div style="position: absolute; inset: 0; background: linear-gradient(135deg, #f97316, #ea580c); opacity: 0; transition: opacity 0.3s;"></div>
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <!-- Image Side with Decorations -->
                                <div style="{{ $slider->image_position === 'left' ? 'direction: ltr;' : '' }}; height: calc(70vh - 60px); display: flex; align-items: center;" data-aos="fade-{{ $slider->image_position === 'left' ? 'right' : 'left' }}" data-aos-duration="1000" data-aos-delay="200">
                                    <div style="position: relative; width: 100%; height: 100%;">
                                        <!-- Decorative Background Card -->
                                        <div style="position: absolute; inset: -20px; background: linear-gradient(135deg, rgba(251, 191, 36, 0.1), rgba(249, 115, 22, 0.1)); border-radius: 30px; transform: rotate(-2deg); z-index: 0;"></div>

                                        @if($slider->image)
                                            <div style="position: relative; width: 100%; height: 100%; border-radius: 24px; overflow: hidden; box-shadow: 0 25px 70px rgba(0,0,0,0.5); transform: rotate(0deg); transition: transform 0.5s; z-index: 1;" class="hero-image">
                                                <img src="{{ $slider->image }}" alt="{{ $slider->title }}" style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; transition: transform 0.5s;">

                                                <!-- Gradient Overlay -->
                                                <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(30, 58, 138, 0.15), rgba(249, 115, 22, 0.15)); pointer-events: none;"></div>

                                                <!-- Shine Effect -->
                                                <div style="position: absolute; top: 0; left: -100%; width: 50%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); animation: shine 3s ease-in-out infinite;"></div>
                                            </div>
                                        @else
                                            <div style="position: relative; width: 100%; height: 100%; background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); border-radius: 24px; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255,255,255,0.2); box-shadow: 0 25px 70px rgba(0,0,0,0.5); z-index: 1;">
                                                <i class="fas fa-image" style="font-size: 120px; color: rgba(255,255,255,0.3);"></i>
                                            </div>
                                        @endif

                                        <!-- Floating Badge -->
                                        <div style="position: absolute; {{ $slider->image_position === 'left' ? 'left: -20px;' : 'right: -20px;' }} bottom: 40px; background: #fff; padding: 20px 25px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); z-index: 2;" data-aos="zoom-in" data-aos-delay="600">
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #fbbf24, #f97316); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-star" style="color: #fff; font-size: 24px;"></i>
                                                </div>
                                                <div>
                                                    <div style="font-size: 20px; font-weight: 900; color: #1e3a8a; line-height: 1;">UNGGUL</div>
                                                    <div style="font-size: 12px; color: #64748b; margin-top: 2px;">Terakreditasi</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Arrows -->
            @if($sliders->count() > 1)
                <button class="hero-prev" style="position: absolute; left: 30px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); border-radius: 50%; color: #fff; font-size: 20px; cursor: pointer; transition: all 0.3s; z-index: 10; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="hero-next" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); border-radius: 50%; color: #fff; font-size: 20px; cursor: pointer; transition: all 0.3s; z-index: 10; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Dots Indicator -->
                <div class="hero-dots" style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); display: flex; gap: 12px; z-index: 10;">
                    @foreach($sliders as $index => $slider)
                        <button class="hero-dot" data-slide="{{ $index }}" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #fff; background: {{ $index === 0 ? '#fff' : 'transparent' }}; cursor: pointer; transition: all 0.3s;"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <!-- Default Hero jika tidak ada slider -->
        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #3b82f6 100%); padding: 100px 0;">
            <div class="container">
                <div style="text-align: center; color: #fff;">
                    <h1 style="font-size: 52px; font-weight: 900; margin: 0 0 20px 0;">
                        {{ $homeSettings['home_hero_title'] ?? 'SISTEM INFORMASI' }}
                    </h1>
                    <p style="font-size: 18px; margin: 0 auto; max-width: 600px;">
                        {{ $homeSettings['home_hero_subtitle'] ?? 'Universitas Bengkulu' }}
                    </p>
                </div>
            </div>
        </div>
    @endif
</section>

<!-- Berita Terkini - Modern Slider -->
<section style="padding: 80px 0; background: linear-gradient(to bottom, #f8fafc, #ffffff); position: relative; margin-top: 0;">
    <div class="container">
        <!-- Dynamic Title & Subtitle - Campus Vibes Design -->
        <div style="text-align: center; margin-bottom: 60px;" data-aos="fade-up">
            <!-- Fun Campus Badge -->
            <div style="margin-bottom: 30px; position: relative;">
                <div style="display: inline-flex; align-items: center; gap: 15px; padding: 15px 35px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 25px; box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3); position: relative; overflow: hidden; transform: rotate(-1deg);">
                    <!-- Fun background pattern -->
                    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.1) 2px, transparent 2px), radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1) 2px, transparent 2px); background-size: 30px 30px; opacity: 0.5;"></div>

                    <!-- Emoji Icon -->
                    <div style="font-size: 24px; animation: bounce 2s ease-in-out infinite;">🎓</div>

                    <!-- Friendly Text -->
                    <span style="font-size: 16px; font-weight: 700; color: #fff; letter-spacing: 1px; position: relative; z-index: 1;">What's New di Kampus!</span>

                    <!-- Fun sparkle -->
                    <div style="font-size: 18px; animation: sparkle 1.5s ease-in-out infinite;">✨</div>
                </div>
            </div>

            <!-- Main Title with Campus Style -->
            <h2 style="font-size: 44px; font-weight: 800; color: #2d3748; margin: 0 0 20px 0; line-height: 1.2; position: relative;">
                <span style="background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    {{ $homeSettings['home_news_title'] ?? 'Info & Kegiatan Terbaru' }}
                </span>

                <!-- Fun underline doodle -->
                <svg style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 200px; height: 20px;" viewBox="0 0 200 20">
                    <path d="M10 15 Q 50 5, 100 12 T 190 10" stroke="#f093fb" stroke-width="3" fill="none" stroke-linecap="round"/>
                    <path d="M15 18 Q 55 8, 105 15 T 185 13" stroke="#f5576c" stroke-width="2" fill="none" stroke-linecap="round" opacity="0.7"/>
                </svg>
            </h2>

            @if(($homeSettings['home_news_show_subtitle'] ?? '1') == '1' && !empty($homeSettings['home_news_subtitle']))
                <p style="font-size: 18px; color: #718096; margin: 0 auto; max-width: 700px; line-height: 1.8; font-weight: 400;">
                    {{ $homeSettings['home_news_subtitle'] }}
                </p>
            @else
                <p style="font-size: 18px; color: #718096; margin: 0 auto; max-width: 700px; line-height: 1.8; font-weight: 400;">
                    Jangan sampai ketinggalan info menarik, kegiatan seru, dan update terbaru dari jurusan kita! 🚀
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

<!-- Informasi Akademik Section -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); position: relative;">
    <div class="container">
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 60px;" data-aos="fade-up">
            <div style="margin-bottom: 20px;">
                <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); border-radius: 25px; box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3); transform: rotate(-1deg);">
                    <div style="font-size: 20px;">📚</div>
                    <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">INFORMASI AKADEMIK</span>
                </div>
            </div>
            <h2 style="font-size: 42px; font-weight: 800; background: linear-gradient(135deg, #1e40af, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin: 0 0 15px 0;">
                Kegiatan & Program Terbaru
            </h2>
            <p style="font-size: 17px; color: #64748b; max-width: 600px; margin: 0 auto;">
                Update terkini seputar kegiatan akademik, program mahasiswa, dan pencapaian terbaru
            </p>
        </div>

        <!-- Academic Activities - Horizontal Layout like Screenshot -->
        <div style="position: relative; max-width: 800px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="100">
            <div class="academic-slider" style="overflow: hidden; border-radius: 15px;">
                <div class="academic-slides" style="display: flex; transition: transform 0.5s ease;">
                    <!-- Kerja Praktik -->
                    <div class="academic-slide" style="min-width: 100%; background: #fff; display: flex; align-items: center; gap: 30px; padding: 30px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
                        <div style="flex-shrink: 0;">
                            <div style="width: 200px; height: 150px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; flex-direction: column; align-items: center; justify-content: center; color: #fff; position: relative; overflow: hidden;">
                                <div style="position: absolute; inset: 0; background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2) 2px, transparent 2px), radial-gradient(circle at 70% 70%, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 20px 20px; opacity: 0.5;"></div>
                                <i class="fas fa-briefcase" style="font-size: 40px; margin-bottom: 10px; position: relative; z-index: 1;"></i>
                                <span style="font-size: 14px; font-weight: 700; text-align: center; position: relative; z-index: 1;">KERJA PRAKTIK<br>2025</span>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <div style="display: inline-block; padding: 4px 12px; background: linear-gradient(135deg, #10b981, #059669); color: #fff; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 15px;">
                                Tahun 2025
                            </div>
                            <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0;">
                                Serah Terima Mahasiswa Kerja Praktik Program Studi Sistem Informasi Tahun 2025
                            </h3>
                            <p style="color: #64748b; line-height: 1.6; margin: 0;">
                                Bengkulu, 30 Juni 2025 — Program Studi Sistem Informasi Universitas Bengkulu kembali melepas mahasiswa untuk mengikuti kegiatan Kerja Praktik (Magang) di berbagai instansi, sebagai bagian dari upaya peningkatan kompetensi dan pengalaman di dunia kerja. Salah satu lokasi penempatan tahun ini adalah Dinas Komunikasi, Informatika, dan Statistik (Diskominfotik) Provinsi Bengkulu.
                            </p>
                        </div>
                    </div>

                    <!-- Visiting Lecture -->
                    <div class="academic-slide" style="min-width: 100%; background: #fff; display: flex; align-items: center; gap: 30px; padding: 30px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
                        <div style="flex-shrink: 0;">
                            <div style="width: 200px; height: 150px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; flex-direction: column; align-items: center; justify-content: center; color: #fff; position: relative; overflow: hidden;">
                                <div style="position: absolute; inset: 0; background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2) 2px, transparent 2px), radial-gradient(circle at 70% 70%, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 20px 20px; opacity: 0.5;"></div>
                                <i class="fas fa-chalkboard-teacher" style="font-size: 40px; margin-bottom: 10px; position: relative; z-index: 1;"></i>
                                <span style="font-size: 14px; font-weight: 700; text-align: center; position: relative; z-index: 1;">VISITING<br>LECTURE</span>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <div style="display: inline-block; padding: 4px 12px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: #fff; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 15px;">
                                International
                            </div>
                            <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0;">
                                Visiting Lecture: Peluang dan Tantangan AI di Sistem Informasi
                            </h3>
                            <p style="color: #64748b; line-height: 1.6; margin: 0;">
                                Bengkulu, 6 November 2024 – Program Studi Sistem Informasi Universitas Bengkulu menggelar kegiatan Visiting Lecture dengan tema "Peluang dan Tantangan AI di Sistem Informasi" pada Rabu, 6 November 2024 pukul 10.00 WIB. Acara yang berlangsung di Gedung Bersama (GB) V Universitas Bengkulu ini menghadirkan narasumber dari Comenius University Bratislava, Slovakia.
                            </p>
                        </div>
                    </div>

                    <!-- MBKM Program -->
                    <div class="academic-slide" style="min-width: 100%; background: #fff; display: flex; align-items: center; gap: 30px; padding: 30px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
                        <div style="flex-shrink: 0;">
                            <div style="width: 200px; height: 150px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; flex-direction: column; align-items: center; justify-content: center; color: #fff; position: relative; overflow: hidden;">
                                <div style="position: absolute; inset: 0; background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2) 2px, transparent 2px), radial-gradient(circle at 70% 70%, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 20px 20px; opacity: 0.5;"></div>
                                <i class="fas fa-graduation-cap" style="font-size: 40px; margin-bottom: 10px; position: relative; z-index: 1;"></i>
                                <span style="font-size: 14px; font-weight: 700; text-align: center; position: relative; z-index: 1;">PROGRAM<br>MBKM</span>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <div style="display: inline-block; padding: 4px 12px; background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 15px;">
                                MSIB 2024
                            </div>
                            <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0;">
                                Mahasiswa SI Ikuti Program MBKM pada MSIB dan Kampus Mengajar 2024
                            </h3>
                            <p style="color: #64748b; line-height: 1.6; margin: 0;">
                                Tahun ini mahasiswa dari Program Studi Sistem Informasi turut berpartisipasi secara aktif dalam program MBKM (Merdeka Belajar Kampus Merdeka). Mereka mengikuti berbagai program seperti MSIB (Magang dan Studi Independen Bersertifikat) dan Kampus Mengajar untuk memperluas pengalaman dan kompetensi di luar kampus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button class="academic-prev" style="position: absolute; left: -50px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: #3b82f6; border: none; border-radius: 50%; color: #fff; cursor: pointer; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); transition: all 0.3s;">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="academic-next" style="position: absolute; right: -50px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: #3b82f6; border: none; border-radius: 50%; color: #fff; cursor: pointer; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); transition: all 0.3s;">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- Dosen Sistem Informasi Section -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); position: relative; overflow: hidden;">
    <!-- Subtle background pattern -->
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.05) 2px, transparent 2px), radial-gradient(circle at 80% 80%, rgba(59, 130, 246, 0.05) 1px, transparent 1px); background-size: 40px 40px; opacity: 0.5;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 60px;" data-aos="fade-up">
            <div style="margin-bottom: 20px;">
                <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); border-radius: 25px; box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);">
                    <div style="font-size: 20px;">👨‍🏫</div>
                    <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">DOSEN PROGRAM STUDI</span>
                </div>
            </div>
            <h2 style="font-size: 42px; font-weight: 800; color: #1e293b; margin: 0 0 20px 0;">
                Dosen <span style="background: linear-gradient(135deg, #3b82f6, #1e40af); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Sistem Informasi</span>
            </h2>
            <p style="font-size: 17px; color: #64748b; max-width: 700px; margin: 0 auto;">
                Tim dosen berkualitas dengan keahlian di bidang teknologi informasi dan sistem bisnis
            </p>
        </div>

        <!-- Dosen Slider -->
        <div style="position: relative; max-width: 1000px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="100">
            <div class="dosen-slider" style="overflow: hidden; border-radius: 20px;">
                <div class="dosen-slides" style="display: flex; transition: transform 0.6s ease;">
                    <!-- Slide 1 - Exact like Screenshot -->
                    <div class="dosen-slide" style="min-width: 100%; display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px;">
                        <!-- Dosen 1 -->
                        <div style="text-align: center; transition: all 0.3s;" class="dosen-card">
                            <div style="width: 220px; height: 280px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; overflow: hidden; margin: 0 auto 20px; box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3); position: relative; transform: rotate(-2deg);">
                                <!-- Decorative elements -->
                                <div style="position: absolute; top: -20px; right: -20px; width: 60px; height: 60px; background: rgba(255,255,255,0.1); border-radius: 50%; backdrop-filter: blur(10px);"></div>
                                <div style="position: absolute; bottom: -10px; left: -10px; width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                                
                                <!-- Photo area -->
                                <div style="width: 100%; height: 200px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 70px; position: relative;">
                                    <i class="fas fa-user-tie"></i>
                                    <!-- Shine effect -->
                                    <div style="position: absolute; top: 0; left: -100%; width: 50%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent); animation: shine 3s ease-in-out infinite;"></div>
                                </div>
                                
                                <!-- Info section -->
                                <div style="padding: 15px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);">
                                    <div style="font-size: 12px; color: #667eea; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Kepala Program Studi</div>
                                </div>
                            </div>
                            <h3 style="font-size: 16px; font-weight: 700; margin: 0; line-height: 1.3; color: #1e293b;">Dr. Yudi Setiawan, S.T., M.Eng.</h3>
                        </div>

                        <!-- Dosen 2 -->
                        <div style="text-align: center; transition: all 0.3s;" class="dosen-card">
                            <div style="width: 220px; height: 280px; background: #f8f9fa; border-radius: 12px; overflow: hidden; margin: 0 auto 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                                <div style="width: 100%; height: 100%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 60px;">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                            </div>
                            <h3 style="font-size: 18px; font-weight: 600; margin: 0; line-height: 1.3; color: #1e293b;">Niska Ramadhani, M.Kom.</h3>
                        </div>

                        <!-- Dosen 3 -->
                        <div style="text-align: center; transition: all 0.3s;" class="dosen-card">
                            <div style="width: 220px; height: 280px; background: #f8f9fa; border-radius: 12px; overflow: hidden; margin: 0 auto 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                                <div style="width: 100%; height: 100%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 60px;">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                            </div>
                            <h3 style="font-size: 18px; font-weight: 600; margin: 0; line-height: 1.3; color: #1e293b;">Aan Erlanshari, S.T., M.Eng.</h3>
                        </div>

                        <!-- Dosen 4 -->
                        <div style="text-align: center; transition: all 0.3s;" class="dosen-card">
                            <div style="width: 220px; height: 280px; background: #f8f9fa; border-radius: 12px; overflow: hidden; margin: 0 auto 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                                <div style="width: 100%; height: 100%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 60px;">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <h3 style="font-size: 18px; font-weight: 600; margin: 0; line-height: 1.3; color: #1e293b;">Soni Ayi Purnama, M.Kom.</h3>
                        </div>
                    </div>

                    <!-- Slide 2 - Consistent with Screenshot Style -->
                    <div class="dosen-slide" style="min-width: 100%; display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px;">
                        <!-- Dosen 5 -->
                        <div style="text-align: center; transition: all 0.3s;" class="dosen-card">
                            <div style="width: 220px; height: 280px; background: #f8f9fa; border-radius: 12px; overflow: hidden; margin: 0 auto 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                                <div style="width: 100%; height: 100%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 60px;">
                                    <i class="fas fa-user-cog"></i>
                                </div>
                            </div>
                            <h3 style="font-size: 18px; font-weight: 600; margin: 0; line-height: 1.3; color: #1e293b;">Yusran Panca Putra, M.Kom.</h3>
                        </div>

                        <!-- Dosen 6 -->
                        <div style="text-align: center; transition: all 0.3s;" class="dosen-card">
                            <div style="width: 220px; height: 280px; background: #f8f9fa; border-radius: 12px; overflow: hidden; margin: 0 auto 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                                <div style="width: 100%; height: 100%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 60px;">
                                    <i class="fas fa-user-edit"></i>
                                </div>
                            </div>
                            <h3 style="font-size: 18px; font-weight: 600; margin: 0; line-height: 1.3; color: #1e293b;">Julia Purnama Sari, S.T., M.Kom.</h3>
                        </div>

                        <!-- Dosen 7 -->
                        <div style="text-align: center; transition: all 0.3s;" class="dosen-card">
                            <div style="width: 220px; height: 280px; background: #f8f9fa; border-radius: 12px; overflow: hidden; margin: 0 auto 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                                <div style="width: 100%; height: 100%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 60px;">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                            </div>
                            <h3 style="font-size: 18px; font-weight: 600; margin: 0; line-height: 1.3; color: #1e293b;">Tiara Eka Putri, S.T., M.Kom.</h3>
                        </div>

                        <!-- Dosen 8 -->
                        <div style="text-align: center; transition: all 0.3s;" class="dosen-card">
                            <div style="width: 220px; height: 280px; background: #f8f9fa; border-radius: 12px; overflow: hidden; margin: 0 auto 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                                <div style="width: 100%; height: 100%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 60px;">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                            </div>
                            <h3 style="font-size: 18px; font-weight: 600; margin: 0; line-height: 1.3; color: #1e293b;">Andang Wijanarko, M.Kom.</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Dots -->
            <div class="dosen-dots" style="display: flex; justify-content: center; gap: 12px; margin-top: 40px;">
                <button class="dosen-dot" data-slide="0" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #3b82f6; background: #3b82f6; cursor: pointer; transition: all 0.3s;"></button>
                <button class="dosen-dot" data-slide="1" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #3b82f6; background: transparent; cursor: pointer; transition: all 0.3s;"></button>
            </div>
        </div>

        <!-- CTA Button -->
        <div style="text-align: center; margin-top: 50px;" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('page.show', 'about') }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 40px; background: linear-gradient(135deg, #fbbf24, #f97316); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; box-shadow: 0 10px 30px rgba(251, 191, 36, 0.4); transition: all 0.3s;" class="btn-hover">
                <span>Lihat Semua Dosen</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Kenali Sistem Informasi Section -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: #fff; position: relative; overflow: hidden;">
    <!-- Background Decorations -->
    <div style="position: absolute; top: -100px; right: -100px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(251, 191, 36, 0.1) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -150px; left: -150px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%); border-radius: 50%;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 60px;" data-aos="fade-up">
            <div style="margin-bottom: 20px;">
                <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 25px; border: 1px solid rgba(255,255,255,0.2);">
                    <div style="font-size: 20px;">🎯</div>
                    <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">KENALI LEBIH DEKAT</span>
                </div>
            </div>
            <h2 style="font-size: 48px; font-weight: 900; margin: 0 0 20px 0; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                SISTEM INFORMASI <span style="color: #fbbf24;">UNIB</span>
            </h2>
            <p style="font-size: 18px; opacity: 0.9; max-width: 700px; margin: 0 auto;">
                Program studi yang mempersiapkan lulusan berkualitas di era digital dengan fokus pada teknologi informasi dan sistem bisnis
            </p>
        </div>

        <!-- Info Cards Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 50px;" data-aos="fade-up" data-aos-delay="100">
            <!-- Apa itu SI -->
            <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 20px; padding: 30px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" class="info-card">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #fbbf24, #f97316); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <i class="fas fa-lightbulb" style="color: #fff; font-size: 24px;"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 700; margin: 0 0 15px 0;">Apa itu Sistem Informasi?</h3>
                <p style="opacity: 0.9; line-height: 1.6; margin: 0;">
                    Disiplin ilmu yang mempelajari interaksi antara Teknologi Informasi dengan Sistem Sosial (Organisasi, Bisnis, Masyarakat) untuk menciptakan solusi digital yang efektif.
                </p>
            </div>

            <!-- Prospek Karir -->
            <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 20px; padding: 30px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" class="info-card">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <i class="fas fa-rocket" style="color: #fff; font-size: 24px;"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 700; margin: 0 0 15px 0;">Prospek Karir Cemerlang</h3>
                <p style="opacity: 0.9; line-height: 1.6; margin: 0;">
                    IS Developer, Technopreneur, Konsultan e-Business, Akademisi SI. Lulusan siap menghadapi tantangan industri 4.0 dan era digital.
                </p>
            </div>

            <!-- Keunggulan -->
            <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 20px; padding: 30px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" class="info-card">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <i class="fas fa-award" style="color: #fff; font-size: 24px;"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 700; margin: 0 0 15px 0;">Terakreditasi Internasional</h3>
                <p style="opacity: 0.9; line-height: 1.6; margin: 0;">
                    Terakreditasi Baik oleh BAN-PT dan terakreditasi internasional ACQUIN. Sertifikasi pelatihan internasional untuk mahasiswa.
                </p>
            </div>
        </div>

        <!-- CTA Button -->
        <div style="text-align: center;" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('page.show', 'about') }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 40px; background: linear-gradient(135deg, #fbbf24, #f97316); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; box-shadow: 0 10px 30px rgba(251, 191, 36, 0.4); transition: all 0.3s;" class="btn-hover">
                <span>Pelajari Lebih Lanjut</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Ikatan Alumni ILUSI Section - Visual Design like Screenshot -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%); position: relative; overflow: hidden;">
    <!-- Background Decorations -->
    <div style="position: absolute; top: -100px; right: -100px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255, 107, 53, 0.1) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -150px; left: -150px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%); border-radius: 50%;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;" data-aos="fade-up">
            <!-- Left Side - Content -->
            <div>
                <div style="margin-bottom: 30px;">
                    <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); border-radius: 25px; box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3); transform: rotate(-2deg);">
                        <div style="font-size: 20px;">🎓</div>
                        <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">IKATAN ALUMNI</span>
                    </div>
                </div>

                <h2 style="font-size: 48px; font-weight: 900; color: #1e293b; margin: 0 0 20px 0; line-height: 1.1;">
                    <span style="background: linear-gradient(135deg, #ff6b35, #f7931e); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">IKATAN ALUMNI</span><br>
                    <span style="background: linear-gradient(135deg, #ff6b35, #f7931e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 52px;">SISTEM INFORMASI</span>
                </h2>

                <!-- Alumni Success Stories -->
                <div style="space-y: 25px;">
                    <!-- Alumni 1 -->
                    <div style="background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; border: 1px solid rgba(255,255,255,0.3); margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 12px;">
                            <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #3b82f6, #1e40af); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 16px;">
                                BS
                            </div>
                            <div>
                                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0;">Bagus Satria, S.Kom.</h4>
                                <p style="font-size: 13px; color: #64748b; margin: 0;">Branch Supervisor - Biznet</p>
                            </div>
                        </div>
                        <p style="color: #475569; font-size: 14px; line-height: 1.5; font-style: italic; margin: 0;">
                            "Fasilitas lengkap sangat mendukung kegiatan akademik dan non-akademik, bahkan saya berkesempatan keluar negeri."
                        </p>
                    </div>

                    <!-- Alumni 2 -->
                    <div style="background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; border: 1px solid rgba(255,255,255,0.3); margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 12px;">
                            <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 16px;">
                                DA
                            </div>
                            <div>
                                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0;">Devi Anggraini Rahayu, S.Kom.</h4>
                                <p style="font-size: 13px; color: #64748b; margin: 0;">Admin Umum - PT. Batu Bara</p>
                            </div>
                        </div>
                        <p style="color: #475569; font-size: 14px; line-height: 1.5; font-style: italic; margin: 0;">
                            "SI UNIB banyak melahirkan generasi berprestasi. Meskipun prodi baru tapi sudah mencetak lulusan yang mampu bersaing."
                        </p>
                    </div>

                    <!-- Alumni 3 -->
                    <div style="background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; border: 1px solid rgba(255,255,255,0.3);">
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 12px;">
                            <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 16px;">
                                JA
                            </div>
                            <div>
                                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0;">Jumratul Aini, S.Kom.</h4>
                                <p style="font-size: 13px; color: #64748b; margin: 0;">Staff Buyer</p>
                            </div>
                        </div>
                        <p style="color: #475569; font-size: 14px; line-height: 1.5; font-style: italic; margin: 0;">
                            "Banyak hal yang saya dapatkan dari SI UNIB, baik ilmu teknologi, etika mahasiswa, maupun attitude berorganisasi."
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side - Visual Illustration like Screenshot -->
            <div style="position: relative; text-align: center;" data-aos="fade-left" data-aos-delay="200">
                <!-- Main Illustration Container -->
                <div style="position: relative; display: inline-block;">
                    <!-- Background Circle with Dots Pattern -->
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; height: 400px; background: radial-gradient(circle, rgba(255, 107, 53, 0.1) 0%, transparent 70%); border-radius: 50%; background-image: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.3) 2px, transparent 2px), radial-gradient(circle at 80% 80%, rgba(255,255,255,0.3) 2px, transparent 2px); background-size: 30px 30px;"></div>

                    <!-- Alumni Figures -->
                    <div style="position: relative; z-index: 2;">
                        <!-- Graduate 1 -->
                        <div style="position: absolute; top: 20px; left: 50px; width: 120px; height: 150px; background: linear-gradient(135deg, #3b82f6, #1e40af); border-radius: 60px 60px 20px 20px; transform: rotate(-5deg); box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);">
                            <!-- Graduation Cap -->
                            <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 15px; background: #1e293b; border-radius: 50px;"></div>
                            <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; background: #1e293b; border-radius: 50%;"></div>
                            <!-- Face -->
                            <div style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: #fbbf24; border-radius: 50%;"></div>
                        </div>

                        <!-- Graduate 2 -->
                        <div style="position: absolute; top: 50px; right: 30px; width: 120px; height: 150px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 60px 60px 20px 20px; transform: rotate(8deg); box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);">
                            <!-- Graduation Cap -->
                            <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 15px; background: #1e293b; border-radius: 50px;"></div>
                            <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; background: #1e293b; border-radius: 50%;"></div>
                            <!-- Face -->
                            <div style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: #fbbf24; border-radius: 50%;"></div>
                        </div>

                        <!-- Graduate 3 -->
                        <div style="position: absolute; bottom: 30px; left: 80px; width: 120px; height: 150px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 60px 60px 20px 20px; transform: rotate(-3deg); box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);">
                            <!-- Graduation Cap -->
                            <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 15px; background: #1e293b; border-radius: 50px;"></div>
                            <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; background: #1e293b; border-radius: 50%;"></div>
                            <!-- Face -->
                            <div style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: #fbbf24; border-radius: 50%;"></div>
                        </div>
                    </div>

                    <!-- Bottom Text Banner -->
                    <div style="position: absolute; bottom: -50px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #ff6b35, #f7931e); padding: 15px 40px; border-radius: 25px; box-shadow: 0 10px 30px rgba(255, 107, 53, 0.4); transform: translateX(-50%) rotate(-2deg);">
                        <h3 style="color: #fff; font-size: 24px; font-weight: 900; margin: 0; text-transform: uppercase; letter-spacing: 1px; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                            IKATAN ALUMNI<br>
                            <span style="font-size: 20px;">SISTEM INFORMASI</span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
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
// Scroll to top on page load/refresh
if (history.scrollRestoration) {
    history.scrollRestoration = 'manual';
}
window.scrollTo(0, 0);

$(document).ready(function() {
    // Scroll to top
    $('html, body').scrollTop(0);

    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Hero Slider
    let currentHeroSlide = 0;
    const heroSlides = $('.hero-slide');
    const heroDots = $('.hero-dot');
    const totalHeroSlides = heroSlides.length;

    function goToHeroSlide(index) {
        currentHeroSlide = index;
        $('.hero-slides').css('transform', `translateX(-${currentHeroSlide * 100}%)`);

        // Update dots
        heroDots.each(function(i) {
            if (i === currentHeroSlide) {
                $(this).css('background', '#fff');
            } else {
                $(this).css('background', 'transparent');
            }
        });
    }

    // Hero dots click
    heroDots.on('click', function() {
        goToHeroSlide($(this).data('slide'));
    });

    // Hero prev/next buttons
    $('.hero-prev').on('click', function() {
        currentHeroSlide = (currentHeroSlide - 1 + totalHeroSlides) % totalHeroSlides;
        goToHeroSlide(currentHeroSlide);
    });

    $('.hero-next').on('click', function() {
        currentHeroSlide = (currentHeroSlide + 1) % totalHeroSlides;
        goToHeroSlide(currentHeroSlide);
    });

    // Hero auto slide
    if (totalHeroSlides > 1) {
        setInterval(function() {
            currentHeroSlide = (currentHeroSlide + 1) % totalHeroSlides;
            goToHeroSlide(currentHeroSlide);
        }, 6000);
    }

    // Hero arrow hover
    $('.hero-prev, .hero-next').hover(
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.4)',
                'transform': 'translateY(-50%) scale(1.1)'
            });
        },
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.2)',
                'transform': 'translateY(-50%) scale(1)'
            });
        }
    );

    // News Slider functionality
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
    if (totalSlides > 0) {
        setInterval(function() {
            currentSlide = (currentSlide + 1) % totalSlides;
            goToSlide(currentSlide);
        }, 5000);
    }

    // Academic Slider functionality
    let currentAcademicSlide = 0;
    const academicSlides = $('.academic-slide');
    const totalAcademicSlides = academicSlides.length;

    function goToAcademicSlide(index) {
        currentAcademicSlide = index;
        $('.academic-slides').css('transform', `translateX(-${currentAcademicSlide * 100}%)`);
    }

    $('.academic-prev').on('click', function() {
        currentAcademicSlide = (currentAcademicSlide - 1 + totalAcademicSlides) % totalAcademicSlides;
        goToAcademicSlide(currentAcademicSlide);
    });

    $('.academic-next').on('click', function() {
        currentAcademicSlide = (currentAcademicSlide + 1) % totalAcademicSlides;
        goToAcademicSlide(currentAcademicSlide);
    });

    // Auto slide for academic section
    if (totalAcademicSlides > 1) {
        setInterval(function() {
            currentAcademicSlide = (currentAcademicSlide + 1) % totalAcademicSlides;
            goToAcademicSlide(currentAcademicSlide);
        }, 8000);
    }

    // Academic arrow hover
    $('.academic-prev, .academic-next').hover(
        function() {
            $(this).css({
                'background': '#1e40af',
                'transform': 'translateY(-50%) scale(1.1)'
            });
        },
        function() {
            $(this).css({
                'background': '#3b82f6',
                'transform': 'translateY(-50%) scale(1)'
            });
        }
    );

    // Dosen Slider functionality
    let currentDosenSlide = 0;
    const dosenSlides = $('.dosen-slide');
    const dosenDots = $('.dosen-dot');
    const totalDosenSlides = dosenSlides.length;

    function goToDosenSlide(index) {
        currentDosenSlide = index;
        $('.dosen-slides').css('transform', `translateX(-${currentDosenSlide * 100}%)`);

        // Update dots
        dosenDots.each(function(i) {
            if (i === currentDosenSlide) {
                $(this).css('background', '#3b82f6');
            } else {
                $(this).css('background', 'transparent');
            }
        });
    }

    // Dosen dots click
    dosenDots.on('click', function() {
        goToDosenSlide($(this).data('slide'));
    });

    // Auto slide for dosen section
    if (totalDosenSlides > 1) {
        setInterval(function() {
            currentDosenSlide = (currentDosenSlide + 1) % totalDosenSlides;
            goToDosenSlide(currentDosenSlide);
        }, 6000);
    }

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
    /* Pulse Animation for Background Shapes */
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
    }

    /* Fun Campus Animations */
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-8px);
        }
        60% {
            transform: translateY(-4px);
        }
    }

    @keyframes sparkle {
        0%, 100% {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
        50% {
            transform: scale(1.2) rotate(180deg);
            opacity: 0.8;
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        33% {
            transform: translateY(-10px) rotate(5deg);
        }
        66% {
            transform: translateY(-5px) rotate(-3deg);
        }
    }

    /* Shine Effect Animation */
    @keyframes shine {
        0% {
            left: -100%;
        }
        50%, 100% {
            left: 150%;
        }
    }

    /* Hero Image Hover Effect */
    .hero-image:hover {
        transform: rotate(2deg) scale(1.02) !important;
    }

    .hero-image:hover img {
        transform: scale(1.05);
    }

    /* CTA Button Hover */
    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(251, 191, 36, 0.6) !important;
    }

    .cta-button:hover > div {
        opacity: 1 !important;
    }

    .cta-button:hover i {
        transform: translateX(5px) !important;
    }

    /* News Card Hover */
    .news-card:hover {
        transform: translateY(-12px) !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    }

    .news-card:hover img {
        transform: scale(1.1) !important;
    }

    /* Arrow Icon Animation */
    .arrow-icon:hover {
        transform: translateX(4px) !important;
        background: linear-gradient(135deg, #f97316, #ea580c) !important;
    }

    /* Button Hover Effects */
    .btn-hover:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 12px 32px rgba(251, 191, 36, 0.5) !important;
    }

    .btn-hover-outline:hover {
        background: rgba(255,255,255,0.2) !important;
        transform: translateY(-2px) !important;
    }

    .social-hover:hover {
        background: rgba(255,255,255,0.2) !important;
        transform: translateY(-3px) !important;
    }

    /* New Section Hover Effects */
    .academic-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
    }

    .info-card:hover {
        transform: translateY(-5px) !important;
        background: rgba(255,255,255,0.15) !important;
    }

    .alumni-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.12) !important;
    }

    .dosen-card:hover {
        transform: translateY(-10px) !important;
        background: rgba(255,255,255,0.2) !important;
        box-shadow: 0 20px 50px rgba(0,0,0,0.3) !important;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        [style*="grid-template-columns: repeat(3"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }

    @media (max-width: 768px) {
        [style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }

        h1 {
            font-size: 36px !important;
        }
    }
</style>
@endpush
