@php
    // Fetch posts from 'akademik' category
    try {
        $academicPosts = App\Models\Post::where('status', 'published')
            ->whereHas('category', function($q) {
                $q->where('slug', 'akademik');
            })
            ->with(['category', 'tags'])
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

    // Build academic metadata from database
    $academicMetadata = $academicPosts->map(function($post) {
        // Get tags from relationship or fallback to empty array
        $tags = $post->tags->pluck('name')->toArray();
        if (empty($tags)) {
            // Fallback: try to get from category name
            $tags = $post->category ? [$post->category->name] : [];
        }

        return [
            'location' => $post->event_location ?? 'Online - Zoom Meeting',
            'status' => $post->event_status ?? 'open',
            'tags' => $tags,
            'participants' => $post->event_participants ?? 0,
            'cta' => $post->event_cta_type ?? 'detail',
        ];
    })->toArray();
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

    // Fetch dosen data from database or use dummy data
    try {
        $teachersFromDb = App\Models\Teacher::active()->ordered()->get();
        if ($teachersFromDb->count() > 0) {
            $dosenData = $teachersFromDb->map(function($teacher) {
                return [
                    'name' => $teacher->name,
                    'role' => $teacher->role,
                    'title' => $teacher->title,
                    'expertise' => $teacher->expertise ?? [],
                    'stats' => ['publications' => $teacher->publications, 'projects' => $teacher->projects],
                    'gradient' => $teacher->gradient,
                    'icon' => $teacher->icon,
                    'badge_color' => $teacher->badge_color,
                    'photo' => $teacher->photo,
                ];
            })->toArray();
        } else {
            // Fallback to dummy data if no teachers in database
            $dosenData = [
        [
            'name' => 'Dr. Yudi Setiawan, S.T., M.Eng.',
            'role' => 'kaprodi',
            'title' => 'Kepala Program Studi Sistem Informasi',
            'expertise' => ['Software Engineering', 'AI'],
            'stats' => ['publications' => 45, 'projects' => 12],
            'gradient' => 'linear-gradient(135deg, #1a246a, #151945)',
            'icon' => 'fa-user-tie',
            'badge_color' => '#fbbf24'
        ],
        [
            'name' => 'Niska Ramadhani, M.Kom.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Data Science', 'Machine Learning'],
            'stats' => ['publications' => 32, 'projects' => 8],
            'gradient' => 'linear-gradient(135deg, #f59e0b, #d97706)',
            'icon' => 'fa-user-graduate',
            'badge_color' => null
        ],
        [
            'name' => 'Aan Erlanshari, S.T., M.Eng.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Network Security', 'Cloud Computing'],
            'stats' => ['publications' => 28, 'projects' => 10],
            'gradient' => 'linear-gradient(135deg, #1d4ed8, #151945)',
            'icon' => 'fa-user-cog',
            'badge_color' => null
        ],
        [
            'name' => 'Soni Ayi Purnama, M.Kom.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Database', 'Business Intelligence'],
            'stats' => ['publications' => 24, 'projects' => 6],
            'gradient' => 'linear-gradient(135deg, #059669, #047857)',
            'icon' => 'fa-user-check',
            'badge_color' => null
        ],
        [
            'name' => 'Yusran Panca Putra, M.Kom.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Web Development', 'UI/UX'],
            'stats' => ['publications' => 20, 'projects' => 14],
            'gradient' => 'linear-gradient(135deg, #ef4444, #dc2626)',
            'icon' => 'fa-user-edit',
            'badge_color' => null
        ],
        [
            'name' => 'Julia Purnama Sari, S.T., M.Kom.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Cyber Security', 'Blockchain'],
            'stats' => ['publications' => 18, 'projects' => 9],
            'gradient' => 'linear-gradient(135deg, #8b5cf6, #7c3aed)',
            'icon' => 'fa-user-shield',
            'badge_color' => null
        ],
        [
            'name' => 'Ahmad Taufik, S.Kom., M.T.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Mobile Development', 'IoT'],
            'stats' => ['publications' => 16, 'projects' => 11],
            'gradient' => 'linear-gradient(135deg, #06b6d4, #0891b2)',
            'icon' => 'fa-user-code',
            'badge_color' => null
        ],
        [
            'name' => 'Rina Wati, S.Kom., M.Kom.',
            'role' => 'dosen',
            'title' => 'Dosen Sistem Informasi',
            'expertise' => ['Data Mining', 'Big Data'],
            'stats' => ['publications' => 22, 'projects' => 7],
            'gradient' => 'linear-gradient(135deg, #f97316, #ea580c)',
            'icon' => 'fa-user-tie',
            'badge_color' => null,
            'photo' => null
        ],
    ];
        }
    } catch (\Exception $e) {
        // Fallback to dummy data on error
        $dosenData = [
            [
                'name' => 'Dr. Yudi Setiawan, S.T., M.Eng.',
                'role' => 'kaprodi',
                'title' => 'Kepala Program Studi Sistem Informasi',
                'expertise' => ['Software Engineering', 'AI'],
                'stats' => ['publications' => 45, 'projects' => 12],
                'gradient' => 'linear-gradient(135deg, #1a246a, #151945)',
                'icon' => 'fa-user-tie',
                'badge_color' => '#fbbf24',
                'photo' => null
            ],
            [
                'name' => 'Niska Ramadhani, M.Kom.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Data Science', 'Machine Learning'],
                'stats' => ['publications' => 32, 'projects' => 8],
                'gradient' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                'icon' => 'fa-user-graduate',
                'badge_color' => null,
                'photo' => null
            ],
            [
                'name' => 'Aan Erlanshari, S.T., M.Eng.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Network Security', 'Cloud Computing'],
                'stats' => ['publications' => 28, 'projects' => 10],
                'gradient' => 'linear-gradient(135deg, #1d4ed8, #151945)',
                'icon' => 'fa-user-cog',
                'badge_color' => null,
                'photo' => null
            ],
            [
                'name' => 'Soni Ayi Purnama, M.Kom.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Database', 'Business Intelligence'],
                'stats' => ['publications' => 24, 'projects' => 6],
                'gradient' => 'linear-gradient(135deg, #059669, #047857)',
                'icon' => 'fa-user-check',
                'badge_color' => null,
                'photo' => null
            ],
            [
                'name' => 'Yusran Panca Putra, M.Kom.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Web Development', 'UI/UX'],
                'stats' => ['publications' => 20, 'projects' => 14],
                'gradient' => 'linear-gradient(135deg, #ef4444, #dc2626)',
                'icon' => 'fa-user-edit',
                'badge_color' => null,
                'photo' => null
            ],
            [
                'name' => 'Julia Purnama Sari, S.T., M.Kom.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Cyber Security', 'Blockchain'],
                'stats' => ['publications' => 18, 'projects' => 9],
                'gradient' => 'linear-gradient(135deg, #8b5cf6, #7c3aed)',
                'icon' => 'fa-user-shield',
                'badge_color' => null,
                'photo' => null
            ],
            [
                'name' => 'Ahmad Taufik, S.Kom., M.T.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Mobile Development', 'IoT'],
                'stats' => ['publications' => 16, 'projects' => 11],
                'gradient' => 'linear-gradient(135deg, #06b6d4, #0891b2)',
                'icon' => 'fa-user-code',
                'badge_color' => null,
                'photo' => null
            ],
            [
                'name' => 'Rina Wati, S.Kom., M.Kom.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Data Mining', 'Big Data'],
                'stats' => ['publications' => 22, 'projects' => 7],
                'gradient' => 'linear-gradient(135deg, #f97316, #ea580c)',
                'icon' => 'fa-user-tie',
                'badge_color' => null,
                'photo' => null
            ],
        ];
    }
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
        <!-- Dosen Slider - Dynamic from database -->
        <div style="position: relative; margin: 0 -20px;" data-aos="fade-up" data-aos-delay="100">
            <div class="dosen-slider-container" style="overflow: hidden; border-radius: 16px;">
                <div class="dosen-slides" style="display: flex; transition: transform 0.6s ease;">
                    @php
                        $dosenChunks = array_chunk($dosenData, 4);
                    @endphp
                    @foreach($dosenChunks as $chunkIndex => $chunk)
                    <!-- Slide {{ $chunkIndex + 1 }} -->
                    <div class="dosen-slide" style="min-width: 100%; display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; padding: 0 20px;">
                        @foreach($chunk as $dosen)
                        <!-- Dosen Card -->
                        <div class="dosen-card-clean" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <!-- Photo Area -->
                            <div style="position: relative; height: 280px; background: {{ $dosen['gradient'] ?? 'linear-gradient(135deg, #1a246a, #151945)' }}; overflow: hidden;">
                                <!-- Special badge for Kaprodi -->
                                @if(isset($dosen['badge_color']) && $dosen['badge_color'])
                                <div style="position: absolute; top: 16px; left: 16px; background: {{ $dosen['badge_color'] }}; color: #78350f; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2;">
                                    Kaprodi
                                </div>
                                @endif

                                @if(isset($dosen['photo']) && $dosen['photo'])
                                    <!-- Photo -->
                                    <img src="{{ asset('storage/' . $dosen['photo']) }}" alt="{{ $dosen['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <!-- Professional icon (fallback) -->
                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                        <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                                            <i class="fas {{ $dosen['icon'] ?? 'fa-user-tie' }}" style="font-size: 32px; color: #fff;"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Content Area -->
                            <div style="padding: 24px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                    <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                                    <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                                </div>

                                <h3 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; line-height: 1.3; color: #1e293b;">
                                    {{ $dosen['name'] }}
                                </h3>

                                <p style="font-size: 14px; color: #64748b; margin: 0 0 16px 0; line-height: 1.5;">
                                    {{ $dosen['title'] }}
                                </p>

                                <div style="padding: 12px 16px; background: #f8fafc; border-radius: 8px; margin-bottom: 20px;">
                                    <p style="font-size: 13px; color: #1a246a; font-weight: 600; margin: 0;">
                                        {{ implode(', ', $dosen['expertise'] ?? []) }}
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
                                    <div style="padding: 8px 16px; background: {{ $dosen['gradient'] ? (strpos($dosen['gradient'], '#1a246a') !== false ? '#1a246a' : '#f59e0b') : '#1a246a' }}; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" class="profile-btn">
                                        Profil
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
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
                @php
                    $totalSlides = count(array_chunk($dosenData, 4));
                @endphp
                @for($i = 0; $i < $totalSlides; $i++)
                <button class="dosen-dot" data-slide="{{ $i }}" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #1a246a; background: {{ $i === 0 ? '#1a246a' : 'transparent' }}; cursor: pointer; transition: all 0.3s;"></button>
                @endfor
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

                {{-- Photo Area --}}
                <div style="position: relative; height: 240px; background: {{ $dosen['gradient'] }}; overflow: hidden;">
                    @if($dosen['badge_color'])
                    <div style="position: absolute; top: 16px; right: 16px; background: {{ $dosen['badge_color'] }}; color: #78350f; padding: 6px 14px; border-radius: 20px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2;">
                        ⭐ Kaprodi
                    </div>
                    @endif
                    @if(isset($dosen['photo']) && $dosen['photo'])
                        <!-- Photo -->
                        <img src="{{ asset('storage/' . $dosen['photo']) }}" alt="{{ $dosen['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <!-- Professional icon (fallback) -->
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 110px; height: 110px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 4px solid rgba(255,255,255,0.3);">
                            <i class="fas {{ $dosen['icon'] }}" style="font-size: 48px; color: #fff;"></i>
                        </div>
                    @endif
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

                    {{-- Status Badge --}}
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 20px;">
                        <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                        <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                    </div>

                    {{-- Expertise --}}
                    <div style="padding: 12px 16px; background: #f8fafc; border-radius: 8px; margin-bottom: 20px;">
                        <p style="font-size: 13px; color: #1a246a; font-weight: 600; margin: 0;">
                            {{ implode(', ', $dosen['expertise'] ?? []) }}
                        </p>
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
                <div style="position: relative; height: 360px; background: {{ $kaprodi['gradient'] }}; overflow: hidden;">
                    @if(isset($kaprodi['photo']) && $kaprodi['photo'])
                        <!-- Photo -->
                        <img src="{{ asset('storage/' . $kaprodi['photo']) }}" alt="{{ $kaprodi['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <!-- Professional icon (fallback) -->
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 150px; height: 150px; background: rgba(255,255,255,0.2); backdrop-filter: blur(15px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 5px solid rgba(255,255,255,0.3);">
                            <i class="fas {{ $kaprodi['icon'] }}" style="font-size: 64px; color: #fff;"></i>
                        </div>
                    @endif
                </div>

                {{-- Content --}}
                <div style="padding: 36px 32px;">
                    <h3 style="font-size: 22px; font-weight: 800; margin: 0 0 10px 0; line-height: 1.3; color: #1e293b;">
                        {{ $kaprodi['name'] }}
                    </h3>
                    <p style="font-size: 15px; color: #64748b; margin: 0 0 24px 0; line-height: 1.5; font-weight: 500;">
                        {{ $kaprodi['title'] }}
                    </p>

                    {{-- Status Badge --}}
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 24px;">
                        <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></div>
                        <span style="font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Aktif Mengajar</span>
                    </div>

                    {{-- Research Interests --}}
                    <div style="margin-bottom: 28px;">
                        <div style="font-size: 12px; font-weight: 800; color: #1a246a; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">Bidang Keahlian:</div>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            @foreach($kaprodi['expertise'] as $skill)
                            <span style="padding: 8px 16px; background: linear-gradient(135deg, #e8eaf6, #c5cae9); color: #1a246a; border-radius: 20px; font-size: 13px; font-weight: 700; border: 2px solid #1a246a20;">
                                {{ $skill }}
                            </span>
                            @endforeach
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
                    <div style="position: relative; width: 120px; min-width: 120px; height: 120px; background: {{ $dosen['gradient'] }}; overflow: hidden;">
                        @if(isset($dosen['photo']) && $dosen['photo'])
                            <!-- Photo -->
                            <img src="{{ asset('storage/' . $dosen['photo']) }}" alt="{{ $dosen['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <!-- Professional icon (fallback) -->
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 60px; height: 60px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid rgba(255,255,255,0.3);">
                                <i class="fas {{ $dosen['icon'] }}" style="font-size: 24px; color: #fff;"></i>
                            </div>
                        @endif
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
                            <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 10px;">
                                @foreach($dosen['expertise'] as $skill)
                                <span style="padding: 4px 10px; background: #e8eaf6; color: #1a246a; border-radius: 12px; font-size: 10px; font-weight: 700;">
                                    {{ $skill }}
                                </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Contact Links --}}
                        <div style="display: flex; gap: 8px; align-items: center; margin-top: 10px;">
                            <div style="width: 32px; height: 32px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 13px; cursor: pointer; transition: all 0.2s;"
                                 onmouseover="this.style.background='#1a246a'; this.style.color='#fff';"
                                 onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b';">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div style="width: 32px; height: 32px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 13px; cursor: pointer; transition: all 0.2s;"
                                 onmouseover="this.style.background='#0077b5'; this.style.color='#fff';"
                                 onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b';">
                                <i class="fab fa-linkedin"></i>
                            </div>
                            <div style="width: 32px; height: 32px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 13px; cursor: pointer; transition: all 0.2s;"
                                 onmouseover="this.style.background='#4285f4'; this.style.color='#fff';"
                                 onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b';">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div style="flex: 1;"></div>
                            <div style="padding: 6px 12px; background: #1a246a; color: #fff; border-radius: 8px; font-size: 11px; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                                 onmouseover="this.style.background='#151945';"
                                 onmouseout="this.style.background='#1a246a';">
                                Profil
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

