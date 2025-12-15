@extends('layouts.frontend')

@section('content')
@if($blogSettings['hero']['enabled'])
<!-- Hero Header with Dynamic Gradient -->
<section style="padding: 100px 0 80px; background: linear-gradient(135deg, {{ $blogSettings['hero']['gradient_start'] }} 0%, {{ $blogSettings['hero']['gradient_end'] }} 100%); position: relative; overflow: hidden;">
    <!-- Animated Background -->
    <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
    <div style="position: absolute; bottom: -150px; left: -150px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite reverse;"></div>
    
    <div class="container" style="position: relative; z-index: 2; text-align: center;">
        @if($blogSettings['hero']['badge_enabled'])
        <div style="display: inline-flex; align-items: center; gap: 10px; padding: 8px 20px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 25px; margin-bottom: 25px; border: 1px solid rgba(255,255,255,0.2);">
            <i class="fas {{ $blogSettings['hero']['badge_icon'] }}" style="color: {{ $blogSettings['cards']['accent_color'] }}; font-size: 14px;"></i>
            <span style="color: #fff; font-size: 13px; font-weight: 600; letter-spacing: 1px;">{{ $blogSettings['hero']['badge_text'] }}</span>
        </div>
        @endif
        
        <h1 style="font-size: 56px; font-weight: 900; color: #fff; margin: 0 0 20px 0; line-height: 1.1;">
            {{ $blogSettings['hero']['title'] }}
        </h1>
        <p style="font-size: 20px; color: rgba(255,255,255,0.9); max-width: 600px; margin: 0 auto; line-height: 1.6;">
            {{ $blogSettings['hero']['subtitle'] }}
        </p>
    </div>
</section>
@endif

<!-- Blog Content -->
<section style="padding: 80px 0; background: {{ $blogSettings['bg_color'] }};">
    <div class="container">
        @php
            $showSidebar = isset($blogSettings['show_sidebar']) && $blogSettings['show_sidebar'];
        @endphp
        <div style="display: grid; grid-template-columns: {{ $showSidebar ? '1fr 350px' : '1fr' }}; gap: 50px; align-items: start;">
            <!-- Main Content -->
            <div style="{{ !$showSidebar ? 'max-width: 1400px; margin: 0 auto; width: 100%;' : '' }}">
                @if(request('category') || request('search'))
                    <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 20px 25px; border-radius: 12px; margin-bottom: 40px; border-left: 4px solid #3b82f6; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.1);">
                        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                            <i class="fas fa-filter" style="color: #3b82f6; font-size: 16px;"></i>
                            <strong style="color: #1e3a8a;">Filter Aktif:</strong>
                            @if(request('category'))
                                <span style="padding: 6px 16px; background: #3b82f6; color: #fff; border-radius: 20px; font-size: 13px; font-weight: 600;">{{ request('category') }}</span>
                            @endif
                            @if(request('search'))
                                <span style="padding: 6px 16px; background: #8b5cf6; color: #fff; border-radius: 20px; font-size: 13px; font-weight: 600;">"{{ request('search') }}"</span>
                            @endif
                            <a href="{{ route('blog.index') }}" style="margin-left: auto; padding: 6px 16px; background: rgba(255,255,255,0.8); color: #3b82f6; border-radius: 20px; text-decoration: none; font-size: 13px; font-weight: 600; transition: all 0.3s;">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        </div>
                    </div>
                @endif
                
                @if(isset($layoutView))
                    @include($layoutView, ['posts' => $posts])
                @endif

                <!-- Pagination -->
                @if($posts->hasPages())
                    <div style="margin-top: 60px;">
                        {{ $posts->links('vendor.pagination.blog-pagination') }}
                    </div>
                @endif
            </div>

            <!-- Sidebar (Conditional) -->
            @if($showSidebar)
                <aside style="position: sticky; top: 20px;">
                    <!-- Search Widget -->
                    <div style="background: {{ $blogSettings['sidebar']['bg_color'] }}; padding: 25px; border-radius: 12px; margin-bottom: 25px; border: 1px solid {{ $blogSettings['sidebar']['border_color'] }}; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                        <h3 style="font-size: 18px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 20px 0; display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-search" style="color: {{ $blogSettings['cards']['primary_color'] }};"></i>
                            Cari Berita
                        </h3>
                        <form action="{{ route('blog.index') }}" method="GET" style="position: relative;">
                            <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}" style="width: 100%; padding: 12px 45px 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.3s;" onfocus="this.style.borderColor='{{ $blogSettings['cards']['primary_color'] }}';" onblur="this.style.borderColor='#e2e8f0';">
                            <button type="submit" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); padding: 8px 16px; background: {{ $blogSettings['cards']['primary_color'] }}; color: #fff; border: none; border-radius: 6px; cursor: pointer;">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    @if($categories->isNotEmpty())
                    <div style="background: {{ $blogSettings['sidebar']['bg_color'] }}; padding: 25px; border-radius: 12px; margin-bottom: 25px; border: 1px solid {{ $blogSettings['sidebar']['border_color'] }}; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                        <h3 style="font-size: 18px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 20px 0; display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-folder" style="color: {{ $blogSettings['cards']['accent_color'] }};"></i>
                            Kategori
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            @foreach($categories as $category)
                                <a href="{{ route('blog.index', ['category' => $category->slug]) }}" style="display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; background: #f8fafc; border-radius: 8px; text-decoration: none; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; transition: all 0.3s; border: 1px solid transparent;" onmouseover="this.style.background='{{ $blogSettings['cards']['primary_color'] }}15'; this.style.borderColor='{{ $blogSettings['cards']['primary_color'] }}'; this.style.color='{{ $blogSettings['cards']['primary_color'] }}';" onmouseout="this.style.background='#f8fafc'; this.style.borderColor='transparent'; this.style.color='{{ $blogSettings['typography']['card_excerpt_color'] }}';">
                                    <span style="font-weight: 600; font-size: 14px;">{{ $category->name }}</span>
                                    <span style="padding: 4px 10px; background: {{ $blogSettings['cards']['accent_color'] }}20; color: {{ $blogSettings['cards']['accent_color'] }}; border-radius: 12px; font-size: 12px; font-weight: 700;">{{ $category->posts_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Popular Tags -->
                    @if(isset($tags) && $tags->isNotEmpty())
                    <div style="background: {{ $blogSettings['sidebar']['bg_color'] }}; padding: 25px; border-radius: 12px; border: 1px solid {{ $blogSettings['sidebar']['border_color'] }}; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                        <h3 style="font-size: 18px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 20px 0; display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-tags" style="color: #8b5cf6;"></i>
                            Tag Populer
                        </h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                            @foreach($tags as $tag)
                                <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" style="padding: 8px 16px; background: #f1f5f9; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: 600; transition: all 0.3s; border: 1px solid transparent;" onmouseover="this.style.background='#8b5cf6'; this.style.color='#fff';" onmouseout="this.style.background='#f1f5f9'; this.style.color='{{ $blogSettings['typography']['card_excerpt_color'] }}';">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </aside>
            @endif
        </div>
    </div>
</section>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
</style>
@endsection
