@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $title = $data['title'] ?? '';
    $url = $data['url'] ?? '';
    $ratio = $data['ratio'] ?? '16:9';
    $accentColor = $page->accent_color ?? '#6366f1';
    
    $ratios = ['16:9' => '56.25%', '4:3' => '75%', '1:1' => '100%'];
    $paddingBottom = $ratios[$ratio] ?? '56.25%';
    
    // Convert URL to embed format
    $embedUrl = '';
    $url = trim($url);
    
    if (!empty($url)) {
        // YouTube watch URL
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
        }
        // YouTube short URL
        elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
        }
        // YouTube embed URL (already correct)
        elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
        }
        // Vimeo URL
        elseif (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
            $embedUrl = 'https://player.vimeo.com/video/' . $matches[1];
        }
        // Vimeo player URL (already correct)
        elseif (preg_match('/player\.vimeo\.com\/video\/(\d+)/', $url, $matches)) {
            $embedUrl = 'https://player.vimeo.com/video/' . $matches[1];
        }
    }
@endphp

@if(!empty($embedUrl))
<div style="width: 100%;">
    @if($title)
        <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 4px; min-height: 28px; background: {{ $accentColor }}; border-radius: 2px; flex-shrink: 0;"></div>
            <h3 style="font-size: 18px; font-weight: 700; margin: 0; color: #1f2937;">{{ $title }}</h3>
        </div>
    @endif
    
    <div style="position: relative; width: 100%; padding-bottom: {{ $paddingBottom }}; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
        <iframe src="{{ $embedUrl }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>
@elseif(!empty($url))
{{-- URL diisi tapi format tidak valid --}}
<div style="padding: 40px 20px; text-align: center; background: #fef3c7; border-radius: 12px;">
    <i class="fas fa-exclamation-triangle" style="font-size: 32px; color: #f59e0b; margin-bottom: 12px;"></i>
    <p style="color: #92400e; margin: 0; font-size: 14px;">URL video tidak valid. Gunakan link YouTube atau Vimeo.</p>
    <p style="color: #b45309; margin: 8px 0 0; font-size: 12px;">Contoh: https://www.youtube.com/watch?v=xxxxx</p>
</div>
@endif
