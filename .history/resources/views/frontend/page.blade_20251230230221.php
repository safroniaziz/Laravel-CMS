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

<div class="dynamic-page" style="background: {{ $bgColor }}; min-height: 100vh;">

    @if($isNewFormat)
        {{-- NEW FORMAT: Array of blocks with flexible layout --}}
        @php
            // Sort blocks by order
            usort($pageData, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

            // Separate blocks by placement
            $heroBlocks = array_filter($pageData, fn($b) => ($b['type'] ?? '') === 'hero');
            $mainBlocks = array_filter($pageData, fn($b) => ($b['type'] ?? '') !== 'hero' && ($b['settings']['placement'] ?? 'main') === 'main');
            $sidebarBlocks = array_filter($pageData, fn($b) => ($b['settings']['placement'] ?? 'main') === 'sidebar');

            $hasSidebar = in_array($layout, ['sidebar-left', 'sidebar-right']) && count($sidebarBlocks) > 0;
        @endphp

        {{-- Render hero blocks first (always full width) --}}
        @foreach($heroBlocks as $block)
            @include('frontend.pages.blocks.hero', ['block' => $block, 'page' => $page])
        @endforeach

        {{-- If no hero, show title header --}}
        @if(count($heroBlocks) === 0)
            <div style="background: {{ $accentColor }}; padding: 60px 0; text-align: center;">
                <div class="container">
                    <h1 style="font-size: 42px; font-weight: 900; color: #fff; margin: 0;">{{ $page->title }}</h1>
                </div>
            </div>
        @endif

        {{-- Content area - full width or with sidebar --}}
        @if($hasSidebar)
            <div class="container" style="padding: 60px 15px;">
                <div class="page-with-sidebar" style="display: grid; grid-template-columns: {{ $layout === 'sidebar-left' ? '320px 1fr' : '1fr 320px' }}; gap: 40px;">
                    {{-- Main Content --}}
                    <div style="order: {{ $layout === 'sidebar-left' ? 2 : 1 }}; min-width: 0;">
                        @forelse($mainBlocks as $block)
                            @php $blockType = $block['type'] ?? 'text'; @endphp
                            @if(view()->exists('frontend.pages.blocks.' . $blockType))
                                @include('frontend.pages.blocks.' . $blockType, ['block' => $block, 'page' => $page, 'inSidebar' => false])
                            @endif
                        @empty
                            <div style="text-align: center; padding: 60px 20px; color: #9ca3af;">
                                <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                                <p style="margin: 0;">Konten utama belum ada</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Dynamic Sidebar --}}
                    <aside style="order: {{ $layout === 'sidebar-left' ? 1 : 2 }}; position: sticky; top: 20px; height: fit-content;">
                        @forelse($sidebarBlocks as $block)
                            @php $blockType = $block['type'] ?? 'text'; @endphp
                            @if(view()->exists('frontend.pages.blocks.' . $blockType))
                                <div style="margin-bottom: 20px;">
                                    @include('frontend.pages.blocks.' . $blockType, ['block' => $block, 'page' => $page, 'inSidebar' => true])
                                </div>
                            @endif
                        @empty
                            <div style="background: #f8fafc; border-radius: 12px; padding: 25px; text-align: center; color: #9ca3af;">
                                <i class="fas fa-sidebar" style="font-size: 32px; margin-bottom: 12px; opacity: 0.5;"></i>
                                <p style="margin: 0; font-size: 14px;">Sidebar kosong</p>
                            </div>
                        @endforelse
                    </aside>
                </div>
            </div>
        @else
            {{-- Full Width Layout --}}
            @forelse($mainBlocks as $block)
                @php $blockType = $block['type'] ?? 'text'; @endphp
                @if(view()->exists('frontend.pages.blocks.' . $blockType))
                    @include('frontend.pages.blocks.' . $blockType, ['block' => $block, 'page' => $page, 'inSidebar' => false])
                @endif
            @empty
                <div class="container" style="padding: 80px 15px; text-align: center; color: #9ca3af;">
                    <i class="fas fa-file-alt" style="font-size: 64px; margin-bottom: 20px; opacity: 0.5;"></i>
                    <h3 style="color: #6b7280; font-weight: 600; margin: 0 0 10px;">Halaman Kosong</h3>
                    <p style="margin: 0;">Belum ada konten di halaman ini</p>
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
                                <li style="margin-bottom: 10px;"><a href="/" style="color: {{ $textColor }}; text-decoration: none;">🏠 Beranda</a></li>
                                <li><a href="/posts" style="color: {{ $textColor }}; text-decoration: none;">📰 Berita</a></li>
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
/* Responsive Styles */
@media (max-width: 992px) {
    .page-with-sidebar {
        grid-template-columns: 1fr !important;
    }
    .page-with-sidebar > div,
    .page-with-sidebar > aside {
        order: unset !important;
    }
    .page-with-sidebar > aside {
        position: static !important;
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
</style>
@endsection
