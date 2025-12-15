{{-- Magazine Layout (Featured + Grid) --}}
<div>
    @if($posts->isNotEmpty())
        {{-- Featured Post (Latest/First) --}}
        @php $featured = $posts->first(); @endphp
        <article style="background: {{ $blogSettings['cards']['bg_color'] }}; border-radius: {{ $blogSettings['cards']['border_radius'] }}px; overflow: hidden; box-shadow: {{ $blogSettings['cards']['shadow'] }}; transition: all 0.3s; border: 1px solid rgba(0,0,0,0.05); margin-bottom: 40px; display: grid; grid-template-columns: 1.2fr 1fr; gap: 0; min-height: 450px;" onmouseover="this.style.boxShadow='{{ $blogSettings['cards']['hover_shadow'] }}';" onmouseout="this.style.boxShadow='{{ $blogSettings['cards']['shadow'] }}';">
            {{-- Featured Image --}}
            <div style="position: relative; overflow: hidden; background: linear-gradient(135deg, {{ $blogSettings['cards']['primary_color'] }}, {{ $blogSettings['cards']['primary_color'] }}dd);">
                @if($featured->featured_image)
                    <img src="{{ asset($featured->featured_image) }}" alt="{{ $featured->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-newspaper" style="font-size: 100px; color: rgba(255,255,255,0.3);"></i>
                    </div>
                @endif
                
                {{-- Latest Badge --}}
                <div style="position: absolute; top: 25px; left: 25px; background: linear-gradient(135deg, #3b82f6, #2563eb); color: #fff; padding: 10px 20px; border-radius: 25px; font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);">
                    <i class="fas fa-newspaper"></i> TERBARU
                </div>
                
                @if($featured->category)
                    <div style="position: absolute; bottom: 25px; left: 25px; background: linear-gradient(135deg, {{ $blogSettings['cards']['accent_color'] }}, {{ $blogSettings['cards']['accent_color'] }}dd); color: #fff; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;">
                        {{ $featured->category->name }}
                    </div>
                @endif
            </div>

            {{-- Featured Content --}}
            <div style="padding: 45px; display: flex; flex-direction: column; justify-content: center;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 14px; font-weight: 600;">
                    <i class="fas fa-calendar-alt" style="color: {{ $blogSettings['cards']['primary_color'] }};"></i>
                    {{ $featured->created_at->format('d M Y') }}
                </div>

                <h2 style="font-size: {{ intval($blogSettings['typography']['card_title_size']) + 10 }}px; font-weight: 900; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 20px 0; line-height: 1.2;">
                    <a href="{{ route('blog.show', $featured->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='{{ $blogSettings['cards']['primary_color'] }}';" onmouseout="this.style.color='{{ $blogSettings['typography']['card_title_color'] }}';">
                        {{ $featured->title }}
                    </a>
                </h2>

                @if($featured->excerpt)
                    <p style="color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 16px; line-height: 1.8; margin: 0 0 25px 0;">
                        {{ Str::limit($featured->excerpt, 180) }}
                    </p>
                @endif

                <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 25px; flex-wrap: wrap;">
                    <span style="display: flex; align-items: center; gap: 6px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 14px;">
                        <i class="fas fa-user" style="color: {{ $blogSettings['cards']['primary_color'] }};"></i>
                        {{ $featured->author->name ?? 'Admin' }}
                    </span>
                    <span style="display: flex; align-items: center; gap: 6px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 14px;">
                        <i class="fas fa-clock" style="color: {{ $blogSettings['cards']['accent_color'] }};"></i>
                        {{ $featured->created_at->diffForHumans() }}
                    </span>
                    <span style="display: flex; align-items: center; gap: 6px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 14px;">
                        <i class="fas fa-eye" style="color: #8b5cf6;"></i>
                        {{ number_format($featured->views ?? 0) }} views
                    </span>
                </div>
                
                <a href="{{ route('blog.show', $featured->slug) }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 28px; background: linear-gradient(135deg, {{ $blogSettings['cards']['primary_color'] }}, {{ $blogSettings['cards']['primary_color'] }}dd); color: #fff; text-decoration: none; border-radius: 10px; font-size: 15px; font-weight: 700; transition: all 0.3s; box-shadow: 0 4px 15px {{ $blogSettings['cards']['primary_color'] }}40; align-self: flex-start;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 6px 25px {{ $blogSettings['cards']['primary_color'] }}60';" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 4px 15px {{ $blogSettings['cards']['primary_color'] }}40';">
                    Baca Artikel Utama
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </article>

        {{-- Other Posts (Grid) --}}
        @if($posts->count() > 1)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;">
                @foreach($posts->skip(1) as $post)
                    <article style="background: {{ $blogSettings['cards']['bg_color'] }}; border-radius: {{ $blogSettings['cards']['border_radius'] }}px; overflow: hidden; box-shadow: {{ $blogSettings['cards']['shadow'] }}; transition: all 0.3s; border: 1px solid rgba(0,0,0,0.05); display: flex; flex-direction: column;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='{{ $blogSettings['cards']['hover_shadow'] }}';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='{{ $blogSettings['cards']['shadow'] }}';">
                        <div style="position: relative; height: 180px; overflow: hidden; background: linear-gradient(135deg, {{ $blogSettings['cards']['primary_color'] }}, {{ $blogSettings['cards']['primary_color'] }}dd);">
                            @if($post->featured_image)
                                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-newspaper" style="font-size: 48px; color: rgba(255,255,255,0.3);"></i>
                                </div>
                            @endif
                            
                            @if($post->category)
                                <div style="position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, {{ $blogSettings['cards']['accent_color'] }}, {{ $blogSettings['cards']['accent_color'] }}dd); color: #fff; padding: 5px 12px; border-radius: 15px; font-size: 10px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;">
                                    {{ $post->category->name }}
                                </div>
                            @endif
                        </div>

                        <div style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
                            <h3 style="font-size: {{ intval($blogSettings['typography']['card_title_size']) - 2 }}px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 10px 0; line-height: 1.3;">
                                <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='{{ $blogSettings['cards']['primary_color'] }}';" onmouseout="this.style.color='{{ $blogSettings['typography']['card_title_color'] }}';">
                                    {{ Str::limit($post->title, 60) }}
                                </a>
                            </h3>

                            @if($post->excerpt)
                                <p style="color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 13px; line-height: 1.6; margin: 0 0 auto 0;">
                                    {{ Str::limit($post->excerpt, 80) }}
                                </p>
                            @endif

                            <div style="display: flex; align-items: center; gap: 12px; padding-top: 12px; margin-top: 12px; border-top: 1px solid #f1f5f9; font-size: 12px; color: {{ $blogSettings['typography']['card_excerpt_color'] }}; flex-wrap: wrap;">
                                <span><i class="fas fa-user" style="color: {{ $blogSettings['cards']['primary_color'] }};"></i> {{ Str::limit($post->author->name ?? 'Admin', 15) }}</span>
                                <span><i class="fas fa-calendar" style="color: {{ $blogSettings['cards']['accent_color'] }};"></i> {{ $post->created_at->format('d M') }}</span>
                                <span><i class="fas fa-eye" style="color: #8b5cf6;"></i> {{ number_format($post->views ?? 0) }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    @else
        <div style="text-align: center; padding: 80px 20px; background: {{ $blogSettings['cards']['bg_color'] }}; border-radius: {{ $blogSettings['cards']['border_radius'] }}px; box-shadow: {{ $blogSettings['cards']['shadow'] }};">
            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 25px;">
                <i class="fas fa-newspaper" style="font-size: 48px; color: {{ $blogSettings['cards']['primary_color'] }};"></i>
            </div>
            <h3 style="font-size: 24px; font-weight: 800; color: {{ $blogSettings['typography']['card_title_color'] }}; margin: 0 0 12px 0;">Belum Ada Berita</h3>
            <p style="color: {{ $blogSettings['typography']['card_excerpt_color'] }}; font-size: 16px; margin: 0;">Belum ada berita yang dipublikasikan saat ini</p>
        </div>
    @endif
</div>

<style>
    @media (max-width: 1024px) {
        article[style*="grid-template-columns: 1.2fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
