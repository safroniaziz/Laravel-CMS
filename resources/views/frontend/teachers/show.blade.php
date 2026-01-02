@extends('layouts.frontend')

@section('content')
<style>
    .teacher-gradient-text {
        background: {{ $teacher->gradient ?? 'linear-gradient(135deg, #1a246a, #2d3a8c)' }};
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .contact-link {
        transition: all 0.2s ease;
    }
    .contact-link:hover {
        background-color: #f8fafc;
        transform: translateX(5px);
    }
    
    .expertise-tag {
        transition: all 0.2s ease;
    }
    .expertise-tag:hover {
        transform: scale(1.05);
    }

    /* Custom Scrollbar for bio if needed */
    .bio-content::-webkit-scrollbar {
        width: 6px;
    }
    .bio-content::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    .bio-content::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
</style>

<div style="background: #ffffff; min-height: 100vh; position: relative; overflow-x: hidden;">
    
    {{-- Decorative Background Elements --}}
    <div style="position: absolute; top: -10%; right: -5%; width: 600px; height: 600px; background: {{ $teacher->gradient ?? 'linear-gradient(135deg, #1a246a, #2d3a8c)' }}; opacity: 0.03; border-radius: 50%; blur: 80px; filter: blur(80px); z-index: 0; pointer-events: none;"></div>
    <div style="position: absolute; bottom: 10%; left: -10%; width: 500px; height: 500px; background: {{ $teacher->gradient ?? 'linear-gradient(135deg, #1a246a, #2d3a8c)' }}; opacity: 0.04; border-radius: 50%; blur: 60px; filter: blur(60px); z-index: 0; pointer-events: none;"></div>

    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 40px 24px; position: relative; z-index: 1;">
        
        {{-- Breadcrumb --}}
        <nav style="margin-bottom: 50px;">
            <a href="{{ route('teachers.index') }}" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: #64748b; font-weight: 500; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='#1a246a'" onmouseout="this.style.color='#64748b'">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Dosen
            </a>
        </nav>

        <div class="row" style="display: flex; flex-wrap: wrap; margin: -15px;">
            
            {{-- Left Column: Sticky Profile Card (35%) --}}
            <div class="col-lg-4" style="flex: 0 0 35%; max-width: 35%; padding: 15px; min-width: 320px;">
                <div style="position: sticky; top: 40px;">
                    <div style="background: #fff; border-radius: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.04); overflow: hidden;">
                        
                        {{-- Photo --}}
                        <div style="padding: 24px; text-align: center; background: linear-gradient(to bottom, #f8fafc 50%, #fff 50%);">
                            <div style="position: relative; display: inline-block;">
                                @if($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" style="width: 200px; height: 200px; object-fit: cover; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                                @else
                                    <div style="width: 200px; height: 200px; background: {{ $teacher->gradient ?? 'linear-gradient(135deg, #1a246a, #2d3a8c)' }}; border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                                        <i class="fas {{ $teacher->icon ?? 'fa-user-tie' }}" style="font-size: 80px; color: rgba(255,255,255,0.8);"></i>
                                    </div>
                                @endif

                                @if($teacher->role === 'kaprodi')
                                <div style="position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); background: #1a246a; color: #fff; padding: 6px 16px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; white-space: nowrap; box-shadow: 0 4px 10px rgba(0,0,0,0.2); border: 2px solid #fff;">
                                    Kaprodi
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Quick Actions / Contact --}}
                        <div style="padding: 30px 24px;">
                            <h5 style="font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 20px;">Connect</h5>
                            
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                {{-- Email --}}
                                <div class="contact-link" style="padding: 12px; border-radius: 12px; border: 1px solid {{ $teacher->email ? '#e2e8f0' : '#f1f5f9' }}; display: flex; align-items: center; gap: 12px; color: {{ $teacher->email ? '#334155' : '#cbd5e1' }};">
                                    <div style="width: 36px; height: 36px; background: {{ $teacher->email ? '#eff6ff' : '#f1f5f9' }}; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: {{ $teacher->email ? '#3b82f6' : '#cbd5e1' }};">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div style="flex: 1; overflow: hidden;">
                                        <div style="font-size: 11px; text-transform: uppercase; color: #94a3b8; font-weight: 600;">Email</div>
                                        @if($teacher->email)
                                            <a href="mailto:{{ $teacher->email }}" style="font-size: 13px; font-weight: 500; color: #1e293b; text-decoration: none; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">
                                                {{ $teacher->email }}
                                            </a>
                                        @else
                                            <span style="font-size: 13px; color: #cbd5e1;">-</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- LinkedIn --}}
                                <div class="contact-link" style="padding: 12px; border-radius: 12px; border: 1px solid {{ $teacher->linkedin ? '#e2e8f0' : '#f1f5f9' }}; display: flex; align-items: center; gap: 12px; color: {{ $teacher->linkedin ? '#334155' : '#cbd5e1' }};">
                                    <div style="width: 36px; height: 36px; background: {{ $teacher->linkedin ? '#f0f9ff' : '#f1f5f9' }}; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: {{ $teacher->linkedin ? '#0077b5' : '#cbd5e1' }};">
                                        <i class="fab fa-linkedin-in"></i>
                                    </div>
                                    <div style="flex: 1;">
                                        <div style="font-size: 11px; text-transform: uppercase; color: #94a3b8; font-weight: 600;">LinkedIn</div>
                                        @if($teacher->linkedin)
                                            <a href="{{ $teacher->linkedin }}" target="_blank" style="font-size: 13px; font-weight: 500; color: #1e293b; text-decoration: none;">View Profile</a>
                                        @else
                                            <span style="font-size: 13px; color: #cbd5e1;">-</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Google Scholar --}}
                                <div class="contact-link" style="padding: 12px; border-radius: 12px; border: 1px solid {{ $teacher->google_scholar ? '#e2e8f0' : '#f1f5f9' }}; display: flex; align-items: center; gap: 12px; color: {{ $teacher->google_scholar ? '#334155' : '#cbd5e1' }};">
                                    <div style="width: 36px; height: 36px; background: {{ $teacher->google_scholar ? '#fefce8' : '#f1f5f9' }}; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: {{ $teacher->google_scholar ? '#f59e0b' : '#cbd5e1' }};">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div style="flex: 1;">
                                        <div style="font-size: 11px; text-transform: uppercase; color: #94a3b8; font-weight: 600;">Scholar</div>
                                        @if($teacher->google_scholar)
                                            <a href="{{ $teacher->google_scholar }}" target="_blank" style="font-size: 13px; font-weight: 500; color: #1e293b; text-decoration: none;">Publications</a>
                                        @else
                                            <span style="font-size: 13px; color: #cbd5e1;">-</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div class="contact-link" style="padding: 12px; border-radius: 12px; border: 1px solid {{ $teacher->phone ? '#e2e8f0' : '#f1f5f9' }}; display: flex; align-items: center; gap: 12px; color: {{ $teacher->phone ? '#334155' : '#cbd5e1' }};">
                                    <div style="width: 36px; height: 36px; background: {{ $teacher->phone ? '#f0fdf4' : '#f1f5f9' }}; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: {{ $teacher->phone ? '#166534' : '#cbd5e1' }};">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div style="flex: 1;">
                                        <div style="font-size: 11px; text-transform: uppercase; color: #94a3b8; font-weight: 600;">Phone</div>
                                        @if($teacher->phone)
                                            <a href="tel:{{ $teacher->phone }}" style="font-size: 13px; font-weight: 500; color: #1e293b; text-decoration: none;">{{ $teacher->phone }}</a>
                                        @else
                                            <span style="font-size: 13px; color: #cbd5e1;">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Content (65%) --}}
            <div class="col-lg-8" style="flex: 1; min-width: 320px; padding: 15px;">
                <div style="padding-left: 20px;">
                    
                    {{-- Header --}}
                    <div style="margin-bottom: 50px;">
                        <h1 class="teacher-gradient-text" style="font-size: 48px; font-weight: 900; line-height: 1.1; margin-bottom: 12px; letter-spacing: -1px;">
                            {{ $teacher->name }}
                        </h1>
                        @if($teacher->title)
                            <p style="font-size: 20px; color: #64748b; font-weight: 400; margin: 0; max-width: 80%;">
                                {{ $teacher->title }}
                            </p>
                        @endif
                    </div>

                    {{-- Stats --}}
                    @if(($teacher->publications ?? 0) > 0 || ($teacher->projects ?? 0) > 0)
                    <div style="display: flex; gap: 24px; margin-bottom: 50px;">
                        @if(($teacher->publications ?? 0) > 0)
                        <div class="stat-card" style="flex: 1; background: #fff; padding: 24px; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 20px;">
                            <div style="width: 56px; height: 56px; background: #eff6ff; border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #2563eb; font-size: 24px;">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div>
                                <div style="font-size: 32px; font-weight: 800; color: #0f172a; line-height: 1;">{{ $teacher->publications }}</div>
                                <div style="font-size: 14px; color: #64748b; font-weight: 500; margin-top: 4px;">Publikasi Ilmiah</div>
                            </div>
                        </div>
                        @endif

                        @if(($teacher->projects ?? 0) > 0)
                        <div class="stat-card" style="flex: 1; background: #fff; padding: 24px; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 20px;">
                            <div style="width: 56px; height: 56px; background: #fefce8; border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ca8a04; font-size: 24px;">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <div>
                                <div style="font-size: 32px; font-weight: 800; color: #0f172a; line-height: 1;">{{ $teacher->projects }}</div>
                                <div style="font-size: 14px; color: #64748b; font-weight: 500; margin-top: 4px;">Proyek Riset</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    {{-- Biography --}}
                    <div style="margin-bottom: 50px;">
                        <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                            <span style="width: 6px; height: 24px; background: {{ $teacher->gradient ?? '#1a246a' }}; border-radius: 4px; display: inline-block;"></span>
                            Tentang Saya
                        </h3>
                        <div class="bio-content" style="font-size: 17px; line-height: 1.8; color: #334155; text-align: justify; font-weight: 400;">
                            @if($teacher->bio)
                                {!! nl2br(e($teacher->bio)) !!}
                            @else
                                <p style="color: #94a3b8; font-style: italic;">Belum ada biografi yang ditambahkan.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Expertise --}}
                    @if($teacher->expertise && count($teacher->expertise) > 0)
                    <div>
                        <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                            <span style="width: 6px; height: 24px; background: {{ $teacher->gradient ?? '#1a246a' }}; border-radius: 4px; display: inline-block;"></span>
                            Bidang Keahlian
                        </h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                            @foreach($teacher->expertise as $skill)
                            <span class="expertise-tag" style="padding: 10px 20px; background: #fff; border: 1px solid #e2e8f0; color: #475569; border-radius: 50px; font-size: 14px; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.02); display: inline-flex; align-items: center; gap: 8px;">
                                <i class="fas fa-check-circle" style="color: #10b981; font-size: 12px;"></i>
                                {{ $skill }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 991px) {
        .col-lg-4, .col-lg-8 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
        }
        .col-lg-4 > div {
            position: static !important;
            margin-bottom: 40px;
        }
        .row {
            margin: 0 !important;
        }
        h1.teacher-gradient-text {
            font-size: 36px !important;
        }
        .stat-card {
            padding: 16px !important;
        }
        .stat-card > div:first-child {
            width: 48px !important;
            height: 48px !important;
            font-size: 20px !important;
        }
        .stat-card > div:last-child > div:first-child {
            font-size: 24px !important;
        }
    }
</style>
@endsection
