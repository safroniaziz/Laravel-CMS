@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $inSidebar = $inSidebar ?? false;

    // Colors
    $useCustomColors = $settings['customColors'] ?? false;
    $blockBg = $useCustomColors && !empty($settings['bgColor']) ? $settings['bgColor'] : '#ffffff';
    $accentColor = $page->accent_color ?? '#1e3a8a';

    // Content
    $title = $data['title'] ?? '';
    $subtitle = $data['subtitle'] ?? '';
    $icon = $data['icon'] ?? 'fas fa-images';

    // Parse images with title and subtitle
    // Format: JSON per line: {"url":"...","title":"...","subtitle":"..."}
    $images = [];
    $rawImages = $data['images'] ?? '';
    if (!empty($rawImages)) {
        foreach (explode("\n", $rawImages) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            // Try JSON format first
            $item = json_decode($line, true);
            if ($item && isset($item['url'])) {
                $images[] = [
                    'url' => $item['url'] ?? '',
                    'title' => $item['title'] ?? '',
                    'subtitle' => $item['subtitle'] ?? ''
                ];
            } else {
                // Legacy format: just URL or url|title|subtitle
                $parts = array_map('trim', explode('|', $line));
                $images[] = [
                    'url' => $parts[0] ?? '',
                    'title' => $parts[1] ?? '',
                    'subtitle' => $parts[2] ?? ''
                ];
            }
        }
    }
    
    $columns = $inSidebar ? 2 : (int)($data['columns'] ?? 3);

    // Spacing
    $paddingY = $settings['paddingY'] ?? 'medium';
    $width = $inSidebar ? 'full' : ($settings['width'] ?? 'contained');
    
    $blockId = 'gallery-' . uniqid();
@endphp

@if($inSidebar)
    {{-- Sidebar: Compact gallery --}}
    <div style="padding: 20px;">
        @if($title)
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                <div style="width: 36px; height: 36px; background: linear-gradient(135deg, {{ $accentColor }}22, {{ $accentColor }}11); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="{{ $icon }}" style="font-size: 16px; color: {{ $accentColor }};"></i>
                </div>
                <div>
                    <h4 style="margin: 0; font-size: 14px; font-weight: 700; color: #1f2937;">{{ $title }}</h4>
                    @if($subtitle)
                        <p style="margin: 2px 0 0; font-size: 11px; color: #6b7280;">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
        @endif
        
        @if(count($images) > 0)
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;">
                @foreach(array_slice($images, 0, 6) as $image)
                    <div class="gallery-thumb" style="aspect-ratio: 1; overflow: hidden; border-radius: 8px; cursor: pointer; position: relative;">
                        <img src="{{ $image['url'] }}" alt="{{ $image['title'] ?: 'Gallery' }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                        @if($image['title'])
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); padding: 8px; color: #fff;">
                                <div style="font-size: 10px; font-weight: 600; line-height: 1.2;">{{ Str::limit($image['title'], 20) }}</div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            @if(count($images) > 6)
                <p style="text-align: center; margin: 12px 0 0; font-size: 12px; color: {{ $accentColor }};">+{{ count($images) - 6 }} foto lainnya</p>
            @endif
        @else
            <div style="background: #f3f4f6; padding: 30px 15px; border-radius: 8px; text-align: center;">
                <i class="fas fa-images" style="font-size: 24px; color: #9ca3af;"></i>
                <p style="margin-top: 8px; color: #9ca3af; font-size: 12px;">Gallery kosong</p>
            </div>
        @endif
    </div>
