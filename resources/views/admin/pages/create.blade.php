@extends('layouts.dashboard.dashboard')

@section('title', 'Add Page')
@section('menu', 'Pages')

@section('link')
    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted"><a href="{{ route('pages.index') }}" class="text-muted text-hover-primary">Pages</a></li>
    <li class="breadcrumb-item text-gray-700">Add Page</li>
@endsection

@push('styles')
<style>
.block-item {
    background: #fff;
    border: 1px solid #e4e6ef;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
    cursor: move;
    transition: all 0.2s;
}
.block-item:hover {
    border-color: #1e3a8a;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}
.block-item.is-sidebar {
    background: #fef3c7;
    border-color: #fbbf24;
}
.block-type-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}
.placement-badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 3px;
    font-size: 10px;
    font-weight: 600;
}
.placement-main { background: #dbeafe; color: #1e40af; }
.placement-sidebar { background: #fef3c7; color: #92400e; }
.block-type-hero { background: #fef3c7; color: #92400e; }
.block-type-text { background: #dbeafe; color: #1e40af; }
.block-type-gallery { background: #ede9fe; color: #5b21b6; }
.block-type-stats { background: #fee2e2; color: #991b1b; }
.block-type-cards { background: #d1fae5; color: #065f46; }
.block-type-accordion { background: #fce7f3; color: #9d174d; }
.block-type-tabs { background: #ccfbf1; color: #0f766e; }
.block-type-timeline { background: #fed7aa; color: #c2410c; }
.block-type-table { background: #e0e7ff; color: #3730a3; }
.block-type-quote { background: #fae8ff; color: #86198f; }
.block-type-video { background: #fecaca; color: #b91c1c; }
.block-type-slider { background: #d9f99d; color: #3f6212; }
.block-type-list { background: #bfdbfe; color: #1e40af; }
.block-type-steps { background: #fef08a; color: #854d0e; }
.block-type-map { background: #a5f3fc; color: #0e7490; }
.block-type-divider { background: #e5e7eb; color: #374151; }
.add-block-btn {
    border: 2px dashed #c4c4c4;
    background: #fafafa;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
}
.add-block-btn:hover {
    border-color: #1e3a8a;
    background: #f0f9ff;
}
.block-type-selector {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}
.block-type-option {
    padding: 15px 10px;
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
.block-type-option .icon {
    font-size: 24px;
    margin-bottom: 5px;
}
.settings-group {
    background: #f8fafc;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
}
.settings-group-title {
    font-size: 13px;
    font-weight: 700;
    color: #1e3a8a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
}

/* Layout selector active state - using direct class */
.layout-active {
    background-color: #dbeafe !important;
    border-color: #1e3a8a !important;
    border-width: 2px !important;
    box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.2) !important;
}
.layout-active .text-gray-800,
.layout-active .fw-bold {
    color: #1e3a8a !important;
    font-weight: 700 !important;
}
.layout-active i {
    color: #1e3a8a !important;
}
.layout-active .text-muted {
    color: #3b82f6 !important;
}
</style>
@endpush

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <form id="pageForm" method="POST" action="{{ route('pages.store') }}">
            @csrf
            <input type="hidden" name="page_builder_data" id="page_builder_data" value="[]">

            <div class="row g-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Basic Info -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">📝 Informasi Halaman</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-5">
                                    <label class="form-label required">Judul Halaman</label>
                                    <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Masukkan judul halaman..." required />
                                </div>
                                <div class="col-md-4 mb-5">
                                    <label class="form-label">Slug URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text">/</span>
                                        <input type="text" name="slug" id="slug" class="form-control" placeholder="auto" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Builder -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">🧱 Page Builder</h3>
                            <div class="card-toolbar">
                                <span class="badge badge-light-primary me-2" id="block-count">0 blok</span>
                                <span class="badge badge-light-warning" id="sidebar-note" style="display:none;">Sidebar aktif</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info d-flex align-items-center mb-4">
                                <i class="fas fa-info-circle me-3 fs-2"></i>
                                <div>
                                    <strong>Tips:</strong> Drag blok untuk mengubah urutan. Block Hero selalu full-width. Block lain bisa ditempatkan di main atau sidebar.
                                </div>
                            </div>

                            <!-- Blocks Container -->
                            <div id="blocks-container" class="mb-4">
                                <!-- Blocks will be rendered here -->
                            </div>

                            <!-- Add Block Button -->
                            <div class="add-block-btn" data-bs-toggle="modal" data-bs-target="#addBlockModal">
                                <i class="fas fa-plus-circle text-primary fs-2"></i>
                                <div class="mt-2 fw-bold text-gray-700">Tambah Blok</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Publish Settings -->
                    <div class="card mb-5 sticky-top" style="top: 20px;">
                        <div class="card-header">
                            <h3 class="card-title">⚙️ Pengaturan</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-5">
                                <label class="form-label required">Status</label>
                                <select name="status" class="form-select">
                                    <option value="draft">📝 Draft</option>
                                    <option value="published">✅ Published</option>
                                </select>
                            </div>

                            <div class="mb-0">
                                <label class="form-label required">Layout Halaman</label>
                                <p class="text-muted small mb-3">Pilih layout yang sesuai dengan kebutuhan halaman</p>
                                <div class="d-grid gap-2">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-4 text-start layout-active">
                                        <input type="radio" name="layout" value="full" class="btn-check" checked onchange="updateLayoutHighlight(this)">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-arrows-alt-h fs-2x text-primary me-4"></i>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-gray-800">Full Width</div>
                                                <div class="text-muted fs-7">Semua block full-width, tanpa sidebar</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-4 text-start">
                                        <input type="radio" name="layout" value="sidebar-right" class="btn-check" onchange="updateLayoutHighlight(this)">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-th-large fs-2x text-primary me-4"></i>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-gray-800">Sidebar Kanan</div>
                                                <div class="text-muted fs-7">Konten utama di kiri, sidebar di kanan</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-4 text-start">
                                        <input type="radio" name="layout" value="sidebar-left" class="btn-check" onchange="updateLayoutHighlight(this)">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-th-large fs-2x text-primary me-4"></i>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-gray-800">Sidebar Kiri</div>
                                                <div class="text-muted fs-7">Sidebar di kiri, konten utama di kanan</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-4">
                            <a href="{{ route('pages.index') }}" class="btn btn-light me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label"><i class="fas fa-save me-1"></i> Simpan</span>
                                <span class="indicator-progress">Menyimpan...<span class="spinner-border spinner-border-sm ms-2"></span></span>
                            </button>
                        </div>
                    </div>

                    <!-- Page Settings -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">🎨 Warna Global</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-4">Warna default untuk semua block (bisa di-override per block)</p>
                            <div class="mb-4">
                                <label class="form-label">Background</label>
                                <input type="color" name="bg_color" value="#ffffff" class="form-control form-control-color w-100" style="height: 40px;">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Teks</label>
                                <input type="color" name="text_color" value="#333333" class="form-control form-control-color w-100" style="height: 40px;">
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Aksen</label>
                                <input type="color" name="accent_color" value="#1e3a8a" class="form-control form-control-color w-100" style="height: 40px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- Add Block Modal -->
<div class="modal fade" id="addBlockModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Jenis Blok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="block-type-selector">
                    <div class="block-type-option" data-type="hero">
                        <div class="icon">🎯</div>
                        <div class="fw-bold">Hero</div>
                        <small class="text-muted">Banner besar</small>
                    </div>
                    <div class="block-type-option" data-type="text">
                        <div class="icon">📝</div>
                        <div class="fw-bold">Text</div>
                        <small class="text-muted">Paragraf</small>
                    </div>
                    <div class="block-type-option" data-type="gallery">
                        <div class="icon">🖼️</div>
                        <div class="fw-bold">Gallery</div>
                        <small class="text-muted">Koleksi gambar</small>
                    </div>
                    <div class="block-type-option" data-type="stats">
                        <div class="icon">📊</div>
                        <div class="fw-bold">Stats</div>
                        <small class="text-muted">Angka/Chart</small>
                    </div>
                    <div class="block-type-option" data-type="cards">
                        <div class="icon">🃏</div>
                        <div class="fw-bold">Cards</div>
                        <small class="text-muted">Grid cards</small>
                    </div>
                    <div class="block-type-option" data-type="accordion">
                        <div class="icon">📋</div>
                        <div class="fw-bold">Accordion</div>
                        <small class="text-muted">FAQ/Collapse</small>
                    </div>
                    <div class="block-type-option" data-type="tabs">
                        <div class="icon">📑</div>
                        <div class="fw-bold">Tabs</div>
                        <small class="text-muted">Tab horizontal</small>
                    </div>
                    <div class="block-type-option" data-type="timeline">
                        <div class="icon">⏱️</div>
                        <div class="fw-bold">Timeline</div>
                        <small class="text-muted">Kronologi</small>
                    </div>
                    <div class="block-type-option" data-type="table">
                        <div class="icon">📊</div>
                        <div class="fw-bold">Table</div>
                        <small class="text-muted">Data tabel</small>
                    </div>
                    <div class="block-type-option" data-type="quote">
                        <div class="icon">💬</div>
                        <div class="fw-bold">Quote</div>
                        <small class="text-muted">Kutipan</small>
                    </div>
                    <div class="block-type-option" data-type="video">
                        <div class="icon">🎬</div>
                        <div class="fw-bold">Video</div>
                        <small class="text-muted">YouTube/Vimeo</small>
                    </div>
                    <div class="block-type-option" data-type="slider">
                        <div class="icon">🎠</div>
                        <div class="fw-bold">Slider</div>
                        <small class="text-muted">Carousel</small>
                    </div>
                    <div class="block-type-option" data-type="list">
                        <div class="icon">📝</div>
                        <div class="fw-bold">List</div>
                        <small class="text-muted">Icon list</small>
                    </div>
                    <div class="block-type-option" data-type="steps">
                        <div class="icon">👣</div>
                        <div class="fw-bold">Steps</div>
                        <small class="text-muted">Langkah-langkah</small>
                    </div>
                    <div class="block-type-option" data-type="map">
                        <div class="icon">🗺️</div>
                        <div class="fw-bold">Map</div>
                        <small class="text-muted">Google Maps</small>
                    </div>
                    <div class="block-type-option" data-type="divider">
                        <div class="icon">➖</div>
                        <div class="fw-bold">Divider</div>
                        <small class="text-muted">Pembatas</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Block Modal -->
<div class="modal fade" id="editBlockModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Blok: <span id="edit-block-type"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-5">
                    <!-- Left: Content Settings -->
                    <div class="col-md-7">
                        <h6 class="fw-bold text-gray-800 mb-4">📝 Konten Block</h6>
                        <div id="edit-block-content-form">
                            <!-- Content form will be injected here -->
                        </div>
                    </div>

                    <!-- Right: Block Settings -->
                    <div class="col-md-5">
                        <h6 class="fw-bold text-gray-800 mb-4">⚙️ Pengaturan Block</h6>

                        <!-- Placement -->
                        <div class="settings-group" id="placement-settings">
                            <div class="settings-group-title">📍 Penempatan</div>
                            <div class="d-grid gap-2">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-3 text-start">
                                    <input type="radio" name="block_placement" value="main" class="btn-check" checked>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-expand fs-3 text-primary me-3"></i>
                                        <div>
                                            <div class="fw-bold">Konten Utama</div>
                                            <small class="text-muted">Block di area utama (full-width)</small>
                                        </div>
                                    </div>
                                </label>
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-warning p-3 text-start">
                                    <input type="radio" name="block_placement" value="sidebar" class="btn-check">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-sidebar fs-3 text-warning me-3"></i>
                                        <div>
                                            <div class="fw-bold">Sidebar</div>
                                            <small class="text-muted">Block di sidebar (jika layout sidebar aktif)</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="settings-group" id="section-header-settings">
                            <div class="settings-group-title">📌 Section Header</div>
                            <p class="text-muted small mb-3">Header yang ditampilkan di atas block ini</p>
                            <div class="mb-3">
                                <label class="form-label small">Judul Section</label>
                                <input type="text" name="section_title" class="form-control" placeholder="Judul section...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">Subtitle Section</label>
                                <input type="text" name="section_subtitle" class="form-control" placeholder="Deskripsi singkat...">
                            </div>
                            <div class="mb-0">
                                <label class="form-label small">Icon (FontAwesome)</label>
                                <input type="hidden" name="section_icon" value="fas fa-star">
                                <div class="d-flex align-items-center gap-2">
                                    <div id="section-icon-preview" style="width:40px;height:40px;background:#f3f4f6;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-star" style="font-size:18px;color:#6366f1;"></i>
                                    </div>
                                    <button type="button" class="btn btn-light-primary btn-sm" onclick="openIconPicker('section')">
                                        <i class="fas fa-icons me-1"></i> Pilih
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Styling -->
                        <div class="settings-group">
                            <div class="settings-group-title">🎨 Styling</div>
                            <div class="mb-3">
                                <label class="form-check form-switch form-check-custom">
                                    <input class="form-check-input" type="checkbox" name="block_custom_colors" onchange="toggleCustomColors()">
                                    <span class="form-check-label fw-bold">Custom Warna</span>
                                </label>
                            </div>
                            <div id="custom-colors-fields" style="display:none;">
                                <div class="mb-3">
                                    <label class="form-label small">Background</label>
                                    <input type="color" name="block_bg_color" class="form-control form-control-color w-100" value="#ffffff">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small">Teks</label>
                                    <input type="color" name="block_text_color" class="form-control form-control-color w-100" value="#333333">
                                </div>
                                <div class="mb-0">
                                    <label class="form-label small">Aksen</label>
                                    <input type="color" name="block_accent_color" class="form-control form-control-color w-100" value="#1e3a8a">
                                </div>
                            </div>
                        </div>

                        <!-- Spacing -->
                        <div class="settings-group">
                            <div class="settings-group-title">📏 Spacing</div>
                            <div class="mb-3">
                                <label class="form-label small">Padding Vertikal</label>
                                <select name="block_padding_y" class="form-select form-select-sm">
                                    <option value="none">None (0px)</option>
                                    <option value="small">Small (40px)</option>
                                    <option value="medium" selected>Medium (60px)</option>
                                    <option value="large">Large (80px)</option>
                                    <option value="xlarge">Extra Large (100px)</option>
                                </select>
                            </div>
                            <div class="mb-0">
                                <label class="form-label small">Padding Horizontal</label>
                                <select name="block_padding_x" class="form-select form-select-sm">
                                    <option value="none">None</option>
                                    <option value="small">Small</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="large">Large</option>
                                </select>
                            </div>
                        </div>

                        <!-- Width -->
                        <div class="settings-group">
                            <div class="settings-group-title">↔️ Lebar</div>
                            <select name="block_width" class="form-select form-select-sm">
                                <option value="full">Full Width</option>
                                <option value="contained" selected>Container (max-width)</option>
                                <option value="narrow">Narrow (800px)</option>
                                <option value="wide">Wide (1200px)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="save-block-btn">Simpan Blok</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<!-- Summernote CSS & JS (no API key needed) -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
function initTextEditor() {
    if ($('textarea[name="block_content"]').hasClass('summernote')) {
        $('textarea[name="block_content"]').summernote('destroy');
    }
    
    $('textarea[name="block_content"]').addClass('summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['codeview', 'help']]
        ],
        styleTags: ['p', 'h2', 'h3', 'h4'],
        placeholder: 'Tulis konten di sini...'
    });
}

let blocks = [];
let editingBlockIndex = null;
let currentBlockType = null;
let currentLayout = 'full';

const blockTypeLabels = {
    hero: '🎯 Hero',
    text: '📝 Text',
    gallery: '🖼️ Gallery',
    stats: '📊 Stats',
    cards: '🃏 Cards',
    accordion: '📋 Accordion',
    tabs: '📑 Tabs',
    timeline: '⏱️ Timeline',
    table: '📊 Table',
    quote: '💬 Quote',
    video: '🎬 Video',
    slider: '🎠 Slider',
    list: '📝 List',
    steps: '👣 Steps',
    map: '🗺️ Map',
    divider: '➖ Divider'
};

const blockContentForms = {
    hero: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul</label>
            <input type="text" name="block_title" class="form-control form-control-lg" placeholder="Judul banner besar..." value="">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Subtitle (opsional)</label>
            <input type="text" name="block_subtitle" class="form-control" placeholder="Deskripsi singkat..." value="">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Gambar Background</label>
            <div class="input-group">
                <input type="text" name="block_image" class="form-control" placeholder="Pilih dari Media atau URL...">
                <button type="button" class="btn btn-primary" onclick="openMediaPicker('hero')">
                    <i class="fas fa-images"></i> Media
                </button>
            </div>
            <small class="text-muted">Kosongkan untuk menggunakan warna solid</small>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Warna Overlay/Background</label>
            <input type="color" name="block_overlay" class="form-control form-control-color w-100" value="#1e3a8a" style="height: 50px;">
        </div>
    `,
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
        <div class="row">
            <div class="col-md-6 mb-0">
                <label class="form-label fw-bold">Posisi Vertikal Teks</label>
                <select name="block_text_valign" class="form-select">
                    <option value="top">Atas</option>
                    <option value="center" selected>Tengah</option>
                    <option value="bottom">Bawah</option>
                </select>
                <small class="text-muted"><i class="fas fa-info-circle text-primary"></i> Hanya untuk layout: Kiri, Kanan, Background</small>
            </div>
            <div class="col-md-6 mb-0">
                <label class="form-label fw-bold">Overlay Gelap</label>
                <select name="block_image_overlay" class="form-select">
                    <option value="none" selected>Tidak ada</option>
                    <option value="light">Ringan (30%)</option>
                    <option value="medium">Sedang (50%)</option>
                    <option value="dark">Gelap (70%)</option>
                </select>
                <small class="text-muted"><i class="fas fa-info-circle text-warning"></i> Hanya untuk layout: Background</small>
            </div>
        </div>
    `,
    image: `
        <div class="mb-4">
            <label class="form-label fw-bold">Gambar</label>
            <div class="input-group">
                <input type="text" name="block_image" class="form-control" placeholder="https://... atau pilih dari Media" id="image-url-input">
                <button type="button" class="btn btn-primary" onclick="openMediaPicker('image')">
                    <i class="fas fa-images"></i> Media
                </button>
            </div>
            <div id="image-preview-container" class="mt-2" style="display: none;">
                <img id="image-preview" src="" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #e5e7eb;">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Caption (opsional)</label>
            <input type="text" name="block_caption" class="form-control" placeholder="Keterangan gambar...">
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Alignment</label>
            <select name="block_align" class="form-select">
                <option value="center">Center</option>
                <option value="left">Left</option>
                <option value="right">Right</option>
            </select>
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
            <textarea name="block_description" id="stats_description_editor" class="form-control" rows="3" placeholder="Penjelasan lebih detail tentang statistik ini..."></textarea>
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
    `,
    cards: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Layanan Kami...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Card Items</label>
            <p class="text-muted small mb-2"><i class="fas fa-info-circle text-primary me-1"></i>Format: <code>icon | judul | deskripsi | link</code> (satu per baris)</p>
            <textarea name="block_items" class="form-control" rows="6" placeholder="fas fa-rocket | Judul Card 1 | Deskripsi singkat card | /link-1
fas fa-users | Judul Card 2 | Deskripsi singkat card | /link-2
fas fa-chart-line | Judul Card 3 | Deskripsi singkat card | /link-3"></textarea>
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
    accordion: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="FAQ / Pertanyaan Umum...">
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Accordion Items</label>
            <p class="text-muted small mb-2"><i class="fas fa-info-circle text-primary me-1"></i>Format: <code>judul | konten</code> (satu per baris)</p>
            <textarea name="block_items" class="form-control" rows="8" placeholder="Apa itu layanan ini? | Layanan ini adalah solusi untuk kebutuhan Anda.
Bagaimana cara mendaftar? | Anda bisa mendaftar melalui website kami.
Berapa biayanya? | Silakan hubungi kami untuk informasi harga."></textarea>
        </div>
    `,
    tabs: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Informasi Lengkap...">
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Tab Items</label>
            <p class="text-muted small mb-2"><i class="fas fa-info-circle text-primary me-1"></i>Format: <code>judul tab | konten tab</code> (satu per baris)</p>
            <textarea name="block_items" class="form-control" rows="8" placeholder="Profil | Konten tentang profil perusahaan...
Visi Misi | Konten tentang visi dan misi...
Sejarah | Konten tentang sejarah perusahaan..."></textarea>
        </div>
    `,
    timeline: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Perjalanan Kami...">
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Timeline Items</label>
            <p class="text-muted small mb-2"><i class="fas fa-info-circle text-primary me-1"></i>Format: <code>tahun/tanggal | judul | deskripsi</code> (satu per baris)</p>
            <textarea name="block_items" class="form-control" rows="8" placeholder="2020 | Pendirian | Perusahaan didirikan dengan visi besar.
2021 | Ekspansi | Membuka cabang di 5 kota besar.
2022 | Pencapaian | Meraih penghargaan nasional.
2023 | Inovasi | Meluncurkan produk terbaru."></textarea>
        </div>
    `,
    table: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Daftar Harga...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Header Kolom</label>
            <input type="text" name="block_headers" class="form-control" placeholder="Nama | Harga | Keterangan (pisahkan dengan |)">
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Data Tabel</label>
            <p class="text-muted small mb-2"><i class="fas fa-info-circle text-primary me-1"></i>Satu baris per row, kolom dipisahkan dengan <code>|</code></p>
            <textarea name="block_items" class="form-control" rows="6" placeholder="Paket Basic | Rp 100.000 | Untuk pemula
Paket Pro | Rp 250.000 | Fitur lengkap
Paket Enterprise | Hubungi kami | Custom"></textarea>
        </div>
    `,
    quote: `
        <div class="mb-4">
            <label class="form-label fw-bold">Kutipan</label>
            <textarea name="block_content" class="form-control" rows="4" placeholder="Tuliskan kutipan atau testimonial di sini..."></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">Nama</label>
                <input type="text" name="block_author" class="form-control" placeholder="John Doe">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">Jabatan/Title</label>
                <input type="text" name="block_role" class="form-control" placeholder="CEO, Perusahaan ABC">
            </div>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Foto (opsional)</label>
            <div class="input-group">
                <input type="text" name="block_image" class="form-control" placeholder="URL foto...">
                <button type="button" class="btn btn-primary" onclick="openMediaPicker('quote')">
                    <i class="fas fa-images"></i> Media
                </button>
            </div>
        </div>
    `,
    video: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Video Profil...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">URL Video</label>
            <input type="text" name="block_url" class="form-control" placeholder="https://www.youtube.com/watch?v=... atau https://vimeo.com/...">
            <small class="text-muted">Mendukung YouTube dan Vimeo</small>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Aspect Ratio</label>
            <select name="block_ratio" class="form-select">
                <option value="16:9">16:9 (Widescreen)</option>
                <option value="4:3">4:3 (Standard)</option>
                <option value="1:1">1:1 (Square)</option>
            </select>
        </div>
    `,
    slider: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Testimoni Pelanggan...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Slider Items</label>
            <p class="text-muted small mb-2"><i class="fas fa-info-circle text-primary me-1"></i>Format: <code>gambar | judul | deskripsi</code> (satu per baris)</p>
            <textarea name="block_items" class="form-control" rows="6" placeholder="/storage/slide1.jpg | Slide 1 | Deskripsi slide pertama
/storage/slide2.jpg | Slide 2 | Deskripsi slide kedua
/storage/slide3.jpg | Slide 3 | Deskripsi slide ketiga"></textarea>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Autoplay</label>
            <select name="block_autoplay" class="form-select">
                <option value="true">Ya</option>
                <option value="false">Tidak</option>
            </select>
        </div>
    `,
    list: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Keunggulan Kami...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">List Items</label>
            <p class="text-muted small mb-2"><i class="fas fa-info-circle text-primary me-1"></i>Format: <code>icon | teks</code> (satu per baris)</p>
            <textarea name="block_items" class="form-control" rows="6" placeholder="fas fa-check | Kualitas terjamin
fas fa-check | Harga terjangkau
fas fa-check | Layanan 24 jam
fas fa-check | Garansi uang kembali"></textarea>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Layout</label>
            <select name="block_layout" class="form-select">
                <option value="single">1 Kolom</option>
                <option value="double">2 Kolom</option>
            </select>
        </div>
    `,
    steps: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Cara Kerja...">
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Steps Items</label>
            <p class="text-muted small mb-2"><i class="fas fa-info-circle text-primary me-1"></i>Format: <code>judul | deskripsi</code> (satu per baris, nomor otomatis)</p>
            <textarea name="block_items" class="form-control" rows="6" placeholder="Daftar Akun | Buat akun gratis dalam 2 menit.
Pilih Paket | Pilih paket sesuai kebutuhan Anda.
Mulai Gunakan | Langsung gunakan semua fitur."></textarea>
        </div>
    `,
    map: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Lokasi Kami...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Google Maps Embed URL</label>
            <input type="text" name="block_url" class="form-control" placeholder="https://www.google.com/maps/embed?pb=...">
            <small class="text-muted">Buka Google Maps → Share → Embed a map → Copy src URL</small>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Tinggi Map</label>
            <select name="block_height" class="form-select">
                <option value="300">Kecil (300px)</option>
                <option value="400" selected>Sedang (400px)</option>
                <option value="500">Besar (500px)</option>
            </select>
        </div>
    `,
    divider: `
        <div class="mb-4">
            <label class="form-label fw-bold">Style</label>
            <select name="block_style" class="form-select">
                <option value="line">Garis</option>
                <option value="dots">Titik-titik</option>
                <option value="icon">Dengan Icon</option>
                <option value="space">Spasi Saja</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Icon (untuk style icon)</label>
            <input type="text" name="block_icon" class="form-control" placeholder="fas fa-star">
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Tinggi Spasi</label>
            <select name="block_height" class="form-select">
                <option value="20">Kecil (20px)</option>
                <option value="40" selected>Sedang (40px)</option>
                <option value="60">Besar (60px)</option>
                <option value="80">Sangat Besar (80px)</option>
            </select>
        </div>
    `
};

$(document).ready(function() {
    // Initialize Sortable
    new Sortable(document.getElementById('blocks-container'), {
        animation: 150,
        handle: '.block-item',
        onEnd: function() {
            updateBlockOrder();
        }
    });

    // Block type selection
    $('.block-type-option').on('click', function() {
        const type = $(this).data('type');
        $('#addBlockModal').modal('hide');
        setTimeout(() => openEditBlockModal(type, null), 300);
    });

    // Save block
    $('#save-block-btn').on('click', function() {
        saveBlock();
    });

    // Auto-generate slug
    $('#title').on('blur', function() {
        if ($('#slug').val() === '') {
            const slug = $(this).val()
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            $('#slug').val(slug);
        }
    });

    // Form submission
    $('#pageForm').on('submit', function(e) {
        e.preventDefault();
        $('#page_builder_data').val(JSON.stringify(blocks));

        const form = $(this);
        const btn = form.find('button[type="submit"]');
        btn.attr('data-kt-indicator', 'on').prop('disabled', true);

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000
                    }).then(() => {
                        window.location = response.redirect || '{{ route("pages.index") }}';
                    });
                }
            },
            error: function(xhr) {
                btn.removeAttr('data-kt-indicator').prop('disabled', false);
                Swal.fire('Error', 'Gagal menyimpan halaman', 'error');
            }
        });
    });
});

function updateLayoutInfo() {
    currentLayout = $('input[name="layout"]:checked').val();
    const hasSidebar = currentLayout !== 'full';
    $('#sidebar-note').toggle(hasSidebar);
    renderBlocks();
}

function updateLayoutHighlight(input) {
    // Remove layout-active from all layout labels
    $('input[name="layout"]').closest('label').removeClass('layout-active');
    // Add to the selected one
    $(input).closest('label').addClass('layout-active');
    // Also update layout info
    updateLayoutInfo();
}

function toggleCustomColors() {
    const isChecked = $('input[name="block_custom_colors"]').is(':checked');
    $('#custom-colors-fields').toggle(isChecked);
}

function updateSectionIconPreview(input) {
    const iconClass = $(input).val() || 'fas fa-star';
    $('#section-icon-preview').html('<i class="' + iconClass + '"></i>');
}

function openEditBlockModal(type, index) {
    editingBlockIndex = index;
    currentBlockType = type; // Store the selected block type
    const isNewBlock = index === null;
    const block = isNewBlock ? { type: type, settings: {} } : blocks[index];

    $('#edit-block-type').text(blockTypeLabels[type]);
    $('#edit-block-content-form').html(blockContentForms[type]);

    // Init gallery items UI when editing gallery block
    if (type === 'gallery') {
        setTimeout(() => loadGalleryFromHidden(), 30);
    }

    // Hide placement for hero blocks OR when layout is full width (no sidebar)
    if (type === 'hero' || currentLayout === 'full') {
        $('#placement-settings').hide();
    } else {
        $('#placement-settings').show();
    }

    // Hide section header settings for CTA blocks
    if (type === 'cta') {
        $('#section-header-settings').hide();
    } else {
        $('#section-header-settings').show();
    }

    // Reset section fields for new blocks
    if (isNewBlock) {
        $('input[name="section_title"]').val('');
        $('input[name="section_subtitle"]').val('');
        $('input[name="section_icon"]').val('fas fa-star');
        $('#section-icon-preview').html('<i class="fas fa-star"></i>');
    }

    // Fill form if editing
    if (!isNewBlock) {
        fillEditForm(block);
    }

    $('#editBlockModal').modal('show');
    
    // Initialize Summernote for text blocks after modal is shown
    if (type === 'text') {
        setTimeout(function() {
            initTextEditor();
        }, 300);
    }
    
    // Initialize stats form
    if (type === 'stats') {
        setTimeout(function() {
            loadStatsFromHidden();
            initStatsDescriptionEditor();
        }, 100);
    }
}

function initStatsDescriptionEditor() {
    const $editor = $('#stats_description_editor');
    if ($editor.length && !$editor.hasClass('summernote-init')) {
        $editor.addClass('summernote-init').summernote({
            height: 120,
            toolbar: [
                ['font', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol']],
                ['insert', ['link']],
                ['view', ['codeview']]
            ],
            placeholder: 'Tulis deskripsi dengan format...'
        });
    }
}

function getStatsDescriptionContent() {
    const $editor = $('#stats_description_editor');
    if ($editor.hasClass('summernote-init')) {
        return $editor.summernote('code');
    }
    return $editor.val();
}

function fillEditForm(block) {
    const data = block.data || {};
    const settings = block.settings || {};

    // Fill content fields
    Object.keys(data).forEach(key => {
        const input = $(`[name="block_${key}"]`);
        if (input.length) {
            input.val(data[key]);
        }
    });

    // Fill settings
    if (settings.placement) {
        $(`input[name="block_placement"][value="${settings.placement}"]`).prop('checked', true);
    }
    if (settings.customColors) {
        $('input[name="block_custom_colors"]').prop('checked', true);
        toggleCustomColors();
        if (settings.bgColor) $('input[name="block_bg_color"]').val(settings.bgColor);
        if (settings.textColor) $('input[name="block_text_color"]').val(settings.textColor);
        if (settings.accentColor) $('input[name="block_accent_color"]').val(settings.accentColor);
    }
    if (settings.paddingY) $('select[name="block_padding_y"]').val(settings.paddingY);
    if (settings.paddingX) $('select[name="block_padding_x"]').val(settings.paddingX);
    if (settings.width) $('select[name="block_width"]').val(settings.width);

    // Load section header settings
    if (settings.sectionTitle) $('input[name="section_title"]').val(settings.sectionTitle);
    if (settings.sectionSubtitle) $('input[name="section_subtitle"]').val(settings.sectionSubtitle);
    if (settings.sectionIcon) {
        $('input[name="section_icon"]').val(settings.sectionIcon);
        $('#section-icon-preview').html('<i class="' + settings.sectionIcon + '" style="font-size:18px;color:#6366f1;"></i>');
    }
    
    // Load stats form if block type is stats
    if (block.type === 'stats' && data.stats) {
        $('#block_stats_hidden').val(data.stats);
        setTimeout(() => loadStatsFromHidden(), 50);
    }
    
    // Load gallery icon preview
    // Load gallery items
    if (block.type === 'gallery' && data.images) {
        $('#gallery_images_hidden').val(data.images);
        setTimeout(() => loadGalleryFromHidden(), 50);
    }
    
    // Load text block image preview
    if (block.type === 'text' && data.image) {
        setTimeout(() => {
            $('#text-image-preview img').attr('src', data.image);
            $('#text-image-preview').show();
        }, 50);
    }
}

function saveBlock() {
    // Use the stored currentBlockType instead of faulty logic
    const type = currentBlockType;

    // Get content from Summernote if it's a text block
    if (type === 'text' && $('textarea[name="block_content"]').hasClass('summernote')) {
        const content = $('textarea[name="block_content"]').summernote('code');
        $('textarea[name="block_content"]').val(content);
    }
    
    // Get description from Summernote if it's a stats block
    if (type === 'stats') {
        const descContent = getStatsDescriptionContent();
        $('textarea[name="block_description"]').val(descContent);
    }

    // Get content data
    const data = {};
    $('#edit-block-content-form').find('input, textarea, select').each(function() {
        const name = $(this).attr('name');
        if (name && name.startsWith('block_')) {
            const key = name.replace('block_', '');
            data[key] = $(this).val();
        }
    });

    // Get settings
    const settings = {
        placement: type === 'hero' ? 'main' : $('input[name="block_placement"]:checked').val(),
        customColors: $('input[name="block_custom_colors"]').is(':checked'),
        bgColor: $('input[name="block_bg_color"]').val(),
        textColor: $('input[name="block_text_color"]').val(),
        accentColor: $('input[name="block_accent_color"]').val(),
        paddingY: $('select[name="block_padding_y"]').val(),
        paddingX: $('select[name="block_padding_x"]').val(),
        width: $('select[name="block_width"]').val(),
        // Section header settings
        sectionTitle: $('input[name="section_title"]').val(),
        sectionSubtitle: $('input[name="section_subtitle"]').val(),
        sectionIcon: $('input[name="section_icon"]').val()
    };

    const block = {
        type: type,
        order: editingBlockIndex !== null ? blocks[editingBlockIndex].order : blocks.length,
        data: data,
        settings: settings
    };

    if (editingBlockIndex !== null) {
        blocks[editingBlockIndex] = block;
    } else {
        blocks.push(block);
    }

    renderBlocks();
    $('#editBlockModal').modal('hide');
}

function renderBlocks() {
    const container = $('#blocks-container');
    container.empty();

    if (blocks.length === 0) {
        container.html('<div class="text-center text-muted py-5"><i class="fas fa-inbox fs-2x mb-3"></i><div>Belum ada blok. Klik "Tambah Blok" untuk memulai.</div></div>');
        $('#block-count').text('0 blok');
        return;
    }

    blocks.forEach((block, index) => {
        const isSidebar = block.settings?.placement === 'sidebar';
        const placementBadge = block.type !== 'hero' ?
            `<span class="placement-badge placement-${block.settings?.placement || 'main'}">${isSidebar ? 'SIDEBAR' : 'MAIN'}</span>` : '';

        const preview = getBlockPreview(block);

        const html = `
            <div class="block-item ${isSidebar ? 'is-sidebar' : ''}" data-index="${index}">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div>
                        <span class="block-type-badge block-type-${block.type}">${blockTypeLabels[block.type]}</span>
                        ${placementBadge}
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-light-primary me-1" onclick="openEditBlockModal('${block.type}', ${index})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-light-warning me-1" onclick="duplicateBlock(${index})">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-light-danger" onclick="deleteBlock(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="text-muted small">${preview}</div>
            </div>
        `;
        container.append(html);
    });

    $('#block-count').text(`${blocks.length} blok`);
}

function getBlockPreview(block) {
    const data = block.data || {};
    switch(block.type) {
        case 'hero':
            return data.title || 'Hero banner';
        case 'text':
            const textPreview = (data.content || '').replace(/<[^>]*>/g, '').substring(0, 60);
            const hasImg = data.image && data.image_position !== 'none';
            return textPreview + '...' + (hasImg ? ` [📷 ${data.image_position || 'gambar'}]` : '');
        case 'gallery':
            const imageCount = (data.images || '').split('\n').filter(l => l.trim()).length;
            return `${imageCount} gambar`;
        case 'stats':
            const statsCount = (data.stats || '').split('\n').filter(l => l.trim()).length;
            return `${statsCount} statistik`;
        case 'cards':
            const cardsCount = (data.items || '').split('\n').filter(l => l.trim()).length;
            return `${cardsCount} cards`;
        case 'accordion':
            const accCount = (data.items || '').split('\n').filter(l => l.trim()).length;
            return `${accCount} items`;
        case 'tabs':
            const tabsCount = (data.items || '').split('\n').filter(l => l.trim()).length;
            return `${tabsCount} tabs`;
        case 'timeline':
            const tlCount = (data.items || '').split('\n').filter(l => l.trim()).length;
            return `${tlCount} events`;
        case 'table':
            const rowCount = (data.items || '').split('\n').filter(l => l.trim()).length;
            return `${rowCount} rows`;
        case 'quote':
            return `"${(data.content || '').substring(0, 50)}..." - ${data.author || 'Anonymous'}`;
        case 'video':
            return data.url ? 'Video embed' : 'No video URL';
        case 'slider':
            const slideCount = (data.items || '').split('\n').filter(l => l.trim()).length;
            return `${slideCount} slides`;
        case 'list':
            const listCount = (data.items || '').split('\n').filter(l => l.trim()).length;
            return `${listCount} items`;
        case 'steps':
            const stepsCount = (data.items || '').split('\n').filter(l => l.trim()).length;
            return `${stepsCount} steps`;
        case 'map':
            return data.url ? 'Google Maps' : 'No map URL';
        case 'divider':
            return `Style: ${data.style || 'line'}`;
        default:
            return 'Block content';
    }
}

function duplicateBlock(index) {
    const newBlock = JSON.parse(JSON.stringify(blocks[index]));
    newBlock.order = blocks.length;
    blocks.push(newBlock);
    renderBlocks();
    Swal.fire({
        icon: 'success',
        title: 'Block diduplikasi!',
        timer: 1500,
        showConfirmButton: false
    });
}

function deleteBlock(index) {
    Swal.fire({
        title: 'Hapus block?',
        text: 'Block akan dihapus permanen',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            blocks.splice(index, 1);
            renderBlocks();
        }
    });
}

function updateBlockOrder() {
    const items = $('#blocks-container').children();
    items.each(function(newIndex) {
        const oldIndex = $(this).data('index');
        blocks[oldIndex].order = newIndex;
    });
    blocks.sort((a, b) => a.order - b.order);
    renderBlocks();
}

// === MEDIA PICKER FUNCTIONS ===
let currentMediaTarget = null;
let selectedGalleryImages = []; // For multi-select gallery

function openMediaPicker(target) {
    currentMediaTarget = target;
    selectedGalleryImages = []; // Reset selection
    
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
                            <div class="d-flex align-items-center gap-2">
                                <span id="selectedCount" class="badge bg-primary" style="display: none;">0 dipilih</span>
                                <button type="button" class="btn btn-light-primary btn-sm" onclick="loadMediaItems()">
                                    <i class="fas fa-sync"></i> Refresh
                                </button>
                            </div>
                        </div>
                        <div id="galleryModeHint" class="alert alert-info py-2 mb-3" style="display: none;">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Mode Gallery:</strong> Klik gambar untuk memilih beberapa sekaligus. Klik tombol "Tambahkan" di bawah setelah selesai memilih.
                        </div>
                        <div id="mediaGridContainer" style="min-height: 300px; max-height: 60vh; overflow-y: auto;">
                            <div class="text-center py-5">
                                <div class="spinner-border text-primary" role="status"></div>
                                <p class="text-muted mt-2">Memuat gambar...</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="galleryFooter" style="display: none;">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="confirmGallerySelection()">
                            <i class="fas fa-check me-1"></i> Tambahkan <span id="addCount">0</span> Gambar
                        </button>
                    </div>
                </div>
            </div>
        </div>`;
        $('body').append(modalHtml);
    }
    
    // Show/hide gallery mode elements
    const isGallery = target === 'gallery';
    $('#galleryModeHint').toggle(isGallery);
    $('#galleryFooter').toggle(isGallery);
    $('#selectedCount').hide();
    
    $('#mediaPickerModal').modal('show');
    loadMediaItems();
}

function loadMediaItems(search = '') {
    $.get('/media/picker', { search: search }, function(response) {
        if (response.success && response.media.data.length > 0) {
            const isGallery = currentMediaTarget === 'gallery';
            let html = '<div class="row g-3">';
            response.media.data.forEach(item => {
                const isSelected = selectedGalleryImages.includes(item.large);
                const selectedStyle = isSelected ? 'border-color: #1e3a8a !important; box-shadow: 0 0 0 3px rgba(30,58,138,0.3);' : '';
                const checkIcon = isSelected ? '<div style="position:absolute;top:8px;right:8px;width:28px;height:28px;background:#1e3a8a;border-radius:50%;display:flex;align-items:center;justify-content:center;"><i class="fas fa-check text-white" style="font-size:14px;"></i></div>' : '';
                
                html += `
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="media-item" data-url="${item.large}" data-filename="${item.filename}" style="cursor: pointer; border: 2px solid #e5e7eb; border-radius: 12px; overflow: hidden; transition: all 0.2s; position: relative; ${selectedStyle}" 
                         onclick="selectMediaImage('${item.large}', '${item.filename}')">
                        ${checkIcon}
                        <img src="${item.thumb}" alt="${item.filename}" style="width: 100%; height: 150px; object-fit: cover;">
                        <div style="padding: 8px; background: ${isSelected ? '#dbeafe' : '#f8fafc'};">
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
    if (currentMediaTarget === 'gallery') {
        // Multi-select mode for gallery
        const index = selectedGalleryImages.indexOf(url);
        if (index > -1) {
            // Deselect
            selectedGalleryImages.splice(index, 1);
        } else {
            // Select
            selectedGalleryImages.push(url);
        }
        // Update UI
        updateGallerySelectionUI();
        // Re-render to show selection state
        loadMediaItems($('#mediaSearch').val());
    } else if (currentMediaTarget === 'image') {
        $('input[name="block_image"]').val(url);
        updateImagePreview(url);
        $('#mediaPickerModal').modal('hide');
        Swal.fire({
            icon: 'success',
            title: 'Gambar dipilih',
            text: filename,
            timer: 1500,
            showConfirmButton: false
        });
    } else if (currentMediaTarget === 'hero') {
        $('input[name="block_image"]').val(url);
        $('#mediaPickerModal').modal('hide');
        Swal.fire({
            icon: 'success',
            title: 'Gambar dipilih',
            text: filename,
            timer: 1500,
            showConfirmButton: false
        });
    } else if (currentMediaTarget === 'quote') {
        $('input[name="block_image"]').val(url);
        $('#mediaPickerModal').modal('hide');
        Swal.fire({
            icon: 'success',
            title: 'Foto dipilih',
            text: filename,
            timer: 1500,
            showConfirmButton: false
        });
    } else if (currentMediaTarget === 'text') {
        $('input[name="block_image"]').val(url);
        $('#text-image-preview img').attr('src', url);
        $('#text-image-preview').show();
        $('select[name="block_image_position"]').val('left');
        $('#mediaPickerModal').modal('hide');
        Swal.fire({
            icon: 'success',
            title: 'Gambar dipilih',
            text: filename,
            timer: 1500,
            showConfirmButton: false
        });
    } else if (currentMediaTarget === 'gallery-item') {
        const item = document.getElementById('gallery-item-' + currentGalleryItemId);
        if (item) {
            item.querySelector('.gallery-url').value = url;
            item.querySelector('.gallery-item-thumb').innerHTML = `<img src="${url}" style="width: 100%; height: 100%; object-fit: cover;">`;
            updateGalleryHidden();
        }
        $('#mediaPickerModal').modal('hide');
    }
}

function clearTextImage() {
    $('input[name="block_image"]').val('');
    $('#text-image-preview').hide();
    $('select[name="block_image_position"]').val('none');
}

function updateGallerySelectionUI() {
    const count = selectedGalleryImages.length;
    $('#selectedCount').text(count + ' dipilih').toggle(count > 0);
    $('#addCount').text(count);
}

function confirmGallerySelection() {
    if (selectedGalleryImages.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Belum ada gambar dipilih',
            text: 'Klik gambar untuk memilih',
            timer: 2000,
            showConfirmButton: false
        });
        return;
    }
    
    const textarea = $('textarea[name="block_images"]');
    const currentVal = textarea.val();
    const newImages = selectedGalleryImages.join('\n');
    textarea.val(currentVal + (currentVal ? '\n' : '') + newImages);
    
    $('#mediaPickerModal').modal('hide');
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: selectedGalleryImages.length + ' gambar ditambahkan ke gallery',
        timer: 2000,
        showConfirmButton: false
    });
    
    selectedGalleryImages = [];
}

function clearGalleryImages() {
    $('#gallery-items-container').empty();
    updateGalleryHidden();
}

// === GALLERY ITEM FUNCTIONS ===
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

let currentGalleryItemId = null;

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
            // Legacy format: just URL
            addGalleryItem(line, '', '');
        }
    });
}

// === STATS FORM FUNCTIONS ===
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

// Auto load stats when block type changes to stats
$(document).on('change', '#blockTypeSelect', function() {
    setTimeout(() => {
        if ($(this).val() === 'stats') {
            loadStatsFromHidden();
        }
    }, 100);
});

function updateGalleryPreview() {
    const images = $('textarea[name="block_images"]').val().split('\n').filter(url => url.trim());
    if (images.length > 0) {
        let html = '';
        images.forEach((url, index) => {
            html += `<div style="position:relative;">
                <img src="${url}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;border:2px solid #e5e7eb;">
                <button type="button" onclick="removeGalleryImage(${index})" style="position:absolute;top:-8px;right:-8px;width:20px;height:20px;background:#ef4444;border:none;border-radius:50%;color:white;font-size:10px;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-times"></i>
                </button>
            </div>`;
        });
        $('#gallery-preview').html(html);
        $('#gallery-preview-container').show();
    } else {
        $('#gallery-preview-container').hide();
    }
}

function removeGalleryImage(index) {
    const textarea = $('textarea[name="block_images"]');
    const images = textarea.val().split('\n').filter(url => url.trim());
    images.splice(index, 1);
    textarea.val(images.join('\n'));
    updateGalleryPreview();
}

// === ICON PICKER FUNCTIONS ===
let currentIconTarget = null;

const availableIcons = [
    // Gallery & Media
    { icon: 'fas fa-images', label: 'Galeri' },
    { icon: 'fas fa-photo-video', label: 'Foto & Video' },
    { icon: 'fas fa-camera', label: 'Kamera' },
    { icon: 'fas fa-camera-retro', label: 'Kamera Retro' },
    { icon: 'fas fa-film', label: 'Film' },
    { icon: 'fas fa-video', label: 'Video' },
    { icon: 'fas fa-play-circle', label: 'Play' },
    
    // Events & Activities
    { icon: 'fas fa-calendar-alt', label: 'Kalender' },
    { icon: 'fas fa-calendar-check', label: 'Event' },
    { icon: 'fas fa-users', label: 'Orang-orang' },
    { icon: 'fas fa-user-friends', label: 'Teman' },
    { icon: 'fas fa-people-carry', label: 'Kegiatan' },
    { icon: 'fas fa-hands-helping', label: 'Kolaborasi' },
    
    // Education
    { icon: 'fas fa-graduation-cap', label: 'Wisuda' },
    { icon: 'fas fa-university', label: 'Kampus' },
    { icon: 'fas fa-book-open', label: 'Buku' },
    { icon: 'fas fa-chalkboard-teacher', label: 'Mengajar' },
    { icon: 'fas fa-user-graduate', label: 'Mahasiswa' },
    { icon: 'fas fa-school', label: 'Sekolah' },
    
    // Achievement
    { icon: 'fas fa-trophy', label: 'Piala' },
    { icon: 'fas fa-medal', label: 'Medali' },
    { icon: 'fas fa-award', label: 'Penghargaan' },
    { icon: 'fas fa-certificate', label: 'Sertifikat' },
    { icon: 'fas fa-star', label: 'Bintang' },
    { icon: 'fas fa-crown', label: 'Mahkota' },
    
    // Business & Work
    { icon: 'fas fa-briefcase', label: 'Bisnis' },
    { icon: 'fas fa-building', label: 'Gedung' },
    { icon: 'fas fa-city', label: 'Kota' },
    { icon: 'fas fa-landmark', label: 'Landmark' },
    { icon: 'fas fa-handshake', label: 'Kerjasama' },
    { icon: 'fas fa-chart-line', label: 'Grafik' },
    
    // Nature & Travel
    { icon: 'fas fa-globe-asia', label: 'Globe' },
    { icon: 'fas fa-map-marked-alt', label: 'Peta' },
    { icon: 'fas fa-mountain', label: 'Gunung' },
    { icon: 'fas fa-tree', label: 'Pohon' },
    { icon: 'fas fa-leaf', label: 'Daun' },
    { icon: 'fas fa-sun', label: 'Matahari' },
    
    // Sports & Health
    { icon: 'fas fa-futbol', label: 'Bola' },
    { icon: 'fas fa-running', label: 'Lari' },
    { icon: 'fas fa-dumbbell', label: 'Fitness' },
    { icon: 'fas fa-heartbeat', label: 'Kesehatan' },
    { icon: 'fas fa-basketball-ball', label: 'Basket' },
    { icon: 'fas fa-volleyball-ball', label: 'Voli' },
    
    // Technology
    { icon: 'fas fa-laptop-code', label: 'Coding' },
    { icon: 'fas fa-robot', label: 'Robot' },
    { icon: 'fas fa-microchip', label: 'Teknologi' },
    { icon: 'fas fa-rocket', label: 'Roket' },
    { icon: 'fas fa-lightbulb', label: 'Ide' },
    { icon: 'fas fa-cogs', label: 'Setting' },
    
    // Communication
    { icon: 'fas fa-comments', label: 'Chat' },
    { icon: 'fas fa-bullhorn', label: 'Pengumuman' },
    { icon: 'fas fa-newspaper', label: 'Berita' },
    { icon: 'fas fa-envelope-open-text', label: 'Pesan' },
    { icon: 'fas fa-share-alt', label: 'Share' },
    { icon: 'fas fa-rss', label: 'Feed' },
    
    // Misc
    { icon: 'fas fa-heart', label: 'Hati' },
    { icon: 'fas fa-thumbs-up', label: 'Like' },
    { icon: 'fas fa-gift', label: 'Hadiah' },
    { icon: 'fas fa-magic', label: 'Magic' },
    { icon: 'fas fa-palette', label: 'Seni' },
    { icon: 'fas fa-music', label: 'Musik' },
    { icon: 'fas fa-utensils', label: 'Kuliner' },
    { icon: 'fas fa-coffee', label: 'Kopi' },
    { icon: 'fas fa-home', label: 'Rumah' },
    { icon: 'fas fa-flag', label: 'Bendera' },
    { icon: 'fas fa-gem', label: 'Permata' },
    { icon: 'fas fa-fire', label: 'Api' }
];

function openIconPicker(target) {
    currentIconTarget = target;
    
    if (!$('#iconPickerModal').length) {
        let iconsHtml = '';
        availableIcons.forEach(item => {
            iconsHtml += `
                <div class="icon-option" data-icon="${item.icon}" onclick="selectIcon('${item.icon}')" 
                     style="cursor:pointer;padding:12px;border:2px solid #e5e7eb;border-radius:12px;text-align:center;transition:all 0.2s;">
                    <i class="${item.icon}" style="font-size:24px;color:#1e3a8a;display:block;margin-bottom:6px;"></i>
                    <small style="color:#6b7280;font-size:11px;">${item.label}</small>
                </div>
            `;
        });
        
        const modalHtml = `
        <div class="modal fade" id="iconPickerModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white"><i class="fas fa-icons me-2"></i>Pilih Icon</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="iconSearch" placeholder="Cari icon..." onkeyup="filterIcons()">
                        </div>
                        <div id="iconGrid" style="display:grid;grid-template-columns:repeat(6,1fr);gap:10px;max-height:400px;overflow-y:auto;">
                            ${iconsHtml}
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        $('body').append(modalHtml);
        
        // Add hover effect
        $(document).on('mouseenter', '.icon-option', function() {
            $(this).css({'border-color': '#1e3a8a', 'background': '#f0f9ff', 'transform': 'scale(1.05)'});
        }).on('mouseleave', '.icon-option', function() {
            if (!$(this).hasClass('selected')) {
                $(this).css({'border-color': '#e5e7eb', 'background': 'transparent', 'transform': 'scale(1)'});
            }
        });
    }
    
    $('#iconPickerModal').modal('show');
}

function filterIcons() {
    const search = $('#iconSearch').val().toLowerCase();
    $('.icon-option').each(function() {
        const label = $(this).find('small').text().toLowerCase();
        const icon = $(this).data('icon').toLowerCase();
        $(this).toggle(label.includes(search) || icon.includes(search));
    });
}

function selectIcon(iconClass) {
    if (currentIconTarget === 'gallery') {
        $('input[name="block_icon"]').val(iconClass);
        $('#gallery-icon-preview').html(`<i class="${iconClass}" style="font-size:24px;color:#1e3a8a;"></i>`);
    } else if (currentIconTarget === 'section') {
        $('input[name="section_icon"]').val(iconClass);
        $('#section-icon-preview').html(`<i class="${iconClass}" style="font-size:18px;color:#6366f1;"></i>`);
    }
    
    $('#iconPickerModal').modal('hide');
    Swal.fire({
        icon: 'success',
        title: 'Icon dipilih',
        timer: 1000,
        showConfirmButton: false
    });
}

// Update gallery preview when textarea changes
$(document).on('input', 'textarea[name="block_images"]', function() {
    updateGalleryPreview();
});

function updateImagePreview(url) {
    if (url) {
        $('#image-preview').attr('src', url);
        $('#image-preview-container').show();
    } else {
        $('#image-preview-container').hide();
    }
}

$(document).on('input', 'input[name="block_image"]', function() {
    const url = $(this).val();
    if (url && (url.startsWith('http') || url.startsWith('/'))) {
        updateImagePreview(url);
    }
});

$(document).on('input', '#mediaSearch', function() {
    const search = $(this).val();
    clearTimeout(window.mediaSearchTimer);
    window.mediaSearchTimer = setTimeout(() => loadMediaItems(search), 300);
});
</script>
@endpush
