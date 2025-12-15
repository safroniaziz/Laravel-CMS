@extends('layouts.frontend')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-slider">
        @forelse($sliders as $index => $slider)
            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
                @if($slider->image)
                    <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}">
                @endif
                <div class="hero-overlay"></div>
            </div>
        @empty
            <div class="hero-slide active">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 100%; height: 100%;"></div>
            </div>
        @endforelse
    </div>

    <div class="container hero-content">
        @if($sliders->count() > 0)
            <h1>{{ $sliders->first()->title }}</h1>
            @if($sliders->first()->description)
                <p>{{ $sliders->first()->description }}</p>
            @endif
            @if($sliders->first()->button_text && $sliders->first()->button_url)
                <div class="hero-buttons">
                    <a href="{{ $sliders->first()->button_url }}" class="btn btn-primary">
                        {{ $sliders->first()->button_text }} <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('page.show', 'about') }}" class="btn btn-outline">
                        Pelajari Lebih Lanjut <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            @endif
        @else
            <h1>Selamat Datang di {{ $siteSettings['name'] }}</h1>
            <p>Platform manajemen konten yang modern, powerful, dan mudah digunakan untuk semua kebutuhan digital Anda</p>
            <div class="hero-buttons">
                <a href="{{ route('page.show', 'about') }}" class="btn btn-primary">
                    Mulai Sekarang <i class="fas fa-rocket"></i>
                </a>
                <a href="{{ route('services.index') }}" class="btn btn-outline">
                    Lihat Layanan <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Stats Section -->
<section class="section" style="padding: 60px 0; background: linear-gradient(135deg, var(--primary-dark), var(--primary));">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; text-align: center;">
            <div data-aos="fade-up" data-aos-delay="0">
                <div style="font-size: 48px; font-weight: 900; color: var(--accent); margin-bottom: 8px;">
                    <span class="counter" data-target="500">0</span>+
                </div>
                <div style="font-size: 16px; color: rgba(255,255,255,0.9); font-weight: 600;">Proyek Selesai</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="100">
                <div style="font-size: 48px; font-weight: 900; color: var(--accent); margin-bottom: 8px;">
                    <span class="counter" data-target="250">0</span>+
                </div>
                <div style="font-size: 16px; color: rgba(255,255,255,0.9); font-weight: 600;">Klien Puas</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <div style="font-size: 48px; font-weight: 900; color: var(--accent); margin-bottom: 8px;">
                    <span class="counter" data-target="15">0</span>+
                </div>
                <div style="font-size: 16px; color: rgba(255,255,255,0.9); font-weight: 600;">Tahun Pengalaman</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="300">
                <div style="font-size: 48px; font-weight: 900; color: var(--accent); margin-bottom: 8px;">
                    <span class="counter" data-target="50">0</span>+
                </div>
                <div style="font-size: 16px; color: rgba(255,255,255,0.9); font-weight: 600;">Penghargaan</div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section -->
