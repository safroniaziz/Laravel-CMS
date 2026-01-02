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
                    'date' => $parts[0],
                    'title' => $parts[1],
                    'description' => $parts[2] ?? ''
                ];
            }
        }
    }
    
    $blockId = 'tl' . uniqid();
@endphp

@if(count($items) > 0)
<div id="{{ $blockId }}" style="width: 100%;">
    @if($title)
        <div style="margin-bottom: 32px; display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 4px; min-height: 28px; background: {{ $accentColor }}; border-radius: 2px; flex-shrink: 0;"></div>
            <h3 style="font-size: 20px; font-weight: 700; margin: 0; color: #1f2937;">{{ $title }}</h3>
        </div>
    @endif
    
    <div style="position: relative; width: 100%;">
        {{-- Center Line for Desktop --}}
        <div class="timeline-line" style="position: absolute; left: 50%; top: 0; bottom: 0; width: 3px; background: linear-gradient(180deg, {{ $accentColor }}40, {{ $accentColor }}20); transform: translateX(-50%); border-radius: 2px;"></div>
        
        @foreach($items as $index => $item)
            @php 
                $isLeft = $index % 2 === 0;
            @endphp
            <div class="timeline-item" style="
                display: flex; 
                align-items: flex-start;
                justify-content: {{ $isLeft ? 'flex-start' : 'flex-end' }};
                position: relative;
                margin-bottom: {{ $loop->last ? '0' : '24px' }};
                width: 100%;
            ">
                {{-- Content Card --}}
                <div style="
                    width: calc(50% - 40px);
                    background: #fff;
                    border-radius: 12px;
                    padding: 20px;
                    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
                    border: 1px solid #e5e7eb;
                    position: relative;
                    transition: all 0.3s ease;
                " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 12px rgba(0,0,0,0.06)'">
                    {{-- Arrow --}}
                    <div style="
                        position: absolute;
                        top: 20px;
                        {{ $isLeft ? 'right: -8px' : 'left: -8px' }};
                        width: 16px;
                        height: 16px;
                        background: #fff;
                        border: 1px solid #e5e7eb;
                        {{ $isLeft ? 'border-left: none; border-bottom: none;' : 'border-right: none; border-top: none;' }}
                        transform: rotate(45deg);
                    "></div>
                    
                    {{-- Date Badge --}}
                    <div style="
                        display: inline-flex;
                        align-items: center;
                        gap: 6px;
                        background: {{ $accentColor }}12;
                        color: {{ $accentColor }};
                        font-size: 12px;
                        font-weight: 700;
                        padding: 5px 12px;
                        border-radius: 6px;
                        margin-bottom: 10px;
                    ">
                        <i class="fas fa-calendar-alt" style="font-size: 10px;"></i>
                        {{ $item['date'] }}
                    </div>
                    
                    {{-- Title --}}
                    <h4 style="font-size: 16px; font-weight: 700; color: #1f2937; margin: 0 0 6px; line-height: 1.4;">{{ $item['title'] }}</h4>
                    
                    {{-- Description --}}
                    @if($item['description'])
                        <p style="font-size: 13px; color: #6b7280; margin: 0; line-height: 1.6;">{!! $item['description'] !!}</p>
                    @endif
                </div>
                
                {{-- Center Dot --}}
                <div style="
                    position: absolute;
                    left: 50%;
                    top: 20px;
                    transform: translateX(-50%);
                    width: 16px;
                    height: 16px;
                    background: {{ $accentColor }};
                    border-radius: 50%;
                    border: 3px solid #fff;
                    box-shadow: 0 2px 8px {{ $accentColor }}50;
                    z-index: 2;
                "></div>
                
                {{-- Number Badge --}}
                <div style="
                    position: absolute;
                    left: 50%;
                    top: 42px;
                    transform: translateX(-50%);
                    width: 24px;
                    height: 24px;
                    background: #f3f4f6;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 11px;
                    font-weight: 700;
                    color: #6b7280;
                    z-index: 1;
                ">{{ $index + 1 }}</div>
            </div>
        @endforeach
    </div>
</div>

<style>
@media (max-width: 768px) {
    #{{ $blockId }} .timeline-line {
        left: 16px !important;
        transform: none !important;
    }
    #{{ $blockId }} .timeline-item {
        justify-content: flex-end !important;
    }
    #{{ $blockId }} .timeline-item > div:first-child {
        width: calc(100% - 50px) !important;
    }
    #{{ $blockId }} .timeline-item > div:first-child > div:first-child {
        left: -8px !important;
        right: auto !important;
        border-right: none !important;
        border-top: none !important;
        border-left: 1px solid #e5e7eb !important;
        border-bottom: 1px solid #e5e7eb !important;
    }
    #{{ $blockId }} .timeline-item > div:nth-child(2),
    #{{ $blockId }} .timeline-item > div:nth-child(3) {
        left: 16px !important;
    }
}
</style>
@endif
