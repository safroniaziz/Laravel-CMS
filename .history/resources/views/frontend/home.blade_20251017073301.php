@extends('layouts.frontend')

@section('content')
<!-- Hero Slider -->
@if($sliders->count() > 0)
<div id="heroCarousel" class="carousel slide hero-section" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($sliders as $index => $slider)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            @if($slider->image)
            <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}">
            @endif
            <div class="carousel-caption">
                <div class="container">
                    <h1 class="display-4 fw-bold">{{ $slider->title }}</h1>
                    @if($slider->subtitle)
                    <h3>{{ $slider->subtitle }}</h3>
                    @endif
                    @if($slider->description)
                    <p class="lead">{{ $slider->description }}</p>
                    @endif
                    @if($slider->button_text && $slider->button_url)
                    <a href="{{ $slider->button_url }}" class="btn btn-lg btn-primary" target="{{ $slider->button_target }}">
                        {{ $slider->button_text }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if($sliders->count() > 1)
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
    @endif
</div>
@endif

<!-- Services Section -->
@if($services->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="section-title">
            <h2>Our Services</h2>
            <p>Discover what we can do for you</p>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->title }}">
                    @endif
                    <div class="card-body text-center">
                        @if($service->icon)
                        <i class="{{ $service->icon }} fa-3x text-primary mb-3"></i>
                        @endif
                        <h5 class="card-title">{{ $service->title }}</h5>
                        <p class="card-text">{{ $service->description }}</p>
                        <a href="{{ route('services.show', $service->slug) }}" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Portfolio Section -->
@if($portfolios->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title">
            <h2>Our Portfolio</h2>
            <p>Check out our recent projects</p>
        </div>
        <div class="row g-4">
            @foreach($portfolios as $portfolio)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($portfolio->featured_image)
                    <img src="{{ asset('storage/' . $portfolio->featured_image) }}" class="card-img-top" alt="{{ $portfolio->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $portfolio->title }}</h5>
                        <p class="card-text">{{ truncate($portfolio->description, 100) }}</p>
                        <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="btn btn-primary">View Project</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('portfolio.index') }}" class="btn btn-lg btn-primary">View All Projects</a>
        </div>
    </div>
</section>
@endif

<!-- Testimonials Section -->
@if($testimonials->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="section-title">
            <h2>What Our Clients Say</h2>
            <p>Testimonials from satisfied customers</p>
        </div>
        <div class="row g-4">
            @foreach($testimonials as $testimonial)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="fas fa-star text-warning"></i>
                            @endfor
                        </div>
                        <p class="card-text">"{{ $testimonial->content }}"</p>
                        <div class="d-flex align-items-center mt-3">
                            @if($testimonial->avatar)
                            <img src="{{ asset('storage/' . $testimonial->avatar) }}" class="rounded-circle me-3" width="50" height="50">
                            @endif
                            <div>
                                <strong>{{ $testimonial->name }}</strong><br>
                                <small class="text-muted">{{ $testimonial->position }}{{ $testimonial->company ? ', ' . $testimonial->company : '' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Posts Section -->
@if($latestPosts->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title">
            <h2>Latest News</h2>
            <p>Stay updated with our latest articles</p>
        </div>
        <div class="row g-4">
            @foreach($latestPosts as $post)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $post->category->name }}</span>
                            <small class="text-muted ms-2">{{ format_date($post->published_at, 'd M Y') }}</small>
                        </div>
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ truncate($post->excerpt, 100) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('blog.index') }}" class="btn btn-lg btn-primary">View All Posts</a>
        </div>
    </div>
</section>
@endif

<!-- Partners Section -->
@if($partners->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="section-title">
            <h2>Our Partners</h2>
            <p>Trusted by leading companies</p>
        </div>
        <div class="row g-4 align-items-center justify-content-center">
            @foreach($partners as $partner)
            <div class="col-6 col-md-2 text-center">
                @if($partner->logo)
                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="img-fluid" style="max-height: 60px; opacity: 0.7;">
                @else
                <p>{{ $partner->name }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <h2 class="mb-3">Ready to Get Started?</h2>
        <p class="lead mb-4">Contact us today to discuss your project</p>
        <a href="{{ route('contact.index') }}" class="btn btn-lg btn-light">Contact Us</a>
    </div>
</section>
@endsection

