@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];

    $accentColor = $page->accent_color ?? '#1e3a8a';
    $overlay = $data['overlay'] ?? $accentColor;

    // Hero height
    $paddingY = $settings['paddingY'] ?? 'large';
    $minHeight = match($paddingY) {
        'small' => '40vh',
        'medium' => '50vh',
        'large' => '60vh',
        'xlarge' => '80vh',
        default => '50vh'
    };
@endphp

<div class="block-hero" style="
    min-height: {{ $minHeight }};
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
">
    {{-- Background --}}
    @if(!empty($data['image']) && !str_contains($data['image'], 'Fungsi:'))
        <div style="
            position: absolute;
            inset: 0;
            background-image: url('{{ $data['image'] }}');
            background-size: cover;
            background-position: center;
        "></div>
        <div style="
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, {{ $overlay }}ee 0%, {{ $overlay }}cc 100%);
        "></div>
    @else
        <div style="
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, {{ $overlay }} 0%, {{ $overlay }}dd 100%);
        "></div>
    @endif
    
    {{-- Decorative elements --}}
    <div style="
        position: absolute;
        top: -30%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    "></div>
    <div style="
        position: absolute;
        bottom: -20%;
        left: -5%;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    "></div>
    <div style="
        position: absolute;
        top: 20%;
        left: 10%;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    "></div>

    {{-- Content --}}
    <div class="container" style="
        position: relative;
        z-index: 10;
        text-align: center;
        padding: 80px 20px;
        max-width: 900px;
        margin: 0 auto;
    ">
        @if(!empty($data['title']) && !str_contains($data['title'], 'Fungsi:'))
            <h1 style="
                font-size: clamp(36px, 7vw, 64px);
                font-weight: 900;
                color: #fff;
                margin: 0;
                text-shadow: 0 4px 30px rgba(0,0,0,0.2);
                line-height: 1.15;
                letter-spacing: -1px;
            ">{{ $data['title'] }}</h1>
        @else
            <h1 style="
                font-size: clamp(36px, 7vw, 64px);
                font-weight: 900;
                color: #fff;
                margin: 0;
                text-shadow: 0 4px 30px rgba(0,0,0,0.2);
                line-height: 1.15;
                letter-spacing: -1px;
            ">{{ $page->title }}</h1>
        @endif
        
        @if(!empty($data['subtitle']) && !str_contains($data['subtitle'], 'Fungsi:'))
            <p style="
                font-size: clamp(16px, 2.5vw, 22px);
                color: rgba(255,255,255,0.92);
                margin: 28px auto 0;
                max-width: 650px;
                line-height: 1.7;
                font-weight: 400;
            ">{{ $data['subtitle'] }}</p>
        @endif
        
        {{-- Decorative underline --}}
        <div style="
            width: 80px;
            height: 4px;
            background: rgba(255,255,255,0.5);
            margin: 32px auto 0;
            border-radius: 2px;
        "></div>
    </div>
</div>

<style>
.block-hero {
    animation: heroFadeIn 0.8s ease;
}

@keyframes heroFadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .block-hero {
        min-height: 50vh !important;
    }
    .block-hero .container {
        padding: 60px 20px !important;
    }
}
</style>
