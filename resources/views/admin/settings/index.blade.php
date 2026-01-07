@extends('layouts.dashboard.dashboard')

@section('title', 'Pengaturan Umum')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Page Header -->
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center mb-8">
            <div class="flex-grow-1 me-5">
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    <i class="fas fa-cog text-primary me-3"></i>Pengaturan Umum
                </h1>
                <p class="text-muted fs-6 fw-semibold mt-2 mb-0">
                    Kelola pengaturan dasar website
                </p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-6" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Quick Links -->
        <div class="row g-4 mb-8">
            <div class="col-6 col-md-3">
                <a href="{{ route('home-settings.hero') }}" class="card card-hover h-100 border-0 shadow-sm">
                    <div class="card-body text-center py-4">
                        <div class="symbol symbol-50px mb-3">
                            <span class="symbol-label bg-light-primary">
                                <i class="fas fa-home text-primary fs-2"></i>
                            </span>
                        </div>
                        <h6 class="mb-0">Homepage</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('blog.settings.index') }}" class="card card-hover h-100 border-0 shadow-sm">
                    <div class="card-body text-center py-4">
                        <div class="symbol symbol-50px mb-3">
                            <span class="symbol-label bg-light-success">
                                <i class="fas fa-newspaper text-success fs-2"></i>
                            </span>
                        </div>
                        <h6 class="mb-0">Blog</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('admin.teacher-settings.index') }}" class="card card-hover h-100 border-0 shadow-sm">
                    <div class="card-body text-center py-4">
                        <div class="symbol symbol-50px mb-3">
                            <span class="symbol-label bg-light-warning">
                                <i class="fas fa-chalkboard-teacher text-warning fs-2"></i>
                            </span>
                        </div>
                        <h6 class="mb-0">Dosen</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('menus.index') }}" class="card card-hover h-100 border-0 shadow-sm">
                    <div class="card-body text-center py-4">
                        <div class="symbol symbol-50px mb-3">
                            <span class="symbol-label bg-light-info">
                                <i class="fas fa-bars text-info fs-2"></i>
                            </span>
                        </div>
                        <h6 class="mb-0">Menu</h6>
                    </div>
                </a>
            </div>
        </div>

        <!-- Settings Form -->
        <form method="POST" action="{{ route('admin.settings.update') }}" id="settings-form">
            @csrf
            
            <div class="row g-6">
                @forelse($settings as $group => $config)
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="{{ $config['icon'] }} text-primary me-2"></i>
                                {{ $config['title'] }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">{{ $config['description'] }}</p>
                            
                            @foreach($config['items'] as $setting)
                            <div class="mb-4">
                                <label class="form-label fw-semibold">{{ $setting->label }}</label>
                                
                                @if($setting->key === 'site_logo')
                                    {{-- Logo with Media Picker --}}
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="site_logo_input"
                                               name="settings[{{ $setting->key }}]" 
                                               value="{{ $setting->value }}" placeholder="/storage/logo.png">
                                        <button type="button" class="btn btn-primary" onclick="openMediaPicker()">
                                            <i class="fas fa-image me-1"></i>Pilih
                                        </button>
                                    </div>
                                    @if($setting->value)
                                    <div id="logo-preview" class="mt-3 p-3 bg-light rounded text-center">
                                        <img src="{{ $setting->value }}" alt="Logo" style="max-height: 80px; max-width: 100%;">
                                    </div>
                                    @else
                                    <div id="logo-preview" class="mt-3 p-3 bg-light rounded text-center" style="display:none;">
                                        <img src="" alt="Logo" style="max-height: 80px; max-width: 100%;">
                                    </div>
                                    @endif
                                @elseif(str_contains($setting->key, 'facebook') || str_contains($setting->key, 'instagram') || str_contains($setting->key, 'youtube') || str_contains($setting->key, 'linkedin') || str_contains($setting->key, 'twitter'))
                                    <div class="input-group">
                                        @php
                                            $iconMap = [
                                                'facebook' => 'fab fa-facebook',
                                                'instagram' => 'fab fa-instagram',
                                                'youtube' => 'fab fa-youtube',
                                                'linkedin' => 'fab fa-linkedin',
                                                'twitter' => 'fab fa-twitter',
                                            ];
                                            $icon = 'fas fa-link';
                                            foreach($iconMap as $key => $val) {
                                                if(str_contains($setting->key, $key)) { $icon = $val; break; }
                                            }
                                        @endphp
                                        <span class="input-group-text"><i class="{{ $icon }}"></i></span>
                                        <input type="url" class="form-control" 
                                               name="settings[{{ $setting->key }}]" 
                                               value="{{ $setting->value }}" placeholder="https://...">
                                    </div>
                                @elseif(str_contains($setting->key, 'description'))
                                    <textarea class="form-control" rows="2" 
                                              name="settings[{{ $setting->key }}]">{{ $setting->value }}</textarea>
                                @elseif(str_contains($setting->key, 'email'))
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" 
                                               name="settings[{{ $setting->key }}]" 
                                               value="{{ $setting->value }}">
                                    </div>
                                @elseif(str_contains($setting->key, 'phone'))
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control" 
                                               name="settings[{{ $setting->key }}]" 
                                               value="{{ $setting->value }}">
                                    </div>
                                @elseif(str_contains($setting->key, 'address'))
                                    <textarea class="form-control" rows="2" 
                                              name="settings[{{ $setting->key }}]" placeholder="Alamat lengkap...">{{ $setting->value }}</textarea>
                                @else
                                    <input type="text" class="form-control" 
                                           name="settings[{{ $setting->key }}]" 
                                           value="{{ $setting->value }}">
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center py-10">
                            <i class="fas fa-check-circle fa-4x text-success mb-4"></i>
                            <h4>Tidak Ada Pengaturan</h4>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            @if(count($settings) > 0)
            <div class="d-flex justify-content-end mt-6">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>Simpan Semua Pengaturan
                </button>
            </div>
            @endif
        </form>

    </div>
</div>

<!-- Media Picker Modal -->
<div class="modal fade" id="mediaPickerModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="fas fa-images me-2"></i>Pilih Logo dari Media</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="media-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 12px; max-height: 400px; overflow-y: auto;">
                    <div class="text-center py-5">
                        <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                        <p class="text-muted mt-2">Memuat media...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card-hover { transition: all 0.2s ease; }
.card-hover:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important; }
.media-item { cursor: pointer; border: 3px solid transparent; border-radius: 8px; transition: all 0.2s; }
.media-item:hover { border-color: #3b82f6; transform: scale(1.05); }
.media-item.selected { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.3); }
</style>

