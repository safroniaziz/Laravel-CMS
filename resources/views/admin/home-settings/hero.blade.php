@extends('layouts.dashboard.dashboard')

@section('title', 'Hero Slider Settings')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            {{-- Page Header --}}
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center me-4">
                            <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #1a246a, #2d3a8c); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                                <i class="fas fa-image text-white fs-3"></i>
                            </div>
                            <div>
                                <h1 class="fs-2 fw-bold mb-0">Hero Slider Settings</h1>
                                <span class="text-muted fs-7">Kelola pengaturan hero slider di homepage</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Settings Form --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Hero Slider</h3>
                </div>
                <div class="card-body">
                    <form id="heroSettingsForm">
                        @csrf
                        <input type="hidden" name="type" value="homepage">
                        <input type="hidden" name="group" value="homepage">
                        
                        {{-- Show Section Toggle --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Section</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[hero_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[hero_show]" value="1" {{ ($settings['hero_show'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tampilkan Hero Slider di Homepage</label>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-6"></div>
                        
                        {{-- Layout Style --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Layout Style</label>
                            <div class="col-lg-9">
                                <select name="settings[hero_layout_style]" class="form-select">
                                    <option value="current" {{ ($settings['hero_layout_style'] ?? 'current') == 'current' ? 'selected' : '' }}>Current Split Layout (Gambar & Teks Berdampingan)</option>
                                    <option value="centered" {{ ($settings['hero_layout_style'] ?? '') == 'centered' ? 'selected' : '' }}>Centered Layout (Teks di Tengah)</option>
                                    <option value="minimal" {{ ($settings['hero_layout_style'] ?? '') == 'minimal' ? 'selected' : '' }}>Minimal Layout (Sederhana)</option>
                                    <option value="fullscreen" {{ ($settings['hero_layout_style'] ?? '') == 'fullscreen' ? 'selected' : '' }}>Fullscreen Layout (Gambar Full Layar)</option>
                                </select>
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-info-circle me-1"></i>Pilih tampilan layout hero slider. Konten slider dikelola di menu <strong>Slider Images</strong>.
                                </small>
                            </div>
                        </div>

                        {{-- Colors --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Color Settings</h4>
                        <p class="text-muted mb-4">Pengaturan warna untuk hero slider. Warna ini berlaku untuk semua slider.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Primary Color</label>
                            <div class="col-lg-9">
                                <input type="color" name="settings[hero_primary_color]" class="form-control form-control-color" value="{{ $settings['hero_primary_color'] ?? '#1a246a' }}">
                                <small class="text-muted">Warna utama untuk teks badge akreditasi di gambar slider</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Accent Color</label>
                            <div class="col-lg-9">
                                <input type="color" name="settings[hero_accent_color]" class="form-control form-control-color" value="{{ $settings['hero_accent_color'] ?? '#fbbf24' }}">
                                <small class="text-muted">Warna aksen untuk tombol CTA, subtitle badge, dan highlight teks (kuning/orange)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient Start</label>
                            <div class="col-lg-9">
                                <input type="color" name="settings[hero_gradient_start]" class="form-control form-control-color" value="{{ $settings['hero_gradient_start'] ?? '#0f172a' }}">
                                <small class="text-muted">Warna awal background gradient (pojok kiri atas)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient Mid</label>
                            <div class="col-lg-9">
                                <input type="color" name="settings[hero_gradient_mid]" class="form-control form-control-color" value="{{ $settings['hero_gradient_mid'] ?? '#1a246a' }}">
                                <small class="text-muted">Warna tengah background gradient</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient End</label>
                            <div class="col-lg-9">
                                <input type="color" name="settings[hero_gradient_end]" class="form-control form-control-color" value="{{ $settings['hero_gradient_end'] ?? '#151945' }}">
                                <small class="text-muted">Warna akhir background gradient (pojok kanan bawah)</small>
                            </div>
                        </div>

                        {{-- Secondary Button --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Secondary Button</h4>
                        <p class="text-muted mb-4">Tombol transparan tambahan yang biasanya mengarah ke halaman About atau informasi selengkapnya.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[hero_secondary_button_text]" class="form-control" value="{{ $settings['hero_secondary_button_text'] ?? 'Pelajari Lebih Lanjut' }}">
                                <small class="text-muted">Teks tombol sekunder</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Link</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[hero_secondary_button_link]" class="form-control" value="{{ $settings['hero_secondary_button_link'] ?? '/page/about' }}">
                                <small class="text-muted">Link tujuan tombol sekunder. Contoh: /page/about</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Show Button</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="settings[hero_secondary_button_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[hero_secondary_button_show]" value="1" {{ ($settings['hero_secondary_button_show'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2">Aktifkan tombol sekunder</label>
                                </div>
                            </div>
                        </div>

                        {{-- Fallback Content --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Fallback Content (Jika Slider Kosong)</h4>
                        <p class="text-muted mb-4">Konten default yang akan ditampilkan jika tidak ada slider yang aktif di database.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[home_hero_title]" class="form-control" value="{{ $settings['home_hero_title'] ?? 'PROGRAM STUDI SISTEM INFORMASI' }}">
                                <small class="text-muted">Judul utama halaman jika tidak ada slider</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Subtitle</label>
                            <div class="col-lg-9">
                                <textarea name="settings[home_hero_subtitle]" class="form-control" rows="3">{{ $settings['home_hero_subtitle'] ?? '' }}</textarea>
                                <small class="text-muted">Deskripsi atau subtitle di bawah judul</small>
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
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#heroSettingsForm').on('submit', function(e) {
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
</script>
@endpush
