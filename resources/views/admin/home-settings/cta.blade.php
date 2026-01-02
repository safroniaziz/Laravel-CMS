@extends('layouts.dashboard.dashboard')

@section('title', 'CTA Settings')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #fbbf24, #f97316); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                            <i class="fas fa-rocket text-white fs-3"></i>
                        </div>
                        <div>
                            <h1 class="fs-2 fw-bold mb-0">Call to Action Settings</h1>
                            <span class="text-muted fs-7">Pengaturan section CTA di homepage</span>
                        </div>
                    </div>
                </div>
            </div>

            <form id="ctaSettingsForm">
                @csrf
                <input type="hidden" name="type" value="homepage">
                <input type="hidden" name="group" value="homepage">

                {{-- Visibility & Layout --}}
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-eye me-2 text-primary"></i>Tampilan & Layout</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan CTA</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[cta_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[cta_show]" value="1" {{ ($settings['cta_show'] ?? '0') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Aktifkan section CTA di homepage</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Layout Style</label>
                            <div class="col-lg-9">
                                <select name="settings[cta_layout_style]" class="form-select">
                                    <option value="current" {{ ($settings['cta_layout_style'] ?? '') == 'current' ? 'selected' : '' }}>Modern (Default)</option>
                                    <option value="minimal" {{ ($settings['cta_layout_style'] ?? '') == 'minimal' ? 'selected' : '' }}>Minimal</option>
                                    <option value="split" {{ ($settings['cta_layout_style'] ?? '') == 'split' ? 'selected' : '' }}>Split Layout</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Icon --}}
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-icons me-2 text-info"></i>Icon</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon CTA</label>
                            <div class="col-lg-9">
                                <input type="hidden" name="settings[cta_icon]" id="cta_icon_value" value="{{ $settings['cta_icon'] ?? 'fas fa-rocket' }}">
                                <div class="d-flex align-items-center gap-3">
                                    <div id="cta-icon-preview" style="width:56px;height:56px;background:#f3f4f6;border-radius:12px;display:flex;align-items:center;justify-content:center;border:1px solid #e5e7eb;">
                                        <i class="{{ $settings['cta_icon'] ?? 'fas fa-rocket' }}" style="font-size:24px;color:#6366f1;"></i>
                                    </div>
                                    <button type="button" class="btn btn-light-primary" onclick="openIconPicker('cta')">
                                        <i class="fas fa-icons me-2"></i> Pilih Icon
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-align-left me-2 text-success"></i>Konten</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Badge</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[cta_badge_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[cta_badge_show]" value="1" {{ ($settings['cta_badge_show'] ?? '1') == '1' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Badge Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_badge_text]" class="form-control" value="{{ $settings['cta_badge_text'] ?? 'JADILAH BAGIAN DARI REVOLUSI DIGITAL' }}">
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_title]" class="form-control form-control-lg" value="{{ $settings['cta_title'] ?? 'Siap Bergabung Bersama Kami?' }}">
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Subtitle</label>
                            <div class="col-lg-9">
                                <textarea name="settings[cta_subtitle]" class="form-control" rows="2">{{ $settings['cta_subtitle'] ?? 'Daftar sekarang dan raih masa depan cemerlang di bidang Sistem Informasi' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Colors --}}
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-palette me-2 text-warning"></i>Warna</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Background Gradient Start</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[cta_bg_gradient_start]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['cta_bg_gradient_start'] ?? '#0f172a' }}">
                                    <input type="text" class="form-control" style="max-width:120px;" value="{{ $settings['cta_bg_gradient_start'] ?? '#0f172a' }}" id="bg_start_text">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Background Gradient Mid</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[cta_bg_gradient_mid]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['cta_bg_gradient_mid'] ?? '#1a246a' }}">
                                    <input type="text" class="form-control" style="max-width:120px;" value="{{ $settings['cta_bg_gradient_mid'] ?? '#1a246a' }}" id="bg_mid_text">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Background Gradient End</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[cta_bg_gradient_end]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['cta_bg_gradient_end'] ?? '#1a246a' }}">
                                    <input type="text" class="form-control" style="max-width:120px;" value="{{ $settings['cta_bg_gradient_end'] ?? '#1a246a' }}" id="bg_end_text">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Accent Color 1</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[cta_accent_color]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['cta_accent_color'] ?? '#fbbf24' }}">
                                    <input type="text" class="form-control" style="max-width:120px;" value="{{ $settings['cta_accent_color'] ?? '#fbbf24' }}" id="accent1_text">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Accent Color 2</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[cta_accent_color_2]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['cta_accent_color_2'] ?? '#f97316' }}">
                                    <input type="text" class="form-control" style="max-width:120px;" value="{{ $settings['cta_accent_color_2'] ?? '#f97316' }}" id="accent2_text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Primary Button --}}
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-mouse-pointer me-2 text-success"></i>Primary Button</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon</label>
                            <div class="col-lg-9">
                                <input type="hidden" name="settings[cta_primary_button_icon]" id="primary_btn_icon_value" value="{{ $settings['cta_primary_button_icon'] ?? 'fa-rocket' }}">
                                <div class="d-flex align-items-center gap-3">
                                    <div id="primary-btn-icon-preview" style="width:48px;height:48px;background:#f3f4f6;border-radius:10px;display:flex;align-items:center;justify-content:center;border:1px solid #e5e7eb;">
                                        <i class="fas {{ $settings['cta_primary_button_icon'] ?? 'fa-rocket' }}" style="font-size:20px;color:#10b981;"></i>
                                    </div>
                                    <button type="button" class="btn btn-light-success btn-sm" onclick="openIconPicker('primary_btn')">
                                        <i class="fas fa-icons me-1"></i> Pilih Icon
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_primary_button_text]" class="form-control" value="{{ $settings['cta_primary_button_text'] ?? 'Mulai Sekarang' }}">
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Link</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_primary_button_link]" class="form-control" value="{{ $settings['cta_primary_button_link'] ?? '/contact' }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Secondary Button --}}
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-mouse-pointer me-2 text-info"></i>Secondary Button</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon</label>
                            <div class="col-lg-9">
                                <input type="hidden" name="settings[cta_secondary_button_icon]" id="secondary_btn_icon_value" value="{{ $settings['cta_secondary_button_icon'] ?? 'fa-compass' }}">
                                <div class="d-flex align-items-center gap-3">
                                    <div id="secondary-btn-icon-preview" style="width:48px;height:48px;background:#f3f4f6;border-radius:10px;display:flex;align-items:center;justify-content:center;border:1px solid #e5e7eb;">
                                        <i class="fas {{ $settings['cta_secondary_button_icon'] ?? 'fa-compass' }}" style="font-size:20px;color:#3b82f6;"></i>
                                    </div>
                                    <button type="button" class="btn btn-light-info btn-sm" onclick="openIconPicker('secondary_btn')">
                                        <i class="fas fa-icons me-1"></i> Pilih Icon
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_secondary_button_text]" class="form-control" value="{{ $settings['cta_secondary_button_text'] ?? 'Jelajahi Program' }}">
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Link</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_secondary_button_link]" class="form-control" value="{{ $settings['cta_secondary_button_link'] ?? '/about' }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Features --}}
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-star me-2 text-warning"></i>Features (3 Kotak)</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Features</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[cta_features_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[cta_features_show]" value="1" {{ ($settings['cta_features_show'] ?? '1') == '1' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h5 class="mb-4">Feature 1</h5>
                        <div class="row mb-4">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon</label>
                            <div class="col-lg-9">
                                <input type="hidden" name="settings[cta_feature_1_icon]" id="feature1_icon_value" value="{{ $settings['cta_feature_1_icon'] ?? 'fa-graduation-cap' }}">
                                <div class="d-flex align-items-center gap-3">
                                    <div id="feature1-icon-preview" style="width:40px;height:40px;background:#fef3c7;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas {{ $settings['cta_feature_1_icon'] ?? 'fa-graduation-cap' }}" style="font-size:16px;color:#f59e0b;"></i>
                                    </div>
                                    <button type="button" class="btn btn-light-warning btn-sm" onclick="openIconPicker('feature1')">
                                        <i class="fas fa-icons me-1"></i> Icon
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_feature_1_title]" class="form-control" value="{{ $settings['cta_feature_1_title'] ?? 'Pendidikan Berkualitas' }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Description</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_feature_1_description]" class="form-control" value="{{ $settings['cta_feature_1_description'] ?? 'Kurikulum modern dan relevan dengan industri' }}">
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h5 class="mb-4">Feature 2</h5>
                        <div class="row mb-4">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon</label>
                            <div class="col-lg-9">
                                <input type="hidden" name="settings[cta_feature_2_icon]" id="feature2_icon_value" value="{{ $settings['cta_feature_2_icon'] ?? 'fa-laptop-code' }}">
                                <div class="d-flex align-items-center gap-3">
                                    <div id="feature2-icon-preview" style="width:40px;height:40px;background:#fef3c7;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas {{ $settings['cta_feature_2_icon'] ?? 'fa-laptop-code' }}" style="font-size:16px;color:#f59e0b;"></i>
                                    </div>
                                    <button type="button" class="btn btn-light-warning btn-sm" onclick="openIconPicker('feature2')">
                                        <i class="fas fa-icons me-1"></i> Icon
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_feature_2_title]" class="form-control" value="{{ $settings['cta_feature_2_title'] ?? 'Praktik Terbaik' }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Description</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_feature_2_description]" class="form-control" value="{{ $settings['cta_feature_2_description'] ?? 'Pembelajaran berbasis proyek dan kasus nyata' }}">
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h5 class="mb-4">Feature 3</h5>
                        <div class="row mb-4">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon</label>
                            <div class="col-lg-9">
                                <input type="hidden" name="settings[cta_feature_3_icon]" id="feature3_icon_value" value="{{ $settings['cta_feature_3_icon'] ?? 'fa-briefcase' }}">
                                <div class="d-flex align-items-center gap-3">
                                    <div id="feature3-icon-preview" style="width:40px;height:40px;background:#fef3c7;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas {{ $settings['cta_feature_3_icon'] ?? 'fa-briefcase' }}" style="font-size:16px;color:#f59e0b;"></i>
                                    </div>
                                    <button type="button" class="btn btn-light-warning btn-sm" onclick="openIconPicker('feature3')">
                                        <i class="fas fa-icons me-1"></i> Icon
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_feature_3_title]" class="form-control" value="{{ $settings['cta_feature_3_title'] ?? 'Karir Cemerlang' }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Description</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_feature_3_description]" class="form-control" value="{{ $settings['cta_feature_3_description'] ?? 'Jaringan alumni dan peluang kerja luas' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Icon Picker Modal --}}
<div class="modal fade" id="iconPickerModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-icons me-2"></i>Pilih Icon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-4" id="iconSearch" placeholder="Cari icon...">
                <div id="iconGrid" style="max-height:400px;overflow-y:auto;display:grid;grid-template-columns:repeat(auto-fill,minmax(50px,1fr));gap:8px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const popularIcons = [
    'fa-rocket', 'fa-star', 'fa-heart', 'fa-home', 'fa-user', 'fa-users',
    'fa-cog', 'fa-envelope', 'fa-phone', 'fa-map-marker-alt', 'fa-calendar',
    'fa-clock', 'fa-check', 'fa-times', 'fa-plus', 'fa-minus',
    'fa-arrow-right', 'fa-arrow-left', 'fa-chevron-right', 'fa-chevron-down',
    'fa-graduation-cap', 'fa-book', 'fa-pencil-alt', 'fa-pen', 'fa-file',
    'fa-folder', 'fa-image', 'fa-camera', 'fa-video', 'fa-music',
    'fa-bell', 'fa-flag', 'fa-bookmark', 'fa-tag', 'fa-tags',
    'fa-search', 'fa-filter', 'fa-sort', 'fa-list', 'fa-th',
    'fa-trophy', 'fa-medal', 'fa-award', 'fa-crown', 'fa-gem',
    'fa-lightbulb', 'fa-bolt', 'fa-fire', 'fa-sun', 'fa-moon',
    'fa-cloud', 'fa-umbrella', 'fa-tree', 'fa-leaf', 'fa-seedling',
    'fa-building', 'fa-university', 'fa-school', 'fa-hospital', 'fa-church',
    'fa-car', 'fa-bus', 'fa-plane', 'fa-ship', 'fa-bicycle',
    'fa-globe', 'fa-map', 'fa-compass', 'fa-route', 'fa-road',
    'fa-laptop', 'fa-desktop', 'fa-mobile-alt', 'fa-tablet-alt', 'fa-tv',
    'fa-laptop-code', 'fa-code', 'fa-terminal', 'fa-database', 'fa-server',
    'fa-wifi', 'fa-signal', 'fa-battery-full', 'fa-plug', 'fa-power-off',
    'fa-lock', 'fa-unlock', 'fa-key', 'fa-shield-alt', 'fa-fingerprint',
    'fa-dollar-sign', 'fa-euro-sign', 'fa-credit-card', 'fa-wallet', 'fa-coins',
    'fa-chart-line', 'fa-chart-bar', 'fa-chart-pie', 'fa-chart-area', 'fa-percentage',
    'fa-handshake', 'fa-thumbs-up', 'fa-thumbs-down', 'fa-hand-peace', 'fa-hands-helping',
    'fa-comment', 'fa-comments', 'fa-quote-left', 'fa-quote-right', 'fa-bullhorn',
    'fa-briefcase', 'fa-suitcase', 'fa-id-card', 'fa-address-card', 'fa-user-tie',
    'fa-chalkboard-teacher', 'fa-user-graduate', 'fa-microscope', 'fa-flask', 'fa-atom'
];