@push('scripts')
<script>
function openMediaPicker() {
    const modal = new bootstrap.Modal(document.getElementById('mediaPickerModal'));
    modal.show();
    loadMedia();
}

function loadMedia() {
    fetch(baseUrl + '/media/picker')
        .then(r => r.json())
        .then(response => {
            const grid = document.getElementById('media-grid');
            const data = response.media?.data || response.media || [];
            
            if (data.length === 0) {
                grid.innerHTML = '<div class="text-center py-5 col-span-full"><p class="text-muted">Belum ada media. Upload dulu di menu Media.</p></div>';
                return;
            }
            
            let html = '';
            data.forEach(item => {
                const url = item.large || item.medium || item.thumb;
                const thumbUrl = item.thumb || url;
                html += `
                    <div class="media-item" onclick="selectLogo('${url}', this)">
                        <img src="${thumbUrl}" alt="${item.filename || 'Image'}" 
                             style="width: 100%; height: 100px; object-fit: cover; border-radius: 6px;">
                    </div>
                `;
            });
            grid.innerHTML = html || '<div class="text-center py-5"><p class="text-muted">Tidak ada gambar.</p></div>';
        })
        .catch(() => {
            document.getElementById('media-grid').innerHTML = '<div class="text-center py-5"><p class="text-danger">Gagal memuat media.</p></div>';
        });
}

function selectLogo(url, el) {
    document.getElementById('site_logo_input').value = url;
    const preview = document.getElementById('logo-preview');
    preview.style.display = 'block';
    preview.querySelector('img').src = url;
    
    document.querySelectorAll('.media-item').forEach(i => i.classList.remove('selected'));
    el.classList.add('selected');
    
    setTimeout(() => bootstrap.Modal.getInstance(document.getElementById('mediaPickerModal')).hide(), 300);
}

document.getElementById('settings-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Simpan Pengaturan?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
            this.submit();
        }
    });
});
</script>
@endpush
@endsection
