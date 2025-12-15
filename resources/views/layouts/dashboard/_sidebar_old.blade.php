<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
            <div style="
                background: linear-gradient(145deg, #ffffff, #f0f0f0);
                padding: 6px;
                border-radius: 12px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                transition: transform 0.3s ease;
            " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <img alt="Logo" src="{{ asset('assets/src/images/pppep.png') }}" class="h-50px app-sidebar-logo-default" />
            </div>
            <img alt="Logo" src="{{ asset('assets/src/images/pppep.png') }}" class="h-35px app-sidebar-logo-minimize d-none" />
            <div class="d-flex flex-column ms-3 app-sidebar-logo-default">
                <span class="fs-3 fw-bolder text-uppercase" style="letter-spacing: 1px; font-family: 'Segoe UI', sans-serif; color: #ffffff; text-shadow: 0 0 10px rgba(255,255,255,0.3);">LPMPP UNIB</span>
                <span class="fs-8 fw-light" style="margin-top: -4px; letter-spacing: 0.5px; color: rgba(255,255,255,0.9); text-shadow: 0 0 5px rgba(255,255,255,0.2);">Sistem Integrasi Mutu UNIB</span>
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
                    <!--begin:Menu item-->
                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">MENU UTAMA</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

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

                    <div class="menu-item {{ Route::is('data.warga') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('data.warga') ? 'active' : '' }}" href="{{ route('data.warga') }}">
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
            <!--end:aside menu-->
        </div>
        <!--end:Aside menu-->
    </div>
    <!--end:Aside-->
</div>
<!--end:Aside menu-->
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Elemen Penilaian</span>
                                </a>
                            </div>
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::is('satuanStandar.index','indikatorKinerja.index','instrumenIkss.index') ? 'show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-tasks fs-4"></i>
                            </span>
                            <span class="menu-title">Instrumen RSB</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('satuanStandar.index') ? 'active' : '' }}" href="{{ route('satuanStandar.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Sasaran Strategis</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('indikatorKinerja.index') ? 'active' : '' }}" href="{{ route('indikatorKinerja.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Indikator Kinerja</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('instrumenIkss.index') ? 'active' : '' }}" href="{{ route('instrumenIkss.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Instrumen IKSS</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::is('rsbProdi.index','rsbFakultas.index') ? 'show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-clipboard-list fs-4"></i>
                            </span>
                            <span class="menu-title">Instrumen RSB</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('rsbProdi.index') ? 'active' : '' }}" href="{{ route('rsbProdi.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Program Studi</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('rsbFakultas.index') ? 'active' : '' }}" href="{{ route('rsbFakultas.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Fakultas</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                    <div class="menu-item {{ Route::is('dokumenAmi.index') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('dokumenAmi.index') ? 'active' : '' }}" href="{{ route('dokumenAmi.index') }}">
                            <span class="menu-icon">
                                <i class="fa fa-file-alt fs-4"></i>
                            </span>
                            <span class="menu-title">Dokumen AMI</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PELAKSANAAN AUDIT</span>
                        </div>
                        <!--end:Menu content-->
                    </div>

                    <div class="menu-item {{ Route::is('penugasanAuditor.index') ? 'show' : '' }}">
                        <a class="menu-link {{ Route::is('penugasanAuditor.index') ? 'active' : '' }}" href="{{ route('penugasanAuditor.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-file-alt fs-4"></i>
                            </span>
                            <span class="menu-title">Penugasan Auditor</span>
                        </a>
                    </div>

                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">LAPORAN & HASIL</span>
                        </div>
                        <!--end:Menu content-->
                    </div>

                    <div class="menu-item {{ Route::is('laporan.index','laporan.detail') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
                            <span class="menu-icon">
                                <i class="fa fa-file-alt fs-4"></i>
                            </span>
                            <span class="menu-title">Laporan AMI</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PENGATURAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::is('administrator.index', 'auditor.index', 'auditee.index') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa fa-users fs-4"></i>
                            </span>
                            <span class="menu-title">Data Pengguna</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ Route::is('administrator.index') ? 'active' : '' }}" href="{{ route('administrator.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Administrator</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ Route::is('auditor.index') ? 'active' : '' }}" href="{{ route('auditor.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Auditor</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ Route::is('auditee.index') ? 'active' : '' }}" href="{{ route('auditee.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Auditee</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                    <!-- Kuisioner Auditor -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::is('kuisioner.index','opsiKuisioner.index') ? 'show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-clipboard-list fs-4"></i> {{-- lebih cocok untuk kuisioner --}}
                            </span>
                            <span class="menu-title">Kuisioner Auditor</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('kuisioner.index') ? 'active' : '' }}" href="{{ route('kuisioner.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Data Kuisioner</span>
                                </a>
                            </div>
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('opsiKuisioner.index') ? 'active' : '' }}" href="{{ route('opsiKuisioner.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Opsi Kuisioner</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Evaluasi Auditor -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::is('evaluasiAuditor.index','evaluasiAuditee.index') ? 'show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-clipboard-list fs-4"></i> {{-- lebih cocok untuk evaluasi --}}
                            </span>
                            <span class="menu-title">Data Evaluasi AMI</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('evaluasiAuditor.index') ? 'active' : '' }}" href="{{ route('evaluasiAuditor.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Data Evaluasi Auditor</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('evaluasiAuditee.index') ? 'active' : '' }}" href="{{ route('evaluasiAuditee.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Data Evaluasi Auditee</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="menu-icon">
                                <i class="fa fa-sign-out-alt fs-4 text-danger"></i>
                            </span>
                            <span class="menu-title">Logout</span>
                        </a>
                        <!--end:Menu link-->

                        <!-- Form for logout -->
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
