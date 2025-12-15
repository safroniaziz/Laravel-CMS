@php
    // Fetch posts from 'akademik' category
    try {
        $academicPosts = App\Models\Post::where('status', 'published')
            ->whereHas('category', function($q) {
                $q->where('slug', 'akademik');
            })
            ->latest('published_at')
            ->take(5)
            ->get();

        // Fetch academic section header from settings
        $academicHeader = [
            'badge_text' => App\Models\Setting::where('key', 'academic_section_badge_text')->value('value') ?? 'INFORMASI AKADEMIK',
            'icon' => App\Models\Setting::where('key', 'academic_section_icon')->value('value') ?? '',
            'title' => App\Models\Setting::where('key', 'academic_section_title')->value('value') ?? 'Kegiatan & Program Akademik',
            'subtitle' => App\Models\Setting::where('key', 'academic_section_subtitle')->value('value') ?? 'Informasi terkini seputar kegiatan akademik, program mahasiswa, dan pencapaian yang membanggakan Program Studi Sistem Informasi',
        ];

        // Fetch academic section colors from settings
        $academicColors = [
            'primary' => App\Models\Setting::where('key', 'academic_section_primary_color')->value('value') ?? App\Models\Setting::where('key', 'theme_primary_color')->value('value') ?? '#1a246a',
            'accent' => App\Models\Setting::where('key', 'academic_section_accent_color')->value('value') ?? App\Models\Setting::where('key', 'theme_accent_color')->value('value') ?? '#f59e0b',
            'bg_start' => App\Models\Setting::where('key', 'academic_section_bg_start')->value('value') ?? App\Models\Setting::where('key', 'theme_bg_light')->value('value') ?? '#f8fafc',
            'bg_end' => App\Models\Setting::where('key', 'academic_section_bg_end')->value('value') ?? App\Models\Setting::where('key', 'theme_bg_white')->value('value') ?? '#ffffff',
        ];

        // Fetch academic layout style from settings
        $academicLayoutStyle = App\Models\Setting::where('key', 'academic_layout_style')->value('value') ?? 'featured_stack';
    } catch (\Exception $e) {
        $academicPosts = collect();
        $academicHeader = [
            'badge_text' => 'INFORMASI AKADEMIK',
            'icon' => '',
            'title' => 'Kegiatan & Program Akademik',
            'subtitle' => 'Informasi terkini seputar kegiatan akademik, program mahasiswa, dan pencapaian yang membanggakan Program Studi Sistem Informasi',
        ];
        $academicColors = [
            'primary' => '#1a246a',
            'accent' => '#f59e0b',
            'bg_start' => '#f8fafc',
            'bg_end' => '#ffffff',
        ];
        $academicLayoutStyle = 'featured_stack';
    }

    // Enhanced metadata for dummy data (will be replaced with real DB fields later)
    $academicMetadata = [
        ['location' => 'Online - Zoom Meeting', 'status' => 'open', 'tags' => ['Machine Learning', 'Workshop'], 'participants' => 124, 'cta' => 'register'],
        ['location' => 'Gedung A - Ruang 301', 'status' => 'ongoing', 'tags' => ['Web Development', 'Seminar'], 'participants' => 89, 'cta' => 'detail'],
        ['location' => 'Online - Google Meet', 'status' => 'completed', 'tags' => ['Data Science', 'Kuliah Tamu'], 'participants' => 156, 'cta' => 'download'],
        ['location' => 'Gedung B - Auditorium', 'status' => 'open', 'tags' => ['AI & Robotics', 'Competition'], 'participants' => 45, 'cta' => 'register'],
        ['location' => 'Online - Teams', 'status' => 'completed', 'tags' => ['Cloud Computing', 'Workshop'], 'participants' => 78, 'cta' => 'download'],
    ];
@endphp

