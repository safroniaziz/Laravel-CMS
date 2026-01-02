@extends('layouts.dashboard.dashboard')

@section('title', 'Category Sections Settings')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #1a246a, #2d3a8c); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                            <i class="fas fa-th-large text-white fs-3"></i>
                        </div>
                        <div>
                            <h1 class="fs-2 fw-bold mb-0">Category Sections Settings</h1>
                            <span class="text-muted fs-7">Pengaturan 3 section kategori (Pendidikan, Prestasi, Penelitian)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Pengaturan Category Sections</h3></div>
                <div class="card-body">
                    <form id="categorySettingsForm">
                        @csrf
                        <input type="hidden" name="type" value="homepage">
                        <input type="hidden" name="group" value="homepage">
                        
                        {{-- Show Section Toggle --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Section</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[category_section_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[category_section_show]" value="1" {{ ($settings['category_section_show'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tampilkan Category Sections di Homepage</label>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-6"></div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Layout Style</label>
                            <div class="col-lg-9">
                                <select name="settings[category_layout_style]" class="form-select">
                                    <option value="current" {{ ($settings['category_layout_style'] ?? 'current') == 'current' ? 'selected' : '' }}>Current 3-Column</option>
                                    <option value="grid" {{ ($settings['category_layout_style'] ?? '') == 'grid' ? 'selected' : '' }}>Grid Cards</option>
                                    <option value="list" {{ ($settings['category_layout_style'] ?? '') == 'list' ? 'selected' : '' }}>List View</option>
                                    <option value="tabs" {{ ($settings['category_layout_style'] ?? '') == 'tabs' ? 'selected' : '' }}>Tabs View</option>
                                </select>
                                <small class="text-muted d-block mt-2">Pilih tampilan layout untuk section kategori di homepage</small>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Section 1</h4>
                        <p class="text-muted mb-4">Pengaturan kategori pertama yang ditampilkan.</p>
                        
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[category_section_title_1]" class="form-control" value="{{ $settings['category_section_title_1'] ?? 'Pendidikan' }}">
                                <small class="text-muted">Judul untuk kolom kategori ini</small>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Category Slug</label>
                            <div class="col-lg-9">
                                <select name="settings[category_section_slug_1]" class="form-select" data-control="select2" data-placeholder="Pilih Kategori">
                                    <option></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" {{ ($settings['category_section_slug_1'] ?? 'akademik') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }} ({{ $category->slug }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Pilih kategori berita yang ingin ditampilkan</small>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Section 2</h4>
                        <p class="text-muted mb-4">Pengaturan kategori kedua yang ditampilkan.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[category_section_title_2]" class="form-control" value="{{ $settings['category_section_title_2'] ?? 'Prestasi' }}">
                                <small class="text-muted">Judul untuk kolom kategori ini</small>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Category Slug</label>
                            <div class="col-lg-9">
                                <select name="settings[category_section_slug_2]" class="form-select" data-control="select2" data-placeholder="Pilih Kategori">
                                    <option></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" {{ ($settings['category_section_slug_2'] ?? 'prestasi') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }} ({{ $category->slug }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Pilih kategori berita yang ingin ditampilkan</small>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Section 3</h4>
                        <p class="text-muted mb-4">Pengaturan kategori ketiga yang ditampilkan.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[category_section_title_3]" class="form-control" value="{{ $settings['category_section_title_3'] ?? 'Penelitian dan Inovasi' }}">
                                <small class="text-muted">Judul untuk kolom kategori ini</small>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Category Slug</label>
                            <div class="col-lg-9">
                                <select name="settings[category_section_slug_3]" class="form-select" data-control="select2" data-placeholder="Pilih Kategori">
                                    <option></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" {{ ($settings['category_section_slug_3'] ?? 'penelitian') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }} ({{ $category->slug }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Pilih kategori berita yang ingin ditampilkan</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan</button>
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
    $('#categorySettingsForm').on('submit', function(e) {
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
</script>
@endpush
