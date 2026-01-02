{{-- 
    Home Builder Blocks Partial
    Renders custom sections from homepage builder at specified positions
    Usage: @include('frontend.partials.home.home-blocks', ['position' => 'after_hero'])
--}}

@php
    if (!isset($homeBuilderSections)) {
        $homeBuilderData = App\Models\Setting::where('key', 'home_page_builder_data')->value('value');
        $homeBuilderSections = $homeBuilderData ? json_decode($homeBuilderData, true) : [];
        if (isset($homeBuilderSections['sections'])) {
            $homeBuilderSections = $homeBuilderSections['sections'];
        }
    }
    $positionSections = collect($homeBuilderSections)->where('position', $position ?? '')->values();
    $accentColor = '#1e3a8a';
@endphp

@foreach($positionSections as $section)
@php
    $sectionBg = $section['bg_color'] ?? '#ffffff';
    $isLightBg = in_array(strtolower($sectionBg), ['#ffffff', '#fff', '#f8fafc', '#f9fafb', '#f3f4f6', 'white']);
@endphp
<section class="custom-section" style="background-color: {{ $sectionBg }}; padding: 60px 0;" data-aos="fade-up">
    <div class="container">
        @if(!empty($section['title']))
        <div style="text-align: center; margin-bottom: 50px; position: relative;" data-aos="fade-down">
            {{-- Decorative badge --}}
            <div style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 20px; background: {{ $isLightBg ? $accentColor.'15' : 'rgba(255,255,255,0.15)' }}; border-radius: 50px; margin-bottom: 16px;">
                <div style="width: 8px; height: 8px; background: {{ $isLightBg ? $accentColor : '#fff' }}; border-radius: 50%; animation: pulse 2s infinite;"></div>
                <span style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: {{ $isLightBg ? $accentColor : '#fff' }};">Custom Section</span>
            </div>
            
            {{-- Main Title --}}
            <h2 style="
                font-size: clamp(32px, 5vw, 48px); 
                font-weight: 900; 
                color: {{ $isLightBg ? '#1f2937' : '#ffffff' }}; 
                margin: 0 0 16px; 
                line-height: 1.2;
                text-shadow: {{ $isLightBg ? 'none' : '0 2px 20px rgba(0,0,0,0.2)' }};
            ">{{ $section['title'] }}</h2>
            
            {{-- Subtitle --}}
            @if(!empty($section['subtitle']))
            <p style="
                font-size: 18px; 
                color: {{ $isLightBg ? '#64748b' : 'rgba(255,255,255,0.9)' }}; 
                max-width: 600px; 
                margin: 0 auto 20px;
                line-height: 1.6;
            ">{{ $section['subtitle'] }}</p>
            @endif
            
            {{-- Decorative line --}}
            <div style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                <div style="width: 40px; height: 2px; background: {{ $isLightBg ? $accentColor.'40' : 'rgba(255,255,255,0.3)' }}; border-radius: 2px;"></div>
                <div style="width: 12px; height: 12px; background: {{ $isLightBg ? $accentColor : '#fff' }}; border-radius: 50%; box-shadow: 0 0 20px {{ $isLightBg ? $accentColor.'50' : 'rgba(255,255,255,0.5)' }};"></div>
                <div style="width: 40px; height: 2px; background: {{ $isLightBg ? $accentColor.'40' : 'rgba(255,255,255,0.3)' }}; border-radius: 2px;"></div>
            </div>
        </div>
        @endif

        @foreach($section['blocks'] ?? [] as $blockIndex => $block)
            @php $blockId = 'hb-' . ($section['id'] ?? uniqid()) . '-' . $blockIndex; @endphp
            
            {{-- TEXT BLOCK --}}
            @if($block['type'] === 'text')
                @php
                    $textTitle = $block['title'] ?? '';
                    $textSubtitle = $block['subtitle'] ?? '';
                    $textContent = $block['content'] ?? '';
                    $textImage = $block['image'] ?? '';
                    $imagePosition = $block['image_position'] ?? 'none';
                    $imageSize = $block['image_size'] ?? 'medium';
                    $hasImage = !empty($textImage) && $imagePosition !== 'none';
                    
                    $imageSizes = ['small' => '30%', 'medium' => '50%', 'large' => '70%', 'full' => '100%'];
                    $imgWidth = $imageSizes[$imageSize] ?? '50%';
                    $textColor = $isLightBg ? '#374151' : 'rgba(255,255,255,0.9)';
                    $titleColor = $isLightBg ? '#1f2937' : '#ffffff';
                @endphp
                
                <div style="margin-bottom: 30px;" data-aos="fade-up" data-aos-delay="{{ $blockIndex * 100 }}">
                    {{-- Background Image Layout --}}
                    @if($imagePosition === 'background' && $hasImage)
                    <div style="position: relative; background: url('{{ $textImage }}') center/cover no-repeat; border-radius: 20px; overflow: hidden; min-height: 350px;">
                        <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5);"></div>
                        <div style="position: relative; z-index: 1; padding: 50px 40px; display: flex; flex-direction: column; justify-content: center; min-height: 350px; color: #fff;">
                            @if($textTitle)<h3 style="font-size: 28px; font-weight: 800; margin: 0 0 12px; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">{{ $textTitle }}</h3>@endif
                            @if($textSubtitle)<p style="font-size: 16px; margin: 0 0 20px; opacity: 0.9;">{{ $textSubtitle }}</p>@endif
                            <div style="font-size: 17px; line-height: 1.8;">{!! nl2br(e($textContent)) !!}</div>
                        </div>
                    </div>
                    
                    {{-- Side by Side Layout (Left/Right) --}}
                    @elseif(in_array($imagePosition, ['left', 'right']) && $hasImage)
                    <div style="background: {{ $isLightBg ? '#fff' : 'rgba(255,255,255,0.1)' }}; border-radius: 20px; box-shadow: 0 8px 40px rgba(0,0,0,0.08); overflow: hidden; display: flex; flex-wrap: wrap; {{ $imagePosition === 'left' ? 'flex-direction: row-reverse;' : 'flex-direction: row;' }}">
                        <div style="flex: 1; min-width: 280px; padding: 40px;">
                            @if($textTitle)<h3 style="font-size: 24px; font-weight: 700; color: {{ $accentColor }}; margin: 0 0 10px;">{{ $textTitle }}</h3>@endif
                            @if($textSubtitle)<p style="font-size: 15px; color: #64748b; margin: 0 0 20px;">{{ $textSubtitle }}</p>@endif
                            <div style="font-size: 16px; line-height: 1.8; color: {{ $textColor }};">{!! nl2br(e($textContent)) !!}</div>
                        </div>
                        <div style="width: {{ $imgWidth }}; min-width: 250px; flex-shrink: 0;">
                            <img src="{{ $textImage }}" alt="{{ $textTitle }}" style="width: 100%; height: 100%; min-height: 280px; object-fit: cover;">
                        </div>
                    </div>
                    
                    {{-- Stacked Layout (Top/Bottom) --}}
                    @elseif(in_array($imagePosition, ['top', 'bottom']) && $hasImage)
                    <div style="background: {{ $isLightBg ? '#fff' : 'rgba(255,255,255,0.1)' }}; border-radius: 20px; box-shadow: 0 8px 40px rgba(0,0,0,0.08); overflow: hidden;">
                        @if($imagePosition === 'top')
                        <div style="overflow: hidden; {{ $imageSize === 'full' ? '' : 'padding: 24px 24px 0; max-width: '.$imgWidth.'; margin: 0 auto;' }}">
                            <img src="{{ $textImage }}" alt="{{ $textTitle }}" style="width: 100%; display: block; {{ $imageSize === 'full' ? '' : 'border-radius: 16px;' }} max-height: 400px; object-fit: cover;">
                        </div>
                        @endif
                        <div style="padding: 32px 40px;">
                            @if($textTitle || $textSubtitle)
                            <div style="text-align: center; margin-bottom: 24px;">
                                @if($textTitle)<h3 style="font-size: 26px; font-weight: 700; color: {{ $titleColor }}; margin: 0 0 10px;">{{ $textTitle }}</h3>@endif
                                @if($textSubtitle)<p style="font-size: 16px; color: {{ $isLightBg ? '#64748b' : 'rgba(255,255,255,0.8)' }}; margin: 0; line-height: 1.6;">{{ $textSubtitle }}</p>@endif
                            </div>
                            @endif
                            <div style="font-size: 16px; line-height: 1.9; color: {{ $textColor }}; max-width: 800px; margin: 0 auto; text-align: center;">{!! nl2br(e($textContent)) !!}</div>
                        </div>
                        @if($imagePosition === 'bottom')
                        <div style="overflow: hidden; {{ $imageSize === 'full' ? '' : 'padding: 0 24px 24px; max-width: '.$imgWidth.'; margin: 0 auto;' }}">
                            <img src="{{ $textImage }}" alt="{{ $textTitle }}" style="width: 100%; display: block; {{ $imageSize === 'full' ? '' : 'border-radius: 16px;' }} max-height: 400px; object-fit: cover;">
                        </div>
                        @endif
                    </div>
                    
                    {{-- No Image / Default Layout --}}
                    @else
                    <div style="line-height: 1.8; font-size: 17px; color: {{ $textColor }}; max-width: 800px; margin: 0 auto; text-align: center;">
                        @if($textTitle)<h3 style="font-size: 24px; font-weight: 700; color: {{ $titleColor }}; margin: 0 0 8px;">{{ $textTitle }}</h3>@endif
                        @if($textSubtitle)<p style="font-size: 15px; color: #64748b; margin: 0 0 16px;">{{ $textSubtitle }}</p>@endif
                        {!! nl2br(e($textContent)) !!}
                    </div>
                    @endif
                </div>

            {{-- GALLERY BLOCK --}}
            @elseif($block['type'] === 'gallery')
                @php
                    $galleryTitle = $block['title'] ?? '';
                    $gallerySubtitle = $block['subtitle'] ?? '';
                    $columns = intval($block['columns'] ?? 3);
                    $images = $block['images'] ?? [];
                @endphp
                
                @if($galleryTitle)
                <div class="text-center" style="margin-bottom: 24px;">
                    <h3 style="font-size: 24px; font-weight: 700; color: {{ $isLightBg ? '#1f2937' : '#ffffff' }}; margin: 0 0 8px;">{{ $galleryTitle }}</h3>
                    @if($gallerySubtitle)
                    <p style="font-size: 15px; color: {{ $isLightBg ? '#64748b' : 'rgba(255,255,255,0.8)' }}; margin: 0;">{{ $gallerySubtitle }}</p>
                    @endif
                </div>
                @endif
                
                @if(count($images) > 0)
                @php
                    // Calculate item width based on columns
                    $itemWidth = match($columns) {
                        2 => '48%',
                        3 => '31%',
                        4 => '23%',
                        default => '31%'
                    };
                @endphp
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-bottom: 30px;" class="gallery-grid">
                    @foreach(array_slice($images, 0, 12) as $imgIndex => $image)
                        @php
                            $imageUrl = is_array($image) ? ($image['url'] ?? '') : $image;
                            $imageTitle = is_array($image) ? ($image['title'] ?? '') : '';
                            $imageSubtitle = is_array($image) ? ($image['subtitle'] ?? '') : '';
                        @endphp
                        @if($imageUrl)
                        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="{{ $imgIndex * 50 }}" style="
                            width: calc({{ $itemWidth }} - 15px);
                            min-width: 250px;
                            aspect-ratio: 4/3;
                            overflow: hidden;
                            border-radius: 16px;
                            cursor: pointer;
                            position: relative;
                            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
                        " onclick="openHomeLightbox('{{ $imageUrl }}', '{{ addslashes($imageTitle) }}', '{{ addslashes($imageSubtitle) }}')"
                           onmouseenter="this.querySelector('.gallery-overlay').style.opacity='1'; this.querySelector('img').style.transform='scale(1.1)';"
                           onmouseleave="this.querySelector('.gallery-overlay').style.opacity='0'; this.querySelector('img').style.transform='scale(1)';">
                            <img src="{{ $imageUrl }}" alt="{{ $imageTitle ?: 'Gallery ' . ($imgIndex + 1) }}" style="
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                                transition: transform 0.5s ease;
                            ">
                            <div class="gallery-overlay" style="
                                position: absolute;
                                inset: 0;
                                background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.8) 100%);
                                opacity: 0;
                                transition: opacity 0.3s ease;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: flex-end;
                                padding: 20px;
                                text-align: center;
                            ">
                                @if($imageTitle || $imageSubtitle)
                                    @if($imageTitle)
                                    <div style="color: #fff; font-size: 16px; font-weight: 700; margin-bottom: 4px;">{{ Str::limit($imageTitle, 40) }}</div>
                                    @endif
                                    @if($imageSubtitle)
                                    <div style="color: rgba(255,255,255,0.85); font-size: 14px;">{{ Str::limit($imageSubtitle, 50) }}</div>
                                    @endif
                                @else
                                    <i class="fas fa-search-plus" style="color: #fff; font-size: 28px;"></i>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                
                @if(count($images) > 12)
                <div style="text-align: center;">
                    <span style="display: inline-block; padding: 12px 28px; background: {{ $isLightBg ? $accentColor.'15' : 'rgba(255,255,255,0.15)' }}; color: {{ $isLightBg ? $accentColor : '#fff' }}; border-radius: 50px; font-weight: 600; font-size: 14px;">
                        <i class="fas fa-images" style="margin-right: 8px;"></i>+{{ count($images) - 12 }} foto lainnya
                    </span>
                </div>
                @endif
                @endif

            {{-- CARDS BLOCK --}}
            @elseif($block['type'] === 'cards')
                @php 
                    $cardTitle = $block['title'] ?? '';
                    $columns = intval($block['columns'] ?? 3);
                    $cardStyle = $block['style'] ?? 'icon-top';
                    $cards = $block['cards'] ?? [];
                    $cardColors = [
                        ['bg' => '#6366f1', 'light' => '#eef2ff'],
                        ['bg' => '#ec4899', 'light' => '#fdf2f8'],
                        ['bg' => '#14b8a6', 'light' => '#f0fdfa'],
                        ['bg' => '#f59e0b', 'light' => '#fffbeb'],
                        ['bg' => '#8b5cf6', 'light' => '#f5f3ff'],
                        ['bg' => '#06b6d4', 'light' => '#ecfeff'],
                    ];
                @endphp
                
                @if($cardTitle)
                <div style="margin-bottom: 28px; display: flex; align-items: center; justify-content: center; gap: 12px;" data-aos="fade-down">
                    <div style="width: 8px; height: 8px; background: {{ $accentColor }}; border-radius: 50%;"></div>
                    <h3 style="font-size: clamp(20px, 2.5vw, 26px); font-weight: 700; margin: 0; color: {{ $isLightBg ? '#1f2937' : '#fff' }};">{{ $cardTitle }}</h3>
                </div>
                @endif
                
                @if(count($cards) > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    @foreach($cards as $cardIdx => $card)
                    @php 
                        $color = $cardColors[$cardIdx % 6]; 
                        $hasLink = !empty($card['link']);
                    @endphp
                    
                    @if($cardStyle === 'icon-top')
                    {{-- Icon Top Style --}}
                    <{{ $hasLink ? 'a href="'.$card['link'].'"' : 'div' }} data-aos="fade-up" data-aos-delay="{{ $cardIdx * 80 }}" style="
                        display: block;
                        background: #fff;
                        border-radius: 16px;
                        padding: 32px 28px;
                        text-align: center;
                        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
                        transition: all 0.3s ease;
                        border: 1px solid rgba(0,0,0,0.04);
                        text-decoration: none;
                    " onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 15px 40px rgba(0,0,0,0.12)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';">
                        <div style="width: 64px; height: 64px; background: {{ $color['light'] }}; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="{{ $card['icon'] ?? 'fas fa-star' }}" style="font-size: 28px; color: {{ $color['bg'] }};"></i>
                        </div>
                        <h4 style="font-size: 18px; font-weight: 700; color: #1f2937; margin: 0 0 10px;">{{ $card['title'] ?? '' }}</h4>
                        @if(!empty($card['description']))
                        <p style="font-size: 14px; color: #64748b; margin: 0; line-height: 1.6;">{{ $card['description'] }}</p>
                        @endif
                        @if($hasLink)
                        <div style="margin-top: 16px; color: {{ $color['bg'] }}; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 6px;">
                            Selengkapnya <i class="fas fa-arrow-right" style="font-size: 11px;"></i>
                        </div>
                        @endif
                    </{{ $hasLink ? 'a' : 'div' }}>
                    
                    @elseif($cardStyle === 'icon-left')
                    {{-- Icon Left Style --}}
                    <{{ $hasLink ? 'a href="'.$card['link'].'"' : 'div' }} data-aos="fade-up" data-aos-delay="{{ $cardIdx * 80 }}" style="
                        display: flex;
                        gap: 20px;
                        background: #fff;
                        border-radius: 16px;
                        padding: 24px;
                        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
                        transition: all 0.3s ease;
                        text-decoration: none;
                    " onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 40px rgba(0,0,0,0.12)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';">
                        <div style="width: 56px; height: 56px; background: {{ $color['light'] }}; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="{{ $card['icon'] ?? 'fas fa-star' }}" style="font-size: 24px; color: {{ $color['bg'] }};"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 17px; font-weight: 700; color: #1f2937; margin: 0 0 8px;">{{ $card['title'] ?? '' }}</h4>
                            @if(!empty($card['description']))
                            <p style="font-size: 14px; color: #6b7280; margin: 0; line-height: 1.6;">{{ $card['description'] }}</p>
                            @endif
                            @if($hasLink)
                            <div style="margin-top: 12px; color: {{ $color['bg'] }}; font-weight: 600; font-size: 14px;">
                                Selengkapnya <i class="fas fa-arrow-right" style="margin-left: 4px; font-size: 11px;"></i>
                            </div>
                            @endif
                        </div>
                    </{{ $hasLink ? 'a' : 'div' }}>
                    
                    @else
                    {{-- Bordered Style (default) --}}
                    <{{ $hasLink ? 'a href="'.$card['link'].'"' : 'div' }} data-aos="fade-up" data-aos-delay="{{ $cardIdx * 80 }}" style="
                        display: block;
                        background: #fff;
                        border-radius: 16px;
                        padding: 28px;
                        border: 2px solid #e5e7eb;
                        transition: all 0.3s ease;
                        text-decoration: none;
                    " onmouseover="this.style.borderColor='{{ $color['bg'] }}';this.style.transform='translateY(-4px)';" onmouseout="this.style.borderColor='#e5e7eb';this.style.transform='translateY(0)';">
                        <div style="width: 48px; height: 48px; background: {{ $color['bg'] }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                            <i class="{{ $card['icon'] ?? 'fas fa-star' }}" style="font-size: 22px; color: #fff;"></i>
                        </div>
                        <h4 style="font-size: 17px; font-weight: 700; color: #1f2937; margin: 0 0 10px;">{{ $card['title'] ?? '' }}</h4>
                        @if(!empty($card['description']))
                        <p style="font-size: 14px; color: #6b7280; margin: 0; line-height: 1.6;">{{ $card['description'] }}</p>
                        @endif
                        @if($hasLink)
                        <div style="margin-top: 14px; color: {{ $color['bg'] }}; font-weight: 600; font-size: 14px;">
                            Selengkapnya <i class="fas fa-arrow-right" style="margin-left: 4px; font-size: 11px;"></i>
                        </div>
                        @endif
                    </{{ $hasLink ? 'a' : 'div' }}>
                    @endif
                    
                    @endforeach
                </div>
                @endif

            {{-- STATS BLOCK --}}
            @elseif($block['type'] === 'stats')
                @php 
                    $sectionTitle = $block['section_title'] ?? '';
                    $sectionSubtitle = $block['section_subtitle'] ?? '';
                    $displayType = $block['display_type'] ?? 'numbers';
                    $stats = $block['stats'] ?? [];
                    $colors = ['#6366f1', '#ec4899', '#14b8a6', '#f59e0b', '#8b5cf6', '#06b6d4'];
                    $colorsLight = ['#eef2ff', '#fce7f3', '#f0fdfa', '#fef3c7', '#f5f3ff', '#ecfeff'];
                    $totalValue = 0;
                    foreach($stats as $s) { $totalValue += floatval(preg_replace('/[^0-9.]/', '', $s['value'] ?? '0')); }
                    $totalValue = $totalValue ?: 1;
                    $chartLabels = json_encode(array_column($stats, 'label'));
                    $chartValues = json_encode(array_map(function($s) { return floatval(preg_replace('/[^0-9.]/', '', $s['value'] ?? '0')); }, $stats));
                    $chartColors = json_encode(array_slice($colors, 0, count($stats)));
                @endphp
                
                @if($sectionTitle)
                <div style="margin-bottom: 28px; display: flex; align-items: center; justify-content: center; gap: 12px;" data-aos="fade-down">
                    <div style="width: 8px; height: 8px; background: {{ $accentColor }}; border-radius: 50%;"></div>
                    <h3 style="font-size: clamp(20px, 2.5vw, 26px); font-weight: 700; margin: 0; color: {{ $isLightBg ? '#1f2937' : '#fff' }};">{{ $sectionTitle }}</h3>
                </div>
                @if($sectionSubtitle)
                <p style="text-align: center; font-size: 15px; color: {{ $isLightBg ? '#64748b' : 'rgba(255,255,255,0.8)' }}; margin: -20px 0 28px;">{{ $sectionSubtitle }}</p>
                @endif
                @endif
                
                @if($displayType === 'numbers')
                {{-- NUMBERS - Colorful Cards --}}
                <div id="{{ $blockId }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    @foreach($stats as $statIdx => $stat)
                    @php
                        $value = $stat['value'] ?? '0';
                        $numericValue = floatval(preg_replace('/[^0-9.]/', '', $value)) ?: 10;
                        $suffix = preg_replace('/[0-9.,]+/', '', $value);
                    @endphp
                    <div class="stat-card" data-aos="zoom-in" data-aos-delay="{{ $statIdx * 80 }}" style="background: {{ $colors[$statIdx % 6] }}; border-radius: 16px; padding: 28px 20px; text-align: center; position: relative; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 8px 30px {{ $colors[$statIdx % 6] }}40;" onmouseover="this.style.transform='translateY(-4px) scale(1.02)'" onmouseout="this.style.transform='translateY(0) scale(1)'">
                        <div style="position: absolute; top: -15px; right: -15px; width: 60px; height: 60px; background: rgba(255,255,255,0.15); border-radius: 50%;"></div>
                        <div style="position: relative;">
                            <div class="stat-number" data-target="{{ $numericValue }}" data-suffix="{{ $suffix }}" style="font-size: 40px; font-weight: 900; color: #fff; margin-bottom: 6px;">0</div>
                            <div style="font-size: 14px; font-weight: 500; color: rgba(255,255,255,0.9);">{{ $stat['label'] ?? '' }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @elseif($displayType === 'cards')
                {{-- CARDS - Icon boxes --}}
                <div id="{{ $blockId }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    @foreach($stats as $statIdx => $stat)
                    @php
                        $value = $stat['value'] ?? '0';
                        $numericValue = floatval(preg_replace('/[^0-9.]/', '', $value)) ?: 10;
                        $suffix = preg_replace('/[0-9.,]+/', '', $value);
                        $icons = ['fas fa-chart-line', 'fas fa-users', 'fas fa-trophy', 'fas fa-star', 'fas fa-rocket', 'fas fa-gem'];
                    @endphp
                    <div class="stat-card-item" data-aos="fade-up" data-aos-delay="{{ $statIdx * 80 }}" style="background: #fff; border-radius: 14px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.05); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(0,0,0,0.06)'">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <div style="width: 52px; height: 52px; background: {{ $colorsLight[$statIdx % 6] }}; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                                <i class="{{ $icons[$statIdx % 6] }}" style="font-size: 22px; color: {{ $colors[$statIdx % 6] }};"></i>
                            </div>
                            <div>
                                <div class="stat-number" data-target="{{ $numericValue }}" data-suffix="{{ $suffix }}" style="font-size: 28px; font-weight: 800; color: {{ $colors[$statIdx % 6] }};">0</div>
                                <div style="font-size: 14px; font-weight: 500; color: #64748b;">{{ $stat['label'] ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @elseif($displayType === 'progress')
                {{-- PROGRESS BARS --}}
                <div id="{{ $blockId }}" style="background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.05); margin-bottom: 30px;">
                    @foreach($stats as $statIdx => $stat)
                    @php
                        $value = $stat['value'] ?? '0';
                        $numericValue = floatval(preg_replace('/[^0-9.]/', '', $value)) ?: 0;
                        $percent = min(100, $numericValue);
                    @endphp
                    <div data-aos="fade-right" data-aos-delay="{{ $statIdx * 100 }}" style="margin-bottom: {{ $loop->last ? '0' : '18px' }};">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-size: 15px; font-weight: 600; color: #374151;">{{ $stat['label'] ?? '' }}</span>
                            <span style="font-size: 18px; font-weight: 700; color: {{ $colors[$statIdx % 6] }};">{{ $value }}</span>
                        </div>
                        <div style="height: 12px; background: #f1f5f9; border-radius: 6px; overflow: hidden;">
                            <div class="progress-bar-animate" style="height: 100%; width: 0%; background: linear-gradient(90deg, {{ $colors[$statIdx % 6] }}, {{ $colors[$statIdx % 6] }}cc); border-radius: 6px; transition: width 1.2s ease-out;" data-width="{{ $percent }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @elseif(in_array($displayType, ['pie', 'donut', 'bar']))
                {{-- CHART.JS CHARTS --}}
                <div id="{{ $blockId }}" style="background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.05); margin-bottom: 30px;">
                    <div style="position: relative; width: 100%; {{ $displayType === 'bar' ? 'height: 300px;' : 'max-width: 350px; margin: 0 auto;' }}">
                        <canvas id="chart-{{ $blockId }}"></canvas>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 16px; margin-top: 20px;">
                        @foreach($stats as $statIdx => $stat)
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 12px; height: 12px; background: {{ $colors[$statIdx % 6] }}; border-radius: 50%;"></div>
                            <span style="font-size: 13px; color: #64748b;">{{ $stat['label'] ?? '' }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
                <script>
                (function() {
                    const ctx = document.getElementById('chart-{{ $blockId }}');
                    if (!ctx) return;
                    const labels = {!! $chartLabels !!};
                    const values = {!! $chartValues !!};
                    const colors = {!! $chartColors !!};
                    const displayType = '{{ $displayType }}';
                    
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                createChart();
                                observer.disconnect();
                            }
                        });
                    }, { threshold: 0.2 });
                    observer.observe(ctx);
                    
                    function createChart() {
                        if (displayType === 'bar') {
                            new Chart(ctx, {
                                type: 'bar',
                                data: { labels: labels, datasets: [{ data: values, backgroundColor: colors.map(c => c + 'cc'), borderColor: colors, borderWidth: 2, borderRadius: 8 }] },
                                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: '#f1f5f9' } }, x: { grid: { display: false } } } }
                            });
                        } else {
                            new Chart(ctx, {
                                type: displayType === 'donut' ? 'doughnut' : 'pie',
                                data: { labels: labels, datasets: [{ data: values, backgroundColor: colors, borderWidth: 3, borderColor: '#fff' }] },
                                options: { responsive: true, maintainAspectRatio: true, plugins: { legend: { display: false } }, cutout: displayType === 'donut' ? '60%' : 0 }
                            });
                        }
                    }
                })();
                </script>
                @endif
                
                @if(in_array($displayType, ['numbers', 'cards']))
                <script>
                (function() {
                    const container = document.querySelector('#{{ $blockId }}');
                    if (!container) return;
                    const numbers = container.querySelectorAll('.stat-number');
                    let animated = false;
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting && !animated) {
                                animated = true;
                                numbers.forEach((num, i) => {
                                    setTimeout(() => {
                                        const target = parseFloat(num.dataset.target) || 0;
                                        const suffix = num.dataset.suffix || '';
                                        const duration = 1500;
                                        const start = performance.now();
                                        function update(currentTime) {
                                            const elapsed = currentTime - start;
                                            const progress = Math.min(elapsed / duration, 1);
                                            const eased = 1 - Math.pow(1 - progress, 4);
                                            const current = Math.floor(eased * target);
                                            num.textContent = current.toLocaleString() + suffix;
                                            if (progress < 1) { requestAnimationFrame(update); }
                                            else { num.textContent = target.toLocaleString() + suffix; }
                                        }
                                        requestAnimationFrame(update);
                                    }, i * 100);
                                });
                                observer.disconnect();
                            }
                        });
                    }, { threshold: 0.2 });
                    observer.observe(container);
                })();
                </script>
                @endif
                
                @if($displayType === 'progress')
                <script>
                (function() {
                    const container = document.querySelector('#{{ $blockId }}');
                    if (!container) return;
                    const bars = container.querySelectorAll('.progress-bar-animate');
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                bars.forEach((bar, i) => {
                                    setTimeout(() => { bar.style.width = bar.dataset.width; }, i * 150);
                                });
                                observer.disconnect();
                            }
                        });
                    }, { threshold: 0.2 });
                    observer.observe(container);
                })();
                </script>
                @endif
            @endif
        @endforeach
    </div>
