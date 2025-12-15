@php
    // Fetch hero slider settings from database
    try {
        $heroLayoutStyle = App\Models\Setting::where('key', 'hero_layout_style')->value('value') ?? 'current';
        $heroBadge = [
            'text' => App\Models\Setting::where('key', 'hero_badge_text')->value('value') ?? 'UNGGUL',
            'subtext' => App\Models\Setting::where('key', 'hero_badge_subtext')->value('value') ?? 'Terakreditasi',
            'show' => App\Models\Setting::where('key', 'hero_badge_show')->value('value') ?? '1',
        ];
        $heroColors = [
            'primary' => App\Models\Setting::where('key', 'hero_primary_color')->value('value') ?? '#1a246a',
            'accent' => App\Models\Setting::where('key', 'hero_accent_color')->value('value') ?? '#fbbf24',
            'gradient_start' => App\Models\Setting::where('key', 'hero_gradient_start')->value('value') ?? '#0f172a',
            'gradient_mid' => App\Models\Setting::where('key', 'hero_gradient_mid')->value('value') ?? '#1a246a',
            'gradient_end' => App\Models\Setting::where('key', 'hero_gradient_end')->value('value') ?? '#151945',
        ];
    } catch (\Exception $e) {
        $heroLayoutStyle = 'current';
        $heroBadge = ['text' => 'UNGGUL', 'subtext' => 'Terakreditasi', 'show' => '1'];
        $heroColors = [
            'primary' => '#1a246a',
            'accent' => '#fbbf24',
            'gradient_start' => '#0f172a',
            'gradient_mid' => '#1a246a',
            'gradient_end' => '#151945',
        ];
    }
@endphp

