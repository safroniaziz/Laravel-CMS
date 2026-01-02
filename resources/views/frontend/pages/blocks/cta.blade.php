@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $inSidebar = $inSidebar ?? false;

    // Content
    $title = $data['title'] ?? '';
    $subtitle = $data['subtitle'] ?? '';
    $description = $data['description'] ?? '';
    $icon = $data['icon'] ?? '';
    
    // Buttons
    $btn1Text = $data['btn1_text'] ?? '';
    $btn1Link = $data['btn1_link'] ?? '#';
    $btn2Text = $data['btn2_text'] ?? '';
    $btn2Link = $data['btn2_link'] ?? '#';
    
    // Colors
    $bgColor = $data['bg_color'] ?? ($page->accent_color ?? '#1e3a8a');
    $textColor = $data['text_color'] ?? '#ffffff';
    $btnColor = $data['btn_color'] ?? '#f97316';
    
    // Layout & Style
    $layout = $data['layout'] ?? 'center';
    $style = $data['style'] ?? 'solid';
    
    // Generate gradient if style is gradient
    $bgStyle = $style === 'gradient' 
        ? "linear-gradient(135deg, {$bgColor} 0%, " . adjustBrightness($bgColor, -30) . " 100%)"
        : ($style === 'outline' ? 'transparent' : $bgColor);
    
    $borderStyle = $style === 'outline' ? "2px solid {$bgColor}" : 'none';
    $mainTextColor = $style === 'outline' ? $bgColor : $textColor;
@endphp

@php
function adjustBrightness($hex, $percent) {
    $hex = ltrim($hex, '#');
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $r = max(0, min(255, $r + ($r * $percent / 100)));
    $g = max(0, min(255, $g + ($g * $percent / 100)));
    $b = max(0, min(255, $b + ($b * $percent / 100)));
    return sprintf("#%02x%02x%02x", $r, $g, $b);
}
@endphp

@if($inSidebar)
    {{-- Sidebar CTA - Compact --}}
    <div style="padding: 24px; background: {{ $bgStyle }}; border: {{ $borderStyle }}; border-radius: 0 0 16px 16px; text-align: center;">
        @if($icon)
            <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <i class="{{ $icon }}" style="font-size: 20px; color: {{ $mainTextColor }};"></i>
            </div>
        @endif
        
        @if($title)
            <h4 style="font-size: 18px; font-weight: 700; color: {{ $mainTextColor }}; margin: 0 0 8px;">{{ $title }}</h4>
        @endif
        
        @if($subtitle)
            <p style="font-size: 13px; color: {{ $mainTextColor }}; opacity: 0.9; margin: 0 0 16px;">{{ $subtitle }}</p>
        @endif
        
        @if($btn1Text)
            <a href="{{ $btn1Link }}" style="display: inline-block; padding: 10px 20px; background: {{ $btnColor }}; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 13px;">
                {{ $btn1Text }}
            </a>
        @endif
    </div>
@else
    {{-- Main CTA --}}
    <div style="
        background: {{ $bgStyle }};
        border: {{ $borderStyle }};
        border-radius: 20px;
        padding: 50px 40px;
        position: relative;
        overflow: hidden;
    ">
        {{-- Decorative elements --}}
        @if($style !== 'outline')
        <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
        @endif
        
        <div style="position: relative; z-index: 1; {{ $layout === 'split' ? 'display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 30px;' : 'text-align: ' . ($layout === 'left' ? 'left' : 'center') . ';' }}">
            
            <div style="{{ $layout === 'split' ? 'flex: 1; min-width: 280px;' : '' }}">
                @if($icon && $layout !== 'split')
                    <div style="
                        width: 64px;
                        height: 64px;
                        background: rgba(255,255,255,0.15);
                        border-radius: 16px;
                        display: {{ $layout === 'center' ? 'inline-flex' : 'flex' }};
                        align-items: center;
                        justify-content: center;
                        margin: {{ $layout === 'center' ? '0 auto 20px' : '0 0 20px' }};
                    ">
                        <i class="{{ $icon }}" style="font-size: 28px; color: {{ $mainTextColor }};"></i>
                    </div>
                @endif
                
                @if($title)
                    <h2 style="
                        font-size: clamp(24px, 4vw, 36px);
                        font-weight: 800;
                        color: {{ $mainTextColor }};
                        margin: 0 0 12px;
                        line-height: 1.2;
                    ">{{ $title }}</h2>
                @endif
                
                @if($subtitle)
                    <p style="
                        font-size: 18px;
                        color: {{ $mainTextColor }};
                        opacity: 0.9;
                        margin: 0 0 {{ $description ? '12px' : '0' }};
                        {{ $layout === 'center' ? 'max-width: 600px; margin-left: auto; margin-right: auto;' : '' }}
                    ">{{ $subtitle }}</p>
                @endif
                
                @if($description)
                    <p style="
                        font-size: 15px;
                        color: {{ $mainTextColor }};
                        opacity: 0.8;
                        margin: 0;
                        line-height: 1.6;
                        {{ $layout === 'center' ? 'max-width: 500px; margin-left: auto; margin-right: auto;' : '' }}
                    ">{{ $description }}</p>
                @endif
            </div>
            
            @if($btn1Text || $btn2Text)
                <div style="
                    {{ $layout === 'split' ? '' : 'margin-top: 28px;' }}
                    display: flex;
                    gap: 12px;
                    flex-wrap: wrap;
                    {{ $layout === 'center' ? 'justify-content: center;' : '' }}
                ">
                    @if($btn1Text)
                        <a href="{{ $btn1Link }}" style="
                            display: inline-flex;
                            align-items: center;
                            gap: 8px;
                            padding: 14px 28px;
                            background: {{ $btnColor }};
                            color: #fff;
                            text-decoration: none;
                            border-radius: 10px;
                            font-weight: 600;
                            font-size: 15px;
                            transition: all 0.3s ease;
                            box-shadow: 0 4px 15px {{ $btnColor }}50;
                        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px {{ $btnColor }}60';"
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px {{ $btnColor }}50';">
                            {{ $btn1Text }}
                            <i class="fas fa-arrow-right" style="font-size: 12px;"></i>
                        </a>
                    @endif
                    
                    @if($btn2Text)
                        <a href="{{ $btn2Link }}" style="
                            display: inline-flex;
                            align-items: center;
                            gap: 8px;
                            padding: 14px 28px;
                            background: {{ $style === 'outline' ? $bgColor : 'rgba(255,255,255,0.15)' }};
                            color: {{ $style === 'outline' ? '#fff' : $mainTextColor }};
                            text-decoration: none;
                            border-radius: 10px;
                            font-weight: 600;
                            font-size: 15px;
                            border: 2px solid {{ $style === 'outline' ? $bgColor : 'rgba(255,255,255,0.3)' }};
                            transition: all 0.3s ease;
                        " onmouseover="this.style.background='rgba(255,255,255,0.25)';"
                           onmouseout="this.style.background='{{ $style === 'outline' ? $bgColor : 'rgba(255,255,255,0.15)' }}';">
                            {{ $btn2Text }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endif
