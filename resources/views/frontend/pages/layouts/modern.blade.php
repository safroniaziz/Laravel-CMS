{{-- Modern Layout: Clean, minimalis, dengan spacing yang lega --}}
@php
    $sections = $page->page_builder_data ?? [];
    $accentColor = $page->accent_color ?? '#1e3a8a';
    $bgColor = $page->bg_color ?? '#ffffff';
    $textColor = $page->text_color ?? '#333333';

    $icons = [
        'star' => '⭐', 'check' => '✅', 'heart' => '❤️', 'rocket' => '🚀',
        'trophy' => '🏆', 'lightbulb' => '💡', 'users' => '👥', 'chart' => '📈',
        'shield' => '🛡️', 'clock' => '⏰', 'target' => '🎯', 'globe' => '🌐',
        'graduation' => '🎓', 'calendar' => '📅', 'building' => '🏢'
    ];

    $gradients = [
        'blue' => 'linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%)',
        'purple' => 'linear-gradient(135deg, #7c3aed 0%, #a855f7 100%)',
        'green' => 'linear-gradient(135deg, #059669 0%, #10b981 100%)',
        'orange' => 'linear-gradient(135deg, #ea580c 0%, #f97316 100%)',
        'dark' => 'linear-gradient(135deg, #1f2937 0%, #374151 100%)',
    ];

    $heights = ['small' => '40vh', 'medium' => '60vh', 'large' => '80vh', 'full' => '100vh'];
@endphp

<style>
.modern-page {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}
.modern-page .section {
    padding: 80px 0;
}
.modern-page .section-heading {
    font-size: 36px;
    font-weight: 800;
    color: {{ $accentColor }};
    margin-bottom: 15px;
}
.modern-page .section-subheading {
    font-size: 18px;
    color: #6b7280;
    max-width: 600px;
}
.modern-page .btn-primary-custom {
    background: {{ $accentColor }};
    color: #fff;
    padding: 14px 32px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
}
.modern-page .btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px {{ $accentColor }}40;
    color: #fff;
}
.modern-page .btn-secondary-custom {
    background: transparent;
    color: {{ $accentColor }};
    padding: 14px 32px;
    border: 2px solid {{ $accentColor }};
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
}
.modern-page .btn-secondary-custom:hover {
    background: {{ $accentColor }}10;
}
@media (max-width: 768px) {
    .modern-page .section { padding: 50px 0; }
    .modern-page .section-heading { font-size: 28px; }
}
</style>

