@extends('layouts.dashboard.dashboard')

@section('title', 'Alumni Settings')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            {{-- Page Header --}}
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #ff6b35, #f7931e); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                            <i class="fas fa-user-graduate text-white fs-3"></i>
                        </div>
                        <div>
                            <h1 class="fs-2 fw-bold mb-0">Kata Alumni Settings</h1>
                            <span class="text-muted fs-7">Pengaturan section Kata Alumni</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Settings Form --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Kata Alumni</h3>
                </div>
                <div class="card-body">
                    <form id="alumniSettingsForm">
                        @csrf
                        <input type="hidden" name="type" value="alumni">
                        
                        {{-- Show Section Toggle --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Section</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[show]" value="1" {{ ($settings['show'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tampilkan Kata Alumni di Homepage</label>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        
                        {{-- Layout Style --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Layout Style</label>
                            <div class="col-lg-9">
                                <select name="settings[layout_style]" class="form-select">
                                    <option value="current" {{ ($settings['layout_style'] ?? 'current') == 'current' ? 'selected' : '' }}>Current Split Layout (Statistik & Testimoni)</option>
                                    <option value="grid" {{ ($settings['layout_style'] ?? '') == 'grid' ? 'selected' : '' }}>Grid Cards Layout (Kartu Alumni)</option>
                                    <option value="carousel" {{ ($settings['layout_style'] ?? '') == 'carousel' ? 'selected' : '' }}>Carousel/Slider Layout</option>
                                </select>
                                <small class="text-muted d-block mt-2">Pilih tampilan layout untuk section Kata Alumni.</small>
                            </div>
                        </div>

                        {{-- Section Header --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Section Header</h4>
                        <p class="text-muted mb-4">Pengaturan judul dan deskripsi section alumni.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-text" id="section_icon_preview" style="min-width: 50px; justify-content: center; font-size: 20px;">{{ $settings['section_icon'] ?? '🎓' }}</span>
                                    <input type="text" name="settings[section_icon]" id="section_icon" class="form-control" value="{{ $settings['section_icon'] ?? '🎓' }}" readonly>
                                    <button type="button" class="btn btn-light-primary" onclick="openIconPicker('section_icon')">
                                        <i class="fas fa-icons me-1"></i>Pilih Icon
                                    </button>
                                    <button type="button" class="btn btn-light-danger" onclick="clearIcon('section_icon', '🎓')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Emoji atau icon FontAwesome untuk header section</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Badge Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[section_badge_text]" class="form-control" value="{{ $settings['section_badge_text'] ?? 'KATA ALUMNI' }}">
                                <small class="text-muted">Teks kecil di atas judul utama</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[section_title]" class="form-control" value="{{ $settings['section_title'] ?? 'KATA ALUMNI' }}">
                                <small class="text-muted">Judul utama section</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title Highlight</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[section_title_highlight]" class="form-control" value="{{ $settings['section_title_highlight'] ?? 'SISTEM INFORMASI' }}">
                                <small class="text-muted">Bagian judul yang akan di-highlight warna aksen</small>
                            </div>
                        </div>

                        {{-- CTA Settings --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">CTA Button</h4>
                        <p class="text-muted mb-4">Tombol ajakan bertindak.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">CTA Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_text]" class="form-control" value="{{ $settings['cta_text'] ?? 'Lihat Semua Alumni' }}">
                                <small class="text-muted">Teks pada tombol</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">CTA Link</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_link]" class="form-control" value="{{ $settings['cta_link'] ?? '/alumni' }}">
                                <small class="text-muted">Link tujuan tombol</small>
                            </div>
                        </div>

                        {{-- Colors --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Color Settings</h4>
                        <p class="text-muted mb-4">Pengaturan warna aksen, background, dan elemen lainnya.</p>

                        <!-- Background Gradient -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="fw-semibold fs-6 text-primary mb-3"><i class="fas fa-fill-drip me-2"></i>Background Gradient</label>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">BG Gradient Start</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[bg_gradient_start]" class="form-control form-control-color" value="{{ $settings['bg_gradient_start'] ?? '#f8fafc' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['bg_gradient_start'] ?? '#f8fafc' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna awal background section</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">BG Gradient End</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[bg_gradient_end]" class="form-control form-control-color" value="{{ $settings['bg_gradient_end'] ?? '#ffffff' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['bg_gradient_end'] ?? '#ffffff' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna akhir background section</small>
                            </div>
                        </div>

                        <!-- Accent Colors -->
                        <div class="row mb-4 mt-8">
                            <div class="col-12">
                                <label class="fw-semibold fs-6 text-primary mb-3"><i class="fas fa-palette me-2"></i>Accent Colors</label>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Accent Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[accent_color]" class="form-control form-control-color" value="{{ $settings['accent_color'] ?? '#ff6b35' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['accent_color'] ?? '#ff6b35' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna utama untuk highlight (stars, text accent)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient Start</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[accent_gradient_start]" class="form-control form-control-color" value="{{ $settings['accent_gradient_start'] ?? '#ff6b35' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['accent_gradient_start'] ?? '#ff6b35' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna awal gradient (badge, button, avatar)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient End</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[accent_gradient_end]" class="form-control form-control-color" value="{{ $settings['accent_gradient_end'] ?? '#f7931e' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['accent_gradient_end'] ?? '#f7931e' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna akhir gradient (badge, button, avatar)</small>
                            </div>
                        </div>

                        <!-- Card Styling -->
                        <div class="row mb-4 mt-8">
                            <div class="col-12">
                                <label class="fw-semibold fs-6 text-primary mb-3"><i class="fas fa-square me-2"></i>Card Styling</label>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Card Background</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <input type="color" id="picker_card_bg" class="form-control form-control-color rgba-picker" data-target="card_bg_color" data-opacity="opacity_card_bg" value="#ffffff" style="width: 60px; height: 40px;">
                                    <div class="d-flex align-items-center gap-2 flex-grow-1">
                                        <span class="text-muted" style="min-width: 65px;">Opacity:</span>
                                        <input type="range" id="opacity_card_bg" class="form-range rgba-opacity" data-target="card_bg_color" data-picker="picker_card_bg" min="0" max="1" step="0.01" value="0.9" style="max-width: 150px;">
                                        <span id="opacity_card_bg_label" class="badge bg-secondary" style="min-width: 45px;">90%</span>
                                    </div>
                                    <div id="preview_card_bg" class="border rounded" style="width: 50px; height: 40px; background: {{ $settings['card_bg_color'] ?? 'rgba(255,255,255,0.9)' }};"></div>
                                </div>
                                <input type="hidden" name="settings[card_bg_color]" id="card_bg_color" value="{{ $settings['card_bg_color'] ?? 'rgba(255,255,255,0.9)' }}">
                                <small class="text-muted">Background kartu testimonial</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Card Border</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <input type="color" id="picker_card_border" class="form-control form-control-color rgba-picker" data-target="card_border_color" data-opacity="opacity_card_border" value="#ff6b35" style="width: 60px; height: 40px;">
                                    <div class="d-flex align-items-center gap-2 flex-grow-1">
                                        <span class="text-muted" style="min-width: 65px;">Opacity:</span>
                                        <input type="range" id="opacity_card_border" class="form-range rgba-opacity" data-target="card_border_color" data-picker="picker_card_border" min="0" max="1" step="0.01" value="0.08" style="max-width: 150px;">
                                        <span id="opacity_card_border_label" class="badge bg-secondary" style="min-width: 45px;">8%</span>
                                    </div>
                                    <div id="preview_card_border" class="border rounded" style="width: 50px; height: 40px; background: {{ $settings['card_border_color'] ?? 'rgba(255,107,53,0.08)' }};"></div>
                                </div>
                                <input type="hidden" name="settings[card_border_color]" id="card_border_color" value="{{ $settings['card_border_color'] ?? 'rgba(255,107,53,0.08)' }}">
                                <small class="text-muted">Warna border kartu</small>
                            </div>
                        </div>

                        <!-- Decoration Colors -->
                        <div class="row mb-4 mt-8">
                            <div class="col-12">
                                <label class="fw-semibold fs-6 text-primary mb-3"><i class="fas fa-sparkles me-2"></i>Decoration Colors</label>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Decoration 1</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <input type="color" id="picker_deco1" class="form-control form-control-color rgba-picker" data-target="decoration_color_1" data-opacity="opacity_deco1" value="#ff6b35" style="width: 60px; height: 40px;">
                                    <div class="d-flex align-items-center gap-2 flex-grow-1">
                                        <span class="text-muted" style="min-width: 65px;">Opacity:</span>
                                        <input type="range" id="opacity_deco1" class="form-range rgba-opacity" data-target="decoration_color_1" data-picker="picker_deco1" min="0" max="1" step="0.01" value="0.1" style="max-width: 150px;">
                                        <span id="opacity_deco1_label" class="badge bg-secondary" style="min-width: 45px;">10%</span>
                                    </div>
                                    <div id="preview_deco1" class="border rounded" style="width: 50px; height: 40px; background: {{ $settings['decoration_color_1'] ?? 'rgba(255, 107, 53, 0.1)' }};"></div>
                                </div>
                                <input type="hidden" name="settings[decoration_color_1]" id="decoration_color_1" value="{{ $settings['decoration_color_1'] ?? 'rgba(255, 107, 53, 0.1)' }}">
                                <small class="text-muted">Warna dekorasi lingkaran kanan atas</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Decoration 2</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <input type="color" id="picker_deco2" class="form-control form-control-color rgba-picker" data-target="decoration_color_2" data-opacity="opacity_deco2" value="#1a246a" style="width: 60px; height: 40px;">
                                    <div class="d-flex align-items-center gap-2 flex-grow-1">
                                        <span class="text-muted" style="min-width: 65px;">Opacity:</span>
                                        <input type="range" id="opacity_deco2" class="form-range rgba-opacity" data-target="decoration_color_2" data-picker="picker_deco2" min="0" max="1" step="0.01" value="0.1" style="max-width: 150px;">
                                        <span id="opacity_deco2_label" class="badge bg-secondary" style="min-width: 45px;">10%</span>
                                    </div>
                                    <div id="preview_deco2" class="border rounded" style="width: 50px; height: 40px; background: {{ $settings['decoration_color_2'] ?? 'rgba(26, 36, 106, 0.1)' }};"></div>
                                </div>
                                <input type="hidden" name="settings[decoration_color_2]" id="decoration_color_2" value="{{ $settings['decoration_color_2'] ?? 'rgba(26, 36, 106, 0.1)' }}">
                                <small class="text-muted">Warna dekorasi lingkaran kiri bawah</small>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Icon Picker Modal -->
<div class="modal fade" id="iconPickerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-icons me-2"></i>Pilih Icon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#emojiTab">😊 Emoji</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#fontawesomeTab"><i class="fab fa-font-awesome"></i> FontAwesome</button>
                    </li>
                </ul>
                <input type="text" id="iconSearch" class="form-control mb-4" placeholder="Cari icon...">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="emojiTab">
                        <div id="emojiGrid" class="row g-2"></div>
                    </div>
                    <div class="tab-pane fade" id="fontawesomeTab">
                        <div id="iconGrid" class="row g-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#alumniSettingsForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        
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
                $.ajax({
                    url: '{{ route("home-settings.update") }}',
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if(response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });
});

// Icon Picker Functionality
const popularEmojis = [
    '🎓', '🎯', '📚', '📖', '✏️', '🖊️', '💡', '🔬', '🔭', '🧪', '⚗️', '🧬',
    '💻', '🖥️', '📱', '⌨️', '🖱️', '💾', '📡', '🌐', '🌍', '🌎', '🌏', '🗺️',
    '🏆', '🥇', '🥈', '🥉', '🏅', '⭐', '🌟', '✨', '💫', '🔥', '💪', '👍',
    '❤️', '💙', '💚', '💛', '🧡', '💜', '🖤', '🤍', '💝', '💖', '💗', '💓',
    '📈', '📊', '📉', '📋', '📁', '📂', '🗂️', '📝', '📄', '📑', '🗒️', '📒'
];

const popularIcons = [
    'fa-home', 'fa-user', 'fa-users', 'fa-cog', 'fa-envelope', 'fa-phone', 'fa-building',
    'fa-briefcase', 'fa-graduation-cap', 'fa-book', 'fa-file-alt', 'fa-image', 'fa-video',
    'fa-music', 'fa-heart', 'fa-star', 'fa-bookmark', 'fa-calendar', 'fa-clock', 'fa-map-marker-alt',
    'fa-globe', 'fa-search', 'fa-trophy', 'fa-award', 'fa-medal', 'fa-certificate',
    'fa-arrow-right', 'fa-arrow-left', 'fa-check', 'fa-times', 'fa-info-circle', 'fa-check-circle'
];

let currentIconField = null;

function openIconPicker(fieldId) {
    currentIconField = fieldId;
    const modal = new bootstrap.Modal(document.getElementById('iconPickerModal'));
    
    const emojiGrid = document.getElementById('emojiGrid');
    emojiGrid.innerHTML = '';
    popularEmojis.forEach(emoji => {
        const col = document.createElement('div');
        col.className = 'col-4 col-sm-3 col-md-2';
        col.innerHTML = `<div class="icon-item text-center p-3 border rounded" onclick="selectIcon('${emoji}')" style="cursor: pointer; font-size: 24px;" onmouseover="this.style.background='#f5f8fa'" onmouseout="this.style.background=''">${emoji}</div>`;
        emojiGrid.appendChild(col);
    });
    
    const iconGrid = document.getElementById('iconGrid');
    iconGrid.innerHTML = '';
    popularIcons.forEach(icon => {
        const col = document.createElement('div');
        col.className = 'col-4 col-sm-3 col-md-2';
        col.innerHTML = `<div class="icon-item text-center p-3 border rounded" onclick="selectIcon('${icon}')" style="cursor: pointer;" onmouseover="this.style.background='#f5f8fa'" onmouseout="this.style.background=''"><i class="fas ${icon} fs-2x mb-2"></i><div class="text-muted fs-8">${icon.replace('fa-', '')}</div></div>`;
        iconGrid.appendChild(col);
    });
    
    modal.show();
}

function selectIcon(iconValue) {
    if (currentIconField) {
        document.getElementById(currentIconField).value = iconValue;
        const preview = document.getElementById(currentIconField + '_preview');
        if (preview) {
            preview.innerHTML = iconValue.startsWith('fa-') ? `<i class="fas ${iconValue}"></i>` : iconValue;
        }
    }
    bootstrap.Modal.getInstance(document.getElementById('iconPickerModal')).hide();
}

function clearIcon(fieldId, defaultValue) {
    document.getElementById(fieldId).value = defaultValue;
    const preview = document.getElementById(fieldId + '_preview');
    if (preview) {
        preview.innerHTML = defaultValue.startsWith('fa-') ? `<i class="fas ${defaultValue}"></i>` : defaultValue;
    }
}

const iconSearch = document.getElementById('iconSearch');
if (iconSearch) {
    iconSearch.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('.icon-item').forEach(item => {
            item.parentElement.style.display = item.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
        });
    });
}

// RGBA Color Picker with Opacity Slider Logic
function hexToRgb(hex) {
    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

function rgbaToHexAndOpacity(rgba) {
    const match = rgba.match(/rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*([\d.]+))?\)/);
    if (match) {
        const r = parseInt(match[1]).toString(16).padStart(2, '0');
        const g = parseInt(match[2]).toString(16).padStart(2, '0');
        const b = parseInt(match[3]).toString(16).padStart(2, '0');
        const a = match[4] ? parseFloat(match[4]) : 1;
        return { hex: `#${r}${g}${b}`, opacity: a };
    }
    return { hex: '#ffffff', opacity: 1 };
}

function updateRgbaValue(targetId, pickerId, opacityId) {
    const picker = document.getElementById(pickerId);
    const opacity = document.getElementById(opacityId);
    const target = document.getElementById(targetId);
    const preview = document.getElementById('preview_' + targetId.replace('_color', '').replace('decoration_color_', 'deco'));
    const label = document.getElementById(opacityId + '_label');
    
    if (picker && opacity && target) {
        const rgb = hexToRgb(picker.value);
        if (rgb) {
            const rgbaValue = `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, ${opacity.value})`;
            target.value = rgbaValue;
            if (preview) {
                preview.style.background = rgbaValue;
            }
            if (label) {
                label.textContent = Math.round(opacity.value * 100) + '%';
            }
        }
    }
}

// Initialize pickers from existing values
function initRgbaPicker(targetId, pickerId, opacityId) {
    const target = document.getElementById(targetId);
    const picker = document.getElementById(pickerId);
    const opacity = document.getElementById(opacityId);
    const label = document.getElementById(opacityId + '_label');
    
    if (target && target.value && picker && opacity) {
        const parsed = rgbaToHexAndOpacity(target.value);
        picker.value = parsed.hex;
        opacity.value = parsed.opacity;
        if (label) {
            label.textContent = Math.round(parsed.opacity * 100) + '%';
        }
    }
}

// Initialize all rgba pickers
$(document).ready(function() {
    initRgbaPicker('card_bg_color', 'picker_card_bg', 'opacity_card_bg');
    initRgbaPicker('card_border_color', 'picker_card_border', 'opacity_card_border');
    initRgbaPicker('decoration_color_1', 'picker_deco1', 'opacity_deco1');
    initRgbaPicker('decoration_color_2', 'picker_deco2', 'opacity_deco2');
});

// Event listeners for picker changes
$('.rgba-picker').on('input change', function() {
    const targetId = $(this).data('target');
    const opacityId = $(this).data('opacity');
    updateRgbaValue(targetId, this.id, opacityId);
});

$('.rgba-opacity').on('input change', function() {
    const targetId = $(this).data('target');
    const pickerId = $(this).data('picker');
    updateRgbaValue(targetId, pickerId, this.id);
});
</script>
@endpush
