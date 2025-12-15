@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Post')
@section('menu', 'Posts')

@section('link')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-700">
        <a href="{{ route('posts.index') }}">Posts</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-700">Edit</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <form id="post_form" action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">Post Information</h3>
                        </div>
                        <div class="card-body">
                            <!-- Title -->
                            <div class="mb-5">
                                <label class="required form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                            </div>
                            
                            <!-- Slug -->
                            <div class="mb-5">
                                <label class="form-label">Slug <span class="text-muted">(Auto-generated)</span></label>
                                <input type="text" name="slug" id="slug" class="form-control" value="{{ $post->slug }}" readonly style="background-color: #f5f8fa;">
                                <div id="slug-feedback" class="mt-2" style="display: none;">
                                    <small id="slug-message"></small>
                                </div>
                            </div>
                            
                            <!-- Excerpt -->
                            <div class="mb-5">
                                <label class="form-label">Excerpt</label>
                                <textarea name="excerpt" class="form-control" rows="3">{{ $post->excerpt }}</textarea>
                            </div>
                            
                            <!-- Content -->
                            <div class="mb-5">
                                <label class="required form-label">Content</label>
                                <textarea name="content" id="content" class="form-control" rows="10" required>{{ $post->content }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Publish -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">Publish</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-5">
                                <label class="form-label required">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                                <small class="text-muted">Published: {{ $post->published_at ? $post->published_at->format('d M Y H:i') : '-' }}</small>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="fas fa-save me-2"></i>Update Post
                                </button>
                                <a href="{{ route('posts.index') }}" class="btn btn-light">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">Category</h3>
                        </div>
                        <div class="card-body">
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Featured Image -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">Featured Image</h3>
                        </div>
                        <div class="card-body">
                            <div id="image-preview" class="mb-3 text-center" style="{{ $post->featured_image ? '' : 'display: none;' }}">
                                <img src="{{ $post->featured_image }}" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                            <input type="hidden" name="featured_image" id="featured_image_input" value="{{ $post->featured_image }}">
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary btn-sm" onclick="openMediaPicker()">
                                    <i class="fas fa-images me-2"></i>Browse Media Library
                                </button>
                                <button type="button" class="btn btn-light btn-sm" onclick="document.getElementById('quick-upload').click()">
                                    <i class="fas fa-upload me-2"></i>Upload New
                                </button>
                                <input type="file" id="quick-upload" accept="image/*" style="display: none;">
                                @if($post->featured_image)
                                <button type="button" class="btn btn-light-danger btn-sm" onclick="removeImage()">
                                    <i class="fas fa-times me-2"></i>Remove
                                </button>
                                @endif
                            </div>
                            <small class="text-muted d-block mt-2 text-center">Recommended: 1600x1067 (3:2 ratio)</small>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tags</h3>
                        </div>
                        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                            <div class="row g-2">
                                @foreach($tags as $tag)
                                <div class="col-6">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                               id="tag_{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tag_{{ $tag->id }}">
                                            {{ $tag->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <!-- Include Media Picker Modal -->
        @include('media.partials.picker-modal')
        
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
// CKEditor
let editor;
ClassicEditor
    .create(document.querySelector('#content'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
        height: '400px'
    })
    .then(newEditor => {
        editor = newEditor;
    })
    .catch(error => {
        console.error(error);
    });

// Auto-generate slug from title
let slugCheckTimeout;
let isSlugAvailable = true; // Start as true for edit mode
const postId = {{ $post->id }};

document.querySelector('input[name="title"]').addEventListener('keyup', function() {
    const title = this.value;
    const slug = generateSlug(title);
    document.getElementById('slug').value = slug;
    
    // Clear previous timeout
    clearTimeout(slugCheckTimeout);
    
    if (slug) {
        // Check slug after 500ms of no typing
        slugCheckTimeout = setTimeout(() => checkSlugAvailability(slug), 500);
    } else {
        hideSlugFeedback();
    }
});

function generateSlug(text) {
    return text
        .toLowerCase()
        .replace(/[^\w\s-]/g, '') // Remove special chars
        .replace(/\s+/g, '-')      // Replace spaces with -
        .replace(/--+/g, '-')      // Replace multiple - with single -
        .trim();
}

function checkSlugAvailability(slug) {
    const feedback = document.getElementById('slug-feedback');
    const message = document.getElementById('slug-message');
    
    // Show checking state
    feedback.style.display = 'block';
    message.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
    message.style.color = '#666';
    
    fetch('{{ route("posts.check-slug") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ slug: slug, post_id: postId })
    })
    .then(response => response.json())
    .then(data => {
        isSlugAvailable = data.available;
        
        if (data.available) {
            message.innerHTML = '<i class="fas fa-check-circle"></i> ' + data.message;
            message.style.color = '#50cd89';
            document.getElementById('slug').style.borderColor = '#50cd89';
        } else {
            message.innerHTML = '<i class="fas fa-times-circle"></i> ' + data.message;
            message.style.color = '#f1416c';
            document.getElementById('slug').style.borderColor = '#f1416c';
        }
    })
    .catch(error => {
        console.error('Error checking slug:', error);
        hideSlugFeedback();
    });
}

function hideSlugFeedback() {
    document.getElementById('slug-feedback').style.display = 'none';
    document.getElementById('slug').style.borderColor = '';
    isSlugAvailable = true; // Reset to true for edit mode
}

// Quick Upload Handler
document.getElementById('quick-upload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    
    const formData = new FormData();
    formData.append('file', file);
    
    Swal.fire({
        title: 'Uploading...',
        text: 'Please wait',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
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
        Swal.close();
        if (data.success) {
            // Set the featured image
            document.getElementById('featured_image_input').value = data.preview.large;
            updateImagePreview(data.preview.large);
            
            Swal.fire({
                icon: 'success',
                title: 'Uploaded!',
                text: 'Image uploaded successfully',
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
    .catch(error => {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Upload Failed',
            text: 'Failed to upload image',
            confirmButtonText: 'OK'
        });
    });
    
    e.target.value = '';
});

// Remove Image
function removeImage() {
    document.getElementById('featured_image_input').value = '';
    document.getElementById('image-preview').style.display = 'none';
}


// Form Submit
document.getElementById('post_form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Check if slug is available
    if (!isSlugAvailable) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Slug!',
            text: 'The slug already exists or is invalid. Please change the title.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#d33'
        });
        return;
    }
    
    // Show confirmation dialog
    Swal.fire({
        title: 'Update Post?',
        text: "Are you sure you want to update this post?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            submitForm();
        }
    });
});

function submitForm() {
    const form = document.getElementById('post_form');
    const formData = new FormData(form);
    const contentData = editor.getData();
    formData.set('content', contentData);
    
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = data.redirect;
            });
        }
    })
    .catch(error => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to update post',
            confirmButtonText: 'OK',
            confirmButtonColor: '#d33'
        });
    });
}
</script>
@endpush
