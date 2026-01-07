@extends('layouts.dashboard.dashboard')

@section('title', 'Teachers')
@section('menu', 'Teachers')

@section('link')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-700">Teachers</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="fas fa-search fs-3 position-absolute ms-5"></i>
                        <input type="text" id="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search teachers..." />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end align-items-center gap-3">
                        <select id="roleFilter" class="form-select form-select-solid w-150px">
                            <option value="">All Roles</option>
                            <option value="kaprodi">Kaprodi</option>
                            <option value="dosen">Dosen</option>
                        </select>
                        <select id="statusFilter" class="form-select form-select-solid w-150px">
                            <option value="">All Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Teacher
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="teachers_table">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#teachers_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-125px">Teacher</th>
                                <th class="min-w-125px">Role</th>
                                <th class="min-w-150px">Expertise</th>
                                <th class="min-w-100px">Publications</th>
                                <th class="min-w-100px">Status</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse($teachers as $teacher)
                            <tr data-teacher-id="{{ $teacher->id }}">
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="{{ $teacher->id }}" />
                                    </div>
                                </td>
                                <td class="d-flex align-items-center">
                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                        @if($teacher->photo)
                                            <div class="symbol-label">
                                                <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="w-100" />
                                            </div>
                                        @else
                                            <div class="symbol-label" style="background: {{ $teacher->gradient ?? 'linear-gradient(135deg, #667eea, #764ba2)' }}">
                                                <i class="fas {{ $teacher->icon ?? 'fa-user-tie' }} text-white fs-1"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('admin.teachers.edit', $teacher) }}" class="text-gray-800 text-hover-primary mb-1">{{ $teacher->name }}</a>
                                        <span class="text-muted">{{ $teacher->title }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light-{{ $teacher->role == 'kaprodi' ? 'warning' : 'primary' }}">
                                        {{ ucfirst($teacher->role) }}
                                    </span>
                                </td>
                                <td>
                                    @if($teacher->expertise && count($teacher->expertise) > 0)
                                        @foreach(array_slice($teacher->expertise, 0, 2) as $skill)
                                            <span class="badge badge-light-info me-1">{{ $skill }}</span>
                                        @endforeach
                                        @if(count($teacher->expertise) > 2)
                                            <span class="badge badge-light">+{{ count($teacher->expertise) - 2 }}</span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <span class="badge badge-light-primary">{{ $teacher->publications ?? 0 }} Pub</span>
                                        <span class="badge badge-light-warning">{{ $teacher->projects ?? 0 }} Proj</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input toggle-status" type="checkbox" data-id="{{ $teacher->id }}" {{ $teacher->is_active ? 'checked' : '' }} />
                                        <label class="form-check-label">{{ $teacher->is_active ? 'Active' : 'Inactive' }}</label>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        Actions
                                        <i class="fas fa-angle-down fs-5 ms-1"></i>
                                    </a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.teachers.edit', $teacher) }}" class="menu-link px-3">Edit</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 delete-teacher" data-id="{{ $teacher->id }}">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-10">
                                    <div class="text-center">
                                        <i class="fas fa-user-tie fs-3x text-gray-400 mb-4"></i>
                                        <p class="text-gray-500">No teachers yet. Add your first teacher!</p>
                                        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i> Add Teacher
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-5">
                    <div class="text-muted">
                        Showing {{ $teachers->firstItem() ?? 0 }} to {{ $teachers->lastItem() ?? 0 }} of {{ $teachers->total() }} teachers
                    </div>
                    <div>
                        {{ $teachers->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
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
        $('#teachers_table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Filters
    $('#roleFilter, #statusFilter').on('change', function() {
        const role = $('#roleFilter').val();
        const status = $('#statusFilter').val();
        
        window.location = '{{ route("admin.teachers.index") }}' + 
            '?role=' + role + '&is_active=' + status;
    });

    // Toggle Status
    $('.toggle-status').on('change', function() {
        const id = $(this).data('id');
        const isActive = $(this).is(':checked');
        
        $.ajax({
            url: baseUrl + `/admin/teachers/${id}/toggle`,
            method: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function() {
                toastr.error('Failed to update status');
            }
        });
    });

    // Delete Teacher
    $('.delete-teacher').on('click', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: baseUrl + `/admin/teachers/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $(`tr[data-teacher-id="${id}"]`).remove();
                    },
                    error: function() {
                        toastr.error('Failed to delete teacher');
                    }
                });
            }
        });
    });
});
</script>
@endpush
