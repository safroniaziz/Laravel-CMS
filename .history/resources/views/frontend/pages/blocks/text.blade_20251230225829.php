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
    $paddingX = $settings['paddingX'] ?? 'medium';
    $width = $inSidebar ? 'full' : ($settings['width'] ?? 'contained');
    
    $paddingClasses = "padding-{$paddingY}";
    $widthClasses = "width-{$width}";
@endphp

<div class="block-text block-container {{ $paddingClasses }}" style="background: {{ $blockBg }};">
    <div class="block-inner {{ $widthClasses }}">
        <div style="font-size: {{ $inSidebar ? '14px' : '17px' }}; line-height: 1.9; color: {{ $blockText }};">
            {!! nl2br(e($data['content'] ?? '')) !!}
        </div>
    </div>
</div>

<style>
.block-text h2, .block-text h3 { 
    color: {{ $blockAccent }}; 
    margin-top: {{ $inSidebar ? '1em' : '1.5em' }}; 
    font-size: {{ $inSidebar ? '16px' : '24px' }};
}
.block-text a { 
    color: {{ $blockAccent }}; 
    text-decoration: underline;
}
.block-text p {
    margin-bottom: 1em;
}
</style>
