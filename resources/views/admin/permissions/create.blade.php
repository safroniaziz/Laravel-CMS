@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Permission')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-8">
            <div>
                <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">
                    <i class="fas fa-plus-circle text-primary me-3"></i>Tambah Permission Baru
                </h1>
            </div>
            <a href="{{ route('permissions.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="card">
            <form id="permissionForm" method="POST" action="{{ route('permissions.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row g-6">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label fw-bold required">Nama Permission</label>
                                <input type="text" name="name" class="form-control" required placeholder="Contoh: View Dashboard">
                                <small class="text-muted">Nama yang mudah dibaca</small>
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold">Slug</label>
                                <input type="text" name="slug" class="form-control" placeholder="Contoh: dashboard.view">
                                <small class="text-muted">Biarkan kosong untuk auto-generate. Format: group.action</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label fw-bold required">Group</label>
                                <input type="text" name="group" class="form-control" required list="groupList" placeholder="Contoh: posts, users, settings">
                                <datalist id="groupList">
                                    @foreach($groups as $group)
                                        <option value="{{ $group }}">
                                    @endforeach
                                </datalist>
                                <small class="text-muted">Ketik grup baru atau pilih yang sudah ada</small>
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi permission..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-light me-3" onclick="window.history.back()">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Permission
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
