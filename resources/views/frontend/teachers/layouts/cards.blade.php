{{-- Cards Layout --}}
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 35px;">
    @forelse($teachers as $teacher)
        <article style="background: {{ $teacherSettings['card']['bg_color'] }}; border-radius: {{ $teacherSettings['card']['border_radius'] }}px; overflow: hidden; box-shadow: {{ $teacherSettings['card']['shadow'] }}; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column; border: 1px solid rgba(0,0,0,0.05); position: relative;" onmouseover="this.style.transform='translateY(-12px) scale(1.02)'; this.style.boxShadow='{{ $teacherSettings['card']['hover_shadow'] }}';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='{{ $teacherSettings['card']['shadow'] }}';">
            {{-- Photo with Overlay --}}
            <div style="position: relative; height: 350px; overflow: hidden;">
                @if($teacher->photo)
                    <img src="{{ asset($teacher->photo) }}" alt="{{ $teacher->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);"></div>
                @else
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, {{ $teacherSettings['card']['primary_color'] }}30, {{ $teacherSettings['card']['primary_color'] }}50); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-tie" style="font-size: 100px; color: {{ $teacherSettings['card']['primary_color'] }}60;"></i>
                    </div>
                @endif
                
                {{-- Name Overlay --}}
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 25px; color: #fff;">
                    <h3 style="font-size: 24px; font-weight: 900; margin: 0 0 5px 0; text-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                        {{ $teacher->name }}
                    </h3>
                    @if($teacher->title)
                        <p style="margin: 0; font-size: 14px; font-weight: 600; opacity: 0.95;">
                            {{ $teacher->title }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- Content --}}
            <div style="padding: 25px; flex: 1; display: flex; flex-direction: column;">
                @if($teacher->bio)
                    <p style="color: #64748b; font-size: 14px; line-height: 1.7; margin: 0 0 20px 0;">
                        {{ Str::limit($teacher->bio, 120) }}
                    </p>
                @endif

                {{-- Contact Info - Always show, disabled if no value --}}
                @php
                    $isBlue = strpos($teacher->gradient, '#1a246a') !== false;
                    $iconColor = $isBlue ? '#3b82f6' : '#f59e0b';
                    $iconBg = $isBlue ? '#eff6ff' : '#fefce8';
                @endphp
                <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                        {{-- Email --}}
                        <div style="display: flex; align-items: center; gap: 8px; {{ !$teacher->email ? 'opacity: 0.4;' : '' }}">
                            <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: {{ $teacher->email ? $iconBg : '#f1f5f9' }}; border-radius: 50%;">
                                <i class="fas fa-envelope" style="color: {{ $teacher->email ? $iconColor : '#cbd5e1' }};"></i>
                            </span>
                        </div>
                        {{-- Phone --}}
                        <div style="display: flex; align-items: center; gap: 8px; {{ !$teacher->phone ? 'opacity: 0.4;' : '' }}">
                            <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: {{ $teacher->phone ? $iconBg : '#f1f5f9' }}; border-radius: 50%;">
                                <i class="fas fa-phone" style="color: {{ $teacher->phone ? $iconColor : '#cbd5e1' }};"></i>
                            </span>
                        </div>
                        {{-- LinkedIn --}}
                        <div style="display: flex; align-items: center; gap: 8px; {{ !$teacher->linkedin ? 'opacity: 0.4;' : '' }}">
                            <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: {{ $teacher->linkedin ? $iconBg : '#f1f5f9' }}; border-radius: 50%;">
                                <i class="fab fa-linkedin" style="color: {{ $teacher->linkedin ? $iconColor : '#cbd5e1' }};"></i>
                            </span>
                        </div>
                        {{-- Google Scholar --}}
                        <div style="display: flex; align-items: center; gap: 8px; {{ !$teacher->google_scholar ? 'opacity: 0.4;' : '' }}">
                            <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: {{ $teacher->google_scholar ? $iconBg : '#f1f5f9' }}; border-radius: 50%;">
                                <i class="fas fa-graduation-cap" style="color: {{ $teacher->google_scholar ? $iconColor : '#cbd5e1' }};"></i>
                            </span>
                        </div>
                    </div>
                </div>

                {{-- View Profile Button --}}
                <a href="{{ route('teachers.show', $teacher->id) }}" style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 20px; padding: 14px 24px; background: linear-gradient(135deg, {{ $teacherSettings['card']['primary_color'] }}, {{ $teacherSettings['card']['primary_color'] }}dd); color: #fff; text-decoration: none; border-radius: 10px; font-size: 15px; font-weight: 700; transition: all 0.3s; box-shadow: 0 4px 15px {{ $teacherSettings['card']['primary_color'] }}40;" onmouseover="this.style.boxShadow='0 6px 25px {{ $teacherSettings['card']['primary_color'] }}60';" onmouseout="this.style.boxShadow='0 4px 15px {{ $teacherSettings['card']['primary_color'] }}40';">
                    Lihat Profil
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </article>
    @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 80px 20px;">
            <i class="fas fa-user-slash" style="font-size: 64px; color: #cbd5e1; margin-bottom: 20px;"></i>
            <p style="color: #64748b; font-size: 18px;">Belum ada data pengajar</p>
        </div>
    @endforelse
</div>