<section class="section section-bg-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-label">Berita Terkini</span>
            <h2 class="section-title">Informasi & <span>Update</span> Terbaru</h2>
            <p class="section-description">Dapatkan informasi terkini dan artikel menarik seputar teknologi, bisnis, dan pengembangan digital</p>
        </div>

        <div class="card-grid">
            @forelse($latestPosts as $index => $post)
                <article class="modern-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="card-image-wrapper">
                        @if($post->featured_image)
                            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x300/667eea/ffffff?text={{ urlencode(substr($post->title, 0, 20)) }}" alt="{{ $post->title }}">
                        @endif

                        <div class="card-date">
                            <span class="card-date-day">{{ $post->created_at->format('d') }}</span>
                            <span class="card-date-month">{{ $post->created_at->format('M') }}</span>
                        </div>

                        @if($post->category)
                            <div class="card-badge">{{ $post->category->name }}</div>
                        @endif
                    </div>

                    <div class="card-body">
                        <h3 class="card-title">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>

                        @if($post->excerpt)
                            <p class="card-excerpt">{{ $post->excerpt }}</p>
                        @endif

                        <div class="card-meta">
                            <span class="card-meta-item">
                                <i class="fas fa-user"></i> {{ $post->author->name }}
                            </span>
                            <span class="card-meta-item">
                                <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary" style="margin-top: 20px; width: 100%; justify-content: center;">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;" data-aos="fade-up">
                    <div style="font-size: 80px; color: var(--border); margin-bottom: 20px;">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3 style="margin-bottom: 12px; color: var(--text-secondary);">Belum Ada Berita</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 24px;">Berita dan artikel akan segera hadir</p>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Buat Berita Pertama
                    </a>
                </div>
            @endforelse
        </div>

        @if($latestPosts->count() > 0)
            <div style="text-align: center; margin-top: 48px;" data-aos="fade-up">
                <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg">
                    Lihat Semua Berita <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Services Section -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-label">Layanan Kami</span>
            <h2 class="section-title">Solusi Digital <span>Terbaik</span> Untuk Anda</h2>
            <p class="section-description">Kami menyediakan berbagai layanan digital profesional untuk membantu bisnis Anda berkembang dan sukses</p>
        </div>

        <div class="card-grid">
            @forelse($services as $index => $service)
                <div class="modern-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" style="text-align: center;">
                    @if($service->image)
                        <div class="card-image-wrapper">
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                        </div>
                    @endif

                    <div class="card-body">
                        @if($service->icon)
                            <div style="width: 80px; height: 80px; margin: 0 auto 24px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 36px; color: white; box-shadow: var(--shadow-lg);">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                        @endif

                        <h3 class="card-title">
                            <a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a>
                        </h3>

                        @if($service->description)
                            <p class="card-excerpt">{{ $service->description }}</p>
                        @endif

                        <a href="{{ route('services.show', $service->slug) }}" class="btn btn-secondary" style="margin-top: 20px;">
                            Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;" data-aos="fade-up">
                    <div style="font-size: 80px; color: var(--border); margin-bottom: 20px;">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 style="margin-bottom: 12px; color: var(--text-secondary);">Belum Ada Layanan</h3>
                    <p style="color: var(--text-secondary);">Layanan akan segera tersedia</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Portfolio Section -->
@if($portfolios->count() > 0)
<section class="section section-bg-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-label">Portfolio</span>
            <h2 class="section-title">Karya & <span>Proyek</span> Kami</h2>
            <p class="section-description">Lihat berbagai proyek sukses yang telah kami kerjakan dengan hasil yang memuaskan</p>
        </div>

        <div class="card-grid">
            @foreach($portfolios as $index => $portfolio)
                <div class="modern-card" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                    <div class="card-image-wrapper" style="padding-top: 75%;">
                        @if($portfolio->featured_image)
                            <img src="{{ asset($portfolio->featured_image) }}" alt="{{ $portfolio->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x400/4facfe/ffffff?text={{ urlencode($portfolio->title) }}" alt="{{ $portfolio->title }}">
                        @endif
                        @if($portfolio->is_featured)
                            <div class="card-badge" style="background: linear-gradient(135deg, var(--accent), var(--accent-dark));">
                                <i class="fas fa-star"></i> Featured
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <h3 class="card-title">
                            <a href="{{ route('portfolio.show', $portfolio->slug) }}">{{ $portfolio->title }}</a>
                        </h3>

                        @if($portfolio->description)
                            <p class="card-excerpt">{{ $portfolio->description }}</p>
                        @endif

                        @if($portfolio->client)
                            <div class="card-meta">
                                <span class="card-meta-item">
                                    <i class="fas fa-building"></i> {{ $portfolio->client }}
                                </span>
                            </div>
                        @endif

                        <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="btn btn-primary" style="margin-top: 20px; width: 100%; justify-content: center;">
                            Lihat Detail <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 48px;" data-aos="fade-up">
            <a href="{{ route('portfolio.index') }}" class="btn btn-primary btn-lg">
                Lihat Semua Portfolio <i class="fas fa-folder-open"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Testimonials Section -->
