@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $inSidebar = $inSidebar ?? false;

    // Get content
    $title = $data['title'] ?? '';
    $subtitle = $data['subtitle'] ?? '';
    $content = $data['content'] ?? '';
    
    // Image settings
    $image = $data['image'] ?? '';
    $imagePosition = $data['image_position'] ?? 'none';
    $imageSize = $data['image_size'] ?? 'medium';
    $textValign = $data['text_valign'] ?? 'center';
    $overlay = $data['image_overlay'] ?? 'none';

    // Colors
    $useCustomColors = $settings['customColors'] ?? false;
    $blockBg = $useCustomColors && !empty($settings['bgColor']) ? $settings['bgColor'] : '#ffffff';
    $blockText = $useCustomColors && !empty($settings['textColor']) ? $settings['textColor'] : ($page->text_color ?? '#374151');
    $blockAccent = $useCustomColors && !empty($settings['accentColor']) ? $settings['accentColor'] : ($page->accent_color ?? '#1e3a8a');

    // Image size percentages
    $imageSizes = [
        'small' => '30%',
        'medium' => '50%',
        'large' => '70%',
        'full' => '100%'
    ];
    $imgWidth = $imageSizes[$imageSize] ?? '50%';
    
    // Text alignment
    $valignMap = [
        'top' => 'flex-start',
        'center' => 'center',
        'bottom' => 'flex-end'
    ];
    $alignItems = $valignMap[$textValign] ?? 'center';
    
    // Overlay opacity - gunakan nilai langsung jika bukan preset
    $overlayOpacity = [
        'none' => '0',
        'light' => '0.3',
        'medium' => '0.5',
        'dark' => '0.7'
    ];
    $overlayAlpha = $overlayOpacity[$overlay] ?? '0.5';
    
    $hasImage = !empty($image) && $imagePosition !== 'none';
    $blockId = 'text-' . uniqid();
@endphp

@if($inSidebar)
    {{-- Sidebar: Compact card design --}}
    <div style="padding: 24px;">
        @if($title)
            <h4 style="color: {{ $blockAccent }}; font-weight: 700; margin-bottom: 8px; font-size: 1rem;">{{ $title }}</h4>
        @endif
        @if($subtitle)
            <p style="color: #6b7280; font-size: 0.85rem; margin-bottom: 12px;">{{ $subtitle }}</p>
        @endif
        @if($hasImage && in_array($imagePosition, ['top', 'bottom']))
            @if($imagePosition === 'top')
                <img src="{{ $image }}" alt="{{ $title }}" style="width: 100%; border-radius: 8px; margin-bottom: 12px;">
            @endif
        @endif
        <div class="tinymce-content" style="font-size: 14px; line-height: 1.8; color: {{ $blockText }};">
            {!! $content !!}
        </div>
        @if($hasImage && $imagePosition === 'bottom')
            <img src="{{ $image }}" alt="{{ $title }}" style="width: 100%; border-radius: 8px; margin-top: 12px;">
        @endif
    </div>
