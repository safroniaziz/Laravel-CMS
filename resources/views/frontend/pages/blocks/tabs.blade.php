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
            if (count($parts) >= 2) {
                $items[] = [
                    'title' => $parts[0],
                    'content' => $parts[1]
                ];
            }
        }
    }
    
    $blockId = 'tab' . uniqid();
@endphp

@if(count($items) > 0)
<div id="{{ $blockId }}">
    @if($title)
        <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 4px; min-height: 28px; background: {{ $accentColor }}; border-radius: 2px; flex-shrink: 0;"></div>
            <h3 style="font-size: 18px; font-weight: 700; margin: 0; color: #1f2937;">{{ $title }}</h3>
        </div>
    @endif
    
    <div style="background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); overflow: hidden; border: 1px solid #e5e7eb;">
        {{-- Tab Headers --}}
        <div style="display: flex; gap: 4px; padding: 8px; background: #f3f4f6; overflow-x: auto;">
            @foreach($items as $index => $item)
                <button onclick="switchTab{{ $blockId }}({{ $index }})" 
                    id="{{ $blockId }}btn{{ $index }}"
                    style="
                        padding: 10px 20px; 
                        font-size: 13px; 
                        font-weight: 600; 
                        color: {{ $index === 0 ? '#fff' : '#6b7280' }}; 
                        background: {{ $index === 0 ? $accentColor : 'transparent' }}; 
                        border: none; 
                        border-radius: 8px;
                        cursor: pointer; 
                        white-space: nowrap; 
                        transition: all 0.2s;
                    ">
                    {{ $item['title'] }}
                </button>
            @endforeach
        </div>
        
        {{-- Tab Contents --}}
        @foreach($items as $index => $item)
            <div id="{{ $blockId }}content{{ $index }}" style="padding: 20px; display: {{ $index === 0 ? 'block' : 'none' }}; color: #4b5563; line-height: 1.7; font-size: 14px;">
                {!! $item['content'] !!}
            </div>
        @endforeach
    </div>
</div>

<script>
function switchTab{{ $blockId }}(index) {
    var id = '{{ $blockId }}';
    // Hide all & reset buttons
    @foreach($items as $i => $item)
    document.getElementById(id + 'content{{ $i }}').style.display = 'none';
    document.getElementById(id + 'btn{{ $i }}').style.background = 'transparent';
    document.getElementById(id + 'btn{{ $i }}').style.color = '#6b7280';
    @endforeach
    // Show selected
    document.getElementById(id + 'content' + index).style.display = 'block';
    document.getElementById(id + 'btn' + index).style.background = '{{ $accentColor }}';
    document.getElementById(id + 'btn' + index).style.color = '#fff';
}
</script>
@endif
