<!-- Cards Layout: Features displayed as 3 distinct cards with shadows -->
@php
    $bgColor = $page->bg_color ?? '#f8fafc';
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

<div class="cards-layout" style="background: {{ $bgColor }}; min-height: 100vh;">
    <!-- Header -->
    <div style="background: {{ $accentColor }}; padding: 60px 0; text-align: center;">
        <div class="container">
            <h1 style="color: #fff; font-size: 42px; font-weight: 800; margin: 0;">{{ $page->title }}</h1>
            @if($page->subtitle)
                <p style="color: rgba(255,255,255,0.9); font-size: 18px; margin: 15px auto 0; max-width: 600px;">{{ $page->subtitle }}</p>
            @endif
        </div>
    </div>

    <div class="container" style="padding: 60px 15px 80px;">
        <!-- Content -->
        @if($page->content)
            <div style="max-width: 800px; margin: 0 auto 50px; font-size: 17px; line-height: 1.8; color: {{ $textColor }}; text-align: center;">
                {!! $page->content !!}
            </div>
        @endif

        <!-- Featured Image -->
        @if($page->featured_image)
            <div style="max-width: 900px; margin: 0 auto 50px;">
                <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" style="width: 100%; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            </div>
        @endif

        <!-- Features as Cards -->
        @if(count($features) > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; max-width: 1000px; margin: 0 auto 50px;">
                @foreach($features as $index => $feature)
                    <div style="background: #fff; padding: 35px 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border-top: 4px solid {{ $accentColor }};">
                        <div style="width: 60px; height: 60px; background: {{ $accentColor }}15; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 20px;">
                            {{ $icons[$feature['icon']] ?? '📌' }}
                        </div>
                        <h3 style="color: {{ $accentColor }}; font-size: 20px; font-weight: 700; margin: 0 0 12px;">{{ $feature['title'] }}</h3>
                        <p style="color: {{ $textColor }}; margin: 0; font-size: 15px; line-height: 1.7;">{{ $feature['text'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- CTA -->
        @if($page->cta_text && $page->cta_link)
            <div style="text-align: center;">
                <a href="{{ $page->cta_link }}" style="display: inline-block; padding: 15px 40px; background: {{ $accentColor }}; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; box-shadow: 0 4px 15px {{ $accentColor }}40;">
                    {{ $page->cta_text }}
                </a>
            </div>
        @endif
    </div>
</div>
