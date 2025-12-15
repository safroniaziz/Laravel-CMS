<!-- Media Picker Modal for Reuse -->
<div class="modal fade" id="mediaPickerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Image from Media Library</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4" id="media-picker-grid">
                    <!-- Images will be loaded via AJAX -->
                    <div class="col-12 text-center py-10">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Load media when picker modal opens
document.getElementById('mediaPickerModal')?.addEventListener('shown.bs.modal', function() {
    loadMediaForPicker();
});

function loadMediaForPicker() {
    const grid = document.getElementById('media-picker-grid');
    
    fetch('/media')
        .then(response => response.text())
        .then(html => {
            // Parse the response to extract media items
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const mediaItems = doc.querySelectorAll('[data-media-id]');
            
            if (mediaItems.length === 0) {
                grid.innerHTML = `
                    <div class="col-12 text-center py-10">
                        <i class="fas fa-images fs-3x text-gray-400 mb-3"></i>
                        <p class="text-gray-600">No images found in Media Library.</p>
                        <a href="/media" class="btn btn-sm btn-primary" target="_blank">
                            <i class="fas fa-upload me-2"></i>Upload Images
                        </a>
                    </div>
                `;
                return;
            }
            
            let pickerHTML = '';
            mediaItems.forEach(item => {
                const mediaId = item.dataset.mediaId;
                const img = item.querySelector('img');
                if (img) {
                    const imgSrc = img.src;
                    const largeSrc = imgSrc.replace('/thumb/', '/large/');
                    
                    pickerHTML += `
                        <div class="col-md-2">
                            <div class="card card-flush h-100" style="cursor: pointer;" onclick="selectMediaImage('${largeSrc}', ${mediaId})">
                                <div class="card-body p-0">
                                    <img src="${imgSrc}" class="w-100" style="height: 150px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    `;
                }
            });
            
            grid.innerHTML = pickerHTML;
        })
        .catch(error => {
            grid.innerHTML = `
                <div class="col-12 text-center py-10">
                    <i class="fas fa-exclamation-triangle fs-3x text-danger mb-3"></i>
                    <p class="text-gray-600">Failed to load media. Please try again.</p>
                </div>
            `;
        });
}
</script>
