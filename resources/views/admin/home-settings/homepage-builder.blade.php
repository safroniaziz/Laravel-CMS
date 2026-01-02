@extends('layouts.dashboard.dashboard')

@section('title', 'Homepage Builder')
@section('menu', 'Home Settings')

@push('styles')
<style>
.section-item {
    background: #fff;
    border: 2px solid #e4e6ef;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    cursor: move;
    transition: all 0.2s;
}
.section-item:hover {
    border-color: #1e3a8a;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}
.block-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 8px;
}
.position-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}
.position-after_hero { background: #fef3c7; color: #92400e; }
.position-after_about { background: #dbeafe; color: #1e40af; }
.position-after_stats { background: #d1fae5; color: #065f46; }
.position-after_news { background: #ede9fe; color: #5b21b6; }
.position-after_alumni { background: #fce7f3; color: #9d174d; }
.position-before_footer { background: #fee2e2; color: #991b1b; }
.block-type-badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 600;
}
.block-type-text { background: #dbeafe; color: #1e40af; }
.block-type-gallery { background: #ede9fe; color: #5b21b6; }
.block-type-cards { background: #d1fae5; color: #065f46; }
.block-type-stats { background: #fee2e2; color: #991b1b; }
.add-section-btn {
    border: 2px dashed #c4c4c4;
    background: #fafafa;
    border-radius: 12px;
    padding: 30px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
}
.add-section-btn:hover {
    border-color: #1e3a8a;
    background: #f0f9ff;
}
.block-type-option {
    padding: 15px;
    border: 2px solid #e4e6ef;
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
}
.block-type-option:hover {
    border-color: #1e3a8a;
    background: #f0f9ff;
}
.block-type-option.selected {
    border-color: #1e3a8a;
    background: #dbeafe;
}
</style>
@endpush

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        {{-- Page Header --}}
        <div class="card mb-5">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                            <i class="fas fa-puzzle-piece text-white fs-3"></i>
                        </div>
                        <div>
                            <h1 class="fs-2 fw-bold mb-0">🏗️ Homepage Builder</h1>
                            <span class="text-muted fs-7">Tambah section custom ke homepage dengan posisi fleksibel</span>
                        </div>
                    </div>
                    <div>
                        <a href="/" target="_blank" class="btn btn-light-primary me-2">
                            <i class="fas fa-eye me-1"></i> Preview Homepage
                        </a>
                        <button type="button" class="btn btn-primary" onclick="saveHomepageBuilder()">
                            <i class="fas fa-save me-1"></i> Simpan Semua
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title">📦 Custom Sections</h3>
                        <div class="card-toolbar">
                            <span class="badge badge-light-primary" id="section-count">0 sections</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info d-flex align-items-center mb-4">
                            <i class="fas fa-info-circle me-3 fs-2"></i>
                            <div>
                                <strong>Cara Penggunaan:</strong> Tambah section baru, pilih posisi (setelah Hero, About, dll.), lalu tambahkan blocks (Gallery, Text, Cards, dll.) ke dalam section tersebut.
                            </div>
                        </div>

                        {{-- Sections Container --}}
                        <div id="sections-container" class="mb-4">
                            {{-- Sections will be rendered here --}}
                        </div>

                        {{-- Add Section Button --}}
                        <div class="add-section-btn" onclick="openAddSectionModal()">
                            <i class="fas fa-plus-circle text-primary fs-1"></i>
                            <div class="mt-3 fw-bold text-gray-700">Tambah Section Baru</div>
                            <small class="text-muted">Klik untuk menambah section custom</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="card mb-5 sticky-top" style="top: 20px;">
                    <div class="card-header">
                        <h3 class="card-title">📍 Posisi yang Tersedia</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-4">Section custom bisa ditempatkan di posisi berikut:</p>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="position-badge position-after_hero">After Hero</span>
                                <span class="text-muted small">Setelah slider/hero section</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="position-badge position-after_about">After About</span>
                                <span class="text-muted small">Setelah Kenali Lebih Dekat</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="position-badge position-after_stats">After Stats</span>
                                <span class="text-muted small">Setelah section statistik</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="position-badge position-after_news">After News</span>
                                <span class="text-muted small">Setelah Berita Terbaru</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="position-badge position-after_alumni">After Alumni</span>
                                <span class="text-muted small">Setelah Kata Alumni</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="position-badge position-before_footer">Before Footer</span>
                                <span class="text-muted small">Tepat di atas footer</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">🧱 Block Types</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Jenis block yang bisa ditambahkan:</p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="block-type-badge block-type-text">📝 Text</span>
                            <span class="block-type-badge block-type-gallery">🖼️ Gallery</span>
                            <span class="block-type-badge block-type-cards">🃏 Cards</span>
                            <span class="block-type-badge block-type-stats">📊 Stats</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Add Section Modal --}}
<div class="modal fade" id="addSectionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="fas fa-folder-plus me-2"></i>Tambah Section Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <label class="form-label fw-bold">Judul Section <span class="text-danger">*</span></label>
                    <input type="text" id="section_title" class="form-control form-control-lg" placeholder="Contoh: Galeri Kegiatan">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Subtitle (opsional)</label>
                    <input type="text" id="section_subtitle" class="form-control" placeholder="Deskripsi singkat section...">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Posisi <span class="text-danger">*</span></label>
                    <select id="section_position" class="form-select">
                        <option value="after_hero">Setelah Hero/Slider</option>
                        <option value="after_about">Setelah Kenali Lebih Dekat</option>
                        <option value="after_stats">Setelah Statistik</option>
                        <option value="after_news">Setelah Berita Terbaru</option>
                        <option value="after_alumni">Setelah Kata Alumni</option>
                        <option value="before_footer">Sebelum Footer</option>
                    </select>
                </div>
                <div class="mb-0">
                    <label class="form-label fw-bold">Warna Background</label>
                    <input type="color" id="section_bg_color" class="form-control form-control-color w-100" value="#ffffff" style="height: 45px;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="addSection()">
                    <i class="fas fa-check me-1"></i>Tambah Section
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Add Block Modal --}}
<div class="modal fade" id="addBlockModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Jenis Block</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="current_section_id">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="block-type-option" data-type="text" onclick="selectBlockType('text')">
                            <div class="fs-1 mb-2">📝</div>
                            <div class="fw-bold">Text</div>
                            <small class="text-muted">Paragraf teks</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="block-type-option" data-type="gallery" onclick="selectBlockType('gallery')">
                            <div class="fs-1 mb-2">🖼️</div>
                            <div class="fw-bold">Gallery</div>
                            <small class="text-muted">Koleksi gambar</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="block-type-option" data-type="cards" onclick="selectBlockType('cards')">
                            <div class="fs-1 mb-2">🃏</div>
                            <div class="fw-bold">Cards</div>
                            <small class="text-muted">Grid kartu</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="block-type-option" data-type="stats" onclick="selectBlockType('stats')">
                            <div class="fs-1 mb-2">📊</div>
                            <div class="fw-bold">Stats</div>
                            <small class="text-muted">Angka statistik</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Block Modal --}}
<div class="modal fade" id="editBlockModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Block: <span id="edit_block_type_label"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_section_id">
                <input type="hidden" id="edit_block_index">
                <div id="block_edit_form"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveBlock()">
                    <i class="fas fa-save me-1"></i>Simpan Block
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
// Data structure
let homepageData = {
    sections: []
};

// Load existing data
let existingSections = @json($sections ?? []);
if (existingSections && existingSections.sections) {
    homepageData = existingSections;
} else if (Array.isArray(existingSections) && existingSections.length > 0) {
    homepageData.sections = existingSections;
}

// Position labels
const positionLabels = {
    'after_hero': 'After Hero',
    'after_about': 'After About',
    'after_stats': 'After Stats',
    'after_news': 'After News',
    'after_alumni': 'After Alumni',
    'before_footer': 'Before Footer'
};

const blockTypeLabels = {
    'text': '📝 Text',
    'gallery': '🖼️ Gallery',
    'cards': '🃏 Cards',
    'stats': '📊 Stats'
};

// Block content forms - SAMA PERSIS dengan pages/edit.blade.php
const blockForms = {
    text: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Judul section...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Subtitle (opsional)</label>
            <input type="text" name="block_subtitle" class="form-control" placeholder="Deskripsi singkat...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Konten</label>
            <textarea name="block_content" class="form-control" rows="8" placeholder="Tulis konten paragraf di sini..."></textarea>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Gambar (opsional)</label>
            <div class="input-group mb-2">
                <input type="text" name="block_image" class="form-control" placeholder="Pilih dari Media..." id="text-image-input">
                <button type="button" class="btn btn-primary" onclick="openMediaPicker('text')">
                    <i class="fas fa-images"></i> Media
                </button>
            </div>
            <div id="text-image-preview" class="mb-2" style="display:none;">
                <img src="" style="max-width:200px;max-height:150px;border-radius:8px;border:1px solid #e5e7eb;">
                <button type="button" class="btn btn-sm btn-light-danger ms-2" onclick="clearTextImage()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">Layout Gambar</label>
                <select name="block_image_position" class="form-select">
                    <option value="none">Tanpa Gambar</option>
                    <option value="top">Gambar di Atas</option>
                    <option value="bottom">Gambar di Bawah</option>
                    <option value="left">Gambar di Kiri</option>
                    <option value="right">Gambar di Kanan</option>
                    <option value="background">Gambar sebagai Background</option>
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">Ukuran Gambar</label>
                <select name="block_image_size" class="form-select">
                    <option value="small">Kecil (30%)</option>
                    <option value="medium" selected>Sedang (50%)</option>
                    <option value="large">Besar (70%)</option>
                    <option value="full">Penuh (100%)</option>
                </select>
            </div>
        </div>
    `,
    gallery: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Gallery (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Contoh: Galeri Kegiatan">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Subtitle Gallery (opsional)</label>
            <input type="text" name="block_subtitle" class="form-control" placeholder="Deskripsi singkat tentang gallery ini...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>Gambar Gallery</span>
                <button type="button" class="btn btn-primary btn-sm" onclick="addGalleryItem()">
                    <i class="fas fa-plus me-1"></i> Tambah Gambar
                </button>
            </label>
            <div id="gallery-items-container"></div>
            <input type="hidden" name="block_images" id="gallery_images_hidden">
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Jumlah Kolom</label>
            <select name="block_columns" class="form-select">
                <option value="2">2 Kolom</option>
                <option value="3" selected>3 Kolom</option>
                <option value="4">4 Kolom</option>
            </select>
        </div>
    `,
    cards: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Layanan Kami...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>Card Items</span>
                <button type="button" class="btn btn-primary btn-sm" onclick="addCardItem()">
                    <i class="fas fa-plus me-1"></i> Tambah Card
                </button>
            </label>
            <div id="cards-items-container"></div>
            <input type="hidden" name="block_cards" id="cards_items_hidden">
        </div>
        <div class="row">
            <div class="col-md-6 mb-0">
                <label class="form-label fw-bold">Jumlah Kolom</label>
                <select name="block_columns" class="form-select">
                    <option value="2">2 Kolom</option>
                    <option value="3" selected>3 Kolom</option>
                    <option value="4">4 Kolom</option>
                </select>
            </div>
            <div class="col-md-6 mb-0">
                <label class="form-label fw-bold">Style</label>
                <select name="block_style" class="form-select">
                    <option value="icon-top">Icon di Atas</option>
                    <option value="icon-left">Icon di Kiri</option>
                    <option value="bordered">Dengan Border</option>
                </select>
            </div>
        </div>
    `,
    stats: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_section_title" class="form-control" placeholder="Statistik Kami...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Subtitle (opsional)</label>
            <input type="text" name="block_section_subtitle" class="form-control" placeholder="Data terbaru tahun 2024...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Deskripsi (opsional)</label>
            <textarea name="block_description" class="form-control" rows="3" placeholder="Penjelasan lebih detail tentang statistik ini..."></textarea>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Tipe Tampilan</label>
            <select name="block_display_type" class="form-select">
                <option value="numbers">Angka Besar</option>
                <option value="cards">Cards dengan Icon</option>
                <option value="progress">Progress Bar</option>
                <option value="pie">Pie Chart</option>
                <option value="bar">Bar Chart</option>
                <option value="donut">Donut Chart</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>Data Statistik</span>
                <button type="button" class="btn btn-primary btn-sm" onclick="addStatItem()">
                    <i class="fas fa-plus me-1"></i> Tambah Data
                </button>
            </label>
            <div id="stats-container"></div>
            <input type="hidden" name="block_stats" id="block_stats_hidden">
        </div>
    `
};

// === MEDIA PICKER (sama persis dengan pages) ===
let currentMediaTarget = null;
let currentGalleryItemId = null;

function openMediaPicker(target) {
    currentMediaTarget = target;
    
    if (!$('#mediaPickerModal').length) {
        const modalHtml = `
        <div class="modal fade" id="mediaPickerModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-images text-primary me-2"></i>Pilih dari Media Library</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <input type="text" class="form-control" style="max-width: 300px;" id="mediaSearch" placeholder="Cari gambar...">
                            <button type="button" class="btn btn-light-primary btn-sm" onclick="loadMediaItems()">
                                <i class="fas fa-sync"></i> Refresh
                            </button>
                        </div>
                        <div id="mediaGridContainer" style="min-height: 300px; max-height: 60vh; overflow-y: auto;">
                            <div class="text-center py-5">
                                <div class="spinner-border text-primary" role="status"></div>
                                <p class="text-muted mt-2">Memuat gambar...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        $('body').append(modalHtml);
    }
    
    $('#mediaPickerModal').modal('show');
    loadMediaItems();
}

function loadMediaItems(search = '') {
    $.get('/media/picker', { search: search }, function(response) {
        if (response.success && response.media.data.length > 0) {
            let html = '<div class="row g-3">';
            response.media.data.forEach(item => {
                html += `
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="media-item" style="cursor: pointer; border: 2px solid #e5e7eb; border-radius: 12px; overflow: hidden; transition: all 0.2s;" 
                         onclick="selectMediaImage('${item.large}', '${item.filename}')">
                        <img src="${item.thumb}" alt="${item.filename}" style="width: 100%; height: 150px; object-fit: cover;">
                        <div style="padding: 8px; background: #f8fafc;">
                            <div class="text-truncate small fw-medium">${item.filename}</div>
                            <div class="text-muted" style="font-size: 11px;">${item.size}</div>
                        </div>
                    </div>
                </div>`;
            });
            html += '</div>';
            $('#mediaGridContainer').html(html);
        } else {
            $('#mediaGridContainer').html('<div class="text-center py-5"><i class="fas fa-inbox fs-2x text-muted mb-3"></i><p class="text-muted">Tidak ada gambar</p></div>');
        }
    }).fail(function() {
        $('#mediaGridContainer').html('<div class="text-center py-5 text-danger"><i class="fas fa-exclamation-triangle fs-2x mb-3"></i><p>Gagal memuat media</p></div>');
    });
}

function selectMediaImage(url, filename) {
    if (currentMediaTarget === 'gallery-item') {
        const item = document.getElementById('gallery-item-' + currentGalleryItemId);
        if (item) {
            item.querySelector('.gallery-url').value = url;
            item.querySelector('.gallery-item-thumb').innerHTML = `<img src="${url}" style="width: 100%; height: 100%; object-fit: cover;">`;
            updateGalleryHidden();
        }
    } else if (currentMediaTarget === 'text') {
        $('#text-image-input').val(url);
        $('#text-image-preview img').attr('src', url);
        $('#text-image-preview').show();
    }
    $('#mediaPickerModal').modal('hide');
}

function clearTextImage() {
    $('#text-image-input').val('');
    $('#text-image-preview').hide();
    $('#text-image-preview img').attr('src', '');
}

$(document).on('input', '#mediaSearch', function() {
    const search = $(this).val();
    clearTimeout(window.mediaSearchTimer);
    window.mediaSearchTimer = setTimeout(() => loadMediaItems(search), 300);
});

// === GALLERY ITEM FUNCTIONS (sama persis dengan pages) ===
let galleryCounter = 0;

function addGalleryItem(url = '', title = '', subtitle = '') {
    galleryCounter++;
    const container = document.getElementById('gallery-items-container');
    if (!container) return;
    
    const itemHtml = `
        <div class="gallery-item-form" id="gallery-item-${galleryCounter}" style="background: #f8fafc; border-radius: 12px; padding: 16px; margin-bottom: 12px; border: 1px solid #e2e8f0;">
            <div class="d-flex gap-3">
                <div class="gallery-item-thumb" style="width: 80px; height: 80px; background: #e5e7eb; border-radius: 8px; overflow: hidden; flex-shrink: 0; cursor: pointer;" onclick="selectGalleryItemImage(${galleryCounter})">
                    ${url ? `<img src="${url}" style="width: 100%; height: 100%; object-fit: cover;">` : '<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;"><i class="fas fa-plus text-muted"></i></div>'}
                </div>
                <div style="flex: 1;">
                    <input type="hidden" class="gallery-url" value="${url}">
                    <input type="text" class="form-control form-control-sm mb-2 gallery-title" placeholder="Judul gambar (opsional)" value="${title}" onchange="updateGalleryHidden()">
                    <input type="text" class="form-control form-control-sm gallery-subtitle" placeholder="Keterangan (opsional)" value="${subtitle}" onchange="updateGalleryHidden()">
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger align-self-start" onclick="removeGalleryItem(${galleryCounter})" style="width: 32px; height: 32px; padding: 0;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', itemHtml);
    updateGalleryHidden();
}

function selectGalleryItemImage(itemId) {
    currentGalleryItemId = itemId;
    openMediaPicker('gallery-item');
}

function removeGalleryItem(id) {
    document.getElementById('gallery-item-' + id)?.remove();
    updateGalleryHidden();
}

function updateGalleryHidden() {
    const items = [];
    document.querySelectorAll('.gallery-item-form').forEach(item => {
        const url = item.querySelector('.gallery-url')?.value || '';
        const title = item.querySelector('.gallery-title')?.value || '';
        const subtitle = item.querySelector('.gallery-subtitle')?.value || '';
        if (url) {
            items.push(JSON.stringify({ url, title, subtitle }));
        }
    });
    $('#gallery_images_hidden').val(items.join('\n'));
}

function loadGalleryFromHidden() {
    const hidden = $('#gallery_images_hidden').val();
    if (!hidden) return;
    
    $('#gallery-items-container').empty();
    galleryCounter = 0;
    
    hidden.split('\n').forEach(line => {
        line = line.trim();
        if (!line) return;
        try {
            const item = JSON.parse(line);
            addGalleryItem(item.url || '', item.title || '', item.subtitle || '');
        } catch(e) {
            addGalleryItem(line, '', '');
        }
    });
}

// === STATS FORM FUNCTIONS (sama persis dengan pages) ===
let statsCounter = 0;

function addStatItem(value = '', label = '') {
    statsCounter++;
    const container = document.getElementById('stats-container');
    if (!container) return;
    
    const itemHtml = `
        <div class="stat-item-form" id="stat-item-${statsCounter}" style="background: #f8fafc; border-radius: 12px; padding: 12px 16px; margin-bottom: 10px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 12px;">
            <span class="badge bg-primary rounded-pill" style="min-width: 28px;">${statsCounter}</span>
            <input type="text" class="form-control stat-value" placeholder="500+" value="${value}" onchange="updateStatsHidden()" style="font-weight: 700; font-size: 16px; text-align: center; max-width: 100px;">
            <input type="text" class="form-control stat-label" placeholder="Label (cth: Total Alumni)" value="${label}" onchange="updateStatsHidden()" style="flex: 1;">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeStatItem(${statsCounter})" style="width: 36px; height: 36px; padding: 0; border-radius: 8px;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', itemHtml);
    updateStatsHidden();
}

function removeStatItem(id) {
    const item = document.getElementById(`stat-item-${id}`);
    if (item) {
        item.remove();
        updateStatsHidden();
    }
}

function updateStatsHidden() {
    const items = document.querySelectorAll('.stat-item-form');
    const stats = [];
    
    items.forEach(item => {
        const value = item.querySelector('.stat-value').value.trim();
        const label = item.querySelector('.stat-label').value.trim();
        
        if (value && label) {
            stats.push(`${value} | ${label}`);
        }
    });
    
    const hidden = document.getElementById('block_stats_hidden');
    if (hidden) {
        hidden.value = stats.join('\n');
    }
}

function loadStatsFromHidden() {
    const hidden = document.getElementById('block_stats_hidden');
    const container = document.getElementById('stats-container');
    
    if (!hidden || !container) return;
    
    container.innerHTML = '';
    statsCounter = 0;
    
    const lines = hidden.value.split('\n').filter(line => line.trim());
    
    if (lines.length === 0) {
        addStatItem();
        return;
    }
    
    lines.forEach(line => {
        const parts = line.split('|').map(p => p.trim());
        if (parts.length >= 2) {
            addStatItem(parts[0], parts[1]);
        }
    });
}

// === CARDS FORM FUNCTIONS ===
let cardsCounter = 0;

function addCardItem(icon = 'fas fa-star', title = '', description = '', link = '') {
    cardsCounter++;
    const container = document.getElementById('cards-items-container');
    if (!container) return;
    
    const itemHtml = `
        <div class="card-item-form" id="card-item-${cardsCounter}" style="background: #f8fafc; border-radius: 12px; padding: 16px; margin-bottom: 12px; border: 1px solid #e2e8f0;">
            <div class="d-flex align-items-center gap-3 mb-3">
                <span class="badge bg-primary rounded-pill">${cardsCounter}</span>
                <div class="input-group" style="max-width: 200px;">
                    <span class="input-group-text" style="background: #fff;">
                        <i class="card-icon-preview ${icon}" style="font-size: 18px; color: #1e3a8a;"></i>
                    </span>
                    <input type="hidden" class="card-icon" value="${icon}">
                    <button type="button" class="btn btn-outline-primary" onclick="openCardIconPicker(${cardsCounter})">
                        <i class="fas fa-icons"></i> Pilih Icon
                    </button>
                </div>
                <input type="text" class="form-control card-title" placeholder="Judul Card" value="${title}" onchange="updateCardsHidden()" style="flex: 1; font-weight: 600;">
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeCardItem(${cardsCounter})" style="width: 36px; height: 36px; padding: 0; border-radius: 8px;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="row g-2">
                <div class="col-md-8">
                    <textarea class="form-control card-description" placeholder="Deskripsi singkat..." onchange="updateCardsHidden()" rows="2">${description}</textarea>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control card-link" placeholder="Link (opsional)" value="${link}" onchange="updateCardsHidden()">
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', itemHtml);
    updateCardsHidden();
}

function removeCardItem(id) {
    const item = document.getElementById(`card-item-${id}`);
    if (item) {
        item.remove();
        updateCardsHidden();
    }
}

function updateCardsHidden() {
    const items = document.querySelectorAll('.card-item-form');
    const cards = [];
    
    items.forEach(item => {
        const icon = item.querySelector('.card-icon').value.trim();
        const title = item.querySelector('.card-title').value.trim();
        const description = item.querySelector('.card-description').value.trim();
        const link = item.querySelector('.card-link').value.trim();
        
        if (title) {
            cards.push(JSON.stringify({ icon: icon || 'fas fa-star', title, description, link }));
        }
    });
    
    const hidden = document.getElementById('cards_items_hidden');
    if (hidden) {
        hidden.value = cards.join('\n');
    }
}

// === ICON PICKER FOR CARDS ===
let currentCardIconTarget = null;

const availableCardIcons = [
    { icon: 'fas fa-star', label: 'Bintang' },
    { icon: 'fas fa-heart', label: 'Hati' },
    { icon: 'fas fa-users', label: 'Pengguna' },
    { icon: 'fas fa-graduation-cap', label: 'Pendidikan' },
    { icon: 'fas fa-book', label: 'Buku' },
    { icon: 'fas fa-trophy', label: 'Piala' },
    { icon: 'fas fa-rocket', label: 'Roket' },
    { icon: 'fas fa-lightbulb', label: 'Ide' },
    { icon: 'fas fa-cog', label: 'Setting' },
    { icon: 'fas fa-chart-line', label: 'Grafik' },
    { icon: 'fas fa-check-circle', label: 'Centang' },
    { icon: 'fas fa-award', label: 'Award' },
    { icon: 'fas fa-briefcase', label: 'Tas Kerja' },
    { icon: 'fas fa-building', label: 'Gedung' },
    { icon: 'fas fa-calendar', label: 'Kalender' },
    { icon: 'fas fa-clock', label: 'Waktu' },
    { icon: 'fas fa-envelope', label: 'Email' },
    { icon: 'fas fa-phone', label: 'Telepon' },
    { icon: 'fas fa-map-marker-alt', label: 'Lokasi' },
    { icon: 'fas fa-globe', label: 'Dunia' },
    { icon: 'fas fa-handshake', label: 'Kerjasama' },
    { icon: 'fas fa-laptop-code', label: 'Coding' },
    { icon: 'fas fa-palette', label: 'Seni' },
    { icon: 'fas fa-music', label: 'Musik' },
    { icon: 'fas fa-camera', label: 'Kamera' },
    { icon: 'fas fa-video', label: 'Video' },
    { icon: 'fas fa-home', label: 'Rumah' },
    { icon: 'fas fa-car', label: 'Mobil' },
    { icon: 'fas fa-plane', label: 'Pesawat' },
    { icon: 'fas fa-gem', label: 'Permata' },
    { icon: 'fas fa-shield-alt', label: 'Keamanan' },
    { icon: 'fas fa-bolt', label: 'Kilat' },
    { icon: 'fas fa-fire', label: 'Api' },
    { icon: 'fas fa-leaf', label: 'Daun' },
    { icon: 'fas fa-sun', label: 'Matahari' },
    { icon: 'fas fa-moon', label: 'Bulan' },
    { icon: 'fas fa-coffee', label: 'Kopi' },
    { icon: 'fas fa-utensils', label: 'Makanan' },
    { icon: 'fas fa-gift', label: 'Hadiah' },
    { icon: 'fas fa-comments', label: 'Chat' },
    { icon: 'fas fa-newspaper', label: 'Berita' },
    { icon: 'fas fa-bullhorn', label: 'Pengumuman' },
    { icon: 'fas fa-thumbs-up', label: 'Like' },
    { icon: 'fas fa-magic', label: 'Magic' },
    { icon: 'fas fa-flag', label: 'Bendera' },
    { icon: 'fas fa-dumbbell', label: 'Fitness' },
    { icon: 'fas fa-futbol', label: 'Bola' },
    { icon: 'fas fa-running', label: 'Lari' }
];

function openCardIconPicker(cardId) {
    currentCardIconTarget = cardId;
    
    if (!$('#cardIconPickerModal').length) {
        let iconsHtml = '';
        availableCardIcons.forEach(item => {
            iconsHtml += `
                <div class="icon-option" data-icon="${item.icon}" onclick="selectCardIcon('${item.icon}')" 
                     style="cursor:pointer;padding:12px;border:2px solid #e5e7eb;border-radius:12px;text-align:center;transition:all 0.2s;">
                    <i class="${item.icon}" style="font-size:24px;color:#1e3a8a;display:block;margin-bottom:6px;"></i>
                    <small style="color:#6b7280;font-size:11px;">${item.label}</small>
                </div>
            `;
        });
        
        const modalHtml = `
        <div class="modal fade" id="cardIconPickerModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white"><i class="fas fa-icons me-2"></i>Pilih Icon</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="cardIconSearch" placeholder="Cari icon..." onkeyup="filterCardIcons()">
                        </div>
                        <div id="cardIconGrid" style="display:grid;grid-template-columns:repeat(6,1fr);gap:10px;max-height:400px;overflow-y:auto;">
                            ${iconsHtml}
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        $('body').append(modalHtml);
        
        $(document).on('mouseenter', '#cardIconPickerModal .icon-option', function() {
            $(this).css({'border-color': '#1e3a8a', 'background': '#f0f9ff', 'transform': 'scale(1.05)'});
        }).on('mouseleave', '#cardIconPickerModal .icon-option', function() {
            $(this).css({'border-color': '#e5e7eb', 'background': 'transparent', 'transform': 'scale(1)'});
        });
    }
    
    $('#cardIconPickerModal').modal('show');
}

function selectCardIcon(iconClass) {
    const cardItem = document.getElementById(`card-item-${currentCardIconTarget}`);
    if (cardItem) {
        cardItem.querySelector('.card-icon').value = iconClass;
        const preview = cardItem.querySelector('.card-icon-preview');
        preview.className = 'card-icon-preview ' + iconClass;
        updateCardsHidden();
    }
    $('#cardIconPickerModal').modal('hide');
}

function filterCardIcons() {
    const search = $('#cardIconSearch').val().toLowerCase();
    $('#cardIconGrid .icon-option').each(function() {
        const label = $(this).find('small').text().toLowerCase();
        const icon = $(this).data('icon').toLowerCase();
        $(this).toggle(label.includes(search) || icon.includes(search));
    });
}

// Initialize
$(document).ready(function() {
    renderSections();
    updateSectionCount();
});

function renderSections() {
    const container = $('#sections-container');
    container.empty();

    if (homepageData.sections.length === 0) {
        container.html('<div class="text-center text-muted py-5"><i class="fas fa-inbox fs-1 mb-3 d-block"></i>Belum ada section. Klik tombol di bawah untuk menambah.</div>');
        return;
    }

    homepageData.sections.forEach((section, index) => {
        const blocksHtml = section.blocks?.map((block, bIndex) => `
            <div class="block-item d-flex justify-content-between align-items-center">
                <div>
                    <span class="block-type-badge block-type-${block.type}">${blockTypeLabels[block.type] || block.type}</span>
                    <span class="text-muted small ms-2">${getBlockSummary(block)}</span>
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-light-primary me-1" onclick="editBlock('${section.id}', ${bIndex})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-light-danger" onclick="deleteBlock('${section.id}', ${bIndex})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `).join('') || '';

        const html = `
            <div class="section-item" data-id="${section.id}">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">${section.title}</h5>
                        <span class="position-badge position-${section.position}">${positionLabels[section.position] || section.position}</span>
                        ${section.subtitle ? `<p class="text-muted small mb-0 mt-2">${section.subtitle}</p>` : ''}
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-light-primary me-1" onclick="editSection('${section.id}')">
                            <i class="fas fa-cog"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-light-danger" onclick="deleteSection('${section.id}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="blocks-container mb-3">
                    ${blocksHtml || '<div class="text-muted small text-center py-2">Belum ada block</div>'}
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm w-100" onclick="openAddBlockModal('${section.id}')">
                    <i class="fas fa-plus me-1"></i>Tambah Block
                </button>
            </div>
        `;
        container.append(html);
    });

    // Init sortable
    new Sortable(container[0], {
        animation: 150,
        handle: '.section-item',
        onEnd: function() {
            reorderSections();
        }
    });
}

function getBlockSummary(block) {
    if (block.type === 'text') return (block.content || '').substring(0, 30) + '...';
    if (block.type === 'gallery') return (block.images?.length || 0) + ' gambar';
    if (block.type === 'cards') return (block.cards?.length || 0) + ' card';
    if (block.type === 'stats') return (block.stats?.length || 0) + ' data';
    return '';
}

function updateSectionCount() {
    $('#section-count').text(homepageData.sections.length + ' sections');
}

function openAddSectionModal() {
    $('#section_title').val('');
    $('#section_subtitle').val('');
    $('#section_position').val('after_hero');
    $('#section_bg_color').val('#ffffff');
    $('#addSectionModal').modal('show');
}

function addSection() {
    const title = $('#section_title').val().trim();
    if (!title) {
        Swal.fire({icon: 'warning', title: 'Judul wajib diisi', timer: 2000, showConfirmButton: false});
        return;
    }

    const section = {
        id: 'section_' + Date.now(),
        title: title,
        subtitle: $('#section_subtitle').val().trim(),
        position: $('#section_position').val(),
        bg_color: $('#section_bg_color').val(),
        blocks: []
    };

    homepageData.sections.push(section);
    $('#addSectionModal').modal('hide');
    renderSections();
    updateSectionCount();

    Swal.fire({icon: 'success', title: 'Section ditambahkan!', timer: 1500, showConfirmButton: false});
}

function deleteSection(id) {
    Swal.fire({
        title: 'Hapus Section?',
        text: 'Section dan semua block di dalamnya akan dihapus.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            homepageData.sections = homepageData.sections.filter(s => s.id !== id);
            renderSections();
            updateSectionCount();
            Swal.fire({icon: 'success', title: 'Dihapus!', timer: 1500, showConfirmButton: false});
        }
    });
}

function reorderSections() {
    const newOrder = [];
    $('.section-item').each(function() {
        const id = $(this).data('id');
        const section = homepageData.sections.find(s => s.id === id);
        if (section) newOrder.push(section);
    });
    homepageData.sections = newOrder;
}

function openAddBlockModal(sectionId) {
    $('#current_section_id').val(sectionId);
    $('.block-type-option').removeClass('selected');
    $('#addBlockModal').modal('show');
}

function selectBlockType(type) {
    $('.block-type-option').removeClass('selected');
    $(`.block-type-option[data-type="${type}"]`).addClass('selected');

    const sectionId = $('#current_section_id').val();
    $('#addBlockModal').modal('hide');

    // Reset counters
    galleryCounter = 0;
    statsCounter = 0;

    // Open edit modal with empty form
    $('#edit_section_id').val(sectionId);
    $('#edit_block_index').val(-1); // -1 means new block
    $('#edit_block_type_label').text(blockTypeLabels[type] || type);
    $('#block_edit_form').html(blockForms[type] || '<p>Form tidak tersedia</p>');
    $('#block_edit_form').data('type', type);
    
    // Add initial item
    setTimeout(() => {
        if (type === 'gallery') addGalleryItem();
        else if (type === 'stats') addStatItem();
    }, 100);
    
    $('#editBlockModal').modal('show');
}

function editBlock(sectionId, blockIndex) {
    const section = homepageData.sections.find(s => s.id === sectionId);
    if (!section || !section.blocks[blockIndex]) return;

    const block = section.blocks[blockIndex];
    
    // Reset counters
    galleryCounter = 0;
    statsCounter = 0;
    
    $('#edit_section_id').val(sectionId);
    $('#edit_block_index').val(blockIndex);
    $('#edit_block_type_label').text(blockTypeLabels[block.type] || block.type);
    $('#block_edit_form').html(blockForms[block.type] || '<p>Form tidak tersedia</p>');
    $('#block_edit_form').data('type', block.type);

    // Fill form with existing data
    setTimeout(() => {
        if (block.type === 'text') {
            $('input[name="block_title"]').val(block.title || '');
            $('input[name="block_subtitle"]').val(block.subtitle || '');
            $('textarea[name="block_content"]').val(block.content || '');
            $('input[name="block_image"]').val(block.image || '');
            $('select[name="block_image_position"]').val(block.image_position || 'none');
            $('select[name="block_image_size"]').val(block.image_size || 'medium');
            // Show image preview if exists
            if (block.image) {
                $('#text-image-preview img').attr('src', block.image);
                $('#text-image-preview').show();
            }
        } else if (block.type === 'gallery') {
            $('input[name="block_title"]').val(block.title || '');
            $('input[name="block_subtitle"]').val(block.subtitle || '');
            $('select[name="block_columns"]').val(block.columns || '3');
            // Load gallery items
            if (block.images && block.images.length > 0) {
                block.images.forEach(img => {
                    if (typeof img === 'object') {
                        addGalleryItem(img.url || '', img.title || '', img.subtitle || '');
                    } else {
                        addGalleryItem(img, '', '');
                    }
                });
            } else {
                addGalleryItem();
            }
        } else if (block.type === 'cards') {
            $('input[name="block_title"]').val(block.title || '');
            $('select[name="block_columns"]').val(block.columns || '3');
            $('select[name="block_style"]').val(block.style || 'icon-top');
            // Load cards dynamically
            cardsCounter = 0;
            if (block.cards && block.cards.length > 0) {
                block.cards.forEach(c => {
                    addCardItem(c.icon || 'fas fa-star', c.title || '', c.description || '', c.link || '');
                });
            } else {
                addCardItem();
            }
        } else if (block.type === 'stats') {
            $('input[name="block_section_title"]').val(block.section_title || '');
            $('input[name="block_section_subtitle"]').val(block.section_subtitle || '');
            $('textarea[name="block_description"]').val(block.description || '');
            $('select[name="block_display_type"]').val(block.display_type || 'numbers');
            // Load stats items
            if (block.stats && block.stats.length > 0) {
                block.stats.forEach(s => {
                    addStatItem(s.value || '', s.label || '');
                });
            } else {
                addStatItem();
            }
        }
    }, 100);

    $('#editBlockModal').modal('show');
}

function saveBlock() {
    const sectionId = $('#edit_section_id').val();
    const blockIndex = parseInt($('#edit_block_index').val());
    const blockType = $('#block_edit_form').data('type');

    const section = homepageData.sections.find(s => s.id === sectionId);
    if (!section) return;

    let block = { type: blockType };

    if (blockType === 'text') {
        block.title = $('input[name="block_title"]').val();
        block.subtitle = $('input[name="block_subtitle"]').val();
        block.content = $('textarea[name="block_content"]').val();
        block.image = $('input[name="block_image"]').val();
        block.image_position = $('select[name="block_image_position"]').val();
        block.image_size = $('select[name="block_image_size"]').val();
    } else if (blockType === 'gallery') {
        block.title = $('input[name="block_title"]').val();
        block.subtitle = $('input[name="block_subtitle"]').val();
        block.columns = $('select[name="block_columns"]').val();
        block.images = [];
        $('.gallery-item-form').each(function() {
            const url = $(this).find('.gallery-url').val().trim();
            const title = $(this).find('.gallery-title').val().trim();
            const subtitle = $(this).find('.gallery-subtitle').val().trim();
            if (url) {
                block.images.push({ url, title, subtitle });
            }
        });
    } else if (blockType === 'cards') {
        block.title = $('input[name="block_title"]').val();
        block.columns = $('select[name="block_columns"]').val();
        block.style = $('select[name="block_style"]').val();
        block.cards = [];
        $('.card-item-form').each(function() {
            const icon = $(this).find('.card-icon').val().trim();
            const title = $(this).find('.card-title').val().trim();
            const description = $(this).find('.card-description').val().trim();
            const link = $(this).find('.card-link').val().trim();
            if (title) {
                block.cards.push({ icon: icon || 'fas fa-star', title, description, link });
            }
        });
    } else if (blockType === 'stats') {
        block.section_title = $('input[name="block_section_title"]').val();
        block.section_subtitle = $('input[name="block_section_subtitle"]').val();
        block.description = $('textarea[name="block_description"]').val();
        block.display_type = $('select[name="block_display_type"]').val();
        block.stats = [];
        $('.stat-item-form').each(function() {
            const value = $(this).find('.stat-value').val().trim();
            const label = $(this).find('.stat-label').val().trim();
            if (value || label) {
                block.stats.push({ value, label });
            }
        });
    }

    if (blockIndex === -1) {
        section.blocks.push(block);
    } else {
        section.blocks[blockIndex] = block;
    }

    $('#editBlockModal').modal('hide');
    renderSections();
    Swal.fire({icon: 'success', title: 'Block disimpan!', timer: 1500, showConfirmButton: false});
}

function deleteBlock(sectionId, blockIndex) {
    Swal.fire({
        title: 'Hapus Block?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const section = homepageData.sections.find(s => s.id === sectionId);
            if (section) {
                section.blocks.splice(blockIndex, 1);
                renderSections();
            }
        }
    });
}

function saveHomepageBuilder() {
    Swal.fire({
        title: 'Simpan Homepage Builder?',
        text: 'Semua perubahan akan disimpan.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("home-settings.homepage-builder.update") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    page_builder_data: JSON.stringify(homepageData)
                },
                success: function(response) {
                    Swal.fire({icon: 'success', title: 'Berhasil!', text: response.message, confirmButtonText: 'OK'});
                },
                error: function(xhr) {
                    Swal.fire({icon: 'error', title: 'Gagal!', text: xhr.responseJSON?.message || 'Terjadi kesalahan', confirmButtonText: 'OK'});
                }
            });
        }
    });
}
</script>
@endpush
