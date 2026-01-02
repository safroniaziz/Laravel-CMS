@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $inSidebar = $inSidebar ?? false;
    
    // Colors
    $useCustomColors = $settings['customColors'] ?? false;
    $blockBg = $useCustomColors && !empty($settings['bgColor']) ? $settings['bgColor'] : ($page->bg_color ?? '#ffffff');
    $blockText = $useCustomColors && !empty($settings['textColor']) ? $settings['textColor'] : ($page->text_color ?? '#333333');
    
    // Spacing & width
    $paddingY = $settings['paddingY'] ?? 'medium';
    $width = $inSidebar ? 'full' : ($settings['width'] ?? 'contained');
    $align = $data['align'] ?? 'center';
    
    $paddingClasses = "padding-{$paddingY}";
    $widthClasses = "width-{$width}";
@endphp

<div class="block-image block-container {{ $paddingClasses }}" style="background: {{ $blockBg }};">
    <div class="block-inner {{ $widthClasses }}" style="text-align: {{ $align }};">
        @if(!empty($data['image']))
            <img src="{{ $data['image'] }}" alt="{{ $data['caption'] ?? '' }}" style="max-width: 100%; height: auto; border-radius: {{ $inSidebar ? '8px' : '12px' }}; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            
            @if(!empty($data['caption']))
                <p style="margin-top: 15px; font-size: {{ $inSidebar ? '12px' : '14px' }}; color: {{ $blockText }}; opacity: 0.7; font-style: italic;">
                    {{ $data['caption'] }}
                </p>
            @endif
        @else
            <div style="background: #f3f4f6; padding: {{ $inSidebar ? '40px 20px' : '80px 40px' }}; border-radius: 12px; text-align: center;">
                <i class="fas fa-image" style="font-size: {{ $inSidebar ? '32px' : '48px' }}; color: #9ca3af;"></i>
                <p style="margin-top: 10px; color: #9ca3af; font-size: {{ $inSidebar ? '12px' : '14px' }};">Gambar belum diatur</p>
            </div>
        @endif
    </div>
</div>
