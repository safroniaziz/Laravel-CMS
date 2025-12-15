{{-- Modern Grid Layout --}}
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 35px;">
    @forelse($posts as $post)
        <article style="background: {{ $blogSettings['cards']['bg_color'] }}; border-radius: {{ $blogSettings['cards']['border_radius'] }}px; overflow: hidden; box-shadow: {{ $blogSettings['cards']['shadow'] }}; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; border: 1px solid rgba(0,0,0,0.05); display: flex; flex-direction: column; height: 100%;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='{{ $blogSettings['cards']['hover_shadow'] }}';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='{{ $blogSettings['cards']['shadow'] }}';">
            <!-- Image with Gradient Overlay -->
            <div style="position: relative; height: 240px; overflow: hidden; background: linear-gradient(135deg, {{ $blogSettings['cards']['primary_color'] }}, {{ $blogSettings['cards']['primary_color'] }}dd);">
                @if($post->featured_image)
                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;">
                    <!-- Gradient Overlay -->
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.4), transparent 60%); opacity: 0; transition: opacity 0.3s;" class="img-overlay"></div>
                @else
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-newspaper" style="font-size: 64px; color: rgba(255,255,255,0.3);"></i>
                    </div>
                @endif
                
                <!-- Date Badge with Animation -->
                <div style="position: absolute; top: 20px; left: 20px; background: rgba(255,255,255,0.98); backdrop-filter: blur(12px); border-radius: 14px; padding: 12px 16px; box-shadow: 0 6px 20px rgba(0,0,0,0.15); text-align: center; transform: translateY(0); transition: transform 0.3s;" class="date-badge">
                    <div style="font-size: 26px; font-weight: 900; color: {{ $blogSettings['cards']['primary_color'] }}; line-height: 1;">{{ $post->created_at->format('d') }}</div>
                    <div style="font-size: 11px; font-weight: 700; color: {{ $blogSettings['cards']['primary_color'] }}; text-transform: uppercase; letter-spacing: 1.2px;">{{ $post->created_at->format('M') }}</div>
                </div>

                <!-- Category Badge with Glow -->
                @if($post->category)
                    <div style="position: absolute; top: 20px; right: 20px; background: linear-gradient(135deg, {{ $blogSettings['cards']['accent_color'] }}ee, {{ $blogSettings['cards']['accent_color'] }}); color: #fff; padding: 7px 16px; border-radius: 22px; font-size: 11px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; box-shadow: 0 4px 15px {{ $blogSettings['cards']['accent_color'] }}50; transition: all 0.3s;" class="category-badge">
                        {{ $post->category->name }}
                    </div>
                @endif
            </div>

            <style>
                article:hover .img-overlay {
                    opacity: 1 !important;
                }
                article:hover img {
                    transform: scale(1.08) !important;
                }
                article:hover .date-badge {
                    transform: translateY(-3px) !important;
                }
                article:hover .category-badge {
                    box-shadow: 0 6px 25px {{ $blogSettings['cards']['accent_color'] }}70 !important;
                }
            </style>

            <!-- Content -->
            <div style="padding: 28px; display: flex; flex-direction: column; flex: 1;">
                <h3 style="font-size: {{ $blogSettings['typography']['card_title_size'] }}px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 14px 0; line-height: 1.3;">
                    <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='{{ $blogSettings['cards']['primary_color'] }}';" onmouseout="this.style.color='{{ $blogSettings['typography']['card_title_color'] }}';">
                        {{ $post->title }}
                    </a>
                </h3>

                @if($post->excerpt)
                    <p style="color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 14px; line-height: 1.7; margin: 0 0 auto 0;">
                        {{ Str::limit($post->excerpt, 120) }}
                    </p>
                @endif

                <!-- Meta -->
                <div style="display: flex; align-items: center; gap: 20px; padding-top: 18px; margin-top: 20px; border-top: 1px solid #f1f5f9; flex-wrap: wrap;">
                    <span style="display: flex; align-items: center; gap: 6px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 13px;">
                        <i class="fas fa-user" style="color: {{ $blogSettings['cards']['primary_color'] }};"></i>
                        <span>{{ $post->author->name ?? 'Admin' }}</span>
                    </span>
                    <span style="display: flex; align-items: center; gap: 6px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 13px;">
                        <i class="fas fa-clock" style="color: {{ $blogSettings['cards']['accent_color'] }};"></i>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                    </span>
                    <span style="display: flex; align-items: center; gap: 6px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 13px;">
                        <i class="fas fa-eye" style="color: #8b5cf6;"></i>
                        <span>{{ number_format($post->views ?? 0) }}</span>
                    </span>
                </div>

                <!-- Read More Button -->
                <a href="{{ route('blog.show', $post->slug) }}" style="display: inline-flex; align-items: center; gap: 8px; margin-top: 20px; padding: 12px 24px; background: linear-gradient(135deg, {{ $blogSettings['cards']['primary_color'] }}, {{ $blogSettings['cards']['primary_color'] }}dd); color: #fff; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 600; transition: all 0.3s; box-shadow: 0 4px 12px {{ $blogSettings['cards']['primary_color'] }}40; align-self: flex-start;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 6px 20px {{ $blogSettings['cards']['primary_color'] }}60';" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 4px 12px {{ $blogSettings['cards']['primary_color'] }}40';">
                    Baca Selengkapnya
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </article>
    @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 80px 20px; background: {{ $blogSettings['cards']['bg_color'] }}; border-radius: {{ $blogSettings['cards']['border_radius'] }}px; box-shadow: {{ $blogSettings['cards']['shadow'] }};">
            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 25px;">
                <i class="fas fa-newspaper" style="font-size: 48px; color: {{ $blogSettings['cards']['primary_color'] }};"></i>
            </div>
            <h3 style="font-size: 24px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 12px 0;">Belum Ada Berita</h3>
            <p style="color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 16px; margin: 0;">Belum ada berita yang dipublikasikan saat ini</p>
        </div>
    @endforelse
</div>
