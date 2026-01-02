<!-- Hero Layout: Large image header with features below -->
@php
    $bgColor = $page->bg_color ?? '#ffffff';
    $textColor = $page->text_color ?? '#333333';
    $accentColor = $page->accent_color ?? '#1e3a8a';
    
    $icons = [
        'star' => '⭐', 'check' => '✅', 'heart' => '❤️', 'rocket' => '🚀',
        'trophy' => '🏆', 'lightbulb' => '💡', 'users' => '👥', 'chart' => '📈'
    ];
    
    $features = [];
    if ($page->feature_1_title) $features[] = ['icon' => $page->feature_1_icon, 'title' => $page->feature_1_title, 'text' => $page->feature_1_text];
    if ($page->feature_2_title) $features[] = ['icon' => $page->feature_2_icon, 'title' => $page->feature_2_title, 'text' => $page->feature_2_text];
    if ($page->feature_3_title) $features[] = ['icon' => $page->feature_3_icon, 'title' => $page->feature_3_title, 'text' => $page->feature_3_text];
@endphp

<div class="hero-layout">
    <!-- Hero Section with Image Background -->
    <div style="min-height: 50vh; position: relative; display: flex; align-items: center; justify-content: center;">
        @if($page->featured_image)
            <div style="position: absolute; inset: 0; background-image: url('{{ asset('storage/' . $page->featured_image) }}'); background-size: cover; background-position: center;"></div>
            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.6));"></div>
        @else
            <div style="position: absolute; inset: 0; background: {{ $accentColor }};"></div>
        @endif
        
        <div class="container" style="position: relative; z-index: 10; text-align: center; padding: 60px 20px;">
            <h1 style="font-size: 48px; font-weight: 900; color: #fff; margin: 0; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">{{ $page->title }}</h1>
            @if($page->subtitle)
                <p style="color: rgba(255,255,255,0.95); font-size: 20px; margin: 20px auto 0; max-width: 600px;">{{ $page->subtitle }}</p>
            @endif
        </div>
    </div>

    <!-- Content Section -->
    <div style="background: {{ $bgColor }};">
        <div class="container" style="padding: 60px 15px;">
            <div style="max-width: 900px; margin: 0 auto;">
                
                @if($page->content)
                    <div style="font-size: 17px; line-height: 1.8; color: {{ $textColor }}; margin-bottom: 50px; text-align: center;">
                        {!! $page->content !!}
                    </div>
                @endif

                <!-- Features as Horizontal Boxes -->
                @if(count($features) > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-bottom: 50px;">
                        @foreach($features as $feature)
                            <div style="text-align: center; padding: 30px 20px;">
                                <div style="font-size: 40px; margin-bottom: 15px;">{{ $icons[$feature['icon']] ?? '📌' }}</div>
                                <h3 style="color: {{ $accentColor }}; font-size: 18px; font-weight: 700; margin: 0 0 10px;">{{ $feature['title'] }}</h3>
                                <p style="color: {{ $textColor }}; margin: 0; font-size: 15px; line-height: 1.6;">{{ $feature['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- CTA -->
                @if($page->cta_text && $page->cta_link)
                    <div style="text-align: center;">
                        <a href="{{ $page->cta_link }}" style="display: inline-block; padding: 15px 40px; background: {{ $accentColor }}; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600;">
                            {{ $page->cta_text }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
