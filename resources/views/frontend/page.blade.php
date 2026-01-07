@extends('layouts.frontend')

@section('title', $page->title)

@section('content')
@php
    $pageData = $page->page_builder_data ?? [];
    $accentColor = $page->accent_color ?? '#1e3a8a';
    $textColor = $page->text_color ?? '#333333';
    $bgColor = $page->bg_color ?? '#ffffff';
    $layout = $page->layout ?? 'full';

    // Check if new format (array of blocks)
    $isNewFormat = isset($pageData[0]) && isset($pageData[0]['type']);

    $icons = ['users' => '👥', 'trophy' => '🏆', 'graduation' => '🎓', 'chart' => '📈', 'star' => '⭐', 'heart' => '❤️', 'check' => '✅', 'rocket' => '🚀', 'lightbulb' => '💡', 'shield' => '🛡️', 'target' => '🎯', 'globe' => '🌐'];
@endphp

<div class="dynamic-page" style="background: linear-gradient(180deg, #fafbfc 0%, #f3f4f6 100%); min-height: 100vh;">

    @if($isNewFormat)
        {{-- NEW FORMAT: Array of blocks with flexible layout --}}
        @php
            // Sort blocks by sectionOrder first, then order
            usort($pageData, function($a, $b) {
                $sectionOrderA = $a['settings']['sectionOrder'] ?? 999;
                $sectionOrderB = $b['settings']['sectionOrder'] ?? 999;
                if ($sectionOrderA !== $sectionOrderB) {
                    return $sectionOrderA <=> $sectionOrderB;
                }
                return ($a['order'] ?? 0) <=> ($b['order'] ?? 0);
            });

            // Separate blocks by placement
            $heroBlocks = array_filter($pageData, fn($b) => ($b['type'] ?? '') === 'hero');
            $mainBlocks = array_filter($pageData, fn($b) => ($b['type'] ?? '') !== 'hero' && ($b['settings']['placement'] ?? 'main') === 'main');
            $sidebarBlocks = array_filter($pageData, fn($b) => ($b['settings']['placement'] ?? 'main') === 'sidebar');

            // Group main blocks by section
            $sections = [];
            $currentSection = null;
            foreach($mainBlocks as $block) {
                $sectionTitle = $block['settings']['sectionTitle'] ?? '';
                $sectionKey = $sectionTitle ?: 'standalone_' . uniqid();
                
                if (!isset($sections[$sectionKey])) {
                    $sections[$sectionKey] = [
                        'title' => $sectionTitle,
                        'subtitle' => $block['settings']['sectionSubtitle'] ?? '',
                        'icon' => $block['settings']['sectionIcon'] ?? 'fas fa-star',
                        'blocks' => []
                    ];
                }
                $sections[$sectionKey]['blocks'][] = $block;
            }

            $hasSidebar = in_array($layout, ['sidebar-left', 'sidebar-right']);
        @endphp

        {{-- Render hero blocks first (always full width) --}}
        @foreach($heroBlocks as $block)
            @include('frontend.pages.blocks.hero', ['block' => $block, 'page' => $page])
        @endforeach

        {{-- If no hero, show premium title header --}}
        @if(count($heroBlocks) === 0)
            <div class="page-header" style="
                background: linear-gradient(135deg, {{ $accentColor }} 0%, {{ $accentColor }}dd 100%);
                padding: 80px 0;
                position: relative;
                overflow: hidden;
            ">
                <!-- Decorative Elements -->
                <div style="
                    position: absolute;
                    top: -50%;
                    right: -10%;
                    width: 600px;
                    height: 600px;
                    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
                    border-radius: 50%;
                "></div>
                <div style="
                    position: absolute;
                    bottom: -30%;
                    left: -5%;
                    width: 400px;
                    height: 400px;
                    background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
                    border-radius: 50%;
                "></div>
                
                <div class="container" style="position: relative; z-index: 1;">
                    <h1 style="
                        font-size: 48px;
                        font-weight: 900;
                        color: #fff;
                        margin: 0;
                        text-align: center;
                        letter-spacing: -0.5px;
                        text-shadow: 0 2px 20px rgba(0,0,0,0.1);
                    ">{{ $page->title }}</h1>
                    <div style="
                        width: 80px;
                        height: 4px;
                        background: rgba(255,255,255,0.5);
                        margin: 24px auto 0;
                        border-radius: 2px;
                    "></div>
                </div>
            </div>
        @endif

        {{-- Content area - full width or with sidebar --}}
        @if($hasSidebar)
            <div class="container" style="padding: 60px 15px; max-width: 1400px; margin: 0 auto;">
                <div class="page-with-sidebar" style="
                    display: grid;
                    grid-template-columns: {{ $layout === 'sidebar-left' ? '340px 1fr' : '1fr 340px' }};
                    gap: 40px;
                    align-items: start;
                ">
                    {{-- Main Content --}}
                    <div class="main-content" style="order: {{ $layout === 'sidebar-left' ? 2 : 1 }}; min-width: 0;">
                        @forelse($sections as $sectionKey => $section)
                            <div class="page-section" style="margin-bottom: 40px;">
                                {{-- Section Header --}}
                                @if(!empty($section['title']))
                                    <div class="section-header" style="
                                        text-align: center;
                                        margin-bottom: 2rem;
                                        padding: 20px 0;
                                    ">
                                        @if(!empty($section['icon']))
                                            <div style="
                                                display: inline-flex;
                                                align-items: center;
                                                justify-content: center;
                                                width: 64px;
                                                height: 64px;
                                                background: linear-gradient(135deg, {{ $accentColor }}22, {{ $accentColor }}11);
                                                border-radius: 16px;
                                                margin-bottom: 1rem;
                                            ">
                                                <i class="{{ $section['icon'] }}" style="font-size: 1.75rem; color: {{ $accentColor }};"></i>
                                            </div>
                                        @endif
                                        
                                        <h2 style="
                                            font-size: clamp(1.5rem, 3vw, 2rem);
                                            font-weight: 800;
                                            color: {{ $accentColor }};
                                            margin: 0 0 0.5rem 0;
                                            line-height: 1.2;
                                        ">{{ $section['title'] }}</h2>
                                        
                                        @if(!empty($section['subtitle']))
                                            <p style="
                                                font-size: clamp(0.9rem, 1.5vw, 1.1rem);
                                                color: #6b7280;
                                                max-width: 600px;
                                                margin: 0 auto;
                                                line-height: 1.5;
                                            ">{{ $section['subtitle'] }}</p>
                                        @endif
                                        
                                        <div style="
                                            width: 60px;
                                            height: 3px;
                                            background: linear-gradient(90deg, {{ $accentColor }}, {{ $accentColor }}88);
                                            margin: 1rem auto 0;
                                            border-radius: 2px;
                                        "></div>
                                    </div>
                                @endif
                                
                                {{-- Section Blocks --}}
                                @foreach($section['blocks'] as $blockIdx => $block)
                                    @php $blockType = $block['type'] ?? 'text'; @endphp
                                    @if(view()->exists('frontend.pages.blocks.' . $blockType))
                                        <div style="margin-bottom: 24px;" data-aos="fade-up" data-aos-delay="{{ $blockIdx * 100 }}">
                                            @include('frontend.pages.blocks.' . $blockType, ['block' => $block, 'page' => $page, 'inSidebar' => false])
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @empty
                            <div class="empty-state" style="
                                text-align: center;
                                padding: 80px 40px;
                                background: #fff;
                                border-radius: 16px;
                                box-shadow: 0 4px 12px rgba(0,0,0,0.05);
                            ">
                                <div style="
                                    width: 80px;
                                    height: 80px;
                                    background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    margin: 0 auto 20px;
                                ">
                                    <i class="fas fa-inbox" style="font-size: 32px; color: {{ $accentColor }};"></i>
                                </div>
                                <h3 style="color: #374151; font-weight: 700; margin: 0 0 8px; font-size: 20px;">Konten Belum Tersedia</h3>
                                <p style="color: #9ca3af; margin: 0; font-size: 15px;">Tambahkan block untuk mulai membuat konten halaman</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Premium Sidebar --}}
                    <aside class="sidebar" style="
                        order: {{ $layout === 'sidebar-left' ? 1 : 2 }};
                        position: sticky;
                        top: 24px;
                    ">
                        @forelse($sidebarBlocks as $sidebarIndex => $block)
                            @php $blockType = $block['type'] ?? 'text'; @endphp
                            @if(view()->exists('frontend.pages.blocks.' . $blockType))
                                <div class="sidebar-block" data-aos="fade-left" data-aos-delay="{{ $sidebarIndex * 100 }}" style="
                                    margin-bottom: 24px;
                                    background: rgba(255, 255, 255, 0.8);
                                    backdrop-filter: blur(10px);
                                    border-radius: 16px;
                                    border: 1px solid rgba(255, 255, 255, 0.3);
                                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
                                    overflow: hidden;
                                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                                ">
                                    <div style="
                                        height: 4px;
                                        background: linear-gradient(90deg, {{ $accentColor }} 0%, {{ $accentColor }}cc 100%);
                                    "></div>
                                    <div style="padding: 0;">
                                        @include('frontend.pages.blocks.' . $blockType, ['block' => $block, 'page' => $page, 'inSidebar' => true])
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="sidebar-empty" style="
                                background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
                                backdrop-filter: blur(10px);
                                border-radius: 16px;
                                border: 2px dashed #e5e7eb;
                                padding: 40px 24px;
                                text-align: center;
                            ">
                                <div style="
                                    width: 64px;
                                    height: 64px;
                                    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    margin: 0 auto 16px;
                                ">
                                    <i class="fas fa-sidebar" style="font-size: 24px; color: #9ca3af;"></i>
                                </div>
                                <p style="
                                    color: #6b7280;
                                    margin: 0;
                                    font-size: 14px;
                                    font-weight: 500;
                                    line-height: 1.6;
                                ">Sidebar masih kosong.<br>Tambahkan block di sini!</p>
                            </div>
                        @endforelse
                    </aside>
                </div>
            </div>
        @else
            {{-- Full Width Layout - Premium Sections --}}
            @php $sectionIndex = 0; @endphp
            @forelse($sections as $sectionKey => $section)
                @php 
                    $isEven = $sectionIndex % 2 === 0;
                    $sectionBg = $isEven ? '#ffffff' : 'linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%)';
                    $sectionIndex++;
                @endphp
                <section class="page-section-premium" style="
                    background: {{ $sectionBg }};
                    padding: 50px 0;
                    position: relative;
                    overflow: hidden;
                ">
                    {{-- Background decorations --}}
                    @if(!$isEven)
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, {{ $accentColor }}20, transparent);"></div>
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, {{ $accentColor }}20, transparent);"></div>
                    @endif
                    
                    <div class="container" style="position: relative;">
                        {{-- Section Header - Clean Academic Style --}}
                        @if(!empty($section['title']))
                            <div class="section-header-academic" style="
                                text-align: center;
                                margin-bottom: 40px;
                            " data-aos="fade-down">
                                @if(!empty($section['icon']))
                                    <div style="
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                        width: 56px;
                                        height: 56px;
                                        background: {{ $accentColor }}12;
                                        border-radius: 12px;
                                        margin-bottom: 16px;
                                    ">
                                        <i class="{{ $section['icon'] }}" style="font-size: 1.5rem; color: {{ $accentColor }};"></i>
                                    </div>
                                @endif
                                
                                <h2 style="
                                    font-size: clamp(24px, 4vw, 32px);
                                    font-weight: 700;
                                    margin: 0 0 12px 0;
                                    line-height: 1.3;
                                    color: {{ $accentColor }};
                                ">{{ $section['title'] }}</h2>
                                
                                @if(!empty($section['subtitle']))
                                    <p style="
                                        font-size: 15px;
                                        color: #64748b;
                                        max-width: 600px;
                                        margin: 0 auto 16px;
                                        line-height: 1.6;
                                    ">{{ $section['subtitle'] }}</p>
                                @endif
                                
                                {{-- Simple underline --}}
                                <div style="width: 60px; height: 3px; background: {{ $accentColor }}; margin: 0 auto; border-radius: 2px;"></div>
                            </div>
                        @endif
                        
                        {{-- Section Blocks --}}
                        <div class="section-blocks">
                            @foreach($section['blocks'] as $blockIndex => $block)
                                @php $blockType = $block['type'] ?? 'text'; @endphp
                                @if(view()->exists('frontend.pages.blocks.' . $blockType))
                                    <div class="block-wrapper" style="margin-bottom: 40px;" data-aos="fade-up" data-aos-delay="{{ $blockIndex * 100 }}">
                                        @include('frontend.pages.blocks.' . $blockType, ['block' => $block, 'page' => $page, 'inSidebar' => false])
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </section>
            @empty
                <div style="padding: 100px 20px; text-align: center;">
                    <div style="
                        max-width: 500px;
                        margin: 0 auto;
                        background: #fff;
                        padding: 60px 40px;
                        border-radius: 24px;
                        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
                    ">
                        <div style="
                            width: 100px;
                            height: 100px;
                            background: linear-gradient(135deg, {{ $accentColor }}20 0%, {{ $accentColor }}10 100%);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin: 0 auto 24px;
                        ">
                            <i class="fas fa-file-alt" style="font-size: 40px; color: {{ $accentColor }};"></i>
                        </div>
                        <h3 style="color: #1f2937; font-weight: 800; margin: 0 0 12px; font-size: 24px;">Halaman Kosong</h3>
                        <p style="color: #6b7280; margin: 0; font-size: 16px; line-height: 1.6;">Mulai tambahkan block untuk membuat konten halaman yang menarik</p>
                    </div>
                </div>
            @endforelse
        @endif

    @else
        {{-- OLD FORMAT: Backward compatibility --}}
        @php
            $hasHero = !empty($pageData['hero']['title']);
        @endphp

        @if(!$hasHero)
            <div style="background: {{ $accentColor }}; padding: 60px 0; text-align: center;">
                <div class="container">
                    <h1 style="font-size: 42px; font-weight: 900; color: #fff; margin: 0;">{{ $page->title }}</h1>
                </div>
            </div>
        @endif

        @if($hasHero)
            <div style="min-height: 50vh; position: relative; display: flex; align-items: center; justify-content: center; background: {{ $pageData['hero']['bg_color'] ?? $accentColor }};">
                <div class="container" style="text-align: center; padding: 60px 20px;">
                    <h1 style="font-size: 48px; font-weight: 900; color: #fff; margin: 0;">{{ $pageData['hero']['title'] }}</h1>
                    @if(!empty($pageData['hero']['subtitle']))
                        <p style="font-size: 20px; color: rgba(255,255,255,0.9); margin: 20px auto 0; max-width: 600px;">{{ $pageData['hero']['subtitle'] }}</p>
                    @endif
                </div>
            </div>
        @endif

        {{-- OLD FORMAT CONTENT --}}
        @if($layout == 'sidebar')
            <div class="container" style="padding: 60px 15px;">
                <div style="display: grid; grid-template-columns: 1fr 350px; gap: 40px;">
                    <div>
                        @include('frontend.pages.partials.old-format-content', ['pageData' => $pageData, 'page' => $page])
                    </div>
                    <aside style="position: sticky; top: 20px; height: fit-content;">
                        <div style="background: #f8fafc; border-radius: 12px; padding: 25px;">
                            <h3 style="color: {{ $accentColor }}; font-size: 18px; font-weight: 700; margin: 0 0 15px;">📌 Menu</h3>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 10px;"><a href="{{ url('/') }}" style="color: {{ $textColor }}; text-decoration: none;">🏠 Beranda</a></li>
                                <li><a href="{{ url('posts') }}" style="color: {{ $textColor }}; text-decoration: none;">📰 Berita</a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        @else
            {{-- Stats Section --}}
            @if(!empty($pageData['stats']['enabled']) && !empty($pageData['stats']['items']))
                <div style="background: {{ $hasHero ? $accentColor : '#f8fafc' }}; padding: 80px 0;">
                    <div class="container">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 40px; text-align: center; max-width: 1000px; margin: 0 auto;">
                            @foreach($pageData['stats']['items'] as $stat)
                                <div style="background: {{ $hasHero ? 'rgba(255,255,255,0.1)' : '#fff' }}; padding: 40px 30px; border-radius: 16px; {{ $hasHero ? '' : 'box-shadow: 0 4px 25px rgba(0,0,0,0.08);' }}">
                                    <div style="font-size: 40px; margin-bottom: 15px;">{{ $icons[$stat['icon'] ?? 'star'] ?? '⭐' }}</div>
                                    <div style="font-size: 52px; font-weight: 900; color: {{ $hasHero ? '#fff' : $accentColor }};">{{ $stat['number'] ?? '' }}</div>
                                    <div style="font-size: 16px; color: {{ $hasHero ? 'rgba(255,255,255,0.85)' : $textColor }}; margin-top: 10px; font-weight: 500;">{{ $stat['label'] ?? '' }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- About Section --}}
            @if(!empty($pageData['about']['content']))
                <div style="background: {{ $bgColor }};">
                    <div class="container" style="padding: 80px 15px;">
                        <div style="max-width: 800px; margin: 0 auto;">
                            @if(!empty($pageData['about']['heading']))
                                <h2 style="color: {{ $accentColor }}; font-size: 32px; font-weight: 800; margin: 0 0 25px; text-align: center;">{{ $pageData['about']['heading'] }}</h2>
                            @endif
                            <div style="font-size: 17px; line-height: 1.9; color: {{ $textColor }};">
                                {!! nl2br(e($pageData['about']['content'])) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- CTA Section --}}
            @if(!empty($pageData['cta']['heading']))
                <div style="background: {{ $accentColor }}; padding: 80px 0;">
                    <div class="container" style="text-align: center;">
                        <h2 style="font-size: 36px; font-weight: 800; color: #fff; margin: 0 0 15px;">{{ $pageData['cta']['heading'] }}</h2>
                        @if(!empty($pageData['cta']['subheading']))
                            <p style="font-size: 18px; color: rgba(255,255,255,0.9); margin: 0 0 30px;">{{ $pageData['cta']['subheading'] }}</p>
                        @endif
                        @if(!empty($pageData['cta']['btn1_text']) && !empty($pageData['cta']['btn1_link']))
                            <a href="{{ $pageData['cta']['btn1_link'] }}" style="display: inline-block; padding: 16px 40px; background: #fff; color: {{ $accentColor }}; text-decoration: none; border-radius: 8px; font-weight: 700;">{{ $pageData['cta']['btn1_text'] }}</a>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    @endif