<!-- Informasi Akademik Section - Enhanced with Featured Layout -->
<section style="padding: 90px 0; background: linear-gradient(to bottom, {{ $academicColors['bg_start'] }} 0%, {{ $academicColors['bg_end'] }} 100%); position: relative;">
    <!-- Subtle Background Pattern -->
    <div style="position: absolute; inset: 0; background-image: radial-gradient(circle at 1px 1px, rgba(26, 36, 106, 0.03) 1px, transparent 1px); background-size: 40px 40px; opacity: 0.5;"></div>

    <div class="container" style="position: relative; z-index: 1;">
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 60px;" data-aos="fade-up">
            <div style="display: inline-flex; align-items: center; gap: 10px; padding: 10px 24px; background: #fff; border: 2px solid {{ $academicColors['primary'] }}; border-radius: 30px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(26, 36, 106, 0.08);">
                <div style="width: 8px; height: 8px; background: {{ $academicColors['primary'] }}; border-radius: 50%;"></div>
                <span style="font-size: 12px; font-weight: 700; color: {{ $academicColors['primary'] }}; letter-spacing: 1.5px;">{{ $academicHeader['badge_text'] }}</span>
                @if($academicHeader['icon'])
                    <i class="fas {{ $academicHeader['icon'] }}" style="color: {{ $academicColors['primary'] }}; font-size: 14px;"></i>
                @endif
            </div>

            <h2 style="font-size: 46px; font-weight: 800; color: {{ $academicColors['primary'] }}; margin: 0 0 18px 0; line-height: 1.2;" data-aos="fade-up" data-aos-delay="100">
                {{ $academicHeader['title'] }}
            </h2>
            <p style="font-size: 17px; color: #64748b; max-width: 650px; margin: 0 auto; line-height: 1.7;" data-aos="fade-up" data-aos-delay="200">
                {{ $academicHeader['subtitle'] }}
            </p>
        </div>

        @if($academicPosts->count() > 0)
            @if($academicLayoutStyle === 'featured_stack')
            {{-- LAYOUT 1: Featured + Stack (Current Design) --}}
            <!-- Latest + Vertical Stack Layout (1 Large Left + 4 Stacked Right) -->
            <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 28px; margin-bottom: 50px;" data-aos="fade-up" data-aos-delay="300">

                <!-- LEFT: Latest Post (Large) -->
                @php
                    $featuredPost = $academicPosts->first();
                    $featuredMeta = $academicMetadata[0];
                @endphp
                <div onclick="window.location='{{ route('blog.show', $featuredPost->slug) }}'"
                     style="background: #fff; border-radius: 20px; overflow: hidden; cursor: pointer; transition: all 0.3s ease; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.06);"
                     onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 16px 50px rgba(26, 36, 106, 0.15)'; this.style.borderColor='#1a246a';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)'; this.style.borderColor='#e2e8f0';">

                    <!-- Terbaru Badge -->
                    <div style="position: absolute; top: 20px; left: 20px; z-index: 10; padding: 8px 18px; background: #1a246a; border-radius: 8px; box-shadow: 0 4px 15px rgba(26,36,106,0.25);">
                        <span style="font-size: 11px; font-weight: 700; color: #fff; letter-spacing: 0.5px;">📅 TERBARU</span>
                    </div>

                    <!-- Image -->
                    @if($featuredPost->featured_image)
                        <div style="position: relative; height: 320px; overflow: hidden; background: #e8eaf6;">
                            <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @else
                        <div style="position: relative; height: 320px; background: linear-gradient(135deg, #e8eaf6, #c5cae9); display: flex; align-items: center; justify-content: center;">
                            <div style="text-align: center;">
                                <div style="width: 100px; height: 100px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 8px 30px rgba(26,36,106,0.2); border: 4px solid rgba(26,36,106,0.1);">
                                    <i class="fas fa-book-open" style="font-size: 42px; color: #1a246a;"></i>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Content -->
                    <div style="padding: 28px;">
                        <!-- Rich Metadata -->
                        <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 18px;">
                            <!-- Status Badge -->
                            @php
                                $statusColors = [
                                    'open' => ['bg' => '#dcfce7', 'text' => '#166534', 'icon' => '🟢'],
                                    'ongoing' => ['bg' => '#dbeafe', 'text' => '#1e40af', 'icon' => '🔵'],
                                    'completed' => ['bg' => '#f1f5f9', 'text' => '#64748b', 'icon' => '⚪'],
                                ];
                                $status = $statusColors[$featuredMeta['status']];
                            @endphp
                            <div style="padding: 6px 14px; background: {{ $status['bg'] }}; border-radius: 20px; display: flex; align-items: center; gap: 6px;">
                                <span style="font-size: 10px;">{{ $status['icon'] }}</span>
                                <span style="font-size: 11px; font-weight: 700; color: {{ $status['text'] }};">
                                    {{ $featuredMeta['status'] == 'open' ? 'Pendaftaran Dibuka' : ($featuredMeta['status'] == 'ongoing' ? 'Berlangsung' : 'Selesai') }}
                                </span>
                            </div>

                            <!-- Location Badge -->
                            <div style="padding: 6px 14px; background: #fef3c7; border-radius: 20px; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-map-marker-alt" style="font-size: 10px; color: #92400e;"></i>
                                <span style="font-size: 11px; font-weight: 600; color: #92400e;">{{ $featuredMeta['location'] }}</span>
                            </div>
                        </div>

                        <!-- Date & Participants -->
                        <div style="display: flex; align-items: center; gap: 18px; margin-bottom: 16px;">
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <i class="far fa-calendar" style="color: #1a246a; font-size: 13px;"></i>
                                <span style="font-size: 13px; color: #64748b; font-weight: 500;">{{ $featuredPost->published_at->format('d M Y') }}</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-users" style="color: #1a246a; font-size: 13px;"></i>
                                <span style="font-size: 13px; color: #64748b; font-weight: 500;">{{ $featuredMeta['participants'] }} Peserta</span>
                            </div>
                        </div>

                        <!-- Title -->
                        <h3 style="font-size: 24px; font-weight: 800; color: #1e293b; margin: 0 0 14px 0; line-height: 1.3;">
                            {{ $featuredPost->title }}
                        </h3>

                        <!-- Excerpt -->
                        <p style="color: #64748b; line-height: 1.7; margin: 0 0 18px 0; font-size: 14px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $featuredPost->excerpt ?? (isset($featuredPost->content) ? Str::limit(strip_tags($featuredPost->content), 180) : 'Baca informasi lengkap mengenai kegiatan akademik ini...') }}
                        </p>

                        <!-- Tags -->
                        <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 22px;">
                            @foreach($featuredMeta['tags'] as $tag)
                                <span style="padding: 6px 12px; background: #e8eaf6; color: #1a246a; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>

                        <!-- CTA Button -->
                        @php
                            $ctaConfig = [
                                'register' => ['text' => 'Daftar Sekarang', 'bg' => '#10b981', 'icon' => 'fa-arrow-right'],
                                'detail' => ['text' => 'Lihat Detail', 'bg' => '#1a246a', 'icon' => 'fa-info-circle'],
                                'download' => ['text' => 'Unduh Materi', 'bg' => '#f59e0b', 'icon' => 'fa-download'],
                            ];
                            $cta = $ctaConfig[$featuredMeta['cta']];
                        @endphp
                        <div style="display: inline-flex; align-items: center; gap: 10px; padding: 13px 26px; background: {{ $cta['bg'] }}; color: #fff; border-radius: 10px; font-weight: 700; font-size: 14px; box-shadow: 0 4px 16px {{ $cta['bg'] }}40; transition: all 0.2s ease;"
                             onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px {{ $cta['bg'] }}60';"
                             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px {{ $cta['bg'] }}40';">
                            <span>{{ $cta['text'] }}</span>
                            <i class="fas {{ $cta['icon'] }}" style="font-size: 12px;"></i>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Vertical Stack of 4 Cards (Single Column) -->
                <div style="display: flex; flex-direction: column; gap: 18px;">
                    @foreach($academicPosts->slice(1, 4) as $index => $post)
                        @php $meta = $academicMetadata[($index + 1) % count($academicMetadata)]; @endphp

                        <div onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                             style="background: #fff; border-radius: 14px; overflow: hidden; cursor: pointer; transition: all 0.3s ease; border: 1px solid #e2e8f0; box-shadow: 0 2px 10px rgba(0,0,0,0.04); display: flex; gap: 16px;"
                             onmouseover="this.style.transform='translateX(6px)'; this.style.boxShadow='0 8px 30px rgba(26, 36, 106, 0.12)'; this.style.borderColor='#1a246a';"
                             onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.04)'; this.style.borderColor='#e2e8f0';">

                            <!-- Left: Image/Icon Area (Fixed Width) -->
                            @if($post->featured_image)
                                <div style="position: relative; width: 140px; min-width: 140px; height: 140px; overflow: hidden; background: #e8eaf6;">
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                    <!-- Status Badge on Image -->
                                    @php $status = $statusColors[$meta['status']]; @endphp
                                    <div style="position: absolute; top: 8px; left: 8px; padding: 4px 10px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 12px;">
                                        <span style="font-size: 9px; font-weight: 700; color: {{ $status['text'] }};">{{ $status['icon'] }} {{ $meta['status'] == 'open' ? 'DIBUKA' : ($meta['status'] == 'ongoing' ? 'LIVE' : 'SELESAI') }}</span>
                                    </div>
                                </div>
                            @else
                                <div style="position: relative; width: 140px; min-width: 140px; height: 140px; background: linear-gradient(135deg, #e8eaf6, #c5cae9); display: flex; align-items: center; justify-content: center;">
                                    <div style="width: 50px; height: 50px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 16px rgba(26,36,106,0.15); border: 3px solid rgba(26,36,106,0.1);">
                                        <i class="fas fa-graduation-cap" style="font-size: 20px; color: #1a246a;"></i>
                                    </div>
                                </div>
                            @endif

                            <!-- Right: Content Area (Flexible Width) -->
                            <div style="flex: 1; padding: 16px 16px 16px 0; display: flex; flex-direction: column; justify-content: space-between;">
                                <!-- Top: Meta & Title -->
                                <div>
                                    <!-- Meta Row -->
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                                        <div style="display: flex; align-items: center; gap: 4px;">
                                            <i class="far fa-calendar" style="color: #1a246a; font-size: 10px;"></i>
                                            <span style="font-size: 11px; color: #64748b; font-weight: 500;">{{ $post->published_at->format('d M Y') }}</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 4px;">
                                            <i class="fas fa-users" style="color: #1a246a; font-size: 10px;"></i>
                                            <span style="font-size: 11px; color: #64748b; font-weight: 500;">{{ $meta['participants'] }} Peserta</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 4px;">
                                            <i class="fas fa-map-marker-alt" style="font-size: 9px; color: #f59e0b;"></i>
                                            <span style="font-size: 11px; color: #64748b;">{{ Str::limit($meta['location'], 20) }}</span>
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <h3 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $post->title }}
                                    </h3>

                                    <!-- Tags -->
                                    <div style="display: flex; flex-wrap: wrap; gap: 5px;">
                                        @foreach(array_slice($meta['tags'], 0, 2) as $tag)
                                            <span style="padding: 3px 8px; background: #e8eaf6; color: #1a246a; border-radius: 8px; font-size: 9px; font-weight: 600;">
                                                #{{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Bottom: CTA Button -->
                                <div style="margin-top: 10px;">
                                    @php $cta = $ctaConfig[$meta['cta']]; @endphp
                                    <div style="display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; background: {{ $cta['bg'] }}; color: #fff; border-radius: 7px; font-weight: 600; font-size: 11px; box-shadow: 0 2px 8px {{ $cta['bg'] }}30; transition: all 0.2s ease;"
                                         onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 14px {{ $cta['bg'] }}50';"
                                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px {{ $cta['bg'] }}30';">
                                        <span>{{ $cta['text'] }}</span>
                                        <i class="fas {{ $cta['icon'] }}" style="font-size: 9px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @elseif($academicLayoutStyle === 'timeline')
            {{-- LAYOUT 2: Timeline Akademis --}}
            <div style="max-width: 900px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="300">
                <div style="position: relative; padding-left: 40px;">
                    <!-- Timeline Line -->
                    <div style="position: absolute; left: 15px; top: 0; bottom: 0; width: 2px; background: linear-gradient(to bottom, {{ $academicColors['primary'] }}, {{ $academicColors['accent'] }});"></div>

                    @foreach($academicPosts as $index => $post)
                        @php $meta = $academicMetadata[$index % count($academicMetadata)]; @endphp
                        <div onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                             style="position: relative; margin-bottom: 40px; background: #fff; border-radius: 16px; padding: 24px; border-left: 4px solid {{ $academicColors['primary'] }}; box-shadow: 0 4px 20px rgba(0,0,0,0.08); cursor: pointer; transition: all 0.3s ease;"
                             onmouseover="this.style.transform='translateX(8px)'; this.style.boxShadow='0 8px 30px rgba(26, 36, 106, 0.15)';"
                             onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.08)';">

                            <!-- Timeline Dot -->
                            <div style="position: absolute; left: -48px; top: 24px; width: 16px; height: 16px; background: {{ $academicColors['primary'] }}; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 0 0 3px {{ $academicColors['accent'] }}40;"></div>

                            <!-- Date Badge -->
                            <div style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; background: {{ $academicColors['primary'] }}; color: #fff; border-radius: 20px; margin-bottom: 16px; font-size: 12px; font-weight: 700;">
                                <i class="far fa-calendar-alt"></i>
                                <span>{{ $post->published_at->format('d M Y') }}</span>
                            </div>

                            <!-- Title -->
                            <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 12px 0; line-height: 1.3;">
                                {{ $post->title }}
                            </h3>

                            <!-- Meta Info -->
                            <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 16px; font-size: 13px; color: #64748b;">
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <i class="fas fa-map-marker-alt" style="color: {{ $academicColors['accent'] }};"></i>
                                    <span>{{ $meta['location'] }}</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <i class="fas fa-users" style="color: {{ $academicColors['accent'] }};"></i>
                                    <span>{{ $meta['participants'] }} Peserta</span>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                @foreach($meta['tags'] as $tag)
                                    <span style="padding: 4px 12px; background: #e8eaf6; color: {{ $academicColors['primary'] }}; border-radius: 12px; font-size: 11px; font-weight: 600;">
                                        #{{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @elseif($academicLayoutStyle === 'agenda')
            {{-- LAYOUT 3: Agenda View --}}
            <div style="max-width: 1000px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="300">
                <div style="display: grid; gap: 20px;">
                    @foreach($academicPosts as $index => $post)
                        @php $meta = $academicMetadata[$index % count($academicMetadata)]; @endphp
                        <div onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                             style="background: #fff; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04); cursor: pointer; transition: all 0.3s ease; display: grid; grid-template-columns: 120px 1fr auto; gap: 24px; align-items: center;"
                             onmouseover="this.style.borderColor='{{ $academicColors['primary'] }}'; this.style.boxShadow='0 4px 16px rgba(26, 36, 106, 0.12)';"
                             onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)';">

                            <!-- Date Column -->
                            <div style="text-align: center; padding: 16px; background: linear-gradient(135deg, {{ $academicColors['primary'] }}, {{ $academicColors['accent'] }}); border-radius: 12px; color: #fff;">
                                <div style="font-size: 32px; font-weight: 800; line-height: 1;">{{ $post->published_at->format('d') }}</div>
                                <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; margin-top: 4px;">{{ $post->published_at->format('M Y') }}</div>
                            </div>

                            <!-- Content Column -->
                            <div>
                                <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0; line-height: 1.3;">
                                    {{ $post->title }}
                                </h3>
                                <div style="display: flex; flex-wrap: wrap; gap: 12px; font-size: 13px; color: #64748b; margin-bottom: 12px;">
                                    <div style="display: flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-map-marker-alt" style="color: {{ $academicColors['accent'] }};"></i>
                                        <span>{{ $meta['location'] }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-users" style="color: {{ $academicColors['accent'] }};"></i>
                                        <span>{{ $meta['participants'] }} Peserta</span>
                                    </div>
                                </div>
                                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                    @foreach($meta['tags'] as $tag)
                                        <span style="padding: 4px 10px; background: #e8eaf6; color: {{ $academicColors['primary'] }}; border-radius: 8px; font-size: 11px; font-weight: 600;">
                                            #{{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Action Column -->
                            <div>
                                @php $cta = $ctaConfig[$meta['cta']]; @endphp
                                <div style="padding: 10px 20px; background: {{ $cta['bg'] }}; color: #fff; border-radius: 8px; font-weight: 600; font-size: 13px; text-align: center; white-space: nowrap;">
                                    {{ $cta['text'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @elseif($academicLayoutStyle === 'schedule')
            {{-- LAYOUT 4: Schedule View --}}
            <div style="max-width: 1100px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="300">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
                    @foreach($academicPosts as $index => $post)
                        @php $meta = $academicMetadata[$index % count($academicMetadata)]; @endphp
                        <div onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                             style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(0,0,0,0.06); cursor: pointer; transition: all 0.3s ease;"
                             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(26, 36, 106, 0.15)';"
                             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.06)';">

                            <!-- Header with Date -->
                            <div style="background: linear-gradient(135deg, {{ $academicColors['primary'] }}, {{ $academicColors['accent'] }}); padding: 20px; color: #fff;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <div style="font-size: 14px; font-weight: 600; opacity: 0.9;">{{ $post->published_at->format('l') }}</div>
                                    <div style="font-size: 12px; opacity: 0.8;">{{ $post->published_at->format('H:i') }}</div>
                                </div>
                                <div style="font-size: 24px; font-weight: 800;">{{ $post->published_at->format('d') }}</div>
                                <div style="font-size: 12px; opacity: 0.9; margin-top: 4px;">{{ $post->published_at->format('F Y') }}</div>
                            </div>

                            <!-- Content -->
                            <div style="padding: 20px;">
                                <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 16px 0; line-height: 1.3;">
                                    {{ $post->title }}
                                </h3>

                                <!-- Schedule Info -->
                                <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px;">
                                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #64748b;">
                                        <i class="fas fa-map-marker-alt" style="color: {{ $academicColors['accent'] }}; width: 16px;"></i>
                                        <span>{{ $meta['location'] }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #64748b;">
                                        <i class="fas fa-users" style="color: {{ $academicColors['accent'] }}; width: 16px;"></i>
                                        <span>{{ $meta['participants'] }} Peserta</span>
                                    </div>
                                </div>

                                <!-- Tags -->
                                <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px;">
                                    @foreach($meta['tags'] as $tag)
                                        <span style="padding: 4px 10px; background: #e8eaf6; color: {{ $academicColors['primary'] }}; border-radius: 8px; font-size: 11px; font-weight: 600;">
                                            #{{ $tag }}
                                        </span>
                                    @endforeach
                                </div>

                                <!-- CTA -->
                                @php $cta = $ctaConfig[$meta['cta']]; @endphp
                                <div style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; background: {{ $cta['bg'] }}; color: #fff; border-radius: 8px; font-weight: 600; font-size: 12px; width: 100%; justify-content: center;">
                                    <span>{{ $cta['text'] }}</span>
                                    <i class="fas {{ $cta['icon'] }}" style="font-size: 11px;"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- View All Button -->
            <div style="text-align: center; margin-top: 50px;" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('blog.index') }}?category=akademik"
                   style="display: inline-flex; align-items: center; gap: 12px; padding: 16px 36px; background: {{ $academicColors['primary'] }}; color: #fff; text-decoration: none; font-weight: 600; font-size: 15px; border-radius: 8px; box-shadow: 0 4px 16px rgba(26, 36, 106, 0.2); transition: all 0.3s ease; border: 2px solid {{ $academicColors['primary'] }};"
                   onmouseover="this.style.background='#151945'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 24px rgba(26, 36, 106, 0.3)';"
                   onmouseout="this.style.background='{{ $academicColors['primary'] }}'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(26, 36, 106, 0.2)';">
                    <span>Lihat Semua Kegiatan Akademik</span>
                    <i class="fas fa-arrow-right" style="font-size: 13px;"></i>
                </a>
            </div>
        @else
            <!-- Empty State -->
            <div style="text-align: center; padding: 80px 40px; background: #fff; border-radius: 16px; border: 2px dashed #cbd5e1;" data-aos="fade-up">
                <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #e8eaf6, #c5cae9); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 28px;">
                    <i class="fas fa-graduation-cap" style="font-size: 42px; color: #1a246a;"></i>
                </div>
                <h3 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0 0 12px 0;">
                    Belum Ada Informasi Akademik
                </h3>
                <p style="color: #64748b; font-size: 15px; margin: 0; max-width: 400px; margin: 0 auto; line-height: 1.6;">
                    Informasi kegiatan akademik, program mahasiswa, dan pencapaian akan ditampilkan di sini
                </p>
            </div>
        @endif
    </div>
</section>

@php
    // Fetch dosen layout style from settings
    try {
        $dosenLayoutStyle = App\Models\Setting::where('key', 'dosen_layout_style')->value('value') ?? 'slider';

        // Fetch dosen section header from settings
        $dosenHeader = [
            'badge_text' => App\Models\Setting::where('key', 'dosen_section_badge_text')->value('value') ?? 'TIM PENGAJAR',
            'icon' => App\Models\Setting::where('key', 'dosen_section_icon')->value('value') ?? 'fa-chalkboard-teacher',
            'title' => App\Models\Setting::where('key', 'dosen_section_title')->value('value') ?? 'Dosen',
            'title_highlight' => App\Models\Setting::where('key', 'dosen_section_title_highlight')->value('value') ?? 'Sistem Informasi',
            'subtitle' => App\Models\Setting::where('key', 'dosen_section_subtitle')->value('value') ?? 'Tim pengajar profesional berpengalaman dengan keahlian di bidang teknologi informasi, sistem bisnis, dan transformasi digital',
        ];
    } catch (\Exception $e) {
        $dosenLayoutStyle = 'slider'; // fallback to current design
        $dosenHeader = [
            'badge_text' => 'TIM PENGAJAR',
            'icon' => 'fa-chalkboard-teacher',
            'title' => 'Dosen',
            'title_highlight' => 'Sistem Informasi',
            'subtitle' => 'Tim pengajar profesional berpengalaman dengan keahlian di bidang teknologi informasi, sistem bisnis, dan transformasi digital',
        ];
    }

    // Dummy dosen data for stats and featured layouts
    $dosenData = [
        [
            'name' => 'Dr. Yudi Setiawan, S.T., M.Eng.',
            'role' => 'kaprodi',
            'title' => 'Kepala Program Studi Sistem Informasi',
            'expertise' => ['Software Engineering', 'AI'],
            'stats' => ['publications' => 45, 'students' => 28, 'projects' => 12],
            'gradient' => 'linear-gradient(135deg, #1a246a, #151945)',
            'icon' => 'fa-user-tie',
            'badge_color' => '#fbbf24'
        ],
        [
            'name' => 'Niska Ramadhani, M.Kom.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Data Science', 'Machine Learning'],
            'stats' => ['publications' => 32, 'students' => 19, 'projects' => 8],
            'gradient' => 'linear-gradient(135deg, #f59e0b, #d97706)',
            'icon' => 'fa-user-graduate',
            'badge_color' => null
        ],
        [
            'name' => 'Aan Erlanshari, S.T., M.Eng.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Network Security', 'Cloud Computing'],
            'stats' => ['publications' => 28, 'students' => 15, 'projects' => 10],
            'gradient' => 'linear-gradient(135deg, #1d4ed8, #151945)',
            'icon' => 'fa-user-cog',
            'badge_color' => null
        ],
        [
            'name' => 'Soni Ayi Purnama, M.Kom.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Database', 'Business Intelligence'],
            'stats' => ['publications' => 24, 'students' => 22, 'projects' => 6],
            'gradient' => 'linear-gradient(135deg, #059669, #047857)',
            'icon' => 'fa-user-check',
            'badge_color' => null
        ],
        [
            'name' => 'Yusran Panca Putra, M.Kom.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Web Development', 'UI/UX'],
            'stats' => ['publications' => 20, 'students' => 18, 'projects' => 14],
            'gradient' => 'linear-gradient(135deg, #ef4444, #dc2626)',
            'icon' => 'fa-user-edit',
            'badge_color' => null
        ],
        [
            'name' => 'Julia Purnama Sari, S.T., M.Kom.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Cyber Security', 'Blockchain'],
            'stats' => ['publications' => 18, 'students' => 12, 'projects' => 9],
            'gradient' => 'linear-gradient(135deg, #8b5cf6, #7c3aed)',
            'icon' => 'fa-user-shield',
            'badge_color' => null
        ],
        [
            'name' => 'Ahmad Taufik, S.Kom., M.T.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Mobile Development', 'IoT'],
            'stats' => ['publications' => 16, 'students' => 14, 'projects' => 11],
            'gradient' => 'linear-gradient(135deg, #06b6d4, #0891b2)',
            'icon' => 'fa-user-code',
            'badge_color' => null
        ],
        [
            'name' => 'Rina Wati, S.Kom., M.Kom.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Data Mining', 'Big Data'],
            'stats' => ['publications' => 22, 'students' => 16, 'projects' => 7],
            'gradient' => 'linear-gradient(135deg, #f97316, #ea580c)',
            'icon' => 'fa-user-tie',
            'badge_color' => null
        ],
    ];
