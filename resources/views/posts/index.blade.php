@extends('layouts.dashboard.dashboard')

@section('title', 'Posts')
@section('menu', 'Posts')

@section('link')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-700">Posts</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <!-- Card -->
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" id="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search posts" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end gap-2" data-kt-user-table-toolbar="base">
                        <!-- Filter Status -->
                        <select id="filter-status" class="form-select form-select-sm w-150px">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                        
                        <!-- Filter Category -->
                        <select id="filter-category" class="form-select form-select-sm w-150px">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        
                        <!-- Add button -->
                        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            New Post
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Card body -->
            <div class="card-body py-4">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="posts_table">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px">#</th>
                            <th class="min-w-125px">Title</th>
                            <th class="min-w-100px">Category</th>
                            <th class="min-w-100px">Author</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-100px">Published</th>
                            <th class="text-end min-w-100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach($posts as $index => $post)
                        <tr>
                            <td>{{ $posts->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="{{ route('posts.edit', $post) }}" class="text-gray-800 text-hover-primary mb-1">
                                        {{ Str::limit($post->title, 60) }}
                                    </a>
                                    <span class="text-muted fs-7">{{ Str::limit($post->excerpt, 80) }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-light-primary">{{ $post->category->name ?? '-' }}</span>
                            </td>
                            <td>{{ $post->user->name ?? '-' }}</td>
                            <td>
                                @if($post->status == 'published')
                                    <span class="badge badge-light-success">Published</span>
                                @else
                                    <span class="badge badge-light-warning">Draft</span>
                                @endif
                            </td>
                            <td>
                                @if($post->published_at)
                                    {{ $post->published_at->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-icon btn-light-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-icon btn-light-danger delete-post" data-id="{{ $post->id }}" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="d-flex flex-stack flex-wrap pt-5">
                    <div class="fs-6 fw-semibold text-gray-700">
                        Showing {{ $posts->firstItem() ?? 0 }} to {{ $posts->lastItem() ?? 0 }} of {{ $posts->total() }} entries
                    </div>
                    <div class="pagination-wrapper">
                        {{ $posts->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@push('scripts')
<script>
// Search functionality
document.getElementById('search').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#posts_table tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});

// Filter status
document.getElementById('filter-status').addEventListener('change', function() {
    const status = this.value;
    window.location.href = `{{ route('posts.index') }}?status=${status}`;
});

// Filter category
document.getElementById('filter-category').addEventListener('change', function() {
    const category = this.value;
    window.location.href = `{{ route('posts.index') }}?category=${category}`;
});

// Delete post
document.querySelectorAll('.delete-post').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const postId = this.dataset.id;
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('posts') }}/${postId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Deleted!', data.message, 'success');
                        setTimeout(() => location.reload(), 1500);
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'Failed to delete post', 'error');
                });
            }
        });
    });
});
</script>
@endpush
