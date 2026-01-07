@extends('layouts.dashboard.dashboard')

@section('title', 'Manajemen Role')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Header -->
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between mb-8">
            <div>
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    <i class="fas fa-user-shield text-primary me-3"></i>Manajemen Role
                </h1>
                <p class="text-muted fs-6 fw-semibold mt-2 mb-0">
                    Kelola role dan izin akses pengguna
                </p>
            </div>
            <a href="{{ route('roles.create') }}" class="btn btn-primary mt-4 mt-lg-0">
                <i class="fas fa-plus me-2"></i>Tambah Role
            </a>
        </div>

        <!-- Roles Grid -->
        <div class="row g-6">
            @forelse($roles as $role)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 hover-elevate-up">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="symbol symbol-50px">
                                <span class="symbol-label bg-light-primary">
                                    <i class="fas fa-shield-alt text-primary fs-2"></i>
                                </span>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-icon btn-light-primary me-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if(!in_array($role->slug, ['superadmin', 'admin']))
                                <button type="button" class="btn btn-sm btn-icon btn-light-danger" onclick="deleteRole({{ $role->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                        
                        <h4 class="fw-bold text-dark mb-1">{{ $role->name }}</h4>
                        <p class="text-muted fs-7 mb-4">{{ $role->description ?: 'Tidak ada deskripsi' }}</p>
                        
                        <div class="d-flex gap-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users text-primary me-2"></i>
                                <span class="fw-bold">{{ $role->users_count }}</span>
                                <span class="text-muted ms-1">Users</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-key text-warning me-2"></i>
                                <span class="fw-bold">{{ $role->permissions_count }}</span>
                                <span class="text-muted ms-1">Permissions</span>
                            </div>
                        </div>
                        
                        @if($role->slug === 'superadmin')
                        <div class="mt-3">
                            <span class="badge badge-primary">System Role</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-10">
                        <i class="fas fa-user-shield fa-4x text-muted mb-4"></i>
                        <p class="text-muted">Belum ada role</p>
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Role Pertama
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

    </div>
</div>

@push('scripts')
<script>
function deleteRole(id) {
    Swal.fire({
        title: 'Hapus Role?',
        text: 'Role yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(baseUrl + `/roles/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Terhapus!', data.message, 'success').then(() => location.reload());
                } else {
                    Swal.fire('Gagal!', data.message, 'error');
                }
            });
        }
    });
}
</script>
@endpush
@endsection
