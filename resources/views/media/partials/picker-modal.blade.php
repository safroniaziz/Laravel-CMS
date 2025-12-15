<!-- Image Picker Modal -->
<div class="modal fade" id="mediaPickerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Search & Upload -->
                <div class="d-flex justify-content-between mb-5">
                    <input type="text" id="picker-search" class="form-control w-300px" placeholder="Search images...">
                    <button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('picker-upload-input').click()">
                        <i class="fas fa-upload me-2"></i>Upload New
                    </button>
                    <input type="file" id="picker-upload-input" accept="image/*" multiple style="display: none;">
                </div>
                
                <!-- Loading -->
                <div id="picker-loading" class="text-center py-10" style="display: none;">
                    <i class="fas fa-spinner fa-spin fs-2x text-primary"></i>
                    <p class="text-gray-600 mt-3">Loading images...</p>
                </div>
                
                <!-- Grid -->
                <div id="picker-grid" class="row g-3" style="max-height: 400px; overflow-y: auto;">
                    <!-- Will be populated by JavaScript -->
                </div>
                
                <!-- Empty State -->
                <div id="picker-empty" class="text-center py-10" style="display: none;">
                    <i class="fas fa-images fs-3x text-gray-400 mb-3"></i>
                    <p class="text-gray-600">No images found</p>
                </div>
                
                <!-- Pagination -->
                <div id="picker-pagination" class="d-flex justify-content-center mt-5">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="select-image-btn" disabled>
                    Select Image
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.picker-image-card {
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
}

.picker-image-card:hover {
    border-color: #3085d6;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.picker-image-card.selected {
    border-color: #50cd89;
    box-shadow: 0 0 0 3px rgba(80,205,137,0.2);
}

.picker-image-card .check-icon {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 28px;
    height: 28px;
    background: #50cd89;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
}

.picker-image-card.selected .check-icon {
    display: flex;
}
</style>

<script>
let selectedImageId = null;
let selectedImageUrl = null;
let currentPickerPage = 1;

function openMediaPicker() {
    const modal = new bootstrap.Modal(document.getElementById('mediaPickerModal'));
    modal.show();
    loadPickerImages();
}

function loadPickerImages(page = 1) {
    const loading = document.getElementById('picker-loading');
    const grid = document.getElementById('picker-grid');
    const empty = document.getElementById('picker-empty');
    const search = document.getElementById('picker-search').value;
    
    loading.style.display = 'block';
    grid.innerHTML = '';
    empty.style.display = 'none';
    
    fetch(`{{ route('media.picker') }}?page=${page}&search=${search}`, {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        loading.style.display = 'none';
        
        if (data.success && data.media.data.length > 0) {
            renderPickerGrid(data.media.data);
            renderPickerPagination(data.media);
        } else {
            empty.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error loading images:', error);
        loading.style.display = 'none';
        empty.style.display = 'block';
    });
}

function renderPickerGrid(images) {
    const grid = document.getElementById('picker-grid');
    grid.innerHTML = '';
    
    images.forEach(image => {
        const card = `
            <div class="col-md-2">
                <div class="picker-image-card card position-relative" onclick="selectImage(${image.id}, '${image.large}')">
                    <div class="card-body p-0">
                        <div class="ratio ratio-1x1" style="background: #f5f8fa;">
                            <img src="${image.thumb}" alt="${image.filename}" style="object-fit: cover;">
                        </div>
                        <div class="check-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="p-2">
                            <div class="text-gray-800 fs-8 text-truncate" title="${image.filename}">
                                ${image.filename}
                            </div>
                            <div class="text-gray-600 fs-9">${image.size}</div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        grid.insertAdjacentHTML('beforeend', card);
    });
}

function renderPickerPagination(data) {
    if (data.last_page <= 1) return;
    
    const pagination = document.getElementById('picker-pagination');
    let html = '<nav><ul class="pagination pagination-sm">';
    
    // Previous
    html += `<li class="page-item ${data.current_page === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="loadPickerImages(${data.current_page - 1}); return false;">«</a>
    </li>`;
    
    // Pages
    for (let i = 1; i <= data.last_page; i++) {
        if (i === 1 || i === data.last_page || (i >= data.current_page - 2 && i <= data.current_page + 2)) {
            html += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                <a class="page-link" href="#" onclick="loadPickerImages(${i}); return false;">${i}</a>
            </li>`;
        } else if (i === data.current_page - 3 || i === data.current_page + 3) {
            html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }
    
    // Next
    html += `<li class="page-item ${data.current_page === data.last_page ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="loadPickerImages(${data.current_page + 1}); return false;">»</a>
    </li>`;
    
    html += '</ul></nav>';
    pagination.innerHTML = html;
}

function selectImage(id, url) {
    selectedImageId = id;
    selectedImageUrl = url;
    
    // Remove previous selection
    document.querySelectorAll('.picker-image-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    // Add selection
    event.currentTarget.classList.add('selected');
    
    // Enable select button
    document.getElementById('select-image-btn').disabled = false;
}

// Select button click
document.getElementById('select-image-btn').addEventListener('click', function() {
    if (selectedImageUrl) {
        // Update hidden input
        document.getElementById('featured_image_input').value = selectedImageUrl;
        
        // Update preview
        updateImagePreview(selectedImageUrl);
        
        // Close modal
        bootstrap.Modal.getInstance(document.getElementById('mediaPickerModal')).hide();
        
        // Reset selection
        selectedImageId = null;
        selectedImageUrl = null;
        this.disabled = true;
    }
});

function updateImagePreview(url) {
    const preview = document.getElementById('image-preview');
    const img = preview.querySelector('img');
    
    if (url) {
        img.src = url;
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
}

// Search
let searchTimeout;
document.getElementById('picker-search').addEventListener('keyup', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => loadPickerImages(1), 500);
});

// Upload from picker
document.getElementById('picker-upload-input').addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    if (files.length === 0) return;
    
    // Show loading
    document.getElementById('picker-loading').style.display = 'block';
    
    let completed = 0;
    files.forEach(file => {
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
            if (completed === files.length) {
                // Reload images
                loadPickerImages(1);
            }
        });
    });
    
    e.target.value = '';
});
</script>
