@extends('layouts.dashboard.dashboard')

@section('title', 'Manajemen Permission')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Header -->
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between mb-8">
            <div>
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    <i class="fas fa-key text-primary me-3"></i>Manajemen Permission
                </h1>
                <p class="text-muted fs-6 fw-semibold mt-2 mb-0">
                    Kelola izin akses untuk role
                </p>
            </div>
            <a href="{{ route('permissions.create') }}" class="btn btn-primary mt-4 mt-lg-0">
                <i class="fas fa-plus me-2"></i>Tambah Permission
            </a>
        </div>

        <!-- Filters -->
        <div class="card mb-6">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Nama atau slug..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Group</label>
                        <select name="group" class="form-select">
                            <option value="">Semua Group</option>
                            @foreach($groups as $group)
                                <option value="{{ $group }}" {{ request('group') == $group ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $group)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-light-primary w-100">
                            <i class="fas fa-search me-2"></i>Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Permissions Table -->
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-row-dashed align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="text-gray-600 fw-bold fs-7 text-uppercase">
                                <th class="ps-5">Permission</th>
                                <th>Slug</th>
                                <th>Group</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Digunakan</th>
                                <th class="text-end pe-5">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permissions as $permission)
                            <tr>
                                <td class="ps-5">
                                    <span class="fw-bold text-dark">{{ $permission->name }}</span>
                                </td>
                                <td>
                                    <code class="text-primary">{{ $permission->slug }}</code>
                                </td>
                                <td>
                                    <span class="badge badge-light-info">{{ $permission->group }}</span>
                                </td>
                                <td class="text-muted">{{ $permission->description ?: '-' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-light-primary">{{ $permission->roles()->count() }} roles</span>
                                </td>
                                <td class="text-end pe-5">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-sm btn-light-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-light-danger" onclick="deletePermission({{ $permission->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-10">
                                    <i class="fas fa-key fa-4x text-muted mb-4"></i>
                                    <p class="text-muted mb-0">Belum ada permission</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($permissions->hasPages())
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan {{ $permissions->firstItem() }} - {{ $permissions->lastItem() }} dari {{ $permissions->total() }} permission
                </div>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        @if($permissions->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">«</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $permissions->previousPageUrl() }}">«</a></li>
                        @endif

                        @foreach($permissions->getUrlRange(1, $permissions->lastPage()) as $page => $url)
                            @if($page == $permissions->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if($permissions->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $permissions->nextPageUrl() }}">»</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">»</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
            @endif
        </div>

    </div>
</div>

@push('scripts')
<script>
function deletePermission(id) {
    Swal.fire({
        title: 'Hapus Permission?',
        text: 'Permission yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/permissions/${id}`, {
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