@endphp

<!-- Dosen Sistem Informasi Section - Dynamic Layout -->
<section style="padding: 100px 0; background: linear-gradient(to bottom, #f0f4ff 0%, #fafbff 100%); position: relative; overflow: hidden;">
    <!-- Subtle Background Patterns -->
    <div style="position: absolute; top: 0; right: 0; width: 600px; height: 600px; background: radial-gradient(circle, rgba(26, 36, 106, 0.02) 1px, transparent 1px); background-size: 50px 50px; transform: rotate(15deg);"></div>
    <div style="position: absolute; bottom: 0; left: 0; width: 500px; height: 500px; background: radial-gradient(circle, rgba(26, 36, 106, 0.015) 1px, transparent 1px); background-size: 40px 40px; transform: rotate(-15deg);"></div>

    <!-- Geometric Shapes - Very Subtle -->
    <div style="position: absolute; top: 10%; right: 8%; width: 120px; height: 120px; border: 1px solid rgba(26, 36, 106, 0.06); border-radius: 50%; transform: rotate(45deg);"></div>
    <div style="position: absolute; bottom: 15%; left: 5%; width: 80px; height: 80px; border: 1px solid rgba(26, 36, 106, 0.05); transform: rotate(30deg);"></div>
    <div style="position: absolute; top: 40%; left: 3%; width: 60px; height: 60px; background: linear-gradient(135deg, rgba(251,191,36,0.08), transparent); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: 25%; right: 10%; width: 100px; height: 100px; background: linear-gradient(135deg, rgba(26,36,106,0.04), transparent); clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <!-- Section Header - Clean & Professional -->
        <div style="text-align: center; margin-bottom: 70px;" data-aos="fade-up">
            <!-- Professional Badge -->
            <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: #fff; border-radius: 50px; margin-bottom: 24px; border: 2px solid #1a246a; box-shadow: 0 4px 20px rgba(26, 36, 106, 0.08);">
                <div style="width: 8px; height: 8px; background: #1a246a; border-radius: 50%;"></div>
                <span style="font-size: 12px; font-weight: 700; color: #1a246a; letter-spacing: 1.5px;">{{ $dosenHeader['badge_text'] }}</span>
                <i class="fas {{ $dosenHeader['icon'] }}" style="color: #1a246a; font-size: 14px;"></i>
            </div>

            <h2 style="font-size: 48px; font-weight: 800; color: #1a246a; margin: 0 0 18px 0; line-height: 1.2;" data-aos="fade-up" data-aos-delay="100">
                {{ $dosenHeader['title'] }} <span style="color: #f59e0b;">{{ $dosenHeader['title_highlight'] }}</span>
            </h2>

            <p style="font-size: 17px; color: #64748b; max-width: 700px; margin: 0 auto; line-height: 1.7;" data-aos="fade-up" data-aos-delay="200">
                {{ $dosenHeader['subtitle'] }}
            </p>

            <!-- Decorative Line -->
            <div style="margin-top: 28px; display: flex; align-items: center; justify-content: center; gap: 16px;" data-aos="fade-up" data-aos-delay="300">
                <div style="width: 80px; height: 2px; background: linear-gradient(to right, transparent, rgba(26,36,106,0.2), transparent);"></div>
                <div style="width: 10px; height: 10px; background: #1a246a; border-radius: 50%;"></div>
                <div style="width: 80px; height: 2px; background: linear-gradient(to right, transparent, rgba(26,36,106,0.2), transparent);"></div>
            </div>
        </div>

        @if($dosenLayoutStyle === 'slider')
        {{-- LAYOUT 1: Current Slider Design (4-column grid with navigation) --}}
        <!-- Dosen Slider - Keep existing layout -->
        <div style="position: relative; margin: 0 -20px;" data-aos="fade-up" data-aos-delay="100">
            <div class="dosen-slider-container" style="overflow: hidden; border-radius: 16px;">
                <div class="dosen-slides" style="display: flex; transition: transform 0.6s ease;">
                    <!-- Slide 1 -->
                    <div class="dosen-slide" style="min-width: 100%; display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; padding: 0 20px;">

                        <!-- Dosen 1 - Clean Card -->
                        <div class="dosen-card-clean" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <!-- Photo Area -->
                            <div style="position: relative; height: 280px; background: linear-gradient(135deg, #1a246a, #151945);">
                                <!-- Special badge for Kaprodi -->
                                <div style="position: absolute; top: 16px; left: 16px; background: #fbbf24; color: #78350f; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2;">
                                    Kaprodi
                                </div>

                                <!-- Professional icon -->
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                                        <i class="fas fa-user-tie" style="font-size: 32px; color: #fff;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div style="padding: 24px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                    <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                                    <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                                </div>

                                <h3 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3; color: #1e293b;">
                                    Dr. Yudi Setiawan, S.T., M.Eng.
                                </h3>

                                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.5;">
                                    Kepala Program Studi Sistem Informasi
                                </p>

                                <div style="padding: 12px 16px; background: #f8fafc; border-radius: 8px; margin-bottom: 20px;">
                                    <p style="font-size: 13px; color: #1a246a; font-weight: 600; margin: 0;">
                                        Software Engineering, AI
                                    </p>
                                </div>

                                <!-- Contact Links -->
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-linkedin"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div style="flex: 1;"></div>
                                    <div style="padding: 8px 16px; background: #1a246a; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" class="profile-btn">
                                        Profil
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dosen 2 - Clean Card -->
                        <div class="dosen-card-clean" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <!-- Photo Area -->
                            <div style="position: relative; height: 280px; background: linear-gradient(135deg, #f59e0b, #d97706);">
                                <!-- Professional icon -->
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                                        <i class="fas fa-user-graduate" style="font-size: 32px; color: #fff;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div style="padding: 24px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                    <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                                    <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                                </div>

                                <h3 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3; color: #1e293b;">
                                    Niska Ramadhani, M.Kom.
                                </h3>

                                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.5;">
                                    Dosen Sistem Informasi
                                </p>

                                <div style="padding: 12px 16px; background: #fef3c7; border-radius: 8px; margin-bottom: 20px;">
                                    <p style="font-size: 13px; color: #92400e; font-weight: 600; margin: 0;">
                                        Data Science, Machine Learning
                                    </p>
                                </div>

                                <!-- Contact Links -->
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-linkedin"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div style="flex: 1;"></div>
                                    <div style="padding: 8px 16px; background: #f59e0b; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" class="profile-btn">
                                        Profil
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dosen 3 - Clean Card -->
                        <div class="dosen-card-clean" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <!-- Photo Area -->
                            <div style="position: relative; height: 280px; background: linear-gradient(135deg, #1d4ed8, #151945);">
                                <!-- Professional icon -->
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                                        <i class="fas fa-user-cog" style="font-size: 32px; color: #fff;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div style="padding: 24px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                    <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                                    <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                                </div>

                                <h3 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3; color: #1e293b;">
                                    Aan Erlanshari, S.T., M.Eng.
                                </h3>

                                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.5;">
                                    Dosen Sistem Informasi
                                </p>

                                <div style="padding: 12px 16px; background: #dbeafe; border-radius: 8px; margin-bottom: 20px;">
                                    <p style="font-size: 13px; color: #151945; font-weight: 600; margin: 0;">
                                        Network Security, Cloud Computing
                                    </p>
                                </div>

                                <!-- Contact Links -->
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-linkedin"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div style="flex: 1;"></div>
                                    <div style="padding: 8px 16px; background: #1a246a; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" class="profile-btn">
                                        Profil
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dosen 4 - Clean Card -->
                        <div class="dosen-card-clean" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <!-- Photo Area -->
                            <div style="position: relative; height: 280px; background: linear-gradient(135deg, #059669, #047857);">
                                <!-- Professional icon -->
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                                        <i class="fas fa-user-check" style="font-size: 32px; color: #fff;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div style="padding: 24px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                    <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                                    <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                                </div>

                                <h3 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3; color: #1e293b;">
                                    Soni Ayi Purnama, M.Kom.
                                </h3>

                                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.5;">
                                    Dosen Sistem Informasi
                                </p>

                                <div style="padding: 12px 16px; background: #ecfdf5; border-radius: 8px; margin-bottom: 20px;">
                                    <p style="font-size: 13px; color: #047857; font-weight: 600; margin: 0;">
                                        Database, Business Intelligence
                                    </p>
                                </div>

                                <!-- Contact Links -->
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-linkedin"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div style="flex: 1;"></div>
                                    <div style="padding: 8px 16px; background: #10b981; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" class="profile-btn">
                                        Profil
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 - Additional Dosen -->
                    <div class="dosen-slide" style="min-width: 100%; display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; padding: 0 20px;">
                        <!-- Dosen 5 -->
                        <div class="dosen-card-clean" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <!-- Photo Area -->
                            <div style="position: relative; height: 280px; background: linear-gradient(135deg, #ef4444, #dc2626);">
                                <!-- Professional icon -->
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                                        <i class="fas fa-user-edit" style="font-size: 32px; color: #fff;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div style="padding: 24px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                    <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                                    <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                                </div>

                                <h3 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3; color: #1e293b;">
                                    Yusran Panca Putra, M.Kom.
                                </h3>

                                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.5;">
                                    Dosen Sistem Informasi
                                </p>

                                <div style="padding: 12px 16px; background: #fef2f2; border-radius: 8px; margin-bottom: 20px;">
                                    <p style="font-size: 13px; color: #dc2626; font-weight: 600; margin: 0;">
                                        Web Development, UI/UX
                                    </p>
                                </div>

                                <!-- Contact Links -->
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-linkedin"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div style="flex: 1;"></div>
                                    <div style="padding: 8px 16px; background: #ef4444; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" class="profile-btn">
                                        Profil
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dosen 6 -->
                        <div class="dosen-card-clean" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <!-- Photo Area -->
                            <div style="position: relative; height: 280px; background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                                <!-- Professional icon -->
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                                        <i class="fas fa-user-shield" style="font-size: 32px; color: #fff;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div style="padding: 24px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                    <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                                    <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                                </div>

                                <h3 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3; color: #1e293b;">
                                    Julia Purnama Sari, S.T., M.Kom.
                                </h3>

                                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.5;">
                                    Dosen Sistem Informasi
                                </p>

                                <div style="padding: 12px 16px; background: #f3e8ff; border-radius: 8px; margin-bottom: 20px;">
                                    <p style="font-size: 13px; color: #7c3aed; font-weight: 600; margin: 0;">
                                        Cyber Security, Blockchain
                                    </p>
                                </div>

                                <!-- Contact Links -->
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-linkedin"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div style="flex: 1;"></div>
                                    <div style="padding: 8px 16px; background: #8b5cf6; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" class="profile-btn">
                                        Profil
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dosen 7 -->
                        <div class="dosen-card-clean" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <!-- Photo Area -->
                            <div style="position: relative; height: 280px; background: linear-gradient(135deg, #06b6d4, #0891b2);">
                                <!-- Professional icon -->
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                                        <i class="fas fa-user-code" style="font-size: 32px; color: #fff;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div style="padding: 24px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                    <div style="width: 8px; height: 8px; background: #06b6d4; border-radius: 50%;"></div>
                                    <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                                </div>

                                <h3 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3; color: #1e293b;">
                                    Ahmad Taufik, S.Kom., M.T.
                                </h3>

                                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.5;">
                                    Dosen Sistem Informasi
                                </p>

                                <div style="padding: 12px 16px; background: #ecfdf5; border-radius: 8px; margin-bottom: 20px;">
                                    <p style="font-size: 13px; color: #047857; font-weight: 600; margin: 0;">
                                        Web Development, Mobile Programming
                                    </p>
                                </div>

                                <!-- Contact Links -->
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-linkedin"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div style="flex: 1;"></div>
                                    <div style="padding: 8px 16px; background: #06b6d4; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" class="profile-btn">
                                        Profil
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dosen 8 -->
                        <div class="dosen-card-clean" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <!-- Photo Area -->
                            <div style="position: relative; height: 280px; background: linear-gradient(135deg, #f97316, #ea580c);">
                                <!-- Professional icon -->
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                                        <i class="fas fa-user-tie" style="font-size: 32px; color: #fff;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div style="padding: 24px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                    <div style="width: 8px; height: 8px; background: #f97316; border-radius: 50%;"></div>
                                    <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                                </div>

                                <h3 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3; color: #1e293b;">
                                    Rina Wati, S.Kom., M.Kom.
                                </h3>

                                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.5;">
                                    Dosen Sistem Informasi
                                </p>

                                <div style="padding: 12px 16px; background: #ecfdf5; border-radius: 8px; margin-bottom: 20px;">
                                    <p style="font-size: 13px; color: #047857; font-weight: 600; margin: 0;">
                                        Data Mining, Machine Learning
                                    </p>
                                </div>

                                <!-- Contact Links -->
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-linkedin"></i>
                                    </div>
                                    <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 14px; transition: all 0.2s; cursor: pointer;" class="contact-link">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div style="flex: 1;"></div>
                                    <div style="padding: 8px 16px; background: #f97316; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" class="profile-btn">
                                        Profil
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button class="dosen-prev" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border: 2px solid rgba(26, 36, 106, 0.2); border-radius: 50%; color: #1a246a; font-size: 20px; cursor: pointer; transition: all 0.3s; z-index: 10; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="dosen-next" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border: 2px solid rgba(26, 36, 106, 0.2); border-radius: 50%; color: #1a246a; font-size: 20px; cursor: pointer; transition: all 0.3s; z-index: 10; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Navigation Dots -->
            <div class="dosen-dots" style="display: flex; justify-content: center; gap: 12px; margin-top: 40px;">
                <button class="dosen-dot" data-slide="0" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #1a246a; background: #1a246a; cursor: pointer; transition: all 0.3s;"></button>
                <button class="dosen-dot" data-slide="1" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #1a246a; background: transparent; cursor: pointer; transition: all 0.3s;"></button>
            </div>
        </div>
        @endif
        {{-- END: Layout 1 Slider --}}

        @if($dosenLayoutStyle === 'stats_cards')
        {{-- LAYOUT 2: Modern Stats Cards (3-column grid with statistics) --}}
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px;" data-aos="fade-up" data-aos-delay="100">
            @foreach($dosenData as $dosen)
            <div style="background: #fff; border-radius: 20px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 20px rgba(0,0,0,0.06);"
                 onmouseover="this.style.transform='translateY(-12px)'; this.style.boxShadow='0 20px 60px rgba(26, 36, 106, 0.15)'; this.style.borderColor='#1a246a';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)'; this.style.borderColor='#e5e7eb';">

                {{-- Photo Placeholder --}}
                <div style="position: relative; height: 240px; background: {{ $dosen['gradient'] }}; display: flex; align-items: center; justify-content: center;">
                    @if($dosen['badge_color'])
                    <div style="position: absolute; top: 16px; right: 16px; background: {{ $dosen['badge_color'] }}; color: #78350f; padding: 6px 14px; border-radius: 20px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2;">
                        ⭐ Kaprodi
                    </div>
                    @endif
                    <div style="width: 110px; height: 110px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 4px solid rgba(255,255,255,0.3);">
                        <i class="fas {{ $dosen['icon'] }}" style="font-size: 48px; color: #fff;"></i>
                    </div>
                </div>

                {{-- Content --}}
                <div style="padding: 28px 24px;">
                    {{-- Name & Title --}}
                    <h3 style="font-size: 17px; font-weight: 800; margin: 0 0 6px 0; line-height: 1.3; color: #1e293b;">
                        {{ $dosen['name'] }}
                    </h3>
                    <p style="font-size: 13px; color: #64748b; margin: 0 0 20px 0; line-height: 1.4;">
                        {{ $dosen['title'] }}
                    </p>

                    {{-- Stats Boxes --}}
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 20px;">
                        <div style="text-align: center; padding: 12px 8px; background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border-radius: 10px;">
                            <div style="font-size: 20px; font-weight: 800; color: #0369a1; margin-bottom: 4px;">{{ $dosen['stats']['publications'] }}</div>
                            <div style="font-size: 9px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Publikasi</div>
                        </div>
                        <div style="text-align: center; padding: 12px 8px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 10px;">
                            <div style="font-size: 20px; font-weight: 800; color: #92400e; margin-bottom: 4px;">{{ $dosen['stats']['students'] }}</div>
                            <div style="font-size: 9px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Mahasiswa</div>
                        </div>
                        <div style="text-align: center; padding: 12px 8px; background: linear-gradient(135deg, #dcfce7, #bbf7d0); border-radius: 10px;">
                            <div style="font-size: 20px; font-weight: 800; color: #166534; margin-bottom: 4px;">{{ $dosen['stats']['projects'] }}</div>
                            <div style="font-size: 9px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Proyek</div>
                        </div>
                    </div>

                    {{-- Expertise --}}
                    <div style="margin-bottom: 20px;">
                        <div style="font-size: 11px; font-weight: 700; color: #1a246a; margin-bottom: 10px;  text-transform: uppercase; letter-spacing: 0.5px;">Keahlian:</div>
                        @foreach($dosen['expertise'] as $skill)
                        <div style="margin-bottom: 8px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                <span style="font-size: 11px; color: #64748b; font-weight: 600;">{{ $skill }}</span>
                            </div>
                            <div style="width: 100%; height: 6px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                                <div style="width: {{ rand(75, 95) }}%; height: 100%; background: linear-gradient(90deg, #1a246a, #3b53a0); border-radius: 10px;"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Contact Buttons --}}
                    <div style="display: flex; gap: 8px; align-items: center;">
                        <div style="width: 38px; height: 38px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 15px; cursor: pointer; transition: all 0.2s;"
                             onmouseover="this.style.background='#1a246a'; this.style.color='#fff';"
                             onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b';">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div style="width: 38px; height: 38px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 15px; cursor: pointer; transition: all 0.2s;"
                             onmouseover="this.style.background='#0077b5'; this.style.color='#fff';"
                             onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b';">
                            <i class="fab fa-linkedin"></i>
                        </div>
                        <div style="width: 38px; height: 38px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 15px; cursor: pointer; transition: all 0.2s;"
                             onmouseover="this.style.background='#4285f4'; this.style.color='#fff';"
                             onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b';">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div style="flex: 1;"></div>
                        <div style="padding: 10px 18px; background: #1a246a; color: #fff; border-radius: 10px; font-size: 12px; font-weight: 700; cursor: pointer; transition: all 0.3s;"
                             onmouseover="this.style.background='#151945'; this.style.transform='scale(1.05)';"
                             onmouseout="this.style.background='#1a246a'; this.style.transform='scale(1)';">
                            Profil
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($dosenLayoutStyle === 'featured_grid')
        {{-- LAYOUT 3: Featured + Grid Hybrid (Kaprodi featured + compact grid) --}}
        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 30px;" data-aos="fade-up" data-aos-delay="100">

            {{-- LEFT: Featured Kaprodi Card --}}
            @php $kaprodi = $dosenData[0]; @endphp
            <div style="background: #fff; border-radius: 24px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 8px 30px rgba(0,0,0,0.08); transition: all 0.4s ease;"
                 onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 60px rgba(26, 36, 106, 0.18)'; this.style.borderColor='#1a246a';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.08)'; this.style.borderColor='#e2e8f0';">

                {{-- Kaprodi Badge --}}
                <div style="position: absolute; top: 24px; right: 24px; z-index: 10; padding: 10px 20px; background: linear-gradient(135deg, #fbbf24, #f59e0b); border-radius: 12px; box-shadow: 0 6px 20px rgba(251, 191, 36, 0.3);">
                    <span style="font-size: 12px; font-weight: 800; color: #78350f; letter-spacing: 0.5px;">⭐ KAPRODI</span>
                </div>

                {{-- Photo --}}
                <div style="position: relative; height: 360px; background: {{ $kaprodi['gradient'] }}; display: flex; align-items: center; justify-content: center;">
                    <div style="width: 150px; height: 150px; background: rgba(255,255,255,0.2); backdrop-filter: blur(15px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 5px solid rgba(255,255,255,0.3);">
                        <i class="fas {{ $kaprodi['icon'] }}" style="font-size: 64px; color: #fff;"></i>
                    </div>
                </div>

                {{-- Content --}}
                <div style="padding: 36px 32px;">
                    <h3 style="font-size: 22px; font-weight: 800; margin: 0 0 10px 0; line-height: 1.3; color: #1e293b;">
                        {{ $kaprodi['name'] }}
                    </h3>
                    <p style="font-size: 15px; color: #64748b; margin: 0 0 24px 0; line-height: 1.5; font-weight: 500;">
                        {{ $kaprodi['title'] }}
                    </p>

                    {{-- Research Interests --}}
                    <div style="margin-bottom: 24px;">
                        <div style="font-size: 12px; font-weight: 800; color: #1a246a; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">Bidang Keahlian:</div>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            @foreach($kaprodi['expertise'] as $skill)
                            <span style="padding: 8px 16px; background: linear-gradient(135deg, #e8eaf6, #c5cae9); color: #1a246a; border-radius: 20px; font-size: 13px; font-weight: 700; border: 2px solid #1a246a20;">
                                {{ $skill }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 28px;">
                        <div style="text-align: center; padding: 16px 12px; background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border-radius: 14px; border: 2px solid #0369a120;">
                            <div style="font-size: 26px; font-weight: 900; color: #0369a1; margin-bottom: 4px;">{{ $kaprodi['stats']['publications'] }}</div>
                            <div style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Publikasi</div>
                        </div>
                        <div style="text-align: center; padding: 16px 12px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 14px; border: 2px solid #92400e20;">
                            <div style="font-size: 26px; font-weight: 900; color: #92400e; margin-bottom: 4px;">{{ $kaprodi['stats']['students'] }}</div>
                            <div style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Mahasiswa</div>
                        </div>
                        <div style="text-align: center; padding: 16px 12px; background: linear-gradient(135deg, #dcfce7, #bbf7d0); border-radius: 14px; border: 2px solid #16653420;">
                            <div style="font-size: 26px; font-weight: 900; color: #166534; margin-bottom: 4px;">{{ $kaprodi['stats']['projects'] }}</div>
                            <div style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Proyek Riset</div>
                        </div>
                    </div>

                    {{-- Contact --}}
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <div style="width: 46px; height: 46px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 18px; cursor: pointer; transition: all 0.3s;"
                             onmouseover="this.style.background='#1a246a'; this.style.color='#fff'; this.style.transform='scale(1.1)';"
                             onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b'; this.style.transform='scale(1)';">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div style="width: 46px; height: 46px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 18px; cursor: pointer; transition: all 0.3s;"
                             onmouseover="this.style.background='#0077b5'; this.style.color='#fff'; this.style.transform='scale(1.1)';"
                             onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b'; this.style.transform='scale(1)';">
                            <i class="fab fa-linkedin"></i>
                        </div>
                        <div style="width: 46px; height: 46px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 18px; cursor: pointer; transition: all 0.3s;"
                             onmouseover="this.style.background='#4285f4'; this.style.color='#fff'; this.style.transform='scale(1.1)';"
                             onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b'; this.style.transform='scale(1)';">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div style="flex: 1;"></div>
                        <div style="padding: 14px 28px; background: linear-gradient(135deg, #1a246a, #151945); color: #fff; border-radius: 12px; font-size: 14px; font-weight: 800; cursor: pointer; box-shadow: 0 6px 20px rgba(26, 36, 106, 0.3); transition: all 0.3s;"
                             onmouseover="this.style.transform='translateY(-2px) scale(1.05)'; this.style.boxShadow='0 10px 30px rgba(26, 36, 106, 0.4)';"
                             onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 6px 20px rgba(26, 36, 106, 0.3)';">
                            Lihat Profil Lengkap →
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Compact Grid of Other Dosen --}}
            <div style="display: flex; flex-direction: column; gap: 20px;">
                @foreach(array_slice($dosenData, 1, 6) as $dosen)
                <div style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; gap: 20px; transition: all 0.3s ease; cursor: pointer;"
                     onmouseover="this.style.transform='translateX(8px)'; this.style.boxShadow='0 10px 30px rgba(26, 36, 106, 0.12)'; this.style.borderColor='#1a246a';"
                     onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.05)'; this.style.borderColor='#e2e8f0';">

                    {{-- Photo Thumbnail --}}
                    <div style="position: relative; width: 120px; min-width: 120px; height: 120px; background: {{ $dosen['gradient'] }}; display: flex; align-items: center; justify-content: center;">
                        <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid rgba(255,255,255,0.3);">
                            <i class="fas {{ $dosen['icon'] }}" style="font-size: 24px; color: #fff;"></i>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div style="flex: 1; padding: 16px 16px 16px 0; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <h4 style="font-size: 15px; font-weight: 800; margin: 0 0 4px 0; line-height: 1.3; color: #1e293b;">
                                {{ $dosen['name'] }}
                            </h4>
                            <p style="font-size: 12px; color: #64748b; margin: 0 0 10px 0;">
                                {{ $dosen['title'] }}
                            </p>

                            {{-- Expertise Tags --}}
                            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                @foreach($dosen['expertise'] as $skill)
                                <span style="padding: 4px 10px; background: #e8eaf6; color: #1a246a; border-radius: 12px; font-size: 10px; font-weight: 700;">
                                    {{ $skill }}
                                </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Quick Stats --}}
                        <div style="display: flex; gap: 10px; margin-top: 10px;">
                            <div style="flex: 1; text-align: center; padding: 6px; background: #f8fafc; border-radius: 8px;">
                                <div style="font-size: 14px; font-weight: 800; color: #1a246a;">{{ $dosen['stats']['publications'] }}</div>
                                <div style="font-size: 8px; color: #64748b; font-weight: 600;">Publikasi</div>
                            </div>
                            <div style="flex: 1; text-align: center; padding: 6px; background: #f8fafc; border-radius: 8px;">
                                <div style="font-size: 14px; font-weight: 800; color: #1a246a;">{{ $dosen['stats']['students'] }}</div>
                                <div style="font-size: 8px; color: #64748b; font-weight: 600;">Mahasiswa</div>
                            </div>
                            <div style="flex: 1; text-align: center; padding: 6px; background: #f8fafc; border-radius: 8px;">
                                <div style="font-size: 14px; font-weight: 800; color: #1a246a;">{{ $dosen['stats']['projects'] }}</div>
                                <div style="font-size: 8px; color: #64748b; font-weight: 600;">Proyek</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@php
    use App\Models\KenaliInfo;
    use App\Models\KenaliStat;
    use App\Models\KenaliSetting;

    // Fetch layout style
    $kenaliLayoutStyle = KenaliSetting::getValue('layout_style', 'current');

    // Fetch active info sections ordered by order field (max 3 for layout consistency)
    $kenaliInfos = KenaliInfo::active()->take(3)->get();

    // Build tabs array from database (for dual-column layout)
    $kenaliTabs = $kenaliInfos->map(function($info, $index) {
        return [
            'id' => \Illuminate\Support\Str::slug($info->title),
            'title' => $info->title,
            'icon' => $info->icon,
            'content' => $info->description,
            'color' => $info->color
        ];
    })->toArray();

    // Fetch active stats ordered by order field (max 4 for layout consistency)
    $kenaliStats = KenaliStat::active()->take(4)->get()->toArray();

    // CTA data from settings
    $kenaliCTA = [
        'text' => KenaliSetting::getValue('cta_text', 'Pelajari Lebih Lanjut'),
        'link' => KenaliSetting::getValue('cta_link', '/about'),
        'icon' => KenaliSetting::getValue('cta_icon', 'fa-arrow-right')
    ];

    // Background gradient colors
    $kenaliBgGradient = [
        'start' => KenaliSetting::getValue('bg_gradient_start', '#1a246a'),
        'end' => KenaliSetting::getValue('bg_gradient_end', '#151945')
    ];

    // CTA gradient colors
    $kenaliCtaGradient = [
        'start' => KenaliSetting::getValue('cta_gradient_start', '#fbbf24'),
        'end' => KenaliSetting::getValue('cta_gradient_end', '#f97316')
    ];

    // Video ID
    $kenaliVideoId = KenaliSetting::getValue('video_id', $homeSettings['youtube_video_id'] ?? 'PrH05mBgdd4');

    // Section Header from settings
    $kenaliHeader = [
        'icon' => KenaliSetting::getValue('section_icon', '🎯'),
        'badge_text' => KenaliSetting::getValue('section_badge_text', 'KENALI LEBIH DEKAT'),
        'title' => KenaliSetting::getValue('section_title', 'SISTEM INFORMASI'),
        'title_highlight' => KenaliSetting::getValue('section_title_highlight', 'UNIB'),
        'subtitle' => KenaliSetting::getValue('section_subtitle', 'Program studi yang mempersiapkan lulusan berkualitas di era digital dengan fokus pada teknologi informasi dan sistem bisnis')
    ];

    // Accent and decoration colors for theming
    $kenaliAccentColor = KenaliSetting::getValue('accent_color', '#fbbf24');
    $kenaliDecorationColor1 = KenaliSetting::getValue('decoration_color_1', 'rgba(251, 191, 36, 0.1)');
    $kenaliDecorationColor2 = KenaliSetting::getValue('decoration_color_2', 'rgba(249, 115, 22, 0.1)');
