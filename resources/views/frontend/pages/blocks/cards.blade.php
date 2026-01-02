@php
    $data = $block['data'] ?? [];
    $title = $data['title'] ?? '';
    $items = [];
    $rawItems = $data['items'] ?? '';
    $columns = $data['columns'] ?? 3;
    $style = $data['style'] ?? 'icon-top';
    
    if (!empty($rawItems)) {
        foreach(explode("\n", $rawItems) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $parts = array_map('trim', explode('|', $line));
            if (count($parts) >= 2) {
                $items[] = [
                    'icon' => $parts[0],
                    'title' => $parts[1],
                    'description' => $parts[2] ?? '',
                    'link' => $parts[3] ?? ''
                ];
            }
        }
    }
    
    $colors = [
        ['bg' => '#6366f1', 'light' => '#eef2ff'],
        ['bg' => '#ec4899', 'light' => '#fdf2f8'],
        ['bg' => '#14b8a6', 'light' => '#f0fdfa'],
        ['bg' => '#f59e0b', 'light' => '#fffbeb'],
        ['bg' => '#8b5cf6', 'light' => '#f5f3ff'],
        ['bg' => '#06b6d4', 'light' => '#ecfeff'],
    ];
@endphp

@if(count($items) > 0)
<div style="padding: 30px 0;">
    @if($title)
        <div style="margin-bottom: 28px; display: flex; align-items: center; gap: 12px;">
            <div style="width: 8px; height: 8px; background: #6366f1; border-radius: 50%;"></div>
            <h3 style="
                font-size: clamp(18px, 2.5vw, 22px);
                font-weight: 700;
                margin: 0;
                color: #1f2937;
            ">{{ $title }}</h3>
        </div>
    @endif
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
        @foreach($items as $index => $item)
            @php $color = $colors[$index % 6]; @endphp
            
            @if($style === 'icon-top')
                {{-- Icon Top Style --}}
                <div style="background: #fff; border-radius: 16px; padding: 32px 28px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.04);" 
                    onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 35px rgba(0,0,0,0.1)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';">
                    <div style="width: 64px; height: 64px; background: {{ $color['light'] }}; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="{{ $item['icon'] }}" style="font-size: 28px; color: {{ $color['bg'] }};"></i>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #1f2937; margin: 0 0 10px;">{{ $item['title'] }}</h4>
                    @if($item['description'])
                        <p style="font-size: 14px; color: #64748b; margin: 0; line-height: 1.6;">{{ $item['description'] }}</p>
                    @endif
                    @if($item['link'])
                        <a href="{{ $item['link'] }}" style="display: inline-flex; align-items: center; gap: 6px; margin-top: 16px; color: {{ $color['bg'] }}; font-weight: 600; text-decoration: none; font-size: 14px;">
                            Selengkapnya <i class="fas fa-arrow-right" style="font-size: 11px;"></i>
                        </a>
                    @endif
                </div>
                
            @elseif($style === 'icon-left')
                {{-- Icon Left Style --}}
                <div style="background: #fff; border-radius: 16px; padding: 24px; display: flex; gap: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.12)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';">
                    <div style="width: 56px; height: 56px; background: {{ $color['light'] }}; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="{{ $item['icon'] }}" style="font-size: 24px; color: {{ $color['bg'] }};"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 17px; font-weight: 700; color: #1f2937; margin: 0 0 8px;">{{ $item['title'] }}</h4>
                        @if($item['description'])
                            <p style="font-size: 14px; color: #6b7280; margin: 0; line-height: 1.6;">{{ $item['description'] }}</p>
                        @endif
                        @if($item['link'])
                            <a href="{{ $item['link'] }}" style="display: inline-block; margin-top: 12px; color: {{ $color['bg'] }}; font-weight: 600; text-decoration: none; font-size: 14px;">
                                Selengkapnya <i class="fas fa-arrow-right" style="margin-left: 4px; font-size: 11px;"></i>
                            </a>
                        @endif
                    </div>
                </div>
                
            @elseif($style === 'bordered')
                {{-- Bordered Style --}}
                <div style="background: #fff; border-radius: 16px; padding: 28px; border: 2px solid #e5e7eb; transition: all 0.3s;"
                    onmouseover="this.style.borderColor='{{ $color['bg'] }}'; this.style.transform='translateY(-4px)';"
                    onmouseout="this.style.borderColor='#e5e7eb'; this.style.transform='translateY(0)';">
                    <div style="width: 48px; height: 48px; background: {{ $color['bg'] }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                        <i class="{{ $item['icon'] }}" style="font-size: 22px; color: #fff;"></i>
                    </div>
                    <h4 style="font-size: 17px; font-weight: 700; color: #1f2937; margin: 0 0 10px;">{{ $item['title'] }}</h4>
                    @if($item['description'])
                        <p style="font-size: 14px; color: #6b7280; margin: 0; line-height: 1.6;">{{ $item['description'] }}</p>
                    @endif
                    @if($item['link'])
                        <a href="{{ $item['link'] }}" style="display: inline-block; margin-top: 14px; color: {{ $color['bg'] }}; font-weight: 600; text-decoration: none; font-size: 14px;">
                            Selengkapnya <i class="fas fa-arrow-right" style="margin-left: 4px; font-size: 11px;"></i>
                        </a>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</div>
@endif