@else
    {{-- Main Content --}}
    
    @if($imagePosition === 'background' && $hasImage)
        {{-- Background Image Layout --}}

        <div id="{{ $blockId }}" style="
            position: relative;
            background: url('{{ $image }}') center/cover no-repeat;
            border-radius: 24px;
            overflow: hidden;
            min-height: 400px;
        ">
            {{-- Overlay --}}
            <div style="
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, {{ $overlayAlpha }});
            "></div>
            
            {{-- Content --}}
            <div style="
                position: relative;
                z-index: 1;
                padding: clamp(40px, 6vw, 80px);
                display: flex;
                flex-direction: column;
                justify-content: {{ $alignItems }};
                min-height: 400px;
                color: #fff;
            ">
                @if($title)
                    <h2 style="
                        font-weight: 800;
                        font-size: clamp(2rem, 5vw, 3rem);
                        margin-bottom: 1rem;
                        text-shadow: 0 2px 20px rgba(0,0,0,0.3);
                    ">{{ $title }}</h2>
                @endif
                @if($subtitle)
                    <p style="
                        font-size: clamp(1.1rem, 2vw, 1.35rem);
                        margin-bottom: 1.5rem;
                        opacity: 0.9;
                        max-width: 700px;
                    ">{{ $subtitle }}</p>
                @endif
                <div class="tinymce-content" style="
                    font-size: clamp(1rem, 1.5vw, 1.125rem);
                    line-height: 1.9;
                    max-width: 800px;
                    text-shadow: 0 1px 10px rgba(0,0,0,0.2);
                ">
                    {!! $content !!}
                </div>
            </div>
        </div>
        
    @elseif(in_array($imagePosition, ['left', 'right']) && $hasImage)
        {{-- Side by Side Layout --}}
        <div id="{{ $blockId }}" style="
            background: {{ $blockBg }};
            border-radius: 24px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            display: flex;
            flex-direction: {{ $imagePosition === 'right' ? 'row' : 'row-reverse' }};
            flex-wrap: wrap;
        ">
            {{-- Text Side --}}
            <div style="
                flex: 1;
                min-width: 300px;
                padding: clamp(32px, 5vw, 56px);
                display: flex;
                flex-direction: column;
                justify-content: {{ $alignItems }};
            ">
                @if($title)
                    <h2 style="
                        color: {{ $blockAccent }};
                        font-weight: 800;
                        font-size: clamp(1.5rem, 3vw, 2.25rem);
                        margin-bottom: 0.75rem;
                        line-height: 1.2;
                    ">{{ $title }}</h2>
                @endif
                @if($subtitle)
                    <p style="
                        color: #6b7280;
                        font-size: clamp(1rem, 1.5vw, 1.15rem);
                        margin-bottom: 1.25rem;
                        line-height: 1.6;
                    ">{{ $subtitle }}</p>
                @endif
                <div class="tinymce-content" style="
                    font-size: clamp(0.95rem, 1.2vw, 1.05rem);
                    line-height: 1.9;
                    color: {{ $blockText }};
                ">
                    {!! $content !!}
                </div>
            </div>
            
            {{-- Image Side --}}
            <div style="
                width: {{ $imgWidth }};
                min-width: 280px;
                flex-shrink: 0;
            ">
                <img src="{{ $image }}" alt="{{ $title }}" style="
                    width: 100%;
                    height: 100%;
                    min-height: 300px;
                    object-fit: cover;
                ">
            </div>
        </div>
        
    @elseif(in_array($imagePosition, ['top', 'bottom']) && $hasImage)
        {{-- Stacked Layout --}}
        <div id="{{ $blockId }}" style="
            background: {{ $blockBg }};
            border-radius: 24px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        ">
            @if($imagePosition === 'top')
                <div style="width: {{ $imageSize === 'full' ? '100%' : 'auto' }}; margin: {{ $imageSize === 'full' ? '0' : '32px auto 0' }}; max-width: {{ $imgWidth }};">
                    <img src="{{ $image }}" alt="{{ $title }}" style="
                        width: 100%;
                        {{ $imageSize === 'full' ? '' : 'border-radius: 16px;' }}
                        display: block;
                    ">
                </div>
            @endif
            
            <div style="padding: clamp(32px, 5vw, 56px);">
                @if($title || $subtitle)
                    <div style="text-align: center; margin-bottom: 2rem;">
                        @if($title)
                            <h2 style="
                                color: {{ $blockAccent }};
                                font-weight: 800;
                                font-size: clamp(1.75rem, 4vw, 2.5rem);
                                margin-bottom: 0.75rem;
                            ">{{ $title }}</h2>
                        @endif
                        @if($subtitle)
                            <p style="
                                color: #6b7280;
                                font-size: clamp(1rem, 2vw, 1.25rem);
                                max-width: 700px;
                                margin: 0 auto;
                            ">{{ $subtitle }}</p>
                        @endif
                    </div>
                @endif
                
                <div class="tinymce-content" style="
                    font-size: clamp(1rem, 1.5vw, 1.125rem);
                    line-height: 2;
                    color: {{ $blockText }};
                    max-width: 900px;
                    margin: 0 auto;
                ">
                    {!! $content !!}
                </div>
            </div>
            
            @if($imagePosition === 'bottom')
                <div style="width: {{ $imageSize === 'full' ? '100%' : 'auto' }}; margin: {{ $imageSize === 'full' ? '0' : '0 auto 32px' }}; max-width: {{ $imgWidth }};">
                    <img src="{{ $image }}" alt="{{ $title }}" style="
                        width: 100%;
                        {{ $imageSize === 'full' ? '' : 'border-radius: 16px;' }}
                        display: block;
                    ">
                </div>
            @endif
        </div>
        
    @else
        {{-- No Image / Default Layout --}}
        <div id="{{ $blockId }}" class="block-text" style="
            background: {{ $blockBg }};
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
            position: relative;
            transition: all 0.3s ease;
        "
        onmouseover="this.style.boxShadow='0 8px 40px rgba(0,0,0,0.1)'; this.style.transform='translateY(-2px)';"
        onmouseout="this.style.boxShadow='0 4px 24px rgba(0,0,0,0.06)'; this.style.transform='translateY(0)';">
            
            <div style="padding: clamp(32px, 5vw, 48px); position: relative;">
                @if($title || $subtitle)
                    <div style="margin-bottom: 24px; display: flex; align-items: flex-start; gap: 16px;">
                        {{-- Accent bar --}}
                        <div style="width: 4px; height: 100%; min-height: 40px; background: linear-gradient(180deg, {{ $blockAccent }}, {{ $blockAccent }}66); border-radius: 2px; flex-shrink: 0;"></div>
                        <div>
                            @if($title)
                                <h3 style="
                                    font-weight: 700;
                                    font-size: clamp(20px, 3vw, 26px);
                                    margin: 0 0 8px;
                                    line-height: 1.3;
                                    color: #1f2937;
                                ">{{ $title }}</h3>
                            @endif
                            @if($subtitle)
                                <p style="
                                    color: #64748b;
                                    font-size: 15px;
                                    margin: 0;
                                    line-height: 1.6;
                                ">{{ $subtitle }}</p>
                            @endif
                        </div>
                    </div>
                @endif
                
                <div class="tinymce-content" style="
                    font-size: clamp(16px, 1.5vw, 18px);
                    line-height: 2;
                    color: {{ $blockText }};
                    max-width: 900px;
                    margin: 0 auto;
                ">
                    {!! $content !!}
                </div>
            </div>
        </div>
    @endif
