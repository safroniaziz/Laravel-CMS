<div class="gallery-item" style="position: relative; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.1); transition: all 0.4s; cursor: pointer; background: #fff;" 
     onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 50px rgba(0,0,0,0.15)';"
     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 40px rgba(0,0,0,0.1)';"
     onclick="openLightbox('{{ $imageSrc }}', '{{ addslashes($gallery->title) }}', '{{ addslashes($gallery->description) }}')">
    
    <!-- Image Container -->
    <div style="position: relative; padding-top: 75%; overflow: hidden;">
        <img src="{{ $imageSrc }}" 
             alt="{{ $gallery->title }}"
             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;"
             onmouseover="this.style.transform='scale(1.1)';"
             onmouseout="this.style.transform='scale(1)';"
             loading="lazy">
        
        <!-- Overlay -->
        <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 50%, rgba(26,36,106,0.9) 100%);"></div>
        
        <!-- Category Badge -->
        @if($gallery->category)
        <span style="position: absolute; top: 15px; left: 15px; padding: 6px 16px; background: rgba(255,255,255,0.95); color: #1a246a; font-size: 12px; font-weight: 700; border-radius: 20px; text-transform: uppercase; letter-spacing: 1px;">
            {{ $gallery->category }}
        </span>
        @endif
        
        <!-- Type Icon -->
        <span style="position: absolute; top: 15px; right: 15px; width: 40px; height: 40px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #1a246a;">
            <i class="fas {{ $gallery->type == 'video' ? 'fa-play' : 'fa-image' }}"></i>
        </span>
    </div>
    
    <!-- Content -->
    <div style="padding: 25px; background: #fff;">
        <h3 style="font-size: 18px; font-weight: 700; color: #1a246a; margin-bottom: 10px; line-height: 1.4;">
            {{ $gallery->title }}
        </h3>
        @if($gallery->description)
        <p style="font-size: 14px; color: #64748b; line-height: 1.6; margin: 0;">
            {{ Str::limit($gallery->description, 100) }}
        </p>
        @endif
        <div style="margin-top: 15px; display: flex; align-items: center; gap: 15px; font-size: 12px; color: #94a3b8;">
            <span><i class="fas fa-calendar me-1"></i> {{ $gallery->created_at->format('d M Y') }}</span>
            <span><i class="fas fa-eye me-1"></i> Lihat Detail</span>
        </div>
    </div>
</div>