<!-- Ikatan Alumni Section - Dynamic Layout -->
<section style="padding: 80px 0; background: linear-gradient(135deg, {{ $alumniBgGradient['start'] }} 0%, {{ $alumniBgGradient['end'] }} 100%); position: relative; overflow: hidden;">
    <!-- Background Decorations -->
    <div style="position: absolute; top: -100px; right: -100px; width: 300px; height: 300px; background: radial-gradient(circle, {{ $alumniDecorationColor1 }} 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -150px; left: -150px; width: 400px; height: 400px; background: radial-gradient(circle, {{ $alumniDecorationColor2 }} 0%, transparent 70%); border-radius: 50%;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        @if($alumniLayoutStyle === 'current')
        {{-- LAYOUT 1: Current Split Layout (Testimonials Left + Illustration Right) --}}
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

            <!-- Right Side - Visual Illustration -->
            <div style="position: relative; text-align: center;" data-aos="fade-left" data-aos-delay="200">
                <div style="position: relative; display: inline-block;">
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; height: 400px; background: radial-gradient(circle, rgba(255, 107, 53, 0.1) 0%, transparent 70%); border-radius: 50%; background-image: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.3) 2px, transparent 2px), radial-gradient(circle at 80% 80%, rgba(255,255,255,0.3) 2px, transparent 2px); background-size: 30px 30px;"></div>
                    <div style="position: relative; z-index: 2;">
                        <div style="position: absolute; top: 20px; left: 50px; width: 120px; height: 150px; background: linear-gradient(135deg, #1a246a, #151945); border-radius: 60px 60px 20px 20px; transform: rotate(-5deg); box-shadow: 0 10px 30px rgba(26, 36, 106, 0.3);">
                            <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 15px; background: #1e293b; border-radius: 50px;"></div>
                            <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; background: #1e293b; border-radius: 50%;"></div>
                            <div style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: #fbbf24; border-radius: 50%;"></div>
                        </div>
                        <div style="position: absolute; top: 50px; right: 30px; width: 120px; height: 150px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 60px 60px 20px 20px; transform: rotate(8deg); box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);">
                            <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 15px; background: #1e293b; border-radius: 50px;"></div>
                            <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; background: #1e293b; border-radius: 50%;"></div>
                            <div style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: #fbbf24; border-radius: 50%;"></div>
                        </div>
                        <div style="position: absolute; bottom: 30px; left: 80px; width: 120px; height: 150px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 60px 60px 20px 20px; transform: rotate(-3deg); box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);">
                            <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 15px; background: #1e293b; border-radius: 50px;"></div>
                            <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; background: #1e293b; border-radius: 50%;"></div>
                            <div style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: #fbbf24; border-radius: 50%;"></div>
                        </div>
                    </div>
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

        @elseif($alumniLayoutStyle === 'grid')
        {{-- LAYOUT 2: Grid Cards Layout --}}
        <div data-aos="fade-up">
            <!-- Section Header -->
            <div style="text-align: center; margin-bottom: 60px;">
                <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }} 0%, {{ $alumniAccentGradient['end'] }} 100%); border-radius: 25px; box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3); margin-bottom: 30px;">
                    <div style="font-size: 20px;">{{ $alumniHeader['icon'] }}</div>
                    <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">{{ $alumniHeader['badge_text'] }}</span>
                </div>
                <h2 style="font-size: 48px; font-weight: 900; color: #1e293b; margin: 0 0 20px 0; line-height: 1.1;">
                    <span style="background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $alumniHeader['title'] }}</span>
                    <span style="background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"> {{ $alumniHeader['title_highlight'] }}</span>
                </h2>
                <p style="font-size: 18px; color: #64748b; max-width: 600px; margin: 0 auto;">{{ $alumniHeader['subtitle'] }}</p>
            </div>

            <!-- Grid Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 50px;">
                @foreach($alumniTestimonials as $index => $alumni)
                @php
                    $nameParts = explode(' ', $alumni->name);
                    $initials = '';
                    foreach($nameParts as $part) {
                        if(!empty($part)) {
                            $initials .= strtoupper(substr($part, 0, 1));
                            if(strlen($initials) >= 2) break;
                        }
                    }
                @endphp
                <div style="background: {{ $alumniCardBg }}; backdrop-filter: blur(10px); border-radius: 20px; padding: 30px; border: 1px solid {{ $alumniCardBorder }}; transition: all 0.3s ease; position: relative; overflow: hidden;" class="alumni-card" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 40px rgba(255, 107, 53, 0.2)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); border-radius: 15px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 20px;">
                            {{ $initials }}
                        </div>
                        <div style="flex: 1;">
                            <h4 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 5px 0;">{{ $alumni->name }}</h4>
                            <p style="font-size: 14px; color: #64748b; margin: 0;">{{ $alumni->position }} at {{ $alumni->company }}</p>
                        </div>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <div style="display: flex; gap: 3px;">
                            @for($i = 0; $i < $alumni->rating; $i++)
                            <i class="fas fa-star" style="color: {{ $alumniAccentColor }}; font-size: 14px;"></i>
                            @endfor
                        </div>
                    </div>
                    <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin: 0; font-style: italic;">
                        "{{ $alumni->testimonial }}"
                    </p>
                </div>
                @endforeach
            </div>

            <!-- CTA Button -->
            <div style="text-align: center;">
                <a href="{{ $alumniCTA['link'] }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 32px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); color: #fff; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 16px; transition: all 0.3s; box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 35px rgba(255, 107, 53, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(255, 107, 53, 0.3)';">
                    <span>{{ $alumniCTA['text'] }}</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        @elseif($alumniLayoutStyle === 'carousel')
        {{-- LAYOUT 3: Carousel/Slider Layout --}}
        <div data-aos="fade-up">
            <!-- Section Header -->
            <div style="text-align: center; margin-bottom: 60px;">
                <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }} 0%, {{ $alumniAccentGradient['end'] }} 100%); border-radius: 25px; box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3); margin-bottom: 30px;">
                    <div style="font-size: 20px;">{{ $alumniHeader['icon'] }}</div>
                    <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">{{ $alumniHeader['badge_text'] }}</span>
                </div>
                <h2 style="font-size: 48px; font-weight: 900; color: #1e293b; margin: 0 0 20px 0; line-height: 1.1;">
                    <span style="background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $alumniHeader['title'] }}</span>
                    <span style="background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"> {{ $alumniHeader['title_highlight'] }}</span>
                </h2>
                <p style="font-size: 18px; color: #64748b; max-width: 600px; margin: 0 auto;">{{ $alumniHeader['subtitle'] }}</p>
            </div>

            <!-- Carousel Container -->
            <div style="position: relative; max-width: 900px; margin: 0 auto;">
                <div id="alumni-carousel" style="overflow: hidden; border-radius: 20px;">
                    <div id="alumni-carousel-track" style="display: flex; transition: transform 0.5s ease;">
                        @foreach($alumniTestimonials as $index => $alumni)
                        @php
                            $nameParts = explode(' ', $alumni->name);
                            $initials = '';
                            foreach($nameParts as $part) {
                                if(!empty($part)) {
                                    $initials .= strtoupper(substr($part, 0, 1));
                                    if(strlen($initials) >= 2) break;
                                }
                            }
                        @endphp
                        <div class="alumni-carousel-slide" style="min-width: 100%; padding: 40px; background: {{ $alumniCardBg }}; backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid {{ $alumniCardBorder }};">
                            <div style="text-align: center; margin-bottom: 30px;">
                                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 28px; margin-bottom: 20px;">
                                    {{ $initials }}
                                </div>
                                <h4 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0;">{{ $alumni->name }}</h4>
                                <p style="font-size: 16px; color: #64748b; margin: 0 0 15px 0;">{{ $alumni->position }} at {{ $alumni->company }}</p>
                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 25px;">
                                    @for($i = 0; $i < $alumni->rating; $i++)
                                    <i class="fas fa-star" style="color: {{ $alumniAccentColor }}; font-size: 18px;"></i>
                                    @endfor
                                </div>
                            </div>
                            <p style="color: #64748b; font-size: 18px; line-height: 1.8; margin: 0; font-style: italic; text-align: center;">
                                "{{ $alumni->testimonial }}"
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Carousel Navigation -->
                <button id="alumni-carousel-prev" style="position: absolute; left: -60px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); border: none; border-radius: 50%; color: #fff; font-size: 18px; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3); display: flex; align-items: center; justify-content: center;" onmouseover="this.style.transform='translateY(-50%) scale(1.1)';" onmouseout="this.style.transform='translateY(-50%) scale(1)';">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="alumni-carousel-next" style="position: absolute; right: -60px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); border: none; border-radius: 50%; color: #fff; font-size: 18px; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3); display: flex; align-items: center; justify-content: center;" onmouseover="this.style.transform='translateY(-50%) scale(1.1)';" onmouseout="this.style.transform='translateY(-50%) scale(1)';">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Carousel Indicators -->
                <div style="display: flex; justify-content: center; gap: 10px; margin-top: 30px;" data-accent-color="{{ $alumniAccentColor }}">
                    @foreach($alumniTestimonials as $index => $alumni)
                    <button class="alumni-carousel-indicator" data-slide="{{ $index }}" style="width: 12px; height: 12px; border-radius: 50%; border: none; background: {{ $index === 0 ? $alumniAccentColor : 'rgba(255, 107, 53, 0.3)' }}; cursor: pointer; transition: all 0.3s;" onclick="goToSlide({{ $index }})"></button>
                    @endforeach
                </div>
            </div>

            <!-- CTA Button -->
            <div style="text-align: center; margin-top: 50px;">
                <a href="{{ $alumniCTA['link'] }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 32px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); color: #fff; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 16px; transition: all 0.3s; box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 35px rgba(255, 107, 53, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(255, 107, 53, 0.3)';">
                    <span>{{ $alumniCTA['text'] }}</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        @elseif($alumniLayoutStyle === 'testimonial_cards')
        {{-- LAYOUT 4: Testimonial Cards with Stats --}}
        <div data-aos="fade-up">
            <!-- Section Header -->
            <div style="text-align: center; margin-bottom: 60px;">
                <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }} 0%, {{ $alumniAccentGradient['end'] }} 100%); border-radius: 25px; box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3); margin-bottom: 30px;">
                    <div style="font-size: 20px;">{{ $alumniHeader['icon'] }}</div>
                    <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">{{ $alumniHeader['badge_text'] }}</span>
                </div>
                <h2 style="font-size: 48px; font-weight: 900; color: #1e293b; margin: 0 0 20px 0; line-height: 1.1;">
                    <span style="background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $alumniHeader['title'] }}</span>
                    <span style="background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"> {{ $alumniHeader['title_highlight'] }}</span>
                </h2>
                <p style="font-size: 18px; color: #64748b; max-width: 600px; margin: 0 auto;">{{ $alumniHeader['subtitle'] }}</p>
            </div>

            <!-- Stats Row -->
            @if(count($alumniStats) > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 60px;">
                @foreach($alumniStats as $stat)
                <div style="background: {{ $alumniCardBg }}; backdrop-filter: blur(10px); border-radius: 16px; padding: 30px; border: 1px solid {{ $alumniCardBorder }}; text-align: center; transition: all 0.3s;" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(255, 107, 53, 0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <div style="font-size: 42px; font-weight: 900; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 10px;">
                        {{ $stat['value'] ?? '0' }}
                    </div>
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">
                        {{ $stat['label'] ?? 'Stat' }}
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Testimonial Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px; margin-bottom: 50px;">
                @foreach($alumniTestimonials as $index => $alumni)
                @php
                    $nameParts = explode(' ', $alumni->name);
                    $initials = '';
                    foreach($nameParts as $part) {
                        if(!empty($part)) {
                            $initials .= strtoupper(substr($part, 0, 1));
                            if(strlen($initials) >= 2) break;
                        }
                    }
                @endphp
                <div style="background: {{ $alumniCardBg }}; backdrop-filter: blur(10px); border-radius: 20px; padding: 35px; border: 1px solid {{ $alumniCardBorder }}; transition: all 0.3s ease; position: relative; overflow: hidden;" class="alumni-card" data-aos="fade-up" data-aos-delay="{{ ($index % 2) * 100 }}" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 50px rgba(255, 107, 53, 0.2)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <div style="position: absolute; top: 0; right: 0; width: 100px; height: 100px; background: radial-gradient(circle, {{ $alumniDecorationColor1 }} 0%, transparent 70%); border-radius: 0 20px 0 100px;"></div>
                    <div style="position: relative; z-index: 2;">
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                            <div style="width: 70px; height: 70px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); border-radius: 18px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 24px; box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);">
                                {{ $initials }}
                            </div>
                            <div style="flex: 1;">
                                <h4 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 6px 0;">{{ $alumni->name }}</h4>
                                <p style="font-size: 15px; color: #64748b; margin: 0 0 8px 0;">{{ $alumni->position }} at {{ $alumni->company }}</p>
                                <div style="display: flex; gap: 3px;">
                                    @for($i = 0; $i < $alumni->rating; $i++)
                                    <i class="fas fa-star" style="color: {{ $alumniAccentColor }}; font-size: 14px;"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p style="color: #64748b; font-size: 16px; line-height: 1.7; margin: 0; font-style: italic;">
                            "{{ $alumni->testimonial }}"
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- CTA Button -->
            <div style="text-align: center;">
                <a href="{{ $alumniCTA['link'] }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 32px; background: linear-gradient(135deg, {{ $alumniAccentGradient['start'] }}, {{ $alumniAccentGradient['end'] }}); color: #fff; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 16px; transition: all 0.3s; box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 35px rgba(255, 107, 53, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(255, 107, 53, 0.3)';">
                    <span>{{ $alumniCTA['text'] }}</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

@php
    use App\Models\Setting as HomeSetting;

    try {
        $pmbLayoutStyle = HomeSetting::where('key', 'pmb_layout_style')->value('value') ?? 'current';
        $pmbBadgeText = HomeSetting::where('key', 'pmb_badge_text')->value('value') ?? 'PENERIMAAN MAHASISWA BARU';
        $pmbBadgeIcon = HomeSetting::where('key', 'pmb_badge_icon')->value('value') ?? 'fa-circle';
        $pmbTitleTemplate = HomeSetting::where('key', 'pmb_title')->value('value') ?? 'Informasi PMB Tahun {{year}}';
        $pmbTitle = str_replace('{{year}}', date('Y'), $pmbTitleTemplate);
        $pmbSubtitle = HomeSetting::where('key', 'pmb_subtitle')->value('value') ?? 'Program Studi Sistem Informasi Universitas Bengkulu';
        $pmbButtonText = HomeSetting::where('key', 'pmb_button_text')->value('value') ?? 'Info Selengkapnya';
        $pmbButtonLink = HomeSetting::where('key', 'pmb_button_link')->value('value') ?? '/contact';
        $pmbButtonIcon = HomeSetting::where('key', 'pmb_button_icon')->value('value') ?? 'fa-arrow-right';
        $pmbBgColor = HomeSetting::where('key', 'pmb_bg_color')->value('value') ?? '#f8fafc';
        $pmbBorderColor = HomeSetting::where('key', 'pmb_border_color')->value('value') ?? '#e5e7eb';
        $pmbBadgeBg = HomeSetting::where('key', 'pmb_badge_bg')->value('value') ?? '#f1f5f9';
        $pmbBadgeDotColor = HomeSetting::where('key', 'pmb_badge_dot_color')->value('value') ?? '#f59e0b';
        $pmbTitleColor = HomeSetting::where('key', 'pmb_title_color')->value('value') ?? '#1e293b';
        $pmbSubtitleColor = HomeSetting::where('key', 'pmb_subtitle_color')->value('value') ?? '#64748b';
        $pmbButtonBg = HomeSetting::where('key', 'pmb_button_bg')->value('value') ?? '#1a246a';
        $pmbButtonTextColor = HomeSetting::where('key', 'pmb_button_text_color')->value('value') ?? '#ffffff';
        $pmbButtonBorderColor = HomeSetting::where('key', 'pmb_button_border_color')->value('value') ?? '#1a246a';
    } catch (\Exception $e) {
        $pmbLayoutStyle = 'current';
        $pmbBadgeText = 'PENERIMAAN MAHASISWA BARU';
        $pmbBadgeIcon = 'fa-circle';
        $pmbTitle = 'Informasi PMB Tahun ' . date('Y');
        $pmbSubtitle = 'Program Studi Sistem Informasi Universitas Bengkulu';
        $pmbButtonText = 'Info Selengkapnya';
        $pmbButtonLink = '/contact';
        $pmbButtonIcon = 'fa-arrow-right';
        $pmbBgColor = '#f8fafc';
        $pmbBorderColor = '#e5e7eb';
        $pmbBadgeBg = '#f1f5f9';
        $pmbBadgeDotColor = '#f59e0b';
        $pmbTitleColor = '#1e293b';
        $pmbSubtitleColor = '#64748b';
        $pmbButtonBg = '#1a246a';
        $pmbButtonTextColor = '#ffffff';
        $pmbButtonBorderColor = '#1a246a';
    }
@endphp

<!-- Info Banner PMB - Dynamic -->
<section style="padding: 80px 0; background: #ffffff;">
    <div class="container" data-aos="fade-up">
        @if($pmbLayoutStyle === 'current')
        <div style="background: {{ $pmbBgColor }}; border: 1px solid {{ $pmbBorderColor }}; border-radius: 16px; padding: 40px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 16px; background: {{ $pmbBadgeBg }}; border-radius: 20px; margin-bottom: 16px;">
                    <div style="width: 6px; height: 6px; background: {{ $pmbBadgeDotColor }}; border-radius: 50%;"></div>
                    <span style="font-size: 12px; font-weight: 600; color: {{ $pmbSubtitleColor }}; letter-spacing: 0.5px;">
                        @if($pmbBadgeIcon)
                            <i class="fas {{ $pmbBadgeIcon }}" style="font-size: 10px; margin-right: 4px; color: {{ $pmbBadgeDotColor }};"></i>
                        @endif
                        {{ $pmbBadgeText }}
                    </span>
                </div>
                <h3 style="font-size: 24px; font-weight: 700; color: {{ $pmbTitleColor }}; margin: 0 0 8px 0;">
                    {{ $pmbTitle }}
                </h3>
                <p style="font-size: 16px; color: {{ $pmbSubtitleColor }}; margin: 0;">{{ $pmbSubtitle }}</p>
            </div>
            <a href="{{ $pmbButtonLink }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: {{ $pmbButtonBg }}; color: {{ $pmbButtonTextColor }}; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 15px; transition: all 0.2s; border: 1px solid {{ $pmbButtonBorderColor }};" class="clean-btn">
                <span>{{ $pmbButtonText }}</span>
                @if($pmbButtonIcon)
                <i class="fas {{ $pmbButtonIcon }}" style="font-size: 12px;"></i>
                @endif
            </a>
        </div>
        @elseif($pmbLayoutStyle === 'compact')
        <div style="background: {{ $pmbBgColor }}; border: 1px solid {{ $pmbBorderColor }}; border-radius: 16px; padding: 24px 28px; display: flex; justify-content: space-between; align-items: center; gap: 20px;">
            <div>
                <h3 style="font-size: 20px; font-weight: 700; color: {{ $pmbTitleColor }}; margin: 0 0 6px 0;">
                    {{ $pmbTitle }}
                </h3>
                <p style="font-size: 14px; color: {{ $pmbSubtitleColor }}; margin: 0;">{{ $pmbSubtitle }}</p>
            </div>
            <a href="{{ $pmbButtonLink }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; background: {{ $pmbButtonBg }}; color: {{ $pmbButtonTextColor }}; text-decoration: none; border-radius: 999px; font-weight: 600; font-size: 14px; border: 1px solid {{ $pmbButtonBorderColor }};">
                <span>{{ $pmbButtonText }}</span>
                @if($pmbButtonIcon)
                <i class="fas {{ $pmbButtonIcon }}" style="font-size: 11px;"></i>
                @endif
            </a>
        </div>
        @endif
    </div>
</section>

@php
    // Fetch CTA settings from database
    try {
        $ctaLayoutStyle = App\Models\Setting::where('key', 'cta_layout_style')->value('value') ?? 'current';
        $ctaBadgeText = App\Models\Setting::where('key', 'cta_badge_text')->value('value') ?? 'JADILAH BAGIAN DARI REVOLUSI DIGITAL';
        $ctaBadgeShow = App\Models\Setting::where('key', 'cta_badge_show')->value('value') ?? '1';
        $ctaTitle = App\Models\Setting::where('key', 'cta_title')->value('value') ?? 'Siap Bergabung Bersama Kami?';
        $ctaSubtitle = App\Models\Setting::where('key', 'cta_subtitle')->value('value') ?? 'Daftar sekarang dan raih masa depan cemerlang di bidang Sistem Informasi';
        $ctaBgGradientStart = App\Models\Setting::where('key', 'cta_bg_gradient_start')->value('value') ?? '#0f172a';
        $ctaBgGradientMid = App\Models\Setting::where('key', 'cta_bg_gradient_mid')->value('value') ?? '#1a246a';
        $ctaBgGradientEnd = App\Models\Setting::where('key', 'cta_bg_gradient_end')->value('value') ?? '#1a246a';
        $ctaAccentColor = App\Models\Setting::where('key', 'cta_accent_color')->value('value') ?? '#fbbf24';
        $ctaAccentColor2 = App\Models\Setting::where('key', 'cta_accent_color_2')->value('value') ?? '#f97316';
        $ctaPrimaryButtonText = App\Models\Setting::where('key', 'cta_primary_button_text')->value('value') ?? 'Mulai Sekarang';
        $ctaPrimaryButtonLink = App\Models\Setting::where('key', 'cta_primary_button_link')->value('value') ?? '/contact';
        $ctaPrimaryButtonIcon = App\Models\Setting::where('key', 'cta_primary_button_icon')->value('value') ?? 'fa-rocket';
        $ctaSecondaryButtonText = App\Models\Setting::where('key', 'cta_secondary_button_text')->value('value') ?? 'Jelajahi Program';
        $ctaSecondaryButtonLink = App\Models\Setting::where('key', 'cta_secondary_button_link')->value('value') ?? '/about';
        $ctaSecondaryButtonIcon = App\Models\Setting::where('key', 'cta_secondary_button_icon')->value('value') ?? 'fa-compass';
        $ctaFeature1Icon = App\Models\Setting::where('key', 'cta_feature_1_icon')->value('value') ?? 'fa-graduation-cap';
        $ctaFeature1Title = App\Models\Setting::where('key', 'cta_feature_1_title')->value('value') ?? 'Pendidikan Berkualitas';
        $ctaFeature1Description = App\Models\Setting::where('key', 'cta_feature_1_description')->value('value') ?? 'Kurikulum modern dan relevan dengan industri';
        $ctaFeature2Icon = App\Models\Setting::where('key', 'cta_feature_2_icon')->value('value') ?? 'fa-laptop-code';
        $ctaFeature2Title = App\Models\Setting::where('key', 'cta_feature_2_title')->value('value') ?? 'Praktik Terbaik';
        $ctaFeature2Description = App\Models\Setting::where('key', 'cta_feature_2_description')->value('value') ?? 'Pembelajaran berbasis proyek dan kasus nyata';
        $ctaFeature3Icon = App\Models\Setting::where('key', 'cta_feature_3_icon')->value('value') ?? 'fa-briefcase';
        $ctaFeature3Title = App\Models\Setting::where('key', 'cta_feature_3_title')->value('value') ?? 'Karir Cemerlang';
        $ctaFeature3Description = App\Models\Setting::where('key', 'cta_feature_3_description')->value('value') ?? 'Jaringan alumni dan peluang kerja luas';
        $ctaFeaturesShow = App\Models\Setting::where('key', 'cta_features_show')->value('value') ?? '1';
    } catch (\Exception $e) {
        $ctaLayoutStyle = 'current';
        $ctaBadgeText = 'JADILAH BAGIAN DARI REVOLUSI DIGITAL';
        $ctaBadgeShow = '1';
        $ctaTitle = 'Siap Bergabung Bersama Kami?';
        $ctaSubtitle = 'Daftar sekarang dan raih masa depan cemerlang di bidang Sistem Informasi';
        $ctaBgGradientStart = '#0f172a';
        $ctaBgGradientMid = '#1a246a';
        $ctaBgGradientEnd = '#1a246a';
        $ctaAccentColor = '#fbbf24';
        $ctaAccentColor2 = '#f97316';
        $ctaPrimaryButtonText = 'Mulai Sekarang';
        $ctaPrimaryButtonLink = '/contact';
        $ctaPrimaryButtonIcon = 'fa-rocket';
        $ctaSecondaryButtonText = 'Jelajahi Program';
        $ctaSecondaryButtonLink = '/about';
        $ctaSecondaryButtonIcon = 'fa-compass';
        $ctaFeature1Icon = 'fa-graduation-cap';
        $ctaFeature1Title = 'Pendidikan Berkualitas';
        $ctaFeature1Description = 'Kurikulum modern dan relevan dengan industri';
        $ctaFeature2Icon = 'fa-laptop-code';
        $ctaFeature2Title = 'Praktik Terbaik';
        $ctaFeature2Description = 'Pembelajaran berbasis proyek dan kasus nyata';
        $ctaFeature3Icon = 'fa-briefcase';
        $ctaFeature3Title = 'Karir Cemerlang';
        $ctaFeature3Description = 'Jaringan alumni dan peluang kerja luas';
        $ctaFeaturesShow = '1';
    }
@endphp

<!-- CTA Section - Dynamic Layout -->
<section style="padding: 120px 0; background: linear-gradient(135deg, {{ $ctaBgGradientStart }} 0%, {{ $ctaBgGradientMid }} 50%, {{ $ctaBgGradientEnd }} 100%); color: #fff; text-align: center; position: relative; overflow: hidden;">
    <!-- Animated Background Elements -->
    <div style="position: absolute; top: -150px; right: -150px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(251, 191, 36, 0.1) 0%, transparent 70%); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
    <div style="position: absolute; bottom: -200px; left: -200px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite reverse;"></div>
    <div style="position: absolute; top: 50%; left: 10%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(147, 51, 234, 0.1) 0%, transparent 70%); border-radius: 50%; animation: float 7s ease-in-out infinite 2s;"></div>

    <div class="container" style="position: relative; z-index: 2;" data-aos="fade-up">
        @if($ctaLayoutStyle === 'current')
        {{-- LAYOUT 1: Current Modern Design --}}
        @if($ctaBadgeShow == '1')
        <div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 28px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 25px; margin-bottom: 40px;">
            <div style="width: 12px; height: 12px; background: {{ $ctaAccentColor }}; border-radius: 50%; animation: pulse 2s ease-in-out infinite;"></div>
            <span style="font-size: 14px; font-weight: 700; color: #fff; letter-spacing: 1px;">{{ $ctaBadgeText }}</span>
            <div style="width: 12px; height: 12px; background: {{ $ctaAccentColor }}; border-radius: 50%; animation: pulse 2s ease-in-out infinite 1s;"></div>
        </div>
        @endif

        <h2 style="font-size: 56px; font-weight: 900; margin: 0 0 25px 0; line-height: 1.1; position: relative;">
            <span style="background: linear-gradient(135deg, #fff 0%, {{ $ctaAccentColor }} 50%, {{ $ctaAccentColor2 }} 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                {{ $ctaTitle }}
            </span>
            <div style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 100px; height: 4px; background: linear-gradient(135deg, {{ $ctaAccentColor }}, {{ $ctaAccentColor2 }}); border-radius: 2px; animation: expandWidth 2s ease-in-out infinite;"></div>
        </h2>

        <p style="font-size: 20px; color: rgba(255,255,255,0.9); max-width: 700px; margin: 0 auto 50px auto; line-height: 1.7; font-weight: 400;">
            {{ $ctaSubtitle }}
        </p>

        <div style="display: flex; gap: 25px; justify-content: center; flex-wrap: wrap; margin-bottom: 60px;">
            <a href="{{ $ctaPrimaryButtonLink }}" style="display: inline-flex; align-items: center; gap: 15px; padding: 18px 40px; background: linear-gradient(135deg, {{ $ctaAccentColor }} 0%, #f59e0b 100%); color: #1e293b; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 18px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 10px 30px rgba(251, 191, 36, 0.3); position: relative; overflow: hidden;" class="cta-primary-btn">
                <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(135deg, {{ $ctaAccentColor2 }} 0%, #f59e0b 100%); transition: left 0.3s; z-index: 0;"></div>
                <i class="fas {{ $ctaPrimaryButtonIcon }}" style="position: relative; z-index: 1; font-size: 20px;"></i>
                <span style="position: relative; z-index: 1;">{{ $ctaPrimaryButtonText }}</span>
            </a>

            <a href="{{ $ctaSecondaryButtonLink }}" style="display: inline-flex; align-items: center; gap: 15px; padding: 18px 40px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); color: #fff; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 18px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;" class="cta-secondary-btn">
                <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: rgba(255,255,255,0.2); transition: left 0.3s; z-index: 0;"></div>
                <i class="fas {{ $ctaSecondaryButtonIcon }}" style="position: relative; z-index: 1; font-size: 20px;"></i>
                <span style="position: relative; z-index: 1;">{{ $ctaSecondaryButtonText }}</span>
            </a>
        </div>

        @if($ctaFeaturesShow == '1')
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; max-width: 800px; margin: 0 auto;">
            <div style="text-align: center; padding: 25px; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; transition: all 0.3s;">
                <i class="fas {{ $ctaFeature1Icon }}" style="font-size: 32px; color: {{ $ctaAccentColor }}; margin-bottom: 15px;"></i>
                <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 8px 0; color: #fff;">{{ $ctaFeature1Title }}</h4>
                <p style="font-size: 14px; color: rgba(255,255,255,0.8); margin: 0; line-height: 1.5;">{{ $ctaFeature1Description }}</p>
            </div>
            <div style="text-align: center; padding: 25px; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; transition: all 0.3s;">
                <i class="fas {{ $ctaFeature2Icon }}" style="font-size: 32px; color: {{ $ctaAccentColor }}; margin-bottom: 15px;"></i>
                <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 8px 0; color: #fff;">{{ $ctaFeature2Title }}</h4>
                <p style="font-size: 14px; color: rgba(255,255,255,0.8); margin: 0; line-height: 1.5;">{{ $ctaFeature2Description }}</p>
            </div>
            <div style="text-align: center; padding: 25px; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; transition: all 0.3s;">
                <i class="fas {{ $ctaFeature3Icon }}" style="font-size: 32px; color: {{ $ctaAccentColor }}; margin-bottom: 15px;"></i>
                <h4 style="font-size: 16px; font-weight: 700; margin: 0 0 8px 0; color: #fff;">{{ $ctaFeature3Title }}</h4>
                <p style="font-size: 14px; color: rgba(255,255,255,0.8); margin: 0; line-height: 1.5;">{{ $ctaFeature3Description }}</p>
            </div>
        </div>
        @endif

        @elseif($ctaLayoutStyle === 'minimal')
        {{-- LAYOUT 2: Minimal Clean --}}
        @if($ctaBadgeShow == '1')
        <div style="display: inline-block; padding: 8px 20px; background: rgba(255,255,255,0.1); border-radius: 20px; margin-bottom: 30px;">
            <span style="font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.9); letter-spacing: 0.5px;">{{ $ctaBadgeText }}</span>
        </div>
        @endif

        <h2 style="font-size: 48px; font-weight: 800; margin: 0 0 20px 0; line-height: 1.2;">
            {{ $ctaTitle }}
        </h2>

        <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto 40px auto; line-height: 1.6;">
            {{ $ctaSubtitle }}
        </p>

        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-bottom: 50px;">
            <a href="{{ $ctaPrimaryButtonLink }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 36px; background: {{ $ctaAccentColor }}; color: #1e293b; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(251, 191, 36, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <i class="fas {{ $ctaPrimaryButtonIcon }}"></i>
                <span>{{ $ctaPrimaryButtonText }}</span>
            </a>
            <a href="{{ $ctaSecondaryButtonLink }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 36px; background: transparent; border: 2px solid rgba(255,255,255,0.3); color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px; transition: all 0.3s;" onmouseover="this.style.borderColor='{{ $ctaAccentColor }}'; this.style.transform='translateY(-2px)';" onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.transform='translateY(0)';">
                <i class="fas {{ $ctaSecondaryButtonIcon }}"></i>
                <span>{{ $ctaSecondaryButtonText }}</span>
            </a>
        </div>

        @if($ctaFeaturesShow == '1')
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; max-width: 700px; margin: 0 auto;">
            <div style="text-align: center; padding: 20px;">
                <i class="fas {{ $ctaFeature1Icon }}" style="font-size: 28px; color: {{ $ctaAccentColor }}; margin-bottom: 12px;"></i>
                <h4 style="font-size: 15px; font-weight: 600; margin: 0 0 6px 0; color: #fff;">{{ $ctaFeature1Title }}</h4>
                <p style="font-size: 13px; color: rgba(255,255,255,0.75); margin: 0; line-height: 1.5;">{{ $ctaFeature1Description }}</p>
            </div>
            <div style="text-align: center; padding: 20px;">
                <i class="fas {{ $ctaFeature2Icon }}" style="font-size: 28px; color: {{ $ctaAccentColor }}; margin-bottom: 12px;"></i>
                <h4 style="font-size: 15px; font-weight: 600; margin: 0 0 6px 0; color: #fff;">{{ $ctaFeature2Title }}</h4>
                <p style="font-size: 13px; color: rgba(255,255,255,0.75); margin: 0; line-height: 1.5;">{{ $ctaFeature2Description }}</p>
            </div>
            <div style="text-align: center; padding: 20px;">
                <i class="fas {{ $ctaFeature3Icon }}" style="font-size: 28px; color: {{ $ctaAccentColor }}; margin-bottom: 12px;"></i>
                <h4 style="font-size: 15px; font-weight: 600; margin: 0 0 6px 0; color: #fff;">{{ $ctaFeature3Title }}</h4>
                <p style="font-size: 13px; color: rgba(255,255,255,0.75); margin: 0; line-height: 1.5;">{{ $ctaFeature3Description }}</p>
            </div>
        </div>
        @endif

        @elseif($ctaLayoutStyle === 'split')
        {{-- LAYOUT 3: Split Content --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; text-align: left;">
            <div>
                @if($ctaBadgeShow == '1')
                <div style="display: inline-block; padding: 8px 20px; background: rgba(255,255,255,0.1); border-radius: 20px; margin-bottom: 25px;">
                    <span style="font-size: 12px; font-weight: 600; color: {{ $ctaAccentColor }}; letter-spacing: 0.5px;">{{ $ctaBadgeText }}</span>
                </div>
                @endif
                <h2 style="font-size: 52px; font-weight: 900; margin: 0 0 25px 0; line-height: 1.1;">
                    <span style="background: linear-gradient(135deg, #fff 0%, {{ $ctaAccentColor }} 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $ctaTitle }}</span>
                </h2>
                <p style="font-size: 18px; color: rgba(255,255,255,0.85); margin: 0 0 35px 0; line-height: 1.7;">
                    {{ $ctaSubtitle }}
                </p>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <a href="{{ $ctaPrimaryButtonLink }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 32px; background: {{ $ctaAccentColor }}; color: #1e293b; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(251, 191, 36, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <i class="fas {{ $ctaPrimaryButtonIcon }}"></i>
                        <span>{{ $ctaPrimaryButtonText }}</span>
                    </a>
                    <a href="{{ $ctaSecondaryButtonLink }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 32px; background: transparent; border: 2px solid rgba(255,255,255,0.3); color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px; transition: all 0.3s;" onmouseover="this.style.borderColor='{{ $ctaAccentColor }}'; this.style.transform='translateY(-2px)';" onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.transform='translateY(0)';">
                        <i class="fas {{ $ctaSecondaryButtonIcon }}"></i>
                        <span>{{ $ctaSecondaryButtonText }}</span>
                    </a>
                </div>
            </div>
            @if($ctaFeaturesShow == '1')
            <div>
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; align-items: start; gap: 20px; padding: 25px; background: rgba(255,255,255,0.05); border-radius: 12px;">
                        <i class="fas {{ $ctaFeature1Icon }}" style="font-size: 32px; color: {{ $ctaAccentColor }}; margin-top: 5px;"></i>
                        <div>
                            <h4 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; color: #fff;">{{ $ctaFeature1Title }}</h4>
                            <p style="font-size: 14px; color: rgba(255,255,255,0.8); margin: 0; line-height: 1.6;">{{ $ctaFeature1Description }}</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: start; gap: 20px; padding: 25px; background: rgba(255,255,255,0.05); border-radius: 12px;">
                        <i class="fas {{ $ctaFeature2Icon }}" style="font-size: 32px; color: {{ $ctaAccentColor }}; margin-top: 5px;"></i>
                        <div>
                            <h4 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; color: #fff;">{{ $ctaFeature2Title }}</h4>
                            <p style="font-size: 14px; color: rgba(255,255,255,0.8); margin: 0; line-height: 1.6;">{{ $ctaFeature2Description }}</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: start; gap: 20px; padding: 25px; background: rgba(255,255,255,0.05); border-radius: 12px;">
                        <i class="fas {{ $ctaFeature3Icon }}" style="font-size: 32px; color: {{ $ctaAccentColor }}; margin-top: 5px;"></i>
                        <div>
                            <h4 style="font-size: 18px; font-weight: 700; margin: 0 0 8px 0; color: #fff;">{{ $ctaFeature3Title }}</h4>
                            <p style="font-size: 14px; color: rgba(255,255,255,0.8); margin: 0; line-height: 1.6;">{{ $ctaFeature3Description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        @elseif($ctaLayoutStyle === 'centered')
        {{-- LAYOUT 4: Centered Simple --}}
        <div style="max-width: 700px; margin: 0 auto;">
            @if($ctaBadgeShow == '1')
            <div style="display: inline-block; padding: 6px 18px; background: {{ $ctaAccentColor }}; border-radius: 20px; margin-bottom: 30px;">
                <span style="font-size: 11px; font-weight: 700; color: #1e293b; letter-spacing: 1px;">{{ $ctaBadgeText }}</span>
            </div>
            @endif

            <h2 style="font-size: 44px; font-weight: 800; margin: 0 0 20px 0; line-height: 1.2;">
                {{ $ctaTitle }}
            </h2>

            <p style="font-size: 17px; color: rgba(255,255,255,0.85); margin: 0 0 35px 0; line-height: 1.7;">
                {{ $ctaSubtitle }}
            </p>

            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-bottom: 50px;">
                <a href="{{ $ctaPrimaryButtonLink }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 30px; background: {{ $ctaAccentColor }}; color: #1e293b; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 15px; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 18px rgba(251, 191, 36, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <i class="fas {{ $ctaPrimaryButtonIcon }}"></i>
                    <span>{{ $ctaPrimaryButtonText }}</span>
                </a>
                <a href="{{ $ctaSecondaryButtonLink }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 30px; background: transparent; border: 1.5px solid rgba(255,255,255,0.4); color: #fff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 15px; transition: all 0.3s;" onmouseover="this.style.borderColor='{{ $ctaAccentColor }}'; this.style.color='{{ $ctaAccentColor }}'; this.style.transform='translateY(-2px)';" onmouseout="this.style.borderColor='rgba(255,255,255,0.4)'; this.style.color='#fff'; this.style.transform='translateY(0)';">
                    <i class="fas {{ $ctaSecondaryButtonIcon }}"></i>
                    <span>{{ $ctaSecondaryButtonText }}</span>
                </a>
            </div>

            @if($ctaFeaturesShow == '1')
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <div style="text-align: center;">
                    <i class="fas {{ $ctaFeature1Icon }}" style="font-size: 24px; color: {{ $ctaAccentColor }}; margin-bottom: 10px;"></i>
                    <h4 style="font-size: 14px; font-weight: 600; margin: 0 0 5px 0; color: #fff;">{{ $ctaFeature1Title }}</h4>
                    <p style="font-size: 12px; color: rgba(255,255,255,0.7); margin: 0; line-height: 1.5;">{{ $ctaFeature1Description }}</p>
                </div>
                <div style="text-align: center;">
                    <i class="fas {{ $ctaFeature2Icon }}" style="font-size: 24px; color: {{ $ctaAccentColor }}; margin-bottom: 10px;"></i>
                    <h4 style="font-size: 14px; font-weight: 600; margin: 0 0 5px 0; color: #fff;">{{ $ctaFeature2Title }}</h4>
                    <p style="font-size: 12px; color: rgba(255,255,255,0.7); margin: 0; line-height: 1.5;">{{ $ctaFeature2Description }}</p>
                </div>
                <div style="text-align: center;">
                    <i class="fas {{ $ctaFeature3Icon }}" style="font-size: 24px; color: {{ $ctaAccentColor }}; margin-bottom: 10px;"></i>
                    <h4 style="font-size: 14px; font-weight: 600; margin: 0 0 5px 0; color: #fff;">{{ $ctaFeature3Title }}</h4>
                    <p style="font-size: 12px; color: rgba(255,255,255,0.7); margin: 0; line-height: 1.5;">{{ $ctaFeature3Description }}</p>
                </div>
            </div>
            @endif
        </div>
        @endif
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
