@extends('layouts.dashboard.dashboard')

@section('title', 'Gallery Management')
@section('menu', 'Gallery')

@section('link')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-700">Gallery</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <!-- Search -->
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" id="searchInput" class="form-control form-control-sm w-250px" placeholder="Search gallery...">
                        <button class="btn btn-sm btn-light" onclick="clearSearch()" title="Clear">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-danger btn-sm" id="bulkDeleteBtn" style="display: none;" onclick="bulkDelete()">
                            <i class="fas fa-trash me-2"></i>Delete Selected (<span id="selectedCount">0</span>)
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#galleryModal" onclick="openCreateModal()">
                            <i class="fas fa-plus me-2"></i>Add Gallery Item
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="card-body py-4">
                <div class="row g-4" id="gallery-grid">
                    @forelse($galleries as $item)
                    <div class="col-md-3 gallery-item" data-category="{{ $item->category }}" data-type="{{ $item->type }}">
                        <div class="card card-flush h-100" style="transition: all 0.3s ease;">
                            <div class="card-body p-0">
                                <!-- Checkbox -->
                                <div class="position-absolute top-0 start-0 m-2" style="z-index: 10;">
                                    <input type="checkbox" class="form-check-input gallery-checkbox" value="{{ $item->id }}" onchange="updateBulkDelete()">
                                </div>
                                <!-- Image Preview -->
                                <div class="position-relative" style="height: 200px; overflow: hidden;">
                                    @if($item->type === 'image')
                                    <img src="{{ $item->file_path }}" alt="{{ $item->title }}" class="w-100 h-100" style="object-fit: cover;">
                                    @else
                                    <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                        <i class="fas fa-video fs-3x text-muted"></i>
                                    </div>
                                    @endif
                                    
                                    <!-- Status Badge -->
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge badge-{{ $item->is_active ? 'success' : 'secondary' }}">
                                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Info -->
                                <div class="p-4">
                                    <h5 class="fs-6 fw-bold text-gray-800 mb-2">{{ Str::limit($item->title, 40) }}</h5>
                                    <p class="text-gray-600 fs-7 mb-3">{{ Str::limit($item->description, 60) }}</p>
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge badge-light-primary">{{ $item->category ?? 'Uncategorized' }}</span>
                                        @if($item->year)
                                        <span class="text-muted fs-8">{{ $item->year }}</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="d-flex justify-content-end gap-1">
                                        <button class="btn btn-sm btn-icon btn-light-info" onclick='viewGalleryItem(@json($item))' title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-light-primary" onclick="toggleActive({{ $item->id }}, {{ $item->is_active ? 'false' : 'true' }})" title="Toggle Active">
                                            <i class="fas fa-{{ $item->is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-light-primary" onclick='openEditModal(@json($item))' title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-light-danger" onclick="deleteGalleryItem({{ $item->id }})" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-10">
                        <i class="fas fa-images fs-3x text-gray-400 mb-3"></i>
                        <p class="text-gray-600">No gallery items found.</p>
                    </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                <div id="pagination-container" class="d-flex justify-content-center mt-6">
                    @if($galleries->hasPages())
                    {{ $galleries->links('pagination::bootstrap-5') }}
                    @endif
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Gallery Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="galleryForm">
                <div class="modal-body">
                    <input type="hidden" id="gallery_id">
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <label class="required form-label">Title</label>
                                <input type="text" id="title" class="form-control" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Description</label>
                                <textarea id="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="required form-label">Type</label>
                                <select id="type" class="form-select" required onchange="toggleTypeFields()">
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Category</label>
                                <select id="category" class="form-select">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Year</label>
                                <input type="number" id="year" class="form-control" min="2000" max="{{ date('Y') + 1 }}" placeholder="{{ date('Y') }}">
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" checked>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Upload Section -->
                    <div id="imageSection">
                        <div class="mb-4">
                            <label class="required form-label">Image</label>
                            
                            <!-- Option 1: Upload File -->
                            <div class="mb-2">
                                <input type="file" id="fileUpload" class="form-control form-control-sm" accept="image/*" onchange="handleFileUpload(event)">
                                <small class="text-muted">Upload new image (max 10MB)</small>
                            </div>
                            
                            <!-- OR Separator -->
                            <div class="text-center my-3">
                                <span class="badge badge-light-secondary">OR</span>
                            </div>
                            
                            <!-- Option 2: Browse Media Library -->
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-light-primary" onclick="openMediaPicker()">
                                    <i class="fas fa-images me-2"></i>Browse Media Library
                                </button>
                                <span class="text-muted fs-7 align-self-center" id="selectedImageName">No image selected</span>
                            </div>
                            <input type="hidden" id="file_path" required>
                            
                            <!-- Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <img id="previewImg" src="" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Video URL Section -->
                    <div id="videoSection" style="display: none;">
                        <div class="mb-4">
                            <label class="required form-label">Video Embed URL</label>
                            <input type="url" id="video_url" class="form-control" placeholder="https://www.youtube.com/embed/...">
                            <small class="text-muted">YouTube or Vimeo embed URL</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="indicator-label">Save</span>
                        <span class="indicator-progress" style="display: none;">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Gallery Modal -->
