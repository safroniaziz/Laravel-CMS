@extends('layouts.dashboard.dashboard')

@section('title', 'Menus')
@section('menu', 'Menus')

@section('link')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-700">Menus</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h3 class="card-title">Menu Management</h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#menuModal" onclick="openCreateModal()">
                        <i class="fas fa-plus me-2"></i>Create Menu
                    </button>
                </div>
            </div>
            <div class="card-body py-4">
                @forelse($menus as $menu)
                    <div class="menu-card mb-5 border border-gray-300 rounded" data-menu-id="{{ $menu->id }}">
                        {{-- Menu Header --}}
                        <div class="menu-card-header bg-light p-4 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center flex-grow-1">
                                <button class="btn btn-sm btn-icon btn-light-primary me-3 toggle-menu-items" onclick="toggleMenuItems({{ $menu->id }})">
                                    <i class="fas fa-chevron-down transition-transform" id="chevron-{{ $menu->id }}"></i>
                                </button>
                                <div class="flex-grow-1">
                                    <h4 class="mb-1 fw-bold text-gray-800">{{ $menu->name }}</h4>
                                    <div class="d-flex align-items-center gap-3">
                                        <code class="text-primary fs-7">{{ $menu->location }}</code>
                                        <span class="badge badge-light-primary">{{ $menu->all_items_count ?? 0 }} items</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('menus.edit', $menu) }}" class="btn btn-sm btn-light-primary" title="Manage Items">
                                    <i class="fas fa-cog me-1"></i>Manage
                                </a>
                                <button class="btn btn-sm btn-light-primary" onclick='openEditModal(@json($menu))' title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-light-danger" onclick="deleteMenu({{ $menu->id }}, {{ $menu->all_items_count ?? 0 }})" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        {{-- Menu Items Preview (Collapsible) --}}
                        <div class="menu-items-preview collapse" id="menu-items-{{ $menu->id }}">
                            <div class="p-4 bg-white">
                                @if($menu->items && $menu->items->count() > 0)
                                    <div class="menu-structure">
                                        @foreach($menu->items->whereNull('parent_id') as $item)
                                            @include('admin.menus.partials.menu-item-preview', ['item' => $item, 'level' => 0])
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center text-muted py-5">
                                        <i class="fas fa-inbox fs-2x mb-3 d-block"></i>
                                        <p class="mb-0">No menu items yet. <a href="{{ route('menus.edit', $menu) }}">Add items</a></p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <i class="fas fa-bars fs-3x text-gray-400 mb-3"></i>
                        <p class="text-gray-600">No menus found.</p>
                    </div>
                @endforelse
            </div>
        </div>
        
    </div>
</div>

<!-- Menu Modal -->
<div class="modal fade" id="menuModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Create Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="menuForm">
                <div class="modal-body">
                    <input type="hidden" id="menu_id">
                    
                    <div class="mb-4">
                        <label class="required form-label">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Main Navigation" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="required form-label">Location</label>
                        <input type="text" id="location" class="form-control" placeholder="header, footer, sidebar" required>
                        <small class="text-muted">Identifier for where this menu appears</small>
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

@push('styles')
<style>
.menu-card {
    transition: all 0.3s;
}

.menu-card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
}

.toggle-menu-items i {
    transition: transform 0.3s;
}

.menu-item-preview {
    transition: all 0.2s;
}

.menu-item-preview:hover {
    background-color: #f5f8fa !important;
    border-color: #009ef7 !important;
}

.child-item .menu-item-preview {
    border-left: 3px solid #009ef7;
}

.bg-light-hover:hover {
    background-color: #f5f8fa;
}
</style>
@endpush

@push('scripts')
<script>
let isEditMode = false;

function openCreateModal() {
    isEditMode = false;
    document.getElementById('modalTitle').textContent = 'Create Menu';
    document.getElementById('menuForm').reset();
    document.getElementById('menu_id').value = '';
}

function openEditModal(menu) {
    isEditMode = true;
    document.getElementById('modalTitle').textContent = 'Edit Menu';
    document.getElementById('menu_id').value = menu.id;
    document.getElementById('name').value = menu.name;
    document.getElementById('location').value = menu.location;
    
    const modal = new bootstrap.Modal(document.getElementById('menuModal'));
    modal.show();
}

document.getElementById('menuForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const menuId = document.getElementById('menu_id').value;
    const url = isEditMode ? baseUrl + `/menus/${menuId}` : baseUrl + '/menus';
    const method = isEditMode ? 'PUT' : 'POST';
    
    const formData = {
        name: document.getElementById('name').value,
        location: document.getElementById('location').value
    };
    
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
            if (data.redirect) {
                window.location.href = data.redirect;
            } else {
                Swal.fire({
                    icon: 'success',
                    title: isEditMode ? 'Updated!' : 'Created!',
                    text: data.message,
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            }
        }
    })
    .catch(error => {
        submitBtn.removeAttribute('data-kt-indicator');
        submitBtn.disabled = false;
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to save menu',
            confirmButtonText: 'OK'
        });
    });
});

function deleteMenu(id, itemsCount) {
    if (itemsCount > 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Cannot Delete',
            text: `This menu has ${itemsCount} item(s). Please delete menu items first.`,
            confirmButtonText: 'OK'
        });
        return;
    }
    
    Swal.fire({
        title: 'Delete Menu?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(baseUrl + `/menus/${id}`, {
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

function toggleMenuItems(menuId) {
    const collapseEl = document.getElementById(`menu-items-${menuId}`);
    const chevronEl = document.getElementById(`chevron-${menuId}`);
    const bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: true });
    
    // Toggle chevron rotation
    setTimeout(() => {
        if (collapseEl.classList.contains('show')) {
            chevronEl.style.transform = 'rotate(180deg)';
        } else {
            chevronEl.style.transform = 'rotate(0deg)';
        }
    }, 10);
}
</script>
@endpush