@else
    {{-- Main: Gallery with header --}}
    <div class="gallery-section" style="
        background: {{ $blockBg }};
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    "
    onmouseover="this.style.boxShadow='0 8px 40px rgba(0,0,0,0.1)';"
    onmouseout="this.style.boxShadow='0 4px 24px rgba(0,0,0,0.06)';">
        {{-- Gallery Header --}}
        @if($title)
            <div style="
                padding: 24px 28px;
                border-bottom: 1px solid rgba(0,0,0,0.06);
                display: flex;
                align-items: center;
                gap: 14px;
            ">
                <div style="
                    width: 44px;
                    height: 44px;
                    background: {{ $accentColor }};
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
                    <i class="{{ $icon }}" style="font-size: 20px; color: #fff;"></i>
                </div>
                <div>
                    <h3 style="
                        font-size: clamp(18px, 2.5vw, 22px);
                        font-weight: 700;
                        color: #1f2937;
                        margin: 0 0 2px;
                    ">{{ $title }}</h3>
                    @if($subtitle)
                        <p style="
                            font-size: 14px;
                            color: #64748b;
                            margin: 0;
                        ">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
        @endif
        
        {{-- Gallery Grid --}}
        <div style="padding: {{ $title ? '20px 24px 24px' : '24px' }};">
            @if(count($images) > 0)
                <div class="gallery-grid" style="
                    display: grid;
                    grid-template-columns: repeat({{ $columns }}, 1fr);
                    gap: 16px;
                ">
                    @foreach(array_slice($images, 0, 12) as $index => $image)
                        <div class="gallery-item" style="
                            aspect-ratio: 1;
                            overflow: hidden;
                            border-radius: 16px;
                            cursor: pointer;
                            position: relative;
                            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                        " onclick="openLightbox('{{ $image['url'] }}', '{{ addslashes($image['title']) }}', '{{ addslashes($image['subtitle']) }}')"
                           onmouseenter="this.querySelector('.gallery-overlay').style.opacity='1'; this.querySelector('img').style.transform='scale(1.1)';"
                           onmouseleave="this.querySelector('.gallery-overlay').style.opacity='0'; this.querySelector('img').style.transform='scale(1)';">
                            <img src="{{ $image['url'] }}" alt="{{ $image['title'] ?: 'Gallery ' . ($index + 1) }}" style="
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                                transition: transform 0.5s ease;
                            ">
                            <div class="gallery-overlay" style="
                                position: absolute;
                                inset: 0;
                                background: linear-gradient(180deg, transparent 30%, rgba(0,0,0,0.85) 100%);
                                opacity: 0;
                                transition: opacity 0.3s ease;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: flex-end;
                                padding: 20px;
                                text-align: center;
                            ">
                                @if($image['title'] || $image['subtitle'])
                                    @if($image['title'])
                                        <div style="color: #fff; font-size: 15px; font-weight: 700; margin-bottom: 6px; line-height: 1.3;">{{ Str::limit($image['title'], 50) }}</div>
                                    @endif
                                    @if($image['subtitle'])
                                        <div style="color: rgba(255,255,255,0.85); font-size: 13px; line-height: 1.4;">{{ Str::limit($image['subtitle'], 60) }}</div>
                                    @endif
                                @else
                                    <i class="fas fa-search-plus" style="color: #fff; font-size: 24px;"></i>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if(count($images) > 12)
                    <div style="text-align: center; margin-top: 24px;">
                        <span style="
                            display: inline-block;
                            padding: 12px 24px;
                            background: {{ $accentColor }}15;
                            color: {{ $accentColor }};
                            border-radius: 50px;
                            font-weight: 600;
                            font-size: 14px;
                        ">
                            <i class="fas fa-images me-2"></i>+{{ count($images) - 12 }} foto lainnya
                        </span>
                    </div>
                @endif
            @else
                <div style="background: #f8fafc; padding: 80px 40px; border-radius: 16px; text-align: center;">
                    <div style="
                        width: 100px;
                        height: 100px;
                        background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 20px;
                    ">
                        <i class="fas fa-images" style="font-size: 40px; color: {{ $accentColor }};"></i>
                    </div>
                    <h3 style="color: #374151; font-weight: 700; margin: 0 0 8px;">Gallery Kosong</h3>
                    <p style="color: #9ca3af; margin: 0; font-size: 15px;">Belum ada foto yang ditambahkan</p>
                </div>
            @endif
        </div>
    </div>
@endif

<style>
.gallery-item:hover img {
    transform: scale(1.1);
}
.gallery-item:hover .gallery-overlay {
    opacity: 1;
}
.gallery-thumb:hover img {
    transform: scale(1.1);
}

