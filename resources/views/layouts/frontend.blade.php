@php
    // Fetch dynamic layout and typography settings
    try {
        $layoutSettings = [
            'header_bg' => App\Models\Setting::where('key', 'layout_header_bg')->value('value') ?? '#1a246a',
            'nav_hover_bg' => App\Models\Setting::where('key', 'layout_nav_hover_bg')->value('value') ?? 'rgba(255,255,255,0.1)',
            'hero_gradient_start' => App\Models\Setting::where('key', 'layout_hero_gradient_start')->value('value') ?? '#1e3a8a',
            'hero_gradient_end' => App\Models\Setting::where('key', 'layout_hero_gradient_end')->value('value') ?? '#2563eb',
            'hero_accent' => App\Models\Setting::where('key', 'layout_hero_accent')->value('value') ?? '#f97316',
            'news_date_color' => App\Models\Setting::where('key', 'layout_news_date_color')->value('value') ?? '#1e3a8a',
            'news_hover_color' => App\Models\Setting::where('key', 'layout_news_hover_color')->value('value') ?? '#f97316',
            'team_gradient_start' => App\Models\Setting::where('key', 'layout_team_gradient_start')->value('value') ?? '#1e3a8a',
            'team_gradient_end' => App\Models\Setting::where('key', 'layout_team_gradient_end')->value('value') ?? '#2563eb',
            'container_max_width' => App\Models\Setting::where('key', 'layout_container_max_width')->value('value') ?? '1300px',
        ];

        $typographySettings = [
            'primary_font' => App\Models\Setting::where('key', 'typography_primary_font')->value('value') ?? 'Roboto',
            'secondary_font' => App\Models\Setting::where('key', 'typography_secondary_font')->value('value') ?? 'Outfit',
            'google_fonts_url' => App\Models\Setting::where('key', 'typography_google_fonts_url')->value('value') ?? 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap',
            'fontawesome_url' => App\Models\Setting::where('key', 'typography_fontawesome_url')->value('value') ?? 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        ];

        // Fetch dynamic menu from database
        $mainMenu = App\Models\Menu::where('location', 'main')
            ->where('is_active', true)
            ->with(['items' => function($query) {
                $query->whereNull('parent_id')->orderBy('order');
            }, 'items.children' => function($query) {
                $query->orderBy('order');
            }, 'items.children.children' => function($query) {
                $query->orderBy('order');
            }])
            ->first();

        $navigationSettings = [
            'beranda_id' => App\Models\Setting::where('key', 'nav_menu_beranda_id')->value('value') ?? 'Beranda',
            'beranda_en' => App\Models\Setting::where('key', 'nav_menu_beranda_en')->value('value') ?? 'Homepage',
            'profil_id' => App\Models\Setting::where('key', 'nav_menu_profil_id')->value('value') ?? 'Profil',
            'profil_en' => App\Models\Setting::where('key', 'nav_menu_profil_en')->value('value') ?? 'Profile',
            'tridharma_id' => App\Models\Setting::where('key', 'nav_menu_tridharma_id')->value('value') ?? 'Tri Dharma',
            'tridharma_en' => App\Models\Setting::where('key', 'nav_menu_tridarma_en')->value('value') ?? 'Three Roles',
            'kemahasiswaan_id' => App\Models\Setting::where('key', 'nav_menu_kemahasiswaan_id')->value('value') ?? 'Kemahasiswaan',
            'kemahasiswaan_en' => App\Models\Setting::where('key', 'nav_menu_kemahasiswaan_en')->value('value') ?? 'Student Center',
            'fasilitas_id' => App\Models\Setting::where('key', 'nav_menu_fasilitas_id')->value('value') ?? 'Fasilitas',
            'fasilitas_en' => App\Models\Setting::where('key', 'nav_menu_fasilitas_en')->value('value') ?? 'Facility',
            'unduh_id' => App\Models\Setting::where('key', 'nav_menu_unduh_id')->value('value') ?? 'Unduh',
            'unduh_en' => App\Models\Setting::where('key', 'nav_menu_unduh_en')->value('value') ?? 'Download',
            'sejarah' => App\Models\Setting::where('key', 'nav_dropdown_sejarah')->value('value') ?? 'Sejarah',
            'visi_misi' => App\Models\Setting::where('key', 'nav_dropdown_visi_misi')->value('value') ?? 'Visi dan Misi',
            'tujuan' => App\Models\Setting::where('key', 'nav_dropdown_tujuan')->value('value') ?? 'Tujuan',
            'dosen' => App\Models\Setting::where('key', 'nav_dropdown_dosen')->value('value') ?? 'Dosen',
            'struktur' => App\Models\Setting::where('key', 'nav_dropdown_struktur')->value('value') ?? 'Struktur Organisasi',
        ];
    } catch (\Exception $e) {
        // Fallback values if database is not available
        $layoutSettings = [
            'header_bg' => '#1a246a',
            'nav_hover_bg' => 'rgba(255,255,255,0.1)',
            'hero_gradient_start' => '#1e3a8a',
            'hero_gradient_end' => '#2563eb',
            'hero_accent' => '#f97316',
            'news_date_color' => '#1e3a8a',
            'news_hover_color' => '#f97316',
            'team_gradient_start' => '#1e3a8a',
            'team_gradient_end' => '#2563eb',
            'container_max_width' => '1300px',
        ];
        $typographySettings = [
            'primary_font' => 'Roboto',
            'secondary_font' => 'Outfit',
            'google_fonts_url' => 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap',
            'fontawesome_url' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        ];
        $mainMenu = null; // Fallback if database is not available
        $navigationSettings = [
            'beranda_id' => 'Beranda', 'beranda_en' => 'Homepage',
            'profil_id' => 'Profil', 'profil_en' => 'Profile',
            'tridharma_id' => 'Tri Dharma', 'tridharma_en' => 'Three Roles',
            'kemahasiswaan_id' => 'Kemahasiswaan', 'kemahasiswaan_en' => 'Student Center',
            'fasilitas_id' => 'Fasilitas', 'fasilitas_en' => 'Facility',
            'unduh_id' => 'Unduh', 'unduh_en' => 'Download',
            'sejarah' => 'Sejarah', 'visi_misi' => 'Visi dan Misi', 'tujuan' => 'Tujuan',
            'dosen' => 'Dosen', 'struktur' => 'Struktur Organisasi',
        ];
    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seoTitle ?? $siteSettings['name'] }}</title>
    <meta name="description" content="{{ $seoDescription ?? $siteSettings['tagline'] }}">
    <meta name="keywords" content="{{ $seoKeywords ?? '' }}">

    @if($siteSettings['favicon'])
        <link rel="icon" href="{{ asset($siteSettings['favicon']) }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{ $typographySettings['google_fonts_url'] }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ $typographySettings['fontawesome_url'] }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: '{{ $typographySettings['primary_font'] }}', sans-serif;
            color: #333;
            line-height: 1.6;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: {{ $layoutSettings['container_max_width'] }};
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header - Dynamic Style */
        .main-header {
            background: {{ $layoutSettings['header_bg'] }};
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: #fff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: {{ $layoutSettings['header_bg'] }};
        }

        .logo-section img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .logo-text h1 {
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            margin: 0;
            line-height: 1.2;
        }

        .logo-text p {
            font-size: 12px;
            color: rgba(255,255,255,0.8);
            margin: 0;
            font-weight: 400;
        }

        /* Main Navigation - UNIB Style */
        .main-nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 0;
        }

        .main-nav li {
            position: relative;
        }

        .main-nav a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px 25px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
            border-left: 1px solid rgba(255,255,255,0.1);
        }

        .main-nav li:last-child a {
            border-right: 1px solid rgba(255,255,255,0.1);
        }

        .main-nav a:hover,
        .main-nav a.active {
            background: {{ $layoutSettings['nav_hover_bg'] }};
        }
        
        .menu-text-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        
        .menu-title-row {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 6px;
        }
        
        .menu-title-row i {
            font-size: 16px;
        }
        
        .dropdown-indicator {
            font-size: 10px !important;
            margin-left: 5px;
            transition: transform 0.3s;
        }
        
        .main-nav li.has-dropdown:hover .dropdown-indicator {
            transform: rotate(180deg);
        }

        .menu-text-id {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 2px;
            line-height: 1;
        }

        .menu-text-en {
            font-size: 12px;
            font-weight: 400;
            font-style: italic;
            opacity: 0.85;
            line-height: 1;
        }

        /* Dropdown Menu */
        .main-nav li.has-dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: #1a2547;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
            z-index: 1000;
        }

        .main-nav li.has-dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu a {
            display: block;
            padding: 12px 20px;
            color: #fff;
            font-size: 14px;
            border-left: none;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .dropdown-menu a:hover {
            background: rgba(255,255,255,0.15);
        }
        
        /* 3-Level Nested Dropdown */
        .dropdown-item-wrapper {
            position: relative;
        }
        
        .dropdown-item {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .dropdown-item span {
            flex: 1;
        }
        
        .dropdown-item i:first-child {
            min-width: 20px;
            width: 20px;
            text-align: center;
            margin-right: 5px;
        }
        
        .dropdown-item.has-submenu {
            padding-right: 35px;
        }
        
        .submenu-indicator {
            position: absolute;
            right: 15px;
            font-size: 10px;
            opacity: 0.7;
        }
        
        .nested-dropdown-menu {
            position: absolute;
            left: 100%;
            background: #14203f;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            opacity: 0;
            visibility: hidden;
            transform: translateX(-10px);
            transition: all 0.3s;
            z-index: 1001;
        }
        
        .dropdown-item-wrapper:hover .nested-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }
        
        .nested-dropdown-menu .dropdown-item {
            padding: 10px 20px;
            font-size: 13px;
        }
        
        .nested-dropdown-menu .dropdown-item:hover {
            background: rgba(255,255,255,0.1);
        }
        
        /* Login Button */
        .login-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #f97316, #fb923c);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
            margin-left: 15px;
        }
        
        .login-btn:hover {
            background: linear-gradient(135deg, #ea580c, #f97316);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(249, 115, 22, 0.4);
        }
        
        .login-btn i {
            font-size: 14px;
        }

        .mobile-toggle {
            display: none;
            background: #f97316;
            border: none;
            color: #fff;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Hero Section - Dynamic Style */
        .hero-section {
            background: linear-gradient(135deg, {{ $layoutSettings['hero_gradient_start'] }} 0%, {{ $layoutSettings['hero_gradient_end'] }} 100%);
            position: relative;
            overflow: hidden;
            padding: 60px 0;
        }

        .hero-content-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-text {
            color: #fff;
        }

        .hero-text h1 {
            font-size: 48px;
            font-weight: 900;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-text h1 span {
            color: {{ $layoutSettings['hero_accent'] }};
        }

        .hero-text p {
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .hero-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .hero-feature {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hero-feature i {
            color: {{ $layoutSettings['hero_accent'] }};
            font-size: 20px;
            width: 24px;
        }

        .hero-feature-text h4 {
            font-size: 14px;
            font-weight: 700;
            margin: 0 0 2px 0;
        }

        .hero-feature-text p {
            font-size: 12px;
            margin: 0;
            opacity: 0.9;
        }

        .hero-illustration {
            position: relative;
        }

        .hero-illustration-shape {
            position: absolute;
            right: -50px;
            top: 50%;
            transform: translateY(-50%);
            width: 250px;
            height: 400px;
            background: {{ $layoutSettings['hero_accent'] }};
            clip-path: polygon(30% 0%, 100% 0%, 100% 100%, 0% 100%);
            z-index: 1;
        }

        .hero-illustration-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .hero-illustration i {
            font-size: 180px;
            color: #fff;
            filter: drop-shadow(0 10px 30px rgba(0,0,0,0.3));
        }

        /* Section */
        .section {
            padding: 60px 0;
            margin: 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-label {
            display: inline-block;
            padding: 6px 20px;
            background: {{ $layoutSettings['hero_gradient_start'] }};
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            border-radius: 3px;
        }

        .section-title {
            font-size: 32px;
            font-weight: 900;
            color: {{ $layoutSettings['hero_gradient_start'] }};
            margin-bottom: 10px;
        }

        /* News Cards - UNIB Style */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .news-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }

        .news-image {
            position: relative;
            width: 100%;
            padding-top: 75%;
            background: #e5e7eb;
            overflow: hidden;
        }

        .news-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .news-date {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .news-date-day {
            display: block;
            font-size: 24px;
            font-weight: 900;
            color: {{ $layoutSettings['news_date_color'] }};
            line-height: 1;
        }

        .news-date-month {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #666;
            text-transform: uppercase;
        }

        .news-content {
            padding: 20px;
        }

        .news-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .news-title a {
            color: inherit;
            text-decoration: none;
        }

        .news-title a:hover {
            color: {{ $layoutSettings['news_hover_color'] }};
        }

        .news-excerpt {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .news-meta {
            font-size: 13px;
            color: #999;
        }

        /* Team Cards - UNIB Style */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .team-card {
            background: linear-gradient(135deg, {{ $layoutSettings['team_gradient_start'] }} 0%, {{ $layoutSettings['team_gradient_end'] }} 100%);
            border-radius: 8px;
            text-align: center;
            padding: 30px 20px;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .team-card:hover {
            transform: translateY(-5px);
        }

        .team-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #fff;
            margin: 0 auto 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .team-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-photo-placeholder {
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .team-photo-placeholder i {
            font-size: 50px;
            color: #fff;
        }

        .team-name {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .team-title {
            font-size: 13px;
            opacity: 0.9;
        }


        /* Responsive */
        @media (max-width: 768px) {
            .mobile-toggle {
                display: block;
            }

            .main-nav {
                position: fixed;
                top: 0;
                left: -100%;
                width: 280px;
                height: 100vh;
                background: #1e3a8a;
                transition: left 0.3s;
                z-index: 9999;
            }

            .main-nav.active {
                left: 0;
            }

            .main-nav ul {
                flex-direction: column;
                padding: 80px 0 20px;
            }

            .hero-content-wrapper {
                grid-template-columns: 1fr;
            }

            .news-grid,
            .team-grid {
                grid-template-columns: 1fr;
            }

                    }
    </style>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Header - UNIB Style -->
    <header class="main-header" id="mainHeader">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    @if($siteSettings['logo'])
                        <img src="{{ asset($siteSettings['logo']) }}" alt="{{ $siteSettings['name'] }}">
                    @else
                        <div class="logo-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    @endif
                    <div class="logo-text">
                        <h1>{{ $siteSettings['name'] ?? 'SISTEM INFORMASI' }}</h1>
                        @if($siteSettings['tagline'])
                            <p>{{ $siteSettings['tagline'] }}</p>
                        @else
                            <p>Universitas Bengkulu</p>
                        @endif
                    </div>
                </div>

                <nav class="main-nav" id="mainNav">
                    <ul>
                        @if($mainMenu && $mainMenu->items->count() > 0)
                            {{-- Dynamic Menu from Database --}}
                            @foreach($mainMenu->items as $item)
                                <li @if($item->children->count() > 0) class="has-dropdown" @endif>
                                    <a href="{{ $item->full_url }}"
                                       class="{{ request()->is(trim($item->url, '/')) ? 'active' : '' }}"
                                       @if($item->target !== '_self') target="{{ $item->target }}" @endif>
                                        <div class="menu-text-wrapper">
                                            <div class="menu-title-row">
                                                @if($item->icon_class)
                                                    <i class="{{ $item->icon_class }}"></i>
                                                @endif
                                                <span class="menu-text-id">{{ $item->title }}</span>
                                                @if($item->children->count() > 0)
                                                    <i class="fas fa-chevron-down dropdown-indicator"></i>
                                                @endif
                                            </div>
                                            <span class="menu-text-en">{{ $item->title }}</span>
                                        </div>
                                    </a>

                                    @if($item->children->count() > 0)
                                        <div class="dropdown-menu">
                                            @foreach($item->children as $child)
                                                @if($child->children->count() > 0)
                                                    {{-- Item with submenu - needs wrapper for hover --}}
                                                    <div class="dropdown-item-wrapper">
                                                        <a href="{{ $child->full_url }}"
                                                           @if($child->target !== '_self') target="{{ $child->target }}" @endif
                                                           class="dropdown-item has-submenu">
                                                            @if($child->icon_class)
                                                                <i class="{{ $child->icon_class }}"></i>
                                                            @endif
                                                            <span>{{ $child->title }}</span>
                                                            <i class="fas fa-chevron-right submenu-indicator"></i>
                                                        </a>
                                                        
                                                        {{-- Nested dropdown (3rd level) --}}
                                                        <div class="nested-dropdown-menu">
                                                            @foreach($child->children as $grandchild)
                                                                <a href="{{ $grandchild->full_url }}"
                                                                   @if($grandchild->target !== '_self') target="{{ $grandchild->target }}" @endif
                                                                   class="dropdown-item">
                                                                    @if($grandchild->icon_class)
                                                                        <i class="{{ $grandchild->icon_class }}"></i>
                                                                    @endif
                                                                    <span>{{ $grandchild->title }}</span>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    {{-- Regular item without submenu --}}
                                                    <a href="{{ $child->full_url }}"
                                                       @if($child->target !== '_self') target="{{ $child->target }}" @endif
                                                       class="dropdown-item">
                                                        @if($child->icon_class)
                                                            <i class="{{ $child->icon_class }}"></i>
                                                        @endif
                                                        <span>{{ $child->title }}</span>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </nav>

                {{-- Auth Button --}}
                {{-- Auth Button --}}
                @auth
                    <div class="user-menu-wrapper">
                        <button class="user-menu-trigger" onclick="toggleUserMenu()">
                            <div class="user-avatar-circle">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down arrow-icon"></i>
                        </button>
                        
                        <div class="user-dropdown-menu" id="userDropdown">
                            <div class="dropdown-header">
                                <div class="user-info">
                                    <p class="name">{{ Auth::user()->name }}</p>
                                    <p class="email">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            
                            <a href="{{ route('dashboard') }}" class="dropdown-item">
                                <i class="fas fa-columns"></i>
                                <span>Dashboard</span>
                            </a>
                            
                            <div class="dropdown-divider"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <style>
                        .user-menu-wrapper {
                            position: relative;
                        }

                        .user-menu-trigger {
                            display: flex;
                            align-items: center;
                            gap: 10px;
                            padding: 6px 16px 6px 6px;
                            background: #fff;
                            border: 1px solid #e2e8f0;
                            border-radius: 30px;
                            cursor: pointer;
                            transition: all 0.2s ease;
                        }

                        .user-menu-trigger:hover {
                            background: #f8fafc;
                            border-color: #cbd5e1;
                            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
                        }

                        .user-avatar-circle {
                            width: 32px;
                            height: 32px;
                            background: linear-gradient(135deg, #3b82f6, #2563eb);
                            color: #fff;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-weight: 700;
                            font-size: 14px;
                        }

                        .user-name {
                            font-size: 14px;
                            font-weight: 600;
                            color: #334155;
                            max-width: 120px;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        .arrow-icon {
                            font-size: 10px;
                            color: #94a3b8;
                            transition: transform 0.2s ease;
                        }

                        .user-menu-wrapper.active .arrow-icon {
                            transform: rotate(180deg);
                        }

                        .user-dropdown-menu {
                            position: absolute;
                            top: calc(100% + 10px);
                            right: 0;
                            width: 220px;
                            background: #fff;
                            border-radius: 16px;
                            box-shadow: 0 10px 30px -5px rgba(0,0,0,0.1);
                            border: 1px solid #f1f5f9;
                            opacity: 0;
                            visibility: hidden;
                            transform: translateY(10px);
                            transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
                            z-index: 50;
                            overflow: hidden;
                        }

                        .user-menu-wrapper.active .user-dropdown-menu {
                            opacity: 1;
                            visibility: visible;
                            transform: translateY(0);
                        }

                        .dropdown-header {
                            padding: 16px;
                            background: #f8fafc;
                            border-bottom: 1px solid #e2e8f0;
                        }

                        .user-info .name {
                            font-size: 14px;
                            font-weight: 700;
                            color: #1e293b;
                            margin: 0;
                        }

                        .user-info .email {
                            font-size: 12px;
                            color: #64748b;
                            margin: 2px 0 0 0;
                        }

                        .dropdown-item {
                            display: flex;
                            align-items: center;
                            gap: 12px;
                            padding: 12px 16px;
                            color: #475569;
                            text-decoration: none;
                            font-size: 14px;
                            font-weight: 500;
                            transition: all 0.2s;
                            width: 100%;
                            background: none;
                            border: none;
                            cursor: pointer;
                            text-align: left;
                        }

                        .dropdown-item:hover {
                            background: #f1f5f9;
                            color: #1a246a;
                        }

                        .dropdown-item.text-danger {
                            color: #ef4444;
                        }

                        .dropdown-item.text-danger:hover {
                            background: #fef2f2;
                            color: #dc2626;
                        }

                        .dropdown-divider {
                            height: 1px;
                            background: #f1f5f9;
                            margin: 4px 0;
                        }
                    </style>

                    <script>
                        function toggleUserMenu() {
                            const wrapper = document.querySelector('.user-menu-wrapper');
                            wrapper.classList.toggle('active');
                        }

                        // Close when clicking outside
                        document.addEventListener('click', function(e) {
                            const wrapper = document.querySelector('.user-menu-wrapper');
                            if (wrapper && !wrapper.contains(e.target)) {
                                wrapper.classList.remove('active');
                            }
                        });
                    </script>
                @else
                    <a href="{{ route('login') }}" class="login-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                @endauth

                <button class="mobile-toggle" id="mobileToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main style="margin: 0; padding: 0;">
        @yield('content')
    </main>
    {{-- Footer is provided by other-sections.blade.php which is included in all pages --}}


    <script>
        // Mobile Menu
        const mobileToggle = document.getElementById('mobileToggle');
        const mainNav = document.getElementById('mainNav');

        if (mobileToggle) {
            mobileToggle.addEventListener('click', () => {
                mainNav.classList.toggle('active');
            });

            document.addEventListener('click', (e) => {
                if (!mainNav.contains(e.target) && !mobileToggle.contains(e.target)) {
                    mainNav.classList.remove('active');
                }
            });
        }

        // Sticky Header Effect
        const mainHeader = document.getElementById('mainHeader');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 100) {
                mainHeader.classList.add('scrolled');
            } else {
                mainHeader.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });
    </script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-add AOS to elements without it
            const elements = document.querySelectorAll('.block-wrapper, .gallery-section, .sidebar-block, .section-header-premium, .block-text, [id^="slider"], [id^="text-"], [id^="stats-"]');
            
            elements.forEach((el, index) => {
                if (!el.hasAttribute('data-aos')) {
                    el.setAttribute('data-aos', 'fade-up');
                    el.setAttribute('data-aos-duration', '800');
                    el.setAttribute('data-aos-delay', String((index % 3) * 150));
                }
            });
            
            // Gallery items - stagger animation
            document.querySelectorAll('.gallery-item').forEach((el, index) => {
                if (!el.hasAttribute('data-aos')) {
                    el.setAttribute('data-aos', 'zoom-in');
                    el.setAttribute('data-aos-duration', '500');
                    el.setAttribute('data-aos-delay', String((index % 6) * 100));
                }
            });
            
            // Initialize AOS with smooth settings
            AOS.init({
                duration: 800,
                easing: 'ease-out-quart',
                once: false,
                mirror: false,
                offset: 120,
                anchorPlacement: 'top-bottom'
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
