@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $inSidebar = $inSidebar ?? false;
    
    // Colors
    $useCustomColors = $settings['customColors'] ?? false;
    $blockBg = $useCustomColors && !empty($settings['bgColor']) ? $settings['bgColor'] : ($page->bg_color ?? '#ffffff');
    $blockText = $useCustomColors && !empty($settings['textColor']) ? $settings['textColor'] : ($page->text_color ?? '#333333');
    $blockAccent = $useCustomColors && !empty($settings['accentColor']) ? $settings['accentColor'] : ($page->accent_color ?? '#1e3a8a');
    
    // Parse features
    $features = [];
    $iconMap = ['star' => '⭐', 'check' => '✅', 'heart' => '❤️', 'rocket' => '🚀', 'trophy' => '🏆', 'lightbulb' => '💡', 'users' => '👥', 'chart' => '📈', 'shield' => '🛡️', 'target' => '🎯', 'globe' => '🌐'];
    
    foreach(explode("\n", $data['features'] ?? '') as $line) {
        $parts = array_map('trim', explode('|', $line));
        if (count($parts) >= 3) {
            $features[] = [
                'icon' => $iconMap[$parts[0]] ?? '⭐',
                'title' => $parts[1],
                'text' => $parts[2]
            ];
        }
    }
    
    // Spacing
    $paddingY = $settings['paddingY'] ?? 'medium';
    $width = $inSidebar ? 'full' : ($settings['width'] ?? 'contained');
    $style = $inSidebar ? 'list' : ($data['style'] ?? 'cards');
    
    $paddingClasses = "padding-{$paddingY}";
    $widthClasses = "width-{$width}";
@endphp

<div class="block-features block-container {{ $paddingClasses }}" style="background: {{ $blockBg }};">
    <div class="block-inner {{ $widthClasses }}">
        @if($style === 'cards' && !$inSidebar)
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px;">
                @foreach($features as $feature)
                    <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-top: 3px solid {{ $blockAccent }};">
                        <div style="font-size: 36px; margin-bottom: 15px;">{{ $feature['icon'] }}</div>
                        <h3 style="color: {{ $blockAccent }}; font-size: 18px; font-weight: 700; margin: 0 0 10px;">{{ $feature['title'] }}</h3>
                        <p style="color: {{ $blockText }}; margin: 0; font-size: 14px; line-height: 1.6;">{{ $feature['text'] }}</p>
                    </div>
                @endforeach
            </div>
        @elseif($style === 'grid' && !$inSidebar)
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                @foreach($features as $feature)
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <div style="width: 50px; height: 50px; background: {{ $blockAccent }}; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">
                            {{ $feature['icon'] }}
                        </div>
                        <div>
                            <h3 style="color: {{ $blockText }}; font-size: 16px; font-weight: 700; margin: 0 0 6px;">{{ $feature['title'] }}</h3>
                            <p style="color: {{ $blockText }}; opacity: 0.7; margin: 0; font-size: 13px; line-height: 1.5;">{{ $feature['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- List style or sidebar --}}
            <div style="display: flex; flex-direction: column; gap: {{ $inSidebar ? '15px' : '20px' }};">
                @foreach($features as $feature)
                    <div style="display: flex; gap: {{ $inSidebar ? '10px' : '15px' }}; align-items: flex-start; {{ $inSidebar ? '' : 'padding: 15px 0; border-bottom: 1px solid #e5e7eb;' }}">
                        <div style="font-size: {{ $inSidebar ? '20px' : '28px' }}; flex-shrink: 0;">{{ $feature['icon'] }}</div>
                        <div>
                            <h3 style="color: {{ $blockText }}; font-size: {{ $inSidebar ? '13px' : '16px' }}; font-weight: 700; margin: 0 0 {{ $inSidebar ? '4px' : '6px' }};">{{ $feature['title'] }}</h3>
                            <p style="color: {{ $blockText }}; opacity: 0.7; margin: 0; font-size: {{ $inSidebar ? '12px' : '14px' }}; line-height: 1.5;">{{ $feature['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
