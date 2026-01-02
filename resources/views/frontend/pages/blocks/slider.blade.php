@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $title = $data['title'] ?? '';
    $autoplay = ($data['autoplay'] ?? 'true') === 'true';
    $size = $data['size'] ?? 'medium';
    $height = $data['height'] ?? '450';
    $accentColor = $page->accent_color ?? '#6366f1';
    
    // Size mapping - 'full' now uses 100% of container, not viewport
    $sizeMap = [
        'small' => '600px',
        'medium' => '800px',
        'large' => '1000px',
        'full' => '100%'
    ];
    $maxWidth = $sizeMap[$size] ?? '800px';
    $isFullWidth = $size === 'full';
    
    $items = [];
    $rawItems = $data['items'] ?? '';
    
    if (!empty($rawItems)) {
        foreach(explode("\n", $rawItems) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $parts = array_map('trim', explode('|', $line));
            if (count($parts) >= 1 && !empty($parts[0])) {
                $items[] = [
                    'image' => $parts[0],
                    'title' => $parts[1] ?? '',
                    'description' => $parts[2] ?? ''
                ];
            }
        }
    }
    
    $blockId = 'slider' . uniqid();
@endphp

@if(count($items) > 0)
<div id="{{ $blockId }}" style="width: 100%;">
    @if($title)
        <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 4px; min-height: 28px; background: {{ $accentColor }}; border-radius: 2px; flex-shrink: 0;"></div>
            <h3 style="font-size: 18px; font-weight: 700; margin: 0; color: #1f2937;">{{ $title }}</h3>
        </div>
    @endif
    
    <div style="max-width: {{ $maxWidth }}; margin: 0 auto; position: relative; overflow: hidden; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.1);">
        {{-- Slides Container --}}
        <div class="slides-container" style="display: flex; transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);">
            @foreach($items as $index => $item)
                <div class="slide" style="min-width: 100%; position: relative;">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" 
                        style="width: 100%; height: {{ $height }}px; object-fit: cover; display: block;">
                    @if($item['title'] || $item['description'])
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.75)); padding: 60px 30px 30px;">
                            @if($item['title'])
                                <h4 style="font-size: 20px; font-weight: 700; color: #fff; margin: 0 0 6px;">{{ $item['title'] }}</h4>
                            @endif
                            @if($item['description'])
                                <p style="font-size: 14px; color: rgba(255,255,255,0.9); margin: 0;">{{ $item['description'] }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        
        @if(count($items) > 1)
        {{-- Navigation Arrows --}}
        <button onclick="{{ $blockId }}Nav(-1)" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); width: 48px; height: 48px; background: rgba(255,255,255,0.95); border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 12px rgba(0,0,0,0.15); transition: all 0.2s; z-index: 10;">
            <i class="fas fa-chevron-left" style="font-size: 18px; color: #1f2937;"></i>
        </button>
        <button onclick="{{ $blockId }}Nav(1)" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); width: 48px; height: 48px; background: rgba(255,255,255,0.95); border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 12px rgba(0,0,0,0.15); transition: all 0.2s; z-index: 10;">
            <i class="fas fa-chevron-right" style="font-size: 18px; color: #1f2937;"></i>
        </button>
        
        {{-- Dots --}}
        <div style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 10px; z-index: 10;">
            @foreach($items as $index => $item)
                <button onclick="{{ $blockId }}GoTo({{ $index }})" 
                    class="{{ $blockId }}-dot" 
                    style="width: 12px; height: 12px; background: {{ $index === 0 ? '#fff' : 'rgba(255,255,255,0.5)' }}; border: none; border-radius: 50%; cursor: pointer; transition: all 0.3s; padding: 0;">
                </button>
            @endforeach
        </div>
        @endif
    </div>
</div>

<script>
(function() {
    const slider = document.getElementById('{{ $blockId }}');
    if (!slider) return;
    const container = slider.querySelector('.slides-container');
    const dots = slider.querySelectorAll('.{{ $blockId }}-dot');
    let currentIndex = 0;
    const totalSlides = {{ count($items) }};
    
    window.{{ $blockId }}Nav = function(direction) {
        currentIndex = (currentIndex + direction + totalSlides) % totalSlides;
        updateSlider();
    };
    
    window.{{ $blockId }}GoTo = function(index) {
        currentIndex = index;
        updateSlider();
    };
    
    function updateSlider() {
        container.style.transform = 'translateX(-' + (currentIndex * 100) + '%)';
        dots.forEach((dot, i) => {
            dot.style.background = i === currentIndex ? '#fff' : 'rgba(255,255,255,0.5)';
        });
    }
    
    @if($autoplay && count($items) > 1)
    let autoplayInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    }, 5000);
    
    slider.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
    slider.addEventListener('mouseleave', () => {
        autoplayInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider();
        }, 5000);
    });
    @endif
})();
</script>
@endif
