@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $title = $data['title'] ?? '';
    $embed = $data['embed'] ?? $data['url'] ?? '';
    $height = $data['height'] ?? '400';
    $accentColor = $page->accent_color ?? '#6366f1';
    
    // Extract src from iframe if full embed code is provided
    $mapUrl = '';
    $isValidEmbed = false;
    
    if (!empty($embed)) {
        // Check if it's an iframe embed code
        if (preg_match('/src=["\']([^"\']+)["\']/', $embed, $matches)) {
            $mapUrl = $matches[1];
            $isValidEmbed = true;
        }
        // Check if it's a Google Maps embed URL (starts with google.com/maps/embed)
        elseif (preg_match('/google\.com\/maps\/embed/', $embed)) {
            $mapUrl = $embed;
            $isValidEmbed = true;
        }
    }
@endphp

@if($isValidEmbed && !empty($mapUrl))
<div style="width: 100%;">
    @if($title)
        <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 4px; min-height: 28px; background: {{ $accentColor }}; border-radius: 2px; flex-shrink: 0;"></div>
            <h3 style="font-size: 18px; font-weight: 700; margin: 0; color: #1f2937;">{{ $title }}</h3>
        </div>
    @endif
    
    <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
        <iframe 
            src="{{ $mapUrl }}" 
            width="100%" 
            height="{{ $height }}" 
            style="border: 0; display: block;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
@elseif(!empty($embed))
{{-- URL/embed tidak valid --}}
<div style="padding: 40px 20px; text-align: center; background: #fef3c7; border-radius: 12px;">
    <i class="fas fa-exclamation-triangle" style="font-size: 32px; color: #f59e0b; margin-bottom: 12px;"></i>
    <p style="color: #92400e; margin: 0; font-size: 14px; font-weight: 600;">Format embed peta tidak valid</p>
    <p style="color: #b45309; margin: 12px 0 0; font-size: 13px; line-height: 1.6;">
        URL seperti <code style="background:#fff;padding:2px 6px;border-radius:4px;">maps.app.goo.gl</code> tidak bisa di-embed.<br>
        Gunakan kode embed dari Google Maps:
    </p>
    <ol style="text-align: left; max-width: 400px; margin: 16px auto 0; color: #78350f; font-size: 12px; line-height: 1.8;">
        <li>Buka <a href="https://maps.google.com" target="_blank" style="color:#1e40af;">Google Maps</a></li>
        <li>Cari lokasi yang diinginkan</li>
        <li>Klik tombol <strong>Share</strong> (Bagikan)</li>
        <li>Pilih tab <strong>"Embed a map"</strong></li>
        <li>Copy seluruh kode <code style="background:#fff;padding:1px 4px;border-radius:3px;">&lt;iframe&gt;...&lt;/iframe&gt;</code></li>
    </ol>
</div>
@endif
