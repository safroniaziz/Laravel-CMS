@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Teacher')
@section('menu', 'Teachers')

@section('link')
    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted"><a href="{{ route('admin.teachers.index') }}" class="text-muted text-hover-primary">Teachers</a></li>
    <li class="breadcrumb-item text-gray-700">Edit Teacher</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <form id="teacherForm" method="POST" action="{{ route('admin.teachers.update', $teacher) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @include('admin.teachers._form')

            <div class="card">
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-light btn-active-light-primary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Update Teacher</span>
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
$('#teacherForm').on('submit', function(e) {
    e.preventDefault();
    const form = $(this);
    const formData = new FormData(this);
    const btn = form.find('button[type="submit"]');
    
    // Convert expertise to JSON array
    const expertise = $('input[name="expertise"]').val();
    if (expertise) {
        formData.delete('expertise');
        expertise.split(',').forEach(skill => {
            formData.append('expertise[]', skill.trim());
        });
    }
    
    btn.attr('data-kt-indicator', 'on').prop('disabled', true);
    
    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            toastr.success(response.message);
            setTimeout(() => window.location = response.redirect, 1000);
        },
        error: function(xhr) {
            btn.removeAttr('data-kt-indicator').prop('disabled', false);
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    toastr.error(value[0]);
                });
            } else {
                toastr.error('Failed to update teacher');
            }
        }
    });
});
</script>
@endpush
