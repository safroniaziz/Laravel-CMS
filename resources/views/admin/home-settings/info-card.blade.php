@extends('layouts.dashboard.dashboard')

@section('title', 'Info Card Settings')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            {{-- Page Header --}}
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                            <i class="fas fa-id-card text-white fs-3"></i>
                        </div>
                        <div>
                            <h1 class="fs-2 fw-bold mb-0">Info Card Settings</h1>
                            <span class="text-muted fs-7">Pengaturan Info Card Banner di Homepage</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Settings Form --}}
            <div class="card">
                <div class="card-header"><h3 class="card-title">Pengaturan Info Card</h3></div>
                <div class="card-body">
                    <form id="infoCardSettingsForm">
                        @csrf
                        <input type="hidden" name="type" value="homepage">
                        <input type="hidden" name="group" value="homepage">
                        
                        {{-- Show Section Toggle --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Section</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[info_card_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[info_card_show]" value="1" {{ ($settings['info_card_show'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tampilkan Info Card di Homepage</label>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-6"></div>

                        {{-- Layout Style --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Layout Style</label>
                            <div class="col-lg-9">
                                <select name="settings[info_card_layout_style]" class="form-select">
                                    <option value="current" {{ ($settings['info_card_layout_style'] ?? 'current') == 'current' ? 'selected' : '' }}>Layout Lengkap</option>
                                    <option value="compact" {{ ($settings['info_card_layout_style'] ?? '') == 'compact' ? 'selected' : '' }}>Layout Kompak</option>
                                    <option value="gradient" {{ ($settings['info_card_layout_style'] ?? '') == 'gradient' ? 'selected' : '' }}>Layout Gradient</option>
                                    <option value="modern" {{ ($settings['info_card_layout_style'] ?? '') == 'modern' ? 'selected' : '' }}>Layout Modern</option>
                                </select>
                                <small class="text-muted d-block mt-2">Pilih tampilan layout untuk Info Card di homepage</small>
                            </div>
                        </div>

                        {{-- Badge Section --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Badge</h4>
                        <p class="text-muted mb-4">Pengaturan badge/label kecil di atas judul.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Badge Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[info_card_badge_text]" class="form-control" value="{{ $settings['info_card_badge_text'] ?? 'INFORMASI PENTING' }}">
                                <small class="text-muted">Teks badge yang muncul di atas judul utama</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Badge Icon</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-text" id="badge_icon_preview" style="min-width: 50px; justify-content: center;"><i class="fas {{ $settings['info_card_badge_icon'] ?? 'fa-info-circle' }}"></i></span>
                                    <input type="text" name="settings[info_card_badge_icon]" id="info_card_badge_icon" class="form-control" value="{{ $settings['info_card_badge_icon'] ?? 'fa-info-circle' }}" readonly>
                                    <button type="button" class="btn btn-light-primary" onclick="openIconPicker('info_card_badge_icon')">
                                        <i class="fas fa-icons me-1"></i>Pilih Icon
                                    </button>
                                    <button type="button" class="btn btn-light-danger" onclick="clearIcon('info_card_badge_icon', 'fa-info-circle')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Icon FontAwesome yang muncul di samping badge text</small>
                            </div>
                        </div>

                        {{-- Content Section --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Konten</h4>
                        <p class="text-muted mb-4">Pengaturan judul dan deskripsi Info Card.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[info_card_title]" class="form-control" value="{{ $settings['info_card_title'] ?? 'Informasi Terkini' }}">
                                <small class="text-muted">Judul utama Info Card. Gunakan @{{year}} untuk menampilkan tahun dinamis</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Subtitle</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[info_card_subtitle]" class="form-control" value="{{ $settings['info_card_subtitle'] ?? 'Program Studi Sistem Informasi Universitas Bengkulu' }}">
                                <small class="text-muted">Deskripsi singkat di bawah judul utama</small>
                            </div>
                        </div>

                        {{-- Button Section --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Tombol</h4>
                        <p class="text-muted mb-4">Pengaturan tombol Call to Action.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[info_card_button_text]" class="form-control" value="{{ $settings['info_card_button_text'] ?? 'Info Selengkapnya' }}">
                                <small class="text-muted">Teks yang muncul pada tombol</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Link</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[info_card_button_link]" class="form-control" value="{{ $settings['info_card_button_link'] ?? '/contact' }}">
                                <small class="text-muted">URL tujuan ketika tombol diklik</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Icon</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-text" id="button_icon_preview" style="min-width: 50px; justify-content: center;"><i class="fas {{ $settings['info_card_button_icon'] ?? 'fa-arrow-right' }}"></i></span>
                                    <input type="text" name="settings[info_card_button_icon]" id="info_card_button_icon" class="form-control" value="{{ $settings['info_card_button_icon'] ?? 'fa-arrow-right' }}" readonly>
                                    <button type="button" class="btn btn-light-primary" onclick="openIconPicker('info_card_button_icon')">
                                        <i class="fas fa-icons me-1"></i>Pilih Icon
                                    </button>
                                    <button type="button" class="btn btn-light-danger" onclick="clearIcon('info_card_button_icon', 'fa-arrow-right')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Icon yang muncul di sebelah teks tombol</small>
                            </div>
                        </div>

                        {{-- Color Section --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Warna</h4>
                        <p class="text-muted mb-4">Pengaturan warna background, border, dan elemen lainnya.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Background Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[info_card_bg_color]" class="form-control form-control-color" value="{{ $settings['info_card_bg_color'] ?? '#f8fafc' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['info_card_bg_color'] ?? '#f8fafc' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna background utama Info Card</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Border Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[info_card_border_color]" class="form-control form-control-color" value="{{ $settings['info_card_border_color'] ?? '#e5e7eb' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['info_card_border_color'] ?? '#e5e7eb' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna garis border Info Card</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Badge Background</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[info_card_badge_bg]" class="form-control form-control-color" value="{{ $settings['info_card_badge_bg'] ?? '#f1f5f9' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['info_card_badge_bg'] ?? '#f1f5f9' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna background badge/label</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[info_card_title_color]" class="form-control form-control-color" value="{{ $settings['info_card_title_color'] ?? '#1e293b' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['info_card_title_color'] ?? '#1e293b' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna teks judul utama</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Subtitle Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[info_card_subtitle_color]" class="form-control form-control-color" value="{{ $settings['info_card_subtitle_color'] ?? '#64748b' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['info_card_subtitle_color'] ?? '#64748b' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna teks subtitle/deskripsi</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Background</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[info_card_button_bg]" class="form-control form-control-color" value="{{ $settings['info_card_button_bg'] ?? '#1a246a' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['info_card_button_bg'] ?? '#1a246a' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna background tombol CTA</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Text Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[info_card_button_text_color]" class="form-control form-control-color" value="{{ $settings['info_card_button_text_color'] ?? '#ffffff' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['info_card_button_text_color'] ?? '#ffffff' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna teks pada tombol</small>
                            </div>
                        </div>

                        {{-- Gradient Colors (for modern/gradient layouts) --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Gradient Colors</h4>
                        <p class="text-muted mb-4">Warna gradient untuk layout Modern dan Gradient.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient Start</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[info_card_gradient_start]" class="form-control form-control-color" value="{{ $settings['info_card_gradient_start'] ?? '#1a246a' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['info_card_gradient_start'] ?? '#1a246a' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna awal gradient</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient End</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[info_card_gradient_end]" class="form-control form-control-color" value="{{ $settings['info_card_gradient_end'] ?? '#3b82f6' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['info_card_gradient_end'] ?? '#3b82f6' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna akhir gradient</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan Pengaturan</button>
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
                <input type="text" id="iconSearch" class="form-control mb-4" placeholder="Cari icon...">
                <div id="iconGrid" class="row g-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#infoCardSettingsForm').on('submit', function(e) {
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
                    success: function(r) { Swal.fire({icon:'success',title:'Berhasil!',text:r.message,confirmButtonText:'OK'}); },
                    error: function(x) { Swal.fire({icon:'error',title:'Gagal!',text:x.responseJSON?.message||'Error',confirmButtonText:'OK'}); }
                });
            }
        });
    });
});

// Icon Picker Functionality
const popularIcons = [
    'fa-info-circle', 'fa-exclamation-circle', 'fa-check-circle', 'fa-times-circle', 'fa-question-circle',
    'fa-arrow-right', 'fa-arrow-left', 'fa-arrow-up', 'fa-arrow-down', 'fa-chevron-right',
    'fa-home', 'fa-user', 'fa-users', 'fa-cog', 'fa-envelope', 'fa-phone', 'fa-building',
    'fa-briefcase', 'fa-graduation-cap', 'fa-book', 'fa-file-alt', 'fa-image', 'fa-video',
    'fa-heart', 'fa-star', 'fa-bookmark', 'fa-calendar', 'fa-clock', 'fa-map-marker-alt',
    'fa-globe', 'fa-search', 'fa-trophy', 'fa-award', 'fa-medal', 'fa-certificate',
    'fa-bell', 'fa-bullhorn', 'fa-comment', 'fa-comments', 'fa-share', 'fa-link',
    'fa-download', 'fa-upload', 'fa-save', 'fa-edit', 'fa-plus', 'fa-minus',
    'fa-rocket', 'fa-paper-plane', 'fa-lightbulb', 'fa-bolt', 'fa-fire', 'fa-shield-alt',
    'fa-laptop', 'fa-mobile', 'fa-tablet', 'fa-camera', 'fa-print', 'fa-wrench',
    'fa-play', 'fa-play-circle', 'fa-pause', 'fa-stop', 'fa-forward', 'fa-backward'
];

let currentIconField = null;

function openIconPicker(fieldId) {
    currentIconField = fieldId;
    const modal = new bootstrap.Modal(document.getElementById('iconPickerModal'));
    
    const iconGrid = document.getElementById('iconGrid');
    iconGrid.innerHTML = '';
    popularIcons.forEach(icon => {
        const col = document.createElement('div');
        col.className = 'col-4 col-sm-3 col-md-2';
        col.innerHTML = `
            <div class="icon-item text-center p-3 border rounded" 
                 onclick="selectIcon('${icon}')" 
                 style="cursor: pointer; transition: all 0.2s;"
                 onmouseover="this.style.background='#f5f8fa'; this.style.borderColor='#009ef7'"
                 onmouseout="this.style.background=''; this.style.borderColor=''">
                <i class="fas ${icon} fs-2x mb-2"></i>
                <div class="text-muted fs-8">${icon.replace('fa-', '')}</div>
            </div>
        `;
        iconGrid.appendChild(col);
    });
    
    modal.show();
}

function selectIcon(iconValue) {
    if (currentIconField) {
        const input = document.getElementById(currentIconField);
        input.value = iconValue;
        
        // Update preview based on field
        let previewId = currentIconField.includes('badge') ? 'badge_icon_preview' : 'button_icon_preview';
        const preview = document.getElementById(previewId);
        if (preview) {
            preview.innerHTML = `<i class="fas ${iconValue}"></i>`;
        }
    }
    bootstrap.Modal.getInstance(document.getElementById('iconPickerModal')).hide();
}

function clearIcon(fieldId, defaultValue) {
    const input = document.getElementById(fieldId);
    input.value = defaultValue;
    
    let previewId = fieldId.includes('badge') ? 'badge_icon_preview' : 'button_icon_preview';
    const preview = document.getElementById(previewId);
    if (preview) {
        preview.innerHTML = `<i class="fas ${defaultValue}"></i>`;
    }
}

// Icon search functionality
const iconSearch = document.getElementById('iconSearch');
if (iconSearch) {
    iconSearch.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('.icon-item').forEach(item => {
            const content = item.textContent.toLowerCase();
            item.parentElement.style.display = content.includes(searchTerm) ? '' : 'none';
        });
    });
}
</script>
@endpush
