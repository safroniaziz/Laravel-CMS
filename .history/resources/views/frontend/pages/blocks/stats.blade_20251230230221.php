@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $inSidebar = $inSidebar ?? false;

    // Colors
    $useCustomColors = $settings['customColors'] ?? false;
    $blockBg = $useCustomColors && !empty($settings['bgColor']) ? $settings['bgColor'] : ($page->accent_color ?? '#1e3a8a');
    $blockText = $useCustomColors && !empty($settings['textColor']) ? $settings['textColor'] : '#ffffff';

    // Parse stats
    $stats = [];
    foreach(explode("\n", $data['stats'] ?? '') as $line) {
        $parts = array_map('trim', explode('|', $line));
        if (count($parts) >= 2) {
            $stats[] = ['number' => $parts[0], 'label' => $parts[1]];
        }
    }

    // Spacing
    $paddingY = $settings['paddingY'] ?? 'medium';
    $width = $inSidebar ? 'full' : ($settings['width'] ?? 'contained');

    $paddingClasses = "padding-{$paddingY}";
    $widthClasses = "width-{$width}";
@endphp

<div class="block-stats block-container {{ $paddingClasses }}" style="background: {{ $blockBg }};">
    <div class="block-inner {{ $widthClasses }}">
        @if($inSidebar)
            {{-- Sidebar version: vertical stack --}}
            <div style="display: flex; flex-direction: column; gap: 20px;">
                @foreach(array_slice($stats, 0, 4) as $stat)
                    <div style="text-align: center; padding: 20px; background: rgba(255,255,255,0.1); border-radius: 8px;">
                        <div style="font-size: 32px; font-weight: 900; color: {{ $blockText }}; line-height: 1;">{{ $stat['number'] }}</div>
                        <div style="font-size: 12px; color: {{ $blockText }}; opacity: 0.85; margin-top: 8px;">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Main version: grid --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 30px; text-align: center;">
                @foreach(array_slice($stats, 0, 6) as $stat)
                    <div>
                        <div style="font-size: 56px; font-weight: 900; color: {{ $blockText }}; line-height: 1;">{{ $stat['number'] }}</div>
                        <div style="font-size: 16px; color: {{ $blockText }}; opacity: 0.85; margin-top: 12px; font-weight: 500;">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