@if($testimonials->count() > 0)
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-label">Testimoni</span>
            <h2 class="section-title">Apa Kata <span>Mereka</span> Tentang Kami</h2>
            <p class="section-description">Kepuasan klien adalah prioritas utama kami. Lihat apa kata mereka tentang layanan kami</p>
        </div>

        <div class="card-grid">
            @foreach($testimonials as $index => $testimonial)
                <div class="modern-card" data-aos="flip-left" data-aos-delay="{{ $index * 100 }}" style="text-align: center;">
                    <div class="card-body" style="padding: 48px 32px;">
                        @if($testimonial->image)
                            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}"
                                 style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; margin: 0 auto 20px; border: 4px solid var(--accent); box-shadow: var(--shadow-lg);">
                        @else
                            <div style="width: 90px; height: 90px; border-radius: 50%; background: var(--gradient-blue); color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 40px; font-weight: 800; box-shadow: var(--shadow-lg);">
                                {{ substr($testimonial->name, 0, 1) }}
                            </div>
                        @endif

                        <div style="color: var(--accent); margin-bottom: 20px; font-size: 24px;">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>

                        <p style="font-style: italic; color: var(--text-secondary); margin-bottom: 24px; font-size: 16px; line-height: 1.8;">
                            "{{ $testimonial->content }}"
                        </p>

                        <h4 style="font-weight: 700; margin-bottom: 4px; font-size: 18px;">{{ $testimonial->name }}</h4>
                        @if($testimonial->position || $testimonial->company)
                            <p style="color: var(--text-secondary); font-size: 14px;">
                                @if($testimonial->position){{ $testimonial->position }}@endif
                                @if($testimonial->position && $testimonial->company) - @endif
                                @if($testimonial->company){{ $testimonial->company }}@endif
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Partners Section -->
@if($partners->count() > 0)
<section class="section section-bg-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-label">Partner Kami</span>
            <h2 class="section-title">Dipercaya Oleh <span>Perusahaan Terkemuka</span></h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 32px; align-items: center;">
            @foreach($partners as $index => $partner)
                <div data-aos="fade-up" data-aos-delay="{{ $index * 50 }}" style="background: white; padding: 32px; border-radius: 16px; text-align: center; box-shadow: var(--shadow); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='var(--shadow-lg)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow)'">
                    @if($partner->logo)
                        <img src="{{ asset($partner->logo) }}" alt="{{ $partner->name }}"
                             style="max-width: 100%; height: 60px; object-fit: contain; filter: grayscale(100%); opacity: 0.7; transition: all 0.3s ease;"
                             onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1'"
                             onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7'">
                    @else
                        <h4 style="font-weight: 700; color: var(--text-secondary);">{{ $partner->name }}</h4>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); padding: 80px 0;">
    <div class="container" style="text-align: center;" data-aos="zoom-in">
        <h2 style="font-size: 42px; margin-bottom: 20px; color: white; font-weight: 800;">Siap Memulai Proyek Anda?</h2>
        <p style="font-size: 20px; margin-bottom: 40px; color: rgba(255,255,255,0.9); max-width: 700px; margin-left: auto; margin-right: auto;">
            Hubungi kami sekarang dan wujudkan ide digital Anda bersama tim profesional kami
        </p>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('contact.index') }}" class="btn btn-primary" style="font-size: 18px; padding: 16px 40px;">
                <i class="fas fa-phone"></i> Hubungi Kami Sekarang
            </a>
            <a href="{{ route('services.index') }}" class="btn btn-outline" style="font-size: 18px; padding: 16px 40px;">
                <i class="fas fa-briefcase"></i> Lihat Layanan
            </a>
        </div>
    </div>
</section>
@endsection

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

    // Trigger counter animation when in viewport
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
