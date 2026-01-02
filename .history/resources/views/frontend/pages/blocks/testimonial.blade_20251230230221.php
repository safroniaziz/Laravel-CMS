@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $inSidebar = $inSidebar ?? false;

    // Colors
    $useCustomColors = $settings['customColors'] ?? false;
    $blockBg = $useCustomColors && !empty($settings['bgColor']) ? $settings['bgColor'] : ($page->bg_color ?? '#ffffff');
    $blockText = $useCustomColors && !empty($settings['textColor']) ? $settings['textColor'] : ($page->text_color ?? '#333333');
    $blockAccent = $useCustomColors && !empty($settings['accentColor']) ? $settings['accentColor'] : ($page->accent_color ?? '#1e3a8a');

    // Spacing
    $paddingY = $settings['paddingY'] ?? 'medium';
    $width = $inSidebar ? 'full' : ($settings['width'] ?? 'contained');

    $paddingClasses = "padding-{$paddingY}";
    $widthClasses = "width-{$width}";
@endphp

<div class="block-testimonial block-container {{ $paddingClasses }}" style="background: {{ $blockBg }};">
    <div class="block-inner {{ $widthClasses }}">
        <div style="background: {{ $inSidebar ? 'rgba(0,0,0,0.02)' : '#fff' }}; padding: {{ $inSidebar ? '20px' : '40px' }}; border-radius: {{ $inSidebar ? '8px' : '16px' }}; {{ $inSidebar ? '' : 'box-shadow: 0 4px 20px rgba(0,0,0,0.06);' }} border-left: 4px solid {{ $blockAccent }};">
            @if(!empty($data['quote']))
                <div style="font-size: {{ $inSidebar ? '32px' : '48px' }}; color: {{ $blockAccent }}; opacity: 0.2; line-height: 0.5; margin-bottom: 15px;">"</div>
                <p style="font-size: {{ $inSidebar ? '13px' : '18px' }}; font-style: italic; color: {{ $blockText }}; line-height: 1.7; margin: 0 0 25px;">
                    {{ $data['quote'] }}
                </p>
            @endif

            <div style="display: flex; align-items: center; gap: 15px;">
                @if(!empty($data['photo']))
                    <img src="{{ $data['photo'] }}" alt="{{ $data['name'] ?? '' }}" style="width: {{ $inSidebar ? '40px' : '50px' }}; height: {{ $inSidebar ? '40px' : '50px' }}; border-radius: 50%; object-fit: cover; border: 2px solid {{ $blockAccent }};">
                @else
                    <div style="width: {{ $inSidebar ? '40px' : '50px' }}; height: {{ $inSidebar ? '40px' : '50px' }}; border-radius: 50%; background: {{ $blockAccent }}20; display: flex; align-items: center; justify-content: center; font-size: {{ $inSidebar ? '16px' : '20px' }};">👤</div>
                @endif
                <div>
                    <div style="font-weight: 700; color: {{ $blockText }}; font-size: {{ $inSidebar ? '13px' : '16px' }};">{{ $data['name'] ?? 'Anonymous' }}</div>
                    @if(!empty($data['role']))
                        <div style="font-size: {{ $inSidebar ? '11px' : '13px' }}; color: {{ $blockAccent }};">{{ $data['role'] }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
