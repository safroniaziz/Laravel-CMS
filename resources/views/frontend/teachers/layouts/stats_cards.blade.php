{{-- Stats Cards Layout - Exact Homepage Match --}}
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px;" data-aos="fade-up">
    @foreach($teachers as $teacher)
    <div style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s; box-shadow: 0 4px 20px rgba(0,0,0,0.06);"
         onmouseover="this.style.transform='translateY(-12px)'; this.style.boxShadow='0 20px 60px rgba(26, 36, 106, 0.15)'; this.style.borderColor='#1a246a';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)'; this.style.borderColor='#e5e7eb';">

        {{-- Photo Area with Gradient --}}
        <div style="position: relative; height: 240px; background: {{ $teacher->gradient ?? 'linear-gradient(135deg, #1a246a, #151945)' }}; overflow: hidden;">
            {{-- Kaprodi Badge - Only for Kaprodi role --}}
            @if($teacher->role === 'kaprodi' && $teacher->badge_color)
            <div style="position: absolute; top: 16px; right: 16px; background: {{ $teacher->badge_color }}; color: #78350f; padding: 6px 14px; border-radius: 20px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2;">
                ⭐ Kaprodi
            </div>
            @endif

            @if($teacher->photo)
                <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 110px; height: 110px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 4px solid rgba(255,255,255,0.3);">
                    <i class="fas {{ $teacher->icon ?? 'fa-user-tie' }}" style="font-size: 42px; color: #fff;"></i>
                </div>
            @endif
        </div>

        {{-- Content --}}
        <div style="padding: 28px 24px;">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
            </div>

            <h3 style="font-size: 20px; font-weight: 800; margin: 0 0 10px 0; line-height: 1.3; color: #1e293b;">
                {{ $teacher->name }}
            </h3>

            @if($teacher->title)
                <p style="font-size: 14px; color: #64748b; margin: 0 0 20px 0; line-height: 1.5;">
                    {{ $teacher->title }}
                </p>
            @endif

            {{-- Expertise --}}
            @if($teacher->expertise && count($teacher->expertise) > 0)
            <div style="padding: 14px 18px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 10px; margin-bottom: 20px; border: 1px solid #bfdbfe;">
                <p style="font-size: 13px; color: #1a246a; font-weight: 700; margin: 0;">
                    {{ implode(', ', $teacher->expertise) }}
                </p>
            </div>
            @endif

            {{-- Stats Row --}}
            @if($teacher->publications || $teacher->projects)
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 16px 0; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; margin-bottom: 20px;">
                @if($teacher->publications)
                <div style="text-align: center;">
                    <div style="font-size: 24px; font-weight: 800; color: #1a246a; margin-bottom: 4px;">{{ $teacher->publications }}</div>
                    <div style="font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Publikasi</div>
                </div>
                @endif
                @if($teacher->projects)
                <div style="text-align: center;">
                    <div style="font-size: 24px; font-weight: 800; color: #f59e0b; margin-bottom: 4px;">{{ $teacher->projects }}</div>
                    <div style="font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Proyek</div>
                </div>
                @endif
            </div>
            @endif

            {{-- Actions - Always show all 3 icons --}}
            @php
                $isBlue = strpos($teacher->gradient, '#1a246a') !== false;
                $iconColor = $isBlue ? '#3b82f6' : '#f59e0b';
                $iconBg = $isBlue ? '#eff6ff' : '#fefce8';
                $iconHoverBg = $isBlue ? '#3b82f6' : '#f59e0b';
                $disabledBg = '#f1f5f9';
                $disabledColor = '#cbd5e1';
            @endphp
            <div style="display: flex; gap: 10px; align-items: center;">
                {{-- Email --}}
                <a href="{{ $teacher->email ? 'mailto:'.$teacher->email : '#' }}" 
                   style="width: 42px; height: 42px; background: {{ $teacher->email ? $iconBg : $disabledBg }}; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: {{ $teacher->email ? $iconColor : $disabledColor }}; font-size: 16px; cursor: {{ $teacher->email ? 'pointer' : 'not-allowed' }}; transition: all 0.3s; opacity: {{ $teacher->email ? '1' : '0.5' }}; text-decoration: none;"
                   {{ $teacher->email ? "onmouseover=\"this.style.background='$iconHoverBg'; this.style.color='#fff'; this.style.transform='scale(1.1)';\" onmouseout=\"this.style.background='$iconBg'; this.style.color='$iconColor'; this.style.transform='scale(1)';\"" : '' }}>
                    <i class="fas fa-envelope"></i>
                </a>
                {{-- LinkedIn --}}
                <a href="{{ $teacher->linkedin ?? '#' }}" target="_blank"
                   style="width: 42px; height: 42px; background: {{ $teacher->linkedin ? $iconBg : $disabledBg }}; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: {{ $teacher->linkedin ? $iconColor : $disabledColor }}; font-size: 16px; cursor: {{ $teacher->linkedin ? 'pointer' : 'not-allowed' }}; transition: all 0.3s; opacity: {{ $teacher->linkedin ? '1' : '0.5' }}; text-decoration: none;"
                   {{ $teacher->linkedin ? "onmouseover=\"this.style.background='$iconHoverBg'; this.style.color='#fff'; this.style.transform='scale(1.1)';\" onmouseout=\"this.style.background='$iconBg'; this.style.color='$iconColor'; this.style.transform='scale(1)';\"" : '' }}>
                    <i class="fab fa-linkedin"></i>
                </a>
                {{-- Google Scholar --}}
                <a href="{{ $teacher->google_scholar ?? '#' }}" target="_blank"
                   style="width: 42px; height: 42px; background: {{ $teacher->google_scholar ? $iconBg : $disabledBg }}; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: {{ $teacher->google_scholar ? $iconColor : $disabledColor }}; font-size: 16px; cursor: {{ $teacher->google_scholar ? 'pointer' : 'not-allowed' }}; transition: all 0.3s; opacity: {{ $teacher->google_scholar ? '1' : '0.5' }}; text-decoration: none;"
                   {{ $teacher->google_scholar ? "onmouseover=\"this.style.background='$iconHoverBg'; this.style.color='#fff'; this.style.transform='scale(1.1)';\" onmouseout=\"this.style.background='$iconBg'; this.style.color='$iconColor'; this.style.transform='scale(1)';\"" : '' }}>
                    <i class="fas fa-graduation-cap"></i>
                </a>
                <div style="flex: 1;"></div>
                <a href="{{ route('teachers.show', $teacher->id) }}" style="padding: 12px 20px; background: linear-gradient(135deg, #1a246a, #151945); color: #fff; border-radius: 10px; font-size: 13px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 15px rgba(26, 36, 106, 0.25); transition: all 0.3s; text-decoration: none; display: inline-block;" onmouseover="this.style.transform='translateY(-2px) scale(1.05)'; this.style.boxShadow='0 8px 25px rgba(26, 36, 106, 0.35)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 15px rgba(26, 36, 106, 0.25)';">
                    Lihat Profil →
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
    @media (max-width: 1024px) {
        div[style*="grid-template-columns: repeat(3, 1fr)"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
    
    @media (max-width: 640px) {
        div[style*="grid-template-columns: repeat(3, 1fr)"],
        div[style*="grid-template-columns: repeat(2, 1fr)"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
