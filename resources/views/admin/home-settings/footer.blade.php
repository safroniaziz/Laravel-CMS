@extends('layouts.dashboard.dashboard')

@section('title', 'Footer Settings')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            {{-- Page Header --}}
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #1a246a, #151945); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                            <i class="fas fa-shoe-prints text-white fs-3"></i>
                        </div>
                        <div>
                            <h1 class="fs-2 fw-bold mb-0">Footer Settings</h1>
                            <span class="text-muted fs-7">Pengaturan Footer di semua halaman website</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Settings Form --}}
            <div class="card">
                <div class="card-header"><h3 class="card-title">Pengaturan Footer</h3></div>
                <div class="card-body">
                    <form id="footerSettingsForm">
                        @csrf
                        <input type="hidden" name="type" value="homepage">
                        <input type="hidden" name="group" value="homepage">
                        
                        {{-- Show Section Toggle --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Tampilkan Footer</label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="settings[footer_show]" value="0">
                                    <input class="form-check-input" type="checkbox" name="settings[footer_show]" value="1" {{ ($settings['footer_show'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tampilkan Footer di semua halaman</label>
                                </div>
                            </div>
                        </div>

                        {{-- Logo & Description Section --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Logo & Deskripsi</h4>
                        <p class="text-muted mb-4">Pengaturan identitas dan deskripsi footer.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Logo Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_logo_text]" class="form-control" value="{{ $settings['footer_logo_text'] ?? 'SISTEM INFORMASI' }}">
                                <small class="text-muted">Teks logo utama di footer (nama program studi dsb.)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Logo Subtext</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_logo_subtext]" class="form-control" value="{{ $settings['footer_logo_subtext'] ?? 'UNIVERSITAS BENGKULU' }}">
                                <small class="text-muted">Teks kecil di bawah logo (nama universitas dsb.)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Description</label>
                            <div class="col-lg-9">
                                <textarea name="settings[footer_description]" class="form-control" rows="2">{{ $settings['footer_description'] ?? 'Leading the future of digital innovation and information systems education in Indonesia.' }}</textarea>
                                <small class="text-muted">Deskripsi singkat tentang institusi/program studi</small>
                            </div>
                        </div>

                        {{-- Contact Information Section --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Informasi Kontak</h4>
                        <p class="text-muted mb-4">Alamat dan detail kontak yang ditampilkan di footer.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Alamat</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_address]" class="form-control" value="{{ $settings['footer_address'] ?? 'Jl. W.R. Supratman Kandang Limun Bengkulu 38371' }}">
                                <small class="text-muted">Alamat lengkap kampus/kantor</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Telepon</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_phone]" class="form-control" value="{{ $settings['footer_phone'] ?? '(0737) 21118' }}">
                                <small class="text-muted">Nomor telepon yang bisa dihubungi</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Email</label>
                            <div class="col-lg-9">
                                <input type="email" name="settings[footer_email]" class="form-control" value="{{ $settings['footer_email'] ?? 'si@unib.ac.id' }}">
                                <small class="text-muted">Alamat email resmi</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Website</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_website]" class="form-control" value="{{ $settings['footer_website'] ?? 'si.unib.ac.id' }}">
                                <small class="text-muted">Domain website resmi (tanpa https://)</small>
                            </div>
                        </div>

                        {{-- Operating Hours / Jam Operasional --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Jam Operasional</h4>
                        <p class="text-muted mb-4">Pengaturan jam operasional yang ditampilkan di footer.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Judul Section</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_hours_title]" class="form-control" value="{{ $settings['footer_hours_title'] ?? 'JAM OPERASIONAL' }}">
                                <small class="text-muted">Judul untuk section jam operasional</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Hari Kerja (Label)</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_hours_weekday_label]" class="form-control" value="{{ $settings['footer_hours_weekday_label'] ?? 'Senin - Jumat' }}">
                                <small class="text-muted">Label untuk hari kerja (contoh: Senin - Jumat)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Hari Kerja (Jam)</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_hours_weekday_time]" class="form-control" value="{{ $settings['footer_hours_weekday_time'] ?? '08:00 - 16:00 WIB' }}">
                                <small class="text-muted">Jam operasional hari kerja</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Sabtu (Label)</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_hours_saturday_label]" class="form-control" value="{{ $settings['footer_hours_saturday_label'] ?? 'Sabtu' }}">
                                <small class="text-muted">Label untuk hari Sabtu</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Sabtu (Jam)</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_hours_saturday_time]" class="form-control" value="{{ $settings['footer_hours_saturday_time'] ?? '08:00 - 12:00 WIB' }}">
                                <small class="text-muted">Jam operasional hari Sabtu</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Hari Libur (Label)</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_hours_holiday_label]" class="form-control" value="{{ $settings['footer_hours_holiday_label'] ?? 'Minggu & Hari Libur' }}">
                                <small class="text-muted">Label untuk hari libur</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Hari Libur (Status)</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_hours_holiday_time]" class="form-control" value="{{ $settings['footer_hours_holiday_time'] ?? 'Tutup' }}">
                                <small class="text-muted">Status untuk hari libur (contoh: Tutup, Libur)</small>
                            </div>
                        </div>

                        {{-- Section Titles --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Section Titles</h4>
                        <p class="text-muted mb-4">Judul untuk setiap kolom di footer.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Quick Links Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_quicklinks_title]" class="form-control" value="{{ $settings['footer_quicklinks_title'] ?? 'QUICK LINKS' }}">
                                <small class="text-muted">Judul untuk kolom Quick Links</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Contact Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_contact_title]" class="form-control" value="{{ $settings['footer_contact_title'] ?? 'CONTACT' }}">
                                <small class="text-muted">Judul untuk kolom Contact</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Copyright Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="settings[footer_copyright_text]" class="form-control" value="{{ $settings['footer_copyright_text'] ?? 'All Rights Reserved' }}">
                                <small class="text-muted">Teks copyright di bagian bawah footer (tahun akan otomatis ditambahkan)</small>
                            </div>
                        </div>

                        {{-- Color Settings --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Warna Background</h4>
                        <p class="text-muted mb-4">Pengaturan gradient warna background footer.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient Start</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[footer_bg_gradient_start]" class="form-control form-control-color" value="{{ $settings['footer_bg_gradient_start'] ?? '#0f172a' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['footer_bg_gradient_start'] ?? '#0f172a' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna awal gradient background footer (bagian atas)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient Mid</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[footer_bg_gradient_mid]" class="form-control form-control-color" value="{{ $settings['footer_bg_gradient_mid'] ?? '#1a246a' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['footer_bg_gradient_mid'] ?? '#1a246a' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna tengah gradient background footer</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient End</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[footer_bg_gradient_end]" class="form-control form-control-color" value="{{ $settings['footer_bg_gradient_end'] ?? '#151945' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['footer_bg_gradient_end'] ?? '#151945' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna akhir gradient background footer (bagian bawah)</small>
                            </div>
                        </div>

                        {{-- Text Colors --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Warna Teks</h4>
                        <p class="text-muted mb-4">Pengaturan warna teks dan elemen di footer.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Text Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[footer_text_color]" class="form-control form-control-color" value="{{ $settings['footer_text_color'] ?? '#d0d0d0' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['footer_text_color'] ?? '#d0d0d0' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna teks umum (deskripsi, paragraph)</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Heading Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[footer_heading_color]" class="form-control form-control-color" value="{{ $settings['footer_heading_color'] ?? '#ffffff' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['footer_heading_color'] ?? '#ffffff' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna judul kolom dan heading</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">Accent Color</label>
                            <div class="col-lg-9">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="settings[footer_accent_color]" class="form-control form-control-color" value="{{ $settings['footer_accent_color'] ?? '#4c5db5' }}" style="width: 60px; height: 40px;">
                                    <input type="text" class="form-control" value="{{ $settings['footer_accent_color'] ?? '#4c5db5' }}" readonly style="max-width: 120px;">
                                </div>
                                <small class="text-muted">Warna aksen untuk link hover dan elemen interaktif</small>
                            </div>
                        </div>

                        {{-- Social Media --}}
                        <div class="separator my-6"></div>
                        <h4 class="mb-2">Social Media</h4>
                        <p class="text-muted mb-4">Link ke akun media sosial resmi. Kosongkan jika tidak ingin ditampilkan.</p>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                <i class="fab fa-facebook text-primary me-2"></i>Facebook URL
                            </label>
                            <div class="col-lg-9">
                                <input type="url" name="settings[footer_facebook_url]" class="form-control" value="{{ $settings['footer_facebook_url'] ?? '' }}" placeholder="https://facebook.com/...">
                                <small class="text-muted">URL lengkap halaman Facebook</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                <i class="fab fa-instagram text-danger me-2"></i>Instagram URL
                            </label>
                            <div class="col-lg-9">
                                <input type="url" name="settings[footer_instagram_url]" class="form-control" value="{{ $settings['footer_instagram_url'] ?? '' }}" placeholder="https://instagram.com/...">
                                <small class="text-muted">URL lengkap profil Instagram</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                <i class="fab fa-linkedin text-info me-2"></i>LinkedIn URL
                            </label>
                            <div class="col-lg-9">
                                <input type="url" name="settings[footer_linkedin_url]" class="form-control" value="{{ $settings['footer_linkedin_url'] ?? '' }}" placeholder="https://linkedin.com/school/...">
                                <small class="text-muted">URL lengkap halaman LinkedIn</small>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                <i class="fab fa-youtube text-danger me-2"></i>YouTube URL
                            </label>
                            <div class="col-lg-9">
                                <input type="url" name="settings[footer_youtube_url]" class="form-control" value="{{ $settings['footer_youtube_url'] ?? '' }}" placeholder="https://youtube.com/@...">
                                <small class="text-muted">URL lengkap channel YouTube</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan Pengaturan</button>
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
    $('#footerSettingsForm').on('submit', function(e) {
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