@endphp

<!-- Kenali Sistem Informasi Section - Dynamic Layout -->
<section style="padding: 80px 0; background: linear-gradient(135deg, {{ $kenaliBgGradient['start'] }} 0%, {{ $kenaliBgGradient['end'] }} 100%); color: #fff; position: relative; overflow: hidden;">
    <!-- Background Decorations -->
    <div style="position: absolute; top: -100px; right: -100px; width: 300px; height: 300px; background: radial-gradient(circle, {{ $kenaliDecorationColor1 }} 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -150px; left: -150px; width: 400px; height: 400px; background: radial-gradient(circle, {{ $kenaliDecorationColor2 }} 0%, transparent 70%); border-radius: 50%;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 60px;" data-aos="fade-up">
            <div style="margin-bottom: 20px;">
                <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 25px; border: 1px solid rgba(255,255,255,0.2);">
                    <div style="font-size: 20px;">{{ $kenaliHeader['icon'] }}</div>
                    <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">{{ $kenaliHeader['badge_text'] }}</span>
                </div>
            </div>
            <h2 style="font-size: 48px; font-weight: 900; margin: 0 0 20px 0; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                {{ $kenaliHeader['title'] }} <span style="color: {{ $kenaliAccentColor }};">{{ $kenaliHeader['title_highlight'] }}</span>
            </h2>
            <p style="font-size: 18px; opacity: 0.9; max-width: 700px; margin: 0 auto;">
                {{ $kenaliHeader['subtitle'] }}
            </p>
        </div>

        @if($kenaliLayoutStyle === 'current')
        {{-- LAYOUT 1: Current Design (Video + 3 Cards) --}}
        <!-- Video Section - YouTube -->
        <div style="margin-bottom: 60px; text-align: center;" data-aos="fade-up" data-aos-delay="100">
            <div style="max-width: 800px; margin: 0 auto; background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 30px;">
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 15px;">
                    @if($homeSettings['youtube_video_id'] ?? null)
                        <iframe
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; border-radius: 15px;"
                            src="https://www.youtube.com/embed/{{ $homeSettings['youtube_video_id'] }}"
                            title="Video Profil Program Studi Sistem Informasi UNIB"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    @else
                        <iframe
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; border-radius: 15px;"
                            src="https://www.youtube.com/embed/PrH05mBgdd4"
                            title="Video Profil Program Studi Sistem Informasi UNIB"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    @endif
                </div>
                <div style="margin-top: 20px;">
                    <h3 style="color: #1e293b; font-size: 20px; font-weight: 700; margin: 0 0 8px 0;">
                        Video Profil Program Studi Sistem Informasi
                    </h3>
                    <p style="color: #64748b; font-size: 14px; margin: 0;">
                        Kenali lebih dekat Program Studi Sistem Informasi Universitas Bengkulu
                    </p>
                </div>
            </div>
        </div>

        <!-- Info Cards Grid (Dynamic from Database) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 50px;" data-aos="fade-up" data-aos-delay="100">
            @foreach($kenaliInfos as $info)
            <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 20px; padding: 30px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" class="info-card">
                <div style="width: 60px; height: 60px; background: {{ $info->color }}; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <i class="fas {{ $info->icon }}" style="color: #fff; font-size: 24px;"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 700; margin: 0 0 15px 0;">{{ $info->title }}</h3>
                <p style="opacity: 0.9; line-height: 1.6; margin: 0;">
                    {{ $info->description }}
                </p>
            </div>
            @endforeach
        </div>

        <!-- Stats Banner (4 Metrics - Dynamic from Database) -->
        <div style="margin-bottom: 50px;" data-aos="fade-up" data-aos-delay="200">
            <div style="background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%); backdrop-filter: blur(10px); border-radius: 24px; padding: 40px; border: 1px solid rgba(255,255,255,0.2);">
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;">
                    @foreach($kenaliStats as $stat)
                    <div style="text-align: center;">
                        <i class="fas {{ $stat['icon'] }}" style="color: {{ $kenaliAccentColor }}; font-size: 36px; margin-bottom: 12px; display: block;"></i>
                        <div style="font-size: 42px; font-weight: 900; color: #fff; margin-bottom: 8px;">{{ $stat['number'] }}</div>
                        <div style="font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px;">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- CTA Button -->
        <div style="text-align: center;" data-aos="fade-up" data-aos-delay="300">
            <a href="{{ $kenaliCTA['link'] }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 40px; background: linear-gradient(135deg, {{ $kenaliCtaGradient['start'] }}, {{ $kenaliCtaGradient['end'] }}); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; box-shadow: 0 10px 30px rgba(251, 191, 36, 0.4); transition: all 0.3s;" class="btn-hover">
                <span>{{ $kenaliCTA['text'] }}</span>
                <i class="fas {{ $kenaliCTA['icon'] }}"></i>
            </a>
        </div>
        @endif
        {{-- END: Layout 1 Current --}}

        @if($kenaliLayoutStyle === 'minimalist')
        {{-- LAYOUT 2: Minimalist Focus Layout (Clean & Academic) --}}

        <!-- Video Section - Larger, Premium Frame -->
        <div style="margin-bottom: 50px; text-align: center;" data-aos="fade-up" data-aos-delay="100">
            <div style="max-width: 1000px; margin: 0 auto; background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.2); padding: 40px;">
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 16px; box-shadow: inset 0 4px 20px rgba(0,0,0,0.1);">
                    @if($kenaliVideoId)
                        <iframe
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; border-radius: 16px;"
                            src="https://www.youtube.com/embed/{{ $kenaliVideoId }}"
                            title="Video Profil Program Studi Sistem Informasi UNIB"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    @else
                        <iframe
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; border-radius: 16px;"
                            src="https://www.youtube.com/embed/{{ $kenaliVideoId }}"
                            title="Video Profil Program Studi Sistem Informasi UNIB"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    @endif
                </div>
            </div>
        </div>

        <!-- 3 Core Info - Minimalist Horizontal Cards (Dynamic from Database) -->
        <div style="max-width: 1100px; margin: 0 auto 50px auto;" data-aos="fade-up" data-aos-delay="200">
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                @foreach($kenaliInfos as $info)
                <div style="background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border-radius: 20px; padding: 32px 24px; border: 1px solid rgba(255,255,255,0.15); transition: all 0.4s; text-align: center;"
                     onmouseover="this.style.background='rgba(255,255,255,0.12)'; this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(251,191,36,0.2)';"
                     onmouseout="this.style.background='rgba(255,255,255,0.08)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <!-- Icon -->
                    <div style="width: 64px; height: 64px; margin: 0 auto 20px auto; background: {{ $info->color }}; border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 20px rgba(251,191,36,0.3);">
                        <i class="fas {{ $info->icon }}" style="color: #fff; font-size: 28px;"></i>
                    </div>
                    <!-- Title -->
                    <h4 style="font-size: 18px; font-weight: 800; color: #fff; margin: 0 0 12px 0; letter-spacing: 0.5px;">
                        {{ $info->title }}
                    </h4>
                    <!-- Description -->
                    <p style="font-size: 14px; line-height: 1.6; color: rgba(255,255,255,0.85); margin: 0;">
                        {{ $info->description }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Stats Row (4 Metrics - Minimalist Horizontal - Dynamic from Database) -->
        <div style="text-align: center; margin-bottom: 50px;" data-aos="fade-up" data-aos-delay="300">
            <div style="display: inline-flex; align-items: center; gap: 20px; padding: 24px 40px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 60px; border: 2px solid rgba(255,255,255,0.2); flex-wrap: wrap; justify-content: center;">
                @foreach($kenaliStats as $index => $stat)
                @if($index > 0)
                <div style="width: 2px; height: 40px; background: rgba(255,255,255,0.3);"></div>
                @endif
                <div style="display: flex; align-items: center; gap: 12px; padding: 0 16px;">
                    <i class="fas {{ $stat['icon'] }}" style="color: {{ $kenaliAccentColor }}; font-size: 28px;"></i>
                    <div>
                        <div style="font-size: 24px; font-weight: 900; color: #fff; line-height: 1;">{{ $stat['number'] }}</div>
                        <div style="font-size: 11px; font-weight: 600; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 0.5px;">{{ $stat['label'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Large Single CTA -->
        <div style="text-align: center;" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ $kenaliCTA['link'] }}" style="display: inline-flex; align-items: center; gap: 16px; padding: 24px 60px; background: linear-gradient(135deg, {{ $kenaliCtaGradient['start'] }}, {{ $kenaliCtaGradient['end'] }}); color: #fff; text-decoration: none; border-radius: 60px; font-weight: 800; font-size: 20px; box-shadow: 0 15px 40px rgba(251, 191, 36, 0.5); transition: all 0.4s; text-transform: uppercase; letter-spacing: 1px;"
               onmouseover="this.style.transform='translateY(-4px) scale(1.05)'; this.style.boxShadow='0 20px 50px rgba(251, 191, 36, 0.6)';"
               onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 15px 40px rgba(251, 191, 36, 0.5)';">
                <span>{{ $kenaliCTA['text'] }}</span>
                <i class="fas {{ $kenaliCTA['icon'] }}" style="font-size: 18px;"></i>
            </a>
        </div>
        @endif

        @if($kenaliLayoutStyle === 'dual_column')
        {{-- LAYOUT 3: Dual-Column Interactive (Video + Tabs + Stats) --}}

        <!-- Dual Column Grid -->
        <div style="display: grid; grid-template-columns: 55% 45%; gap: 40px; margin-bottom: 50px;" data-aos="fade-up" data-aos-delay="100">

            <!-- LEFT: Video -->
            <div>
                <div style="background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15); padding: 24px;">
                    <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px;">
                        @if($kenaliVideoId)
                            <iframe
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                src="https://www.youtube.com/embed/{{ $kenaliVideoId }}"
                                title="Video Profil Program Studi Sistem Informasi UNIB"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        @else
                            <iframe
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                src="https://www.youtube.com/embed/{{ $kenaliVideoId }}"
                                title="Video Profil Program Studi Sistem Informasi UNIB"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        @endif
                    </div>
                    <div style="margin-top: 16px; text-align: center;">
                        <h4 style="color: #1e293b; font-size: 16px; font-weight: 700; margin: 0 0 6px 0;">
                            Video Profil Sistem Informasi
                        </h4>
                        <p style="color: #64748b; font-size: 13px; margin: 0;">
                            <i class="fas fa-play-circle" style="color: #fbbf24;"></i> Kenali Lebih Dekat
                        </p>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Tabbed Interface -->
            <div>
                <!-- Tab Navigation -->
                <div style="display: flex; gap: 0; border-bottom: 2px solid rgba(255,255,255,0.2); margin-bottom: 30px;">
                    @foreach($kenaliTabs as $index => $tab)
                    <button class="kenali-tab-btn {{ $index === 0 ? 'active' : '' }}" data-tab="{{ $tab['id'] }}"
                        style="flex: 1; padding: 16px 20px; background: transparent; border: none; color: rgba(255,255,255,0.6); font-weight: 700; font-size: 15px; cursor: pointer; transition: all 0.3s; border-bottom: 3px solid transparent; position: relative;"
                        onclick="switchKenaliTab('{{ $tab['id'] }}')">
                        <i class="fas {{ $tab['icon'] }}" style="margin-right: 8px;"></i>
                        <span>{{ $tab['title'] }}</span>
                    </button>
                    @endforeach
                </div>

                <!-- Tab Content -->
                <div id="kenali-tab-content">
                    @foreach($kenaliTabs as $index => $tab)
                    <div class="kenali-tab-panel {{ $index === 0 ? 'active' : '' }}" data-panel="{{ $tab['id'] }}"
                        style="{{ $index === 0 ? '' : 'display: none;' }}">
                        <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 16px; padding: 30px; border: 1px solid rgba(255,255,255,0.2);">
                            <!-- Icon -->
                            <div style="width: 70px; height: 70px; background: {{ $tab['color'] }}; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.2);">
                                <i class="fas {{ $tab['icon'] }}" style="color: #fff; font-size: 32px;"></i>
                            </div>

                            <!-- Content -->
                            <h3 style="font-size: 24px; font-weight: 800; margin: 0 0 15px 0; color: #fff;">
                                {{ $tab['title'] }}
                            </h3>
                            <p style="opacity: 0.9; line-height: 1.7; margin: 0 0 20px 0; font-size: 16px;">
                                {{ $tab['content'] }}
                            </p>

                            <!-- Inline Stat -->
                            <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 24px; background: rgba(255,255,255,0.15); border-radius: 30px; border: 2px solid {{ $tab['color'] }};">
                                <i class="fas fa-chart-line" style="color: {{ $tab['color'] }}; font-size: 18px;"></i>
                                <span style="font-weight: 800; font-size: 16px; color: #fff;">{{ $tab['stat'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Stats Banner -->
        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 20px; padding: 40px; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);" data-aos="fade-up" data-aos-delay="200">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;">
                @foreach($kenaliStats as $stat)
                <div style="text-align: center;">
                    <i class="fas {{ $stat['icon'] }}" style="color: {{ $kenaliAccentColor }}; font-size: 36px; margin-bottom: 12px;"></i>
                    <div style="font-size: 42px; font-weight: 900; color: #fff; margin-bottom: 8px;">{{ $stat['number'] }}+</div>
                    <div style="font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px;">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Single CTA Button (Consistent) -->
        <div style="text-align: center;" data-aos="fade-up" data-aos-delay="300">
            <a href="{{ $kenaliCTA['link'] }}" style="display: inline-flex; align-items: center; gap: 16px; padding: 20px 50px; background: linear-gradient(135deg, {{ $kenaliCtaGradient['start'] }}, {{ $kenaliCtaGradient['end'] }}); color: #fff; text-decoration: none; border-radius: 60px; font-weight: 800; font-size: 18px; box-shadow: 0 15px 40px rgba(251, 191, 36, 0.5); transition: all 0.4s; text-transform: uppercase; letter-spacing: 1px;"
               onmouseover="this.style.transform='translateY(-4px) scale(1.05)'; this.style.boxShadow='0 20px 50px rgba(251, 191, 36, 0.6)';"
               onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 15px 40px rgba(251, 191, 36, 0.5)';">
                <span>{{ $kenaliCTA['text'] }}</span>
                <i class="fas {{ $kenaliCTA['icon'] }}" style="font-size: 18px;"></i>
            </a>
        </div>

        <script>
        function switchKenaliTab(tabId) {
            // Hide all panels
            document.querySelectorAll('.kenali-tab-panel').forEach(panel => {
                panel.style.display = 'none';
                panel.classList.remove('active');
            });

            // Remove active class from all buttons
            document.querySelectorAll('.kenali-tab-btn').forEach(btn => {
                btn.style.color = 'rgba(255,255,255,0.6)';
                btn.style.borderBottomColor = 'transparent';
                btn.classList.remove('active');
            });

            // Show selected panel
            const selectedPanel = document.querySelector(`[data-panel="${tabId}"]`);
            if (selectedPanel) {
                selectedPanel.style.display = 'block';
                selectedPanel.classList.add('active');
            }

            // Activate selected button
            const selectedBtn = document.querySelector(`[data-tab="${tabId}"]`);
            if (selectedBtn) {
                selectedBtn.style.color = '#fff';
                selectedBtn.style.borderBottomColor = '#fbbf24';
                selectedBtn.classList.add('active');
            }
        }
        </script>
        @endif
    </div>
</section>

@php
    use App\Models\AlumniTestimonial;
    use App\Models\AlumniStat;
    use App\Models\AlumniSetting;

    // Fetch layout style
    $alumniLayoutStyle = AlumniSetting::getValue('layout_style', 'current');

    // Fetch active testimonials (max 10 for layout consistency)
    $alumniTestimonials = AlumniTestimonial::active()->take(10)->get();

    // Fetch active stats (max 6 for layout consistency)
    $alumniStats = AlumniStat::active()->take(6)->get()->toArray();

    // Section Header from settings
    $alumniHeader = [
        'icon' => AlumniSetting::getValue('section_icon', '🎓'),
        'badge_text' => AlumniSetting::getValue('section_badge_text', 'IKATAN ALUMNI'),
        'title' => AlumniSetting::getValue('section_title', 'IKATAN ALUMNI'),
        'title_highlight' => AlumniSetting::getValue('section_title_highlight', 'SISTEM INFORMASI'),
        'subtitle' => AlumniSetting::getValue('section_subtitle', 'Testimoni dari para alumni yang telah sukses berkarir di berbagai bidang')
    ];

    // Background gradient colors
    $alumniBgGradient = [
        'start' => AlumniSetting::getValue('bg_gradient_start', '#f8fafc'),
        'end' => AlumniSetting::getValue('bg_gradient_end', '#ffffff')
    ];

    // Accent colors (orange theme)
    $alumniAccentColor = AlumniSetting::getValue('accent_color', '#ff6b35');
    $alumniAccentGradient = [
        'start' => AlumniSetting::getValue('accent_gradient_start', '#ff6b35'),
        'end' => AlumniSetting::getValue('accent_gradient_end', '#f7931e')
    ];

    // Card styling
    $alumniCardBg = AlumniSetting::getValue('card_bg_color', 'rgba(255,255,255,0.9)');
    $alumniCardBorder = AlumniSetting::getValue('card_border_color', 'rgba(255,107,53,0.08)');

    // Decoration colors
    $alumniDecorationColor1 = AlumniSetting::getValue('decoration_color_1', 'rgba(255, 107, 53, 0.1)');
    $alumniDecorationColor2 = AlumniSetting::getValue('decoration_color_2', 'rgba(26, 36, 106, 0.1)');

    // CTA Button
    $alumniCTA = [
        'text' => AlumniSetting::getValue('cta_text', 'Lihat Semua Alumni'),
        'link' => AlumniSetting::getValue('cta_link', '/alumni')
    ];
@endphp

<!-- Ikatan Alumni ILUSI Section - Dynamic Layout -->
<section style="padding: 80px 0; background: linear-gradient(135deg, {{ $alumniBgGradient['start'] }} 0%, {{ $alumniBgGradient['end'] }} 100%); position: relative; overflow: hidden;">
    <!-- Background Decorations -->
    <div style="position: absolute; top: -100px; right: -100px; width: 300px; height: 300px; background: radial-gradient(circle, {{ $alumniDecorationColor1 }} 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -150px; left: -150px; width: 400px; height: 400px; background: radial-gradient(circle, {{ $alumniDecorationColor2 }} 0%, transparent 70%); border-radius: 50%;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;" data-aos="fade-up">
            <!-- Left Side - Content -->
            <div>
                <div style="margin-bottom: 30px;">
                    <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }} 0%, {{ $alumniAccentGradient['end'] }} 100%); border-radius: 25px; box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3); transform: rotate(-2deg);">
                        <div style="font-size: 20px;">{{ $alumniHeader['icon'] }}</div>
                        <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">{{ $alumniHeader['badge_text'] }}</span>
                    </div>
                </div>

                <h2 style="font-size: 48px; font-weight: 900; color: #1e293b; margin: 0 0 20px 0; line-height: 1.1;">
                    <span style="background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $alumniHeader['title'] }}</span><br>
                    <span style="background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 52px;">{{ $alumniHeader['title_highlight'] }}</span>
                </h2>

                <!-- Alumni Testimonials Scrollable Container -->
                <div style="position: relative; height: 600px;">
                    <!-- Navigation Buttons -->
                    <button id="alumni-scroll-up" style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); z-index: 10; width: 40px; height: 40px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); border: none; border-radius: 50%; color: #fff; font-size: 16px; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-chevron-up"></i>
                    </button>

                    <button id="alumni-scroll-down" style="position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); z-index: 10; width: 40px; height: 40px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); border: none; border-radius: 50%; color: #fff; font-size: 16px; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-chevron-down"></i>
                    </button>

                    <!-- Scrollable Container -->
                    <div id="alumni-scroll-container" style="height: 100%; overflow-y: auto; overflow-x: hidden; border-radius: 20px; padding: 10px;">
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                            @foreach($alumniTestimonials as $index => $alumni)
                            @php
                                // Generate initials from name
                                $nameParts = explode(' ', $alumni->name);
                                $initials = '';
                                foreach($nameParts as $part) {
                                    if(!empty($part)) {
                                        $initials .= strtoupper(substr($part, 0, 1));
                                        if(strlen($initials) >= 2) break;
                                    }
                                }
                            @endphp
                            <div style="background: {{ $alumniCardBg }}; backdrop-filter: blur(10px); border-radius: 20px; padding: 20px; border: 1px solid {{ $alumniCardBorder }}; transition: all 0.3s ease; position: relative; overflow: hidden;" class="alumni-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); border-radius: 15px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 16px;">
                                        {{ $initials }}
                                    </div>
                                    <div style="flex: 1;">
                                        <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0 0 3px 0;">{{ $alumni->name }}</h4>
                                        <p style="font-size: 13px; color: #64748b; margin: 0;">{{ $alumni->position }} at {{ $alumni->company }}</p>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="display: flex; gap: 2px;">
                                            @for($i = 0; $i < $alumni->rating; $i++)
                                            <i class="fas fa-star" style="color: {{ $alumniAccentColor }}; font-size: 10px;"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p style="color: #64748b; font-size: 13px; line-height: 1.5; margin: 12px 0 0 0; font-style: italic;">
                                    "{{ $alumni->testimonial }}"
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Scroll Indicator -->
                    <div style="position: absolute; right: -40px; top: 50%; transform: translateY(-50%); z-index: 10;">
                        <div style="width: 4px; height: 100px; background: rgba(255,107,53,0.2); border-radius: 2px; position: relative;">
                            <div id="scroll-progress" style="position: absolute; top: 0; left: 0; width: 100%; height: 30%; background: linear-gradient(135deg, #ff6b35, #f7931e); border-radius: 2px; transition: height 0.3s ease;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Visual Illustration like Screenshot -->
            <div style="position: relative; text-align: center;" data-aos="fade-left" data-aos-delay="200">
                <!-- Main Illustration Container -->
                <div style="position: relative; display: inline-block;">
                    <!-- Background Circle with Dots Pattern -->
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; height: 400px; background: radial-gradient(circle, rgba(255, 107, 53, 0.1) 0%, transparent 70%); border-radius: 50%; background-image: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.3) 2px, transparent 2px), radial-gradient(circle at 80% 80%, rgba(255,255,255,0.3) 2px, transparent 2px); background-size: 30px 30px;"></div>

                    <!-- Alumni Figures -->
                    <div style="position: relative; z-index: 2;">
                        <!-- Graduate 1 -->
                        <div style="position: absolute; top: 20px; left: 50px; width: 120px; height: 150px; background: linear-gradient(135deg, #1a246a, #151945); border-radius: 60px 60px 20px 20px; transform: rotate(-5deg); box-shadow: 0 10px 30px rgba(26, 36, 106, 0.3);">
                            <!-- Graduation Cap -->
                            <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 15px; background: #1e293b; border-radius: 50px;"></div>
                            <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; background: #1e293b; border-radius: 50%;"></div>
                            <!-- Face -->
                            <div style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: #fbbf24; border-radius: 50%;"></div>
                        </div>

                        <!-- Graduate 2 -->
                        <div style="position: absolute; top: 50px; right: 30px; width: 120px; height: 150px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 60px 60px 20px 20px; transform: rotate(8deg); box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);">
                            <!-- Graduation Cap -->
                            <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 15px; background: #1e293b; border-radius: 50px;"></div>
                            <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; background: #1e293b; border-radius: 50%;"></div>
                            <!-- Face -->
                            <div style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: #fbbf24; border-radius: 50%;"></div>
                        </div>

                        <!-- Graduate 3 -->
                        <div style="position: absolute; bottom: 30px; left: 80px; width: 120px; height: 150px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 60px 60px 20px 20px; transform: rotate(-3deg); box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);">
                            <!-- Graduation Cap -->
                            <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 15px; background: #1e293b; border-radius: 50px;"></div>
                            <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; background: #1e293b; border-radius: 50%;"></div>
                            <!-- Face -->
                            <div style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: #fbbf24; border-radius: 50%;"></div>
                        </div>
                    </div>

                    <!-- Bottom Text Banner -->
                    <div style="position: absolute; bottom: -50px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #ff6b35, #f7931e); padding: 15px 40px; border-radius: 25px; box-shadow: 0 10px 30px rgba(255, 107, 53, 0.4); transform: translateX(-50%) rotate(-2deg);">
                    <a href="{{ $alumniCTA['link'] }}" style="text-decoration: none;">
                        <div style="position: absolute; bottom: -50px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); padding: 15px 40px; border-radius: 25px; box-shadow: 0 10px 30px rgba(255, 107, 53, 0.4); transform: translateX(-50%) rotate(-2deg);">
                            <h3 style="color: #fff; font-size: 24px; font-weight: 900; margin: 0; text-transform: uppercase; letter-spacing: 1px; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                                {{ $alumniHeader['title'] }}<br>
                                <span style="font-size: 20px;">{{ $alumniHeader['title_highlight'] }}</span>
                            </h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Banner PMB - Clean -->
