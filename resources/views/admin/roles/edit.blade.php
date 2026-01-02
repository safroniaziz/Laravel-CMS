@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Role')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-8">
            <div>
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    <i class="fas fa-edit text-primary me-3"></i>Edit Role
                </h1>
                <p class="text-muted mt-2 mb-0">{{ $role->name }}</p>
            </div>
            <a href="{{ route('roles.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <!-- Form -->
        <form id="roleForm" method="POST" action="{{ route('roles.update', $role) }}">
            @csrf
            @method('PUT')
            <div class="row g-6">
                <!-- Left Column - Role Info -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Role</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-5">
                                <label class="form-label fw-bold required">Nama Role</label>
                                <input type="text" name="name" class="form-control" required value="{{ $role->name }}">
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold">Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ $role->slug }}" {{ in_array($role->slug, ['superadmin', 'admin']) ? 'readonly' : '' }}>
                                @if(in_array($role->slug, ['superadmin', 'admin']))
                                <small class="text-danger">System role slug tidak dapat diubah</small>
                                @endif
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold required">Level</label>
                                <input type="number" name="level" class="form-control" required value="{{ $role->level }}" min="1" max="100">
                            </div>
                            
                            <div class="mb-0">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3">{{ $role->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Role Stats -->
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-users text-primary fs-2 me-3"></i>
                                    <div>
                                        <span class="text-muted d-block fs-7">Pengguna dengan role ini</span>
                                        <span class="fw-bold fs-4">{{ $role->users()->count() }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('users.index', ['role' => $role->id]) }}" class="btn btn-sm btn-light-primary">
                                    Lihat Users
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Permissions -->
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-key text-warning me-2"></i>Permissions
                            </h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary" onclick="toggleAllPermissions()">
                                    <i class="fas fa-check-double"></i> Toggle Semua
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                            @php
                                $rolePermissionIds = $role->permissions->pluck('id')->toArray();
                            @endphp
                            
                            @forelse($permissions as $group => $groupPermissions)
                            <div class="mb-5">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="fas fa-folder me-2"></i>{{ ucwords(str_replace('_', ' ', $group)) }}
                                </h5>
                                <div class="row g-3">
                                    @foreach($groupPermissions as $permission)
                                    <div class="col-md-6">
                                        <label class="form-check form-check-custom form-check-solid">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                                   class="form-check-input permission-check"
                                                   {{ in_array($permission->id, $rolePermissionIds) ? 'checked' : '' }}>
                                            <span class="form-check-label">
                                                <span class="fw-semibold">{{ $permission->name }}</span>
                                                @if($permission->description)
                                                <span class="text-muted d-block fs-8">{{ $permission->description }}</span>
                                                @endif
                                            </span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="separator my-4"></div>
                            @empty
                            <div class="text-center py-5">
                                <i class="fas fa-key fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada permission.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-6">
                <button type="button" class="btn btn-light me-3" onclick="window.history.back()">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Role
                </button>
            </div>
        </form>

    </div>
</div>

@push('scripts')
<script>
let allChecked = false;
function toggleAllPermissions() {
    allChecked = !allChecked;
    document.querySelectorAll('.permission-check').forEach(cb => cb.checked = allChecked);
}

document.getElementById('roleForm').addEventListener('submit', function(e) {
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
                window.location.href = data.redirect || '{{ route("roles.index") }}';
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
