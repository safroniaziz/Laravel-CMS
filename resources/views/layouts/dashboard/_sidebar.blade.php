<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
            <!-- Logo Icon (No Image) -->
            <div style="
                background: linear-gradient(135deg, #1a246a, #2d3a8c);
                padding: 10px;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(26,36,106,0.3);
                transition: transform 0.3s ease;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
            " class="app-sidebar-logo-default" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-shield-alt" style="color: white; font-size: 24px;"></i>
            </div>
            
            <!-- Minimized Logo -->
            <div style="
                background: linear-gradient(135deg, #1a246a, #2d3a8c);
                padding: 8px;
                border-radius: 10px;
                width: 35px;
                height: 35px;
                display: none;
                align-items: center;
                justify-content: center;
            " class="app-sidebar-logo-minimize">
                <i class="fas fa-shield-alt" style="color: white; font-size: 18px;"></i>
            </div>
            
            <div class="d-flex flex-column ms-3 app-sidebar-logo-default">
                <span class="fs-3 fw-bolder text-uppercase" style="letter-spacing: 1px; font-family: 'Segoe UI', sans-serif; color: #ffffff; text-shadow: 0 0 10px rgba(255,255,255,0.3);">CMS Admin</span>
                <span class="fs-8 fw-light" style="margin-top: -4px; letter-spacing: 0.5px; color: rgba(255,255,255,0.9); text-shadow: 0 0 5px rgba(255,255,255,0.2);">Content Management</span>
            </div>
        </a>

        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-3 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    
                    <!--======================================-->
                    <!--           DASHBOARD SECTION          -->
                    <!--======================================-->
                    <div class="menu-item {{ Route::is('dashboard') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <i class="fa fa-chart-line fs-4"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    <!--======================================-->
                    <!--            KONTEN SECTION            -->
                    <!--======================================-->
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Konten</span>
                        </div>
                    </div>

                    <!-- Posts -->
                    <div class="menu-item {{ Route::is('posts.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('posts.*') ? 'active' : '' }}" href="{{ route('posts.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-newspaper fs-4"></i>
                            </span>
                            <span class="menu-title">Posts</span>
                        </a>
                    </div>

                    <!-- Categories -->
                    <div class="menu-item {{ Route::is('categories.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-folder fs-4"></i>
                            </span>
                            <span class="menu-title">Kategori</span>
                        </a>
                    </div>

                    <!-- Tags -->
                    <div class="menu-item {{ Route::is('tags.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('tags.*') ? 'active' : '' }}" href="{{ route('tags.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-tags fs-4"></i>
                            </span>
                            <span class="menu-title">Tags</span>
                        </a>
                    </div>

                    <!-- Pages -->
                    <div class="menu-item {{ Route::is('pages.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('pages.*') ? 'active' : '' }}" href="{{ route('pages.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-file-alt fs-4"></i>
                            </span>
                            <span class="menu-title">Halaman</span>
                        </a>
                    </div>

                    <!-- Media -->
                    <div class="menu-item {{ Route::is('media.*','galleries.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('media.*','galleries.*') ? 'active' : '' }}" href="{{ route('media.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-images fs-4"></i>
                            </span>
                            <span class="menu-title">Media & Galeri</span>
                        </a>
                    </div>

                    <!-- Teachers -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::is('admin.teachers.*', 'admin.teacher-settings.*') ? 'show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-user-tie fs-4"></i>
                            </span>
                            <span class="menu-title">Dosen</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('admin.teachers.index') ? 'active' : '' }}" href="{{ route('admin.teachers.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Semua Dosen</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('admin.teacher-settings.index') ? 'active' : '' }}" href="{{ route('admin.teacher-settings.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Pengaturan</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!--======================================-->
                    <!--           TAMPILAN SECTION           -->
                    <!--======================================-->
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Tampilan</span>
                        </div>
                    </div>

                    <!-- Menus -->
                    <div class="menu-item {{ Route::is('menus.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('menus.*') ? 'active' : '' }}" href="{{ route('menus.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-bars fs-4"></i>
                            </span>
                            <span class="menu-title">Menu Navigasi</span>
                        </a>
                    </div>

                    <!-- Home Settings -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::is('home-settings.*', 'admin.sliders.*') ? 'show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-home fs-4"></i>
                            </span>
                            <span class="menu-title">Beranda</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('admin.sliders.*') ? 'active' : '' }}" href="{{ route('admin.sliders.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Slider</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('home-settings.hero') ? 'active' : '' }}" href="{{ route('home-settings.hero') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Hero</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('home-settings.news') ? 'active' : '' }}" href="{{ route('home-settings.news') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Berita</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('home-settings.category') ? 'active' : '' }}" href="{{ route('home-settings.category') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Kategori</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('home-settings.kenali') ? 'active' : '' }}" href="{{ route('home-settings.kenali') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Kenali Lebih Dekat</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('home-settings.alumni') ? 'active' : '' }}" href="{{ route('home-settings.alumni') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Kata Alumni</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('home-settings.cta') ? 'active' : '' }}" href="{{ route('home-settings.cta') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Call to Action</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('home-settings.info-card') ? 'active' : '' }}" href="{{ route('home-settings.info-card') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Info Card</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('home-settings.footer') ? 'active' : '' }}" href="{{ route('home-settings.footer') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Footer</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('home-settings.general') ? 'active' : '' }}" href="{{ route('home-settings.general') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Umum</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('home-settings.homepage-builder') ? 'active' : '' }}" href="{{ route('home-settings.homepage-builder') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Custom Sections</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Settings -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::is('blog.settings.*') ? 'show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-blog fs-4"></i>
                            </span>
                            <span class="menu-title">Blog</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('blog.settings.index') ? 'active' : '' }}" href="{{ route('blog.settings.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Halaman Index</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('blog.settings.detail') ? 'active' : '' }}" href="{{ route('blog.settings.detail') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Halaman Detail</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!--======================================-->
                    <!--          PENGATURAN SECTION          -->
                    <!--======================================-->
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Pengaturan</span>
                        </div>
                    </div>

                    <!-- Website Settings -->
                    <div class="menu-item {{ Route::is('admin.settings.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-cog fs-4"></i>
                            </span>
                            <span class="menu-title">Website</span>
                        </a>
                    </div>

                    <!-- Users -->
                    <div class="menu-item {{ Route::is('users.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-users fs-4"></i>
                            </span>
                            <span class="menu-title">Pengguna</span>
                        </a>
                    </div>

                    <!-- Roles -->
                    <div class="menu-item {{ Route::is('roles.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-user-shield fs-4"></i>
                            </span>
                            <span class="menu-title">Roles</span>
                        </a>
                    </div>

                    <!-- Permissions (Admin Only) -->
                    @if(auth()->user()->isAdmin())
                    <div class="menu-item {{ Route::is('permissions.*') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('permissions.*') ? 'active' : '' }}" href="{{ route('permissions.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-key fs-4"></i>
                            </span>
                            <span class="menu-title">Permissions</span>
                        </a>
                    </div>
                    @endif

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
