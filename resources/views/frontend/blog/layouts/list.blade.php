{{-- Classic List Layout --}}
<div style="display: flex; flex-direction: column; gap: 30px;">
    @forelse($posts as $post)
        <article style="background: {{ $blogSettings['cards']['bg_color'] }}; border-radius: {{ $blogSettings['cards']['border_radius'] }}px; overflow: hidden; box-shadow: {{ $blogSettings['cards']['shadow'] }}; transition: all 0.3s; border: 1px solid rgba(0,0,0,0.05); display: flex; flex-direction: row; gap: 0;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='{{ $blogSettings['cards']['hover_shadow'] }}';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='{{ $blogSettings['cards']['shadow'] }}';">
            <!-- Featured Image -->
            <div style="position: relative; width: 350px; flex-shrink: 0; overflow: hidden; background: linear-gradient(135deg, {{ $blogSettings['cards']['primary_color'] }}, {{ $blogSettings['cards']['primary_color'] }}dd);">
                @if($post->featured_image)
                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';">
                @else
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; min-height: 280px;">
                        <i class="fas fa-newspaper" style="font-size: 80px; color: rgba(255,255,255,0.3);"></i>
                    </div>
                @endif
                
                <!-- Category Badge -->
                @if($post->category)
                    <div style="position: absolute; top: 20px; left: 20px; background: linear-gradient(135deg, {{ $blogSettings['cards']['accent_color'] }}, {{ $blogSettings['cards']['accent_color'] }}dd); color: #fff; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                        {{ $post->category->name }}
                    </div>
                @endif
            </div>

            <!-- Content -->
            <div style="flex: 1; padding: 35px; display: flex; flex-direction: column;">
                <!-- Date -->
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 13px; font-weight: 600;">
                    <i class="fas fa-calendar-alt" style="color: {{ $blogSettings['cards']['primary_color'] }};"></i>
                    {{ $post->created_at->format('d M Y') }}
                </div>

                <h3 style="font-size: {{ intval($blogSettings['typography']['card_title_size']) + 4 }}px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 15px 0; line-height: 1.3;">
                    <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='{{ $blogSettings['cards']['primary_color'] }}';" onmouseout="this.style.color='{{ $blogSettings['typography']['card_title_color'] }}';">
                        {{ $post->title }}
                    </a>
                </h3>

                @if($post->excerpt)
                    <p style="color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 15px; line-height: 1.8; margin: 0 0 20px 0; flex: 1;">
                        {{ Str::limit($post->excerpt, 200) }}
                    </p>
                @endif

                <!-- Footer Meta -->
                <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 20px; border-top: 1px solid #f1f5f9; flex-wrap: wrap; gap: 15px;">
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <span style="display: flex; align-items: center; gap: 6px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 14px;">
                            <i class="fas fa-user" style="color: {{ $blogSettings['cards']['primary_color'] }};"></i>
                            {{ $post->author->name ?? 'Admin' }}
                        </span>
                        <span style="display: flex; align-items: center; gap: 6px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 14px;">
                            <i class="fas fa-clock" style="color: {{ $blogSettings['cards']['accent_color'] }};"></i>
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                        <span style="display: flex; align-items: center; gap: 6px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 14px;">
                            <i class="fas fa-eye" style="color: #8b5cf6;"></i>
                            {{ number_format($post->views ?? 0) }}
                        </span>
                    </div>
                    
                    <a href="{{ route('blog.show', $post->slug) }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: linear-gradient(135deg, {{ $blogSettings['cards']['primary_color'] }}, {{ $blogSettings['cards']['primary_color'] }}dd); color: #fff; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 600; transition: all 0.3s; box-shadow: 0 4px 12px {{ $blogSettings['cards']['primary_color'] }}40;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 6px 20px {{ $blogSettings['cards']['primary_color'] }}60';" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 4px 12px {{ $blogSettings['cards']['primary_color'] }}40';">
                        Baca Artikel
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </article>
    @empty
        <div style="text-align: center; padding: 80px 20px; background: {{ $blogSettings['cards']['bg_color'] }}; border-radius: {{ $blogSettings['cards']['border_radius'] }}px; box-shadow: {{ $blogSettings['cards']['shadow'] }};">
            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 25px;">
                <i class="fas fa-newspaper" style="font-size: 48px; color: {{ $blogSettings['cards']['primary_color'] }};"></i>
            </div>
            <h3 style="font-size: 24px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 12px 0;">Belum Ada Berita</h3>
            <p style="color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 16px; margin: 0;">Belum ada berita yang dipublikasikan saat ini</p>
        </div>
    @endforelse
</div>

<style>
    @media (max-width: 968px) {
        article[style*="flex-direction: row"] {
            flex-direction: column !important;
        }
        article[style*="flex-direction: row"] > div:first-child {
            width: 100% !important;
            min-height: 250px !important;
        }
    }
</style>
