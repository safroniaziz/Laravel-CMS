@extends('layouts.dashboard.dashboard')

@section('title', 'Media Library')
@section('menu', 'Media')

@section('link')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-700">Media Library</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <!-- Card -->
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center gap-3">
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" id="select-all">
                            <label class="form-check-label" for="select-all">
                                Select All
                            </label>
                        </div>
                        <div class="d-flex align-items-center position-relative">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" id="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search media" />
                        </div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex gap-2">
                        <button type="button" id="delete-selected-btn" class="btn btn-danger btn-sm" style="display: none;">
                            <i class="fas fa-trash me-2"></i>Delete Selected (<span id="selected-count">0</span>)
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('upload-input').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Upload Images
                        </button>
                    </div>
                    <input type="file" id="upload-input" accept="image/*" multiple style="display: none;">
                </div>
            </div>
            
            <!-- Card body -->
            <div class="card-body py-4">
                <!-- Upload Progress -->
                <div id="upload-progress" style="display: none;" class="mb-5">
                    <div class="alert alert-primary d-flex align-items-center">
                        <i class="fas fa-spinner fa-spin me-3"></i>
                        <div class="flex-grow-1">
                            <span id="upload-text">Uploading...</span>
                        </div>
                    </div>
                </div>
                
                <!-- Media Grid -->
                <div id="media-grid" class="row g-4">
                    @forelse($media as $item)
                    <div class="col-md-2" data-media-id="{{ $item->id }}">
                        <div class="card media-card" style="cursor: pointer;" onclick="toggleCheckbox({{ $item->id }}, event)">
                            <div class="card-body p-0 position-relative">
                                <!-- Checkbox -->
                                <div class="position-absolute top-0 start-0 p-2" style="z-index: 10;">
                                    <input class="form-check-input media-checkbox" type="checkbox" value="{{ $item->id }}" onclick="event.stopPropagation();">
                                </div>
                                
                                <!-- Image -->
                                <div class="ratio ratio-1x1" style="background: #f5f8fa; border-radius: 8px 8px 0 0;">
                                    <img src="{{ asset('storage/media/thumb/' . $item->file_name) }}" 
                                         alt="{{ $item->name }}"
                                         style="object-fit: cover; border-radius: 8px 8px 0 0;">
                                </div>
                                
                                <!-- Actions overlay -->
                                <div class="position-absolute top-0 end-0 p-2">
                                    <button class="btn btn-sm btn-icon btn-light-danger" 
                                            onclick="deleteSingleMedia({{ $item->id }}); event.stopPropagation();">
                                        <i class="fas fa-trash fs-7"></i>
                                    </button>
                                </div>
                                
                                <!-- Info -->
                                <div class="p-3">
                                    <div class="text-gray-800 fw-semibold fs-7 mb-1 text-truncate" title="{{ $item->name }}">
                                        {{ Str::limit($item->name, 15) }}
                                    </div>
                                    <div class="text-gray-600 fs-8">
                                        {{ number_format($item->size / 1024, 0) }} KB
                                    </div>
                                    <div class="text-gray-500 fs-9">
                                        {{ $item->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="text-center py-10">
                            <i class="fas fa-images fs-3x text-gray-400 mb-3"></i>
                            <p class="text-gray-600">No media found. Upload your first image!</p>
                        </div>
                    </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                @if($media->hasPages())
                <div class="d-flex flex-stack flex-wrap pt-10">
                    <div class="fs-6 fw-semibold text-gray-700">
                        Showing {{ $media->firstItem() ?? 0 }} to {{ $media->lastItem() ?? 0 }} of {{ $media->total() }} images
                    </div>
                    {{ $media->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>
        
    </div>
</div>
@endsection

@push('scripts')
<script>
// Upload handler
document.getElementById('upload-input').addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    
    if (files.length === 0) return;
    
    const progress = document.getElementById('upload-progress');
    const uploadText = document.getElementById('upload-text');
    progress.style.display = 'block';
    
    let completed = 0;
    const total = files.length;
    
    files.forEach((file, index) => {
        const formData = new FormData();
        formData.append('file', file);
        
        fetch('{{ route('media.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            completed++;
            uploadText.textContent = `Uploading ${completed}/${total} images...`;
            
            if (data.success) {
                // Add new media card to grid
                addMediaCard(data.media, data.preview.thumb);
            }
            
            if (completed === total) {
                uploadText.textContent = `✓ Successfully uploaded ${total} ${total > 1 ? 'images' : 'image'}!`;
                setTimeout(() => {
                    progress.style.display = 'none';
                    location.reload(); // Refresh to show updated grid
                }, 1500);
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            completed++;
            if (completed === total) {
                progress.style.display = 'none';
                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: 'Some images failed to upload',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
    
    // Reset input
    e.target.value = '';
});

function addMediaCard(media, thumbUrl) {
    const grid = document.getElementById('media-grid');
    
    // Remove "no media" message if exists
    const emptyState = grid.querySelector('.col-12');
    if (emptyState) emptyState.remove();
    
    const card = `
        <div class="col-md-2" data-media-id="${media.id}">
            <div class="card media-card">
                <div class="card-body p-0 position-relative">
                    <div class="ratio ratio-1x1" style="background: #f5f8fa; border-radius: 8px 8px 0 0;">
                        <img src="${thumbUrl}" alt="${media.name}" style="object-fit: cover; border-radius: 8px 8px 0 0;">
                    </div>
                    <div class="position-absolute top-0 end-0 p-2">
                        <button class="btn btn-sm btn-icon btn-light-danger delete-media" data-id="${media.id}" onclick="event.stopPropagation();">
                            <i class="fas fa-trash fs-7"></i>
                        </button>
                    </div>
                    <div class="p-3">
                        <div class="text-gray-800 fw-semibold fs-7 mb-1">${media.name}</div>
                        <div class="text-gray-600 fs-8">${Math.round(media.size / 1024)} KB</div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    grid.insertAdjacentHTML('afterbegin', card);
}

// Delete single media function
function deleteSingleMedia(mediaId) {
    Swal.fire({
        title: 'Delete Image?',
        text: "This will permanently delete the image and all its sizes!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`{{ url('media') }}/${mediaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove card from grid
                    const card = document.querySelector(`[data-media-id="${mediaId}"]`);
                    if (card) card.remove();
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: data.message,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to delete image',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            });
        }
    });
}


// Toggle checkbox when clicking card
function toggleCheckbox(mediaId, event) {
    // Don't toggle if clicking delete button
    if (event.target.closest('button')) {
        return;
    }
    
    const card = document.querySelector(`[data-media-id="${mediaId}"]`);
    const checkbox = card.querySelector('.media-checkbox');
    
    if (checkbox) {
        checkbox.checked = !checkbox.checked;
        updateDeleteButton();
    }
}

// Search
document.getElementById('search').addEventListener('keyup', function() {
    const search = this.value.toLowerCase();
    const cards = document.querySelectorAll('#media-grid [data-media-id]');
    
    cards.forEach(card => {
        const name = card.querySelector('.text-gray-800').textContent.toLowerCase();
        card.style.display = name.includes(search) ? '' : 'none';
    });
});

// Select All
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.media-checkbox');
    checkboxes.forEach(cb => {
        cb.checked = this.checked;
    });
    updateDeleteButton();
});

// Update delete button visibility
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('media-checkbox')) {
        updateDeleteButton();
    }
});

