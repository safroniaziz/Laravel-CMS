{{-- Masonry Layout (Pinterest-style Grid) --}}
<div class="masonry-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; align-items: start;">
    @forelse($posts as $post)
        <article style="background: {{ $blogSettings['cards']['bg_color'] }}; border-radius: {{ $blogSettings['cards']['border_radius'] }}px; overflow: hidden; box-shadow: {{ $blogSettings['cards']['shadow'] }}; transition: all 0.3s; border: 1px solid rgba(0,0,0,0.05);" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='{{ $blogSettings['cards']['hover_shadow'] }}';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='{{ $blogSettings['cards']['shadow'] }}';">
            <!-- Image -->
            <div style="position: relative; overflow: hidden; background: linear-gradient(135deg, {{ $blogSettings['cards']['primary_color'] }}, {{ $blogSettings['cards']['primary_color'] }}dd);">
                @if($post->featured_image)
                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: auto; display: block; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';">
                @else
                    <div style="width: 100%; padding-bottom: 75%; position: relative;">
                        <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-newspaper" style="font-size: 48px; color: rgba(255,255,255,0.3);"></i>
                        </div>
                    </div>
                @endif
                
                <!-- Category Badge -->
                @if($post->category)
                    <div style="position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, {{ $blogSettings['cards']['accent_color'] }}, {{ $blogSettings['cards']['accent_color'] }}dd); color: #fff; padding: 5px 12px; border-radius: 15px; font-size: 10px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                        {{ $post->category->name }}
                    </div>
                @endif
            </div>

            <!-- Content -->
            <div style="padding: 20px;">
                <!-- Date -->
                <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 10px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 12px; font-weight: 600;">
                    <i class="fas fa-calendar" style="color: {{ $blogSettings['cards']['primary_color'] }};"></i>
                    {{ $post->created_at->format('d M Y') }}
                </div>

                <h3 style="font-size: {{ intval($blogSettings['typography']['card_title_size']) - 2 }}px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 10px 0; line-height: 1.3;">
                    <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='{{ $blogSettings['cards']['primary_color'] }}';" onmouseout="this.style.color='{{ $blogSettings['typography']['card_title_color'] }}';">
                        {{ $post->title }}
                    </a>
                </h3>

                @if($post->excerpt)
                    <p style="color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 13px; line-height: 1.6; margin: 0 0 15px 0;">
                        {{ Str::limit($post->excerpt, 100) }}
                    </p>
                @endif

                <!-- Meta -->
                <div style="display: flex; align-items: center; gap: 15px; padding-top: 12px; border-top: 1px solid #f1f5f9; flex-wrap: wrap;">
                    <span style="display: flex; align-items: center; gap: 5px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 12px;">
                        <i class="fas fa-user" style="color: {{ $blogSettings['cards']['primary_color'] }};"></i>
                        {{ Str::limit($post->author->name ?? 'Admin', 12) }}
                    </span>
                    <span style="display: flex; align-items: center; gap: 5px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 12px;">
                        <i class="fas fa-clock" style="color: {{ $blogSettings['cards']['accent_color'] }};"></i>
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                    <span style="display: flex; align-items: center; gap: 5px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 12px;">
                        <i class="fas fa-eye" style="color: #8b5cf6;"></i>
                        {{ number_format($post->views ?? 0) }}
                    </span>
                </div>
            </div>
        </article>
    @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 80px 20px; background: {{ $blogSettings['cards']['bg_color'] }}; border-radius: {{ $blogSettings['cards']['border_radius'] }}px; box-shadow: {{ $blogSettings['cards']['shadow'] }};">
            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 25px;">
                <i class="fas fa-newspaper" style="font-size: 48px; color: {{ $blogSettings['cards']['primary_color'] }};"></i>
            </div>
            <h3 style="font-size: 24px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 12px 0;">Belum Ada Berita</h3>
            <p style="color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 16px; margin: 0;">Belum ada berita yang dipublikasikan saat ini</p>
        </div>
    @endforelse
</div>
