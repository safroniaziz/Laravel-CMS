@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $inSidebar = $inSidebar ?? false;

    // Colors
    $useCustomColors = $settings['customColors'] ?? false;
    $blockBg = $useCustomColors && !empty($settings['bgColor']) ? $settings['bgColor'] : ($page->bg_color ?? '#ffffff');

    // Parse images
    $images = array_filter(array_map('trim', explode("\n", $data['images'] ?? '')));
    $columns = $inSidebar ? 2 : (int)($data['columns'] ?? 3);

    // Spacing
    $paddingY = $settings['paddingY'] ?? 'medium';
    $width = $inSidebar ? 'full' : ($settings['width'] ?? 'contained');

    $paddingClasses = "padding-{$paddingY}";
    $widthClasses = "width-{$width}";
@endphp

<div class="block-gallery block-container {{ $paddingClasses }}" style="background: {{ $blockBg }};">
    <div class="block-inner {{ $widthClasses }}">
        @if(count($images) > 0)
            <div style="display: grid; grid-template-columns: repeat({{ $columns }}, 1fr); gap: {{ $inSidebar ? '8px' : '15px' }};">
                @foreach(array_slice($images, 0, 12) as $image)
                    <div style="aspect-ratio: 1; overflow: hidden; border-radius: {{ $inSidebar ? '6px' : '8px' }};">
                        <img src="{{ $image }}" alt="Gallery" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                    </div>
                @endforeach
            </div>
        @else
            <div style="background: #f3f4f6; padding: {{ $inSidebar ? '30px 15px' : '60px 30px' }}; border-radius: 12px; text-align: center;">
                <i class="fas fa-images" style="font-size: {{ $inSidebar ? '24px' : '40px' }}; color: #9ca3af;"></i>
                <p style="margin-top: 10px; color: #9ca3af; font-size: {{ $inSidebar ? '12px' : '14px' }};">Gallery kosong</p>
            </div>
        @endif
    </div>
</div>

<style>
.block-gallery img:hover {
    transform: scale(1.05);
}
</style>
