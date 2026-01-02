{{-- Featured Grid Layout - Exact Homepage Match --}}
<div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 30px;" data-aos="fade-up">

    {{-- LEFT: Featured First Teacher Card --}}
    @php $featured = $teachers->first(); @endphp
    @if($featured)
    <div style="background: #fff; border-radius: 24px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 8px 30px rgba(0,0,0,0.08); transition: all 0.4s ease;"
         onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 60px rgba(26, 36, 106, 0.18)'; this.style.borderColor='#1a246a';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.08)'; this.style.borderColor='#e2e8f0';">

        {{-- Kaprodi Badge - Only for Kaprodi role --}}
        @if($featured->role === 'kaprodi' && $featured->badge_color)
        <div style="position: absolute; top: 24px; right: 24px; z-index: 10; padding: 10px 20px; background: linear-gradient(135deg, #fbbf24, #f59e0b); border-radius: 12px; box-shadow: 0 6px 20px rgba(251, 191, 36, 0.3);">
            <span style="font-size: 12px; font-weight: 800; color: #78350f; letter-spacing: 0.5px;">⭐ KAPRODI</span>
        </div>
        @endif

        {{-- Photo with Gradient --}}
        <div style="position: relative; height: 360px; background: {{ $featured->gradient ?? 'linear-gradient(135deg, #1a246a, #151945)' }}; overflow: hidden;">
            @if($featured->photo)
                <img src="{{ asset('storage/' . $featured->photo) }}" alt="{{ $featured->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 150px; height: 150px; background: rgba(255,255,255,0.2); backdrop-filter: blur(15px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 5px solid rgba(255,255,255,0.3);">
                    <i class="fas {{ $featured->icon ?? 'fa-user-tie' }}" style="font-size: 64px; color: #fff;"></i>
                </div>
            @endif
        </div>

        {{-- Content --}}
        <div style="padding: 36px 32px;">
            <h3 style="font-size: 22px; font-weight: 800; margin: 0 0 10px 0; line-height: 1.3; color: #1e293b;">
                {{ $featured->name }}
            </h3>
            @if($featured->title)
                <p style="font-size: 15px; color: #64748b; margin: 0 0 24px 0; line-height: 1.5; font-weight: 500;">
                    {{ $featured->title }}
                </p>
            @endif

            {{-- Status Badge --}}
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 24px;">
                <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
            </div>

            {{-- Expertise --}}
            @if($featured->expertise && count($featured->expertise) > 0)
            <div style="margin-bottom: 28px;">
                <div style="font-size: 12px; font-weight: 800; color: #1a246a; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">Bidang Keahlian:</div>
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    @foreach($featured->expertise as $skill)
                    <span style="padding: 8px 16px; background: linear-gradient(135deg, #e8eaf6, #c5cae9); color: #1a246a; border-radius: 20px; font-size: 13px; font-weight: 700; border: 2px solid rgba(26, 36, 106, 0.2);">
                        {{ $skill }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Contact - Always show all 3 icons --}}
            @php
                $isBlue = strpos($featured->gradient, '#1a246a') !== false;
                $iconColor = $isBlue ? '#3b82f6' : '#f59e0b';
                $iconBg = $isBlue ? '#eff6ff' : '#fefce8';
                $iconHoverBg = $isBlue ? '#3b82f6' : '#f59e0b';
                $disabledBg = '#f1f5f9';
                $disabledColor = '#cbd5e1';
            @endphp
            <div style="display: flex; gap: 12px; align-items: center;">
                {{-- Email --}}
                <a href="{{ $featured->email ? 'mailto:'.$featured->email : '#' }}" 
                   style="width: 46px; height: 46px; background: {{ $featured->email ? $iconBg : $disabledBg }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: {{ $featured->email ? $iconColor : $disabledColor }}; font-size: 18px; cursor: {{ $featured->email ? 'pointer' : 'not-allowed' }}; transition: all 0.3s; opacity: {{ $featured->email ? '1' : '0.5' }}; text-decoration: none;"
                   {{ $featured->email ? "onmouseover=\"this.style.background='$iconHoverBg'; this.style.color='#fff'; this.style.transform='scale(1.1)';\" onmouseout=\"this.style.background='$iconBg'; this.style.color='$iconColor'; this.style.transform='scale(1)';\"" : '' }}>
                    <i class="fas fa-envelope"></i>
                </a>
                {{-- LinkedIn --}}
                <a href="{{ $featured->linkedin ?? '#' }}" target="_blank"
                   style="width: 46px; height: 46px; background: {{ $featured->linkedin ? $iconBg : $disabledBg }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: {{ $featured->linkedin ? $iconColor : $disabledColor }}; font-size: 18px; cursor: {{ $featured->linkedin ? 'pointer' : 'not-allowed' }}; transition: all 0.3s; opacity: {{ $featured->linkedin ? '1' : '0.5' }}; text-decoration: none;"
                   {{ $featured->linkedin ? "onmouseover=\"this.style.background='$iconHoverBg'; this.style.color='#fff'; this.style.transform='scale(1.1)';\" onmouseout=\"this.style.background='$iconBg'; this.style.color='$iconColor'; this.style.transform='scale(1)';\"" : '' }}>
                    <i class="fab fa-linkedin"></i>
                </a>
                {{-- Google Scholar --}}
                <a href="{{ $featured->google_scholar ?? '#' }}" target="_blank"
                   style="width: 46px; height: 46px; background: {{ $featured->google_scholar ? $iconBg : $disabledBg }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: {{ $featured->google_scholar ? $iconColor : $disabledColor }}; font-size: 18px; cursor: {{ $featured->google_scholar ? 'pointer' : 'not-allowed' }}; transition: all 0.3s; opacity: {{ $featured->google_scholar ? '1' : '0.5' }}; text-decoration: none;"
                   {{ $featured->google_scholar ? "onmouseover=\"this.style.background='$iconHoverBg'; this.style.color='#fff'; this.style.transform='scale(1.1)';\" onmouseout=\"this.style.background='$iconBg'; this.style.color='$iconColor'; this.style.transform='scale(1)';\"" : '' }}>
                    <i class="fas fa-graduation-cap"></i>
                </a>
                <div style="flex: 1;"></div>
                <a href="{{ route('teachers.show', $featured->id) }}" style="padding: 14px 28px; background: linear-gradient(135deg, #1a246a, #151945); color: #fff; border-radius: 12px; font-size: 14px; font-weight: 800; cursor: pointer; box-shadow: 0 6px 20px rgba(26, 36, 106, 0.3); transition: all 0.3s; text-decoration: none; display: inline-block;"
                     onmouseover="this.style.transform='translateY(-2px) scale(1.05)'; this.style.boxShadow='0 10px 30px rgba(26, 36, 106, 0.4)';"
                     onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 6px 20px rgba(26, 36, 106, 0.3)';">
                    Lihat Profil Lengkap →
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- RIGHT: Compact Grid of Other Teachers --}}
    <div style="display: flex; flex-direction: column; gap: 20px;">
        @foreach($teachers->skip(1)->take(6) as $teacher)
        <div style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; gap: 20px; transition: all 0.3s ease; cursor: pointer;"
             onmouseover="this.style.transform='translateX(8px)'; this.style.boxShadow='0 10px 30px rgba(26, 36, 106, 0.12)'; this.style.borderColor='#1a246a';"
             onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.05)'; this.style.borderColor='#e2e8f0';">

            {{-- Photo Thumbnail with Gradient --}}
            <div style="position: relative; width: 120px; min-width: 120px; height: 120px; background: {{ $teacher->gradient ?? 'linear-gradient(135deg, #1a246a, #151945)' }}; overflow: hidden;">
                @if($teacher->role === 'kaprodi' && $teacher->badge_color)
                <div style="position: absolute; top: 8px; right: 8px; width: 20px; height: 20px; background: {{ $teacher->badge_color }}; border-radius: 50%; z-index: 2; display: flex; align-items: center; justify-content: center; font-size: 10px;">
                    ⭐
                </div>
                @endif

                @if($teacher->photo)
                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 60px; height: 60px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas {{ $teacher->icon ?? 'fa-user-tie' }}" style="font-size: 24px; color: #fff;"></i>
                    </div>
                @endif
            </div>

            {{-- Compact Info --}}
            <div style="flex: 1; padding: 16px 20px 16px 0; display: flex; flex-direction: column; justify-content: center;">
                <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 6px 0; line-height: 1.3; color: #1e293b;">
                    {{ $teacher->name }}
                </h4>
                @if($teacher->title)
                    <p style="font-size: 13px; color: #64748b; margin: 0 0 12px 0; line-height: 1.4;">
                        {{ Str::limit($teacher->title, 50) }}
                    </p>
                @endif
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width: 6px; height: 6px; background: #10b981; border-radius: 50%;"></div>
                    <span style="font-size: 11px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif</span>
                </div>
            </div>

            {{-- View Arrow --}}
            <div style="padding: 16px; display: flex; align-items: center; justify-content: center;">
                <a href="{{ route('teachers.show', $teacher->id) }}" style="width: 36px; height: 36px; background: #f8fafc; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1a246a; transition: all 0.2s; text-decoration: none;" onmouseover="this.style.background='#1a246a'; this.style.color='#fff'; this.style.transform='scale(1.1)';" onmouseout="this.style.background='#f8fafc'; this.style.color='#1a246a'; this.style.transform='scale(1)';">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    @media (max-width: 1024px) {
        div[style*="grid-template-columns: 1.2fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
