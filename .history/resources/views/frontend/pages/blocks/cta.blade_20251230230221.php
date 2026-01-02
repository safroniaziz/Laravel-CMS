@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $inSidebar = $inSidebar ?? false;

    // Colors
    $useCustomColors = $settings['customColors'] ?? false;
    $blockBg = !empty($data['cta_bg']) ? $data['cta_bg'] : ($useCustomColors && !empty($settings['bgColor']) ? $settings['bgColor'] : ($page->accent_color ?? '#1e3a8a'));

    // Spacing
    $paddingY = $settings['paddingY'] ?? 'medium';
    $width = $inSidebar ? 'full' : ($settings['width'] ?? 'contained');

    $paddingClasses = "padding-{$paddingY}";
    $widthClasses = "width-{$width}";
@endphp

<div class="block-cta block-container {{ $paddingClasses }}" style="background: {{ $blockBg }};">
    <div class="block-inner {{ $widthClasses }}" style="text-align: center;">
        @if(!empty($data['title']))
            <h2 style="font-size: {{ $inSidebar ? '20px' : '36px' }}; font-weight: 800; color: #fff; margin: 0 0 {{ $inSidebar ? '10px' : '15px' }}; line-height: 1.2;">
                {{ $data['title'] }}
            </h2>
        @endif

        @if(!empty($data['subtitle']))
            <p style="font-size: {{ $inSidebar ? '13px' : '18px' }}; color: rgba(255,255,255,0.9); margin: 0 0 {{ $inSidebar ? '20px' : '30px' }}; max-width: {{ $inSidebar ? '100%' : '600px' }}; margin-left: auto; margin-right: auto;">
                {{ $data['subtitle'] }}
            </p>
        @endif

        @if(!empty($data['button_text']) && !empty($data['button_link']))
            <a href="{{ $data['button_link'] }}" style="display: inline-block; padding: {{ $inSidebar ? '12px 24px' : '16px 40px' }}; background: #fff; color: {{ $blockBg }}; text-decoration: none; border-radius: {{ $inSidebar ? '6px' : '8px' }}; font-weight: 700; font-size: {{ $inSidebar ? '13px' : '16px' }}; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                {{ $data['button_text'] }}
            </a>
        @endif
    </div>
</div>
