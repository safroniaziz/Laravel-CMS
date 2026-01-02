@php
    // Fetch global icon settings
    try {
        $icons = [
            'arrow_right' => App\Models\Setting::where('key', 'icon_arrow_right')->value('value') ?? 'fas fa-arrow-right',
            'calendar' => App\Models\Setting::where('key', 'icon_calendar')->value('value') ?? 'far fa-calendar',
            'image_fallback' => App\Models\Setting::where('key', 'icon_image_fallback')->value('value') ?? 'fas fa-image',
            'news_fallback' => App\Models\Setting::where('key', 'icon_news_fallback')->value('value') ?? 'fas fa-newspaper',
        ];
        $themeColors = [
            'text_primary' => App\Models\Setting::where('key', 'theme_text_primary')->value('value') ?? '#1e293b',
            'text_secondary' => App\Models\Setting::where('key', 'theme_text_secondary')->value('value') ?? '#64748b',
            'border_color' => App\Models\Setting::where('key', 'theme_border_color')->value('value') ?? '#e2e8f0',
            'primary' => App\Models\Setting::where('key', 'theme_primary_color')->value('value') ?? '#1a246a',
        ];
        $uiTexts = [
            'see_all' => App\Models\Setting::where('key', 'text_see_all')->value('value') ?? 'LIHAT SEMUA',
        ];
    } catch (\Exception $e) {
        $icons = [
            'arrow_right' => 'fas fa-arrow-right',
            'calendar' => 'far fa-calendar',
            'image_fallback' => 'fas fa-image',
            'news_fallback' => 'fas fa-newspaper',
        ];
        $themeColors = [
            'text_primary' => '#1e293b',
            'text_secondary' => '#64748b',
            'border_color' => '#e2e8f0',
            'primary' => '#1a246a',
        ];
        $uiTexts = [
            'see_all' => 'LIHAT SEMUA',
        ];
    }

    // Fetch news section header and layout from settings
    try {
        $newsLayoutStyle = App\Models\Setting::where('key', 'news_layout_style')->value('value') ?? 'current';
        $newsHeader = [
            'title' => App\Models\Setting::where('key', 'news_section_title')->value('value') ?? 'Berita Terbaru',
            'subtitle' => App\Models\Setting::where('key', 'news_section_subtitle')->value('value') ?? 'Informasi dan Berita Terbaru Program Studi Sistem Informasi',
            'show_subtitle' => App\Models\Setting::where('key', 'news_section_show_subtitle')->value('value') ?? '0',
            'accent_color' => App\Models\Setting::where('key', 'news_section_accent_color')->value('value') ?? '#f97316',
        ];
    } catch (\Exception $e) {
        $newsLayoutStyle = 'current';
        $newsHeader = [
            'title' => 'Berita Terbaru',
            'subtitle' => 'Informasi dan Berita Terbaru Program Studi Sistem Informasi',
            'show_subtitle' => '0',
            'accent_color' => '#f97316',
        ];
    }
@endphp