@media (max-width: 768px) {
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px !important;
    }
    .gallery-section > div:first-child {
        padding: 32px 24px !important;
    }
}
</style>

<!-- Gallery Modal -->
<div id="galleryModal" class="gallery-modal" onclick="if(event.target === this) closeGalleryModal()">
    <div class="gallery-modal-content">
        <button class="gallery-modal-close" onclick="closeGalleryModal()">
            <i class="fas fa-times"></i>
        </button>
        <div class="gallery-modal-img-wrapper">
            <img id="galleryModalImg" src="" alt="">
        </div>
        <div id="galleryModalCaption" class="gallery-modal-caption">
            <div id="galleryModalTitle" class="gallery-modal-title"></div>
            <div id="galleryModalSubtitle" class="gallery-modal-subtitle"></div>
        </div>
    </div>
</div>

<style>
.gallery-modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-modal::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

.gallery-modal.active {
    opacity: 1;
}

.gallery-modal-content {
    position: relative;
    max-width: 900px;
    width: 100%;
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 
        0 25px 80px rgba(0, 0, 0, 0.5),
        0 0 0 1px rgba(255, 255, 255, 0.1);
    transform: scale(0.8) translateY(30px);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.gallery-modal.active .gallery-modal-content {
    transform: scale(1) translateY(0);
}

.gallery-modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 44px;
    height: 44px;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.gallery-modal-close:hover {
    background: rgba(239, 68, 68, 0.9);
    border-color: rgba(239, 68, 68, 0.5);
    transform: rotate(90deg) scale(1.1);
}

.gallery-modal-img-wrapper {
    position: relative;
    background: #f8fafc;
}

.gallery-modal-img-wrapper img {
    display: block;
    width: 100%;
    max-height: 70vh;
    object-fit: contain;
    opacity: 0;
    transform: scale(0.95);
    transition: opacity 0.4s ease 0.1s, transform 0.4s ease 0.1s;
}

.gallery-modal.active .gallery-modal-img-wrapper img {
    opacity: 1;
    transform: scale(1);
}

.gallery-modal-caption {
    padding: 24px 30px;
    text-align: center;
    background: #fff;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    display: none;
    opacity: 0;
    transform: translateY(10px);
    transition: opacity 0.3s ease 0.2s, transform 0.3s ease 0.2s;
}

.gallery-modal.active .gallery-modal-caption {
    opacity: 1;
    transform: translateY(0);
}

.gallery-modal-title {
    font-size: 20px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 6px;
    line-height: 1.4;
}

.gallery-modal-subtitle {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .gallery-modal {
        padding: 10px;
    }
    .gallery-modal-content {
        border-radius: 16px;
    }
    .gallery-modal-img-wrapper img {
        max-height: 50vh;
    }
    .gallery-modal-caption {
        padding: 16px 20px;
    }
    .gallery-modal-title {
        font-size: 16px;
    }
    .gallery-modal-close {
        width: 38px;
        height: 38px;
        top: 10px;
        right: 10px;
    }
}
</style>

<script>
function openLightbox(imageUrl, title, subtitle) {
    const modal = document.getElementById('galleryModal');
    const img = document.getElementById('galleryModalImg');
    const caption = document.getElementById('galleryModalCaption');
    const titleEl = document.getElementById('galleryModalTitle');
    const subtitleEl = document.getElementById('galleryModalSubtitle');
    
    img.src = imageUrl;
    img.alt = title || 'Gallery';
    
    if (title || subtitle) {
        caption.style.display = 'block';
        titleEl.textContent = title || '';
        subtitleEl.textContent = subtitle || '';
        titleEl.style.display = title ? 'block' : 'none';
        subtitleEl.style.display = subtitle ? 'block' : 'none';
    } else {
        caption.style.display = 'none';
    }
    
    modal.style.display = 'flex';
    
    requestAnimationFrame(() => {
        modal.classList.add('active');
    });
}

function closeGalleryModal() {
    const modal = document.getElementById('galleryModal');
    if (!modal) return;
    
    modal.classList.remove('active');
    
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeGalleryModal();
});
</script>