let currentIconTarget = '';

function openIconPicker(target) {
    currentIconTarget = target;
    renderIcons(popularIcons);
    $('#iconPickerModal').modal('show');
}

function renderIcons(icons) {
    let html = '';
    icons.forEach(icon => {
        html += `<div class="icon-item" onclick="selectIcon('${icon}')" style="padding:12px;text-align:center;cursor:pointer;border-radius:8px;border:1px solid #e5e7eb;transition:all 0.2s;" onmouseover="this.style.background='#f3f4f6';this.style.borderColor='#6366f1'" onmouseout="this.style.background='';this.style.borderColor='#e5e7eb'">
            <i class="fas ${icon}" style="font-size:20px;color:#374151;"></i>
        </div>`;
    });
    $('#iconGrid').html(html);
}

function selectIcon(iconClass) {
    const fullIcon = iconClass.startsWith('fa-') ? iconClass : 'fa-' + iconClass;
    
    if (currentIconTarget === 'cta') {
        $('#cta_icon_value').val('fas ' + fullIcon);
        $('#cta-icon-preview').html(`<i class="fas ${fullIcon}" style="font-size:24px;color:#6366f1;"></i>`);
    } else if (currentIconTarget === 'primary_btn') {
        $('#primary_btn_icon_value').val(fullIcon);
        $('#primary-btn-icon-preview').html(`<i class="fas ${fullIcon}" style="font-size:20px;color:#10b981;"></i>`);
    } else if (currentIconTarget === 'secondary_btn') {
        $('#secondary_btn_icon_value').val(fullIcon);
        $('#secondary-btn-icon-preview').html(`<i class="fas ${fullIcon}" style="font-size:20px;color:#3b82f6;"></i>`);
    } else if (currentIconTarget === 'feature1') {
        $('#feature1_icon_value').val(fullIcon);
        $('#feature1-icon-preview').html(`<i class="fas ${fullIcon}" style="font-size:16px;color:#f59e0b;"></i>`);
    } else if (currentIconTarget === 'feature2') {
        $('#feature2_icon_value').val(fullIcon);
        $('#feature2-icon-preview').html(`<i class="fas ${fullIcon}" style="font-size:16px;color:#f59e0b;"></i>`);
    } else if (currentIconTarget === 'feature3') {
        $('#feature3_icon_value').val(fullIcon);
        $('#feature3-icon-preview').html(`<i class="fas ${fullIcon}" style="font-size:16px;color:#f59e0b;"></i>`);
    }
    
    $('#iconPickerModal').modal('hide');
    Swal.fire({icon:'success',title:'Icon dipilih',timer:1000,showConfirmButton:false});
}

$(document).ready(function() {
    // Sync color inputs
    $('input[type="color"]').on('input', function() {
        $(this).next('input[type="text"]').val(this.value);
    });

    // Icon search
    $('#iconSearch').on('input', function() {
        const q = this.value.toLowerCase();
        const filtered = popularIcons.filter(i => i.toLowerCase().includes(q));
        renderIcons(filtered.length ? filtered : popularIcons);
    });

    // Form submit
    $('#ctaSettingsForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        console.log('Form data:', formData);
        
        Swal.fire({
            title: 'Simpan Pengaturan?',
            text: 'Pastikan semua data sudah benar',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading()});
                $.ajax({
                    url: '{{ route("home-settings.update") }}',
                    type: 'POST',
                    data: formData,
                    success: function(r) { 
                        console.log('Success:', r);
                        Swal.fire({icon:'success',title:'Berhasil!',text:r.message,confirmButtonText:'OK'}); 
                    },
                    error: function(x) { 
                        console.log('Error:', x);
                        Swal.fire({icon:'error',title:'Gagal!',text:x.responseJSON?.message||'Error',confirmButtonText:'OK'}); 
                    }
                });
            }
        });
    });
});
</script>
@endpush
