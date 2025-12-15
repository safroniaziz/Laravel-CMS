<!--begin:Aside menu-->
<div id="kt_aside_menu_wrapper" class="hover-scroll-overlay-y my-2" data-kt-scroll="true" data-kt-scroll-activate-class="scroll-ms" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
    <!--begin:Aside-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin:Logo-->
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
            <img alt="Logo" src="{{ asset('images/logo.png') }}" class="h-50px logo" />
            <div class="ms-3">
                <span class="fs-3 fw-bolder text-uppercase" style="letter-spacing: 1px; font-family: 'Segoe UI', sans-serif; color: #ffffff; text-shadow: 0 0 10px rgba(255,255,255,0.3);">Smart Village</span>
                <div class="fs-7 fw-semibold text-white opacity-75">Ketapang Baru</div>
            </div>
        </a>
        <!--end:Logo-->
    </div>
    <!--end:Aside-->

    <!--begin:Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin:Aside Menu-->
        <div class="hover-scroll-overlay-y mx-3 my-5 my-lg-5" id="kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
            <!--begin:Menu Nav-->
            <ul class="nav nav-flush nav-pills nav-pills-sidebar flex-column mb-7 fs-6" id="kt_aside_menu_nav">
                <!--begin:Menu wrapper-->
                <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu items-->
                    <div data-kt-menu-trigger="click" class="menu-content">
                        <!--begin:Menu item-->
                        <div class="menu-item {{ Route::is('dashboard') ? 'show' : '' }}">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <span class="menu-icon">
                                    <i class="fa fa-tachometer-alt fs-4"></i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->

                        <div class="menu-item ">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">DATA DESA</span>
                            </div>
                            <!--end:Menu content-->
                        </div>

                        <div class="menu-item {{ Route::is('data-warga.*') ? 'show' : '' }}">
                            <a class="menu-link {{ Route::is('data-warga.*') ? 'active' : '' }}" href="{{ route('data-warga.index') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-users fs-4"></i>
                                </span>
                                <span class="menu-title">Data Warga</span>
                            </a>
                        </div>

                        <div class="menu-item {{ Route::is('tentang') ? 'show' : '' }}">
                            <a class="menu-link {{ Route::is('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-home fs-4"></i>
                                </span>
                                <span class="menu-title">Profil Desa</span>
                            </a>
                        </div>

                        <div class="menu-item {{ Route::is('struktur') ? 'show' : '' }}">
                            <a class="menu-link {{ Route::is('struktur') ? 'active' : '' }}" href="{{ route('struktur') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-sitemap fs-4"></i>
                                </span>
                                <span class="menu-title">Struktur Organisasi</span>
                            </a>
                        </div>

                        <div class="menu-item {{ Route::is('statistik') ? 'show' : '' }}">
                            <a class="menu-link {{ Route::is('statistik') ? 'active' : '' }}" href="{{ route('statistik') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-chart-pie fs-4"></i>
                                </span>
                                <span class="menu-title">Statistik Desa</span>
                            </a>
                        </div>

                        <div class="menu-item ">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">LAYANAN</span>
                            </div>
                            <!--end:Menu content-->
                        </div>

                    <div class="menu-item {{ Route::is('admin.pengaduan.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('admin.pengaduan.*') ? 'active' : '' }}" href="{{ route('admin.pengaduan.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-exclamation-triangle fs-4"></i>
                            </span>
                            <span class="menu-title">Manajemen Pengaduan</span>
                        </a>
                    </div>

                    <div class="menu-item {{ Route::is('admin.bantuan.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('admin.bantuan.*') ? 'active' : '' }}" href="{{ route('admin.bantuan.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-hand-holding-heart fs-4"></i>
                            </span>
                            <span class="menu-title">Bantuan Warga</span>
                        </a>
                    </div>

                        <div class="menu-item {{ Route::is('surat.online') ? 'show' : '' }}">
                            <a class="menu-link {{ Route::is('surat.online') ? 'active' : '' }}" href="{{ route('surat.online') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-file-alt fs-4"></i>
                                </span>
                                <span class="menu-title">Surat Online</span>
                            </a>
                        </div>

                        <div class="menu-item ">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">INFORMASI</span>
                            </div>
                            <!--end:Menu content-->
                        </div>

                        <div class="menu-item {{ Route::is('berita') ? 'show' : '' }}">
                            <a class="menu-link {{ Route::is('berita') ? 'active' : '' }}" href="{{ route('berita') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-newspaper fs-4"></i>
                                </span>
                                <span class="menu-title">Berita</span>
                            </a>
                        </div>

                        <div class="menu-item {{ Route::is('pengumuman') ? 'show' : '' }}">
                            <a class="menu-link {{ Route::is('pengumuman') ? 'active' : '' }}" href="{{ route('pengumuman') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-bullhorn fs-4"></i>
                                </span>
                                <span class="menu-title">Pengumuman</span>
                            </a>
                        </div>

                        <div class="menu-item {{ Route::is('peta.desa') ? 'show' : '' }}">
                            <a class="menu-link {{ Route::is('peta.desa') ? 'active' : '' }}" href="{{ route('peta.desa') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-map fs-4"></i>
                                </span>
                                <span class="menu-title">Peta Desa</span>
                            </a>
                        </div>

                    </div>
                    <!--end:Menu items-->
                </div>
                <!--end:Menu wrapper-->
            </ul>
            <!--end:Menu Nav-->
        </div>
        <!--end:Aside Menu-->
    </div>
    <!--end:Aside menu-->
</div>
<!--end:Aside menu-->