@endif

<style>
#{{ $blockId }} .tinymce-content h1,
#{{ $blockId }} .tinymce-content h2,
#{{ $blockId }} .tinymce-content h3,
#{{ $blockId }} .tinymce-content h4 {
    font-weight: 700;
    margin-top: 1.5em;
    margin-bottom: 0.75em;
    line-height: 1.3;
}
#{{ $blockId }} .tinymce-content p {
    margin-bottom: 1.25em;
}
#{{ $blockId }} .tinymce-content a {
    color: {{ $blockAccent }};
    text-decoration: underline;
    text-underline-offset: 3px;
}
#{{ $blockId }} .tinymce-content ul,
#{{ $blockId }} .tinymce-content ol {
    padding-left: 1.5em;
    margin-bottom: 1.5em;
}
#{{ $blockId }} .tinymce-content li {
    margin-bottom: 0.5em;
}
#{{ $blockId }} .tinymce-content blockquote {
    border-left: 4px solid {{ $blockAccent }};
    padding: 1em 1.5em;
    margin: 1.5em 0;
    font-style: italic;
    background: rgba(0,0,0,0.03);
    border-radius: 0 8px 8px 0;
}
#{{ $blockId }} .tinymce-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

@media (max-width: 768px) {
    #{{ $blockId }}[style*="flex-direction: row"],
    #{{ $blockId }}[style*="flex-direction: row-reverse"] {
        flex-direction: column !important;
    }
    #{{ $blockId }}[style*="flex-direction"] > div[style*="width:"] {
        width: 100% !important;
        min-height: 200px !important;
    }
}
</style>
