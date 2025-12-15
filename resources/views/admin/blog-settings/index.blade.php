@extends('layouts.dashboard.dashboard')

@section('title', 'Blog Settings - Index Page')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Page Header -->
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center mb-10">
            <div class="flex-grow-1 me-5">
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    Blog Index Page Settings
                </h1>
                <p class="text-muted fs-6 fw-semibold mt-2">
                    Configure layout, colors, and appearance for your blog index page
                </p>
            </div>
            <div class="d-flex gap-3">
                <a href="{{ route('blog.index') }}" target="_blank" class="btn btn-sm btn-light-primary">
                    <i class="fas fa-eye"></i> Preview Blog
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
        <form method="POST" action="{{ route('blog.settings.update') }}">
            @csrf

            <!-- Layout Settings Card -->
            @if(isset($settings['layout']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">Layout Settings</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($settings['layout'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_', '', $setting->key))) }}</label>
                                
                                @if($setting->key === 'blog_layout_style')
                                    <select class="form-select" name="settings[{{ $setting->key }}]">
                                        <option value="grid" {{ $setting->value == 'grid' ? 'selected' : '' }}>Modern Grid</option>
                                        <option value="list" {{ $setting->value == 'list' ? 'selected' : '' }}>Classic List</option>
                                        <option value="masonry" {{ $setting->value == 'masonry' ? 'selected' : '' }}>Masonry Cards</option>
                                        <option value="magazine" {{ $setting->value == 'magazine' ? 'selected' : '' }}>Magazine Style</option>
                                    </select>
                                @elseif($setting->type === 'boolean')
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="settings[{{ $setting->key }}]" value="1" {{ $setting->value == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label text-muted">
                                            {{ $setting->value == '1' ? 'Enabled' : 'Disabled' }}
                                        </label>
                                    </div>
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

            <!-- Hero Section Settings Card -->
            @if(isset($settings['hero']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">Hero Section</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($settings['hero'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_hero_', '', $setting->key))) }}</label>
                                
                                @if($setting->type === 'color')
                                    <input type="color" class="form-control form-control-color" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                @elseif($setting->type === 'boolean')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="settings[{{ $setting->key }}]" value="1" {{ $setting->value == '1' ? 'checked' : '' }}>
                                    </div>
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

            <!-- Card Styling Settings -->
            @if(isset($settings['cards']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">Card Styling</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($settings['cards'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_card_', '', $setting->key))) }}</label>
                                
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

            <!-- Typography Settings -->
            @if(isset($settings['typography']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">Typography</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($settings['typography'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_', '', $setting->key))) }}</label>
                                
                                @if(str_contains($setting->key, 'font_family'))
                                    <select class="form-select" name="settings[{{ $setting->key }}]">
                                        <option value="Inter" {{ $setting->value == 'Inter' ? 'selected' : '' }}>Inter</option>
                                        <option value="Roboto" {{ $setting->value == 'Roboto' ? 'selected' : '' }}>Roboto</option>
                                        <option value="Poppins" {{ $setting->value == 'Poppins' ? 'selected' : '' }}>Poppins</option>
                                        <option value="Outfit" {{ $setting->value == 'Outfit' ? 'selected' : '' }}>Outfit</option>
                                        <option value="Montserrat" {{ $setting->value == 'Montserrat' ? 'selected' : '' }}>Montserrat</option>
                                        <option value="Open Sans" {{ $setting->value == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                        <option value="Lato" {{ $setting->value == 'Lato' ? 'selected' : '' }}>Lato</option>
                                        <option value="Nunito" {{ $setting->value == 'Nunito' ? 'selected' : '' }}>Nunito</option>
                                    </select>
                                @elseif($setting->type === 'color')
                                    <input type="color" class="form-control form-control-color w-100" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
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

            <!-- Sidebar Settings -->
            @if(isset($settings['sidebar']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">Sidebar</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($settings['sidebar'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_sidebar_', '', $setting->key))) }}</label>
                                
                                @if($setting->type === 'color')
                                    <input type="color" class="form-control form-control-color" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
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

            <!-- Pagination Settings -->
            @if(isset($settings['pagination']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">Pagination</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($settings['pagination'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_pagination_', '', $setting->key))) }}</label>
                                
                                @if(str_contains($setting->key, '_bg') || str_contains($setting->key, '_border') || str_contains($setting->key, '_color'))
                                    <input type="color" class="form-control form-control-color w-100" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
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

            <!-- General Settings -->
            @if(isset($settings['general']))
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title">General</h3>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        @foreach($settings['general'] as $setting)
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', str_replace('blog_', '', $setting->key))) }}</label>
                                <input type="text" class="form-control" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
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
    console.log('Blog settings confirmation script loaded');
    
    const form = document.querySelector('form[action="{{ route('blog.settings.update') }}"]');
    
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
            title: 'Simpan Pengaturan?',
            text: "Apakah Anda yakin ingin menyimpan pengaturan blog ini?",
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
