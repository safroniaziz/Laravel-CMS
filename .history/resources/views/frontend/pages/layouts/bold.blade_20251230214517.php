{{-- Bold Layout: Warna kontras, font besar, berani --}}
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
@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap');
.bold-page {
    font-family: 'Space Grotesk', sans-serif;
}
.bold-page .section {
    padding: 100px 0;
}
.bold-page .section-heading {
    font-size: 48px;
    font-weight: 700;
    color: {{ $accentColor }};
    margin-bottom: 20px;
    line-height: 1.1;
}
.bold-page .section-subheading {
    font-size: 20px;
    color: #6b7280;
    max-width: 650px;
}
.bold-page .btn-bold {
    background: {{ $accentColor }};
    color: #fff;
    padding: 18px 40px;
    border-radius: 0;
    text-decoration: none;
    font-weight: 700;
    font-size: 16px;
    display: inline-block;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 2px;
}
.bold-page .btn-bold:hover {
    transform: translateX(10px);
    background: {{ $textColor }};
}
.bold-page .highlight-box {
    background: {{ $accentColor }};
    padding: 5px 15px;
    color: #fff;
    display: inline-block;
    font-weight: 700;
}
@media (max-width: 768px) {
    .bold-page .section { padding: 60px 0; }
    .bold-page .section-heading { font-size: 36px; }
}
</style>

