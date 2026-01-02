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
    
    $blockId = 'acc' . uniqid();
@endphp

@if(count($items) > 0)
<div id="{{ $blockId }}">
    @if($title)
        <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 4px; min-height: 28px; background: {{ $accentColor }}; border-radius: 2px; flex-shrink: 0;"></div>
            <h3 style="font-size: 18px; font-weight: 700; margin: 0; color: #1f2937;">{{ $title }}</h3>
        </div>
    @endif
    
    @foreach($items as $index => $item)
        <div style="background: #fff; border-radius: 10px; margin-bottom: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; overflow: hidden;">
            <button onclick="toggleAcc{{ $blockId }}({{ $index }})" style="width: 100%; padding: 14px 16px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; cursor: pointer; text-align: left;">
                <span style="font-size: 14px; font-weight: 600; color: #1f2937;">{{ $item['title'] }}</span>
                <i class="fas fa-chevron-down" id="{{ $blockId }}icon{{ $index }}" style="color: {{ $accentColor }}; font-size: 11px; transition: transform 0.3s; {{ $index === 0 ? 'transform: rotate(180deg);' : '' }}"></i>
            </button>
            <div id="{{ $blockId }}content{{ $index }}" style="overflow: hidden; transition: max-height 0.3s ease; {{ $index === 0 ? '' : 'max-height: 0;' }}">
                <div style="padding: 0 16px 14px; color: #6b7280; line-height: 1.6; font-size: 13px; border-top: 1px solid #f3f4f6; padding-top: 12px;">
                    {!! nl2br(e($item['content'])) !!}
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
(function(){
    var first = document.getElementById('{{ $blockId }}content0');
    if(first) first.style.maxHeight = first.scrollHeight + 'px';
})();
function toggleAcc{{ $blockId }}(idx) {
    var content = document.getElementById('{{ $blockId }}content' + idx);
    var icon = document.getElementById('{{ $blockId }}icon' + idx);
    if (content.style.maxHeight && content.style.maxHeight !== '0px') {
        content.style.maxHeight = '0px';
        icon.style.transform = 'rotate(0deg)';
    } else {
        content.style.maxHeight = content.scrollHeight + 'px';
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>
@endif
