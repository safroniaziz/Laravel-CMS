@php
    // Fetch news section header from settings
    try {
        $newsHeader = [
            'title' => App\Models\Setting::where('key', 'news_section_title')->value('value') ?? 'Berita Terbaru',
            'subtitle' => App\Models\Setting::where('key', 'news_section_subtitle')->value('value') ?? 'Informasi dan Berita Terbaru Program Studi Sistem Informasi',
            'show_subtitle' => App\Models\Setting::where('key', 'news_section_show_subtitle')->value('value') ?? '0',
            'accent_color' => App\Models\Setting::where('key', 'news_section_accent_color')->value('value') ?? '#f97316',
        ];
    } catch (\Exception $e) {
        $newsHeader = [
            'title' => 'Berita Terbaru',
            'subtitle' => 'Informasi dan Berita Terbaru Program Studi Sistem Informasi',
            'show_subtitle' => '0',
            'accent_color' => '#f97316',
        ];
    }
@endphp

{{-- Berita Terbaru Section - UGM Style --}}
<section style="padding: 80px 0; background: #fff; position: relative;">
    <div class="container">
        {{-- UGM Style Header --}}
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px;" data-aos="fade-up">
            <div style="position: relative;">
                <h2 style="font-size: 36px; font-weight: 700; color: #1a246a; margin: 0; font-family: 'Outfit', sans-serif; letter-spacing: -0.5px;">
                    {{ $newsHeader['title'] }}
                </h2>
                @if($newsHeader['show_subtitle'] == '1')
                    <p style="font-size: 14px; color: #64748b; margin: 8px 0 0 0;">
                        {{ $newsHeader['subtitle'] }}
                    </p>
                @endif
                {{-- UGM Yellow Line Accent --}}
                <div style="position: absolute; bottom: -21px; left: 0; width: 100px; height: 4px; background: {{ $newsHeader['accent_color'] }};"></div>
            </div>
            <a href="{{ route('blog.index') }}" style="font-size: 14px; font-weight: 600; color: #1a246a; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s ease;" onmouseover="this.style.color='#f97316'; this.querySelector('i').style.transform='translateX(4px)';" onmouseout="this.style.color='#1a246a'; this.querySelector('i').style.transform='translateX(0)';">
                LIHAT SEMUA
                <i class="fas fa-arrow-right" style="font-size: 12px; transition: transform 0.3s ease;"></i>
            </a>
        </div>

        @php
            // Fallback data if no posts
            if ($latestPosts->count() == 0) {
                $latestPosts = collect([
                    (object)[
                        'title' => 'Grand Launching Majalah Equilibrium 2025 Bahas Krisis Bumi (Dummy)',
                        'slug' => 'dummy-main-1',
                        'excerpt' => 'Grand Launching Majalah Equilibrium 2025 menyoroti urgensi menjaga keberlanjutan bumi di tengah berbagai proyek transisi energi yang berpotensi menimbulkan dampak ekologis baru.',
                        'featured_image' => null,
                        'published_at' => now(),
                        'category' => (object)['name' => 'Liputan/Berita']
                    ],
                    (object)[
                        'title' => 'Mahasiswa UGM Kembangkan SIKE, Sistem Dapur Pintar Berbasis AI',
                        'slug' => 'dummy-1',
                        'featured_image' => null,
                        'published_at' => now()->subDays(1),
                        'category' => (object)['name' => 'PKM']
                    ],
                    (object)[
                        'title' => 'UGM dan APCOVE Gelar Lokakarya Epidemiologi, Perkuat Kapasitas',
                        'slug' => 'dummy-2',
                        'featured_image' => null,
                        'published_at' => now()->subDays(2),
                        'category' => (object)['name' => 'Seminar/Workshop']
                    ],
                    (object)[
                        'title' => 'UGM Dampingi Petani Dlingo Ubah Limbah Biomassa Kayu Jadi',
                        'slug' => 'dummy-3',
                        'featured_image' => null,
                        'published_at' => now()->subDays(3),
                        'category' => (object)['name' => 'Pengabdian']
                    ]
                ]);
            }
        @endphp

        @if($latestPosts->count() > 0)
            @php
                $featuredPost = $latestPosts->first();
                $gridPosts = $latestPosts->skip(1)->take(3);
            @endphp

            {{-- Featured Post --}}
            <div style="margin-bottom: 40px;" data-aos="fade-up" data-aos-delay="100">
                <article onclick="window.location='{{ route('blog.show', $featuredPost->slug) }}'" 
                         style="display: grid; grid-template-columns: 453px 1fr; gap: 30px; cursor: pointer;">
                    
                    {{-- Featured Image (Left) --}}
                    <div style="position: relative; height: 309px; overflow: hidden; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                        @if($featuredPost->featured_image)
                            <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" 
                                 onmouseover="this.style.transform='scale(1.05)';" 
                                 onmouseout="this.style.transform='scale(1)';">
                        @else
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a246a, #2563eb); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-newspaper" style="font-size: 64px; color: rgba(255, 255, 255, 0.3);"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Content (Right) --}}
                    <div style="display: flex; flex-direction: column; justify-content: center;">
                        {{-- Category Badge --}}
                        <div style="margin-bottom: 12px;">
                            <span style="font-size: 12px; font-weight: 700; color: #1a246a; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $featuredPost->category->name ?? 'Liputan/Berita' }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h3 style="font-size: 28px; font-weight: 700; color: #1a246a; margin: 0 0 12px 0; line-height: 1.3; font-family: 'Outfit', sans-serif; transition: color 0.3s ease;" 
                            onmouseover="this.style.color='#0f4c81';" 
                            onmouseout="this.style.color='#1a246a';">
                            {{ $featuredPost->title }}
                        </h3>

                        {{-- Date --}}
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; color: #64748b; font-size: 14px;">
                            <span>{{ $featuredPost->published_at->format('d F Y, H.i') }}</span>
                        </div>

                        {{-- Excerpt --}}
                        @if($featuredPost->excerpt)
                            <p style="font-size: 15px; color: #475569; margin: 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $featuredPost->excerpt }}
                            </p>
                        @endif
                    </div>
                </article>
            </div>

            {{-- Grid Posts (3 columns) --}}
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;" data-aos="fade-up" data-aos-delay="200">
                @foreach($gridPosts as $post)
                    <article onclick="window.location='{{ route('blog.show', $post->slug) }}'" 
                             style="cursor: pointer; transition: transform 0.3s ease;" 
                             onmouseover="this.style.transform='translateY(-4px)';" 
                             onmouseout="this.style.transform='translateY(0)';">
                        
                        {{-- Thumbnail --}}
                        <div style="position: relative; height: 180px; overflow: hidden; border-radius: 8px; margin-bottom: 16px; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" 
                                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;" 
                                     onmouseover="this.style.transform='scale(1.1)';" 
                                     onmouseout="this.style.transform='scale(1)';">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #e2e8f0, #cbd5e1); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="font-size: 32px; color: rgba(100, 116, 139, 0.4);"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Category Badge --}}
                        <div style="margin-bottom: 8px;">
                            <span style="font-size: 11px; font-weight: 700; color: #1a246a; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $post->category->name ?? 'Berita' }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s ease; font-family: 'Outfit', sans-serif;" 
                            onmouseover="this.style.color='#1a246a';" 
                            onmouseout="this.style.color='#1e293b';">
                            {{ $post->title }}
                        </h4>

                        {{-- Date --}}
                        <span style="font-size: 12px; color: #94a3b8;">
                            {{ $post->published_at->format('d F Y, H.i') }}
                        </span>
                    </article>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div style="text-align: center; padding: 60px; background: #f8fafc; border-radius: 12px;">
                <p style="color: #64748b;">Belum ada berita terbaru.</p>
            </div>
        @endif
    </div>
</section>
