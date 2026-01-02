<!-- Timeline/Steps Layout: Features displayed as numbered steps/timeline -->
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

<div class="timeline-layout" style="background: {{ $bgColor }}; min-height: 100vh;">
    <!-- Header -->
    <div style="text-align: center; padding: 80px 15px 60px;">
        <div class="container">
            <div style="display: inline-block; width: 50px; height: 4px; background: {{ $accentColor }}; margin-bottom: 25px; border-radius: 2px;"></div>
            <h1 style="color: {{ $accentColor }}; font-size: 42px; font-weight: 900; margin: 0;">{{ $page->title }}</h1>
            @if($page->subtitle)
                <p style="color: {{ $textColor }}; font-size: 18px; margin: 20px auto 0; max-width: 600px; opacity: 0.8;">{{ $page->subtitle }}</p>
            @endif
        </div>
    </div>

    <div class="container" style="padding: 0 15px 80px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Content -->
            @if($page->content)
                <div style="font-size: 17px; line-height: 1.8; color: {{ $textColor }}; margin-bottom: 60px; text-align: center;">
                    {!! $page->content !!}
                </div>
            @endif

            <!-- Features as Timeline/Steps -->
            @if(count($features) > 0)
                <div style="position: relative; margin-bottom: 60px;">
                    <!-- Vertical line -->
                    <div style="position: absolute; left: 30px; top: 0; bottom: 0; width: 3px; background: {{ $accentColor }}20;"></div>
                    
                    @foreach($features as $index => $feature)
                        <div style="display: flex; gap: 30px; margin-bottom: {{ $loop->last ? '0' : '40px' }}; position: relative;">
                            <!-- Step Number -->
                            <div style="width: 60px; height: 60px; background: {{ $accentColor }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 24px; font-weight: 800; flex-shrink: 0; position: relative; z-index: 1;">
                                {{ $index + 1 }}
                            </div>
                            <!-- Content -->
                            <div style="flex: 1; background: #f8fafc; padding: 25px 30px; border-radius: 12px; border-left: 4px solid {{ $accentColor }};">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <span style="font-size: 24px;">{{ $icons[$feature['icon']] ?? '' }}</span>
                                    <h3 style="color: {{ $accentColor }}; font-size: 20px; font-weight: 700; margin: 0;">{{ $feature['title'] }}</h3>
                                </div>
                                <p style="color: {{ $textColor }}; margin: 0; font-size: 15px; line-height: 1.7;">{{ $feature['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- CTA -->
            @if($page->cta_text && $page->cta_link)
                <div style="text-align: center;">
                    <a href="{{ $page->cta_link }}" style="display: inline-block; padding: 16px 45px; background: {{ $accentColor }}; color: #fff; text-decoration: none; border-radius: 30px; font-weight: 600; font-size: 16px;">
                        {{ $page->cta_text }} →
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
