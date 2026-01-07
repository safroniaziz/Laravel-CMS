@extends('layouts.dashboard.dashboard')

@section('title', 'Manajemen User')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Header -->
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between mb-8">
            <div>
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    <i class="fas fa-users text-primary me-3"></i>Manajemen User
                </h1>
                <p class="text-muted fs-6 fw-semibold mt-2 mb-0">
                    Kelola pengguna sistem
                </p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-primary mt-4 mt-lg-0">
                <i class="fas fa-plus me-2"></i>Tambah User
            </a>
        </div>

        <!-- Filters -->
        <div class="card mb-6">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Nama atau email..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="">Semua Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-light-primary w-100">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-row-dashed align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="text-gray-600 fw-bold fs-7 text-uppercase">
                                <th class="ps-5">User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Terdaftar</th>
                                <th class="text-end pe-5">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td class="ps-5">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-4">
                                            @if($user->avatar)
                                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                                            @else
                                                <span class="symbol-label bg-light-primary text-primary fw-bold">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="text-dark fw-bold d-block">{{ $user->name }}</span>
                                            @if($user->phone)
                                                <span class="text-muted fs-7"><i class="fas fa-phone me-1"></i>{{ $user->phone }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:{{ $user->email }}" class="text-dark">{{ $user->email }}</a>
                                </td>
                                <td>
                                    @if($user->role)
                                        <span class="badge badge-light-primary">{{ $user->role->name }}</span>
                                    @else
                                        <span class="badge badge-light">No Role</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($user->is_active)
                                        <span class="badge badge-light-success">Aktif</span>
                                    @else
                                        <span class="badge badge-light-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center text-muted">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="text-end pe-5">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-light-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth()->id() !== $user->id)
                                    <button type="button" class="btn btn-sm btn-light-danger" onclick="deleteUser({{ $user->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-10">
                                    <i class="fas fa-users fa-4x text-muted mb-4"></i>
                                    <p class="text-muted mb-0">Belum ada user</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($users->hasPages())
            <div class="card-footer">
                {{ $users->withQueryString()->links() }}
            </div>
            @endif
        </div>

    </div>
</div>

@push('scripts')
<script>
function deleteUser(id) {
    Swal.fire({
        title: 'Hapus User?',
        text: 'User yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(baseUrl + `/users/${id}`, {
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
