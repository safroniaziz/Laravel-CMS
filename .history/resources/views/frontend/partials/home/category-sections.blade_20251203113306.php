@php
    // Fetch category sections settings from database
    try {
        $categoryLayoutStyle = App\Models\Setting::where('key', 'category_layout_style')->value('value') ?? 'current';
        $categoryAccentColor = App\Models\Setting::where('key', 'category_accent_color')->value('value') ?? '#f97316';
        $categoryPrimaryColor = App\Models\Setting::where('key', 'category_primary_color')->value('value') ?? '#1a246a';

        // Fetch category titles and slugs from settings
        $category1 = [
            'title' => App\Models\Setting::where('key', 'category_section_title_1')->value('value') ?? 'Pendidikan',
            'slug' => App\Models\Setting::where('key', 'category_section_slug_1')->value('value') ?? 'akademik',
        ];
        $category2 = [
            'title' => App\Models\Setting::where('key', 'category_section_title_2')->value('value') ?? 'Prestasi',
            'slug' => App\Models\Setting::where('key', 'category_section_slug_2')->value('value') ?? 'prestasi',
        ];
        $category3 = [
            'title' => App\Models\Setting::where('key', 'category_section_title_3')->value('value') ?? 'Penelitian dan Inovasi',
            'slug' => App\Models\Setting::where('key', 'category_section_slug_3')->value('value') ?? 'penelitian',
        ];
    } catch (\Exception $e) {
        $categoryLayoutStyle = 'current';
        $categoryAccentColor = '#f97316';
        $categoryPrimaryColor = '#1a246a';
        $category1 = ['title' => 'Pendidikan', 'slug' => 'akademik'];
        $category2 = ['title' => 'Prestasi', 'slug' => 'prestasi'];
        $category3 = ['title' => 'Penelitian dan Inovasi', 'slug' => 'penelitian'];
    }

    // Fetch posts from database (NO DUMMY DATA)
    $getCategoryPosts = function($slug) {
        try {
            return App\Models\Post::where('status', 'published')
                ->whereHas('category', function($q) use ($slug) {
                    $q->where('slug', $slug);
                })
                ->with('category')
                ->latest('published_at')
                ->take(3)
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    };

    $pendidikanPosts = $getCategoryPosts($category1['slug']);
    $prestasiPosts = $getCategoryPosts($category2['slug']);
    $penelitianPosts = $getCategoryPosts($category3['slug']);

    $categories = [
        ['title' => $category1['title'], 'posts' => $pendidikanPosts, 'slug' => $category1['slug']],
        ['title' => $category2['title'], 'posts' => $prestasiPosts, 'slug' => $category2['slug']],
        ['title' => $category3['title'], 'posts' => $penelitianPosts, 'slug' => $category3['slug']],
    ];
@endphp

{{-- Category Sections - Dynamic Layout --}}
<section style="padding: 60px 0 80px 0; background: #fff; border-top: 1px solid #f1f5f9;">
    <div class="container">
        @if($categoryLayoutStyle === 'current')
        {{-- LAYOUT 1: Current 3-Column --}}
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px;" data-aos="fade-up">
            @foreach($categories as $category)
                <div style="display: flex; flex-direction: column; height: 100%;">
                    {{-- Header --}}
                    <div style="margin-bottom: 24px; position: relative; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px;">
                        <h3 style="font-size: 24px; font-weight: 700; color: {{ $categoryPrimaryColor }}; margin: 0; font-family: 'Outfit', sans-serif;">
                            {{ $category['title'] }}
                        </h3>
                        {{-- Accent Line --}}
                        <div style="position: absolute; bottom: -1px; left: 0; width: 60px; height: 3px; background: {{ $categoryAccentColor }};"></div>
                    </div>

                    @if($category['posts']->count() > 0)
                        {{-- Main Post (Large) --}}
                        @php $mainPost = $category['posts']->first(); @endphp
                        <article onclick="window.location='{{ route('blog.show', $mainPost->slug) }}'"
                                 style="cursor: pointer; margin-bottom: 24px; group: hover;">
                            <div style="height: 200px; overflow: hidden; border-radius: 8px; margin-bottom: 16px; position: relative;">
                                @if($mainPost->featured_image)
                                    <img src="{{ $mainPost->featured_image }}" alt="{{ $mainPost->title }}"
                                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;"
                                         onmouseover="this.style.transform='scale(1.05)';"
                                         onmouseout="this.style.transform='scale(1)';">
                                @else
                                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a246a, #2563eb); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-newspaper" style="font-size: 40px; color: rgba(255, 255, 255, 0.3);"></i>
                                    </div>
                                @endif
                            </div>
                            <h4 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0; line-height: 1.4; transition: color 0.3s ease;" onmouseover="this.style.color='{{ $categoryPrimaryColor }}';" onmouseout="this.style.color='#1e293b';">
                                {{ $mainPost->title }}
                            </h4>
                            <div style="font-size: 13px; color: #64748b;">
                                {{ $mainPost->published_at->format('d F Y, H.i') }}
                            </div>
                        </article>

                        {{-- Small Posts (List Items) --}}
                        <div style="flex: 1; display: flex; flex-direction: column; gap: 20px;">
                            @foreach($category['posts']->skip(1)->take(2) as $smallPost)
                                <article onclick="window.location='{{ route('blog.show', $smallPost->slug) }}'"
                                         style="display: flex; gap: 16px; cursor: pointer; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                                    <div style="flex-shrink: 0; width: 80px; height: 60px; border-radius: 6px; overflow: hidden;">
                                        @if($smallPost->featured_image)
                                            <img src="{{ $smallPost->featured_image }}" alt="{{ $smallPost->title }}"
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div style="width: 100%; height: 100%; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-image" style="color: #cbd5e1;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h5 style="font-size: 14px; font-weight: 600; color: #1e293b; margin: 0 0 6px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s ease;" onmouseover="this.style.color='{{ $categoryPrimaryColor }}';" onmouseout="this.style.color='#1e293b';">
                                            {{ $smallPost->title }}
                                        </h5>
                                        <div style="font-size: 12px; color: #94a3b8;">
                                            {{ $smallPost->published_at->format('d F Y, H.i') }}
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        {{-- See All Button --}}
                        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                            <a href="{{ route('blog.index') }}?category={{ $category['slug'] }}" style="display: flex; align-items: center; justify-content: center; width: 100%; padding: 10px 0; border: 1px solid {{ $categoryPrimaryColor }}; border-radius: 6px; color: {{ $categoryPrimaryColor }}; font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.3s ease;"
                               onmouseover="this.style.background='{{ $categoryPrimaryColor }}'; this.style.color='#fff';"
                               onmouseout="this.style.background='transparent'; this.style.color='{{ $categoryPrimaryColor }}';">
                                LIHAT SEMUA
                                <i class="fas fa-arrow-right" style="margin-left: 8px; font-size: 11px;"></i>
                            </a>
                        </div>
                    @else
                        <div style="padding: 20px; background: #f8fafc; border-radius: 8px; text-align: center; color: #94a3b8; font-size: 14px;">
                            Belum ada berita
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @elseif($categoryLayoutStyle === 'grid')
        {{-- LAYOUT 2: Grid Cards --}}
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;" data-aos="fade-up">
            @foreach($categories as $category)
                <div style="background: #fff; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; transition: all 0.3s ease;"
                     onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'; this.style.borderColor='{{ $categoryAccentColor }}';"
                     onmouseout="this.style.boxShadow='none'; this.style.borderColor='#e2e8f0';">
                    {{-- Header --}}
                    <div style="padding: 24px; border-bottom: 1px solid #e2e8f0; background: linear-gradient(135deg, #f8fafc, #fff);">
                        <h3 style="font-size: 22px; font-weight: 700; color: #1a246a; margin: 0; font-family: 'Outfit', sans-serif;">
                            {{ $category['title'] }}
                        </h3>
                        <div style="width: 50px; height: 3px; background: {{ $categoryAccentColor }}; margin-top: 12px;"></div>
                    </div>

                    <div style="padding: 24px;">
                        @if($category['posts']->count() > 0)
                            @foreach($category['posts'] as $post)
                            <article onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                                     style="cursor: pointer; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9; transition: all 0.3s ease;"
                                     onmouseover="this.style.paddingLeft='8px';"
                                     onmouseout="this.style.paddingLeft='0';">
                                @if($post->featured_image)
                                <div style="height: 120px; border-radius: 8px; overflow: hidden; margin-bottom: 12px;">
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;"
                                         onmouseover="this.style.transform='scale(1.1)';"
                                         onmouseout="this.style.transform='scale(1)';">
                                </div>
                                @endif
                                <h4 style="font-size: 15px; font-weight: 600; color: #1e293b; margin: 0 0 8px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $post->title }}
                                </h4>
                                <div style="font-size: 12px; color: #94a3b8;">
                                    {{ $post->published_at->format('d M Y') }}
                                </div>
                            </article>
                            @endforeach

                            <a href="{{ route('blog.index') }}?category={{ $category['slug'] }}" style="display: flex; align-items: center; justify-content: center; width: 100%; padding: 10px 0; border: 1px solid {{ $categoryAccentColor }}; border-radius: 6px; color: {{ $categoryAccentColor }}; font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.3s ease;"
                               onmouseover="this.style.background='{{ $categoryAccentColor }}'; this.style.color='#fff';"
                               onmouseout="this.style.background='transparent'; this.style.color='{{ $categoryAccentColor }}';">
                                LIHAT SEMUA
                                <i class="fas fa-arrow-right" style="margin-left: 8px; font-size: 11px;"></i>
                            </a>
                        @else
                            <div style="padding: 20px; text-align: center; color: #94a3b8; font-size: 14px;">
                                Belum ada berita
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @elseif($categoryLayoutStyle === 'list')
        {{-- LAYOUT 3: List View --}}
        <div style="display: flex; flex-direction: column; gap: 40px;" data-aos="fade-up">
            @foreach($categories as $category)
                <div>
                    {{-- Header --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 2px solid {{ $categoryAccentColor }};">
                        <h3 style="font-size: 28px; font-weight: 700; color: #1a246a; margin: 0; font-family: 'Outfit', sans-serif;">
                            {{ $category['title'] }}
                        </h3>
                        <a href="{{ route('blog.index') }}?category={{ $category['slug'] }}" style="font-size: 14px; font-weight: 600; color: {{ $categoryAccentColor }}; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                            Lihat Semua
                            <i class="fas fa-arrow-right" style="font-size: 12px;"></i>
                        </a>
                    </div>

                    @if($category['posts']->count() > 0)
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                            @foreach($category['posts'] as $post)
                            <article onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                                     style="cursor: pointer; transition: all 0.3s ease;"
                                     onmouseover="this.style.transform='translateY(-4px)';"
                                     onmouseout="this.style.transform='translateY(0)';">
                                @if($post->featured_image)
                                <div style="height: 160px; border-radius: 8px; overflow: hidden; margin-bottom: 12px;">
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;"
                                         onmouseover="this.style.transform='scale(1.1)';"
                                         onmouseout="this.style.transform='scale(1)';">
                                </div>
                                @endif
                                <h4 style="font-size: 16px; font-weight: 600; color: #1e293b; margin: 0 0 8px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $post->title }}
                                </h4>
                                <div style="font-size: 12px; color: #94a3b8;">
                                    {{ $post->published_at->format('d M Y') }}
                                </div>
                            </article>
                            @endforeach
                        </div>
                    @else
                        <div style="padding: 40px; background: #f8fafc; border-radius: 8px; text-align: center; color: #94a3b8; font-size: 14px;">
                            Belum ada berita
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @elseif($categoryLayoutStyle === 'tabs')
        {{-- LAYOUT 4: Tabs View --}}
        <div data-aos="fade-up">
            {{-- Tab Navigation --}}
            <div style="display: flex; gap: 8px; margin-bottom: 30px; border-bottom: 2px solid #e2e8f0;">
                @foreach($categories as $index => $category)
                <button class="category-tab-btn" data-tab="{{ $index }}"
                        style="padding: 12px 24px; background: transparent; border: none; border-bottom: 3px solid {{ $index === 0 ? $categoryAccentColor : 'transparent' }}; color: {{ $index === 0 ? '#1a246a' : '#64748b' }}; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;"
                        onmouseover="this.style.color='#1a246a';"
                        onmouseout="if({{ $index }} !== 0) this.style.color='#64748b';">
                    {{ $category['title'] }}
                </button>
                @endforeach
            </div>

            {{-- Tab Content --}}
            @foreach($categories as $index => $category)
            <div class="category-tab-content" data-tab="{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                @if($category['posts']->count() > 0)
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                        {{-- Featured Post --}}
                        @php $featuredPost = $category['posts']->first(); @endphp
                        <article onclick="window.location='{{ route('blog.show', $featuredPost->slug) }}'"
                                 style="cursor: pointer; grid-row: span 2;">
                            @if($featuredPost->featured_image)
                            <div style="height: 300px; border-radius: 12px; overflow: hidden; margin-bottom: 16px;">
                                <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}"
                                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;"
                                     onmouseover="this.style.transform='scale(1.05)';"
                                     onmouseout="this.style.transform='scale(1)';">
                            </div>
                            @endif
                            <h3 style="font-size: 22px; font-weight: 700; color: #1a246a; margin: 0 0 12px 0; line-height: 1.3;">
                                {{ $featuredPost->title }}
                            </h3>
                            <div style="font-size: 14px; color: #64748b;">
                                {{ $featuredPost->published_at->format('d F Y, H.i') }}
                            </div>
                        </article>

                        {{-- Other Posts --}}
                        <div style="display: flex; flex-direction: column; gap: 20px;">
                            @foreach($category['posts']->skip(1) as $post)
                            <article onclick="window.location='{{ route('blog.show', $post->slug) }}'"
                                     style="cursor: pointer; display: flex; gap: 16px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
                                @if($post->featured_image)
                                <div style="width: 120px; height: 80px; border-radius: 8px; overflow: hidden; flex-shrink: 0;">
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                @endif
                                <div>
                                    <h4 style="font-size: 15px; font-weight: 600; color: #1e293b; margin: 0 0 6px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $post->title }}
                                    </h4>
                                    <div style="font-size: 12px; color: #94a3b8;">
                                        {{ $post->published_at->format('d M Y') }}
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div style="padding: 40px; background: #f8fafc; border-radius: 8px; text-align: center; color: #94a3b8; font-size: 14px;">
                        Belum ada berita
                    </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<script>
// Tab functionality for category sections
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.category-tab-btn');
    const tabContents = document.querySelectorAll('.category-tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabIndex = this.getAttribute('data-tab');

            // Update buttons
            tabButtons.forEach((btn, index) => {
                btn.style.borderBottomColor = index == tabIndex ? '{{ $categoryAccentColor }}' : 'transparent';
                btn.style.color = index == tabIndex ? '#1a246a' : '#64748b';
            });

            // Update contents
            tabContents.forEach((content, index) => {
                content.style.display = index == tabIndex ? 'block' : 'none';
            });
        });
    });
});
</script>