<div class="modal fade" id="viewGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Content (Image/Video) -->
                        <div id="viewModalContent"></div>
                    </div>
                    <div class="col-md-4">
                        <!-- Meta Info -->
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Details</h6>
                                <div class="mb-3">
                                    <label class="text-muted fs-7 mb-1">Description</label>
                                    <p id="viewModalDescription" class="mb-0"></p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted fs-7 mb-1">Category</label>
                                    <div><span id="viewModalCategory" class="badge badge-light-primary"></span></div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted fs-7 mb-1">Year</label>
                                    <p id="viewModalYear" class="mb-0"></p>
                                </div>
                                <div>
                                    <label class="text-muted fs-7 mb-1">Status</label>
                                    <div><span id="viewModalStatus" class="badge"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('media.picker')
@endsection

@push('styles')
<style>
.gallery-item .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}
</style>
@endpush


@push('scripts')
<script>
let isEditMode = false;

function openCreateModal() {
    isEditMode = false;
    document.getElementById('modalTitle').textContent = 'Add Gallery Item';
    document.getElementById('galleryForm').reset();
    document.getElementById('gallery_id').value = '';
    document.getElementById('is_active').checked = true;
    document.getElementById('imagePreview').style.display = 'none';
    toggleTypeFields();
}

function openEditModal(item) {
    isEditMode = true;
    document.getElementById('modalTitle').textContent = 'Edit Gallery Item';
    document.getElementById('gallery_id').value = item.id;
    document.getElementById('title').value = item.title;
    document.getElementById('description').value = item.description || '';
    document.getElementById('type').value = item.type;
    document.getElementById('category').value = item.category || '';
    document.getElementById('year').value = item.year || '';
    document.getElementById('is_active').checked = item.is_active;
    
    if (item.type === 'image') {
        document.getElementById('file_path').value = item.file_path;
        document.getElementById('selectedImageName').textContent = 'Image selected';
        document.getElementById('previewImg').src = item.file_path;
        document.getElementById('imagePreview').style.display = 'block';
    } else {
        document.getElementById('video_url').value = item.file_path;
    }
    
    toggleTypeFields();
    
    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    modal.show();
}

function toggleTypeFields() {
    const type = document.getElementById('type').value;
    const imageSection = document.getElementById('imageSection');
    const videoSection = document.getElementById('videoSection');
    
    if (type === 'image') {
        imageSection.style.display = 'block';
        videoSection.style.display = 'none';
        document.getElementById('file_path').required = true;
        document.getElementById('video_url').required = false;
    } else {
        imageSection.style.display = 'none';
        videoSection.style.display = 'block';
        document.getElementById('file_path').required = false;
        document.getElementById('video_url').required = true;
    }
}

// Media Picker Integration
function openMediaPicker() {
    const mediaPicker = new bootstrap.Modal(document.getElementById('mediaPickerModal'));
    mediaPicker.show();
}

// Handle media selection from picker
function selectMediaImage(imageUrl, mediaId) {
    document.getElementById('file_path').value = imageUrl;
    document.getElementById('selectedImageName').textContent = 'Image selected';
    document.getElementById('previewImg').src = imageUrl;
    document.getElementById('imagePreview').style.display = 'block';
    
    // Close picker modal
    const pickerModal = bootstrap.Modal.getInstance(document.getElementById('mediaPickerModal'));
    pickerModal.hide();
}

// Handle file upload
function handleFileUpload(event) {
    const file = event.target.files[0];
    if (!file) return;
    
    // Validate file size (max 10MB)
    if (file.size > 10 * 1024 * 1024) {
        Swal.fire({
            icon: 'error',
            title: 'File too large',
            text: 'Maximum file size is 10MB',
            confirmButtonText: 'OK'
        });
        event.target.value = '';
        return;
    }
    
    // Preview only (file will be sent via FormData)
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('selectedImageName').textContent = file.name;
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('imagePreview').style.display = 'block';
        // Clear file_path hidden field since we're using file upload
        document.getElementById('file_path').value = '';
    };
    reader.readAsDataURL(file);
}