{{-- Berita Terbaru Section - UGM Style --}}
<section style="padding: 80px 0; background: #fff; position: relative;">
    <div class="container">
        {{-- UGM Style Header --}}
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px;" data-aos="fade-up">
            <div style="position: relative;">
                <h2 style="font-size: 36px; font-weight: 700; color: {{ $themeColors['primary'] }}; margin: 0; font-family: 'Outfit', sans-serif; letter-spacing: -0.5px;">
                    {{ $newsHeader['title'] }}
                </h2>
                @if($newsHeader['show_subtitle'] == '1' && !empty($newsHeader['subtitle']))
                    <p style="font-size: 14px; color: {{ $themeColors['text_secondary'] }}; margin: 8px 0 0 0;">
                        {{ $newsHeader['subtitle'] }}
                    </p>
                @endif
                {{-- UGM Yellow Line Accent --}}
                <div style="position: absolute; bottom: -21px; left: 0; width: 100px; height: 4px; background: {{ $newsHeader['accent_color'] }};"></div>
            </div>
            <a href="{{ route('blog.index') }}" style="font-size: 14px; font-weight: 600; color: {{ $themeColors['primary'] }}; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s ease;" onmouseover="this.style.color='#f97316'; this.querySelector('i').style.transform='translateX(4px)';" onmouseout="this.style.color='{{ $themeColors['primary'] }}'; this.querySelector('i').style.transform='translateX(0)';">
                {{ $uiTexts['see_all'] }}
                <i class="{{ $icons['arrow_right'] }}" style="font-size: 12px; transition: transform 0.3s ease;"></i>
            </a>
        </div>

        @if($latestPosts->count() > 0)
            @php
                $featuredPost = $latestPosts->first();
                $gridPosts = $latestPosts->skip(1)->take(3);
            @endphp

            @if($newsLayoutStyle === 'current')
            {{-- LAYOUT 1: Current Style (Featured + 3 Grid) --}}
            {{-- Featured Post --}}
            <div style="margin-bottom: 40px;" data-aos="fade-up" data-aos-delay="100">
                <article onclick="window.location='{{ route('blog.show', $featuredPost->slug) }}'"
                         style="display: grid; grid-template-columns: 453px 1fr; gap: 30px; cursor: pointer;">

                    {{-- Featured Image (Left) --}}
                    <div style="position: relative; height: 309px; overflow: hidden; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                        @if($featuredPost->featured_image)
                            <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;"
                                 onmouseover="this.style.transform='scale(1.05)';"
                                 onmouseout="this.style.transform='scale(1)';">
                        @else
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a246a, #2563eb); display: flex; align-items: center; justify-content: center;">
                                <i class="{{ $icons['news_fallback'] }}" style="font-size: 64px; color: rgba(255, 255, 255, 0.3);"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Content (Right) --}}
                    <div style="display: flex; flex-direction: column; justify-content: center;">
                        {{-- Category Badge --}}
                        <div style="margin-bottom: 12px;">
                            <span style="font-size: 12px; font-weight: 700; color: #1a246a; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $featuredPost->category->name ?? 'Liputan/Berita' }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h3 style="font-size: 28px; font-weight: 700; color: #1a246a; margin: 0 0 12px 0; line-height: 1.3; font-family: 'Outfit', sans-serif; transition: color 0.3s ease;"
                            onmouseover="this.style.color='#0f4c81';"
                            onmouseout="this.style.color='#1a246a';">
                            {{ $featuredPost->title }}
                        </h3>

                        {{-- Date --}}
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; color: #64748b; font-size: 14px;">
                            <span>{{ $featuredPost->published_at->format('d F Y, H.i') }}</span>
                        </div>

                        {{-- Excerpt --}}
                        @if($featuredPost->excerpt)
                            <p style="font-size: 15px; color: #475569; margin: 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $featuredPost->excerpt }}
                            </p>
                        @endif
                    </div>
                </article>
            </div>

            {{-- Grid Posts (3 columns) --}}
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;" data-aos="fade-up" data-aos-delay="200">
                @foreach($gridPosts as $post)
                    <article onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                             style="cursor: pointer; transition: transform 0.3s ease;"
                             onmouseover="this.style.transform='translateY(-4px)';"
                             onmouseout="this.style.transform='translateY(0)';">

                        {{-- Thumbnail --}}
                        <div style="position: relative; height: 180px; overflow: hidden; border-radius: 8px; margin-bottom: 16px; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;"
                                     onmouseover="this.style.transform='scale(1.1)';"
                                     onmouseout="this.style.transform='scale(1)';">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #e2e8f0, #cbd5e1); display: flex; align-items: center; justify-content: center;">
                                    <i class="{{ $icons['image_fallback'] }}" style="font-size: 32px; color: rgba(100, 116, 139, 0.4);"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Category Badge --}}
                        <div style="margin-bottom: 8px;">
                            <span style="font-size: 11px; font-weight: 700; color: #1a246a; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $post->category->name ?? 'Berita' }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s ease; font-family: 'Outfit', sans-serif;"
                            onmouseover="this.style.color='#1a246a';"
                            onmouseout="this.style.color='#1e293b';">
                            {{ $post->title }}
                        </h4>

                        {{-- Date --}}
                        <span style="font-size: 12px; color: #94a3b8;">
                            {{ $post->published_at->format('d F Y, H.i') }}
                        </span>
                    </article>
                @endforeach
            </div>
            @elseif($newsLayoutStyle === 'academic_grid')
            {{-- LAYOUT 2: Academic Grid Cards --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;" data-aos="fade-up" data-aos-delay="100">
                @foreach($latestPosts->take(4) as $post)
                <article onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                         style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(0,0,0,0.06); cursor: pointer; transition: all 0.3s ease;"
                         onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 32px rgba(26, 36, 106, 0.15)'; this.style.borderColor='#1a246a';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.06)'; this.style.borderColor='#e2e8f0';">

                    {{-- Thumbnail --}}
                    <div style="position: relative; height: 200px; overflow: hidden; background: linear-gradient(135deg, #e8eaf6, #c5cae9);">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;"
                                 onmouseover="this.style.transform='scale(1.1)';"
                                 onmouseout="this.style.transform='scale(1)';">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                <i class="{{ $icons['news_fallback'] }}" style="font-size: 48px; color: rgba(26, 36, 106, 0.3);"></i>
                            </div>
                        @endif
                        {{-- Category Badge --}}
                        <div style="position: absolute; top: 12px; left: 12px; padding: 6px 12px; background: rgba(26, 36, 106, 0.9); backdrop-filter: blur(10px); border-radius: 8px;">
                            <span style="font-size: 10px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $post->category->name ?? 'Berita' }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div style="padding: 20px;">
                        {{-- Date --}}
                        <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 12px; color: #64748b; font-size: 12px;">
                            <i class="{{ $icons['calendar'] }}" style="color: {{ $themeColors['primary'] }};"></i>
                            <span>{{ $post->published_at->format('d M Y, H.i') }}</span>
                        </div>

                        {{-- Title --}}
                        <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 12px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s ease;"
                            onmouseover="this.style.color='#1a246a';"
                            onmouseout="this.style.color='#1e293b';">
                            {{ $post->title }}
                        </h3>

                        {{-- Excerpt --}}
                        @if($post->excerpt)
                        <p style="font-size: 14px; color: #64748b; margin: 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $post->excerpt }}
                        </p>
                        @endif
                    </div>
                </article>
                @endforeach
            </div>
            @elseif($newsLayoutStyle === 'featured_list')
            {{-- LAYOUT 3: Featured List View --}}
            <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px;" data-aos="fade-up" data-aos-delay="100">
                {{-- LEFT: Featured Post --}}
                <article onclick="window.location='{{ route('blog.show', $featuredPost->slug) }}'"
                         style="background: #fff; border-radius: 20px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 8px 24px rgba(0,0,0,0.08); cursor: pointer; transition: all 0.3s ease;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 40px rgba(26, 36, 106, 0.15)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)';">

                    {{-- Featured Image --}}
                    <div style="position: relative; height: 320px; overflow: hidden; background: linear-gradient(135deg, #1a246a, #2563eb);">
                        @if($featuredPost->featured_image)
                            <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;"
                                 onmouseover="this.style.transform='scale(1.05)';"
                                 onmouseout="this.style.transform='scale(1)';">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                <i class="{{ $icons['news_fallback'] }}" style="font-size: 64px; color: rgba(255, 255, 255, 0.3);"></i>
                            </div>
                        @endif
                        {{-- Category Badge --}}
                        <div style="position: absolute; top: 20px; left: 20px; padding: 8px 16px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 12px;">
                            <span style="font-size: 11px; font-weight: 700; color: #1a246a; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $featuredPost->category->name ?? 'Liputan/Berita' }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div style="padding: 28px;">
                        {{-- Date --}}
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; color: #64748b; font-size: 13px;">
                            <i class="{{ $icons['calendar'] }}" style="color: {{ $themeColors['primary'] }};"></i>
                            <span>{{ $featuredPost->published_at->format('d F Y, H.i') }}</span>
                        </div>

                        {{-- Title --}}
                        <h3 style="font-size: 24px; font-weight: 700; color: #1a246a; margin: 0 0 16px 0; line-height: 1.3; transition: color 0.3s ease;"
                            onmouseover="this.style.color='#0f4c81';"
                            onmouseout="this.style.color='#1a246a';">
                            {{ $featuredPost->title }}
                        </h3>

                        {{-- Excerpt --}}
                        @if($featuredPost->excerpt)
                        <p style="font-size: 15px; color: #475569; margin: 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $featuredPost->excerpt }}
                        </p>
                        @endif
                    </div>
                </article>

                {{-- RIGHT: List of Posts --}}
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    @foreach($gridPosts as $post)
                    <article onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                             style="background: #fff; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0; cursor: pointer; transition: all 0.3s ease; display: flex; gap: 16px;"
                             onmouseover="this.style.borderColor='#1a246a'; this.style.boxShadow='0 4px 12px rgba(26, 36, 106, 0.1)';"
                             onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">

                        {{-- Thumbnail --}}
                        <div style="width: 100px; min-width: 100px; height: 100px; border-radius: 8px; overflow: hidden; background: linear-gradient(135deg, #e8eaf6, #c5cae9);">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                    <i class="{{ $icons['image_fallback'] }}" style="font-size: 24px; color: rgba(26, 36, 106, 0.3);"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                {{-- Category --}}
                                <div style="margin-bottom: 6px;">
                                    <span style="font-size: 10px; font-weight: 700; color: #1a246a; text-transform: uppercase; letter-spacing: 0.5px;">
                                        {{ $post->category->name ?? 'Berita' }}
                                    </span>
                                </div>

                                {{-- Title --}}
                                <h4 style="font-size: 14px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $post->title }}
                                </h4>
                            </div>

                            {{-- Date --}}
                            <span style="font-size: 11px; color: #94a3b8;">
                                {{ $post->published_at->format('d M Y') }}
                            </span>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @elseif($newsLayoutStyle === 'magazine')
            {{-- LAYOUT 4: Magazine Style --}}
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;" data-aos="fade-up" data-aos-delay="100">
                {{-- LEFT: Main Featured --}}
                <article onclick="window.location='{{ route('blog.show', $featuredPost->slug) }}'"
                         style="background: #fff; border-radius: 20px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 8px 32px rgba(0,0,0,0.1); cursor: pointer; transition: all 0.3s ease;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 48px rgba(26, 36, 106, 0.18)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(0,0,0,0.1)';">

                    {{-- Image --}}
                    <div style="position: relative; height: 350px; overflow: hidden; background: linear-gradient(135deg, #1a246a, #2563eb);">
                        @if($featuredPost->featured_image)
                            <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"
                                 onmouseover="this.style.transform='scale(1.08)';"
                                 onmouseout="this.style.transform='scale(1)';">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                <i class="{{ $icons['news_fallback'] }}" style="font-size: 80px; color: rgba(255, 255, 255, 0.2);"></i>
                            </div>
                        @endif
                        {{-- Gradient Overlay --}}
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 60%; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);"></div>
                        {{-- Category Badge --}}
                        <div style="position: absolute; top: 24px; left: 24px; padding: 10px 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 12px;">
                            <span style="font-size: 12px; font-weight: 700; color: #1a246a; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $featuredPost->category->name ?? 'Liputan/Berita' }}
                            </span>
                        </div>
                    </div>

                    {{-- Content Overlay on Image --}}
                    <div style="position: relative; margin-top: -80px; padding: 25px; background: #fff; z-index: 2; border-top: 1px solid #e2e8f0;">
                        {{-- Date --}}
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; color: #64748b; font-size: 13px;">
                            <i class="{{ $icons['calendar'] }}" style="color: {{ $themeColors['primary'] }};"></i>
                            <span>{{ $featuredPost->published_at->format('d F Y, H.i') }}</span>
                        </div>

                        {{-- Title --}}
                        <h3 style="font-size: 26px; font-weight: 800; color: #1a246a; margin: 0 0 16px 0; line-height: 1.3;">
                            {{ $featuredPost->title }}
                        </h3>

                        {{-- Excerpt --}}
                        @if($featuredPost->excerpt)
                        <p style="font-size: 15px; color: #475569; margin: 0; line-height: 1.7; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $featuredPost->excerpt }}
                        </p>
                        @endif
                    </div>
                </article>

                {{-- RIGHT: Sidebar Posts --}}
                <div style="display: flex; flex-direction: column; gap: 24px;">
                    @foreach($gridPosts as $index => $post)
                    <article onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                             style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(0,0,0,0.06); cursor: pointer; transition: all 0.3s ease;"
                             onmouseover="this.style.transform='translateX(4px)'; this.style.boxShadow='0 8px 24px rgba(26, 36, 106, 0.12)'; this.style.borderColor='#1a246a';"
                             onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.06)'; this.style.borderColor='#e2e8f0';">

                        {{-- Thumbnail --}}
                        <div style="height: 140px; overflow: hidden; background: linear-gradient(135deg, #e8eaf6, #c5cae9);">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;"
                                     onmouseover="this.style.transform='scale(1.1)';"
                                     onmouseout="this.style.transform='scale(1)';">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="font-size: 32px; color: rgba(26, 36, 106, 0.3);"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div style="padding: 16px;">
                            {{-- Category --}}
                            <div style="margin-bottom: 8px;">
                                <span style="font-size: 10px; font-weight: 700; color: #1a246a; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $post->category->name ?? 'Berita' }}
                                </span>
                            </div>

                            {{-- Title --}}
                            <h4 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $post->title }}
                            </h4>

                            {{-- Date --}}
                            <span style="font-size: 11px; color: #94a3b8;">
                                {{ $post->published_at->format('d M Y') }}
                            </span>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif
        @else
            @php
                $newsEmptyText = App\Models\Setting::where('key', 'news_empty_text')->value('value') ?? 'Data kosong.';
                $newsEmptyIcon = $icons['news_fallback'];
                $themeMutedBg = App\Models\Setting::where('key', 'theme_muted_bg')->value('value') ?? '#f8fafc';
                $themeMutedText = App\Models\Setting::where('key', 'theme_muted_text_color')->value('value') ?? '#64748b';
            @endphp
            {{-- Empty State (Dynamic) --}}
            <div style="text-align: center; padding: 60px; background: {{ $themeMutedBg }}; border-radius: 12px;">
                <i class="{{ $newsEmptyIcon }}" style="font-size: 40px; color: {{ $themeMutedText }}; opacity: 0.6; margin-bottom: 12px;"></i>
                <p style="color: {{ $themeMutedText }}; margin: 0;">{{ $newsEmptyText }}</p>
            </div>
        @endif
    </div>
</section>
