<!-- Grid/Split Layout: Features displayed in grid with large icons -->
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

<style>
@media (max-width: 768px) {
    .split-content { display: block !important; }
    .split-left { margin-bottom: 40px; }
}
</style>

<div class="grid-layout" style="background: {{ $bgColor }}; min-height: 100vh;">
    <div class="container" style="padding: 80px 15px;">
        <!-- Split: Left content, Right image -->
        <div class="split-content" style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; max-width: 1100px; margin: 0 auto 60px;">
            <div class="split-left">
                <h1 style="color: {{ $accentColor }}; font-size: 38px; font-weight: 800; margin: 0 0 20px; line-height: 1.2;">{{ $page->title }}</h1>
                @if($page->subtitle)
                    <p style="color: {{ $textColor }}; font-size: 18px; margin: 0 0 25px; opacity: 0.8;">{{ $page->subtitle }}</p>
                @endif
                @if($page->content)
                    <div style="color: {{ $textColor }}; font-size: 16px; line-height: 1.8;">
                        {!! $page->content !!}
                    </div>
                @endif
                
                @if($page->cta_text && $page->cta_link)
                    <div style="margin-top: 30px;">
                        <a href="{{ $page->cta_link }}" style="display: inline-block; padding: 14px 35px; background: {{ $accentColor }}; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600;">
                            {{ $page->cta_text }}
                        </a>
                    </div>
                @endif
            </div>
            <div class="split-right">
                @if($page->featured_image)
                    <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" style="width: 100%; border-radius: 16px; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
                @else
                    <div style="background: linear-gradient(135deg, {{ $accentColor }}, {{ $accentColor }}cc); border-radius: 16px; padding: 80px; text-align: center;">
                        <span style="font-size: 80px;">🖼️</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Features Grid with Big Icons -->
        @if(count($features) > 0)
            <div style="background: {{ $accentColor }}10; border-radius: 20px; padding: 50px; max-width: 1100px; margin: 0 auto;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px;">
                    @foreach($features as $feature)
                        <div style="display: flex; gap: 20px; align-items: flex-start;">
                            <div style="width: 70px; height: 70px; background: {{ $accentColor }}; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 32px; flex-shrink: 0;">
                                {{ $icons[$feature['icon']] ?? '📌' }}
                            </div>
                            <div>
                                <h3 style="color: {{ $accentColor }}; font-size: 18px; font-weight: 700; margin: 0 0 8px;">{{ $feature['title'] }}</h3>
                                <p style="color: {{ $textColor }}; margin: 0; font-size: 15px; line-height: 1.6;">{{ $feature['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
