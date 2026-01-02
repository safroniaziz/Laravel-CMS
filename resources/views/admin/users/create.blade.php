@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah User')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-8">
            <div>
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    <i class="fas fa-user-plus text-primary me-3"></i>Tambah User Baru
                </h1>
            </div>
            <a href="{{ route('users.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="card">
            <form id="userForm" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row g-6">
                        <!-- Left Column -->
                        <div class="col-md-8">
                            <div class="mb-5">
                                <label class="form-label fw-bold required">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" required placeholder="Masukkan nama lengkap">
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold required">Email</label>
                                <input type="email" name="email" class="form-control" required placeholder="email@example.com">
                            </div>
                            
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold required">Password</label>
                                    <input type="password" name="password" class="form-control" required minlength="8" placeholder="Min 8 karakter">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold required">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
                                </div>
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold">Nomor Telepon</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+62...">
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold">Bio</label>
                                <textarea name="bio" class="form-control" rows="3" placeholder="Deskripsi singkat tentang user..."></textarea>
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="col-md-4">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <div class="mb-5">
                                        <label class="form-label fw-bold required">Role</label>
                                        <select name="role_id" class="form-select" required>
                                            <option value="">Pilih Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="mb-5">
                                        <label class="form-label fw-bold required">Status</label>
                                        <select name="is_active" class="form-select" required>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
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
                        <i class="fas fa-save me-2"></i>Simpan User
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
