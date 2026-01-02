@extends('layouts.dashboard.dashboard')

@section('title', 'Kenali Lebih Dekat Settings')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            {{-- Page Header --}}
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #1a246a, #2d3a8c); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                            <i class="fas fa-play-circle text-white fs-3"></i>
                        </div>
                        <div>
                            <h1 class="fs-2 fw-bold mb-0">Kenali Lebih Dekat Settings</h1>
                            <span class="text-muted fs-7">Pengaturan video dan section Kenali Lebih Dekat</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Settings Form --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Kenali Lebih Dekat</h3>
                </div>
                <div class="card-body">
                    <form id="kenaliSettingsForm">
                        @csrf
                        <input type="hidden" name="type" value="kenali">
                        
                        {{-- Show Section Toggle --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Section</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[show]" value="1" {{ ($settings['show'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tampilkan Kenali Lebih Dekat di Homepage</label>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        
                        {{-- Layout Style --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Layout Style</label>
                            <div class="col-lg-9">
                                <select name="settings[layout_style]" class="form-select">
                                    <option value="current" {{ ($settings['layout_style'] ?? 'current') == 'current' ? 'selected' : '' }}>Current Design (Video + 3 Cards)</option>
                                    <option value="minimalist" {{ ($settings['layout_style'] ?? '') == 'minimalist' ? 'selected' : '' }}>Minimalist Focus Layout (Video + Teks)</option>
                                    <option value="dual_column" {{ ($settings['layout_style'] ?? '') == 'dual_column' ? 'selected' : '' }}>Dual-Column Interactive</option>
                                </select>
                                <small class="text-muted d-block mt-2">Pilih tampilan layout untuk section Kenali Lebih Dekat (Video Profil).</small>
                            </div>
                        </div>

                        {{-- Video Settings --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Video Settings</h4>
                        <p class="text-muted mb-4">Pengaturan video profil yang akan ditampilkan.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">YouTube Video ID</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[video_id]" class="form-control" value="{{ $settings['video_id'] ?? '' }}" placeholder="Contoh: PrH05mBgdd4">
                                <small class="text-muted">Masukkan <strong>HANYA ID</strong> video YouTube (karakter acak di akhir URL video). Contoh: untuk <code>youtube.com/watch?v=PrH05mBgdd4</code> masukkan <code>PrH05mBgdd4</code>.</small>
                            </div>
                        </div>

                        {{-- Section Header --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Section Header</h4>
                        <p class="text-muted mb-4">Pengaturan judul dan deskripsi section.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-text" id="section_icon_preview" style="min-width: 50px; justify-content: center; font-size: 20px;">{{ $settings['section_icon'] ?? '🎯' }}</span>
                                    <input type="text" name="settings[section_icon]" id="section_icon" class="form-control" value="{{ $settings['section_icon'] ?? '🎯' }}" readonly>
                                    <button type="button" class="btn btn-light-primary" onclick="openIconPicker('section_icon')">
                                        <i class="fas fa-icons me-1"></i>Pilih Icon
                                    </button>
                                    <button type="button" class="btn btn-light-danger" onclick="clearIcon('section_icon', '🎯')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Emoji atau icon FontAwesome untuk header section</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Badge Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[section_badge_text]" class="form-control" value="{{ $settings['section_badge_text'] ?? 'KENALI LEBIH DEKAT' }}">
                                <small class="text-muted">Teks kecil di atas judul utama</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[section_title]" class="form-control" value="{{ $settings['section_title'] ?? 'SISTEM INFORMASI' }}">
                                <small class="text-muted">Judul utama section</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title Highlight</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[section_title_highlight]" class="form-control" value="{{ $settings['section_title_highlight'] ?? 'UNIB' }}">
                                <small class="text-muted">Bagian judul yang akan di-highlight warna aksen</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Subtitle</label>
                            <div class="col-lg-9">
                                <textarea name="settings[section_subtitle]" class="form-control" rows="2">{{ $settings['section_subtitle'] ?? '' }}</textarea>
                                <small class="text-muted">Deskripsi singkat di bawah judul</small>
                            </div>
                        </div>

                        {{-- CTA Settings --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">CTA Button</h4>
                        <p class="text-muted mb-4">Tombol ajakan bertindak (Call to Action).</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">CTA Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_text]" class="form-control" value="{{ $settings['cta_text'] ?? 'Pelajari Lebih Lanjut' }}">
                                <small class="text-muted">Teks pada tombol</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">CTA Link</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[cta_link]" class="form-control" value="{{ $settings['cta_link'] ?? '/about' }}">
                                <small class="text-muted">Link tujuan tombol</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">CTA Icon</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-text" id="cta_icon_preview" style="min-width: 50px; justify-content: center;"><i class="fas {{ $settings['cta_icon'] ?? 'fa-arrow-right' }}"></i></span>
                                    <input type="text" name="settings[cta_icon]" id="cta_icon" class="form-control" value="{{ $settings['cta_icon'] ?? 'fa-arrow-right' }}" readonly>
                                    <button type="button" class="btn btn-light-primary" onclick="openIconPicker('cta_icon')">
                                        <i class="fas fa-icons me-1"></i>Pilih Icon
                                    </button>
                                    <button type="button" class="btn btn-light-danger" onclick="clearIcon('cta_icon', 'fa-arrow-right')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Icon pada tombol CTA (contoh: fa-arrow-right)</small>
                            </div>
                        </div>

                        {{-- Colors --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Color Settings</h4>
                        <p class="text-muted mb-4">Pengaturan warna background dan aksen.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient Start</label>
                            <div class="col-lg-9">
                                <input type="color" name="settings[bg_gradient_start]" class="form-control form-control-color" value="{{ $settings['bg_gradient_start'] ?? '#1a246a' }}">
                                <small class="text-muted">Warna awal background gradient</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient End</label>
                            <div class="col-lg-9">
                                <input type="color" name="settings[bg_gradient_end]" class="form-control form-control-color" value="{{ $settings['bg_gradient_end'] ?? '#151945' }}">
                                <small class="text-muted">Warna akhir background gradient</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Accent Color</label>
                            <div class="col-lg-9">
                                <input type="color" name="settings[accent_color]" class="form-control form-control-color" value="{{ $settings['accent_color'] ?? '#fbbf24' }}">
                                <small class="text-muted">Warna aksen untuk highlight teks dan tombol</small>
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
                <!-- Emoji Tab -->
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
    $('#kenaliSettingsForm').on('submit', function(e) {
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
    '🎯', '🎓', '📚', '📖', '✏️', '🖊️', '💡', '🔬', '🔭', '🧪', '⚗️', '🧬',
    '💻', '🖥️', '📱', '⌨️', '🖱️', '💾', '📡', '🌐', '🌍', '🌎', '🌏', '🗺️',
    '🏆', '🥇', '🥈', '🥉', '🏅', '⭐', '🌟', '✨', '💫', '🔥', '💪', '👍',
    '❤️', '💙', '💚', '💛', '🧡', '💜', '🖤', '🤍', '💝', '💖', '💗', '💓',
    '📈', '📊', '📉', '📋', '📁', '📂', '🗂️', '📝', '📄', '📑', '🗒️', '📒'
];

const popularIcons = [
    'fa-home', 'fa-user', 'fa-users', 'fa-cog', 'fa-envelope', 'fa-phone', 'fa-building',
    'fa-briefcase', 'fa-graduation-cap', 'fa-book', 'fa-file-alt', 'fa-image', 'fa-video',
    'fa-music', 'fa-heart', 'fa-star', 'fa-bookmark', 'fa-calendar', 'fa-clock', 'fa-map-marker-alt',
    'fa-globe', 'fa-search', 'fa-shopping-cart', 'fa-credit-card', 'fa-gift', 'fa-trophy',
    'fa-award', 'fa-medal', 'fa-certificate', 'fa-bullhorn', 'fa-comment', 'fa-comments',
    'fa-thumbs-up', 'fa-thumbs-down', 'fa-share', 'fa-link', 'fa-download', 'fa-upload',
    'fa-save', 'fa-trash', 'fa-edit', 'fa-plus', 'fa-minus', 'fa-check', 'fa-times',
    'fa-arrow-right', 'fa-arrow-left', 'fa-arrow-up', 'fa-arrow-down', 'fa-bars', 'fa-th',
    'fa-list', 'fa-chart-bar', 'fa-chart-line', 'fa-chart-pie', 'fa-database', 'fa-server',
    'fa-laptop', 'fa-mobile', 'fa-tablet', 'fa-camera', 'fa-print', 'fa-wrench', 'fa-tools',
    'fa-play', 'fa-play-circle', 'fa-pause', 'fa-stop', 'fa-forward', 'fa-backward',
    'fa-info-circle', 'fa-question-circle', 'fa-exclamation-circle', 'fa-check-circle', 'fa-times-circle'
];

let currentIconField = null;

function openIconPicker(fieldId) {
    currentIconField = fieldId;
    const modal = new bootstrap.Modal(document.getElementById('iconPickerModal'));
    
    // Populate emoji grid
    const emojiGrid = document.getElementById('emojiGrid');
    emojiGrid.innerHTML = '';
    popularEmojis.forEach(emoji => {
        const col = document.createElement('div');
        col.className = 'col-4 col-sm-3 col-md-2';
        col.innerHTML = `
            <div class="icon-item text-center p-3 border rounded" 
                 onclick="selectIcon('${emoji}')" 
                 style="cursor: pointer; transition: all 0.2s; font-size: 24px;"
                 onmouseover="this.style.background='#f5f8fa'; this.style.borderColor='#009ef7'"
                 onmouseout="this.style.background=''; this.style.borderColor=''">
                ${emoji}
            </div>
        `;
        emojiGrid.appendChild(col);
    });
    
    // Populate icon grid
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
        
        // Update preview
        const preview = document.getElementById(currentIconField + '_preview');
        if (preview) {
            if (iconValue.startsWith('fa-')) {
                preview.innerHTML = `<i class="fas ${iconValue}"></i>`;
            } else {
                preview.textContent = iconValue;
            }
        }
    }
    bootstrap.Modal.getInstance(document.getElementById('iconPickerModal')).hide();
}

function clearIcon(fieldId, defaultValue) {
    const input = document.getElementById(fieldId);
    input.value = defaultValue;
    
    const preview = document.getElementById(fieldId + '_preview');
    if (preview) {
        if (defaultValue.startsWith('fa-')) {
            preview.innerHTML = `<i class="fas ${defaultValue}"></i>`;
        } else {
            preview.textContent = defaultValue;
        }
    }
}

// Icon search functionality
const iconSearch = document.getElementById('iconSearch');
if (iconSearch) {
    iconSearch.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('.icon-item').forEach(item => {
            const content = item.textContent.toLowerCase();
            if (content.includes(searchTerm) || searchTerm === '') {
                item.parentElement.style.display = '';
            } else {
                item.parentElement.style.display = 'none';
            }
        });
    });
}
</script>
@endpush
