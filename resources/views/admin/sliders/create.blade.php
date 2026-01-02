@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Slider')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-light-primary me-3">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h1 class="fs-2 fw-bold mb-0">Tambah Slider Baru</h1>
                            <span class="text-muted fs-7">Buat slider untuk ditampilkan di homepage</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form id="sliderForm" action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Judul</label>
                            <div class="col-lg-9">
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Subtitle</label>
                            <div class="col-lg-9">
                                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}" placeholder="Contoh: Program Studi Terakreditasi">
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Deskripsi</label>
                            <div class="col-lg-9">
                                <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat untuk slider">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gambar</label>
                            <div class="col-lg-9">
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, GIF, WebP. Maksimum 5MB. Rasio yang disarankan: 16:9</small>
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Posisi Gambar</label>
                            <div class="col-lg-9">
                                <select name="image_position" class="form-select">
                                    <option value="right" {{ old('image_position', 'right') == 'right' ? 'selected' : '' }}>Kanan</option>
                                    <option value="left" {{ old('image_position') == 'left' ? 'selected' : '' }}>Kiri</option>
                                </select>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-4">Badge (Label di Sudut Gambar)</h4>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Badge Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', 'UNGGUL') }}" placeholder="Contoh: UNGGUL, A+, TOP">
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Badge Subtext</label>
                            <div class="col-lg-9">
                                <input type="text" name="badge_subtext" class="form-control" value="{{ old('badge_subtext', 'Terakreditasi') }}" placeholder="Contoh: Terakreditasi, BAN-PT">
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Badge</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="badge_show" value="0">
                                    <input class="form-check-input" type="checkbox" name="badge_show" value="1" checked>
                                    <label class="form-check-label">Tampilkan badge di slider</label>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-4">Tombol CTA</h4>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Text Tombol</label>
                            <div class="col-lg-9">
                                <input type="text" name="button_text" class="form-control" value="{{ old('button_text', 'Daftar Sekarang') }}">
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Link Tombol</label>
                            <div class="col-lg-9">
                                <input type="text" name="button_link" class="form-control" value="{{ old('button_link', '/contact') }}">
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Status</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                    <label class="form-check-label">Aktif</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-light">Batal</a>
                            <button type="button" id="submitBtn" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Slider
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#submitBtn').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Simpan Slider?',
            text: 'Pastikan data sudah benar',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = $('#sliderForm')[0];
                var formData = new FormData(form);
                
                $.ajax({
                    url: form.action,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Slider berhasil ditambahkan',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '{{ route("admin.sliders.index") }}';
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON?.errors;
                        var errorMsg = 'Terjadi kesalahan';
                        if (errors) {
                            errorMsg = Object.values(errors).flat().join('<br>');
                        }
                        Swal.fire({icon: 'error', title: 'Gagal!', html: errorMsg, confirmButtonText: 'OK'});
                    }
                });
            }
        });
    });
});
</script>
@endpush