{{-- Hero Slider Section --}}
<section style="position: relative; overflow: hidden; margin: 0; padding: 0;">
    @if($sliders->count() > 0)
        <div class="hero-slider" style="position: relative;">
            <div class="hero-slides" style="display: flex; transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);">
                @foreach($sliders as $index => $slider)
                    @if($heroLayoutStyle === 'current')
                    {{-- LAYOUT 1: Current Split Layout --}}
                    <div class="hero-slide" style="min-width: 100%; height: calc(100vh - 80px); background: linear-gradient(135deg, {{ $heroColors['gradient_start'] }} 0%, {{ $heroColors['gradient_mid'] }} 40%, {{ $heroColors['gradient_end'] }} 100%); position: relative; display: flex; align-items: center;">

                        {{-- Simple Background Elements --}}
                        <div style="position: absolute; inset: 0; overflow: hidden; pointer-events: none;">
                            {{-- Subtle gradient orbs --}}
                            <div style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(26, 36, 106, 0.1) 0%, transparent 70%); top: -100px; {{ $slider->image_position === 'left' ? 'left: -100px;' : 'right: -100px;' }} border-radius: 50%;"></div>
                            <div style="position: absolute; width: 300px; height: 300px; background: radial-gradient(circle, rgba(251, 191, 36, 0.08) 0%, transparent 70%); bottom: -80px; {{ $slider->image_position === 'left' ? 'right: 10%;' : 'left: 10%;' }} border-radius: 50%;"></div>
                        </div>

                        <div class="container" style="position: relative; z-index: 2; width: 100%;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; {{ $slider->image_position === 'left' ? 'direction: rtl;' : '' }}">
                                {{-- Clean Content Side --}}
                                <div style="color: #fff; {{ $slider->image_position === 'left' ? 'direction: ltr;' : '' }}" data-aos="fade-{{ $slider->image_position === 'left' ? 'left' : 'right' }}" data-aos-duration="1000">
                                    @if($slider->subtitle)
                                        <div style="display: inline-flex; align-items: center; gap: 10px; padding: 10px 24px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50px; border: 1px solid rgba(255,255,255,0.2); margin-bottom: 30px;">
                                            <div style="width: 8px; height: 8px; background: {{ $heroColors['accent'] }}; border-radius: 50%;"></div>
                                            <span style="font-size: 13px; font-weight: 700; color: {{ $heroColors['accent'] }}; letter-spacing: 1px; text-transform: uppercase;">{{ strtoupper($slider->subtitle) }}</span>
                                        </div>
                                    @endif

                                    <h1 style="font-size: 48px; font-weight: 800; margin: 0 0 25px 0; line-height: 1.1; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                                        @php
                                            $words = explode(' ', $slider->title);
                                            $lastWord = array_pop($words);
                                            $restWords = implode(' ', $words);
                                        @endphp
                                        @if($restWords)
                                            {{ $restWords }}
                                            <span style="background: linear-gradient(135deg, {{ $heroColors['accent'] }}, #f97316); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $lastWord }}</span>
                                        @else
                                            {{ $slider->title }}
                                        @endif
                                    </h1>

                                    @if($slider->description)
                                        <p style="font-size: 18px; line-height: 1.6; margin-bottom: 35px; color: rgba(255,255,255,0.9); max-width: 500px;">
                                            {{ $slider->description }}
                                        </p>
                                    @endif

                                    @if($slider->button_text && $slider->button_link)
                                        <div style="display: flex; gap: 15px; align-items: center;">
                                            <a href="{{ $slider->button_link }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 40px; background: linear-gradient(135deg, {{ $heroColors['accent'] }}, #f97316); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; box-shadow: 0 10px 30px rgba(251, 191, 36, 0.3); transition: all 0.3s;">
                                                <span>{{ $slider->button_text }}</span>
                                                <i class="fas fa-arrow-right" style="transition: transform 0.3s;"></i>
                                            </a>
                                            <a href="{{ route('page.show', 'about') }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 35px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 600; font-size: 16px; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s;">
                                                <span>Pelajari Lebih Lanjut</span>
                                                <i class="fas fa-arrow-right" style="transition: transform 0.3s;"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                {{-- Image Side with Decorations --}}
                                <div style="{{ $slider->image_position === 'left' ? 'direction: ltr;' : '' }}; height: calc(70vh - 60px); display: flex; align-items: center;" data-aos="fade-{{ $slider->image_position === 'left' ? 'right' : 'left' }}" data-aos-duration="1000" data-aos-delay="200">
                                    <div style="position: relative; width: 100%; height: 100%;">
                                        {{-- Decorative Background Card --}}
                                        <div style="position: absolute; inset: -20px; background: linear-gradient(135deg, rgba(251, 191, 36, 0.1), rgba(249, 115, 22, 0.1)); border-radius: 30px; transform: rotate(-2deg); z-index: 0;"></div>

                                        @if($slider->image)
                                            <div style="position: relative; width: 100%; height: 100%; border-radius: 24px; overflow: hidden; box-shadow: 0 25px 70px rgba(0,0,0,0.5); transform: rotate(0deg); transition: transform 0.5s; z-index: 1;" class="hero-image">
                                                <img src="{{ $slider->image }}" alt="{{ $slider->title }}" style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; transition: transform 0.5s;">

                                                {{-- Gradient Overlay --}}
                                                <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(30, 58, 138, 0.15), rgba(249, 115, 22, 0.15)); pointer-events: none;"></div>

                                                {{-- Shine Effect --}}
                                                <div style="position: absolute; top: 0; left: -100%; width: 50%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); animation: shine 3s ease-in-out infinite;"></div>
                                            </div>
                                        @else
                                            <div style="position: relative; width: 100%; height: 100%; background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); border-radius: 24px; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255,255,255,0.2); box-shadow: 0 25px 70px rgba(0,0,0,0.5); z-index: 1;">
                                                <i class="fas fa-image" style="font-size: 120px; color: rgba(255,255,255,0.3);"></i>
                                            </div>
                                        @endif

                                        {{-- Floating Badge (Dynamic from Database) --}}
                                        @if($heroBadge['show'] == '1')
                                        <div style="position: absolute; {{ $slider->image_position === 'left' ? 'left: -20px;' : 'right: -20px;' }} bottom: 40px; background: #fff; padding: 20px 25px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); z-index: 2;" data-aos="zoom-in" data-aos-delay="600">
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, {{ $heroColors['accent'] }}, #f97316); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-star" style="color: #fff; font-size: 24px;"></i>
                                                </div>
                                                <div>
                                                    <div style="font-size: 20px; font-weight: 900; color: {{ $heroColors['primary'] }}; line-height: 1;">{{ $heroBadge['text'] }}</div>
                                                    <div style="font-size: 12px; color: #64748b; margin-top: 2px;">{{ $heroBadge['subtext'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($heroLayoutStyle === 'centered')
                    {{-- LAYOUT 2: Centered Layout --}}
                    <div class="hero-slide" style="min-width: 100%; height: calc(100vh - 80px); background: linear-gradient(135deg, {{ $heroColors['gradient_start'] }} 0%, {{ $heroColors['gradient_mid'] }} 50%, {{ $heroColors['gradient_end'] }} 100%); position: relative; display: flex; align-items: center; justify-content: center; text-align: center;">
                        <div class="container" style="position: relative; z-index: 2;">
                            <div style="max-width: 800px; margin: 0 auto;">
                                @if($slider->subtitle)
                                    <div style="display: inline-flex; align-items: center; gap: 10px; padding: 10px 24px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50px; border: 1px solid rgba(255,255,255,0.2); margin-bottom: 30px;">
                                        <div style="width: 8px; height: 8px; background: {{ $heroColors['accent'] }}; border-radius: 50%;"></div>
                                        <span style="font-size: 13px; font-weight: 700; color: {{ $heroColors['accent'] }}; letter-spacing: 1px; text-transform: uppercase;">{{ strtoupper($slider->subtitle) }}</span>
                                    </div>
                                @endif

                                <h1 style="font-size: 56px; font-weight: 800; margin: 0 0 30px 0; line-height: 1.2; text-shadow: 0 2px 10px rgba(0,0,0,0.2); color: #fff;">
                                    {{ $slider->title }}
                                </h1>

                                @if($slider->description)
                                    <p style="font-size: 20px; line-height: 1.7; margin-bottom: 40px; color: rgba(255,255,255,0.9); max-width: 600px; margin-left: auto; margin-right: auto;">
                                        {{ $slider->description }}
                                    </p>
                                @endif

                                @if($slider->button_text && $slider->button_link)
                                    <div style="display: flex; gap: 15px; align-items: center; justify-content: center;">
                                        <a href="{{ $slider->button_link }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 40px; background: linear-gradient(135deg, {{ $heroColors['accent'] }}, #f97316); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; box-shadow: 0 10px 30px rgba(251, 191, 36, 0.3); transition: all 0.3s;">
                                            <span>{{ $slider->button_text }}</span>
                                            <i class="fas fa-arrow-right" style="transition: transform 0.3s;"></i>
                                        </a>
                                    </div>
                                @endif

                                @if($slider->image)
                                <div style="margin-top: 60px; max-width: 600px; margin-left: auto; margin-right: auto;">
                                    <div style="position: relative; width: 100%; padding-bottom: 60%; border-radius: 24px; overflow: hidden; box-shadow: 0 25px 70px rgba(0,0,0,0.5);">
                                        <img src="{{ $slider->image }}" alt="{{ $slider->title }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @elseif($heroLayoutStyle === 'minimal')
                    {{-- LAYOUT 3: Minimal Layout --}}
                    <div class="hero-slide" style="min-width: 100%; height: calc(100vh - 80px); background: linear-gradient(135deg, {{ $heroColors['gradient_start'] }}, {{ $heroColors['gradient_end'] }}); position: relative; display: flex; align-items: center;">
                        <div class="container" style="position: relative; z-index: 2;">
                            <div style="max-width: 700px;">
                                @if($slider->subtitle)
                                    <div style="font-size: 14px; font-weight: 600; color: {{ $heroColors['accent'] }}; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;">
                                        {{ $slider->subtitle }}
                                    </div>
                                @endif

                                <h1 style="font-size: 64px; font-weight: 900; margin: 0 0 30px 0; line-height: 1.1; color: #fff;">
                                    {{ $slider->title }}
                                </h1>

                                @if($slider->description)
                                    <p style="font-size: 18px; line-height: 1.8; margin-bottom: 40px; color: rgba(255,255,255,0.85);">
                                        {{ $slider->description }}
                                    </p>
                                @endif

                                @if($slider->button_text && $slider->button_link)
                                    <a href="{{ $slider->button_link }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 16px 36px; background: {{ $heroColors['accent'] }}; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 15px; transition: all 0.3s;">
                                        <span>{{ $slider->button_text }}</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @elseif($heroLayoutStyle === 'fullscreen')
                    {{-- LAYOUT 4: Fullscreen Layout --}}
                    <div class="hero-slide" style="min-width: 100%; height: 100vh; position: relative; overflow: hidden;">
                        @if($slider->image)
                        <div style="position: absolute; inset: 0; z-index: 0;">
                            <img src="{{ $slider->image }}" alt="{{ $slider->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; inset: 0; background: linear-gradient(135deg, {{ $heroColors['gradient_start'] }}dd, {{ $heroColors['gradient_end'] }}dd);"></div>
                        </div>
                        @else
                        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, {{ $heroColors['gradient_start'] }}, {{ $heroColors['gradient_end'] }}); z-index: 0;"></div>
                        @endif

                        <div class="container" style="position: relative; z-index: 2; height: 100%; display: flex; align-items: center;">
                            <div style="max-width: 800px; color: #fff;">
                                @if($slider->subtitle)
                                    <div style="display: inline-flex; align-items: center; gap: 10px; padding: 10px 24px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 50px; border: 1px solid rgba(255,255,255,0.3); margin-bottom: 30px;">
                                        <div style="width: 8px; height: 8px; background: {{ $heroColors['accent'] }}; border-radius: 50%;"></div>
                                        <span style="font-size: 13px; font-weight: 700; color: {{ $heroColors['accent'] }}; letter-spacing: 1px; text-transform: uppercase;">{{ strtoupper($slider->subtitle) }}</span>
                                    </div>
                                @endif

                                <h1 style="font-size: 72px; font-weight: 900; margin: 0 0 30px 0; line-height: 1.1; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                                    {{ $slider->title }}
                                </h1>

                                @if($slider->description)
                                    <p style="font-size: 22px; line-height: 1.7; margin-bottom: 40px; color: rgba(255,255,255,0.95); max-width: 600px;">
                                        {{ $slider->description }}
                                    </p>
                                @endif

                                @if($slider->button_text && $slider->button_link)
                                    <a href="{{ $slider->button_link }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 20px 45px; background: linear-gradient(135deg, {{ $heroColors['accent'] }}, #f97316); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 18px; box-shadow: 0 15px 40px rgba(251, 191, 36, 0.4); transition: all 0.3s;">
                                        <span>{{ $slider->button_text }}</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            {{-- Clean Navigation Arrows --}}
            @if($sliders->count() > 1)
                <button class="hero-prev" style="position: absolute; left: 30px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); border-radius: 50%; color: #fff; font-size: 20px; cursor: pointer; transition: all 0.3s; z-index: 10; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="hero-next" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); border-radius: 50%; color: #fff; font-size: 20px; cursor: pointer; transition: all 0.3s; z-index: 10; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-chevron-right"></i>
                </button>

                {{-- Clean Dots Indicator --}}
                <div class="hero-dots" style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); display: flex; gap: 12px; z-index: 10;">
                    @foreach($sliders as $index => $slider)
                        <button class="hero-dot" data-slide="{{ $index }}" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #fff; background: {{ $index === 0 ? '#fff' : 'transparent' }}; cursor: pointer; transition: all 0.3s;"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        {{-- Default Hero jika tidak ada slider --}}
        <div style="background: linear-gradient(135deg, {{ $heroColors['gradient_start'] }} 0%, {{ $heroColors['gradient_mid'] }} 50%, {{ $heroColors['gradient_end'] }} 100%); padding: 100px 0;">
            <div class="container">
                <div style="text-align: center; color: #fff;">
                    <h1 style="font-size: 52px; font-weight: 900; margin: 0 0 20px 0;">
                        {{ $homeSettings['home_hero_title'] ?? 'SISTEM INFORMASI' }}
                    </h1>
                    <p style="font-size: 18px; margin: 0 auto; max-width: 600px;">
                        {{ $homeSettings['home_hero_subtitle'] ?? 'Universitas Bengkulu' }}
                    </p>
                </div>
            </div>
        </div>
    @endif
</section>
