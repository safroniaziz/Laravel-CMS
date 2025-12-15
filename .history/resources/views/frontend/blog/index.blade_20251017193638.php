@extends('layouts.frontend')

@section('content')
<!-- Page Header -->
<section class="section" style="padding: 60px 0; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 42px; margin-bottom: 15px;">Berita & Artikel</h1>
        <p style="font-size: 18px; color: rgba(255,255,255,0.9);">Informasi terkini dan artikel menarik dari kami</p>
    </div>
</section>

<!-- Blog Content -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 300px; gap: 40px;">
            <!-- Main Content -->
            <div>
                @if(request('category') || request('search'))
                    <div style="background: var(--bg-light); padding: 15px 20px; border-radius: 8px; margin-bottom: 30px;">
                        <strong>Filter:</strong>
                        @if(request('category'))
                            <span style="margin-left: 10px;">Kategori: <strong>{{ request('category') }}</strong></span>
                        @endif
                        @if(request('search'))
                            <span style="margin-left: 10px;">Pencarian: <strong>{{ request('search') }}</strong></span>
                        @endif
                        <a href="{{ route('blog.index') }}" style="margin-left: 15px; color: var(--primary-color);">Reset Filter</a>
                    </div>
                @endif

                <div class="card-grid">
                    @forelse($posts as $post)
                        <article class="card">
                            <div class="card-image">
                                @if($post->featured_image)
                                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
                                @else
                                    <img src="https://via.placeholder.com/400x300/2563eb/ffffff?text={{ urlencode(substr($post->title, 0, 20)) }}" alt="{{ $post->title }}">
                                @endif
                                
                                <div class="card-date">
                                    <span class="day">{{ $post->created_at->format('d') }}</span>
                                    <span class="month">{{ $post->created_at->format('M') }}</span>
                                </div>

                                @if($post->category)
                                    <div class="card-badge">{{ $post->category->name }}</div>
                                @endif
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
                                    <span><i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}</span>
                                </div>

                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary" style="margin-top: 15px; display: inline-block;">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
                            <i class="fas fa-newspaper" style="font-size: 64px; color: var(--text-light); margin-bottom: 20px;"></i>
                            <h3 style="margin-bottom: 10px;">Tidak Ada Berita</h3>
                            <p style="color: var(--text-light);">Belum ada berita yang dipublikasikan</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($posts->hasPages())
                    <div style="margin-top: 40px;">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside>
                <!-- Search -->
                <div class="card" style="margin-bottom: 30px;">
                    <div class="card-content">
                        <h3 style="font-size: 18px; margin-bottom: 15px;">Pencarian</h3>
                        <form action="{{ route('blog.index') }}" method="GET">
                            <div style="display: flex; gap: 10px;">
                                <input type="text" 
                                       name="search" 
                                       placeholder="Cari berita..." 
                                       value="{{ request('search') }}"
                                       style="flex: 1; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Categories -->
                @if($categories->count() > 0)
                <div class="card" style="margin-bottom: 30px;">
                    <div class="card-content">
                        <h3 style="font-size: 18px; margin-bottom: 15px;">Kategori</h3>
                        <ul style="list-style: none;">
                            @foreach($categories as $category)
                                <li style="margin-bottom: 10px;">
                                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}" 
                                       style="display: flex; justify-content: space-between; align-items: center; padding: 8px 0; color: var(--text-dark); text-decoration: none; transition: color 0.3s;">
                                        <span><i class="fas fa-folder" style="margin-right: 8px; color: var(--primary-color);"></i> {{ $category->name }}</span>
                                        <span style="background: var(--bg-light); padding: 2px 10px; border-radius: 12px; font-size: 12px;">
                                            {{ $category->posts_count ?? 0 }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Popular Posts -->
                @if($popularPosts->count() > 0)
                <div class="card" style="margin-bottom: 30px;">
                    <div class="card-content">
                        <h3 style="font-size: 18px; margin-bottom: 15px;">Berita Populer</h3>
                        <ul style="list-style: none;">
                            @foreach($popularPosts as $popular)
                                <li style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color);">
                                    <div style="display: flex; gap: 15px;">
                                        @if($popular->featured_image)
                                            <img src="{{ asset($popular->featured_image) }}" 
                                                 alt="{{ $popular->title }}"
                                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                                        @endif
                                        <div style="flex: 1;">
                                            <a href="{{ route('blog.show', $popular->slug) }}" 
                                               style="color: var(--text-dark); text-decoration: none; font-weight: 600; display: block; margin-bottom: 5px; line-height: 1.4;">
                                                {{ Str::limit($popular->title, 50) }}
                                            </a>
                                            <span style="color: var(--text-light); font-size: 12px;">
                                                <i class="fas fa-calendar"></i> {{ $popular->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Tags -->
                @if($tags->count() > 0)
                <div class="card">
                    <div class="card-content">
                        <h3 style="font-size: 18px; margin-bottom: 15px;">Tags</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            @foreach($tags as $tag)
                                <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" 
                                   style="padding: 6px 15px; background: var(--bg-light); color: var(--text-dark); text-decoration: none; border-radius: 20px; font-size: 14px; transition: all 0.3s;">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>

@push('styles')
<style>
    @media (max-width: 768px) {
        .container > div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush
@endsection

