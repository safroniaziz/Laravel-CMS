@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $title = $data['title'] ?? '';
    $accentColor = $page->accent_color ?? '#6366f1';
    $items = [];
    $rawItems = $data['items'] ?? '';
    
    if (!empty($rawItems)) {
        foreach(explode("\n", $rawItems) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $parts = array_map('trim', explode('|', $line));
            if (count($parts) >= 1) {
                $items[] = [
                    'title' => $parts[0],
                    'description' => $parts[1] ?? ''
                ];
            }
        }
    }
@endphp

@if(count($items) > 0)
<div style="width: 100%;">
    @if($title)
        <div style="margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 4px; min-height: 28px; background: {{ $accentColor }}; border-radius: 2px; flex-shrink: 0;"></div>
            <h3 style="font-size: 18px; font-weight: 700; margin: 0; color: #1f2937;">{{ $title }}</h3>
        </div>
    @endif
    
    <div style="display: grid; grid-template-columns: 1fr; gap: 12px;">
        @foreach($items as $index => $item)
            <div style="display: flex; align-items: flex-start; gap: 14px; padding: 16px 20px; background: #fff; border-radius: 12px; border: 1px solid #e5e7eb; transition: all 0.2s;">
                <div style="width: 32px; height: 32px; background: {{ $accentColor }}; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <span style="font-size: 14px; font-weight: 700; color: #fff;">{{ $index + 1 }}</span>
                </div>
                <div style="flex: 1; padding-top: 4px;">
                    <h4 style="font-size: 15px; font-weight: 600; color: #374151; margin: 0; line-height: 1.6;">{{ $item['title'] }}</h4>
                    @if($item['description'])
                        <p style="font-size: 14px; color: #6b7280; margin: 6px 0 0; line-height: 1.5;">{{ $item['description'] }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
