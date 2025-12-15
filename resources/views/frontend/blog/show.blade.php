@extends('layouts.frontend')

@section('title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description ?? $post->excerpt)
@section('meta_keywords', $post->meta_keywords ?? '')

@section('content')
<!-- Reading Progress Bar -->
<div id="reading-progress" style="position: fixed; top: 0; left: 0; width: 0%; height: 4px; background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899); z-index: 9999; transition: width 0.1s;"></div>

<!-- Hero Section with Parallax Effect -->
<section style="background: linear-gradient(135deg, {{ $detailSettings['hero']['gradient_start'] }} 0%, {{ $detailSettings['hero']['gradient_middle'] }} 50%, {{ $detailSettings['hero']['gradient_end'] }} 100%); padding: 120px 0 80px; position: relative; overflow: hidden;">
    <!-- Animated Background -->
    <div style="position: absolute; inset: 0; opacity: 0.1;">
        <div style="position: absolute; top: 20%; left: 10%; width: 300px; height: 300px; background: radial-gradient(circle, #3b82f6 0%, transparent 70%); border-radius: 50%; animation: float 20s ease-in-out infinite;"></div>
        <div style="position: absolute; top: 60%; right: 15%; width: 200px; height: 200px; background: radial-gradient(circle, #8b5cf6 0%, transparent 70%); border-radius: 50%; animation: float 15s ease-in-out infinite reverse;"></div>
    </div>
    
    <div class="container" style="max-width: 1300px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 2;">
        <!-- Breadcrumb -->
        <nav style="margin-bottom: 30px;">
            <ol style="list-style: none; padding: 0; display: flex; gap: 10px; flex-wrap: wrap; align-items: center; font-size: 14px;">
                <li><a href="{{ route('home') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#fff'; this.style.textDecoration='underline'" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.textDecoration='none'"><i class="fas fa-home"></i> Home</a></li>
                <li style="color: rgba(255,255,255,0.4);"><i class="fas fa-chevron-right" style="font-size: 10px;"></i></li>
                <li><a href="{{ route('blog.index') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#fff'; this.style.textDecoration='underline'" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.textDecoration='none'">Blog</a></li>
                <li style="color: rgba(255,255,255,0.4);"><i class="fas fa-chevron-right" style="font-size: 10px;"></i></li>
                <li style="color: #60a5fa; font-weight: 600;">{{ Str::limit($post->title, 30) }}</li>
            </ol>
        </nav>

        <!-- Category Badge -->
        @if($post->category)
            <div style="margin-bottom: 20px;">
                <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" style="display: inline-block; padding: 8px 20px; background: linear-gradient(135deg, #f59e0b, #fbbf24); color: #fff; text-decoration: none; border-radius: 30px; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; box-shadow: 0 4px 15px rgba(245,158,11,0.4); transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(245,158,11,0.5)'" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 15px rgba(245,158,11,0.4)'">
                    <i class="fas fa-folder"></i> {{ $post->category->name }}
                </a>
            </div>
        @endif

        <!-- Title -->
        <h1 style="font-size: 48px; font-weight: 900; color: {{ $detailSettings['hero']['text_color'] }}; margin: 0 0 25px 0; line-height: 1.1; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
            {{ $post->title }}
        </h1>
        
        <!-- Excerpt -->
        @if($post->excerpt)
            <p style="font-size: 20px; line-height: 1.6; color: {{ $detailSettings['hero']['meta_color'] }}; margin: 0 0 30px 0; font-weight: 400;">
                {{ $post->excerpt }}
            </p>
        @endif

        <!-- Meta Info -->
        <div style="display: flex; align-items: center; gap: 30px; flex-wrap: wrap; padding: 25px 0; border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #8b5cf6); display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700; color: #fff; box-shadow: 0 4px 15px rgba(59,130,246,0.4);">
                    {{ substr($post->author->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <div style="font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 4px;">{{ $post->author->name ?? 'Admin' }}</div>
                    <div style="font-size: 13px; color: rgba(255,255,255,0.6);">Author</div>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 20px; color: rgba(255,255,255,0.7); font-size: 14px;">
                <span style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-calendar-alt" style="color: #60a5fa;"></i>
                    {{ $post->published_at->format('d M Y') }}
                </span>
                <span style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-clock" style="color: #fbbf24;"></i>
                    {{ $post->created_at->diffForHumans() }}
                </span>
                <span style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-eye" style="color: #8b5cf6;"></i>
                    {{ number_format($post->views) }} views
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 80px 0; background: linear-gradient(180deg, #f8fafc 0%, #fff 100%);">
    <div class="container" style="max-width: 1300px; margin: 0 auto; padding: 0 20px;">
        <div style="display: grid; grid-template-columns: 1fr 380px; gap: 60px; align-items: start;">
            
            <!-- Article Content -->
            <article>
                <!-- Featured Image -->
                @if($post->featured_image)
                    <div style="margin-bottom: 50px; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15); position: relative;">
                        <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: auto; display: block;">
                        <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.4) 100%); pointer-events: none;"></div>
                    </div>
                @endif

                <!-- Tags -->
                @if($post->tags->count() > 0)
                    <div style="margin-bottom: 40px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                            <i class="fas fa-tags" style="color: #3b82f6; font-size: 18px;"></i>
                            <h4 style="font-size: 14px; font-weight: 700; color: #64748b; margin: 0; text-transform: uppercase; letter-spacing: 1px;">Tags</h4>
                        </div>
                        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" style="padding: 10px 20px; background: #fff; color: #475569; text-decoration: none; border-radius: 30px; font-size: 14px; font-weight: 600; transition: all 0.3s; border: 2px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04);" onmouseover="this.style.background='linear-gradient(135deg, #3b82f6, #2563eb)'; this.style.color='#fff'; this.style.borderColor='#3b82f6'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(59,130,246,0.3)'" onmouseout="this.style.background='#fff'; this.style.color='#475569'; this.style.borderColor='#e2e8f0'; this.style.transform='none'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">
                                    <i class="fas fa-hashtag" style="font-size: 12px; opacity: 0.7;"></i> {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Content Box -->
                <div style="background: #fff; border-radius: 24px; padding: 60px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.05);">
                    <div class="blog-content" style="font-size: 18px; line-height: 1.9; color: #334155;">
                        {!! $post->content !!}
                    </div>
                </div>

                <!-- Share Section -->
                <div style="margin-top: 60px; padding: 40px; background: linear-gradient(135deg, {{ $detailSettings['social']['bg_start'] }} 0%, {{ $detailSettings['social']['bg_end'] }} 100%); border-radius: 24px; border: 2px solid {{ $detailSettings['social']['border_color'] }};">
                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 25px;">
                        <div>
                            <h4 style="font-size: 22px; font-weight: 800; color: #1e3a8a; margin: 0 0 8px 0;">
                                <i class="fas fa-share-alt"></i> Bagikan Artikel Ini
                            </h4>
                            <p style="color: #3b82f6; margin: 0; font-size: 14px;">Bantu teman Anda menemukan artikel bermanfaat ini</p>
                        </div>
                        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" style="width: 50px; height: 50px; background: #1877f2; color: #fff; text-decoration: none; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; transition: all 0.3s; box-shadow: 0 4px 12px rgba(24,119,242,0.3);" onmouseover="this.style.transform='translateY(-4px) scale(1.1)'; this.style.boxShadow='0 8px 25px rgba(24,119,242,0.5)'" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 12px rgba(24,119,242,0.3)'">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" style="width: 50px; height: 50px; background: #1da1f2; color: #fff; text-decoration: none; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; transition: all 0.3s; box-shadow: 0 4px 12px rgba(29,161,242,0.3);" onmouseover="this.style.transform='translateY(-4px) scale(1.1)'; this.style.boxShadow='0 8px 25px rgba(29,161,242,0.5)'" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 12px rgba(29,161,242,0.3)'">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . request()->url()) }}" target="_blank" style="width: 50px; height: 50px; background: #25d366; color: #fff; text-decoration: none; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; transition: all 0.3s; box-shadow: 0 4px 12px rgba(37,211,102,0.3);" onmouseover="this.style.transform='translateY(-4px) scale(1.1)'; this.style.boxShadow='0 8px 25px rgba(37,211,102,0.5)'" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 12px rgba(37,211,102,0.3)'">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" target="_blank" style="width: 50px; height: 50px; background: #0077b5; color: #fff; text-decoration: none; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; transition: all 0.3s; box-shadow: 0 4px 12px rgba(0,119,181,0.3);" onmouseover="this.style.transform='translateY(-4px) scale(1.1)'; this.style.boxShadow='0 8px 25px rgba(0,119,181,0.5)'" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 12px rgba(0,119,181,0.3)'">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <button onclick="copyToClipboard('{{ request()->url() }}')" style="width: 50px; height: 50px; background: #64748b; color: #fff; border: none; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(100,116,139,0.3);" onmouseover="this.style.transform='translateY(-4px) scale(1.1)'; this.style.boxShadow='0 8px 25px rgba(100,116,139,0.5)'" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 12px rgba(100,116,139,0.3)'">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Enhanced Sidebar -->
            <aside style="position: sticky; top: 100px;">
                <!-- Author Card -->
                <div style="background: linear-gradient(135deg, {{ $detailSettings['author']['gradient_start'] }} 0%, {{ $detailSettings['author']['gradient_end'] }} 100%); border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 40px rgba(245,158,11,0.2); border: 2px solid rgba(245,158,11,0.3);">
                    <div style="text-align: center;">
                        <div style="width: 80px; height: 80px; margin: 0 auto 20px; border-radius: 50%; background: linear-gradient(135deg, {{ $detailSettings['author']['avatar_gradient_start'] }}, {{ $detailSettings['author']['avatar_gradient_end'] }}); display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 900; color: #fff; box-shadow: 0 8px 25px rgba(245,158,11,0.4);">
                            {{ substr($post->author->name ?? 'A', 0, 1) }}
                        </div>
                        <h3 style="font-size: 20px; font-weight: 800; color: {{ $detailSettings['author']['text_color'] }}; margin: 0 0 8px 0;">{{ $post->author->name ?? 'Admin' }}</h3>
                        <p style="color: #b45309; font-size: 14px; margin: 0 0 20px 0; font-weight: 600;">
                            <i class="fas fa-pen-fancy"></i> Penulis
                        </p>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px; padding: 20px; background: rgba(255,255,255,0.5); border-radius: 12px;">
                            <div style="text-align: center;">
                                <div style="font-size: 24px; font-weight: 900; color: #92400e; margin-bottom: 4px;">
                                    {{ \App\Models\Post::where('author_id', $post->author_id)->published()->count() }}
                                </div>
                                <div style="font-size: 12px; color: #b45309; font-weight: 600;">Artikel</div>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: 24px; font-weight: 900; color: #92400e; margin-bottom: 4px;">
                                    {{ \App\Models\Post::where('author_id', $post->author_id)->sum('views') }}
                                </div>
                                <div style="font-size: 12px; color: #b45309; font-weight: 600;">Total Views</div>
                            </div>
                        </div>
                        
                        <div style="padding: 15px; background: rgba(255,255,255,0.7); border-radius: 10px; text-align: left;">
                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                <i class="fas fa-calendar-check" style="color: #f59e0b; width: 18px;"></i>
                                <span style="color: #78350f; font-size: 13px;">
                                    Bergabung {{ $post->author?->created_at?->format('M Y') ?? 'sejak awal' }}
                                </span>
                            </div>
                            @if($post->author?->email)
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-envelope" style="color: #f59e0b; width: 18px;"></i>
                                <a href="mailto:{{ $post->author->email }}" style="color: #1e40af; font-size: 13px; text-decoration: none; font-weight: 600; transition: color 0.3s;" onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#1e40af'">
                                    Hubungi Penulis
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                <div style="background: #fff; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.05);">
                    <h3 style="font-size: 20px; font-weight: 800; color: #1e293b; margin: 0 0 25px 0; display: flex; align-items: center; gap: 12px;">
                        <div style="width: 6px; height: 28px; background: linear-gradient(180deg, #3b82f6, #8b5cf6); border-radius: 10px;"></div>
                        Artikel Terkait
                    </h3>
                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        @foreach($relatedPosts as $related)
                            <a href="{{ route('blog.show', $related->slug) }}" style="display: flex; gap: 15px; text-decoration: none; padding: 15px; border-radius: 12px; transition: all 0.3s; border: 1px solid #f1f5f9;" onmouseover="this.style.background='#f8fafc'; this.style.transform='translateX(8px)'; this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.06)'" onmouseout="this.style.background='transparent'; this.style.transform='none'; this.style.borderColor='#f1f5f9'; this.style.boxShadow='none'">
                                @if($related->featured_image)
                                    <div style="width: 80px; height: 80px; flex-shrink: 0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                        <img src="{{ asset($related->featured_image) }}" alt="{{ $related->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endif
                                <div style="flex: 1; min-width: 0;">
                                    <h4 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0; line-height: 1.4; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $related->title }}</h4>
                                    <div style="display: flex; align-items: center; gap: 12px; text-align: 12px; color: #94a3b8;">
                                        <span><i class="fas fa-calendar" style="color: #3b82f6;"></i> {{ $related->created_at->format('d M') }}</span>
                                        <span><i class="fas fa-eye" style="color: #8b5cf6;"></i> {{ number_format($related->views ?? 0) }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Popular Categories -->
                @if($categories->count() > 0)
                <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-radius: 20px; padding: 30px; box-shadow: 0 10px 40px rgba(59,130,246,0.15); border: 2px solid #bfdbfe;">
                    <h3 style="font-size: 20px; font-weight: 800; color: #1e3a8a; margin: 0 0 25px 0; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-folder-open" style="color: #3b82f6;"></i>
                        Kategori Populer
                    </h3>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        @foreach($categories->take(6) as $category)
                            <a href="{{ route('blog.index', ['category' => $category->slug]) }}" style="display: flex; justify-content: space-between; align-items: center; padding: 14px 18px; background: rgba(255,255,255,0.7); border-radius: 12px; color: #1e40af; text-decoration: none; transition: all 0.3s; font-size: 15px; font-weight: 600; border: 1px solid #bfdbfe;" onmouseover="this.style.background='#fff'; this.style.paddingLeft='24px'; this.style.boxShadow='0 4px 12px rgba(59,130,246,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.7)'; this.style.paddingLeft='18px'; this.style.boxShadow='none'">
                                <span><i class="fas fa-chevron-right" style="font-size: 11px; margin-right: 12px; color: #3b82f6;"></i>{{ $category->name }}</span>
                                <span style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: #fff; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; box-shadow: 0 2px 8px rgba(59,130,246,0.3);">{{ $category->posts_count ?? 0 }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    /* Enhanced Content Styling */
    .blog-content h2, .blog-content h3 {
        font-weight: 800;
        color: {{ $detailSettings['content']['h2_color'] }};
        margin: 40px 0 20px 0;
        line-height: 1.3;
    }
    
    .blog-content h2 {
        font-size: {{ $detailSettings['content']['h2_size'] }}px;
        padding-bottom: 15px;
        border-bottom: 3px solid {{ $detailSettings['content']['h2_border_color'] }};
    }
    
    .blog-content h3 {
        font-size: {{ $detailSettings['content']['h3_size'] }}px;
        color: {{ $detailSettings['content']['h3_color'] }};
    }
    
    .blog-content p {
        margin-bottom: 24px;
    }
    
    .blog-content ul, .blog-content ol {
        padding-left: 30px;
        margin-bottom: 24px;
    }
    
    .blog-content li {
        margin-bottom: 12px;
        line-height: 1.8;
    }
    
    .blog-content a {
        color: {{ $detailSettings['content']['link_color'] }};
        font-weight: 600;
        text-decoration: underline;
        transition: color 0.3s;
    }
    
    .blog-content a:hover {
        color: #2563eb;
    }
    
    .blog-content blockquote {
        margin: 30px 0;
        padding: 25px 30px;
        background: linear-gradient(135deg, {{ $detailSettings['blockquote']['bg_start'] }}, {{ $detailSettings['blockquote']['bg_end'] }});
        border-left: 5px solid {{ $detailSettings['blockquote']['border_color'] }};
        border-radius: 0 12px 12px 0;
        font-style: italic;
        color: {{ $detailSettings['blockquote']['text_color'] }};
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(59,130,246,0.1);
    }
    
    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 30px 0;
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    
    .blog-content code {
        padding: 3px 8px;
        background: {{ $detailSettings['code']['bg'] }};
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        font-size: 0.9em;
        color: {{ $detailSettings['code']['text_color'] }};
        font-weight: 600;
    }
    
    .blog-content pre {
        background: {{ $detailSettings['code']['block_bg'] }};
        padding: 20px;
        border-radius: 12px;
        overflow-x: auto;
        margin: 30px 0;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .blog-content pre code {
        background: transparent;
        color: {{ $detailSettings['code']['block_text_color'] }};
        padding: 0;
    }

    @media (max-width: 1200px) {
        .container > div[style*="grid-template-columns: 1fr 380px"] {
            grid-template-columns: 1fr !important;
        }
        aside {
            position: relative !important;
            top: 0 !important;
        }
    }
</style>

<script>
// Reading Progress Bar
window.addEventListener('scroll', function() {
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    document.getElementById('reading-progress').style.width = scrolled + '%';
});

// Copy to Clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link berhasil disalin!');
    });
}
</script>
@endsection