<div class="modern-page" style="background: {{ $bgColor }}; color: {{ $textColor }};">

    {{-- ========== HERO SECTION ========== --}}
    @if(!empty($sections['hero']['enabled']))
    @php
        $hero = $sections['hero'];
        $heroHeight = $heights[$hero['height'] ?? 'medium'] ?? '60vh';
        $heroBgType = $hero['bg_type'] ?? 'color';
        $heroBg = match($heroBgType) {
            'gradient' => $gradients[$hero['gradient'] ?? 'blue'],
            'image' => "url('" . asset('storage/' . ($hero['bg_image'] ?? '')) . "')",
            default => $hero['bg_color'] ?? $accentColor
        };
    @endphp
    <section class="hero-section" style="min-height: {{ $heroHeight }}; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
        @if($heroBgType === 'image')
            <div style="position: absolute; inset: 0; background-image: {{ $heroBg }}; background-size: cover; background-position: center;"></div>
            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.7));"></div>
        @elseif($heroBgType === 'gradient')
            <div style="position: absolute; inset: 0; background: {{ $heroBg }};"></div>
        @else
            <div style="position: absolute; inset: 0; background: {{ $heroBg }};"></div>
        @endif

        <div class="container" style="position: relative; z-index: 10; text-align: center; padding: 40px 20px;">
            @if(!empty($hero['title']))
                <h1 style="font-size: clamp(32px, 6vw, 56px); font-weight: 900; color: #fff; margin: 0 0 20px; line-height: 1.1; text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
                    {{ $hero['title'] }}
                </h1>
            @endif
            @if(!empty($hero['subtitle']))
                <p style="font-size: clamp(16px, 2.5vw, 22px); color: rgba(255,255,255,0.9); margin: 0 auto 35px; max-width: 700px; line-height: 1.6;">
                    {{ $hero['subtitle'] }}
                </p>
            @endif
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                @if(!empty($hero['cta1_text']) && !empty($hero['cta1_link']))
                    <a href="{{ safe_url($hero['cta1_link']) }}" style="background: #fff; color: {{ $accentColor }}; padding: 16px 36px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 16px; transition: all 0.3s;">
                        {{ $hero['cta1_text'] }}
                    </a>
                @endif
                @if(!empty($hero['cta2_text']) && !empty($hero['cta2_link']))
                    <a href="{{ safe_url($hero['cta2_link']) }}" style="background: transparent; color: #fff; padding: 16px 36px; border: 2px solid rgba(255,255,255,0.8); border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 16px;">
                        {{ $hero['cta2_text'] }}
                    </a>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- ========== ABOUT SECTION ========== --}}
    @if(!empty($sections['about']['enabled']))
    @php $about = $sections['about']; @endphp
    <section class="section" style="background: {{ $bgColor }};">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; max-width: 1200px; margin: 0 auto;" class="about-grid">
                <div style="order: {{ ($about['image_position'] ?? 'right') === 'left' ? 2 : 1 }};">
                    @if(!empty($about['heading']))
                        <h2 class="section-heading">{{ $about['heading'] }}</h2>
                    @endif
                    @if(!empty($about['subheading']))
                        <p class="section-subheading" style="margin-bottom: 25px;">{{ $about['subheading'] }}</p>
                    @endif
                    @if(!empty($about['content']))
                        <div style="font-size: 16px; line-height: 1.8; color: {{ $textColor }}; margin-bottom: 30px;">
                            {!! nl2br(e($about['content'])) !!}
                        </div>
                    @endif
                    @if(!empty($about['btn_text']) && !empty($about['btn_link']))
                        <a href="{{ safe_url($about['btn_link']) }}" class="btn-primary-custom">
                            {{ $about['btn_text'] }} →
                        </a>
                    @endif
                </div>
                <div style="order: {{ ($about['image_position'] ?? 'right') === 'left' ? 1 : 2 }};">
                    @if(!empty($about['image']))
                        <img src="{{ asset('storage/' . $about['image']) }}" alt="{{ $about['heading'] ?? 'About' }}" style="width: 100%; border-radius: 20px; box-shadow: 0 25px 50px rgba(0,0,0,0.15);">
                    @else
                        <div style="background: linear-gradient(135deg, {{ $accentColor }}20, {{ $accentColor }}40); border-radius: 20px; padding: 80px; text-align: center;">
                            <span style="font-size: 80px;">📖</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <style>
        @media (max-width: 768px) {
            .about-grid { display: block !important; }
            .about-grid > div { margin-bottom: 30px; order: unset !important; }
        }
    </style>
    @endif

    {{-- ========== FEATURES SECTION ========== --}}
    @if(!empty($sections['features']['enabled']) && !empty($sections['features']['items']))
    @php
        $features = $sections['features'];
        $featureStyle = $features['style'] ?? 'cards';
    @endphp
    <section class="section" style="background: {{ $accentColor }}08;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 50px;">
                @if(!empty($features['heading']))
                    <h2 class="section-heading">{{ $features['heading'] }}</h2>
                @endif
                @if(!empty($features['subheading']))
                    <p class="section-subheading" style="margin: 0 auto;">{{ $features['subheading'] }}</p>
                @endif
            </div>

            @if($featureStyle === 'cards')
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; max-width: 1200px; margin: 0 auto;">
                @foreach($features['items'] as $item)
                <div style="background: #fff; padding: 40px 30px; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.3s ease; border-top: 4px solid {{ $accentColor }};">
                    <div style="width: 70px; height: 70px; background: {{ $accentColor }}15; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 32px; margin-bottom: 25px;">
                        {{ $icons[$item['icon'] ?? 'star'] ?? '⭐' }}
                    </div>
                    <h3 style="color: {{ $textColor }}; font-size: 20px; font-weight: 700; margin: 0 0 15px;">{{ $item['title'] ?? '' }}</h3>
                    <p style="color: #6b7280; margin: 0; line-height: 1.7;">{{ $item['text'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
            @elseif($featureStyle === 'icons')
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; max-width: 1200px; margin: 0 auto;">
                @foreach($features['items'] as $item)
                <div style="text-align: center;">
                    <div style="font-size: 60px; margin-bottom: 20px;">{{ $icons[$item['icon'] ?? 'star'] ?? '⭐' }}</div>
                    <h3 style="color: {{ $accentColor }}; font-size: 20px; font-weight: 700; margin: 0 0 12px;">{{ $item['title'] ?? '' }}</h3>
                    <p style="color: #6b7280; margin: 0; line-height: 1.6;">{{ $item['text'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
            @elseif($featureStyle === 'list')
            <div style="max-width: 800px; margin: 0 auto;">
                @foreach($features['items'] as $item)
                <div style="display: flex; gap: 20px; align-items: flex-start; padding: 25px 0; border-bottom: 1px solid #e5e7eb;">
                    <div style="font-size: 32px; flex-shrink: 0;">{{ $icons[$item['icon'] ?? 'check'] ?? '✅' }}</div>
                    <div>
                        <h3 style="color: {{ $textColor }}; font-size: 18px; font-weight: 700; margin: 0 0 8px;">{{ $item['title'] ?? '' }}</h3>
                        <p style="color: #6b7280; margin: 0; line-height: 1.6;">{{ $item['text'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else {{-- grid --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; max-width: 1200px; margin: 0 auto;">
                @foreach($features['items'] as $item)
                <div style="background: #fff; padding: 30px; border-radius: 12px; display: flex; gap: 20px; align-items: flex-start;">
                    <div style="width: 50px; height: 50px; background: {{ $accentColor }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">
                        {{ $icons[$item['icon'] ?? 'star'] ?? '⭐' }}
                    </div>
                    <div>
                        <h3 style="color: {{ $textColor }}; font-size: 17px; font-weight: 700; margin: 0 0 8px;">{{ $item['title'] ?? '' }}</h3>
                        <p style="color: #6b7280; margin: 0; font-size: 14px; line-height: 1.6;">{{ $item['text'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ========== CONTENT BLOCKS SECTION ========== --}}
    @if(!empty($sections['content']['enabled']) && !empty($sections['content']['blocks']))
    @php $contentBlocks = $sections['content']['blocks']; @endphp
    <section class="section">
        <div class="container">
            @foreach($contentBlocks as $index => $block)
            @php $imgPos = $block['image_position'] ?? 'right'; @endphp
            <div style="display: grid; grid-template-columns: {{ in_array($imgPos, ['left', 'right']) ? '1fr 1fr' : '1fr' }}; gap: 50px; align-items: center; max-width: 1100px; margin: 0 auto {{ $loop->last ? '0' : '60px' }};" class="content-block-grid">
                @if($imgPos === 'top' && !empty($block['image']))
                    <div style="grid-column: 1 / -1;">
                        <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="width: 100%; border-radius: 16px; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
                    </div>
                @endif

                <div style="order: {{ $imgPos === 'left' ? 2 : 1 }};">
                    @if(!empty($block['heading']))
                        <h3 style="color: {{ $accentColor }}; font-size: 28px; font-weight: 700; margin: 0 0 20px;">{{ $block['heading'] }}</h3>
                    @endif
                    @if(!empty($block['text']))
                        <div style="color: {{ $textColor }}; font-size: 16px; line-height: 1.8;">
                            {!! nl2br(e($block['text'])) !!}
                        </div>
                    @endif
                </div>

                @if(in_array($imgPos, ['left', 'right']) && !empty($block['image']))
                <div style="order: {{ $imgPos === 'left' ? 1 : 2 }};">
                    <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="width: 100%; border-radius: 16px; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
                </div>
                @endif

                @if($imgPos === 'bottom' && !empty($block['image']))
                    <div style="grid-column: 1 / -1;">
                        <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="width: 100%; border-radius: 16px; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </section>
    <style>
        @media (max-width: 768px) {
            .content-block-grid { display: block !important; }
            .content-block-grid > div { margin-bottom: 25px; order: unset !important; }
        }
    </style>
    @endif

    {{-- ========== GALLERY SECTION ========== --}}
    @if(!empty($sections['gallery']['enabled']) && !empty($sections['gallery']['images']))
    @php
        $gallery = $sections['gallery'];
        $columns = $gallery['columns'] ?? 3;
    @endphp
    <section class="section" style="background: {{ $accentColor }}05;">
        <div class="container">
            @if(!empty($gallery['heading']))
                <div style="text-align: center; margin-bottom: 40px;">
                    <h2 class="section-heading">{{ $gallery['heading'] }}</h2>
                </div>
            @endif
            <div style="display: grid; grid-template-columns: repeat({{ $columns }}, 1fr); gap: 20px; max-width: 1200px; margin: 0 auto;">
                @foreach($gallery['images'] as $image)
                <div style="aspect-ratio: 1; overflow: hidden; border-radius: 12px; cursor: pointer;" onclick="openLightbox('{{ asset('storage/' . $image) }}')">
                    <img src="{{ asset('storage/' . $image) }}" alt="Gallery" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ========== STATS SECTION ========== --}}
    @if(!empty($sections['stats']['enabled']) && !empty($sections['stats']['items']))
    @php
        $stats = $sections['stats'];
        $statsBg = match($stats['bg_style'] ?? 'light') {
            'colored' => $accentColor,
            'dark' => '#1f2937',
            default => '#f9fafb'
        };
        $statsText = in_array($stats['bg_style'] ?? 'light', ['colored', 'dark']) ? '#fff' : $textColor;
    @endphp
    <section class="section" style="background: {{ $statsBg }};">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; max-width: 1000px; margin: 0 auto; text-align: center;">
                @foreach($stats['items'] as $item)
                <div>
                    @if(!empty($item['icon']))
                        <div style="font-size: 40px; margin-bottom: 10px;">{{ $icons[$item['icon']] ?? '' }}</div>
                    @endif
                    <div style="font-size: 48px; font-weight: 900; color: {{ $statsText }}; line-height: 1;">{{ $item['number'] ?? '' }}</div>
                    <div style="font-size: 16px; color: {{ in_array($stats['bg_style'] ?? 'light', ['colored', 'dark']) ? 'rgba(255,255,255,0.8)' : '#6b7280' }}; margin-top: 8px;">{{ $item['label'] ?? '' }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ========== TEAM SECTION ========== --}}
    @if(!empty($sections['team']['enabled']) && !empty($sections['team']['items']))
    @php $team = $sections['team']; @endphp
    <section class="section">
        <div class="container">
            <div style="text-align: center; margin-bottom: 50px;">
                @if(!empty($team['heading']))
                    <h2 class="section-heading">{{ $team['heading'] }}</h2>
                @endif
                @if(!empty($team['subheading']))
                    <p class="section-subheading" style="margin: 0 auto;">{{ $team['subheading'] }}</p>
                @endif
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 30px; max-width: 1100px; margin: 0 auto;">
                @foreach($team['items'] as $member)
                <div style="text-align: center; background: #fff; padding: 35px 25px; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.06);">
                    <div style="width: 120px; height: 120px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; border: 4px solid {{ $accentColor }}20;">
                        @if(!empty($member['photo']))
                            <img src="{{ asset('storage/' . $member['photo']) }}" alt="{{ $member['name'] ?? '' }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: {{ $accentColor }}20; display: flex; align-items: center; justify-content: center; font-size: 40px;">👤</div>
                        @endif
                    </div>
                    <h3 style="color: {{ $textColor }}; font-size: 20px; font-weight: 700; margin: 0 0 5px;">{{ $member['name'] ?? '' }}</h3>
                    <p style="color: {{ $accentColor }}; font-size: 14px; font-weight: 600; margin: 0 0 15px;">{{ $member['position'] ?? '' }}</p>
                    @if(!empty($member['bio']))
                        <p style="color: #6b7280; font-size: 14px; line-height: 1.6; margin: 0;">{{ $member['bio'] }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ========== TESTIMONIALS SECTION ========== --}}
    @if(!empty($sections['testimonials']['enabled']) && !empty($sections['testimonials']['items']))
    @php
        $testimonials = $sections['testimonials'];
        $testiStyle = $testimonials['style'] ?? 'cards';
    @endphp
    <section class="section" style="background: {{ $accentColor }}08;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 50px;">
                @if(!empty($testimonials['heading']))
                    <h2 class="section-heading">{{ $testimonials['heading'] }}</h2>
                @endif
            </div>

            @if($testiStyle === 'quotes')
            <div style="max-width: 800px; margin: 0 auto;">
                @foreach($testimonials['items'] as $testi)
                <div style="text-align: center; margin-bottom: 50px; padding: 40px;">
                    <div style="font-size: 60px; color: {{ $accentColor }}30; line-height: 1;">"</div>
                    <p style="font-size: 22px; font-style: italic; color: {{ $textColor }}; line-height: 1.7; margin: -20px 0 30px;">{{ $testi['quote'] ?? '' }}</p>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 15px;">
                        @if(!empty($testi['photo']))
                            <img src="{{ asset('storage/' . $testi['photo']) }}" alt="{{ $testi['name'] ?? '' }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                        @endif
                        <div style="text-align: left;">
                            <div style="font-weight: 700; color: {{ $textColor }};">{{ $testi['name'] ?? '' }}</div>
                            <div style="font-size: 14px; color: #6b7280;">{{ $testi['title'] ?? '' }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; max-width: 1100px; margin: 0 auto;">
                @foreach($testimonials['items'] as $testi)
                <div style="background: #fff; padding: 30px; border-radius: 16px; box-shadow: 0 8px 30px rgba(0,0,0,0.06);">
                    <p style="font-size: 16px; color: {{ $textColor }}; line-height: 1.7; margin: 0 0 25px; font-style: italic;">"{{ $testi['quote'] ?? '' }}"</p>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        @if(!empty($testi['photo']))
                            <img src="{{ asset('storage/' . $testi['photo']) }}" alt="{{ $testi['name'] ?? '' }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                        @else
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: {{ $accentColor }}20; display: flex; align-items: center; justify-content: center;">👤</div>
                        @endif
                        <div>
                            <div style="font-weight: 700; color: {{ $textColor }}; font-size: 15px;">{{ $testi['name'] ?? '' }}</div>
                            <div style="font-size: 13px; color: {{ $accentColor }};">{{ $testi['title'] ?? '' }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ========== FAQ SECTION ========== --}}
    @if(!empty($sections['faq']['enabled']) && !empty($sections['faq']['items']))
    @php $faq = $sections['faq']; @endphp
    <section class="section">
        <div class="container">
            <div style="text-align: center; margin-bottom: 50px;">
                @if(!empty($faq['heading']))
                    <h2 class="section-heading">{{ $faq['heading'] }}</h2>
                @endif
            </div>
            <div style="max-width: 800px; margin: 0 auto;">
                @foreach($faq['items'] as $index => $item)
                <div style="border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 15px; overflow: hidden;">
                    <div onclick="toggleFaq({{ $index }})" style="padding: 20px 25px; background: #fff; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600; color: {{ $textColor }}; font-size: 16px;">{{ $item['question'] ?? '' }}</span>
                        <span id="faq-icon-{{ $index }}" style="font-size: 20px; transition: transform 0.3s;">+</span>
                    </div>
                    <div id="faq-answer-{{ $index }}" style="display: none; padding: 0 25px 20px; background: #fff;">
                        <p style="margin: 0; color: #6b7280; line-height: 1.7;">{{ $item['answer'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        function toggleFaq(index) {
            const answer = document.getElementById('faq-answer-' + index);
            const icon = document.getElementById('faq-icon-' + index);
            if (answer.style.display === 'none') {
                answer.style.display = 'block';
                icon.textContent = '−';
            } else {
                answer.style.display = 'none';
                icon.textContent = '+';
            }
        }
    </script>
    @endif

    {{-- ========== CTA SECTION ========== --}}
    @if(!empty($sections['cta']['enabled']))
    @php
        $cta = $sections['cta'];
        $ctaBg = match($cta['bg_style'] ?? 'gradient') {
            'solid' => $accentColor,
            'image' => "url('" . asset('storage/' . ($cta['bg_image'] ?? '')) . "')",
            default => "linear-gradient(135deg, " . $accentColor . " 0%, " . $accentColor . "cc 100%)"
        };
    @endphp
    <section style="background: {{ $ctaBg }}; padding: 80px 20px; text-align: center; position: relative;">
        @if($cta['bg_style'] === 'image')
            <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.6);"></div>
        @endif
        <div class="container" style="position: relative; z-index: 10;">
            @if(!empty($cta['heading']))
                <h2 style="font-size: 36px; font-weight: 800; color: #fff; margin: 0 0 15px;">{{ $cta['heading'] }}</h2>
            @endif
            @if(!empty($cta['subheading']))
                <p style="font-size: 18px; color: rgba(255,255,255,0.9); margin: 0 auto 35px; max-width: 600px;">{{ $cta['subheading'] }}</p>
            @endif
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                @if(!empty($cta['btn1_text']) && !empty($cta['btn1_link']))
                    <a href="{{ safe_url($cta['btn1_link']) }}" style="background: #fff; color: {{ $accentColor }}; padding: 16px 40px; border-radius: 50px; text-decoration: none; font-weight: 700;">
                        {{ $cta['btn1_text'] }}
                    </a>
                @endif
                @if(!empty($cta['btn2_text']) && !empty($cta['btn2_link']))
                    <a href="{{ safe_url($cta['btn2_link']) }}" style="background: transparent; color: #fff; padding: 16px 40px; border: 2px solid rgba(255,255,255,0.8); border-radius: 50px; text-decoration: none; font-weight: 600;">
                        {{ $cta['btn2_text'] }}
                    </a>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- Fallback if no sections enabled --}}
    @if(empty($sections) || !collect($sections)->pluck('enabled')->filter()->count())
    <section class="section">
        <div class="container" style="max-width: 800px; text-align: center;">
            <h1 style="font-size: 42px; font-weight: 800; color: {{ $accentColor }}; margin-bottom: 20px;">{{ $page->title }}</h1>
            @if($page->subtitle)
                <p style="font-size: 18px; color: #6b7280; margin-bottom: 30px;">{{ $page->subtitle }}</p>
            @endif
            @if($page->content)
                <div style="font-size: 16px; line-height: 1.8; color: {{ $textColor }}; text-align: left;">
                    {!! nl2br(e($page->content)) !!}
                </div>
            @endif
        </div>
    </section>
    @endif

</div>
