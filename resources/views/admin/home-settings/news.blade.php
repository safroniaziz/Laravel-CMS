@extends('layouts.dashboard.dashboard')

@section('title', 'News Section Settings')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #1a246a, #2d3a8c); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                            <i class="fas fa-newspaper text-white fs-3"></i>
                        </div>
                        <div>
                            <h1 class="fs-2 fw-bold mb-0">Berita Terbaru Settings</h1>
                            <span class="text-muted fs-7">Pengaturan section berita terbaru</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Pengaturan Berita</h3></div>
                <div class="card-body">
                    <form id="newsSettingsForm">
                        @csrf
                        <input type="hidden" name="type" value="homepage">
                        <input type="hidden" name="group" value="homepage">
                        
                        {{-- Show Section Toggle --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Section</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[news_section_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[news_section_show]" value="1" {{ ($settings['news_section_show'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tampilkan Section Berita Terbaru di Homepage</label>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-6"></div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Layout Style</label>
                            <div class="col-lg-9">
                                <select name="settings[news_layout_style]" class="form-select">
                                    <option value="current" {{ ($settings['news_layout_style'] ?? 'current') == 'current' ? 'selected' : '' }}>Current Style</option>
                                    <option value="academic_grid" {{ ($settings['news_layout_style'] ?? '') == 'academic_grid' ? 'selected' : '' }}>Academic Grid Cards</option>
                                    <option value="featured_list" {{ ($settings['news_layout_style'] ?? '') == 'featured_list' ? 'selected' : '' }}>Featured List View</option>
                                    <option value="magazine" {{ ($settings['news_layout_style'] ?? '') == 'magazine' ? 'selected' : '' }}>Magazine Style</option>
                                </select>
                                <small class="text-muted d-block mt-2">Pilih tampilan layout untuk section berita terbaru di homepage</small>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-4">Section Header</h4>
                        <p class="text-muted mb-4">Pengaturan judul dan deskripsi section berita.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Section Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[news_section_title]" class="form-control" value="{{ $settings['news_section_title'] ?? 'Berita Terbaru' }}">
                                <small class="text-muted">Judul utama section berita</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Section Subtitle</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[news_section_subtitle]" class="form-control" value="{{ $settings['news_section_subtitle'] ?? '' }}">
                                <small class="text-muted">Deskripsi singkat di bawah judul</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Subtitle</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[news_section_show_subtitle]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[news_section_show_subtitle]" value="1" {{ ($settings['news_section_show_subtitle'] ?? '0') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tampilkan subtitle di section berita</label>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-4">Pengaturan Warna</h4>
                        <p class="text-muted mb-4">Kustomisasi warna untuk section berita.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Primary Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[news_section_primary_color]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['news_section_primary_color'] ?? '#1a246a' }}">
                                    <span class="text-muted">{{ $settings['news_section_primary_color'] ?? '#1a246a' }}</span>
                                </div>
                                <small class="text-muted">Warna utama untuk judul dan heading</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Accent Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[news_section_accent_color]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['news_section_accent_color'] ?? '#f97316' }}">
                                    <span class="text-muted">{{ $settings['news_section_accent_color'] ?? '#f97316' }}</span>
                                </div>
                                <small class="text-muted">Warna aksen untuk tombol dan highlight</small>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-4">Pengaturan Lainnya</h4>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Empty Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[news_empty_text]" class="form-control" value="{{ $settings['news_empty_text'] ?? 'Data kosong.' }}">
                                <small class="text-muted">Teks yang ditampilkan jika tidak ada berita</small>
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
    $('#newsSettingsForm').on('submit', function(e) {
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
