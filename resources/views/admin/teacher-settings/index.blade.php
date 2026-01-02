@extends('layouts.dashboard.dashboard')

@section('title', 'Teacher Settings')
@section('menu', 'Teacher Settings')

@section('link')
    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-gray-700">Teacher Settings</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <form id="settingsForm" method="POST" action="{{ route('admin.teacher-settings.update') }}">
            @csrf
            
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h3>General Settings</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Page Layout</label>
                        <div class="col-lg-9">
                            <select name="teacher_page_layout" class="form-select form-select-solid">
                                <option value="grid" {{ ($settings['teacher_page_layout'] ?? 'grid') == 'grid' ? 'selected' : '' }}>Grid (4-column)</option>
                                <option value="stats_cards" {{ ($settings['teacher_page_layout'] ?? '') == 'stats_cards' ? 'selected' : '' }}>Stats Cards (3-column with stats)</option>
                                <option value="featured_grid" {{ ($settings['teacher_page_layout'] ?? '') == 'featured_grid' ? 'selected' : '' }}>Featured Grid (Featured + sidebar)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Page Title</label>
                        <div class="col-lg-9">
                            <input type="text" name="teacher_page_title" class="form-control form-control-solid" value="{{ $settings['teacher_page_title'] ?? 'Tim Pengajar Kami' }}" required />
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Page Subtitle</label>
                        <div class="col-lg-9">
                            <textarea name="teacher_page_subtitle" class="form-control form-control-solid" rows="2">{{ $settings['teacher_page_subtitle'] ?? 'Dosen berpengalaman dan berkualitas siap membimbing Anda' }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Items Per Page</label>
                        <div class="col-lg-9">
                            <input type="number" name="teacher_page_per_page" class="form-control form-control-solid" value="{{ $settings['teacher_page_per_page'] ?? 8 }}" min="4" max="20" required />
                            <div class="form-text">Number of teachers loaded per AJAX request (recommended: 8)</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Hero Section</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Enable Hero</label>
                        <div class="col-lg-9">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="teacher_hero_enabled" value="1" {{ ($settings['teacher_hero_enabled'] ?? '1') == '1' ? 'checked' : '' }} />
                                <label class="form-check-label">Show hero section</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient Start</label>
                        <div class="col-lg-9">
                            <input type="color" name="teacher_hero_gradient_start" class="form-control form-control-solid form-control-color" value="{{ $settings['teacher_hero_gradient_start'] ?? '#1e3a8a' }}" />
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient End</label>
                        <div class="col-lg-9">
                            <input type="color" name="teacher_hero_gradient_end" class="form-control form-control-solid form-control-color" value="{{ $settings['teacher_hero_gradient_end'] ?? '#60a5fa' }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Card Styling</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Background Color</label>
                        <div class="col-lg-9">
                            <input type="color" name="teacher_card_bg_color" class="form-control form-control-solid form-control-color" value="{{ $settings['teacher_card_bg_color'] ?? '#ffffff' }}" />
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Border Radius</label>
                        <div class="col-lg-9">
                            <input type="number" name="teacher_card_border_radius" class="form-control form-control-solid" value="{{ $settings['teacher_card_border_radius'] ?? 16 }}" min="0" max="50" />
                            <div class="form-text">Pixels</div>
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Shadow</label>
                        <div class="col-lg-9">
                            <input type="text" name="teacher_card_shadow" class="form-control form-control-solid" value="{{ $settings['teacher_card_shadow'] ?? '0 4px 20px rgba(0,0,0,0.1)' }}" />
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Hover Shadow</label>
                        <div class="col-lg-9">
                            <input type="text" name="teacher_card_hover_shadow" class="form-control form-control-solid" value="{{ $settings['teacher_card_hover_shadow'] ?? '0 12px 35px rgba(0,0,0,0.15)' }}" />
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Primary Color</label>
                        <div class="col-lg-9">
                            <input type="color" name="teacher_card_primary_color" class="form-control form-control-solid form-control-color" value="{{ $settings['teacher_card_primary_color'] ?? '#3b82f6' }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-active-light-primary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Save Settings</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script>
$('#settingsForm').on('submit', function(e) {
    e.preventDefault();
    const form = $(this);
    const btn = form.find('button[type="submit"]');
    
    btn.attr('data-kt-indicator', 'on').prop('disabled', true);
    
    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: form.serialize(),
        success: function(response) {
            btn.removeAttr('data-kt-indicator').prop('disabled', false);
            toastr.success(response.message);
        },
        error: function(xhr) {
            btn.removeAttr('data-kt-indicator').prop('disabled', false);
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    toastr.error(value[0]);
                });
            } else {
                toastr.error('Failed to save settings');
            }
        }
    });
});
</script>
@endpush