<section style="padding: 80px 0; background: #ffffff;">
    <div class="container" data-aos="fade-up">
        <div style="background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 16px; padding: 40px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 16px; background: #f1f5f9; border-radius: 20px; margin-bottom: 16px;">
                    <div style="width: 6px; height: 6px; background: #f59e0b; border-radius: 50%;"></div>
                    <span style="font-size: 12px; font-weight: 600; color: #475569; letter-spacing: 0.5px;">PENERIMAAN MAHASISWA BARU</span>
                </div>
                <h3 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0;">
                    Informasi PMB Tahun {{ date('Y') }}
                </h3>
                <p style="font-size: 16px; color: #64748b; margin: 0;">Program Studi Sistem Informasi Universitas Bengkulu</p>
            </div>
            <a href="{{ route('contact.index') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: #1a246a; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 15px; transition: all 0.2s; border: 1px solid #1a246a;" class="clean-btn">
                <span>Info Selengkapnya</span>
                <i class="fas fa-arrow-right" style="font-size: 12px;"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section - Modern Dynamic Design -->
<section style="padding: 120px 0; background: linear-gradient(135deg, #0f172a 0%, #1a246a 50%, #1a246a 100%); color: #fff; text-align: center; position: relative; overflow: hidden;">
    <!-- Animated Background Elements -->
    <div style="position: absolute; top: -150px; right: -150px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(251, 191, 36, 0.1) 0%, transparent 70%); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
    <div style="position: absolute; bottom: -200px; left: -200px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite reverse;"></div>
    <div style="position: absolute; top: 50%; left: 10%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(147, 51, 234, 0.1) 0%, transparent 70%); border-radius: 50%; animation: float 7s ease-in-out infinite 2s;"></div>

    <div class="container" style="position: relative; z-index: 2;" data-aos="fade-up">
        <!-- Dynamic Badge -->
        <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 25px; margin-bottom: 40px;">
            <div style="width: 12px; height: 12px; background: #fbbf24; border-radius: 50%; animation: pulse 2s ease-in-out infinite;"></div>
            <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">JADILAH BAGIAN DARI REVOLUSI DIGITAL</span>
            <div style="width: 12px; height: 12px; background: #fbbf24; border-radius: 50%; animation: pulse 2s ease-in-out infinite 1s;"></div>
        </div>

        <!-- Main Heading with Gradient Effect -->
        <h2 style="font-size: 56px; font-weight: 900; margin: 0 0 25px 0; line-height: 1.1; position: relative;">
            <span style="background: linear-gradient(135deg, #fff 0%, #fbbf24 50%, #f97316 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                {{ $homeSettings['home_cta_title'] ?? 'Wujudkan Masa Depan Digitalmu' }}
            </span>
            <!-- Animated Underline -->
            <div style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 100px; height: 4px; background: linear-gradient(135deg, #fbbf24, #f97316); border-radius: 2px; animation: expandWidth 2s ease-in-out infinite;"></div>
        </h2>

        <!-- Subtitle with Better Typography -->
        <p style="font-size: 20px; color: rgba(255,255,255,0.9); max-width: 700px; margin: 0 auto 50px auto; line-height: 1.7; font-weight: 400;">
            {{ $homeSettings['home_cta_subtitle'] ?? 'Bergabunglah dengan Program Studi Sistem Informasi dan mulailah perjalananmu menjadi ahli teknologi masa depan' }}
        </p>

        <!-- Enhanced CTA Buttons -->
        <div style="display: flex; gap: 25px; justify-content: center; flex-wrap: wrap; margin-bottom: 60px;">
            <a href="{{ route('contact.index') }}" style="display: inline-flex; align-items: center; gap: 15px; padding: 18px 40px; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); color: #1e293b; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 18px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 10px 30px rgba(251, 191, 36, 0.3); position: relative; overflow: hidden;" class="cta-primary-btn">
                <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(135deg, #f97316 0%, #f59e0b 100%); transition: left 0.3s; z-index: 0;"></div>
                <i class="fas fa-rocket" style="position: relative; z-index: 1; font-size: 20px;"></i>
                <span style="position: relative; z-index: 1;">Mulai Sekarang</span>
            </a>

            <a href="{{ route('page.show', 'about') }}" style="display: inline-flex; align-items: center; gap: 15px; padding: 18px 40px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); color: #fff; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 18px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;" class="cta-secondary-btn">
                <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: rgba(255,255,255,0.2); transition: left 0.3s; z-index: 0;"></div>
                <i class="fas fa-compass" style="position: relative; z-index: 1; font-size: 20px;"></i>
                <span style="position: relative; z-index: 1;">Jelajahi Program</span>
            </a>
        </div>

        <!-- Feature Highlights -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; max-width: 800px; margin: 0 auto;">
            <div style="text-align: center; padding: 25px; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; transition: all 0.3s;">
                <i class="fas fa-graduation-cap" style="font-size: 32px; color: #fbbf24; margin-bottom: 15px;"></i>
                <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 8px 0; color: #fff;">Pendidikan Berkualitas</h4>
                <p style="font-size: 14px; color: rgba(255,255,255,0.8); margin: 0; line-height: 1.5;">Kurikulum modern dan relevan dengan industri</p>
            </div>

            <div style="text-align: center; padding: 25px; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; transition: all 0.3s;">
                <i class="fas fa-laptop-code" style="font-size: 32px; color: #fbbf24; margin-bottom: 15px;"></i>
                <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 8px 0; color: #fff;">Praktik Terbaik</h4>
                <p style="font-size: 14px; color: rgba(255,255,255,0.8); margin: 0; line-height: 1.5;">Pembelajaran berbasis proyek dan kasus nyata</p>
            </div>

            <div style="text-align: center; padding: 25px; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; transition: all 0.3s;">
                <i class="fas fa-briefcase" style="font-size: 32px; color: #fbbf24; margin-bottom: 15px;"></i>
                <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 8px 0; color: #fff;">Karir Cemerlang</h4>
                <p style="font-size: 14px; color: rgba(255,255,255,0.8); margin: 0; line-height: 1.5;">Jaringan alumni dan peluang kerja luas</p>
            </div>
        </div>
    </div>

    <!-- CSS Animations -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.2); }
        }

        @keyframes expandWidth {
            0%, 100% { width: 100px; opacity: 0.8; }
            50% { width: 150px; opacity: 1; }
        }

        .cta-primary-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 20px 40px rgba(251, 191, 36, 0.4);
        }

        .cta-primary-btn:hover div {
            left: 0;
        }

        .cta-secondary-btn:hover {
            transform: translateY(-3px) scale(1.05);
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.4);
        }

        .cta-secondary-btn:hover div {
            left: 0;
        }

        /* Hover effects for feature cards */
        .grid > div:hover {
            transform: translateY(-5px);
            background: rgba(255,255,255,0.1);
            border-color: rgba(251, 191, 36, 0.3);
        }
    </style>