</div>

<style>
/* Premium Dynamic Page Styles */
.page-header {
    animation: fadeInDown 0.6s ease;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Floating animation for section icons */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

/* Section animations */
.page-section-premium {
    animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Block wrapper animations */
.block-wrapper {
    animation: slideIn 0.5s ease forwards;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Section header premium styles */
.section-header-premium h2 {
    position: relative;
}

.section-header-premium h2::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 3px;
    background: currentColor;
    transition: width 0.4s ease;
}

.section-header-premium:hover h2::after {
    width: 100px;
}

/* Sidebar Block Hover Effect */
.sidebar-block:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.12) !important;
}

/* Empty State Animation */
.empty-state,
.sidebar-empty {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Responsive Styles */
@media (max-width: 992px) {
    .page-with-sidebar {
        grid-template-columns: 1fr !important;
        gap: 32px !important;
    }
    
    .page-with-sidebar > div,
    .page-with-sidebar > aside {
        order: unset !important;
    }
    
    .sidebar {
        position: static !important;
    }
    
    .page-header h1 {
        font-size: 36px !important;
    }
}

@media (max-width: 768px) {
    .page-header {
        padding: 60px 0 !important;
    }
    
    .page-header h1 {
        font-size: 32px !important;
    }
    
    .empty-state {
        padding: 60px 24px !important;
    }
    
    .sidebar-block {
        margin-bottom: 16px !important;
    }
}

/* Block spacing utilities */
.block-container {
    position: relative;
}

.block-container.padding-none { padding: 0 !important; }
.block-container.padding-small { padding: 40px 0; }
.block-container.padding-medium { padding: 60px 0; }
.block-container.padding-large { padding: 80px 0; }
.block-container.padding-xlarge { padding: 100px 0; }

.block-inner.width-full { max-width: 100%; padding: 0; }
.block-inner.width-contained { max-width: 1140px; margin: 0 auto; padding: 0 15px; }
.block-inner.width-narrow { max-width: 800px; margin: 0 auto; padding: 0 15px; }
.block-inner.width-wide { max-width: 1400px; margin: 0 auto; padding: 0 15px; }

/* Smooth scroll */
html {
    scroll-behavior: smooth;
}

/* Selection color */
::selection {
    background: {{ $accentColor }}33;
    color: {{ $accentColor }};
}

</style>
@endsection
