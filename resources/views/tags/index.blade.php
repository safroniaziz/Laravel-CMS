@extends('layouts.dashboard.dashboard')

@section('title', 'Tags')
@section('menu', 'Tags')

@section('link')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-700">Tags</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h3 class="card-title">Tags Management</h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tagModal" onclick="openCreateModal()">
                        <i class="fas fa-plus me-2"></i>Create Tag
                    </button>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-200px">Name</th>
                                <th class="min-w-150px">Slug</th>
                                <th class="w-100px text-center">Posts</th>
                                <th class="w-150px text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tags-table">
                            @forelse($tags as $tag)
                            <tr data-tag-id="{{ $tag->id }}">
                                <td>
                                    <span class="badge badge-light-info fs-7 fw-bold">{{ $tag->name }}</span>
                                </td>
                                <td><code class="text-info">{{ $tag->slug }}</code></td>
                                <td class="text-center">
                                    <span class="badge badge-light-primary">{{ $tag->posts_count ?? 0 }}</span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-icon btn-light-primary" onclick="openEditModal({{ $tag->id }}, '{{ addslashes($tag->name) }}', '{{ $tag->slug }}')" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-light-danger" onclick="deleteTag({{ $tag->id }}, {{ $tag->posts_count ?? 0 }})" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-10">
                                    <i class="fas fa-tags fs-3x text-gray-400 mb-3"></i>
                                    <p class="text-gray-600">No tags found.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- Tag Modal -->
<div class="modal fade" id="tagModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Create Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="tagForm">
                <div class="modal-body">
                    <input type="hidden" id="tag_id">
                    
                    <div class="mb-4">
                        <label class="required form-label">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter tag name" required>
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Slug <span class="text-muted">(Auto-generated)</span></label>
                        <input type="text" id="slug" class="form-control" placeholder="tag-slug" readonly style="background-color: #f5f8fa;">
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
@endsection

@push('scripts')
<script>
let isEditMode = false;

// Auto-generate slug from name
document.getElementById('name').addEventListener('keyup', function() {
    const name = this.value;
    const slug = name.toLowerCase()
        .replace(/[^\w\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/--+/g, '-')
        .trim();
    document.getElementById('slug').value = slug;
});

function openCreateModal() {
    isEditMode = false;
    document.getElementById('modalTitle').textContent = 'Create Tag';
    document.getElementById('tagForm').reset();
    document.getElementById('tag_id').value = '';
}

function openEditModal(id, name, slug) {
    isEditMode = true;
    document.getElementById('modalTitle').textContent = 'Edit Tag';
    document.getElementById('tag_id').value = id;
    document.getElementById('name').value = name;
    document.getElementById('slug').value = slug;
    
    const modal = new bootstrap.Modal(document.getElementById('tagModal'));
    modal.show();
}

// Submit form
document.getElementById('tagForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const tagId = document.getElementById('tag_id').value;
    const url = isEditMode ? `/tags/${tagId}` : '/tags';
    const method = isEditMode ? 'PUT' : 'POST';
    
    const formData = {
        name: document.getElementById('name').value,
        slug: document.getElementById('slug').value
    };
    
    // Show loading
    submitBtn.setAttribute('data-kt-indicator', 'on');
    submitBtn.disabled = true;
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        submitBtn.removeAttribute('data-kt-indicator');
        submitBtn.disabled = false;
        
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: isEditMode ? 'Updated!' : 'Created!',
                text: data.message,
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                location.reload();
            });
        }
    })
    .catch(error => {
        submitBtn.removeAttribute('data-kt-indicator');
        submitBtn.disabled = false;
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to save tag',
            confirmButtonText: 'OK',
            confirmButtonColor: '#d33'
        });
    });
});

function deleteTag(id, postsCount) {
    if (postsCount > 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Cannot Delete',
            text: `This tag is used by ${postsCount} post(s). Please remove tag from posts first.`,
            confirmButtonText: 'OK',
            confirmButtonColor: '#f1416c'
        });
        return;
    }
    
    Swal.fire({
        title: 'Delete Tag?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/tags/${id}`, {
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
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to delete tag',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            });
        }
    });
}
</script>
@endpush
