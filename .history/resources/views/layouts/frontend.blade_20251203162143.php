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
            'container_max_width' => App\Models\Setting::where('key', 'layout_container_max_width')->value('value') ?? '1200px',
        ];

        $typographySettings = [
            'primary_font' => App\Models\Setting::where('key', 'typography_primary_font')->value('value') ?? 'Roboto',
            'secondary_font' => App\Models\Setting::where('key', 'typography_secondary_font')->value('value') ?? 'Outfit',
            'google_fonts_url' => App\Models\Setting::where('key', 'typography_google_fonts_url')->value('value') ?? 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap',
            'fontawesome_url' => App\Models\Setting::where('key', 'typography_fontawesome_url')->value('value') ?? 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        ];

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
            'container_max_width' => '1200px',
        ];
        $typographySettings = [
            'primary_font' => 'Roboto',
            'secondary_font' => 'Outfit',
            'google_fonts_url' => 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap',
            'fontawesome_url' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        ];
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
            padding-left: 25px;
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
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
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
                        <li>
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                <span class="menu-text-id">Beranda</span>
                                <span class="menu-text-en">Homepage</span>
                            </a>
                        </li>
                        <li class="has-dropdown">
                            <a href="{{ route('page.show', 'about') }}" class="{{ request()->is('page/about') ? 'active' : '' }}">
                                <span class="menu-text-id">Profil</span>
                                <span class="menu-text-en">Profile</span>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('page.show', 'about') }}">Sejarah</a>
                                <a href="{{ route('page.show', 'about') }}">Visi dan Misi</a>
                                <a href="{{ route('page.show', 'about') }}">Tujuan</a>
                                <a href="{{ route('page.show', 'about') }}">Dosen</a>
                                <a href="{{ route('page.show', 'about') }}">Struktur Organisasi</a>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
                                <span class="menu-text-id">Tri Dharma</span>
                                <span class="menu-text-en">Three Roles</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">
                                <span class="menu-text-id">Kemahasiswaan</span>
                                <span class="menu-text-en">Student Center</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">
                                <span class="menu-text-id">Fasilitas</span>
                                <span class="menu-text-en">Facility</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                                <span class="menu-text-id">Unduh</span>
                                <span class="menu-text-en">Download</span>
                            </a>
                        </li>
                    </ul>
                </nav>

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

    @stack('scripts')
</body>
</html>
