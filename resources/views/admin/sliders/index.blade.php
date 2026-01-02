@extends('layouts.dashboard.dashboard')

@section('title', 'Kelola Slider')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            
            {{-- Page Header --}}
            <div class="card mb-5">
                <div class="card-body py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-50px me-3" style="background: linear-gradient(135deg, #1a246a, #2d3a8c); display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                                <i class="fas fa-images text-white fs-3"></i>
                            </div>
                            <div>
                                <h1 class="fs-2 fw-bold mb-0">Hero Slider</h1>
                                <span class="text-muted fs-7">Kelola slider pada halaman utama</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Slider
                        </a>
                    </div>
                </div>
            </div>

            {{-- Alert --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- Sliders List --}}
            <div class="card">
                <div class="card-body">
                    @if($sliders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-row-bordered align-middle gy-4" id="slidersTable">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="ps-4" style="width: 50px;">Order</th>
                                    <th style="width: 150px;">Gambar</th>
                                    <th>Judul</th>
                                    <th>Subtitle</th>
                                    <th>Posisi</th>
                                    <th class="text-center" style="width: 80px;">Status</th>
                                    <th class="text-end pe-4" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="sliderTableBody">
                                @foreach($sliders as $slider)
                                <tr data-id="{{ $slider->id }}">
                                    <td class="ps-4">
                                        <span class="drag-handle cursor-move"><i class="fas fa-grip-vertical text-muted"></i></span>
                                        <span class="ms-2">{{ $slider->order }}</span>
                                    </td>
                                    <td>
                                        @if($slider->image)
                                            @if(str_starts_with($slider->image, 'http'))
                                                <img src="{{ $slider->image }}" alt="{{ $slider->title }}" class="rounded" style="width: 120px; height: 70px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="rounded" style="width: 120px; height: 70px; object-fit: cover;">
                                            @endif
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 120px; height: 70px;">
                                                <i class="fas fa-image text-muted fs-3"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark">{{ Str::limit($slider->title, 40) }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ Str::limit($slider->subtitle, 30) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-primary">{{ ucfirst($slider->image_position) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
                                            <input class="form-check-input toggle-active" type="checkbox" data-id="{{ $slider->id }}" {{ $slider->is_active ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-sm btn-light-primary me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-10">
                        <i class="fas fa-images fs-3x text-muted mb-4"></i>
                        <h4 class="text-muted">Belum ada slider</h4>
                        <p class="text-gray-500">Klik tombol "Tambah Slider" untuk membuat slider baru</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
$(document).ready(function() {
    // Toggle Active
    $('.toggle-active').on('change', function() {
        var checkbox = $(this);
        var id = checkbox.data('id');
        $.ajax({
            url: '{{ route("admin.sliders.toggle", ":id") }}'.replace(':id', id),
            type: 'PATCH',
            data: { _token: '{{ csrf_token() }}' },
            success: function(res) {
                Swal.fire({icon: 'success', title: 'Berhasil!', text: res.message, confirmButtonText: 'OK'});
            },
            error: function(xhr) {
                checkbox.prop('checked', !checkbox.prop('checked'));
                Swal.fire({icon: 'error', title: 'Gagal!', text: xhr.responseJSON?.message || 'Terjadi kesalahan', confirmButtonText: 'OK'});
            }
        });
    });

    // Delete Confirmation
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Hapus Slider?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    });

    // Sortable
    var el = document.getElementById('sliderTableBody');
    if (el) {
        new Sortable(el, {
            handle: '.drag-handle',
            animation: 150,
            onEnd: function() {
                var orders = {};
                $('#sliderTableBody tr').each(function(index) {
                    orders[$(this).data('id')] = index + 1;
                });
                $.ajax({
                    url: '{{ route("admin.sliders.reorder") }}',
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}', orders: orders },
                    success: function(res) {
                        Swal.fire({icon: 'success', title: 'Berhasil!', text: res.message, confirmButtonText: 'OK'});
                    }
                });
            }
        });
    }
});
</script>
@endpush
