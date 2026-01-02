@extends('layouts.dashboard.dashboard')

@section('title', 'Edit User')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-8">
            <div>
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    <i class="fas fa-user-edit text-primary me-3"></i>Edit User
                </h1>
                <p class="text-muted mt-2 mb-0">{{ $user->name }} ({{ $user->email }})</p>
            </div>
            <a href="{{ route('users.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="card">
            <form id="userForm" method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row g-6">
                        <!-- Left Column -->
                        <div class="col-md-8">
                            <div class="mb-5">
                                <label class="form-label fw-bold required">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" required value="{{ $user->name }}">
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold required">Email</label>
                                <input type="email" name="email" class="form-control" required value="{{ $user->email }}">
                            </div>
                            
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Password Baru</label>
                                    <input type="password" name="password" class="form-control" minlength="8" placeholder="Kosongkan jika tidak diubah">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                                </div>
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold">Nomor Telepon</label>
                                <input type="tel" name="phone" class="form-control" value="{{ $user->phone }}">
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold">Bio</label>
                                <textarea name="bio" class="form-control" rows="3">{{ $user->bio }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="col-md-4">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <div class="mb-5">
                                        <label class="form-label fw-bold required">Role</label>
                                        <select name="role_id" class="form-select" required>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="mb-5">
                                        <label class="form-label fw-bold required">Status</label>
                                        <select name="is_active" class="form-select" required>
                                            <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-light me-3" onclick="window.history.back()">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update User
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
document.getElementById('userForm').addEventListener('submit', function(e) {
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
                window.location.href = data.redirect || '{{ route("users.index") }}';
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
