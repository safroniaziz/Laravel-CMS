@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Page')
@section('menu', 'Pages')

@php
    $existingBlocks = $page->page_builder_data ?? [];
@endphp

@section('link')
    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted"><a href="{{ route('pages.index') }}" class="text-muted text-hover-primary">Pages</a></li>
    <li class="breadcrumb-item text-gray-700">Edit: {{ Str::limit($page->title, 30) }}</li>
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
.block-type-quote { background: #fef3c7; color: #92400e; }
.block-type-video { background: #fee2e2; color: #991b1b; }
.block-type-slider { background: #d1fae5; color: #065f46; }
.block-type-list { background: #dbeafe; color: #1e40af; }
.block-type-steps { background: #ede9fe; color: #5b21b6; }
.block-type-map { background: #ccfbf1; color: #0f766e; }
.block-type-divider { background: #f3f4f6; color: #6b7280; }
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

        <form id="pageForm" method="POST" action="{{ route('pages.update', $page) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="page_builder_data" id="page_builder_data" value="">

            <div class="row g-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Basic Info -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">📝 Informasi Halaman</h3>
                            <div class="card-toolbar">
                                <a href="/{{ $page->slug }}" target="_blank" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-eye me-1"></i> Preview
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-5">
                                    <label class="form-label required">Judul Halaman</label>
                                    <input type="text" name="title" id="title" class="form-control form-control-lg" value="{{ $page->title }}" required />
                                </div>
                                <div class="col-md-4 mb-5">
                                    <label class="form-label">Slug URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text">/</span>
                                        <input type="text" name="slug" id="slug" class="form-control" value="{{ $page->slug }}" />
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
                                <span class="badge badge-light-primary me-2" id="section-count">0 section</span>
                                <span class="badge badge-light-info me-2" id="block-count">0 blok</span>
                                <span class="badge badge-light-warning" id="sidebar-note" style="display:none;">Sidebar aktif</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info d-flex align-items-center mb-4">
                                <i class="fas fa-info-circle me-3 fs-2"></i>
                                <div>
                                    <strong>Tips:</strong> Buat Section terlebih dahulu, kemudian tambahkan block di dalam section. CTA bisa ditambahkan langsung tanpa section.
                                </div>
                            </div>

                            <!-- Sections Container -->
                            <div id="sections-container" class="mb-4">
                                <!-- Sections will be rendered here -->
                            </div>

                            <!-- Standalone CTA Blocks -->
                            <div id="standalone-blocks-container" class="mb-4">
                                <!-- Standalone CTA blocks will be rendered here -->
                            </div>
                            
                            <!-- Sidebar Blocks Container -->
                            <div id="sidebar-blocks-container" class="mb-4" style="display:none;">
                                <!-- Sidebar blocks will be rendered here -->
                            </div>

                            <!-- Add Section / CTA Buttons -->
                            <div class="d-flex gap-3 justify-content-center">
                                <div class="add-block-btn" onclick="openAddSectionModal()">
                                    <i class="fas fa-folder-plus text-primary fs-2"></i>
                                    <div class="mt-2 fw-bold text-gray-700">Tambah Section</div>
                                </div>
                                <div class="add-block-btn" onclick="openEditBlockModal('cta', null, true)">
                                    <i class="fas fa-bullhorn text-success fs-2"></i>
                                    <div class="mt-2 fw-bold text-gray-700">Tambah CTA</div>
                                </div>
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
                                    <option value="draft" {{ $page->status === 'draft' ? 'selected' : '' }}>📝 Draft</option>
                                    <option value="published" {{ $page->status === 'published' ? 'selected' : '' }}>✅ Published</option>
                                </select>
                            </div>

                            <div class="mb-0">
                                <label class="form-label required">Layout Halaman</label>
                                <p class="text-muted small mb-3">Pilih layout yang sesuai dengan kebutuhan halaman</p>
                                <div class="d-grid gap-2">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-4 text-start {{ ($page->layout ?? 'full') === 'full' ? 'layout-active' : '' }}">
                                        <input type="radio" name="layout" value="full" class="btn-check" {{ ($page->layout ?? 'full') === 'full' ? 'checked' : '' }} onchange="updateLayoutHighlight(this)">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-arrows-alt-h fs-2x text-primary me-4"></i>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-gray-800">Full Width</div>
                                                <div class="text-muted fs-7">Semua block full-width, tanpa sidebar</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-4 text-start {{ ($page->layout ?? '') === 'sidebar-right' ? 'layout-active' : '' }}">
                                        <input type="radio" name="layout" value="sidebar-right" class="btn-check" {{ ($page->layout ?? '') === 'sidebar-right' ? 'checked' : '' }} onchange="updateLayoutHighlight(this)">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-th-large fs-2x text-primary me-4"></i>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-gray-800">Sidebar Kanan</div>
                                                <div class="text-muted fs-7">Konten utama di kiri, sidebar di kanan</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-4 text-start {{ ($page->layout ?? '') === 'sidebar-left' ? 'layout-active' : '' }}">
                                        <input type="radio" name="layout" value="sidebar-left" class="btn-check" {{ ($page->layout ?? '') === 'sidebar-left' ? 'checked' : '' }} onchange="updateLayoutHighlight(this)">
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
                        <div class="card-footer d-flex justify-content-between py-4">
                            <button type="button" class="btn btn-light-danger" onclick="deletePage()">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                            <div>
                                <a href="{{ route('pages.index') }}" class="btn btn-light me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label"><i class="fas fa-save me-1"></i> Update</span>
                                    <span class="indicator-progress">Menyimpan...<span class="spinner-border spinner-border-sm ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Page Settings -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">🎨 Warna Global</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-4">Warna default untuk semua block (bisa di-override per block)</p>
                            <div class="mb-4">
                                <label class="form-label">Background</label>
                                <input type="color" name="bg_color" value="{{ $page->bg_color ?? '#ffffff' }}" class="form-control form-control-color w-100" style="height: 40px;">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Teks</label>
                                <input type="color" name="text_color" value="{{ $page->text_color ?? '#333333' }}" class="form-control form-control-color w-100" style="height: 40px;">
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Aksen</label>
                                <input type="color" name="accent_color" value="{{ $page->accent_color ?? '#1e3a8a' }}" class="form-control form-control-color w-100" style="height: 40px;">
                            </div>
                        </div>
                    </div>

                    <!-- Page Info -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ℹ️ Informasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Dibuat oleh</span>
                                <span class="fw-bold">{{ $page->user->name ?? 'Unknown' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Dibuat</span>
                                <span>{{ $page->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Terakhir update</span>
                                <span>{{ $page->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- Add Section Modal -->
<div class="modal fade" id="addSectionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="fas fa-folder-plus me-2"></i>Tambah Section</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4">Section adalah container untuk mengelompokkan beberapa block dengan header yang sama.</p>
                <div class="mb-4">
                    <label class="form-label fw-bold">Judul Section <span class="text-danger">*</span></label>
                    <input type="text" name="section_title_input" class="form-control form-control-lg" placeholder="Contoh: Tentang Kami">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Subtitle (opsional)</label>
                    <input type="text" name="section_subtitle_input" class="form-control" placeholder="Deskripsi singkat section...">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-bold">Icon</label>
                    <input type="hidden" name="section_icon_input" value="fas fa-star">
                    <div class="d-flex align-items-center gap-2">
                        <div id="section-modal-icon-preview" style="width:48px;height:48px;background:#f3f4f6;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-star" style="font-size:20px;color:#6366f1;"></i>
                        </div>
                        <button type="button" class="btn btn-light-primary btn-sm" onclick="openIconPicker('section-modal')">
                            <i class="fas fa-icons me-1"></i> Pilih Icon
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveSection()">
                    <i class="fas fa-check me-1"></i>Simpan Section
                </button>
            </div>
        </div>
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
                    <div class="col-md-7">
                        <h6 class="fw-bold text-gray-800 mb-4">📝 Konten Block</h6>
                        <div id="edit-block-content-form"></div>
                    </div>
                    <div class="col-md-5">
                        <h6 class="fw-bold text-gray-800 mb-4">⚙️ Pengaturan Block</h6>

                        <div class="settings-group" id="placement-settings">
                            <div class="settings-group-title">📍 Penempatan</div>
                            <div class="d-grid gap-2">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-3 text-start">
                                    <input type="radio" name="block_placement" value="main" class="btn-check" checked>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-expand fs-3 text-primary me-3"></i>
                                        <div>
                                            <div class="fw-bold">Konten Utama</div>
                                            <small class="text-muted">Block di area utama</small>
                                        </div>
                                    </div>
                                </label>
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-warning p-3 text-start">
                                    <input type="radio" name="block_placement" value="sidebar" class="btn-check">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-sidebar fs-3 text-warning me-3"></i>
                                        <div>
                                            <div class="fw-bold">Sidebar</div>
                                            <small class="text-muted">Block di sidebar</small>
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
    // Destroy existing instance if any
    if ($('textarea[name="block_content"]').hasClass('summernote')) {
        $('textarea[name="block_content"]').summernote('destroy');
    }
    
    // Initialize Summernote
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

// Sections-based data structure
let pageData = {
    sections: [],       // Main content sections with blocks inside
    standaloneBlocks: [], // CTA blocks without section
    sidebarBlocks: []   // Sidebar blocks
};

// Legacy blocks array for backward compatibility
let blocks = [];

// Convert existing flat blocks to new structure (migration support)
let existingBlocks = {!! json_encode($existingBlocks) !!};
if (existingBlocks && existingBlocks.length > 0) {
    // Group blocks into sections or standalone
    existingBlocks.forEach(block => {
        if (block.settings && block.settings.placement === 'sidebar') {
            pageData.sidebarBlocks.push(block);
        } else if (block.type === 'cta') {
            pageData.standaloneBlocks.push(block);
        } else {
            // For old blocks without section, create a section with the block's section header
            let sectionTitle = block.settings?.sectionTitle || '';
            let sectionSubtitle = block.settings?.sectionSubtitle || '';
            let sectionIcon = block.settings?.sectionIcon || 'fas fa-star';
            
            if (sectionTitle) {
                // Find existing section with same title or create new
                let existingSection = pageData.sections.find(s => s.title === sectionTitle);
                if (existingSection) {
                    existingSection.blocks.push(block);
                } else {
                    pageData.sections.push({
                        id: 'section-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9),
                        title: sectionTitle,
                        subtitle: sectionSubtitle,
                        icon: sectionIcon,
                        order: pageData.sections.length,
                        blocks: [block]
                    });
                }
            } else {
                // Block without section - create unnamed section
                pageData.sections.push({
                    id: 'section-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9),
                    title: 'Section ' + (pageData.sections.length + 1),
                    subtitle: '',
                    icon: 'fas fa-star',
                    order: pageData.sections.length,
                    blocks: [block]
                });
            }
        }
    });
}

// Editing state
let editingSectionIndex = null;
let editingBlockIndex = null;
let currentBlockType = null;
let currentSectionIndex = null; // Which section we're adding block to
let currentLayout = '{{ $page->layout ?? "full" }}';

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
    divider: '➖ Divider',
    cta: '📢 Call to Action'
};

// Include all blockContentForms from create.blade.php
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
        <div class="mb-4">
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>Accordion Items</span>
                <button type="button" class="btn btn-primary btn-sm" onclick="addAccordionItem()">
                    <i class="fas fa-plus me-1"></i> Tambah Item
                </button>
            </label>
            <div id="accordion-items-container"></div>
            <input type="hidden" name="block_items" id="accordion_items_hidden">
        </div>
    `,
    tabs: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Informasi Lengkap...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>Tab Items</span>
                <button type="button" class="btn btn-primary btn-sm" onclick="addTabItem()">
                    <i class="fas fa-plus me-1"></i> Tambah Tab
                </button>
            </label>
            <div id="tabs-items-container"></div>
            <input type="hidden" name="block_items" id="tabs_items_hidden">
        </div>
    `,
    timeline: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Perjalanan Kami...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>Timeline Items</span>
                <button type="button" class="btn btn-primary btn-sm" onclick="addTimelineItem()">
                    <i class="fas fa-plus me-1"></i> Tambah Event
                </button>
            </label>
            <div id="timeline-items-container"></div>
            <input type="hidden" name="block_items" id="timeline_items_hidden">
        </div>
    `,
    table: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Daftar Harga...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>Kolom Header</span>
                <button type="button" class="btn btn-light-primary btn-sm" onclick="addTableColumn()">
                    <i class="fas fa-plus me-1"></i> Tambah Kolom
                </button>
            </label>
            <div id="table-headers-container" class="d-flex flex-wrap gap-2 mb-2"></div>
            <input type="hidden" name="block_headers" id="table_headers_hidden">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>Data Baris</span>
                <button type="button" class="btn btn-primary btn-sm" onclick="addTableRow()">
                    <i class="fas fa-plus me-1"></i> Tambah Baris
                </button>
            </label>
            <div id="table-rows-container"></div>
            <input type="hidden" name="block_items" id="table_items_hidden">
        </div>
        <div class="row">
            <div class="col-md-6 mb-0">
                <label class="form-label fw-bold">Tampilkan Search</label>
                <select name="block_searchable" class="form-select">
                    <option value="true">Ya</option>
                    <option value="false">Tidak</option>
                </select>
            </div>
            <div class="col-md-6 mb-0">
                <label class="form-label fw-bold">Baris per Halaman</label>
                <select name="block_per_page" class="form-select">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="0">Semua (tanpa pagination)</option>
                </select>
            </div>
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
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>Slider Items</span>
                <button type="button" class="btn btn-primary btn-sm" onclick="addSliderItem()">
                    <i class="fas fa-plus me-1"></i> Tambah Slide
                </button>
            </label>
            <div id="slider-items-container"></div>
            <input type="hidden" name="block_items" id="slider_items_hidden">
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">Ukuran Slider</label>
                <input type="hidden" name="block_size" id="slider_size_value" value="medium">
                <select class="form-select" id="slider_size_select">
                    <option value="small">Kecil (600px)</option>
                    <option value="medium" selected>Sedang (800px)</option>
                    <option value="large">Lebar (1000px)</option>
                    <option value="full">Full Width (100%)</option>
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">Tinggi Gambar</label>
                <input type="hidden" name="block_height" id="slider_height_value" value="500">
                <select class="form-select" id="slider_height_select">
                    <option value="300">Pendek (300px)</option>
                    <option value="400">Sedang (400px)</option>
                    <option value="500" selected>Tinggi (500px)</option>
                    <option value="600">Sangat Tinggi (600px)</option>
                </select>
            </div>
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
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>List Items</span>
                <button type="button" class="btn btn-primary btn-sm" onclick="addListItem()">
                    <i class="fas fa-plus me-1"></i> Tambah Item
                </button>
            </label>
            <div id="list-items-container"></div>
            <input type="hidden" name="block_items" id="list_items_hidden">
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
        <div class="mb-4">
            <label class="form-label fw-bold d-flex justify-content-between align-items-center">
                <span>Steps Items</span>
                <button type="button" class="btn btn-primary btn-sm" onclick="addStepItem()">
                    <i class="fas fa-plus me-1"></i> Tambah Step
                </button>
            </label>
            <div id="steps-items-container"></div>
            <input type="hidden" name="block_items" id="steps_items_hidden">
        </div>
    `,
    map: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul Section (opsional)</label>
            <input type="text" name="block_title" class="form-control" placeholder="Lokasi Kami...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Google Maps Embed Code</label>
            <textarea name="block_embed" class="form-control" rows="4" placeholder="Paste kode embed dari Google Maps di sini...&#10;&#10;Cara: Buka Google Maps → Klik Share → Embed a map → Copy HTML"></textarea>
            <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle text-primary me-1"></i>Paste seluruh kode <code>&lt;iframe&gt;...&lt;/iframe&gt;</code> dari Google Maps</small>
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
            <select name="block_style" class="form-select" onchange="toggleDividerIcon(this.value)">
                <option value="line">Garis</option>
                <option value="dots">Titik-titik</option>
                <option value="icon">Dengan Icon</option>
                <option value="space">Spasi Saja</option>
            </select>
        </div>
        <div class="mb-4" id="divider-icon-group">
            <label class="form-label fw-bold">Icon</label>
            <input type="hidden" name="block_icon" id="divider_icon_value" value="fas fa-star">
            <div class="d-flex align-items-center gap-2">
                <div id="divider-icon-preview" style="width:48px;height:48px;background:#f3f4f6;border-radius:10px;display:flex;align-items:center;justify-content:center;border:1px solid #e5e7eb;">
                    <i class="fas fa-star" style="font-size:20px;color:#6366f1;"></i>
                </div>
                <button type="button" class="btn btn-light-primary btn-sm" onclick="openIconPicker('divider')">
                    <i class="fas fa-icons me-1"></i> Pilih Icon
                </button>
            </div>
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
    `,
    cta: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul CTA</label>
            <input type="text" name="block_title" class="form-control form-control-lg" placeholder="Siap untuk Bergabung?">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Subtitle (opsional)</label>
            <input type="text" name="block_subtitle" class="form-control" placeholder="Daftar sekarang dan dapatkan...">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Deskripsi (opsional)</label>
            <textarea name="block_description" class="form-control" rows="2" placeholder="Penjelasan singkat..."></textarea>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Icon</label>
            <input type="hidden" name="block_icon" id="cta_icon_value" value="fas fa-rocket">
            <div class="d-flex align-items-center gap-2">
                <div id="cta-icon-preview" style="width:48px;height:48px;background:#f3f4f6;border-radius:10px;display:flex;align-items:center;justify-content:center;border:1px solid #e5e7eb;">
                    <i class="fas fa-rocket" style="font-size:20px;color:#6366f1;"></i>
                </div>
                <button type="button" class="btn btn-light-primary btn-sm" onclick="openIconPicker('cta')">
                    <i class="fas fa-icons me-1"></i> Pilih Icon
                </button>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Teks Tombol 1</label>
                <input type="text" name="block_btn1_text" class="form-control" placeholder="Daftar Sekarang">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Link Tombol 1</label>
                <input type="text" name="block_btn1_link" class="form-control" placeholder="/pendaftaran">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Teks Tombol 2 (opsional)</label>
                <input type="text" name="block_btn2_text" class="form-control" placeholder="Pelajari Lebih Lanjut">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Link Tombol 2</label>
                <input type="text" name="block_btn2_link" class="form-control" placeholder="/tentang-kami">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Warna Background</label>
                <input type="color" name="block_bg_color" id="cta_bg_color" class="form-control form-control-color w-100" value="#1e3a8a">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Warna Teks</label>
                <input type="color" name="block_text_color" id="cta_text_color" class="form-control form-control-color w-100" value="#ffffff">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Warna Tombol</label>
                <input type="color" name="block_btn_color" id="cta_btn_color" class="form-control form-control-color w-100" value="#f97316">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Layout</label>
                <select name="block_layout" class="form-select">
                    <option value="center">Tengah</option>
                    <option value="left">Kiri</option>
                    <option value="split">Split (Teks Kiri, Tombol Kanan)</option>
                </select>
            </div>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Style</label>
            <select name="block_style" class="form-select">
                <option value="solid">Solid Color</option>
                <option value="gradient">Gradient</option>
                <option value="outline">Outline / Border</option>
            </select>
        </div>
    `
};

$(document).ready(function() {
    // Event delegation for slider selects (fix template literal issue)
    $(document).on('change', '#slider_size_select', function() {
        $('#slider_size_value').val($(this).val());
        console.log('Size changed to:', $(this).val());
    });
    $(document).on('change', '#slider_height_select', function() {
        $('#slider_height_value').val($(this).val());
        console.log('Height changed to:', $(this).val());
    });
    
    // Initialize with existing sections
    renderSections();
    renderStandaloneBlocks();
    renderSidebarBlocks();
    updateLayoutInfo();
    updateCounts();

    // Initialize Sortable for sections
    new Sortable(document.getElementById('sections-container'), {
        animation: 150,
        handle: '.section-header-drag',
        onEnd: function() {
            updateSectionOrder();
        }
    });

    $('.block-type-option').on('click', function() {
        const type = $(this).data('type');
        $('#addBlockModal').modal('hide');
        setTimeout(() => openEditBlockModal(type, null, false), 300);
    });

    $('#save-block-btn').on('click', function() {
        saveBlock();
    });

    $('#pageForm').on('submit', function(e) {
        e.preventDefault();
        // Convert sections-based data back to flat blocks array for backend
        let allBlocks = [];
        pageData.sections.forEach((section, sIndex) => {
            section.blocks.forEach((block, bIndex) => {
                block.settings = block.settings || {};
                block.settings.sectionTitle = section.title;
                block.settings.sectionSubtitle = section.subtitle;
                block.settings.sectionIcon = section.icon;
                block.settings.sectionOrder = sIndex;
                block.order = bIndex;
                allBlocks.push(block);
            });
        });
        pageData.standaloneBlocks.forEach((block, index) => {
            block.settings = block.settings || {};
            block.settings.placement = 'main';
            block.order = allBlocks.length + index;
            allBlocks.push(block);
        });
        pageData.sidebarBlocks.forEach((block, index) => {
            block.settings = block.settings || {};
            block.settings.placement = 'sidebar';
            block.order = allBlocks.length + index;
            allBlocks.push(block);
        });
        $('#page_builder_data').val(JSON.stringify(allBlocks));

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
                        window.location.reload();
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

function deletePage() {
    Swal.fire({
        title: 'Hapus halaman?',
        text: 'Tindakan ini tidak dapat dibatalkan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("pages.destroy", $page) }}',
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Terhapus!', response.message, 'success').then(() => {
                            window.location = '{{ route("pages.index") }}';
                        });
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Gagal menghapus halaman', 'error');
                }
            });
        }
    });
}

function updateLayoutInfo() {
    currentLayout = $('input[name="layout"]:checked').val();
    const hasSidebar = currentLayout !== 'full';
    $('#sidebar-note').toggle(hasSidebar);
    renderSections();
    renderStandaloneBlocks();
    renderSidebarBlocks();
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

function openEditBlockModal(type, index, isStandalone = false, sectionIndex = null) {
    editingBlockIndex = index;
    currentBlockType = type;
    
    // Track where this block belongs
    if (isStandalone) {
        currentSectionIndex = 'standalone'; // Mark as standalone CTA
    } else if (sectionIndex !== null) {
        currentSectionIndex = sectionIndex; // Existing block in specific section
    }
    // If currentSectionIndex is already set (from openAddBlockToSection), keep it
    
    const isNewBlock = index === null;
    let block;
    
    if (isNewBlock) {
        block = { type: type, settings: {} };
    } else if (isStandalone) {
        block = pageData.standaloneBlocks[index];
    } else if (sectionIndex !== null) {
        block = pageData.sections[sectionIndex].blocks[index];
    } else {
        block = { type: type, settings: {} };
    }

    $('#edit-block-type').text(blockTypeLabels[type]);
    $('#edit-block-content-form').html(blockContentForms[type]);

    // Init gallery items UI when editing gallery block
    if (type === 'gallery') {
        setTimeout(() => loadGalleryFromHidden(), 30);
    }

    // Show placement settings only if layout has sidebar
    const currentLayout = $('input[name="layout"]:checked').val();
    if (currentLayout === 'sidebar-left' || currentLayout === 'sidebar-right') {
        $('#placement-settings').show();
    } else {
        $('#placement-settings').hide();
    }
    
    // Hide section header settings (now handled at section level)
    $('#section-header-settings').hide();

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
    
    // Initialize accordion form
    if (type === 'accordion') {
        setTimeout(function() {
            loadAccordionFromHidden();
        }, 100);
    }
    
    // Initialize tabs form
    if (type === 'tabs') {
        setTimeout(function() {
            loadTabsFromHidden();
        }, 100);
    }
    
    // Initialize timeline form
    if (type === 'timeline') {
        setTimeout(function() {
            loadTimelineFromHidden();
        }, 100);
    }
    
    // Initialize table form
    if (type === 'table') {
        setTimeout(function() {
            loadTableFromHidden();
        }, 100);
    }
    
    // Initialize slider form
    if (type === 'slider') {
        setTimeout(function() {
            loadSliderFromHidden();
            // Set default values for new slider
            if (!$('#slider_size_select').val()) {
                $('#slider_size_select').val('medium');
            }
            if (!$('#slider_height_select').val()) {
                $('#slider_height_select').val('500');
            }
        }, 100);
    }
    
    // Initialize list form
    if (type === 'list') {
        setTimeout(function() {
            loadListFromHidden();
        }, 100);
    }
    
    // Initialize steps form
    if (type === 'steps') {
        setTimeout(function() {
            loadStepsFromHidden();
        }, 100);
    }
    
    // Initialize divider form
    if (type === 'divider') {
        setTimeout(function() {
            toggleDividerIcon($('select[name="block_style"]').val());
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

function setStatsDescriptionContent(content) {
    const $editor = $('#stats_description_editor');
    if ($editor.hasClass('summernote-init')) {
        $editor.summernote('code', content || '');
    } else {
        $editor.val(content || '');
    }
}

function fillEditForm(block) {
    const data = block.data || {};
    const settings = block.settings || {};

    Object.keys(data).forEach(key => {
        const input = $(`[name="block_${key}"]`);
        if (input.length) {
            input.val(data[key]);
        }
    });

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
    if (block.type === 'stats') {
        if (data.stats) {
            $('#block_stats_hidden').val(data.stats);
            setTimeout(() => loadStatsFromHidden(), 50);
        }
        if (data.description) {
            setTimeout(() => setStatsDescriptionContent(data.description), 150);
        }
    }
    
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
    
    // Load slider size and height
    if (block.type === 'slider') {
        if (data.size) {
            $('#slider_size_value').val(data.size);
            $('#slider_size_select').val(data.size);
        }
        if (data.height) {
            $('#slider_height_value').val(data.height);
            $('#slider_height_select').val(data.height);
        }
    }
    // Load CTA icon and colors
    if (block.type === 'cta') {
        if (data.icon) {
            $('#cta_icon_value').val(data.icon);
            $('#cta-icon-preview').html(`<i class="${data.icon}" style="font-size:20px;color:#6366f1;"></i>`);
        }
        if (data.bg_color) $('#cta_bg_color').val(data.bg_color);
        if (data.text_color) $('#cta_text_color').val(data.text_color);
        if (data.btn_color) $('#cta_btn_color').val(data.btn_color);
    }
}

function saveBlock() {
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
    
    // Sync slider select values to hidden inputs
    if (type === 'slider') {
        $('#slider_size_value').val($('#slider_size_select').val());
        $('#slider_height_value').val($('#slider_height_select').val());
    }

    const data = {};
    $('#edit-block-content-form').find('input, textarea, select').each(function() {
        const name = $(this).attr('name');
        if (name && name.startsWith('block_')) {
            const key = name.replace('block_', '');
            data[key] = $(this).val();
        }
    });
    
    const settings = {
        customColors: $('input[name="block_custom_colors"]').is(':checked'),
        bgColor: $('input[name="block_bg_color"]').val(),
        textColor: $('input[name="block_text_color"]').val(),
        accentColor: $('input[name="block_accent_color"]').val(),
        paddingY: $('select[name="block_padding_y"]').val(),
        paddingX: $('select[name="block_padding_x"]').val(),
        width: $('select[name="block_width"]').val()
    };

    const block = {
        type: type,
        order: 0,
        data: data,
        settings: settings
    };

    // Get placement selection
    const placement = $('input[name="block_placement"]:checked').val() || 'main';
    block.settings.placement = placement;
    
    // Determine where to save the block based on placement
    if (placement === 'sidebar') {
        // Save to sidebar
        if (editingBlockIndex !== null && currentSectionIndex === 'sidebar') {
            pageData.sidebarBlocks[editingBlockIndex] = block;
        } else {
            // Remove from previous location if moving to sidebar
            if (currentSectionIndex === 'standalone' && editingBlockIndex !== null) {
                pageData.standaloneBlocks.splice(editingBlockIndex, 1);
            } else if (typeof currentSectionIndex === 'number' && currentSectionIndex >= 0 && editingBlockIndex !== null) {
                pageData.sections[currentSectionIndex].blocks.splice(editingBlockIndex, 1);
            }
            pageData.sidebarBlocks.push(block);
        }
        renderSidebarBlocks();
        renderSections();
        renderStandaloneBlocks();
    } else if (currentSectionIndex === 'standalone') {
        // Standalone CTA block
        if (editingBlockIndex !== null) {
            pageData.standaloneBlocks[editingBlockIndex] = block;
        } else {
            pageData.standaloneBlocks.push(block);
        }
        renderStandaloneBlocks();
    } else if (typeof currentSectionIndex === 'number' && currentSectionIndex >= 0) {
        // Block in a section
        if (editingBlockIndex !== null) {
            pageData.sections[currentSectionIndex].blocks[editingBlockIndex] = block;
        } else {
            pageData.sections[currentSectionIndex].blocks.push(block);
        }
        renderSections();
    } else {
        // New block without section - add to first section or create one
        if (pageData.sections.length === 0) {
            pageData.sections.push({
                id: 'section-' + Date.now(),
                title: '',
                subtitle: '',
                icon: 'fas fa-star',
                blocks: [block]
            });
        } else {
            pageData.sections[0].blocks.push(block);
        }
        renderSections();
    }

    updateCounts();
    $('#editBlockModal').modal('hide');
    
    // Reset editing state
    editingBlockIndex = null;
    currentSectionIndex = null;
}

// ============ SECTION FUNCTIONS ============

function openAddSectionModal() {
    editingSectionIndex = null;
    $('input[name="section_title_input"]').val('');
    $('input[name="section_subtitle_input"]').val('');
    $('input[name="section_icon_input"]').val('fas fa-star');
    $('#section-modal-icon-preview').html('<i class="fas fa-star" style="font-size:20px;color:#6366f1;"></i>');
    $('#addSectionModal').modal('show');
}

function openEditSectionModal(index) {
    editingSectionIndex = index;
    const section = pageData.sections[index];
    $('input[name="section_title_input"]').val(section.title);
    $('input[name="section_subtitle_input"]').val(section.subtitle || '');
    $('input[name="section_icon_input"]').val(section.icon || 'fas fa-star');
    $('#section-modal-icon-preview').html('<i class="' + (section.icon || 'fas fa-star') + '" style="font-size:20px;color:#6366f1;"></i>');
    $('#addSectionModal').modal('show');
}

function saveSection() {
    const title = $('input[name="section_title_input"]').val().trim();
    const subtitle = $('input[name="section_subtitle_input"]').val().trim();
    const icon = $('input[name="section_icon_input"]').val().trim() || 'fas fa-star';
    
    if (!title) {
        alert('Judul section wajib diisi!');
        return;
    }
    
    if (editingSectionIndex !== null) {
        // Editing existing section
        pageData.sections[editingSectionIndex].title = title;
        pageData.sections[editingSectionIndex].subtitle = subtitle;
        pageData.sections[editingSectionIndex].icon = icon;
    } else {
        // Creating new section
        pageData.sections.push({
            id: 'section-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9),
            title: title,
            subtitle: subtitle,
            icon: icon,
            order: pageData.sections.length,
            blocks: []
        });
    }
    
    $('#addSectionModal').modal('hide');
    renderSections();
    updateCounts();
}

function deleteSection(index) {
    if (confirm('Hapus section "' + pageData.sections[index].title + '" beserta semua block di dalamnya?')) {
        pageData.sections.splice(index, 1);
        renderSections();
        updateCounts();
    }
}

function openAddBlockToSection(sectionIndex) {
    currentSectionIndex = sectionIndex;
    $('#addBlockModal').modal('show');
}

function renderSections() {
    const container = $('#sections-container');
    container.empty();
    
    if (pageData.sections.length === 0) {
        container.html('<div class="text-center text-muted py-5"><i class="fas fa-folder-open fs-2x mb-3"></i><div>Belum ada section. Klik "Tambah Section" untuk memulai.</div></div>');
        return;
    }
    
    pageData.sections.forEach((section, sIndex) => {
        let blocksHtml = '';
        if (section.blocks.length === 0) {
            blocksHtml = '<div class="text-center text-muted py-4"><small>Belum ada block dalam section ini</small></div>';
        } else {
            section.blocks.forEach((block, bIndex) => {
                const preview = getBlockPreview(block);
                blocksHtml += `
                    <div class="block-item" data-section="${sIndex}" data-block="${bIndex}">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="block-type-badge block-type-${block.type}">${blockTypeLabels[block.type]}</span>
                            <div>
                                <button type="button" class="btn btn-sm btn-light-primary me-1" onclick="openEditBlockModal('${block.type}', ${bIndex}, false, ${sIndex})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-light-danger" onclick="deleteBlockFromSection(${sIndex}, ${bIndex})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-muted small">${preview}</div>
                    </div>
                `;
            });
        }
        
        const html = `
            <div class="section-card mb-4" data-section-index="${sIndex}">
                <div class="section-header-drag d-flex align-items-center justify-content-between p-3" style="background: linear-gradient(135deg, #667eea22 0%, #764ba222 100%); border-radius: 12px 12px 0 0; cursor: move;">
                    <div class="d-flex align-items-center">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                            <i class="${section.icon}" style="color: white; font-size: 1rem;"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">${section.title}</h6>
                            ${section.subtitle ? '<small class="text-muted">' + section.subtitle + '</small>' : ''}
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-light-primary me-1" onclick="openEditSectionModal(${sIndex})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-light-danger" onclick="deleteSection(${sIndex})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="section-body p-3" style="background: #fafbfc; border: 1px solid #e8eaed; border-top: 0; border-radius: 0 0 12px 12px;">
                    <div class="section-blocks" id="section-blocks-${sIndex}">
                        ${blocksHtml}
                    </div>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-sm btn-outline btn-outline-dashed btn-outline-primary" onclick="openAddBlockToSection(${sIndex})">
                            <i class="fas fa-plus me-1"></i>Tambah Block
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.append(html);
        
        // Initialize sortable for blocks within this section
        new Sortable(document.getElementById('section-blocks-' + sIndex), {
            animation: 150,
            group: 'blocks',
            onEnd: function(evt) {
                updateBlockOrderInSection(sIndex);
            }
        });
    });
}

function renderStandaloneBlocks() {
    const container = $('#standalone-blocks-container');
    container.empty();
    
    if (pageData.standaloneBlocks.length === 0) return;
    
    container.append('<h6 class="text-muted mb-3"><i class="fas fa-bullhorn me-2"></i>CTA Blocks</h6>');
    
    pageData.standaloneBlocks.forEach((block, index) => {
        const preview = getBlockPreview(block);
        const html = `
            <div class="block-item mb-3" data-standalone-index="${index}">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="block-type-badge block-type-cta">${blockTypeLabels.cta}</span>
                    <div>
                        <button type="button" class="btn btn-sm btn-light-primary me-1" onclick="openEditBlockModal('cta', ${index}, true)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-light-danger" onclick="deleteStandaloneBlock(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="text-muted small">${preview}</div>
            </div>
        `;
        container.append(html);
    });
}

function renderSidebarBlocks() {
    const container = $('#sidebar-blocks-container');
    if (!container.length) return;
    
    container.empty();
    
    const currentLayout = $('input[name="layout"]:checked').val();
    if (currentLayout !== 'sidebar-left' && currentLayout !== 'sidebar-right') {
        container.hide();
        return;
    }
    
    container.show();
    container.append('<h6 class="text-warning mb-3"><i class="fas fa-columns me-2"></i>Sidebar Blocks</h6>');
    
    if (pageData.sidebarBlocks.length === 0) {
        container.append('<div class="text-muted small p-3 border border-dashed rounded">Belum ada block di sidebar. Tambahkan block dan pilih "Sidebar" pada penempatan.</div>');
        return;
    }
    
    pageData.sidebarBlocks.forEach((block, index) => {
        const preview = getBlockPreview(block);
        const html = `
            <div class="block-item mb-3 is-sidebar" data-sidebar-index="${index}">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="block-type-badge block-type-${block.type}">${blockTypeLabels[block.type] || block.type}</span>
                    <div>
                        <button type="button" class="btn btn-sm btn-light-primary me-1" onclick="openEditSidebarBlock(${index})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-light-danger" onclick="deleteSidebarBlock(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="text-muted small">${preview}</div>
            </div>
        `;
        container.append(html);
    });
}

function openEditSidebarBlock(index) {
    const block = pageData.sidebarBlocks[index];
    editingBlockIndex = index;
    currentSectionIndex = 'sidebar';
    openEditBlockModal(block.type, index, false, null);
    // Set placement to sidebar
    setTimeout(() => {
        $('input[name="block_placement"][value="sidebar"]').prop('checked', true);
    }, 100);
}

function deleteSidebarBlock(index) {
    if (confirm('Hapus sidebar block ini?')) {
        pageData.sidebarBlocks.splice(index, 1);
        renderSidebarBlocks();
        updateCounts();
    }
}

function deleteBlockFromSection(sectionIndex, blockIndex) {
    if (confirm('Hapus block ini?')) {
        pageData.sections[sectionIndex].blocks.splice(blockIndex, 1);
        renderSections();
        updateCounts();
    }
}

function deleteStandaloneBlock(index) {
    if (confirm('Hapus CTA block ini?')) {
        pageData.standaloneBlocks.splice(index, 1);
        renderStandaloneBlocks();
        updateCounts();
    }
}

function updateSectionOrder() {
    const newOrder = [];
    $('#sections-container .section-card').each(function(index) {
        const sIndex = $(this).data('section-index');
        newOrder.push(pageData.sections[sIndex]);
    });
    pageData.sections = newOrder;
    renderSections();
}

function updateBlockOrderInSection(sectionIndex) {
    const newBlocks = [];
    $(`#section-blocks-${sectionIndex} .block-item`).each(function() {
        const bIndex = $(this).data('block');
        newBlocks.push(pageData.sections[sectionIndex].blocks[bIndex]);
    });
    pageData.sections[sectionIndex].blocks = newBlocks;
    renderSections();
}

function updateCounts() {
    const totalBlocks = pageData.sections.reduce((sum, s) => sum + s.blocks.length, 0) + pageData.standaloneBlocks.length + pageData.sidebarBlocks.length;
    $('#section-count').text(pageData.sections.length + ' section');
    $('#block-count').text(totalBlocks + ' blok');
}

// Keep old renderBlocks for backward compatibility (not used anymore)
function renderBlocks() {
    // This function is deprecated, use renderSections instead
    const container = $('#sections-container');

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
    const countItems = (str) => (str || '').split('\n').filter(l => l.trim()).length;
    switch(block.type) {
        case 'hero':
            return data.title || 'Hero banner';
        case 'text':
            const textPreview = (data.content || '').replace(/<[^>]*>/g, '').substring(0, 60);
            const hasImg = data.image && data.image_position !== 'none';
            return textPreview + '...' + (hasImg ? ` [📷 ${data.image_position || 'gambar'}]` : '');
        case 'gallery':
            return `${countItems(data.images)} gambar`;
        case 'stats':
            return `${countItems(data.stats)} statistik - ${data.display_type || 'numbers'}`;
        case 'cards':
            return `${countItems(data.items)} cards`;
        case 'accordion':
            return `${countItems(data.items)} items`;
        case 'tabs':
            return `${countItems(data.items)} tabs`;
        case 'timeline':
            return `${countItems(data.items)} events`;
        case 'table':
            return `${countItems(data.items)} rows`;
        case 'quote':
            return `"${(data.content || '').substring(0, 50)}..." - ${data.author || ''}`;
        case 'video':
            return data.url ? 'Video embedded' : 'No video URL';
        case 'slider':
            return `${countItems(data.items)} slides`;
        case 'list':
            return `${countItems(data.items)} items`;
        case 'steps':
            return `${countItems(data.items)} langkah`;
        case 'map':
            return data.url ? 'Google Maps' : 'No map URL';
        case 'divider':
            return `Divider - ${data.style || 'line'}`;
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
    
    // Create media picker modal if not exists
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
    } else if (currentMediaTarget === 'table-cell') {
        if (currentTableCellInput) {
            currentTableCellInput.value = url;
            updateTableHidden();
        }
        $('#mediaPickerModal').modal('hide');
        Swal.fire({
            icon: 'success',
            title: 'File dipilih',
            text: filename,
            timer: 1500,
            showConfirmButton: false
        });
    } else if (currentMediaTarget === 'slider-item') {
        const item = document.getElementById('slider-item-' + currentSliderItemId);
        if (item) {
            item.querySelector('.slider-image').value = url;
            item.querySelector('.slider-thumb').innerHTML = '<img src="'+url+'" style="width:100%;height:100%;object-fit:cover;">';
            updateSliderHidden();
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

// === ACCORDION ITEM FUNCTIONS ===
let accordionCounter = 0;
function addAccordionItem(title = '', content = '') {
    accordionCounter++;
    const container = document.getElementById('accordion-items-container');
    if (!container) return;
    const editorId = 'accordion-editor-' + accordionCounter;
    const itemHtml = `
        <div class="accordion-item-form" id="accordion-item-${accordionCounter}" style="background: #f8fafc; border-radius: 12px; padding: 16px; margin-bottom: 12px; border: 1px solid #e2e8f0;">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-primary rounded-pill">${accordionCounter}</span>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAccordionItem(${accordionCounter})" style="width: 32px; height: 32px; padding: 0;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <input type="text" class="form-control mb-2 accordion-title" placeholder="Judul accordion" value="${title.replace(/"/g, '&quot;')}" onchange="updateAccordionHidden()">
            <textarea class="accordion-content-editor" id="${editorId}">${content}</textarea>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', itemHtml);
    // Init Summernote
    $('#' + editorId).summernote({
        height: 120,
        toolbar: [['style', ['bold', 'italic', 'underline']], ['para', ['ul', 'ol']], ['insert', ['link']]],
        callbacks: { onChange: function() { updateAccordionHidden(); } }
    });
}
function removeAccordionItem(id) {
    const item = document.getElementById('accordion-item-' + id);
    if (item) {
        $(item).find('.accordion-content-editor').summernote('destroy');
        item.remove();
        updateAccordionHidden();
    }
}
function updateAccordionHidden() {
    const items = document.querySelectorAll('.accordion-item-form');
    const data = [];
    items.forEach(item => {
        const title = item.querySelector('.accordion-title').value.trim();
        const editor = $(item).find('.accordion-content-editor');
        const content = editor.length ? editor.summernote('code').trim() : '';
        if (title && content) data.push(title + ' | ' + content.replace(/\n/g, ' '));
    });
    const hidden = document.getElementById('accordion_items_hidden');
    if (hidden) hidden.value = data.join('\n');
}
function loadAccordionFromHidden() {
    const hidden = document.getElementById('accordion_items_hidden');
    const container = document.getElementById('accordion-items-container');
    if (!hidden || !container) return;
    // Destroy existing editors
    $(container).find('.accordion-content-editor').each(function() { $(this).summernote('destroy'); });
    container.innerHTML = '';
    accordionCounter = 0;
    const lines = hidden.value.split('\n').filter(line => line.trim());
    if (lines.length === 0) { addAccordionItem(); return; }
    lines.forEach(line => {
        const idx = line.indexOf('|');
        if (idx > 0) {
            const title = line.substring(0, idx).trim();
            const content = line.substring(idx + 1).trim();
            addAccordionItem(title, content);
        }
    });
}

// === TAB ITEM FUNCTIONS ===
let tabCounter = 0;
function addTabItem(title = '', content = '') {
    tabCounter++;
    const container = document.getElementById('tabs-items-container');
    if (!container) return;
    const editorId = 'tab-editor-' + tabCounter;
    const itemHtml = `
        <div class="tab-item-form" id="tab-item-${tabCounter}" style="background: #f8fafc; border-radius: 12px; padding: 16px; margin-bottom: 12px; border: 1px solid #e2e8f0;">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-info rounded-pill">Tab ${tabCounter}</span>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeTabItem(${tabCounter})" style="width: 32px; height: 32px; padding: 0;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <input type="text" class="form-control mb-2 tab-title" placeholder="Judul tab (cth: Profil)" value="${title.replace(/"/g, '&quot;')}" onchange="updateTabsHidden()">
            <textarea class="tab-content-editor" id="${editorId}">${content}</textarea>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', itemHtml);
    // Init Summernote
    $('#' + editorId).summernote({
        height: 150,
        toolbar: [['style', ['style']], ['font', ['bold', 'italic', 'underline']], ['para', ['ul', 'ol', 'paragraph']], ['insert', ['link']]],
        styleTags: ['p', 'h3', 'h4'],
        callbacks: { onChange: function() { updateTabsHidden(); } }
    });
}
function removeTabItem(id) {
    const item = document.getElementById('tab-item-' + id);
    if (item) {
        $(item).find('.tab-content-editor').summernote('destroy');
        item.remove();
        updateTabsHidden();
    }
}
function updateTabsHidden() {
    const items = document.querySelectorAll('.tab-item-form');
    const data = [];
    items.forEach(item => {
        const title = item.querySelector('.tab-title').value.trim();
        const editor = $(item).find('.tab-content-editor');
        const content = editor.length ? editor.summernote('code').trim() : '';
        if (title && content) data.push(title + ' | ' + content.replace(/\n/g, ' '));
    });
    const hidden = document.getElementById('tabs_items_hidden');
    if (hidden) hidden.value = data.join('\n');
}
function loadTabsFromHidden() {
    const hidden = document.getElementById('tabs_items_hidden');
    const container = document.getElementById('tabs-items-container');
    if (!hidden || !container) return;
    // Destroy existing editors
    $(container).find('.tab-content-editor').each(function() { $(this).summernote('destroy'); });
    container.innerHTML = '';
    tabCounter = 0;
    const lines = hidden.value.split('\n').filter(line => line.trim());
    if (lines.length === 0) { addTabItem(); return; }
    lines.forEach(line => {
        const idx = line.indexOf('|');
        if (idx > 0) {
            const title = line.substring(0, idx).trim();
            const content = line.substring(idx + 1).trim();
            addTabItem(title, content);
        }
    });
}

// === TIMELINE ITEM FUNCTIONS ===
let timelineCounter = 0;
function addTimelineItem(year = '', title = '', desc = '') {
    timelineCounter++;
    const container = document.getElementById('timeline-items-container');
    if (!container) return;
    const editorId = 'timeline-editor-' + timelineCounter;
    const itemHtml = `
        <div class="timeline-item-form" id="timeline-item-${timelineCounter}" style="background: #f8fafc; border-radius: 12px; padding: 16px; margin-bottom: 12px; border: 1px solid #e2e8f0;">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-warning text-dark rounded-pill"><i class="fas fa-clock me-1"></i>${timelineCounter}</span>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeTimelineItem(${timelineCounter})" style="width: 32px; height: 32px; padding: 0;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-3">
                    <input type="text" class="form-control timeline-year" placeholder="Tahun" value="${year.replace(/"/g, '&quot;')}" onchange="updateTimelineHidden()">
                </div>
                <div class="col-9">
                    <input type="text" class="form-control timeline-title" placeholder="Judul event" value="${title.replace(/"/g, '&quot;')}" onchange="updateTimelineHidden()">
                </div>
            </div>
            <textarea class="timeline-desc-editor" id="${editorId}">${desc}</textarea>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', itemHtml);
    // Init Summernote
    $('#' + editorId).summernote({
        height: 100,
        toolbar: [['style', ['bold', 'italic']], ['para', ['ul', 'ol']], ['insert', ['link']]],
        callbacks: { onChange: function() { updateTimelineHidden(); } }
    });
}
function removeTimelineItem(id) {
    const item = document.getElementById('timeline-item-' + id);
    if (item) {
        $(item).find('.timeline-desc-editor').summernote('destroy');
        item.remove();
        updateTimelineHidden();
    }
}
function updateTimelineHidden() {
    const items = document.querySelectorAll('.timeline-item-form');
    const data = [];
    items.forEach(item => {
        const year = item.querySelector('.timeline-year').value.trim();
        const title = item.querySelector('.timeline-title').value.trim();
        const editor = $(item).find('.timeline-desc-editor');
        const desc = editor.length ? editor.summernote('code').trim().replace(/\n/g, ' ') : '';
        if (year && title) data.push(year + ' | ' + title + ' | ' + desc);
    });
    const hidden = document.getElementById('timeline_items_hidden');
    if (hidden) hidden.value = data.join('\n');
}
function loadTimelineFromHidden() {
    const hidden = document.getElementById('timeline_items_hidden');
    const container = document.getElementById('timeline-items-container');
    if (!hidden || !container) return;
    // Destroy existing editors
    $(container).find('.timeline-desc-editor').each(function() { $(this).summernote('destroy'); });
    container.innerHTML = '';
    timelineCounter = 0;
    const lines = hidden.value.split('\n').filter(line => line.trim());
    if (lines.length === 0) { addTimelineItem(); return; }
    lines.forEach(line => {
        const idx1 = line.indexOf('|');
        if (idx1 > 0) {
            const year = line.substring(0, idx1).trim();
            const rest = line.substring(idx1 + 1);
            const idx2 = rest.indexOf('|');
            if (idx2 > 0) {
                const title = rest.substring(0, idx2).trim();
                const desc = rest.substring(idx2 + 1).trim();
                addTimelineItem(year, title, desc);
            } else {
                addTimelineItem(year, rest.trim(), '');
            }
        }
    });
}

// === TABLE FUNCTIONS ===
let tableColumnCount = 0;
let tableRowCount = 0;
let tableColumns = [];

function addTableColumn(name = '') {
    tableColumnCount++;
    const container = document.getElementById('table-headers-container');
    if (!container) return;
    const html = `
        <div class="table-col-item d-flex align-items-center gap-1" id="table-col-${tableColumnCount}" style="background:#e0e7ff;padding:6px 10px;border-radius:6px;">
            <input type="text" class="form-control form-control-sm table-col-name" value="${name}" placeholder="Nama Kolom" style="width:120px;" onchange="updateTableHidden()">
            <button type="button" class="btn btn-sm btn-icon btn-light-danger" onclick="removeTableColumn(${tableColumnCount})" style="width:24px;height:24px;padding:0;">
                <i class="fas fa-times" style="font-size:10px;"></i>
            </button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    updateTableHidden();
}

function removeTableColumn(id) {
    const el = document.getElementById('table-col-' + id);
    if (el) { el.remove(); updateTableHidden(); rebuildTableRows(); }
}

function addTableRow(cells = []) {
    tableRowCount++;
    const container = document.getElementById('table-rows-container');
    const headers = getTableHeaders();
    if (!container || headers.length === 0) {
        Swal.fire({icon:'warning',title:'Tambah kolom dulu!',text:'Silakan tambah kolom header terlebih dahulu.',timer:2000,showConfirmButton:false});
        return;
    }
    
    let cellsHtml = '';
    headers.forEach((h, i) => {
        const val = cells[i] || '';
        const isFile = val.startsWith('/storage/') || val.startsWith('http');
        cellsHtml += `
            <div class="col-md-${Math.max(3, Math.floor(12/headers.length))} mb-2">
                <label class="form-label small text-muted">${h}</label>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control table-cell" value="${val.replace(/"/g,'&quot;')}" placeholder="${h}" onchange="updateTableHidden()">
                    <button type="button" class="btn btn-outline-primary" onclick="openMediaPickerForTableCell(this)" title="Upload File">
                        <i class="fas fa-paperclip"></i>
                    </button>
                </div>
            </div>
        `;
    });
    
    const html = `
        <div class="table-row-item" id="table-row-${tableRowCount}" style="background:#f8fafc;border-radius:10px;padding:12px;margin-bottom:8px;border:1px solid #e2e8f0;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-secondary">Baris ${tableRowCount}</span>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeTableRow(${tableRowCount})" style="width:28px;height:28px;padding:0;">
                    <i class="fas fa-trash" style="font-size:11px;"></i>
                </button>
            </div>
            <div class="row g-2">${cellsHtml}</div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    updateTableHidden();
}

function removeTableRow(id) {
    const el = document.getElementById('table-row-' + id);
    if (el) { el.remove(); updateTableHidden(); }
}

function getTableHeaders() {
    const items = document.querySelectorAll('.table-col-name');
    return Array.from(items).map(i => i.value.trim()).filter(v => v);
}

function rebuildTableRows() {
    // Get existing row data
    const rows = [];
    document.querySelectorAll('.table-row-item').forEach(row => {
        const cells = Array.from(row.querySelectorAll('.table-cell')).map(c => c.value.trim());
        if (cells.some(c => c)) rows.push(cells);
    });
    // Clear and rebuild
    document.getElementById('table-rows-container').innerHTML = '';
    tableRowCount = 0;
    rows.forEach(r => addTableRow(r));
}

function updateTableHidden() {
    // Headers
    const headers = getTableHeaders();
    document.getElementById('table_headers_hidden').value = headers.join(' | ');
    
    // Rows
    const rows = [];
    document.querySelectorAll('.table-row-item').forEach(row => {
        const cells = Array.from(row.querySelectorAll('.table-cell')).map(c => c.value.trim());
        if (cells.some(c => c)) rows.push(cells.join(' | '));
    });
    document.getElementById('table_items_hidden').value = rows.join('\n');
}

function loadTableFromHidden() {
    const headersHidden = document.getElementById('table_headers_hidden');
    const itemsHidden = document.getElementById('table_items_hidden');
    const headersContainer = document.getElementById('table-headers-container');
    const rowsContainer = document.getElementById('table-rows-container');
    
    if (!headersContainer || !rowsContainer) return;
    
    headersContainer.innerHTML = '';
    rowsContainer.innerHTML = '';
    tableColumnCount = 0;
    tableRowCount = 0;
    
    // Load headers
    const headers = (headersHidden?.value || '').split('|').map(h => h.trim()).filter(h => h);
    if (headers.length === 0) {
        addTableColumn('Nama');
        addTableColumn('Nilai');
        return;
    }
    headers.forEach(h => addTableColumn(h));
    
    // Load rows
    const lines = (itemsHidden?.value || '').split('\n').filter(l => l.trim());
    if (lines.length === 0) {
        addTableRow();
        return;
    }
    lines.forEach(line => {
        const cells = line.split('|').map(c => c.trim());
        addTableRow(cells);
    });
}

let currentTableCellInput = null;
function openMediaPickerForTableCell(btn) {
    currentTableCellInput = btn.previousElementSibling;
    openMediaPicker('table-cell');
}

// === SLIDER ITEM FUNCTIONS ===
let sliderCounter = 0;
let currentSliderItemId = null;
function addSliderItem(image = '', title = '', desc = '') {
    sliderCounter++;
    const container = document.getElementById('slider-items-container');
    if (!container) return;
    const html = `
        <div class="slider-item-form" id="slider-item-${sliderCounter}" style="background:#f8fafc;border-radius:12px;padding:14px;margin-bottom:10px;border:1px solid #e2e8f0;">
            <div class="d-flex gap-3">
                <div class="slider-thumb" style="width:100px;height:70px;background:#e5e7eb;border-radius:8px;overflow:hidden;cursor:pointer;flex-shrink:0;" onclick="selectSliderImage(${sliderCounter})">
                    ${image ? '<img src="'+image+'" style="width:100%;height:100%;object-fit:cover;">' : '<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image text-muted"></i></div>'}
                </div>
                <div style="flex:1;">
                    <input type="hidden" class="slider-image" value="${image}">
                    <input type="text" class="form-control form-control-sm mb-2 slider-title" placeholder="Judul slide" value="${title.replace(/"/g,'&quot;')}" onchange="updateSliderHidden()">
                    <input type="text" class="form-control form-control-sm slider-desc" placeholder="Deskripsi (opsional)" value="${desc.replace(/"/g,'&quot;')}" onchange="updateSliderHidden()">
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger align-self-start" onclick="removeSliderItem(${sliderCounter})" style="width:32px;height:32px;padding:0;"><i class="fas fa-times"></i></button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    updateSliderHidden();
}
function selectSliderImage(id) { currentSliderItemId = id; openMediaPicker('slider-item'); }
function removeSliderItem(id) { document.getElementById('slider-item-'+id)?.remove(); updateSliderHidden(); }
function updateSliderHidden() {
    const items = [];
    document.querySelectorAll('.slider-item-form').forEach(item => {
        const img = item.querySelector('.slider-image')?.value || '';
        const title = item.querySelector('.slider-title')?.value || '';
        const desc = item.querySelector('.slider-desc')?.value || '';
        if (img) items.push(img + ' | ' + title + ' | ' + desc);
    });
    document.getElementById('slider_items_hidden').value = items.join('\n');
}
function loadSliderFromHidden() {
    const hidden = document.getElementById('slider_items_hidden');
    const container = document.getElementById('slider-items-container');
    if (!hidden || !container) return;
    container.innerHTML = ''; sliderCounter = 0;
    const lines = hidden.value.split('\n').filter(l => l.trim());
    if (lines.length === 0) { addSliderItem(); return; }
    lines.forEach(line => {
        const parts = line.split('|').map(p => p.trim());
        addSliderItem(parts[0] || '', parts[1] || '', parts[2] || '');
    });
}

// === LIST ITEM FUNCTIONS ===
let listCounter = 0;
function addListItem(icon = 'fas fa-check', text = '') {
    listCounter++;
    const container = document.getElementById('list-items-container');
    if (!container) return;
    const html = `
        <div class="list-item-form" id="list-item-${listCounter}" style="background:#f8fafc;border-radius:10px;padding:12px;margin-bottom:8px;border:1px solid #e2e8f0;display:flex;align-items:center;gap:10px;">
            <input type="hidden" class="list-icon" value="${icon}">
            <div class="list-icon-preview" style="width:36px;height:36px;background:#e0e7ff;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;" onclick="openIconPickerForList(${listCounter})">
                <i class="${icon}" style="color:#6366f1;"></i>
            </div>
            <input type="text" class="form-control form-control-sm list-text" placeholder="Teks item..." value="${text.replace(/"/g,'&quot;')}" onchange="updateListHidden()" style="flex:1;">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeListItem(${listCounter})" style="width:32px;height:32px;padding:0;"><i class="fas fa-times"></i></button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    updateListHidden();
}
let currentListItemId = null;
function openIconPickerForList(id) { currentListItemId = id; openIconPicker('list-item'); }
function removeListItem(id) { document.getElementById('list-item-'+id)?.remove(); updateListHidden(); }
function updateListHidden() {
    const items = [];
    document.querySelectorAll('.list-item-form').forEach(item => {
        const icon = item.querySelector('.list-icon')?.value || 'fas fa-check';
        const text = item.querySelector('.list-text')?.value || '';
        if (text) items.push(icon + ' | ' + text);
    });
    document.getElementById('list_items_hidden').value = items.join('\n');
}
function loadListFromHidden() {
    const hidden = document.getElementById('list_items_hidden');
    const container = document.getElementById('list-items-container');
    if (!hidden || !container) return;
    container.innerHTML = ''; listCounter = 0;
    const lines = hidden.value.split('\n').filter(l => l.trim());
    if (lines.length === 0) { addListItem(); return; }
    lines.forEach(line => {
        const idx = line.indexOf('|');
        if (idx > 0) addListItem(line.substring(0,idx).trim(), line.substring(idx+1).trim());
        else addListItem('fas fa-check', line.trim());
    });
}

// === STEPS ITEM FUNCTIONS ===
let stepsCounter = 0;
function addStepItem(title = '', desc = '') {
    stepsCounter++;
    const container = document.getElementById('steps-items-container');
    if (!container) return;
    const html = `
        <div class="step-item-form" id="step-item-${stepsCounter}" style="background:#f8fafc;border-radius:10px;padding:14px;margin-bottom:10px;border:1px solid #e2e8f0;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-success rounded-pill">Step ${stepsCounter}</span>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeStepItem(${stepsCounter})" style="width:28px;height:28px;padding:0;"><i class="fas fa-times" style="font-size:11px;"></i></button>
            </div>
            <input type="text" class="form-control form-control-sm mb-2 step-title" placeholder="Judul step" value="${title.replace(/"/g,'&quot;')}" onchange="updateStepsHidden()">
            <textarea class="form-control form-control-sm step-desc" rows="2" placeholder="Deskripsi step..." onchange="updateStepsHidden()">${desc}</textarea>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    updateStepsHidden();
}
function removeStepItem(id) { document.getElementById('step-item-'+id)?.remove(); updateStepsHidden(); }
function updateStepsHidden() {
    const items = [];
    document.querySelectorAll('.step-item-form').forEach(item => {
        const title = item.querySelector('.step-title')?.value?.trim() || '';
        const desc = item.querySelector('.step-desc')?.value?.trim().replace(/\n/g,' ') || '';
        if (title) items.push(title + ' | ' + desc);
    });
    document.getElementById('steps_items_hidden').value = items.join('\n');
}
function loadStepsFromHidden() {
    const hidden = document.getElementById('steps_items_hidden');
    const container = document.getElementById('steps-items-container');
    if (!hidden || !container) return;
    container.innerHTML = ''; stepsCounter = 0;
    const lines = hidden.value.split('\n').filter(l => l.trim());
    if (lines.length === 0) { addStepItem(); return; }
    lines.forEach(line => {
        const idx = line.indexOf('|');
        if (idx > 0) addStepItem(line.substring(0,idx).trim(), line.substring(idx+1).trim());
        else addStepItem(line.trim(), '');
    });
}

// === DIVIDER ICON FUNCTIONS ===
function toggleDividerIcon(style) {
    const group = document.getElementById('divider-icon-group');
    if (group) group.style.display = style === 'icon' ? 'block' : 'none';
}

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
    } else if (currentIconTarget === 'section-modal') {
        $('input[name="section_icon_input"]').val(iconClass);
        $('#section-modal-icon-preview').html(`<i class="${iconClass}" style="font-size:20px;color:#6366f1;"></i>`);
    } else if (currentIconTarget === 'list-item') {
        const item = document.getElementById('list-item-' + currentListItemId);
        if (item) {
            item.querySelector('.list-icon').value = iconClass;
            item.querySelector('.list-icon-preview').innerHTML = `<i class="${iconClass}" style="color:#6366f1;"></i>`;
            updateListHidden();
        }
    } else if (currentIconTarget === 'divider') {
        $('#divider_icon_value').val(iconClass);
        $('#divider-icon-preview').html(`<i class="${iconClass}" style="font-size:20px;color:#6366f1;"></i>`);
    } else if (currentIconTarget === 'cta') {
        $('#cta_icon_value').val(iconClass);
        $('#cta-icon-preview').html(`<i class="${iconClass}" style="font-size:20px;color:#6366f1;"></i>`);
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

// Update image preview when URL changes
$(document).on('input', 'input[name="block_image"]', function() {
    const url = $(this).val();
    if (url && (url.startsWith('http') || url.startsWith('/'))) {
        updateImagePreview(url);
    }
});

// Search media
$(document).on('input', '#mediaSearch', function() {
    const search = $(this).val();
    clearTimeout(window.mediaSearchTimer);
    window.mediaSearchTimer = setTimeout(() => loadMediaItems(search), 300);
});
</script>
@endpush
