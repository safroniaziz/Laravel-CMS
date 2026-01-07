{{-- Elegant Layout: Mewah, premium, dengan animasi halus --}}
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
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap');
.elegant-page {
    font-family: 'Montserrat', sans-serif;
    font-weight: 400;
}
.elegant-page h1, .elegant-page h2, .elegant-page h3 {
    font-family: 'Cormorant Garamond', serif;
}
.elegant-page .section {
    padding: 100px 0;
}
.elegant-page .section-heading {
    font-size: 44px;
    font-weight: 600;
    color: {{ $accentColor }};
    margin-bottom: 15px;
    letter-spacing: 2px;
}
.elegant-page .section-subheading {
    font-size: 16px;
    color: #9ca3af;
    max-width: 600px;
    letter-spacing: 1px;
    text-transform: uppercase;
}
.elegant-page .btn-elegant {
    background: transparent;
    color: {{ $accentColor }};
    padding: 16px 40px;
    border: 1px solid {{ $accentColor }};
    text-decoration: none;
    font-weight: 500;
    font-size: 13px;
    display: inline-block;
    transition: all 0.4s ease;
    text-transform: uppercase;
    letter-spacing: 3px;
}
.elegant-page .btn-elegant:hover {
    background: {{ $accentColor }};
    color: #fff;
}
.elegant-page .btn-elegant-filled {
    background: {{ $accentColor }};
    color: #fff;
    padding: 16px 40px;
    border: 1px solid {{ $accentColor }};
    text-decoration: none;
    font-weight: 500;
    font-size: 13px;
    display: inline-block;
    transition: all 0.4s ease;
    text-transform: uppercase;
    letter-spacing: 3px;
}
.elegant-page .btn-elegant-filled:hover {
    background: {{ $textColor }};
    border-color: {{ $textColor }};
}
.elegant-page .gold-line {
    width: 60px;
    height: 1px;
    background: linear-gradient(90deg, transparent, {{ $accentColor }}, transparent);
    margin: 25px auto;
}
.elegant-page .fade-in {
    animation: fadeInUp 0.8s ease forwards;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
@media (max-width: 768px) {
    .elegant-page .section { padding: 60px 0; }
    .elegant-page .section-heading { font-size: 34px; }
}
</style>

<div class="elegant-page" style="background: {{ $bgColor }}; color: {{ $textColor }};">

    {{-- ========== HERO SECTION ========== --}}
    @if(!empty($sections['hero']['enabled']))
    @php
        $hero = $sections['hero'];
        $heroHeight = $heights[$hero['height'] ?? 'medium'] ?? '60vh';
        $heroBgType = $hero['bg_type'] ?? 'color';
    @endphp
    <section style="min-height: {{ $heroHeight }}; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
        @if($heroBgType === 'image' && !empty($hero['bg_image']))
            <div style="position: absolute; inset: 0; background-image: url('{{ asset('storage/' . $hero['bg_image']) }}'); background-size: cover; background-position: center;"></div>
            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.5));"></div>
        @elseif($heroBgType === 'gradient')
            <div style="position: absolute; inset: 0; background: {{ $gradients[$hero['gradient'] ?? 'blue'] }};"></div>
        @else
            <div style="position: absolute; inset: 0; background: {{ $hero['bg_color'] ?? $accentColor }};"></div>
        @endif

        {{-- Decorative frame --}}
        <div style="position: absolute; inset: 40px; border: 1px solid rgba(255,255,255,0.2); pointer-events: none;"></div>

        <div class="container" style="position: relative; z-index: 10; text-align: center; padding: 60px 20px;">
            @if(!empty($hero['title']))
                <h1 style="font-size: clamp(38px, 6vw, 64px); font-weight: 600; color: #fff; margin: 0 0 20px; line-height: 1.2; letter-spacing: 4px;">
                    {{ $hero['title'] }}
                </h1>
            @endif
            <div class="gold-line" style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);"></div>
            @if(!empty($hero['subtitle']))
                <p style="font-size: 16px; color: rgba(255,255,255,0.85); margin: 0 auto 45px; max-width: 600px; line-height: 1.8; letter-spacing: 1px;">
                    {{ $hero['subtitle'] }}
                </p>
            @endif
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                @if(!empty($hero['cta1_text']) && !empty($hero['cta1_link']))
                    <a href="{{ safe_url($hero['cta1_link']) }}" style="background: #fff; color: {{ $accentColor }}; padding: 16px 45px; text-decoration: none; font-weight: 500; font-size: 12px; text-transform: uppercase; letter-spacing: 3px; transition: all 0.4s ease;">
                        {{ $hero['cta1_text'] }}
                    </a>
                @endif
                @if(!empty($hero['cta2_text']) && !empty($hero['cta2_link']))
                    <a href="{{ safe_url($hero['cta2_link']) }}" style="background: transparent; color: #fff; padding: 16px 45px; border: 1px solid rgba(255,255,255,0.6); text-decoration: none; font-weight: 500; font-size: 12px; text-transform: uppercase; letter-spacing: 3px;">
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
    <section class="section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; max-width: 1100px; margin: 0 auto;" class="elegant-about-grid">
                <div style="order: {{ ($about['image_position'] ?? 'right') === 'left' ? 2 : 1 }};">
                    @if(!empty($about['subheading']))
                        <p class="section-subheading" style="margin-bottom: 15px;">{{ $about['subheading'] }}</p>
                    @endif
                    @if(!empty($about['heading']))
                        <h2 class="section-heading">{{ $about['heading'] }}</h2>
                    @endif
                    <div class="gold-line" style="margin: 25px 0;"></div>
                    @if(!empty($about['content']))
                        <div style="font-size: 15px; line-height: 2; color: #6b7280; margin-bottom: 35px; font-weight: 300;">
                            {!! nl2br(e($about['content'])) !!}
                        </div>
                    @endif
                    @if(!empty($about['btn_text']) && !empty($about['btn_link']))
                        <a href="{{ safe_url($about['btn_link']) }}" class="btn-elegant">
                            {{ $about['btn_text'] }}
                        </a>
                    @endif
                </div>
                <div style="order: {{ ($about['image_position'] ?? 'right') === 'left' ? 1 : 2 }};">
                    @if(!empty($about['image']))
                        <div style="position: relative; padding: 20px;">
                            <div style="position: absolute; inset: 0; border: 1px solid {{ $accentColor }}30;"></div>
                            <img src="{{ asset('storage/' . $about['image']) }}" alt="{{ $about['heading'] ?? '' }}" style="width: 100%; position: relative; z-index: 1;">
                        </div>
                    @else
                        <div style="background: {{ $accentColor }}10; padding: 100px; text-align: center; border: 1px solid {{ $accentColor }}20;">
                            <span style="font-size: 80px; opacity: 0.5;">✨</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <style>
        @media (max-width: 768px) {
            .elegant-about-grid { display: block !important; }
            .elegant-about-grid > div { margin-bottom: 40px; order: unset !important; }
        }
    </style>
    @endif

    {{-- ========== FEATURES SECTION ========== --}}
    @if(!empty($sections['features']['enabled']) && !empty($sections['features']['items']))
    @php $features = $sections['features']; @endphp
    <section class="section" style="background: {{ $accentColor }}05;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 70px;">
                @if(!empty($features['subheading']))
                    <p class="section-subheading" style="margin: 0 auto 10px;">{{ $features['subheading'] }}</p>
                @endif
                @if(!empty($features['heading']))
                    <h2 class="section-heading">{{ $features['heading'] }}</h2>
                @endif
                <div class="gold-line"></div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; max-width: 1100px; margin: 0 auto;">
                @foreach($features['items'] as $item)
                <div style="text-align: center; padding: 50px 35px; background: #fff; border: 1px solid {{ $accentColor }}15; transition: all 0.4s ease;">
                    <div style="font-size: 50px; margin-bottom: 25px; opacity: 0.8;">{{ $icons[$item['icon'] ?? 'star'] ?? '⭐' }}</div>
                    <h3 style="color: {{ $accentColor }}; font-size: 24px; font-weight: 600; margin: 0 0 15px; letter-spacing: 1px;">{{ $item['title'] ?? '' }}</h3>
                    <p style="color: #9ca3af; margin: 0; line-height: 1.8; font-size: 14px; font-weight: 300;">{{ $item['text'] ?? '' }}</p>
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
            <div style="max-width: 1000px; margin: 0 auto {{ $loop->last ? '0' : '100px' }};">
                @if(in_array($imgPos, ['top', 'bottom']))
                    <div style="text-align: center;">
                        @if($imgPos === 'top' && !empty($block['image']))
                            <div style="padding: 15px; border: 1px solid {{ $accentColor }}20; display: inline-block; margin-bottom: 40px;">
                                <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="max-width: 100%;">
                            </div>
                        @endif
                        @if(!empty($block['heading']))
                            <h3 class="section-heading" style="font-size: 34px;">{{ $block['heading'] }}</h3>
                        @endif
                        <div class="gold-line"></div>
                        @if(!empty($block['text']))
                            <div style="color: #6b7280; font-size: 15px; line-height: 2; max-width: 700px; margin: 0 auto; font-weight: 300;">
                                {!! nl2br(e($block['text'])) !!}
                            </div>
                        @endif
                        @if($imgPos === 'bottom' && !empty($block['image']))
                            <div style="padding: 15px; border: 1px solid {{ $accentColor }}20; display: inline-block; margin-top: 40px;">
                                <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="max-width: 100%;">
                            </div>
                        @endif
                    </div>
                @else
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 70px; align-items: center;" class="elegant-content-grid">
                        <div style="order: {{ $imgPos === 'left' ? 2 : 1 }};">
                            @if(!empty($block['heading']))
                                <h3 class="section-heading" style="font-size: 32px;">{{ $block['heading'] }}</h3>
                            @endif
                            <div class="gold-line" style="margin: 20px 0;"></div>
                            @if(!empty($block['text']))
                                <div style="color: #6b7280; font-size: 15px; line-height: 2; font-weight: 300;">
                                    {!! nl2br(e($block['text'])) !!}
                                </div>
                            @endif
                        </div>
                        @if(!empty($block['image']))
                        <div style="order: {{ $imgPos === 'left' ? 1 : 2 }};">
                            <div style="padding: 15px; border: 1px solid {{ $accentColor }}20;">
                                <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="width: 100%;">
                            </div>
                        </div>
                        @endif
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </section>
    <style>
        @media (max-width: 768px) {
            .elegant-content-grid { display: block !important; }
            .elegant-content-grid > div { margin-bottom: 30px; order: unset !important; }
        }
    </style>
    @endif

    {{-- ========== GALLERY SECTION ========== --}}
    @if(!empty($sections['gallery']['enabled']) && !empty($sections['gallery']['images']))
    @php $gallery = $sections['gallery']; @endphp
    <section class="section" style="background: {{ $accentColor }}05;">
        <div class="container">
            @if(!empty($gallery['heading']))
                <div style="text-align: center; margin-bottom: 60px;">
                    <h2 class="section-heading">{{ $gallery['heading'] }}</h2>
                    <div class="gold-line"></div>
                </div>
            @endif
            <div style="display: grid; grid-template-columns: repeat({{ $gallery['columns'] ?? 3 }}, 1fr); gap: 25px; max-width: 1100px; margin: 0 auto;">
                @foreach($gallery['images'] as $image)
                <div style="overflow: hidden; padding: 10px; border: 1px solid {{ $accentColor }}15; background: #fff;">
                    <img src="{{ asset('storage/' . $image) }}" alt="Gallery" style="width: 100%; aspect-ratio: 1; object-fit: cover; transition: all 0.5s ease;">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ========== STATS SECTION ========== --}}
    @if(!empty($sections['stats']['enabled']) && !empty($sections['stats']['items']))
    @php $stats = $sections['stats']; @endphp
    <section class="section" style="background: {{ $accentColor }}; position: relative;">
        <div style="position: absolute; inset: 20px; border: 1px solid rgba(255,255,255,0.2); pointer-events: none;"></div>
        <div class="container" style="position: relative; z-index: 10;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 40px; max-width: 900px; margin: 0 auto; text-align: center;">
                @foreach($stats['items'] as $item)
                <div style="padding: 20px;">
                    @if(!empty($item['icon']))
                        <div style="font-size: 35px; margin-bottom: 15px; opacity: 0.8;">{{ $icons[$item['icon']] ?? '' }}</div>
                    @endif
                    <div style="font-size: 52px; font-weight: 600; color: #fff; font-family: 'Cormorant Garamond', serif; letter-spacing: 2px;">{{ $item['number'] ?? '' }}</div>
                    <div style="width: 30px; height: 1px; background: rgba(255,255,255,0.5); margin: 15px auto;"></div>
                    <div style="font-size: 12px; color: rgba(255,255,255,0.85); text-transform: uppercase; letter-spacing: 3px;">{{ $item['label'] ?? '' }}</div>
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
            <div style="text-align: center; margin-bottom: 70px;">
                @if(!empty($team['subheading']))
                    <p class="section-subheading" style="margin: 0 auto 10px;">{{ $team['subheading'] }}</p>
                @endif
                @if(!empty($team['heading']))
                    <h2 class="section-heading">{{ $team['heading'] }}</h2>
                @endif
                <div class="gold-line"></div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 40px; max-width: 1000px; margin: 0 auto;">
                @foreach($team['items'] as $member)
                <div style="text-align: center;">
                    <div style="padding: 10px; border: 1px solid {{ $accentColor }}20; margin-bottom: 25px;">
                        <div style="width: 100%; aspect-ratio: 1; overflow: hidden;">
                            @if(!empty($member['photo']))
                                <img src="{{ asset('storage/' . $member['photo']) }}" alt="{{ $member['name'] ?? '' }}" style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(20%);">
                            @else
                                <div style="width: 100%; height: 100%; background: {{ $accentColor }}10; display: flex; align-items: center; justify-content: center; font-size: 60px; opacity: 0.5;">👤</div>
                            @endif
                        </div>
                    </div>
                    <h3 style="color: {{ $textColor }}; font-size: 24px; font-weight: 600; margin: 0 0 5px; letter-spacing: 1px;">{{ $member['name'] ?? '' }}</h3>
                    <p style="color: {{ $accentColor }}; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 15px;">{{ $member['position'] ?? '' }}</p>
                    @if(!empty($member['bio']))
                        <p style="color: #9ca3af; font-size: 14px; line-height: 1.8; margin: 0; font-weight: 300;">{{ $member['bio'] }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ========== TESTIMONIALS SECTION ========== --}}
    @if(!empty($sections['testimonials']['enabled']) && !empty($sections['testimonials']['items']))
    @php $testimonials = $sections['testimonials']; @endphp
    <section class="section" style="background: {{ $accentColor }}05;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 60px;">
                @if(!empty($testimonials['heading']))
                    <h2 class="section-heading">{{ $testimonials['heading'] }}</h2>
                @endif
                <div class="gold-line"></div>
            </div>

            <div style="max-width: 800px; margin: 0 auto;">
                @foreach($testimonials['items'] as $testi)
                <div style="text-align: center; margin-bottom: 60px; padding: 60px 50px; background: #fff; border: 1px solid {{ $accentColor }}15;">
                    <div style="font-size: 80px; color: {{ $accentColor }}20; line-height: 0.5; margin-bottom: 30px; font-family: serif;">"</div>
                    <p style="font-size: 18px; font-style: italic; color: #6b7280; line-height: 1.9; margin: 0 0 35px; font-weight: 300;">{{ $testi['quote'] ?? '' }}</p>
                    <div style="width: 70px; height: 70px; margin: 0 auto 15px; border: 1px solid {{ $accentColor }}30; padding: 5px;">
                        @if(!empty($testi['photo']))
                            <img src="{{ asset('storage/' . $testi['photo']) }}" alt="{{ $testi['name'] ?? '' }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: {{ $accentColor }}10; display: flex; align-items: center; justify-content: center;">👤</div>
                        @endif
                    </div>
                    <div style="font-weight: 600; color: {{ $textColor }}; font-size: 16px; letter-spacing: 1px;">{{ $testi['name'] ?? '' }}</div>
                    <div style="font-size: 12px; color: {{ $accentColor }}; text-transform: uppercase; letter-spacing: 2px; margin-top: 5px;">{{ $testi['title'] ?? '' }}</div>
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
            <div style="text-align: center; margin-bottom: 60px;">
                @if(!empty($faq['heading']))
                    <h2 class="section-heading">{{ $faq['heading'] }}</h2>
                @endif
                <div class="gold-line"></div>
            </div>
            <div style="max-width: 800px; margin: 0 auto;">
                @foreach($faq['items'] as $index => $item)
                <div style="border: 1px solid {{ $accentColor }}15; margin-bottom: 15px; background: #fff;">
                    <div onclick="toggleFaqElegant({{ $index }})" style="padding: 25px 30px; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 500; color: {{ $textColor }}; font-size: 16px; letter-spacing: 0.5px;">{{ $item['question'] ?? '' }}</span>
                        <span id="faq-elegant-icon-{{ $index }}" style="font-size: 20px; color: {{ $accentColor }}; transition: transform 0.3s;">+</span>
                    </div>
                    <div id="faq-elegant-answer-{{ $index }}" style="display: none; padding: 0 30px 25px;">
                        <div style="width: 40px; height: 1px; background: {{ $accentColor }}30; margin-bottom: 20px;"></div>
                        <p style="margin: 0; color: #9ca3af; line-height: 1.9; font-size: 15px; font-weight: 300;">{{ $item['answer'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        function toggleFaqElegant(index) {
            const answer = document.getElementById('faq-elegant-answer-' + index);
            const icon = document.getElementById('faq-elegant-icon-' + index);
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
    <section style="background: {{ $accentColor }}; padding: 100px 20px; text-align: center; position: relative;">
        <div style="position: absolute; inset: 30px; border: 1px solid rgba(255,255,255,0.2); pointer-events: none;"></div>
        <div class="container" style="position: relative; z-index: 10;">
            @if(!empty($cta['heading']))
                <h2 style="font-size: 42px; font-weight: 600; color: #fff; margin: 0 0 15px; font-family: 'Cormorant Garamond', serif; letter-spacing: 3px;">{{ $cta['heading'] }}</h2>
            @endif
            <div style="width: 60px; height: 1px; background: rgba(255,255,255,0.5); margin: 25px auto;"></div>
            @if(!empty($cta['subheading']))
                <p style="font-size: 15px; color: rgba(255,255,255,0.85); margin: 0 auto 45px; max-width: 550px; letter-spacing: 1px; font-weight: 300;">{{ $cta['subheading'] }}</p>
            @endif
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                @if(!empty($cta['btn1_text']) && !empty($cta['btn1_link']))
                    <a href="{{ safe_url($cta['btn1_link']) }}" style="background: #fff; color: {{ $accentColor }}; padding: 16px 50px; text-decoration: none; font-weight: 500; text-transform: uppercase; letter-spacing: 3px; font-size: 12px; transition: all 0.4s ease;">
                        {{ $cta['btn1_text'] }}
                    </a>
                @endif
                @if(!empty($cta['btn2_text']) && !empty($cta['btn2_link']))
                    <a href="{{ safe_url($cta['btn2_link']) }}" style="background: transparent; color: #fff; padding: 16px 50px; border: 1px solid rgba(255,255,255,0.6); text-decoration: none; font-weight: 500; text-transform: uppercase; letter-spacing: 3px; font-size: 12px;">
                        {{ $cta['btn2_text'] }}
                    </a>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- Fallback --}}
    @if(empty($sections) || !collect($sections)->pluck('enabled')->filter()->count())
    <section class="section">
        <div class="container" style="max-width: 800px; text-align: center;">
            <h1 class="section-heading" style="font-size: 48px;">{{ $page->title }}</h1>
            <div class="gold-line"></div>
            @if($page->subtitle)
                <p class="section-subheading" style="margin: 0 auto 30px;">{{ $page->subtitle }}</p>
            @endif
            @if($page->content)
                <div style="font-size: 15px; line-height: 2; color: #6b7280; text-align: left; font-weight: 300;">
                    {!! nl2br(e($page->content)) !!}
                </div>
            @endif
        </div>
    </section>
    @endif

</div>
