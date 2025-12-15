@extends('layouts.dashboard.dashboard')

@section('title', 'Blog Settings - Detail Page')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Page Header -->
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center mb-10">
            <div class="flex-grow-1 me-5">
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    Blog Detail Page Settings
                </h1>
                <p class="text-muted fs-6 fw-semibold mt-2">
                    Configure hero section, content styling, author card, and social sharing for blog detail pages
                </p>
            </div>
            <div class="d-flex gap-3">
                <a href="{{ route('blog.settings.index') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left"></i> Index Page Settings
                </a>
            </div>
        </div>

        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        @endif

        <!-- Settings Form -->
        <form method="POST" action="{{ route('blog.settings.detail.update') }}">
            @csrf

            <!-- Detail Hero Section -->
            @if(isset($detailSettings['detail_hero']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">Hero Section</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($detailSettings['detail_hero'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_detail_hero_', '', $setting->key))) }}</label>
                                <input type="color" class="form-control form-control-color" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                <small class="form-text text-muted">{{ $setting->key }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Content Styling -->
            @if(isset($detailSettings['detail_content']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">Content Styling (H2, H3, Blockquotes, Code)</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($detailSettings['detail_content'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_detail_', '', str_replace('content_', '', str_replace('blockquote_', 'BQ ', str_replace('code_', 'Code ', $setting->key)))))) }}</label>
                                
                                @if($setting->type === 'color')
                                    <input type="color" class="form-control form-control-color" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                @elseif($setting->type === 'number')
                                    <input type="number" class="form-control" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                @else
                                    <input type="text" class="form-control" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                @endif
                                <small class="form-text text-muted">{{ $setting->key }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Author Card -->
            @if(isset($detailSettings['detail_author']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">Author Card</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($detailSettings['detail_author'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_detail_author_', '', $setting->key))) }}</label>
                                <input type="color" class="form-control form-control-color" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                <small class="form-text text-muted">{{ $setting->key }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Social Sharing -->
            @if(isset($detailSettings['detail_social']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">Social Sharing Section</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($detailSettings['detail_social'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_detail_share_', '', $setting->key))) }}</label>
                                <input type="color" class="form-control form-control-color" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                <small class="form-text text-muted">{{ $setting->key }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Save Settings
                </button>
            </div>

        </form>

    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Blog detail settings confirmation script loaded');
    
    const form = document.querySelector('form[action="{{ route('blog.settings.detail.update') }}"]');
    
    if (!form) {
        console.error('Form not found!');
        return;
    }
    
    console.log('Form found, adding submit listener');
    
    form.addEventListener('submit', function(e) {
        console.log('Form submit detected, preventing default');
        e.preventDefault();
        e.stopPropagation();
        
        Swal.fire({
            title: 'Simpan Pengaturan Detail?',
            text: "Apakah Anda yakin ingin menyimpan pengaturan halaman detail blog ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('User confirmed, showing loading');
                // Show loading
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu sementara kami menyimpan pengaturan Anda',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Remove event listener to prevent loop
                form.removeEventListener('submit', arguments.callee);
                console.log('Submitting form');
                form.submit();
            } else {
                console.log('User cancelled');
            }
        });
    });
});
</script>
@endpush
@endsection
