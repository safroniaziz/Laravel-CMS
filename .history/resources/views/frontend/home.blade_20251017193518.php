@extends('layouts.frontend')

@section('content')
<!-- Hero Slider -->
<section class="hero-slider">
    @forelse($sliders as $index => $slider)
        <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
            @if($slider->image)
                <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}">
            @endif
            <div class="hero-content">
                <h1>{{ $slider->title }}</h1>
                @if($slider->description)
                    <p>{{ $slider->description }}</p>
                @endif
                @if($slider->button_text && $slider->button_url)
                    <a href="{{ $slider->button_url }}" class="btn btn-primary">{{ $slider->button_text }}</a>
                @endif
            </div>
        </div>
    @empty
        <div class="hero-slide active">
            <div class="hero-content">
                <h1>Selamat Datang di {{ $siteSettings['name'] }}</h1>
                <p>Platform manajemen konten yang modern, powerful, dan mudah digunakan</p>
                <a href="{{ route('page.show', 'about') }}" class="btn btn-primary">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    @endforelse
</section>

<!-- Latest News Section -->
<section class="section" style="background: var(--bg-light);">
    <div class="container">
        <div class="section-header">
            <h2>Berita Terkini</h2>
            <p>Informasi dan update terbaru dari kami</p>
        </div>

        <div class="card-grid">
            @forelse($latestPosts as $post)
                <article class="card">
                    <div class="card-image">
                        @if($post->featured_image)
                            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x300/2563eb/ffffff?text={{ urlencode($post->title) }}" alt="{{ $post->title }}">
                        @endif
                        
                        <div class="card-date">
                            <span class="day">{{ $post->created_at->format('d') }}</span>
                            <span class="month">{{ $post->created_at->format('M') }}</span>
                        </div>
                    </div>

                    <div class="card-content">
                        <h3 class="card-title">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        
                        @if($post->excerpt)
                            <p class="card-excerpt">{{ $post->excerpt }}</p>
                        @endif

                        <div class="card-meta">
                            <span><i class="fas fa-user"></i> {{ $post->author->name }}</span>
                            @if($post->category)
                                <span><i class="fas fa-folder"></i> {{ $post->category->name }}</span>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
                    <i class="fas fa-newspaper" style="font-size: 48px; color: var(--text-light); margin-bottom: 15px;"></i>
                    <p style="color: var(--text-light);">Belum ada berita tersedia</p>
                </div>
            @endforelse
        </div>

        @if($latestPosts->count() > 0)
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('blog.index') }}" class="btn btn-primary">Lihat Semua Berita</a>
            </div>
        @endif
    </div>
</section>

<!-- Services Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Layanan Kami</h2>
            <p>Solusi terbaik untuk kebutuhan digital Anda</p>
        </div>

        <div class="card-grid">
            @forelse($services as $service)
                <div class="card">
                    @if($service->image)
                        <div class="card-image">
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                        </div>
                    @endif

                    <div class="card-content">
                        @if($service->icon)
                            <div style="font-size: 48px; color: var(--primary-color); margin-bottom: 15px;">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                        @endif

                        <h3 class="card-title">
                            <a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a>
                        </h3>

                        @if($service->description)
                            <p class="card-excerpt">{{ $service->description }}</p>
                        @endif

                        <a href="{{ route('services.show', $service->slug) }}" class="btn btn-secondary" style="margin-top: 15px;">
                            Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
                    <i class="fas fa-briefcase" style="font-size: 48px; color: var(--text-light); margin-bottom: 15px;"></i>
                    <p style="color: var(--text-light);">Belum ada layanan tersedia</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Portfolio Section -->
@if($portfolios->count() > 0)
<section class="section" style="background: var(--bg-light);">
    <div class="container">
        <div class="section-header">
            <h2>Portfolio</h2>
            <p>Karya dan proyek yang telah kami selesaikan</p>
        </div>

        <div class="card-grid">
            @foreach($portfolios as $portfolio)
                <div class="card">
                    <div class="card-image">
                        @if($portfolio->featured_image)
                            <img src="{{ asset($portfolio->featured_image) }}" alt="{{ $portfolio->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x300/2563eb/ffffff?text={{ urlencode($portfolio->title) }}" alt="{{ $portfolio->title }}">
                        @endif
                        @if($portfolio->is_featured)
                            <div class="card-badge">Featured</div>
                        @endif
                    </div>

                    <div class="card-content">
                        <h3 class="card-title">
                            <a href="{{ route('portfolio.show', $portfolio->slug) }}">{{ $portfolio->title }}</a>
                        </h3>

                        @if($portfolio->description)
                            <p class="card-excerpt">{{ $portfolio->description }}</p>
                        @endif

                        @if($portfolio->client)
                            <div class="card-meta">
                                <span><i class="fas fa-building"></i> {{ $portfolio->client }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('portfolio.index') }}" class="btn btn-primary">Lihat Semua Portfolio</a>
        </div>
    </div>
</section>
@endif

<!-- Testimonials Section -->
@if($testimonials->count() > 0)
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Testimoni</h2>
            <p>Apa kata mereka tentang kami</p>
        </div>

        <div class="card-grid">
            @foreach($testimonials as $testimonial)
                <div class="card" style="text-align: center;">
                    <div class="card-content" style="padding: 40px 25px;">
                        @if($testimonial->image)
                            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" 
                                 style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin: 0 auto 20px;">
                        @else
                            <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--primary-color); color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 32px; font-weight: 700;">
                                {{ substr($testimonial->name, 0, 1) }}
                            </div>
                        @endif

                        <div style="color: var(--accent-color); margin-bottom: 15px; font-size: 20px;">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>

                        <p style="font-style: italic; color: var(--text-light); margin-bottom: 20px;">
                            "{{ $testimonial->content }}"
                        </p>

                        <h4 style="font-weight: 600; margin-bottom: 5px;">{{ $testimonial->name }}</h4>
                        @if($testimonial->position || $testimonial->company)
                            <p style="color: var(--text-light); font-size: 14px;">
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
<section class="section" style="background: var(--bg-light);">
    <div class="container">
        <div class="section-header">
            <h2>Partner Kami</h2>
            <p>Dipercaya oleh perusahaan terkemuka</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 30px; align-items: center;">
            @foreach($partners as $partner)
                <div style="text-align: center; padding: 20px; background: white; border-radius: 8px; transition: transform 0.3s;">
                    @if($partner->logo)
                        <img src="{{ asset($partner->logo) }}" alt="{{ $partner->name }}" 
                             style="max-width: 100%; height: 60px; object-fit: contain; filter: grayscale(100%); transition: filter 0.3s;"
                             onmouseover="this.style.filter='grayscale(0%)'" 
                             onmouseout="this.style.filter='grayscale(100%)'">
                    @else
                        <h4>{{ $partner->name }}</h4>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white; text-align: center;">
    <div class="container">
        <h2 style="font-size: 36px; margin-bottom: 20px; color: white;">Siap Memulai Proyek Anda?</h2>
        <p style="font-size: 18px; margin-bottom: 30px; color: rgba(255,255,255,0.9);">
            Hubungi kami sekarang dan wujudkan ide digital Anda bersama tim profesional kami
        </p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('contact.index') }}" class="btn btn-secondary">Hubungi Kami</a>
            <a href="{{ route('services.index') }}" class="btn" style="background: transparent; border: 2px solid white;">Lihat Layanan</a>
        </div>
    </div>
</section>
@endsection
