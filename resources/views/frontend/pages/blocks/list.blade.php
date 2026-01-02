@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $title = $data['title'] ?? '';
    $layout = $data['layout'] ?? 'single';
    $accentColor = $page->accent_color ?? '#6366f1';
    $items = [];
    $rawItems = $data['items'] ?? '';
    
    if (!empty($rawItems)) {
        foreach(explode("\n", $rawItems) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $parts = array_map('trim', explode('|', $line));
            if (count($parts) >= 2) {
                $items[] = [
                    'icon' => $parts[0],
                    'text' => $parts[1]
                ];
            } elseif (count($parts) == 1) {
                $items[] = [
                    'icon' => 'fas fa-check',
                    'text' => $parts[0]
                ];
            }
        }
    }
    
    $gridCols = $layout === 'double' ? 'repeat(2, 1fr)' : '1fr';
@endphp

@if(count($items) > 0)
<div style="width: 100%;">
    @if($title)
        <div style="margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 4px; min-height: 28px; background: {{ $accentColor }}; border-radius: 2px; flex-shrink: 0;"></div>
            <h3 style="font-size: 18px; font-weight: 700; margin: 0; color: #1f2937;">{{ $title }}</h3>
        </div>
    @endif
    
    <div style="display: grid; grid-template-columns: {{ $gridCols }}; gap: 12px;">
        @foreach($items as $item)
            <div style="display: flex; align-items: flex-start; gap: 14px; padding: 16px 20px; background: #fff; border-radius: 12px; border: 1px solid #e5e7eb; transition: all 0.2s;">
                <div style="width: 32px; height: 32px; background: {{ $accentColor }}15; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="{{ $item['icon'] }}" style="font-size: 14px; color: {{ $accentColor }};"></i>
                </div>
                <span style="font-size: 15px; color: #374151; line-height: 1.6; padding-top: 4px;">{{ $item['text'] }}</span>
            </div>
        @endforeach
    </div>
</div>
@endif
