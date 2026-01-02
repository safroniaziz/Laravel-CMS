@php
    $data = $block['data'] ?? [];
    $style = $data['style'] ?? 'line';
    $icon = $data['icon'] ?? 'fas fa-star';
    $height = $data['height'] ?? '40';
@endphp

<div style="padding: {{ $height }}px 0;">
    @if($style === 'line')
        <div style="max-width: 600px; margin: 0 auto; height: 1px; background: linear-gradient(to right, transparent, #e5e7eb, transparent);"></div>
    
    @elseif($style === 'dots')
        <div style="text-align: center;">
            <span style="color: #d1d5db; font-size: 20px; letter-spacing: 12px;">• • •</span>
        </div>
    
    @elseif($style === 'icon')
        <div style="display: flex; align-items: center; justify-content: center; gap: 20px;">
            <div style="flex: 1; max-width: 200px; height: 1px; background: linear-gradient(to right, transparent, #e5e7eb);"></div>
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);">
                <i class="{{ $icon }}" style="font-size: 18px; color: #fff;"></i>
            </div>
            <div style="flex: 1; max-width: 200px; height: 1px; background: linear-gradient(to left, transparent, #e5e7eb);"></div>
        </div>
    
    @elseif($style === 'space')
        {{-- Just spacing, no visual element --}}
    @endif
</div>
