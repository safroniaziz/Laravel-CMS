{{-- Grid Layout - Static 4-Column Grid (No Slider) --}}
<div id="teachers-grid-container" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px;" data-aos="fade-up">
    @foreach($teachers as $teacher)
    {{-- Teacher Card --}}
    <div class="teacher-card-clean" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
        {{-- Photo Area with Gradient --}}
        <div style="position: relative; height: 280px; background: {{ $teacher->gradient ?? 'linear-gradient(135deg, #1a246a, #151945)' }}; overflow: hidden;">
            {{-- Kaprodi Badge - Only for Kaprodi role --}}
            @if($teacher->role === 'kaprodi' && $teacher->badge_color)
            <div style="position: absolute; top: 16px; left: 16px; background: {{ $teacher->badge_color }}; color: #78350f; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2;">
                Kaprodi
            </div>
            @endif

            @if($teacher->photo)
                <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                        <i class="fas {{ $teacher->icon ?? 'fa-user-tie' }}" style="font-size: 32px; color: #fff;"></i>
                    </div>
                </div>
            @endif
        </div>

        {{-- Content Area --}}
        <div style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
            </div>

            <h3 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3; color: #1e293b;">
                {{ $teacher->name }}
            </h3>

            @if($teacher->title)
                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.5;">
                    {{ $teacher->title }}
                </p>
            @endif

            {{-- Expertise --}}
            @if($teacher->expertise && count($teacher->expertise) > 0)
            <div style="padding: 12px 16px; background: #f8fafc; border-radius: 8px; margin-bottom: 20px;">
                <p style="font-size: 13px; color: #1a246a; font-weight: 600; margin: 0;">
                    {{ implode(', ', $teacher->expertise) }}
                </p>
            </div>
            @endif

            <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between;">
                {{-- Social Icons - Always show, disabled if no value --}}
                @php
                    $isBlue = strpos($teacher->gradient, '#1a246a') !== false;
                    $iconColor = $isBlue ? '#3b82f6' : '#f59e0b';
                    $iconBg = $isBlue ? '#eff6ff' : '#fefce8';
                @endphp
                <div style="display: flex; gap: 8px;">
                    <a href="{{ $teacher->email ? 'mailto:'.$teacher->email : '#' }}" 
                       class="icon-link {{ !$teacher->email ? 'disabled' : '' }}" 
                       title="Email" 
                       style="background: {{ $teacher->email ? $iconBg : '#f1f5f9' }}; color: {{ $teacher->email ? $iconColor : '#cbd5e1' }}; --hover-color: {{ $iconColor }};"
                       {{ !$teacher->email ? 'onclick=return false;' : '' }}>
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a href="{{ $teacher->linkedin ?? '#' }}" 
                       target="_blank" 
                       class="icon-link {{ !$teacher->linkedin ? 'disabled' : '' }}" 
                       title="LinkedIn" 
                       style="background: {{ $teacher->linkedin ? $iconBg : '#f1f5f9' }}; color: {{ $teacher->linkedin ? $iconColor : '#cbd5e1' }}; --hover-color: {{ $iconColor }};"
                       {{ !$teacher->linkedin ? 'onclick=return false;' : '' }}>
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="{{ $teacher->google_scholar ?? '#' }}" 
                       target="_blank" 
                       class="icon-link {{ !$teacher->google_scholar ? 'disabled' : '' }}" 
                       title="Google Scholar" 
                       style="background: {{ $teacher->google_scholar ? $iconBg : '#f1f5f9' }}; color: {{ $teacher->google_scholar ? $iconColor : '#cbd5e1' }}; --hover-color: {{ $iconColor }};"
                       {{ !$teacher->google_scholar ? 'onclick=return false;' : '' }}>
                        <i class="fas fa-graduation-cap"></i>
                    </a>
                </div>

                {{-- Dynamic Color Button --}}
                @php
                    $isBlueTheme = strpos($teacher->gradient, '#1a246a') !== false;
                    $btnColor = $isBlueTheme ? '#1a246a' : '#f59e0b';
                    $btnText = $isBlueTheme ? '#fff' : '#fff';
                    $btnHover = $isBlueTheme ? '#151d54' : '#d97706';
                @endphp
                <a href="{{ route('teachers.show', $teacher->id) }}" class="profile-btn" style="--btn-bg: {{ $btnColor }}; --btn-hover: {{ $btnHover }}; --btn-text: {{ $btnText }};">
                    Lihat Profil
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
    .teacher-card-clean {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #f1f5f9; /* Subtle border */
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }
    
    .teacher-card-clean:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -5px rgba(0,0,0,0.1); /* Sophisticated shadow */
        border-color: transparent;
    }

    /* Icon Buttons */
    .icon-link {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff; /* White icon */
        background: var(--hover-color); /* Vibrant background by default */
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 14px;
        opacity: 0.9; /* Slight transparency */
    }
    
    .icon-link:hover:not(.disabled) {
        color: #fff;
        background: var(--hover-color);
        transform: translateY(-2px);
        opacity: 1; /* Full vibrancy on hover */
        box-shadow: 0 4px 10px rgba(0,0,0,0.15); /* Shadow on hover */
    }

    .icon-link.disabled {
        cursor: not-allowed;
        opacity: 0.5;
        pointer-events: none;
    }

    .profile-btn {
        padding: 10px 20px;
        background: var(--btn-bg);
        color: var(--btn-text);
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .profile-btn:hover {
        background: var(--btn-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    @media (max-width: 1200px) {
        div[style*="grid-template-columns: repeat(4, 1fr)"] {
            grid-template-columns: repeat(3, 1fr) !important;
        }
    }
    
    @media (max-width: 1024px) {
        div[style*="grid-template-columns: repeat(4, 1fr)"],
        div[style*="grid-template-columns: repeat(3, 1fr)"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
    
    @media (max-width: 640px) {
        div[style*="grid-template-columns: repeat(4, 1fr)"],
        div[style*="grid-template-columns: repeat(3, 1fr)"],
        div[style*="grid-template-columns: repeat(2, 1fr)"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
