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
}
.block-item:hover {
    border-color: #1e3a8a;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}
.block-type-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}
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
.block-type-option.selected {
    border-color: #1e3a8a;
    background: #dbeafe;
}
.block-type-option .icon {
    font-size: 24px;
    margin-bottom: 5px;
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
                                <span class="badge badge-light-primary" id="block-count">0 blok</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">Tambahkan dan atur blok konten untuk halaman ini. Drag untuk mengubah urutan.</p>

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
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">Publish</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-5">
                                <label class="form-label required">Status</label>
                                <select name="status" class="form-select">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-4">
                            <a href="{{ route('pages.index') }}" class="btn btn-light me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label"><i class="fas fa-save me-1"></i> Save Page</span>
                                <span class="indicator-progress">Saving...<span class="spinner-border spinner-border-sm ms-2"></span></span>
                            </button>
                        </div>
                    </div>

                    <!-- Page Settings -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">🎨 Warna Global</h3>
                        </div>
                        <div class="card-body">
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Blok: <span id="edit-block-type"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="edit-block-form">
                <!-- Form will be injected here -->
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
let blocks = [];
let editingBlockIndex = null;

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

const blockForms = {
    hero: `
        <div class="mb-4">
            <label class="form-label">Judul</label>
            <input type="text" name="block_title" class="form-control" placeholder="Judul banner...">
        </div>
        <div class="mb-4">
            <label class="form-label">Subtitle</label>
            <input type="text" name="block_subtitle" class="form-control" placeholder="Deskripsi singkat...">
        </div>
        <div class="mb-4">
            <label class="form-label">URL Gambar Background</label>
            <input type="text" name="block_image" class="form-control" placeholder="https://... atau /storage/...">
        </div>
        <div class="mb-0">
            <label class="form-label">Warna Overlay</label>
            <input type="color" name="block_overlay" class="form-control form-control-color" value="#1e3a8a">
        </div>
    `,
    text: `
        <div class="mb-0">
            <label class="form-label">Konten</label>
            <textarea name="block_content" class="form-control" rows="8" placeholder="Tulis konten paragraf di sini..."></textarea>
        </div>
    `,
    image: `
        <div class="mb-4">
            <label class="form-label">URL Gambar</label>
            <input type="text" name="block_image" class="form-control" placeholder="https://... atau /storage/...">
        </div>
        <div class="mb-0">
            <label class="form-label">Caption (opsional)</label>
            <input type="text" name="block_caption" class="form-control" placeholder="Keterangan gambar...">
        </div>
    `,
    gallery: `
        <p class="text-muted mb-3">Masukkan URL gambar (satu per baris, maksimal 6)</p>
        <div class="mb-0">
            <textarea name="block_images" class="form-control" rows="6" placeholder="https://gambar1.jpg&#10;https://gambar2.jpg&#10;https://gambar3.jpg"></textarea>
        </div>
    `,
    stats: `
        <p class="text-muted mb-3">Masukkan statistik (format: angka | label, satu per baris)</p>
        <div class="mb-0">
            <textarea name="block_stats" class="form-control" rows="4" placeholder="500+ | Total Alumni&#10;95% | Tingkat Employment&#10;50+ | Perusahaan Mitra"></textarea>
        </div>
    `,
    testimonial: `
        <div class="mb-4">
            <label class="form-label">Quote</label>
            <textarea name="block_quote" class="form-control" rows="3" placeholder="Isi testimonial..."></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">Nama</label>
                <input type="text" name="block_name" class="form-control" placeholder="Nama orang">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Role/Jabatan</label>
                <input type="text" name="block_role" class="form-control" placeholder="CEO, Alumni, dll">
            </div>
        </div>
        <div class="mb-0">
            <label class="form-label">URL Foto (opsional)</label>
            <input type="text" name="block_photo" class="form-control" placeholder="https://...">
        </div>
    `,
    features: `
        <p class="text-muted mb-3">Masukkan fitur (format: icon | judul | deskripsi, satu per baris)</p>
        <p class="text-muted mb-3"><small>Icon: star, check, heart, rocket, trophy, lightbulb, users, chart</small></p>
        <div class="mb-0">
            <textarea name="block_features" class="form-control" rows="4" placeholder="star | Fitur 1 | Deskripsi fitur pertama&#10;check | Fitur 2 | Deskripsi fitur kedua&#10;rocket | Fitur 3 | Deskripsi fitur ketiga"></textarea>
        </div>
    `,
    cta: `
        <div class="mb-4">
            <label class="form-label">Judul</label>
            <input type="text" name="block_title" class="form-control" placeholder="Siap bergabung?">
        </div>
        <div class="mb-4">
            <label class="form-label">Subtitle</label>
            <input type="text" name="block_subtitle" class="form-control" placeholder="Deskripsi pendek...">
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">Teks Tombol</label>
                <input type="text" name="block_button_text" class="form-control" placeholder="Hubungi Kami">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Link Tombol</label>
                <input type="text" name="block_button_link" class="form-control" placeholder="/kontak">
            </div>
        </div>
        <div class="mb-0">
            <label class="form-label">Warna Background</label>
            <input type="color" name="block_bg_color" class="form-control form-control-color" value="#1e3a8a">
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
        openEditBlockModal(type, null);
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
                        title: 'Success!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location = response.redirect;
                    });
                }
            },
            error: function(xhr) {
                btn.removeAttr('data-kt-indicator').prop('disabled', false);
                Swal.fire('Error', 'Failed to save page', 'error');
            }
        });
    });
});

function openEditBlockModal(type, index) {
    editingBlockIndex = index;
    $('#edit-block-type').text(blockTypeLabels[type]);
    $('#edit-block-form').html(blockForms[type]);
    $('#edit-block-form').data('block-type', type);

    // If editing existing block, populate form
    if (index !== null && blocks[index]) {
        const data = blocks[index].data;
        populateBlockForm(type, data);
    }

    $('#editBlockModal').modal('show');
}

function populateBlockForm(type, data) {
    if (!data) return;

    Object.keys(data).forEach(key => {
        const input = $(`[name="block_${key}"]`);
        if (input.length) {
            input.val(data[key]);
        }
    });
}

function saveBlock() {
    const type = $('#edit-block-form').data('block-type');
    const data = {};

    // Collect form data
    $('#edit-block-form').find('input, textarea, select').each(function() {
        const name = $(this).attr('name');
        if (name && name.startsWith('block_')) {
            const key = name.replace('block_', '');
            data[key] = $(this).val();
        }
    });

    if (editingBlockIndex !== null) {
        // Update existing block
        blocks[editingBlockIndex].data = data;
    } else {
        // Add new block
        blocks.push({
            type: type,
            order: blocks.length,
            data: data
        });
    }

    renderBlocks();
    $('#editBlockModal').modal('hide');
}

function renderBlocks() {
    const container = $('#blocks-container');
    container.empty();

    blocks.forEach((block, index) => {
        const preview = getBlockPreview(block);
        const html = `
            <div class="block-item" data-index="${index}">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="block-type-badge block-type-${block.type}">${blockTypeLabels[block.type]}</span>
                        <span class="text-muted ms-2">${preview}</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-light-primary me-1" onclick="editBlock(${index})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-light-danger" onclick="deleteBlock(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.append(html);
    });

    $('#block-count').text(blocks.length + ' blok');
}

function getBlockPreview(block) {
    const data = block.data;
    switch (block.type) {
        case 'hero': return data.title || 'Hero banner';
        case 'text': return (data.content || '').substring(0, 50) + '...';
        case 'image': return data.caption || 'Image';
        case 'gallery': return 'Gallery';
        case 'stats': return 'Statistics';
        case 'testimonial': return data.name || 'Testimonial';
        case 'features': return 'Features';
        case 'cta': return data.button_text || 'CTA Button';
        default: return '';
    }
}

function editBlock(index) {
    const block = blocks[index];
    openEditBlockModal(block.type, index);
}

function deleteBlock(index) {
    Swal.fire({
        title: 'Hapus blok?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            blocks.splice(index, 1);
            updateBlockOrder();
            renderBlocks();
        }
    });
}

function updateBlockOrder() {
    const items = document.querySelectorAll('.block-item');
    const newBlocks = [];
    items.forEach((item, index) => {
        const oldIndex = parseInt(item.dataset.index);
        newBlocks.push({...blocks[oldIndex], order: index});
    });
    blocks = newBlocks;
}
</script>
@endpush