</section>

<!-- Footer -->
<footer style="background: linear-gradient(135deg, #0f172a 0%, #1a246a 40%, #151945 100%); color: #fff; padding: 80px 0 50px; position: relative; overflow: hidden;">
    <!-- Overlay untuk readability -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.6);"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 40px;">

            <!-- Logo Section -->
            <div>
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #1a246a, #151945); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(26, 36, 106, 0.3);">
                        <span style="font-size: 24px; font-weight: 900; color: #fff;">SI</span>
                    </div>
                    <div>
                        <h3 style="font-size: 22px; font-weight: 700; margin: 0; color: #fff; letter-spacing: 1px;">SISTEM INFORMASI</h3>
                        <p style="font-size: 13px; color: #f0f0f0; margin: 3px 0 0 0; font-weight: 400;">UNIVERSITAS BENGKULU</p>
                    </div>
                </div>
                <p style="color: #d0d0d0; font-size: 13px; line-height: 1.7; margin: 0; max-width: 280px;">
                    Leading the future of digital innovation and information systems education in Indonesia.
                </p>
            </div>

            <!-- Quick Links Section -->
            <div>
                <h4 style="font-size: 16px; font-weight: 600; margin: 0 0 20px 0; color: #fff; text-transform: uppercase; letter-spacing: 2px; position: relative;">
                    QUICK LINKS
                    <div style="position: absolute; bottom: -8px; left: 0; width: 30px; height: 3px; background: linear-gradient(135deg, #1a246a, #4c5db5); border-radius: 2px;"></div>
                </h4>
                <ul style="list-style: none; padding: 0; margin: 15px 0 0 0;">
                    <li style="margin-bottom: 12px;">
                        <a href="#" style="color: #d0d0d0; text-decoration: none; transition: all 0.3s; font-size: 14px; display: flex; align-items: center;">
                            <span style="width: 8px; height: 8px; background: linear-gradient(135deg, #1a246a, #151945); border-radius: 50%; margin-right: 12px;"></span>
                            About Us
                        </a>
                    </li>
                    <li style="margin-bottom: 12px;">
                        <a href="#" style="color: #d0d0d0; text-decoration: none; transition: all 0.3s; font-size: 14px; display: flex; align-items: center;">
                            <span style="width: 8px; height: 8px; background: linear-gradient(135deg, #1a246a, #151945); border-radius: 50%; margin-right: 12px;"></span>
                            Academics
                        </a>
                    </li>
                    <li style="margin-bottom: 12px;">
                        <a href="#" style="color: #d0d0d0; text-decoration: none; transition: all 0.3s; font-size: 14px; display: flex; align-items: center;">
                            <span style="width: 8px; height: 8px; background: linear-gradient(135deg, #1a246a, #151945); border-radius: 50%; margin-right: 12px;"></span>
                            Admissions
                        </a>
                    </li>
                    <li style="margin-bottom: 12px;">
                        <a href="#" style="color: #d0d0d0; text-decoration: none; transition: all 0.3s; font-size: 14px; display: flex; align-items: center;">
                            <span style="width: 8px; height: 8px; background: linear-gradient(135deg, #1a246a, #151945); border-radius: 50%; margin-right: 12px;"></span>
                            Faculty
                        </a>
                    </li>
                    <li>
                        <a href="#" style="color: #d0d0d0; text-decoration: none; transition: all 0.3s; font-size: 14px; display: flex; align-items: center;">
                            <span style="width: 8px; height: 8px; background: linear-gradient(135deg, #1a246a, #151945); border-radius: 50%; margin-right: 12px;"></span>
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Section -->
            <div>
                <h4 style="font-size: 16px; font-weight: 600; margin: 0 0 20px 0; color: #fff; text-transform: uppercase; letter-spacing: 2px; position: relative;">
                    CONTACT
                    <div style="position: absolute; bottom: -8px; left: 0; width: 30px; height: 3px; background: linear-gradient(135deg, #1a246a, #4c5db5); border-radius: 2px;"></div>
                </h4>
                <ul style="list-style: none; padding: 0; margin: 15px 0 0 0;">
                    <li style="margin-bottom: 16px; display: flex; align-items: flex-start; gap: 12px;">
                        <i class="fas fa-map-marker-alt" style="color: #4c5db5; font-size: 14px; margin-top: 2px;"></i>
                        <span style="color: #d0d0d0; font-size: 13px; line-height: 1.6;">Jl. W.R. Supratman Kandang Limun Bengkulu 38371</span>
                    </li>
                    <li style="margin-bottom: 16px; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-phone" style="color: #4c5db5; font-size: 14px;"></i>
                        <span style="color: #d0d0d0; font-size: 13px;">(0737) 21118</span>
                    </li>
                    <li style="margin-bottom: 16px; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-envelope" style="color: #4c5db5; font-size: 14px;"></i>
                        <span style="color: #d0d0d0; font-size: 13px;">si@unib.ac.id</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-globe" style="color: #4c5db5; font-size: 14px;"></i>
                        <span style="color: #d0d0d0; font-size: 13px;">si.unib.ac.id</span>
                    </li>
                </ul>
            </div>

            <!-- Subscribe Section -->
            <div>
                <h4 style="font-size: 16px; font-weight: 600; margin: 0 0 20px 0; color: #fff; text-transform: uppercase; letter-spacing: 2px; position: relative;">
                    SUBSCRIBE
                    <div style="position: absolute; bottom: -8px; left: 0; width: 30px; height: 3px; background: linear-gradient(135deg, #1a246a, #4c5db5); border-radius: 2px;"></div>
                </h4>
                <p style="color: #d0d0d0; font-size: 13px; line-height: 1.6; margin: 15px 0 20px 0;">
                    Get the latest updates and news from our Information Systems program
                </p>
                <form style="display: flex; flex-direction: column; gap: 12px;">
                    <input type="email" placeholder="Email address" style="width: 100%; padding: 12px 15px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; color: #fff; font-size: 13px; outline: none; box-sizing: border-box; backdrop-filter: blur(10px);">
                    <button type="submit" style="width: 100%; padding: 12px; background: linear-gradient(135deg, #1a246a, #4c5db5); color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 5px 15px rgba(240, 147, 251, 0.3);">
                        Subscribe Now
                    </button>
                </form>
            </div>

        </div>

        <!-- Social Media Links -->
        <div style="display: flex; justify-content: center; gap: 15px; margin-top: 50px; padding-top: 40px; border-top: 1px solid rgba(255,255,255,0.2);">
            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: all 0.3s; border: 1px solid rgba(255,255,255,0.2);">
                <i class="fab fa-facebook-f" style="font-size: 16px;"></i>
            </a>
            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: all 0.3s; border: 1px solid rgba(255,255,255,0.2);">
                <i class="fab fa-instagram" style="font-size: 16px;"></i>
            </a>
            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: all 0.3s; border: 1px solid rgba(255,255,255,0.2);">
                <i class="fab fa-linkedin-in" style="font-size: 16px;"></i>
            </a>
            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: all 0.3s; border: 1px solid rgba(255,255,255,0.2);">
                <i class="fab fa-youtube" style="font-size: 16px;"></i>
            </a>
        </div>
    </div>
</footer>
