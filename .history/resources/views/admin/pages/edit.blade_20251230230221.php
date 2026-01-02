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
.block-type-image { background: #d1fae5; color: #065f46; }
.block-type-gallery { background: #ede9fe; color: #5b21b6; }
.block-type-stats { background: #fee2e2; color: #991b1b; }
.block-type-testimonial { background: #fce7f3; color: #9d174d; }
.block-type-features { background: #ccfbf1; color: #0f766e; }
.block-type-cta { background: #fed7aa; color: #c2410c; }
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
                                    <option value="draft" {{ $page->status === 'draft' ? 'selected' : '' }}>📝 Draft</option>
                                    <option value="published" {{ $page->status === 'published' ? 'selected' : '' }}>✅ Published</option>
                                </select>
                            </div>

                            <div class="mb-0">
                                <label class="form-label required">Layout Halaman</label>
                                <p class="text-muted small mb-3">Pilih layout yang sesuai dengan kebutuhan halaman</p>
                                <div class="d-grid gap-2">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-4 text-start">
                                        <input type="radio" name="layout" value="full" class="btn-check" {{ ($page->layout ?? 'full') === 'full' ? 'checked' : '' }} onchange="updateLayoutInfo()">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-arrows-alt-h fs-2x text-primary me-4"></i>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-gray-800">Full Width</div>
                                                <div class="text-muted fs-7">Semua block full-width, tanpa sidebar</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-4 text-start">
                                        <input type="radio" name="layout" value="sidebar-right" class="btn-check" {{ ($page->layout ?? '') === 'sidebar-right' ? 'checked' : '' }} onchange="updateLayoutInfo()">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-th-large fs-2x text-primary me-4"></i>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-gray-800">Sidebar Kanan</div>
                                                <div class="text-muted fs-7">Konten utama di kiri, sidebar di kanan</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-4 text-start">
                                        <input type="radio" name="layout" value="sidebar-left" class="btn-check" {{ ($page->layout ?? '') === 'sidebar-left' ? 'checked' : '' }} onchange="updateLayoutInfo()">
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
                    <div class="block-type-option" data-type="image">
                        <div class="icon">🖼️</div>
                        <div class="fw-bold">Image</div>
                        <small class="text-muted">Gambar</small>
                    </div>
                    <div class="block-type-option" data-type="gallery">
                        <div class="icon">🎨</div>
                        <div class="fw-bold">Gallery</div>
                        <small class="text-muted">Koleksi gambar</small>
                    </div>
                    <div class="block-type-option" data-type="stats">
                        <div class="icon">📊</div>
                        <div class="fw-bold">Stats</div>
                        <small class="text-muted">Angka statistik</small>
                    </div>
                    <div class="block-type-option" data-type="testimonial">
                        <div class="icon">💬</div>
                        <div class="fw-bold">Testimonial</div>
                        <small class="text-muted">Quote</small>
                    </div>
                    <div class="block-type-option" data-type="features">
                        <div class="icon">⭐</div>
                        <div class="fw-bold">Features</div>
                        <small class="text-muted">Fitur cards</small>
                    </div>
                    <div class="block-type-option" data-type="cta">
                        <div class="icon">🔘</div>
                        <div class="fw-bold">CTA</div>
                        <small class="text-muted">Tombol aksi</small>
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
<script>
// Load existing blocks
let blocks = {!! json_encode($existingBlocks) !!};
let editingBlockIndex = null;
let currentLayout = '{{ $page->layout ?? "full" }}';

const blockTypeLabels = {
    hero: '🎯 Hero',
    text: '📝 Text',
    image: '🖼️ Image',
    gallery: '🎨 Gallery',
    stats: '📊 Stats',
    testimonial: '💬 Testimonial',
    features: '⭐ Features',
    cta: '🔘 CTA'
};

// Include all blockContentForms from create.blade.php
const blockContentForms = {
    hero: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul</label>
            <input type="text" name="block_title" class="form-control form-control-lg" placeholder="Judul banner besar..." value="">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Subtitle</label>
            <input type="text" name="block_subtitle" class="form-control" placeholder="Deskripsi singkat..." value="">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">URL Gambar Background</label>
            <input type="text" name="block_image" class="form-control" placeholder="https://... atau /storage/..." value="">
            <small class="text-muted">Kosongkan untuk menggunakan warna solid</small>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Warna Overlay/Background</label>
            <input type="color" name="block_overlay" class="form-control form-control-color w-100" value="#1e3a8a" style="height: 50px;">
        </div>
    `,
    text: `
        <div class="mb-0">
            <label class="form-label fw-bold">Konten</label>
            <textarea name="block_content" class="form-control" rows="10" placeholder="Tulis konten paragraf di sini...

Anda bisa menulis beberapa paragraf.
Gunakan format markdown sederhana jika perlu."></textarea>
            <small class="text-muted">Tip: Tekan Enter 2x untuk paragraf baru</small>
        </div>
    `,
    image: `
        <div class="mb-4">
            <label class="form-label fw-bold">URL Gambar</label>
            <input type="text" name="block_image" class="form-control" placeholder="https://... atau /storage/...">
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
        <p class="text-muted mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Masukkan URL gambar (satu per baris, maksimal 12)</p>
        <div class="mb-4">
            <textarea name="block_images" class="form-control" rows="8" placeholder="https://gambar1.jpg
https://gambar2.jpg
https://gambar3.jpg
https://gambar4.jpg"></textarea>
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
        <p class="text-muted mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Format: <code>angka | label</code> (satu per baris)</p>
        <div class="mb-0">
            <textarea name="block_stats" class="form-control" rows="6" placeholder="500+ | Total Alumni
95% | Tingkat Employment
50+ | Perusahaan Mitra
10+ | Tahun Pengalaman"></textarea>
        </div>
    `,
    testimonial: `
        <div class="mb-4">
            <label class="form-label fw-bold">Quote / Testimonial</label>
            <textarea name="block_quote" class="form-control" rows="4" placeholder="&quot;Pengalaman yang luar biasa! Sangat membantu dalam pengembangan karir saya...&quot;"></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">Nama</label>
                <input type="text" name="block_name" class="form-control" placeholder="John Doe">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">Role/Jabatan</label>
                <input type="text" name="block_role" class="form-control" placeholder="CEO, Alumni 2020, dll">
            </div>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">URL Foto (opsional)</label>
            <input type="text" name="block_photo" class="form-control" placeholder="https://...">
        </div>
    `,
    features: `
        <p class="text-muted mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Format: <code>icon | judul | deskripsi</code> (satu per baris)</p>
        <p class="text-muted mb-3"><small><strong>Icon:</strong> star, check, heart, rocket, trophy, lightbulb, users, chart, shield, target, globe</small></p>
        <div class="mb-4">
            <textarea name="block_features" class="form-control" rows="6" placeholder="star | Fitur Unggulan | Deskripsi fitur pertama yang menarik
check | Kualitas Terjamin | Deskripsi fitur kedua yang menjelaskan keunggulan
rocket | Cepat & Efisien | Deskripsi fitur ketiga"></textarea>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Style Tampilan</label>
            <select name="block_style" class="form-select">
                <option value="cards">Cards dengan shadow</option>
                <option value="grid">Grid minimalis</option>
                <option value="list">List dengan icon</option>
            </select>
        </div>
    `,
    cta: `
        <div class="mb-4">
            <label class="form-label fw-bold">Judul CTA</label>
            <input type="text" name="block_title" class="form-control form-control-lg" placeholder="Siap bergabung dengan kami?">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Subtitle</label>
            <input type="text" name="block_subtitle" class="form-control" placeholder="Deskripsi pendek untuk mendorong action...">
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">Teks Tombol</label>
                <input type="text" name="block_button_text" class="form-control" placeholder="Hubungi Kami">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">Link Tombol</label>
                <input type="text" name="block_button_link" class="form-control" placeholder="/kontak atau https://...">
            </div>
        </div>
        <div class="mb-0">
            <label class="form-label fw-bold">Warna Background CTA</label>
            <input type="color" name="block_cta_bg" class="form-control form-control-color w-100" value="#1e3a8a" style="height: 50px;">
        </div>
    `
};

$(document).ready(function() {
    // Initialize with existing blocks
    renderBlocks();
    updateLayoutInfo();

    // Initialize Sortable
    new Sortable(document.getElementById('blocks-container'), {
        animation: 150,
        handle: '.block-item',
        onEnd: function() {
            updateBlockOrder();
        }
    });

    $('.block-type-option').on('click', function() {
        const type = $(this).data('type');
        $('#addBlockModal').modal('hide');
        setTimeout(() => openEditBlockModal(type, null), 300);
    });

    $('#save-block-btn').on('click', function() {
        saveBlock();
    });

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
    renderBlocks();
}

function toggleCustomColors() {
    const isChecked = $('input[name="block_custom_colors"]').is(':checked');
    $('#custom-colors-fields').toggle(isChecked);
}

function openEditBlockModal(type, index) {
    editingBlockIndex = index;
    const isNewBlock = index === null;
    const block = isNewBlock ? { type: type, settings: {} } : blocks[index];

    $('#edit-block-type').text(blockTypeLabels[type]);
    $('#edit-block-content-form').html(blockContentForms[type]);

    if (type === 'hero') {
        $('#placement-settings').hide();
    } else {
        $('#placement-settings').show();
    }

    if (!isNewBlock) {
        fillEditForm(block);
    }

    $('#editBlockModal').modal('show');
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
}

function saveBlock() {
    const type = editingBlockIndex === null ?
        (blocks[editingBlockIndex] ? blocks[editingBlockIndex].type : 'text') :
        blocks[editingBlockIndex].type;

    const data = {};
    $('#edit-block-content-form').find('input, textarea, select').each(function() {
        const name = $(this).attr('name');
        if (name && name.startsWith('block_')) {
            const key = name.replace('block_', '');
            data[key] = $(this).val();
        }
    });

    const settings = {
        placement: type === 'hero' ? 'main' : $('input[name="block_placement"]:checked').val(),
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
            return (data.content || '').substring(0, 100) + '...';
        case 'image':
            return data.image || 'Image block';
        case 'gallery':
            const imageCount = (data.images || '').split('\n').filter(l => l.trim()).length;
            return `${imageCount} gambar`;
        case 'stats':
            const statsCount = (data.stats || '').split('\n').filter(l => l.trim()).length;
            return `${statsCount} statistik`;
        case 'testimonial':
            return `"${(data.quote || '').substring(0, 80)}..." - ${data.name || 'Anonymous'}`;
        case 'features':
            const featuresCount = (data.features || '').split('\n').filter(l => l.trim()).length;
            return `${featuresCount} fitur`;
        case 'cta':
            return data.title || 'Call to action';
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
</script>
@endpush
