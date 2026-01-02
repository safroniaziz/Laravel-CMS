{{-- Individual Teacher Card - For AJAX Loading --}}
@foreach($teachers as $teacher)
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

        {{-- Contact Links - Always show all 3 icons --}}
        <div style="display: flex; gap: 10px;">
            <div style="width: 36px; height: 36px; background: #f8fafc; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.background='#1a246a'; this.style.color='#fff';" onmouseout="this.style.background='#f8fafc'; this.style.color='#64748b';">
                <i class="fas fa-envelope"></i>
            </div>
            <div style="width: 36px; height: 36px; background: #f8fafc; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.background='#0077b5'; this.style.color='#fff';" onmouseout="this.style.background='#f8fafc'; this.style.color='#64748b';">
                <i class="fab fa-linkedin"></i>
            </div>
            <div style="width: 36px; height: 36px; background: #f8fafc; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.background='#4285f4'; this.style.color='#fff';" onmouseout="this.style.background='#f8fafc'; this.style.color='#64748b';">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div style="flex: 1;"></div>
            <a href="{{ route('teachers.show', $teacher->id) }}" style="padding: 8px 16px; background: {{ $teacher->gradient ? (strpos($teacher->gradient, '#1a246a') !== false ? '#1a246a' : '#f59e0b') : '#1a246a' }}; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none;" onmouseover="this.style.opacity='0.85'; this.style.transform='scale(1.05)';" onmouseout="this.style.opacity='1'; this.style.transform='scale(1)';">
                Profil
            </a>
        </div>
    </div>
</div>
@endforeach
