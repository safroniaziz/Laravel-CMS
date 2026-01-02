@php
    $data = $block['data'] ?? [];
    $content = $data['content'] ?? '';
    $author = $data['author'] ?? '';
    $role = $data['role'] ?? '';
    $image = $data['image'] ?? '';
@endphp

@php
    $accentColor = $page->accent_color ?? '#6366f1';
@endphp

@if(!empty($content))
<div style="padding: 24px 0;">
    <div style="position: relative;">
        {{-- Quote Card --}}
        <div style="
            background: linear-gradient(135deg, {{ $accentColor }}08 0%, {{ $accentColor }}03 100%);
            border-radius: 16px; 
            padding: 28px 32px; 
            border: 1px solid {{ $accentColor }}15;
            position: relative;
            transition: all 0.3s ease;
        "
        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.08)';"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            {{-- Quote marks --}}
            <div style="position: absolute; top: 20px; left: 24px; font-size: 48px; color: {{ $accentColor }}20; font-family: Georgia, serif; line-height: 1;">"</div>
            
            {{-- Quote Text --}}
            <p style="
                font-size: 17px; 
                font-style: italic; 
                color: #374151; 
                line-height: 1.8; 
                margin: 0 0 20px;
                padding-left: 24px;
            ">
                {{ $content }}
            </p>
            
            {{-- Author Info --}}
            <div style="display: flex; align-items: center; gap: 12px; padding-left: 24px;">
                <div style="width: 3px; height: 40px; background: {{ $accentColor }}; border-radius: 2px;"></div>
                @if($image)
                    <img src="{{ $image }}" alt="{{ $author }}" 
                        style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                @endif
                <div>
                    @if($author)
                        <div style="font-size: 15px; font-weight: 700; color: #1f2937;">{{ $author }}</div>
                    @endif
                    @if($role)
                        <div style="font-size: 13px; color: #64748b;">{{ $role }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif
