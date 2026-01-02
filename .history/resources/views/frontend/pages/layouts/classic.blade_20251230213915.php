{{-- Classic Layout: Tradisional, formal, dengan serif fonts --}}
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
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Source+Sans+Pro:wght@400;600&display=swap');
.classic-page {
    font-family: 'Source Sans Pro', Georgia, serif;
}
.classic-page h1, .classic-page h2, .classic-page h3 {
    font-family: 'Playfair Display', Georgia, serif;
}
.classic-page .section {
    padding: 80px 0;
}
.classic-page .section-heading {
    font-size: 38px;
    font-weight: 700;
    color: {{ $accentColor }};
    margin-bottom: 15px;
    position: relative;
    display: inline-block;
}
.classic-page .section-heading::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 3px;
    background: {{ $accentColor }};
}
.classic-page .section-heading.centered::after {
    left: 50%;
    transform: translateX(-50%);
}
.classic-page .section-subheading {
    font-size: 18px;
    color: #6b7280;
    max-width: 600px;
}
.classic-page .btn-classic {
    background: {{ $accentColor }};
    color: #fff;
    padding: 14px 35px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
    border: 2px solid {{ $accentColor }};
}
.classic-page .btn-classic:hover {
    background: transparent;
    color: {{ $accentColor }};
}
.classic-page .btn-outline {
    background: transparent;
    color: {{ $accentColor }};
    padding: 14px 35px;
    border: 2px solid {{ $accentColor }};
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
}
.classic-page .divider {
    width: 80px;
    height: 2px;
    background: {{ $accentColor }};
    margin: 30px auto;
}
@media (max-width: 768px) {
    .classic-page .section { padding: 50px 0; }
    .classic-page .section-heading { font-size: 30px; }
}
</style>

<div class="classic-page" style="background: {{ $bgColor }}; color: {{ $textColor }};">

    {{-- ========== HERO SECTION ========== --}}
    @if(!empty($sections['hero']['enabled']))
    @php
        $hero = $sections['hero'];
        $heroHeight = $heights[$hero['height'] ?? 'medium'] ?? '60vh';
        $heroBgType = $hero['bg_type'] ?? 'color';
    @endphp
    <section style="min-height: {{ $heroHeight }}; display: flex; align-items: center; justify-content: center; position: relative; background: {{ $heroBgType === 'color' ? ($hero['bg_color'] ?? $accentColor) : 'transparent' }};">
        @if($heroBgType === 'image' && !empty($hero['bg_image']))
            <div style="position: absolute; inset: 0; background-image: url('{{ asset('storage/' . $hero['bg_image']) }}'); background-size: cover; background-position: center;"></div>
            <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.55);"></div>
        @elseif($heroBgType === 'gradient')
            <div style="position: absolute; inset: 0; background: {{ $gradients[$hero['gradient'] ?? 'blue'] }};"></div>
        @endif
        
        <div class="container" style="position: relative; z-index: 10; text-align: center; padding: 60px 20px;">
            @if(!empty($hero['title']))
                <h1 style="font-size: clamp(36px, 5vw, 58px); font-weight: 700; color: #fff; margin: 0 0 25px; line-height: 1.2; letter-spacing: -1px;">
                    {{ $hero['title'] }}
                </h1>
            @endif
            <div class="divider" style="background: rgba(255,255,255,0.5);"></div>
            @if(!empty($hero['subtitle']))
                <p style="font-size: 20px; color: rgba(255,255,255,0.9); margin: 0 auto 40px; max-width: 650px; line-height: 1.7;">
                    {{ $hero['subtitle'] }}
                </p>
            @endif
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                @if(!empty($hero['cta1_text']) && !empty($hero['cta1_link']))
                    <a href="{{ $hero['cta1_link'] }}" style="background: #fff; color: {{ $accentColor }}; padding: 16px 40px; text-decoration: none; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; font-size: 14px;">
                        {{ $hero['cta1_text'] }}
                    </a>
                @endif
                @if(!empty($hero['cta2_text']) && !empty($hero['cta2_link']))
                    <a href="{{ $hero['cta2_link'] }}" style="background: transparent; color: #fff; padding: 16px 40px; border: 2px solid #fff; text-decoration: none; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; font-size: 14px;">
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
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 70px; align-items: center; max-width: 1100px; margin: 0 auto;" class="classic-about-grid">
                <div style="order: {{ ($about['image_position'] ?? 'right') === 'left' ? 2 : 1 }};">
                    @if(!empty($about['heading']))
                        <h2 class="section-heading" style="margin-bottom: 30px;">{{ $about['heading'] }}</h2>
                    @endif
                    @if(!empty($about['subheading']))
                        <p style="font-size: 18px; color: {{ $accentColor }}; font-style: italic; margin-bottom: 20px;">{{ $about['subheading'] }}</p>
                    @endif
                    @if(!empty($about['content']))
                        <div style="font-size: 17px; line-height: 1.9; color: {{ $textColor }}; margin-bottom: 30px;">
                            {!! nl2br(e($about['content'])) !!}
                        </div>
                    @endif
                    @if(!empty($about['btn_text']) && !empty($about['btn_link']))
                        <a href="{{ $about['btn_link'] }}" class="btn-classic">
                            {{ $about['btn_text'] }}
                        </a>
                    @endif
                </div>
                <div style="order: {{ ($about['image_position'] ?? 'right') === 'left' ? 1 : 2 }};">
                    @if(!empty($about['image']))
                        <div style="position: relative;">
                            <img src="{{ asset('storage/' . $about['image']) }}" alt="{{ $about['heading'] ?? '' }}" style="width: 100%; border: 8px solid #fff; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
                            <div style="position: absolute; top: -20px; left: -20px; right: 20px; bottom: 20px; border: 3px solid {{ $accentColor }}; z-index: -1;"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <style>
        @media (max-width: 768px) {
            .classic-about-grid { display: block !important; }
            .classic-about-grid > div { margin-bottom: 40px; order: unset !important; }
        }
    </style>
    @endif

    {{-- ========== FEATURES SECTION ========== --}}
    @if(!empty($sections['features']['enabled']) && !empty($sections['features']['items']))
    @php $features = $sections['features']; @endphp
    <section class="section" style="background: #f8f9fa;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 60px;">
                @if(!empty($features['heading']))
                    <h2 class="section-heading centered">{{ $features['heading'] }}</h2>
                @endif
                @if(!empty($features['subheading']))
                    <p class="section-subheading" style="margin: 25px auto 0;">{{ $features['subheading'] }}</p>
                @endif
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 0; max-width: 1100px; margin: 0 auto; border: 1px solid #e5e7eb;">
                @foreach($features['items'] as $index => $item)
                <div style="padding: 45px 35px; background: #fff; border: 1px solid #e5e7eb; text-align: center;">
                    <div style="font-size: 45px; margin-bottom: 20px;">{{ $icons[$item['icon'] ?? 'star'] ?? '⭐' }}</div>
                    <h3 style="color: {{ $accentColor }}; font-size: 22px; font-weight: 700; margin: 0 0 15px;">{{ $item['title'] ?? '' }}</h3>
                    <p style="color: #6b7280; margin: 0; line-height: 1.7; font-size: 15px;">{{ $item['text'] ?? '' }}</p>
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
            <div style="max-width: 1000px; margin: 0 auto {{ $loop->last ? '0' : '70px' }};">
                @if(in_array($imgPos, ['top', 'bottom']))
                    <div style="text-align: center;">
                        @if($imgPos === 'top' && !empty($block['image']))
                            <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="width: 100%; max-width: 800px; margin-bottom: 30px; border: 8px solid #fff; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
                        @endif
                        @if(!empty($block['heading']))
                            <h3 class="section-heading centered" style="font-size: 30px;">{{ $block['heading'] }}</h3>
                        @endif
                        <div class="divider"></div>
                        @if(!empty($block['text']))
                            <div style="color: {{ $textColor }}; font-size: 17px; line-height: 1.9; max-width: 750px; margin: 0 auto;">
                                {!! nl2br(e($block['text'])) !!}
                            </div>
                        @endif
                        @if($imgPos === 'bottom' && !empty($block['image']))
                            <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="width: 100%; max-width: 800px; margin-top: 30px; border: 8px solid #fff; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
                        @endif
                    </div>
                @else
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;" class="classic-content-grid">
                        <div style="order: {{ $imgPos === 'left' ? 2 : 1 }};">
                            @if(!empty($block['heading']))
                                <h3 class="section-heading" style="font-size: 28px; margin-bottom: 25px;">{{ $block['heading'] }}</h3>
                            @endif
                            @if(!empty($block['text']))
                                <div style="color: {{ $textColor }}; font-size: 16px; line-height: 1.9;">
                                    {!! nl2br(e($block['text'])) !!}
                                </div>
                            @endif
                        </div>
                        @if(!empty($block['image']))
                        <div style="order: {{ $imgPos === 'left' ? 1 : 2 }};">
                            <img src="{{ asset('storage/' . $block['image']) }}" alt="{{ $block['heading'] ?? '' }}" style="width: 100%; border: 5px solid #fff; box-shadow: 0 15px 40px rgba(0,0,0,0.12);">
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
            .classic-content-grid { display: block !important; }
            .classic-content-grid > div { margin-bottom: 25px; order: unset !important; }
        }
    </style>
    @endif

    {{-- ========== GALLERY SECTION ========== --}}
    @if(!empty($sections['gallery']['enabled']) && !empty($sections['gallery']['images']))
    @php $gallery = $sections['gallery']; @endphp
    <section class="section" style="background: #f8f9fa;">
        <div class="container">
            @if(!empty($gallery['heading']))
                <div style="text-align: center; margin-bottom: 50px;">
                    <h2 class="section-heading centered">{{ $gallery['heading'] }}</h2>
                    <div class="divider"></div>
                </div>
            @endif
            <div style="display: grid; grid-template-columns: repeat({{ $gallery['columns'] ?? 3 }}, 1fr); gap: 15px; max-width: 1100px; margin: 0 auto;">
                @foreach($gallery['images'] as $image)
                <div style="overflow: hidden;">
                    <img src="{{ asset('storage/' . $image) }}" alt="Gallery" style="width: 100%; aspect-ratio: 1; object-fit: cover; border: 5px solid #fff; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ========== STATS SECTION ========== --}}
    @if(!empty($sections['stats']['enabled']) && !empty($sections['stats']['items']))
    @php $stats = $sections['stats']; @endphp
    <section class="section" style="background: {{ $accentColor }};">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 30px; max-width: 900px; margin: 0 auto; text-align: center;">
                @foreach($stats['items'] as $item)
                <div style="padding: 20px;">
                    <div style="font-size: 54px; font-weight: 700; color: #fff; font-family: 'Playfair Display', serif;">{{ $item['number'] ?? '' }}</div>
                    <div style="width: 40px; height: 2px; background: rgba(255,255,255,0.5); margin: 15px auto;"></div>
                    <div style="font-size: 15px; color: rgba(255,255,255,0.9); text-transform: uppercase; letter-spacing: 2px;">{{ $item['label'] ?? '' }}</div>
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
            <div style="text-align: center; margin-bottom: 60px;">
                @if(!empty($team['heading']))
                    <h2 class="section-heading centered">{{ $team['heading'] }}</h2>
                @endif
                <div class="divider"></div>
                @if(!empty($team['subheading']))
                    <p class="section-subheading" style="margin: 0 auto;">{{ $team['subheading'] }}</p>
                @endif
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 35px; max-width: 1000px; margin: 0 auto;">
                @foreach($team['items'] as $member)
                <div style="text-align: center;">
                    <div style="width: 180px; height: 180px; margin: 0 auto 20px; overflow: hidden; border: 6px solid #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        @if(!empty($member['photo']))
                            <img src="{{ asset('storage/' . $member['photo']) }}" alt="{{ $member['name'] ?? '' }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: {{ $accentColor }}20; display: flex; align-items: center; justify-content: center; font-size: 50px;">👤</div>
                        @endif
                    </div>
                    <h3 style="color: {{ $textColor }}; font-size: 22px; font-weight: 700; margin: 0 0 5px;">{{ $member['name'] ?? '' }}</h3>
                    <p style="color: {{ $accentColor }}; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 15px;">{{ $member['position'] ?? '' }}</p>
                    @if(!empty($member['bio']))
                        <p style="color: #6b7280; font-size: 14px; line-height: 1.7; margin: 0;">{{ $member['bio'] }}</p>
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
    <section class="section" style="background: #f8f9fa;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 50px;">
                @if(!empty($testimonials['heading']))
                    <h2 class="section-heading centered">{{ $testimonials['heading'] }}</h2>
                @endif
                <div class="divider"></div>
            </div>
            
            <div style="max-width: 850px; margin: 0 auto;">
                @foreach($testimonials['items'] as $testi)
                <div style="text-align: center; margin-bottom: 50px; padding: 50px; background: #fff; border: 1px solid #e5e7eb;">
                    <div style="font-size: 80px; color: {{ $accentColor }}20; line-height: 0.5; margin-bottom: 20px;">"</div>
                    <p style="font-size: 20px; font-style: italic; color: {{ $textColor }}; line-height: 1.8; margin: 0 0 30px;">{{ $testi['quote'] ?? '' }}</p>
                    <div style="width: 60px; height: 60px; margin: 0 auto 15px; border-radius: 50%; overflow: hidden; border: 3px solid {{ $accentColor }};">
                        @if(!empty($testi['photo']))
                            <img src="{{ asset('storage/' . $testi['photo']) }}" alt="{{ $testi['name'] ?? '' }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: {{ $accentColor }}20; display: flex; align-items: center; justify-content: center;">👤</div>
                        @endif
                    </div>
                    <div style="font-weight: 700; color: {{ $textColor }}; font-size: 18px;">{{ $testi['name'] ?? '' }}</div>
                    <div style="font-size: 14px; color: {{ $accentColor }};">{{ $testi['title'] ?? '' }}</div>
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
            <div style="text-align: center; margin-bottom: 50px;">
                @if(!empty($faq['heading']))
                    <h2 class="section-heading centered">{{ $faq['heading'] }}</h2>
                @endif
                <div class="divider"></div>
            </div>
            <div style="max-width: 800px; margin: 0 auto;">
                @foreach($faq['items'] as $index => $item)
                <div style="border-bottom: 1px solid #e5e7eb; margin-bottom: 0;">
                    <div onclick="toggleFaqClassic({{ $index }})" style="padding: 25px 0; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600; color: {{ $textColor }}; font-size: 18px; font-family: 'Playfair Display', serif;">{{ $item['question'] ?? '' }}</span>
                        <span id="faq-classic-icon-{{ $index }}" style="font-size: 24px; color: {{ $accentColor }};">+</span>
                    </div>
                    <div id="faq-classic-answer-{{ $index }}" style="display: none; padding: 0 0 25px;">
                        <p style="margin: 0; color: #6b7280; line-height: 1.8; font-size: 16px;">{{ $item['answer'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        function toggleFaqClassic(index) {
            const answer = document.getElementById('faq-classic-answer-' + index);
            const icon = document.getElementById('faq-classic-icon-' + index);
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
    <section style="background: {{ $accentColor }}; padding: 80px 20px; text-align: center;">
        <div class="container">
            @if(!empty($cta['heading']))
                <h2 style="font-size: 38px; font-weight: 700; color: #fff; margin: 0 0 15px; font-family: 'Playfair Display', serif;">{{ $cta['heading'] }}</h2>
            @endif
            <div style="width: 60px; height: 2px; background: rgba(255,255,255,0.5); margin: 25px auto;"></div>
            @if(!empty($cta['subheading']))
                <p style="font-size: 18px; color: rgba(255,255,255,0.9); margin: 0 auto 40px; max-width: 600px;">{{ $cta['subheading'] }}</p>
            @endif
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                @if(!empty($cta['btn1_text']) && !empty($cta['btn1_link']))
                    <a href="{{ $cta['btn1_link'] }}" style="background: #fff; color: {{ $accentColor }}; padding: 16px 45px; text-decoration: none; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; font-size: 14px;">
                        {{ $cta['btn1_text'] }}
                    </a>
                @endif
                @if(!empty($cta['btn2_text']) && !empty($cta['btn2_link']))
                    <a href="{{ $cta['btn2_link'] }}" style="background: transparent; color: #fff; padding: 16px 45px; border: 2px solid #fff; text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 14px;">
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
            <h1 class="section-heading centered" style="font-size: 44px;">{{ $page->title }}</h1>
            <div class="divider"></div>
            @if($page->subtitle)
                <p style="font-size: 18px; color: #6b7280; margin-bottom: 30px; font-style: italic;">{{ $page->subtitle }}</p>
            @endif
            @if($page->content)
                <div style="font-size: 17px; line-height: 1.9; color: {{ $textColor }}; text-align: left;">
                    {!! nl2br(e($page->content)) !!}
                </div>
            @endif
        </div>
    </section>
    @endif

</div>