function updateDeleteButton() {
    const selectedCount = document.querySelectorAll('.media-checkbox:checked').length;
    const deleteBtn = document.getElementById('delete-selected-btn');
    const countSpan = document.getElementById('selected-count');
    
    if (selectedCount > 0) {
        deleteBtn.style.display = 'block';
        countSpan.textContent = selectedCount;
    } else {
        deleteBtn.style.display = 'none';
        document.getElementById('select-all').checked = false;
    }
}

// Bulk Delete
document.getElementById('delete-selected-btn').addEventListener('click', function() {
    const selectedCheckboxes = document.querySelectorAll('.media-checkbox:checked');
    const selectedIds = Array.from(selectedCheckboxes).map(cb => cb.value);
    
    if (selectedIds.length === 0) return;
    
    Swal.fire({
        title: `Delete ${selectedIds.length} Images?`,
        text: "This will permanently delete all selected images and their sizes!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete them!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            bulkDelete(selectedIds);
        }
    });
});

function bulkDelete(ids) {
    let completed = 0;
    const total = ids.length;
    
    Swal.fire({
        title: 'Deleting...',
        text: `Deleting ${completed}/${total} images...`,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    ids.forEach(id => {
        fetch(`{{ url('media') }}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            completed++;
            Swal.update({
                text: `Deleting ${completed}/${total} images...`
            });
            
            if (data.success) {
                // Remove card from grid
                const card = document.querySelector(`[data-media-id="${id}"]`);
                if (card) card.remove();
            }
            
            if (completed === total) {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: `Successfully deleted ${total} ${total > 1 ? 'images' : 'image'}`,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    // Reset selections
                    document.getElementById('select-all').checked = false;
                    updateDeleteButton();
                });
            }
        })
        .catch(error => {
            console.error('Delete error:', error);
            completed++;
            if (completed === total) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Some images failed to delete',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
}

</script>
@endpush
