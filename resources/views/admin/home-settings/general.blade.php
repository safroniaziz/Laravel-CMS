@extends('layouts.dashboard.dashboard')

@section('title', 'General Homepage Settings')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #1a246a, #2d3a8c); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                            <i class="fas fa-cog text-white fs-3"></i>
                        </div>
                        <div>
                            <h1 class="fs-2 fw-bold mb-0">General Homepage Settings</h1>
                            <span class="text-muted fs-7">Pengaturan umum lainnya</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Pengaturan Umum</h3></div>
                <div class="card-body">
                    <form id="generalSettingsForm">
                        @csrf
                        <input type="hidden" name="type" value="homepage">
                        <input type="hidden" name="group" value="homepage">
                        
                        {{-- Show Section Toggles --}}
                        <h4 class="mb-4">Toggle Tampilan Section</h4>
                        <p class="text-muted mb-4">Aktifkan atau nonaktifkan tampilan section di homepage.</p>

                        <div class="row mb-4">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Academic Section</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[academic_section_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[academic_section_show]" value="1" {{ ($settings['academic_section_show'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tampilkan section Informasi Akademik</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Dosen Section</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[dosen_section_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[dosen_section_show]" value="1" {{ ($settings['dosen_section_show'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tampilkan section Dosen/Staf Pengajar</label>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-4">Judul Section</h4>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Dosen Section Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[home_dosen_title]" class="form-control" value="{{ $settings['home_dosen_title'] ?? 'DOSEN SISTEM INFORMASI' }}">
                                <small class="text-muted">Judul untuk section Dosen/Staf Pengajar</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Video Section Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[home_video_title]" class="form-control" value="{{ $settings['home_video_title'] ?? '' }}">
                                <small class="text-muted">Judul untuk section video (jika ada)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Program Info Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[home_program_title]" class="form-control" value="{{ $settings['home_program_title'] ?? '' }}">
                                <small class="text-muted">Judul untuk section informasi program studi</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Alumni Section Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[home_alumni_title]" class="form-control" value="{{ $settings['home_alumni_title'] ?? 'Informasi Akademik' }}">
                                <small class="text-muted">Judul untuk section informasi alumni</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Requirements Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[home_requirements_title]" class="form-control" value="{{ $settings['home_requirements_title'] ?? 'Persyaratan Masuk' }}">
                                <small class="text-muted">Judul untuk section persyaratan masuk</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Testimonial Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[home_testimonial_title]" class="form-control" value="{{ $settings['home_testimonial_title'] ?? 'Apa Kata Alumni Kami' }}">
                                <small class="text-muted">Judul untuk section testimonial alumni</small>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-4">Informasi Akademik</h4>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Layout Style</label>
                            <div class="col-lg-9">
                                <select name="settings[academic_layout_style]" class="form-select">
                                    <option value="featured_stack" {{ ($settings['academic_layout_style'] ?? 'featured_stack') == 'featured_stack' ? 'selected' : '' }}>Featured & Stack (Default)</option>
                                    <option value="timeline" {{ ($settings['academic_layout_style'] ?? '') == 'timeline' ? 'selected' : '' }}>Timeline View</option>
                                    <option value="agenda" {{ ($settings['academic_layout_style'] ?? '') == 'agenda' ? 'selected' : '' }}>Agenda List</option>
                                    <option value="schedule" {{ ($settings['academic_layout_style'] ?? '') == 'schedule' ? 'selected' : '' }}>Schedule Cards</option>
                                </select>
                                <small class="text-muted">Pilih tampilan layout untuk section informasi akademik</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[academic_section_icon]" class="form-control" value="{{ $settings['academic_section_icon'] ?? '' }}" placeholder="fas fa-graduation-cap">
                                <small class="text-muted">Icon FontAwesome untuk section akademik (contoh: fas fa-graduation-cap)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Badge Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[academic_section_badge_text]" class="form-control" value="{{ $settings['academic_section_badge_text'] ?? 'INFORMASI AKADEMIK' }}">
                                <small class="text-muted">Teks badge kecil di atas judul</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Section Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[academic_section_title]" class="form-control" value="{{ $settings['academic_section_title'] ?? 'Kegiatan & Program Akademik' }}">
                                <small class="text-muted">Judul utama section Informasi Akademik</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Section Subtitle</label>
                            <div class="col-lg-9">
                                <textarea name="settings[academic_section_subtitle]" class="form-control" rows="3">{{ $settings['academic_section_subtitle'] ?? 'Informasi terkini seputar kegiatan akademik, program mahasiswa, dan pencapaian yang membanggakan Program Studi Sistem Informasi' }}</textarea>
                                <small class="text-muted">Deskripsi singkat di bawah judul section</small>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        <h4 class="mb-4">Warna Akademik Section</h4>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Primary Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[academic_section_primary_color]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['academic_section_primary_color'] ?? '#1a246a' }}">
                                    <span class="text-muted">{{ $settings['academic_section_primary_color'] ?? '#1a246a' }}</span>
                                </div>
                                <small class="text-muted">Warna utama untuk judul dan heading</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Accent Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[academic_section_accent_color]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['academic_section_accent_color'] ?? '#f59e0b' }}">
                                    <span class="text-muted">{{ $settings['academic_section_accent_color'] ?? '#f59e0b' }}</span>
                                </div>
                                <small class="text-muted">Warna aksen untuk tombol dan highlight</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Background Gradient Start</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[academic_section_bg_start]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['academic_section_bg_start'] ?? '#f8fafc' }}">
                                    <span class="text-muted">{{ $settings['academic_section_bg_start'] ?? '#f8fafc' }}</span>
                                </div>
                                <small class="text-muted">Warna awal gradient background</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Background Gradient End</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[academic_section_bg_end]" class="form-control form-control-color" style="width:60px;height:40px;" value="{{ $settings['academic_section_bg_end'] ?? '#ffffff' }}">
                                    <span class="text-muted">{{ $settings['academic_section_bg_end'] ?? '#ffffff' }}</span>
                                </div>
                                <small class="text-muted">Warna akhir gradient background</small>
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
    $('#generalSettingsForm').on('submit', function(e) {
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