</section>
@endforeach

{{-- Gallery Lightbox Modal --}}
<div id="homeGalleryModal" class="home-gallery-modal" onclick="if(event.target === this) closeHomeLightbox()">
    <div class="home-gallery-modal-content">
        <button class="home-gallery-modal-close" onclick="closeHomeLightbox()">
            <i class="fas fa-times"></i>
        </button>
        <div class="home-gallery-modal-img-wrapper">
            <img id="homeGalleryModalImg" src="" alt="">
        </div>
        <div id="homeGalleryModalCaption" class="home-gallery-modal-caption">
            <div id="homeGalleryModalTitle" class="home-gallery-modal-title"></div>
            <div id="homeGalleryModalSubtitle" class="home-gallery-modal-subtitle"></div>
        </div>
    </div>
</div>

<style>
/* Gallery Grid Responsive */
@media (max-width: 992px) {
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
@media (max-width: 576px) {
    .gallery-grid {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
    }
}

/* Gallery Hover */
.gallery-item:hover img { transform: scale(1.1); }
.gallery-item:hover .gallery-overlay { opacity: 1; }

/* Home Gallery Modal */
.home-gallery-modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.home-gallery-modal::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(10px);
}
.home-gallery-modal.active { opacity: 1; }
.home-gallery-modal-content {
    position: relative;
    max-width: 900px;
    width: 100%;
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 30px 100px rgba(0, 0, 0, 0.5);
    transform: scale(0.85) translateY(40px);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.home-gallery-modal.active .home-gallery-modal-content {
    transform: scale(1) translateY(0);
}
.home-gallery-modal-close {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 48px;
    height: 48px;
    background: rgba(0, 0, 0, 0.7);
    border: none;
    border-radius: 50%;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}
.home-gallery-modal-close:hover {
    background: #ef4444;
    transform: rotate(90deg) scale(1.1);
}
.home-gallery-modal-img-wrapper {
    background: #f1f5f9;
}
.home-gallery-modal-img-wrapper img {
    display: block;
    width: 100%;
    max-height: 70vh;
    object-fit: contain;
    opacity: 0;
    transform: scale(0.95);
    transition: opacity 0.4s ease 0.1s, transform 0.4s ease 0.1s;
}
.home-gallery-modal.active .home-gallery-modal-img-wrapper img {
    opacity: 1;
    transform: scale(1);
}
.home-gallery-modal-caption {
    padding: 24px 30px;
    text-align: center;
    background: #fff;
    border-top: 1px solid #f1f5f9;
    display: none;
}
.home-gallery-modal-title {
    font-size: 22px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 6px;
}
.home-gallery-modal-subtitle {
    font-size: 15px;
    color: #64748b;
}

@media (max-width: 768px) {
    .home-gallery-modal { padding: 12px; }
    .home-gallery-modal-content { border-radius: 16px; }
    .home-gallery-modal-img-wrapper img { max-height: 50vh; }
    .home-gallery-modal-caption { padding: 16px 20px; }
    .home-gallery-modal-title { font-size: 18px; }
    .home-gallery-modal-close { width: 40px; height: 40px; top: 12px; right: 12px; }
}
</style>

<script>
function openHomeLightbox(imageUrl, title, subtitle) {
    const modal = document.getElementById('homeGalleryModal');
    const img = document.getElementById('homeGalleryModalImg');
    const caption = document.getElementById('homeGalleryModalCaption');
    const titleEl = document.getElementById('homeGalleryModalTitle');
    const subtitleEl = document.getElementById('homeGalleryModalSubtitle');
    
    img.src = imageUrl;
    img.alt = title || 'Gallery';
    
    if (title || subtitle) {
        caption.style.display = 'block';
        titleEl.textContent = title || '';
        subtitleEl.textContent = subtitle || '';
        titleEl.style.display = title ? 'block' : 'none';
        subtitleEl.style.display = subtitle ? 'block' : 'none';
    } else {
        caption.style.display = 'none';
    }
    
    modal.style.display = 'flex';
    requestAnimationFrame(() => modal.classList.add('active'));
}

function closeHomeLightbox() {
    const modal = document.getElementById('homeGalleryModal');
    if (!modal) return;
    modal.classList.remove('active');
    setTimeout(() => modal.style.display = 'none', 300);
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeHomeLightbox();
});
</script>