<div class="bold-page" style="background: {{ $bgColor }}; color: {{ $textColor }};">

    {{-- ========== HERO SECTION ========== --}}
    @if(!empty($sections['hero']['enabled']))
    @php
        $hero = $sections['hero'];
        $heroHeight = $heights[$hero['height'] ?? 'medium'] ?? '60vh';
        $heroBgType = $hero['bg_type'] ?? 'color';
    @endphp
    <section style="min-height: {{ $heroHeight }}; display: flex; align-items: center; position: relative; overflow: hidden;">
        @if($heroBgType === 'image' && !empty($hero['bg_image']))
            <div style="position: absolute; inset: 0; background-image: url('{{ asset('storage/' . $hero['bg_image']) }}'); background-size: cover; background-position: center;"></div>
            <div style="position: absolute; inset: 0; background: linear-gradient(135deg, {{ $accentColor }}ee 0%, {{ $accentColor }}99 100%);"></div>
        @elseif($heroBgType === 'gradient')
            <div style="position: absolute; inset: 0; background: {{ $gradients[$hero['gradient'] ?? 'blue'] }};"></div>
        @else
            <div style="position: absolute; inset: 0; background: {{ $hero['bg_color'] ?? $accentColor }};"></div>
        @endif

        <div class="container" style="position: relative; z-index: 10; padding: 60px 20px;">
            <div style="max-width: 800px;">
                @if(!empty($hero['title']))
                    <h1 style="font-size: clamp(42px, 8vw, 72px); font-weight: 700; color: #fff; margin: 0 0 25px; line-height: 1.0; text-transform: uppercase; letter-spacing: -2px;">
                        {{ $hero['title'] }}
                    </h1>
                @endif
                @if(!empty($hero['subtitle']))
                    <p style="font-size: 22px; color: rgba(255,255,255,0.9); margin: 0 0 40px; line-height: 1.6; max-width: 600px;">
                        {{ $hero['subtitle'] }}
                    </p>
                @endif
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    @if(!empty($hero['cta1_text']) && !empty($hero['cta1_link']))
                        <a href="{{ $hero['cta1_link'] }}" style="background: #fff; color: {{ $accentColor }}; padding: 20px 45px; text-decoration: none; font-weight: 700; font-size: 16px; text-transform: uppercase; letter-spacing: 2px;">
                            {{ $hero['cta1_text'] }} →
                        </a>
                    @endif
                    @if(!empty($hero['cta2_text']) && !empty($hero['cta2_link']))
                        <a href="{{ $hero['cta2_link'] }}" style="background: transparent; color: #fff; padding: 20px 45px; border: 3px solid #fff; text-decoration: none; font-weight: 700; font-size: 16px; text-transform: uppercase; letter-spacing: 2px;">
                            {{ $hero['cta2_text'] }}
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Decorative element --}}
        <div style="position: absolute; right: -100px; bottom: -100px; width: 400px; height: 400px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
    </section>
    @endif

    {{-- ========== ABOUT SECTION ========== --}}
    @if(!empty($sections['about']['enabled']))
    @php $about = $sections['about']; @endphp
    <section class="section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; max-width: 1200px; margin: 0 auto;" class="bold-about-grid">
                <div style="order: {{ ($about['image_position'] ?? 'right') === 'left' ? 2 : 1 }};">
                    @if(!empty($about['heading']))
                        <h2 class="section-heading">{{ $about['heading'] }}</h2>
                    @endif
                    @if(!empty($about['subheading']))
                        <p class="highlight-box" style="margin-bottom: 25px;">{{ $about['subheading'] }}</p>
                    @endif
                    @if(!empty($about['content']))
                        <div style="font-size: 18px; line-height: 1.8; color: {{ $textColor }}; margin-bottom: 35px;">
                            {!! nl2br(e($about['content'])) !!}
                        </div>
                    @endif
                    @if(!empty($about['btn_text']) && !empty($about['btn_link']))
                        <a href="{{ $about['btn_link'] }}" class="btn-bold">
                            {{ $about['btn_text'] }} →
                        </a>
                    @endif
                </div>
                <div style="order: {{ ($about['image_position'] ?? 'right') === 'left' ? 1 : 2 }};">
                    @if(!empty($about['image']))
                        <div style="position: relative;">
                            <img src="{{ asset('storage/' . $about['image']) }}" alt="{{ $about['heading'] ?? '' }}" style="width: 100%;">
                            <div style="position: absolute; top: 20px; left: 20px; right: -20px; bottom: -20px; background: {{ $accentColor }}; z-index: -1;"></div>
                        </div>
                    @else
                        <div style="background: {{ $accentColor }}; padding: 100px; text-align: center;">
                            <span style="font-size: 100px;">📖</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <style>
        @media (max-width: 768px) {
            .bold-about-grid { display: block !important; }
            .bold-about-grid > div { margin-bottom: 40px; order: unset !important; }
        }
    </style>
    @endif

    {{-- ========== FEATURES SECTION ========== --}}
    @if(!empty($sections['features']['enabled']) && !empty($sections['features']['items']))
    @php $features = $sections['features']; @endphp
    <section class="section" style="background: {{ $accentColor }};">
        <div class="container">
            <div style="margin-bottom: 60px;">
                @if(!empty($features['heading']))
                    <h2 class="section-heading" style="color: #fff;">{{ $features['heading'] }}</h2>
                @endif
                @if(!empty($features['subheading']))
                    <p class="section-subheading" style="color: rgba(255,255,255,0.8);">{{ $features['subheading'] }}</p>
                @endif
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; max-width: 1200px;">
                @foreach($features['items'] as $index => $item)
                <div style="background: rgba(255,255,255,0.1); padding: 40px 35px; border-left: 5px solid #fff; transition: all 0.3s ease;">
                    <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                        <span style="font-size: 50px;">{{ $icons[$item['icon'] ?? 'star'] ?? '⭐' }}</span>
                        <span style="font-size: 60px; font-weight: 700; color: rgba(255,255,255,0.3);">0{{ $index + 1 }}</span>
                    </div>
                    <h3 style="color: #fff; font-size: 24px; font-weight: 700; margin: 0 0 15px; text-transform: uppercase;">{{ $item['title'] ?? '' }}</h3>
                    <p style="color: rgba(255,255,255,0.8); margin: 0; line-height: 1.7; font-size: 16px;">{{ $item['text'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
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
            <div style="display: grid; grid-template-columns: {{ in_array($imgPos, ['left', 'right']) ? '1fr 1fr' : '1fr' }}; gap: 60px; align-items: center; max-width: 1200px; margin: 0 auto {{ $loop->last ? '0' : '80px' }}; {{ $loop->iteration % 2 === 0 ? 'background: ' . $accentColor . '10; padding: 60px;' : '' }}" class="bold-content-grid">
                @if($imgPos === 'top' && !empty($block['image']))
                    <div style="grid-column: 1 / -1;">
                        <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="width: 100%;">
                    </div>
                @endif

                <div style="order: {{ $imgPos === 'left' ? 2 : 1 }};">
                    @if(!empty($block['heading']))
                        <h3 style="color: {{ $accentColor }}; font-size: 36px; font-weight: 700; margin: 0 0 25px; text-transform: uppercase;">{{ $block['heading'] }}</h3>
                    @endif
                    @if(!empty($block['text']))
                        <div style="color: {{ $textColor }}; font-size: 17px; line-height: 1.8;">
                            {!! nl2br(e($block['text'])) !!}
                        </div>
                    @endif
                </div>

                @if(in_array($imgPos, ['left', 'right']) && !empty($block['image']))
                <div style="order: {{ $imgPos === 'left' ? 1 : 2 }};">
                    <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="width: 100%;">
                </div>
                @endif

                @if($imgPos === 'bottom' && !empty($block['image']))
                    <div style="grid-column: 1 / -1;">
                        <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="width: 100%;">
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </section>
    <style>
        @media (max-width: 768px) {
            .bold-content-grid { display: block !important; padding: 30px !important; }
            .bold-content-grid > div { margin-bottom: 25px; order: unset !important; }
        }
    </style>
    @endif

    {{-- ========== GALLERY SECTION ========== --}}
    @if(!empty($sections['gallery']['enabled']) && !empty($sections['gallery']['images']))
    @php $gallery = $sections['gallery']; @endphp
    <section class="section" style="background: #111;">
        <div class="container">
            @if(!empty($gallery['heading']))
                <div style="margin-bottom: 50px;">
                    <h2 class="section-heading" style="color: #fff;">{{ $gallery['heading'] }}</h2>
                </div>
            @endif
            <div style="display: grid; grid-template-columns: repeat({{ $gallery['columns'] ?? 3 }}, 1fr); gap: 5px;">
                @foreach($gallery['images'] as $image)
                <div style="aspect-ratio: 1; overflow: hidden;">
                    <img src="{{ asset('storage/' . $image) }}" alt="Gallery" style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(50%); transition: all 0.3s ease;">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ========== STATS SECTION ========== --}}
    @if(!empty($sections['stats']['enabled']) && !empty($sections['stats']['items']))
    @php $stats = $sections['stats']; @endphp
    <section class="section" style="background: #fff;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; max-width: 1000px; margin: 0 auto;">
                @foreach($stats['items'] as $item)
                <div style="text-align: center; padding: 30px;">
                    @if(!empty($item['icon']))
                        <div style="font-size: 50px; margin-bottom: 15px;">{{ $icons[$item['icon']] ?? '' }}</div>
                    @endif
                    <div style="font-size: 72px; font-weight: 700; color: {{ $accentColor }}; line-height: 1;">{{ $item['number'] ?? '' }}</div>
                    <div style="font-size: 16px; color: {{ $textColor }}; margin-top: 10px; text-transform: uppercase; letter-spacing: 3px; font-weight: 600;">{{ $item['label'] ?? '' }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ========== TEAM SECTION ========== --}}
    @if(!empty($sections['team']['enabled']) && !empty($sections['team']['items']))
    @php $team = $sections['team']; @endphp
    <section class="section" style="background: {{ $accentColor }}10;">
        <div class="container">
            <div style="margin-bottom: 60px;">
                @if(!empty($team['heading']))
                    <h2 class="section-heading">{{ $team['heading'] }}</h2>
                @endif
                @if(!empty($team['subheading']))
                    <p class="section-subheading">{{ $team['subheading'] }}</p>
                @endif
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; max-width: 1200px;">
                @foreach($team['items'] as $member)
                <div style="background: #fff; overflow: hidden;">
                    <div style="height: 300px; overflow: hidden;">
                        @if(!empty($member['photo']))
                            <img src="{{ asset('storage/' . $member['photo']) }}" alt="{{ $member['name'] ?? '' }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: {{ $accentColor }}; display: flex; align-items: center; justify-content: center; font-size: 80px;">👤</div>
                        @endif
                    </div>
                    <div style="padding: 30px;">
                        <h3 style="color: {{ $textColor }}; font-size: 22px; font-weight: 700; margin: 0 0 5px; text-transform: uppercase;">{{ $member['name'] ?? '' }}</h3>
                        <p style="color: {{ $accentColor }}; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin: 0 0 15px;">{{ $member['position'] ?? '' }}</p>
                        @if(!empty($member['bio']))
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.7; margin: 0;">{{ $member['bio'] }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ========== TESTIMONIALS SECTION ========== --}}
    @if(!empty($sections['testimonials']['enabled']) && !empty($sections['testimonials']['items']))
    @php $testimonials = $sections['testimonials']; @endphp
    <section class="section" style="background: #111; color: #fff;">
        <div class="container">
            <div style="margin-bottom: 60px;">
                @if(!empty($testimonials['heading']))
                    <h2 class="section-heading" style="color: #fff;">{{ $testimonials['heading'] }}</h2>
                @endif
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px; max-width: 1200px;">
                @foreach($testimonials['items'] as $testi)
                <div style="background: rgba(255,255,255,0.05); padding: 40px; border-left: 5px solid {{ $accentColor }};">
                    <p style="font-size: 20px; color: #fff; line-height: 1.7; margin: 0 0 30px;">"{{ $testi['quote'] ?? '' }}"</p>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        @if(!empty($testi['photo']))
                            <img src="{{ asset('storage/' . $testi['photo']) }}" alt="{{ $testi['name'] ?? '' }}" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <div style="width: 60px; height: 60px; background: {{ $accentColor }}; display: flex; align-items: center; justify-content: center;">👤</div>
                        @endif
                        <div>
                            <div style="font-weight: 700; color: #fff; font-size: 16px; text-transform: uppercase;">{{ $testi['name'] ?? '' }}</div>
                            <div style="font-size: 14px; color: {{ $accentColor }};">{{ $testi['title'] ?? '' }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ========== FAQ SECTION ========== --}}
    @if(!empty($sections['faq']['enabled']) && !empty($sections['faq']['items']))
    @php $faq = $sections['faq']; @endphp
    <section class="section">
        <div class="container">
            <div style="margin-bottom: 60px;">
                @if(!empty($faq['heading']))
                    <h2 class="section-heading">{{ $faq['heading'] }}</h2>
                @endif
            </div>
            <div style="max-width: 900px;">
                @foreach($faq['items'] as $index => $item)
                <div style="border-left: 5px solid {{ $accentColor }}; margin-bottom: 20px; background: #f9fafb;">
                    <div onclick="toggleFaqBold({{ $index }})" style="padding: 25px 30px; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 700; color: {{ $textColor }}; font-size: 18px; text-transform: uppercase;">{{ $item['question'] ?? '' }}</span>
                        <span id="faq-bold-icon-{{ $index }}" style="font-size: 28px; color: {{ $accentColor }}; font-weight: 700;">+</span>
                    </div>
                    <div id="faq-bold-answer-{{ $index }}" style="display: none; padding: 0 30px 25px;">
                        <p style="margin: 0; color: #6b7280; line-height: 1.8; font-size: 16px;">{{ $item['answer'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        function toggleFaqBold(index) {
            const answer = document.getElementById('faq-bold-answer-' + index);
            const icon = document.getElementById('faq-bold-icon-' + index);
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
    @php $cta = $sections['cta']; @endphp
    <section style="background: {{ $accentColor }}; padding: 100px 20px; position: relative; overflow: hidden;">
        <div style="position: absolute; left: -100px; top: -100px; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
        <div style="position: absolute; right: -50px; bottom: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>

        <div class="container" style="position: relative; z-index: 10;">
            <div style="max-width: 800px;">
                @if(!empty($cta['heading']))
                    <h2 style="font-size: 52px; font-weight: 700; color: #fff; margin: 0 0 20px; text-transform: uppercase; line-height: 1.1;">{{ $cta['heading'] }}</h2>
                @endif
                @if(!empty($cta['subheading']))
                    <p style="font-size: 20px; color: rgba(255,255,255,0.9); margin: 0 0 40px;">{{ $cta['subheading'] }}</p>
                @endif
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    @if(!empty($cta['btn1_text']) && !empty($cta['btn1_link']))
                        <a href="{{ $cta['btn1_link'] }}" style="background: #fff; color: {{ $accentColor }}; padding: 20px 50px; text-decoration: none; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 16px;">
                            {{ $cta['btn1_text'] }} →
                        </a>
                    @endif
                    @if(!empty($cta['btn2_text']) && !empty($cta['btn2_link']))
                        <a href="{{ $cta['btn2_link'] }}" style="background: transparent; color: #fff; padding: 20px 50px; border: 3px solid #fff; text-decoration: none; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 16px;">
                            {{ $cta['btn2_text'] }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Fallback --}}
    @if(empty($sections) || !collect($sections)->pluck('enabled')->filter()->count())
    <section class="section">
        <div class="container" style="max-width: 900px;">
            <h1 class="section-heading" style="font-size: 56px; text-transform: uppercase;">{{ $page->title }}</h1>
            @if($page->subtitle)
                <p class="highlight-box" style="margin-bottom: 30px;">{{ $page->subtitle }}</p>
            @endif
            @if($page->content)
                <div style="font-size: 18px; line-height: 1.8; color: {{ $textColor }};">
                    {!! nl2br(e($page->content)) !!}
                </div>
            @endif
        </div>
    </section>
    @endif

</div>
