<!-- Default/List Layout: Features displayed as a simple vertical list -->
@php
    $bgColor = $page->bg_color ?? '#ffffff';
    $textColor = $page->text_color ?? '#333333';
    $accentColor = $page->accent_color ?? '#1e3a8a';
    
    $icons = [
        'star' => '⭐',
        'check' => '✅',
        'heart' => '❤️',
        'rocket' => '🚀',
        'trophy' => '🏆',
        'lightbulb' => '💡',
        'users' => '👥',
        'chart' => '📈'
    ];
    
    $features = [];
    if ($page->feature_1_title) $features[] = ['icon' => $page->feature_1_icon, 'title' => $page->feature_1_title, 'text' => $page->feature_1_text];
    if ($page->feature_2_title) $features[] = ['icon' => $page->feature_2_icon, 'title' => $page->feature_2_title, 'text' => $page->feature_2_text];
    if ($page->feature_3_title) $features[] = ['icon' => $page->feature_3_icon, 'title' => $page->feature_3_title, 'text' => $page->feature_3_text];
@endphp

<div class="list-layout" style="background: {{ $bgColor }}; min-height: 100vh;">
    <!-- Header -->
    <div style="background: {{ $accentColor }}; padding: 60px 0; text-align: center;">
        <div class="container">
            <h1 style="color: #fff; font-size: 42px; font-weight: 800; margin: 0;">{{ $page->title }}</h1>
            @if($page->subtitle)
                <p style="color: rgba(255,255,255,0.9); font-size: 18px; margin: 15px 0 0; max-width: 600px; margin-left: auto; margin-right: auto;">{{ $page->subtitle }}</p>
            @endif
        </div>
    </div>

    <div class="container" style="padding: 60px 15px 80px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Content -->
            @if($page->content)
                <div style="font-size: 17px; line-height: 1.8; color: {{ $textColor }}; margin-bottom: 50px;">
                    {!! $page->content !!}
                </div>
            @endif

            <!-- Features as List -->
            @if(count($features) > 0)
                <div style="margin-bottom: 50px;">
                    @foreach($features as $index => $feature)
                        <div style="display: flex; gap: 20px; padding: 25px 0; border-bottom: 1px solid #eee;">
                            <div style="font-size: 32px; flex-shrink: 0;">
                                {{ $icons[$feature['icon']] ?? '📌' }}
                            </div>
                            <div>
                                <h3 style="color: {{ $accentColor }}; font-size: 20px; font-weight: 700; margin: 0 0 8px;">{{ $feature['title'] }}</h3>
                                <p style="color: {{ $textColor }}; margin: 0; line-height: 1.6;">{{ $feature['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- CTA -->
            @if($page->cta_text && $page->cta_link)
                <div style="text-align: center;">
                    <a href="{{ $page->cta_link }}" style="display: inline-block; padding: 15px 40px; background: {{ $accentColor }}; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px;">
                        {{ $page->cta_text }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
