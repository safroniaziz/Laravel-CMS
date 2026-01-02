@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];

    $bgColor = $page->bg_color ?? '#ffffff';
    $textColor = $page->text_color ?? '#333333';
    $accentColor = $page->accent_color ?? '#1e3a8a';
    $overlay = $data['overlay'] ?? $accentColor;

    // Hero is always full-width, but can have custom height
    $paddingY = $settings['paddingY'] ?? 'large';
    $minHeight = match($paddingY) {
        'small' => '40vh',
        'medium' => '50vh',
        'large' => '60vh',
        'xlarge' => '80vh',
        default => '50vh'
    };
@endphp

<div class="block-hero" style="min-height: {{ $minHeight }}; position: relative; display: flex; align-items: center; justify-content: center;">
    @if(!empty($data['image']))
        <div style="position: absolute; inset: 0; background-image: url('{{ $data['image'] }}'); background-size: cover; background-position: center;"></div>
        <div style="position: absolute; inset: 0; background: {{ $overlay }}; opacity: 0.7;"></div>
    @else
        <div style="position: absolute; inset: 0; background: {{ $overlay }};"></div>
    @endif

    <div class="container" style="position: relative; z-index: 10; text-align: center; padding: 60px 20px;">
        @if(!empty($data['title']))
            <h1 style="font-size: clamp(32px, 6vw, 56px); font-weight: 900; color: #fff; margin: 0; text-shadow: 0 2px 20px rgba(0,0,0,0.3); line-height: 1.2;">
                {{ $data['title'] }}
            </h1>
        @endif
        @if(!empty($data['subtitle']))
            <p style="font-size: clamp(16px, 2.5vw, 22px); color: rgba(255,255,255,0.9); margin: 25px auto 0; max-width: 700px; line-height: 1.6;">
                {{ $data['subtitle'] }}
            </p>
        @endif
    </div>
</div>
