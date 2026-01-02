@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Permission')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-8">
            <div>
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    <i class="fas fa-edit text-primary me-3"></i>Edit Permission
                </h1>
                <p class="text-muted mt-2 mb-0">{{ $permission->name }}</p>
            </div>
            <a href="{{ route('permissions.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="card">
            <form id="permissionForm" method="POST" action="{{ route('permissions.update', $permission) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row g-6">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label fw-bold required">Nama Permission</label>
                                <input type="text" name="name" class="form-control" required value="{{ $permission->name }}">
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold">Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ $permission->slug }}">
                                <small class="text-muted">Format: group.action</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label fw-bold required">Group</label>
                                <input type="text" name="group" class="form-control" required list="groupList" value="{{ $permission->group }}">
                                <datalist id="groupList">
                                    @foreach($groups as $group)
                                        <option value="{{ $group }}">
                                    @endforeach
                                </datalist>
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3">{{ $permission->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Roles using this permission -->
                    @if($permission->roles->count() > 0)
                    <div class="mt-5 pt-5 border-top">
                        <h5 class="fw-bold mb-3">Digunakan oleh Role:</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($permission->roles as $role)
                                <span class="badge badge-light-primary fs-7">{{ $role->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-light me-3" onclick="window.history.back()">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Permission
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
document.getElementById('permissionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    formData.append('_method', 'PUT');
    
    Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    
    fetch(this.action, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Berhasil!', data.message, 'success').then(() => {
                window.location.href = data.redirect || '{{ route("permissions.index") }}';
            });
        } else {
            Swal.fire('Gagal!', data.message || 'Terjadi kesalahan', 'error');
        }
    })
    .catch(err => {
        Swal.fire('Error!', 'Terjadi kesalahan server', 'error');
    });
});
</script>
@endpush
@endsection
