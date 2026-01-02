@php
    $settings = $block['settings'] ?? [];
    $sectionTitle = $settings['sectionTitle'] ?? '';
    $sectionSubtitle = $settings['sectionSubtitle'] ?? '';
    $sectionIcon = $settings['sectionIcon'] ?? 'fas fa-star';
    $accentColor = $page->accent_color ?? '#1e3a8a';
@endphp

@if($sectionTitle || $sectionSubtitle)
<div class="section-header" style="
    text-align: center;
    margin-bottom: 2.5rem;
    padding-bottom: 2rem;
">
    @if($sectionIcon)
        <div style="
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, {{ $accentColor }}22, {{ $accentColor }}11);
            border-radius: 16px;
            margin-bottom: 1.25rem;
        ">
            <i class="{{ $sectionIcon }}" style="font-size: 1.75rem; color: {{ $accentColor }};"></i>
        </div>
    @endif
    
    @if($sectionTitle)
        <h2 style="
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: {{ $accentColor }};
            margin: 0 0 0.75rem 0;
            line-height: 1.2;
        ">{{ $sectionTitle }}</h2>
    @endif
    
    @if($sectionSubtitle)
        <p style="
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        ">{{ $sectionSubtitle }}</p>
    @endif
    
    {{-- Decorative underline --}}
    <div style="
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, {{ $accentColor }}, {{ $accentColor }}88);
        margin: 1.5rem auto 0;
        border-radius: 2px;
    "></div>
</div>
@endif