// Form submission
document.getElementById('galleryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const galleryId = document.getElementById('gallery_id').value;
    const url = isEditMode ? `/galleries/${galleryId}` : '/galleries';
    const method = isEditMode ? 'PUT' : 'POST';
    
    const type = document.getElementById('type').value;
    
    // Build FormData for file upload
    const formData = new FormData();
    formData.append('title', document.getElementById('title').value);
    formData.append('description', document.getElementById('description').value || '');
    formData.append('type', type);
    formData.append('category', document.getElementById('category').value || '');
    formData.append('year', document.getElementById('year').value || '');
    formData.append('is_active', document.getElementById('is_active').checked ? 1 : 0);
    
    if (type === 'image') {
        // Check if we have file upload or media library selection
        const fileInput = document.getElementById('fileUpload');
        const filePath = document.getElementById('file_path').value;
        
        if (fileInput.files && fileInput.files[0]) {
            // Direct file upload
            formData.append('file', fileInput.files[0]);
        } else if (filePath && !filePath.startsWith('data:')) {
            // Media Library selection (URL)
            formData.append('file_path', filePath);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'No Image Selected',
                text: 'Please upload an image or select from Media Library',
                confirmButtonText: 'OK'
            });
            return;
        }
    } else {
        // Video URL
        formData.append('file_path', document.getElementById('video_url').value);
    }
    
    // For PUT requests, add _method field
    if (method === 'PUT') {
        formData.append('_method', 'PUT');
    }
    
    submitBtn.setAttribute('data-kt-indicator', 'on');
    submitBtn.disabled = true;
    
    fetch(url, {
        method: 'POST', // Always POST, _method handles PUT
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw err;
            });
        }
        return response.json();
    })
    .then(data => {
        submitBtn.removeAttribute('data-kt-indicator');
        submitBtn.disabled = false;
        
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: isEditMode ? 'Updated!' : 'Created!',
                text: data.message,
                confirmButtonText: 'OK'
            }).then(() => {
                location.reload();
            });
        }
    })
    .catch(error => {
        submitBtn.removeAttribute('data-kt-indicator');
        submitBtn.disabled = false;
        
        let errorMessage = 'Failed to save gallery item';
        if (error.message) {
            errorMessage = error.message;
        } else if (error.errors) {
            errorMessage = Object.values(error.errors).flat().join(', ');
        }
        
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: errorMessage,
            confirmButtonText: 'OK'
        });
    });
});

function toggleActive(id, newStatus) {
    fetch(`/galleries/${id}/toggle-active`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

function deleteGalleryItem(id) {
    Swal.fire({
        title: 'Delete Gallery Item?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/galleries/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        }
    });
}

// Search and Pagination (Server-side via AJAX)
let searchTimeout;
let currentPage = 1;
let currentSearch = '';

document.getElementById('searchInput').addEventListener('keyup', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        currentSearch = this.value;
        currentPage = 1;
        loadGalleries();
    }, 500);
});

function clearSearch() {
    document.getElementById('searchInput').value = '';
    currentSearch = '';
    currentPage = 1;
    loadGalleries();
}

function loadGalleries(page = 1) {
    currentPage = page;
    const url = new URL(window.location.origin + '/galleries');
    if (currentSearch) url.searchParams.append('search', currentSearch);
    url.searchParams.append('page', currentPage);
    
    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'text/html'
        }
    })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Update gallery grid
        const newGrid = doc.querySelector('#gallery-grid');
        if (newGrid) {
            document.getElementById('gallery-grid').innerHTML = newGrid.innerHTML;
        }
        
        // Update pagination
        const newPagination = doc.querySelector('#pagination-container');
        if (newPagination) {
            document.getElementById('pagination-container').innerHTML = newPagination.innerHTML;
            attachPaginationHandlers();
        }
    })
    .catch(error => {
        console.error('Error loading galleries:', error);
    });
}

function attachPaginationHandlers() {
    document.querySelectorAll('#pagination-container a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = new URL(this.href);
            const page = url.searchParams.get('page') || 1;
            loadGalleries(page);
        });
    });
}

// Initial pagination handlers
attachPaginationHandlers();

// Bulk Delete
function updateBulkDelete() {
    const checkboxes = document.querySelectorAll('.gallery-checkbox:checked');
    const count = checkboxes.length;
    document.getElementById('selectedCount').textContent = count;
    document.getElementById('bulkDeleteBtn').style.display = count > 0 ? 'block' : 'none';
}

function bulkDelete() {
    const checkboxes = document.querySelectorAll('.gallery-checkbox:checked');
    const ids = Array.from(checkboxes).map(cb => cb.value);
    
    if (ids.length === 0) return;
    
    Swal.fire({
        title: `Delete ${ids.length} Items?`,
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete them!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/galleries/bulk-destroy', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ ids: ids })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        }
    });
}

// View Gallery Item
function viewGalleryItem(item) {
    document.getElementById('viewModalTitle').textContent = item.title;
    document.getElementById('viewModalDescription').textContent = item.description || 'No description';
    document.getElementById('viewModalCategory').textContent = item.category || 'Uncategorized';
    document.getElementById('viewModalYear').textContent = item.year || '-';
    
    // Status badge
    const statusBadge = document.getElementById('viewModalStatus');
    if (item.is_active) {
        statusBadge.className = 'badge badge-success';
        statusBadge.textContent = 'Active';
    } else {
        statusBadge.className = 'badge badge-secondary';
        statusBadge.textContent = 'Inactive';
    }
    
    // Content (image or video)
    const contentDiv = document.getElementById('viewModalContent');
    if (item.type === 'image') {
        contentDiv.innerHTML = `<img src="${item.file_path}" class="img-fluid rounded w-100">`;
    } else {
        contentDiv.innerHTML = `
            <div class="ratio ratio-16x9">
                <iframe src="${item.file_path}" allowfullscreen class="rounded"></iframe>
            </div>
        `;
    }
    
    // Open modal
    const modal = new bootstrap.Modal(document.getElementById('viewGalleryModal'));
    modal.show();
}
</script>
@endpush
