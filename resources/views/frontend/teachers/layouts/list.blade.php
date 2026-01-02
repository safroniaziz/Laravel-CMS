{{-- List Layout --}}
<div style="display: flex; flex-direction: column; gap: 25px;">
    @forelse($teachers as $teacher)
        <article style="background: {{ $teacherSettings['card']['bg_color'] }}; border-radius: {{ $teacherSettings['card']['border_radius'] }}px; overflow: hidden; box-shadow: {{ $teacherSettings['card']['shadow'] }}; transition: all 0.3s; display: grid; grid-template-columns: 250px 1fr; gap: 0; border: 1px solid rgba(0,0,0,0.05);" onmouseover="this.style.boxShadow='{{ $teacherSettings['card']['hover_shadow'] }}';" onmouseout="this.style.boxShadow='{{ $teacherSettings['card']['shadow'] }}';">
            {{-- Photo --}}
            <div style="position: relative; overflow: hidden; background: linear-gradient(135deg, {{ $teacherSettings['card']['primary_color'] }}20, {{ $teacherSettings['card']['primary_color'] }}40);">
                @if($teacher->photo)
                    <img src="{{ asset($teacher->photo) }}" alt="{{ $teacher->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-tie" style="font-size: 64px; color: {{ $teacherSettings['card']['primary_color'] }}40;"></i>
                    </div>
                @endif
            </div>

            {{-- Content --}}
            <div style="padding: 30px; display: flex; flex-direction: column;">
                <div style="flex: 1;">
                    <h3 style="font-size: 24px; font-weight: 800; color: #1e293b; margin: 0 0 10px 0;">
                        {{ $teacher->name }}
                    </h3>
                    
                    @if($teacher->title)
                        <p style="color: {{ $teacherSettings['card']['primary_color'] }}; font-size: 16px; font-weight: 600; margin: 0 0 20px 0;">
                            {{ $teacher->title }}
                        </p>
                    @endif

                    @if($teacher->bio)
                        <p style="color: #64748b; font-size: 15px; line-height: 1.7; margin: 0 0 20px 0;">
                            {{ Str::limit($teacher->bio, 200) }}
                        </p>
                    @endif

                    {{-- Contact Info - Always show, disabled if no value --}}
                    @php
                        $isBlue = strpos($teacher->gradient, '#1a246a') !== false;
                        $iconColor = $isBlue ? '#3b82f6' : '#f59e0b';
                    @endphp
                    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">
                        <span style="color: {{ $teacher->email ? '#64748b' : '#cbd5e1' }}; font-size: 14px; display: flex; align-items: center; gap: 8px; {{ !$teacher->email ? 'opacity: 0.5;' : '' }}">
                            <i class="fas fa-envelope" style="color: {{ $teacher->email ? $iconColor : '#cbd5e1' }};"></i>
                            {{ $teacher->email ?? '-' }}
                        </span>
                        <span style="color: {{ $teacher->phone ? '#64748b' : '#cbd5e1' }}; font-size: 14px; display: flex; align-items: center; gap: 8px; {{ !$teacher->phone ? 'opacity: 0.5;' : '' }}">
                            <i class="fas fa-phone" style="color: {{ $teacher->phone ? $iconColor : '#cbd5e1' }};"></i>
                            {{ $teacher->phone ?? '-' }}
                        </span>
                        <span style="color: {{ $teacher->linkedin ? '#64748b' : '#cbd5e1' }}; font-size: 14px; display: flex; align-items: center; gap: 8px; {{ !$teacher->linkedin ? 'opacity: 0.5;' : '' }}">
                            <i class="fab fa-linkedin" style="color: {{ $teacher->linkedin ? $iconColor : '#cbd5e1' }};"></i>
                            @if($teacher->linkedin)
                                <a href="{{ $teacher->linkedin }}" target="_blank" style="color: inherit; text-decoration: none;">LinkedIn</a>
                            @else
                                -
                            @endif
                        </span>
                    </div>
                </div>

                <a href="{{ route('teachers.show', $teacher->id) }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: linear-gradient(135deg, {{ $teacherSettings['card']['primary_color'] }}, {{ $teacherSettings['card']['primary_color'] }}dd); color: #fff; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 600; transition: all 0.3s; align-self: flex-start;" onmouseover="this.style.transform='translateX(5px)';" onmouseout="this.style.transform='translateX(0)';">
                    Lihat Profil Lengkap
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </article>
    @empty
        <div style="text-align: center; padding: 80px 20px;">
            <i class="fas fa-user-slash" style="font-size: 64px; color: #cbd5e1; margin-bottom: 20px;"></i>
            <p style="color: #64748b; font-size: 18px;">Belum ada data pengajar</p>
        </div>
    @endforelse
</div>

<style>
    @media (max-width: 768px) {
        article {
            grid-template-columns: 1fr !important;
        }
    }
</style>
