@extends('layouts.dashboard.dashboard')

@section('title', 'Pages')
@section('menu', 'Pages')

@section('link')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-700">Pages</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="fas fa-search fs-3 position-absolute ms-5"></i>
                        <input type="text" id="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search pages..." />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end align-items-center gap-3">
                        <select id="statusFilter" class="form-select form-select-solid w-150px">
                            <option value="">All Status</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        <a href="{{ route('pages.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Page
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="pages_table">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#pages_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-200px">Page</th>
                                <th class="min-w-100px">Slug</th>
                                <th class="min-w-100px">Template</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-100px">Author</th>
                                <th class="min-w-100px">Date</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse($pages as $page)
                            <tr data-page-id="{{ $page->id }}">
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="{{ $page->id }}" />
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            @if($page->featured_image)
                                                <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" />
                                            @else
                                                <div class="symbol-label bg-light-primary">
                                                    <i class="fas fa-file-alt fs-2 text-primary"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('pages.edit', $page) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $page->title }}</a>
                                            <span class="text-muted fs-7">{{ Str::limit(strip_tags($page->content), 50) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="/{{ $page->slug }}" target="_blank" class="text-primary text-hover-dark">
                                        /{{ $page->slug }}
                                    </a>
                                </td>
                                <td>
                                    @if($page->template)
                                        <span class="badge badge-light-info">{{ $page->template->name }}</span>
                                    @else
                                        <span class="text-muted">Default</span>
                                    @endif
                                </td>
                                <td>
                                    @if($page->status == 'published')
                                        <span class="badge badge-light-success">Published</span>
                                    @else
                                        <span class="badge badge-light-warning">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">{{ $page->user->name ?? 'Unknown' }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $page->created_at->format('d M Y') }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        Actions
                                        <i class="fas fa-angle-down fs-5 ms-1"></i>
                                    </a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a href="/{{ $page->slug }}" target="_blank" class="menu-link px-3">
                                                <i class="fas fa-eye me-2"></i> View
                                            </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="{{ route('pages.edit', $page) }}" class="menu-link px-3">
                                                <i class="fas fa-edit me-2"></i> Edit
                                            </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 delete-page" data-id="{{ $page->id }}">
                                                <i class="fas fa-trash me-2"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-10">
                                    <div class="text-center">
                                        <i class="fas fa-file-alt fs-3x text-gray-400 mb-4"></i>
                                        <p class="text-gray-500">No pages yet. Create your first page!</p>
                                        <a href="{{ route('pages.create') }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i> Add Page
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pages->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <div class="text-muted">
                        Showing {{ $pages->firstItem() ?? 0 }} to {{ $pages->lastItem() ?? 0 }} of {{ $pages->total() }} pages
                    </div>
                    <div>
                        {{ $pages->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Search
    $('#search').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#pages_table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Status Filter
    $('#statusFilter').on('change', function() {
        const status = $(this).val();
        window.location = '{{ route("pages.index") }}' + (status ? '?status=' + status : '');
    });

    // Delete Page
    $('.delete-page').on('click', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Delete Page?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/pages/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Deleted!', response.message, 'success');
                            $(`tr[data-page-id="${id}"]`).fadeOut(300, function() {
                                $(this).remove();
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Failed to delete page', 'error');
                    }
                });
            }
        });
    });
});
</script>
@endpush
