@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Menu - ' . $menu->name)
@section('menu', 'Menus')

@section('link')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('menus.index') }}" class="text-muted">Menus</a></li>
    <li class="breadcrumb-item text-gray-700">{{ $menu->name }}</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <div class="row g-5">
            <!-- Left: Menu Details -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Menu Details</h3>
                    </div>
                    <div class="card-body">
                        <form id="menuForm">
                            <div class="mb-4">
                                <label class="required form-label">Name</label>
                                <input type="text" id="menu_name" class="form-control" value="{{ $menu->name }}" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="required form-label">Location</label>
                                <input type="text" id="menu_location" class="form-control" value="{{ $menu->location }}" required>
                                <small class="text-muted">Identifier for where this menu appears</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-2"></i>Update Menu
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Add Menu Item -->
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="card-title">Add Menu Item</h3>
                    </div>
                    <div class="card-body">
                        <form id="addItemForm">
                            <div class="mb-3">
                                <label class="required form-label">Title</label>
                                <input type="text" id="item_title" class="form-control" placeholder="Home" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="required form-label">URL</label>
                                <input type="text" id="item_url" class="form-control" placeholder="/" required>
                                <small class="text-muted">Full URL or path (/, /about, https://...)</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Parent</label>
                                <select id="item_parent" class="form-select">
                                    <option value="">None (Top Level)</option>
                                    @foreach($menu->allItems as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Icon (Optional)</label>
                                <input type="text" id="item_icon_class" class="form-control" placeholder="fas fa-home" readonly>
                                <button type="button" class="btn btn-sm btn-light-primary mt-2" onclick="openIconPicker('item_icon_class')">
                                    <i class="fas fa-icons me-1"></i>Choose Icon
                                </button>
                                <button type="button" class="btn btn-sm btn-light-danger mt-2" onclick="clearIcon('item_icon_class')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Target</label>
                                <select id="item_target" class="form-select">
                                    <option value="_self">Same Window</option>
                                    <option value="_blank">New Window</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-2"></i>Add Item
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Right: Menu Items -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Menu Structure</h3>
                        <div class="card-toolbar">
                            <span class="badge badge-light-primary">{{ $menu->items->count() }} top-level items</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Info Alert -->
                        <div class="alert alert-info d-flex align-items-center mb-4">
                            <i class="fas fa-info-circle fs-2x me-3"></i>
                            <div>
                                <h5 class="mb-2"><i class="fas fa-arrows-alt me-2"></i>Cara Mengelola Menu</h5>
                                <ul class="mb-0 ps-3">
                                    <li><strong>Drag & Drop:</strong> Untuk mengubah <u>urutan</u> menu item (naik/turun)</li>
                                    <li><strong>Ubah Parent:</strong> Klik tombol <i class="fas fa-edit"></i> Edit, lalu pilih Parent baru di dropdown</li>
                                    <li><strong>Hapus Item:</strong> Klik tombol <i class="fas fa-trash text-danger"></i> untuk menghapus</li>
                                </ul>
                                <small class="text-muted"><i class="fas fa-lightbulb"></i> Tips: Item dengan indentasi adalah submenu (child). Drag hanya mengubah urutan, tidak memindahkan ke parent lain.</small>
                            </div>
                        </div>
                        
                        @if($menu->items->isEmpty())
                            <div class="text-center py-10">
                                <i class="fas fa-bars fs-3x text-gray-400 mb-3"></i>
                                <p class="text-gray-600">No menu items yet. Add one using the form on the left.</p>
                            </div>
                        @else
                            <div id="menu-items-list" class="menu-items-container">
                                @foreach($menu->items as $item)
                                    @include('admin.menus.partials.menu-item', ['item' => $item, 'level' => 0])
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editItemForm">
                <div class="modal-body">
                    <input type="hidden" id="edit_item_id">
                    
                    <div class="mb-3">
                        <label class="required form-label">Title</label>
                        <input type="text" id="edit_item_title" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="required form-label">URL</label>
                        <input type="text" id="edit_item_url" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Parent</label>
                        <select id="edit_item_parent" class="form-select">
                            <option value="">None (Top Level)</option>
                            @foreach($menu->allItems as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Choose parent menu item to create submenu</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                        <input type="text" id="edit_item_icon_class" class="form-control" readonly>
                        <button type="button" class="btn btn-sm btn-light-primary mt-2" onclick="openIconPicker('edit_item_icon_class')">
                            <i class="fas fa-icons me-1"></i>Choose Icon
                        </button>
                        <button type="button" class="btn btn-sm btn-light-danger mt-2" onclick="clearIcon('edit_item_icon_class')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Target</label>
                        <select id="edit_item_target" class="form-select">
                            <option value="_self">Same Window</option>
                            <option value="_blank">New Window</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Icon Picker Modal -->
<div class="modal fade" id="iconPickerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose Icon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="iconSearch" class="form-control mb-4" placeholder="Search icons...">
                <div id="iconGrid" class="row g-3">
                    <!-- Icons will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.menu-items-container {
    min-height: 200px;
}

.editable-menu-item {
    background: #f9f9f9;
    border: 1px solid #e4e6ef;
    border-radius: 4px;
    padding: 12px 15px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: move;
    transition: all 0.2s;
}

.editable-menu-item:hover {
    background: #fff;
    border-color: #d0d1d5;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

.editable-menu-item.child-item {
    margin-left: 40px;
    background: #fff;
    border-left: 3px solid #009ef7;
}

/* Progressive indentation for nested levels - increased spacing */
.editable-menu-item[data-level="0"] {
    margin-left: 0 !important;
    border-left: none !important;
}

.editable-menu-item[data-level="1"] {
    margin-left: 40px !important;
    position: relative;
}

.editable-menu-item[data-level="1"]::before {
    content: '';
    position: absolute;
    left: -20px;
    top: 50%;
    width: 15px;
    height: 2px;
    background: #009ef7;
}

.editable-menu-item[data-level="2"] {
    margin-left: 80px !important;
    border-left-color: #f97316 !important;
    position: relative;
}

.editable-menu-item[data-level="2"]::before {
    content: '';
    position: absolute;
    left: -20px;
    top: 50%;
    width: 15px;
    height: 2px;
    background: #f97316;
}

.editable-menu-item-info {
    flex: 1;
}

.editable-menu-item-title {
    font-weight: 600;
    color: #181c32;
    margin-bottom: 2px;
}

.editable-menu-item-url {
    font-size: 12px;
    color: #7e8299;
}

.editable-menu-item-actions {
    display: flex;
    gap: 5px;
}

/* Drag & Drop Styles */
.sortable-ghost {
    opacity: 0.4;
    background: #f5f8fa !important;
    border: 2px dashed #009ef7 !important;
}

.sortable-chosen {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    transform: scale(1.02);
}

.sortable-drag {
    opacity: 1;
    cursor: grabbing !important;
}

.editable-menu-item {
    cursor: grab;
}

.editable-menu-item:active {
    cursor: grabbing;
}
</style>
@endpush

@push('scripts')
<!-- SortableJS for Drag & Drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
// Update Menu
document.getElementById('menuForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = {
        name: document.getElementById('menu_name').value,
        location: document.getElementById('menu_location').value
    };
    
    fetch(`/menus/{{ $menu->id }}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: data.message,
                confirmButtonText: 'OK'
            });
        }
    });
});

// Add Menu Item
document.getElementById('addItemForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = {
        title: document.getElementById('item_title').value,
        url: document.getElementById('item_url').value,
        parent_id: document.getElementById('item_parent').value || null,
        icon_class: document.getElementById('item_icon_class').value,
        target: document.getElementById('item_target').value
    };
    
    fetch(`/menus/{{ $menu->id }}/items`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Added!',
                text: data.message,
                confirmButtonText: 'OK'
            }).then(() => {
                location.reload();
            });
        }
    });
});

// Edit Item
function editItem(item) {
    document.getElementById('edit_item_id').value = item.id;
    document.getElementById('edit_item_title').value = item.title;
    document.getElementById('edit_item_url').value = item.url;
    document.getElementById('edit_item_parent').value = item.parent_id || '';
    document.getElementById('edit_item_icon_class').value = item.icon_class || '';
    document.getElementById('edit_item_target').value = item.target;
    
    const modal = new bootstrap.Modal(document.getElementById('editItemModal'));
    modal.show();
}

document.getElementById('editItemForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const itemId = document.getElementById('edit_item_id').value;
    const formData = {
        title: document.getElementById('edit_item_title').value,
        url: document.getElementById('edit_item_url').value,
        parent_id: document.getElementById('edit_item_parent').value || null,
        icon_class: document.getElementById('edit_item_icon_class').value,
        target: document.getElementById('edit_item_target').value
    };
    
    fetch(`/menu-items/${itemId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: data.message,
                confirmButtonText: 'OK'
            }).then(() => {
                location.reload();
            });
        }
    });
});

// Delete Item
function deleteItem(id) {
    Swal.fire({
        title: 'Delete Menu Item?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/menu-items/${id}`, {
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

// Initialize Drag & Drop with SortableJS
document.addEventListener('DOMContentLoaded', function() {
    const menuList = document.getElementById('menu-items-list');
    
    if (menuList) {
        new Sortable(menuList, {
            animation: 150,
            handle: '.editable-menu-item',
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                // Collect new order - preserve parent_id from data
                const items = [];
                document.querySelectorAll('.editable-menu-item').forEach((el, index) => {
                    // Get parent_id from closest parent structure or data attribute
                    const parentEl = el.closest('.editable-menu-item[data-id]');
                    const dataParentId = el.getAttribute('data-parent-id');
                    
                    items.push({
                        id: el.getAttribute('data-id'),
                        order: index,
                        parent_id: dataParentId || null
                    });
                });
                
                // Save to backend
                saveMenuOrder(items);
            }
        });
    }
});

function saveMenuOrder(items) {
    fetch(`/menus/{{ $menu->id }}/order`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ items: items })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show subtle toast notification
            const toast = document.createElement('div');
            toast.className = 'position-fixed bottom-0 end-0 p-3';
            toast.style.zIndex = '11';
            toast.innerHTML = `
                <div class="toast show" role="alert">
                    <div class="toast-body bg-success text-white rounded">
                        <i class="fas fa-check me-2"></i>Menu order updated
                    </div>
                </div>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2000);
        }
    })
    .catch(error => {
        console.error('Error saving menu order:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to save menu order',
            confirmButtonText: 'OK'
        });
    });
}

// Icon Picker Functionality
const popularIcons = [
    'fa-home', 'fa-user', 'fa-users', 'fa-cog', 'fa-envelope', 'fa-phone', 'fa-building',
    'fa-briefcase', 'fa-graduation-cap', 'fa-book', 'fa-file-alt', 'fa-image', 'fa-video',
    'fa-music', 'fa-heart', 'fa-star', 'fa-bookmark', 'fa-calendar', 'fa-clock', 'fa-map-marker-alt',
    'fa-globe', 'fa-search', 'fa-shopping-cart', 'fa-credit-card', 'fa-gift', 'fa-trophy',
    'fa-award', 'fa-medal', 'fa-certificate', 'fa-bullhorn', 'fa-comment', 'fa-comments',
    'fa-thumbs-up', 'fa-thumbs-down', 'fa-share', 'fa-link', 'fa-download', 'fa-upload',
    'fa-save', 'fa-trash', 'fa-edit', 'fa-plus', 'fa-minus', 'fa-check', 'fa-times',
    'fa-arrow-right', 'fa-arrow-left', 'fa-arrow-up', 'fa-arrow-down', 'fa-bars', 'fa-th',
    'fa-list', 'fa-chart-bar', 'fa-chart-line', 'fa-chart-pie', 'fa-database', 'fa-server',
    'fa-laptop', 'fa-mobile', 'fa-tablet', 'fa-camera', 'fa-print', 'fa-wrench', 'fa-tools'
];

let currentIconField = null;

function openIconPicker(fieldId) {
    currentIconField = fieldId;
    const modal = new bootstrap.Modal(document.getElementById('iconPickerModal'));
    
    // Populate icon grid
    const iconGrid = document.getElementById('iconGrid');
    iconGrid.innerHTML = '';
    
    popularIcons.forEach(icon => {
        const col = document.createElement('div');
        col.className = 'col-6 col-sm-4 col-md-3 col-lg-2';
        col.innerHTML = `
            <div class="icon-item text-center p-3 border rounded cursor-pointer hover-primary" 
                 onclick="selectIcon('fas ${icon}')" 
                 style="cursor: pointer; transition: all 0.2s;"
                 onmouseover="this.style.background='#f5f8fa'; this.style.borderColor='#009ef7'"
                 onmouseout="this.style.background=''; this.style.borderColor=''">
                <i class="fas ${icon} fs-2x mb-2"></i>
                <div class="text-muted fs-8">${icon.replace('fa-', '')}</div>
            </div>
        `;
        iconGrid.appendChild(col);
    });
    
    modal.show();
}

function selectIcon(iconClass) {
    if (currentIconField) {
        document.getElementById(currentIconField).value = iconClass;
    }
    bootstrap.Modal.getInstance(document.getElementById('iconPickerModal')).hide();
}

function clearIcon(fieldId) {
    document.getElementById(fieldId).value = '';
}

// Icon search functionality
document.addEventListener('DOMContentLoaded', function() {
    const iconSearch = document.getElementById('iconSearch');
    if (iconSearch) {
        iconSearch.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.icon-item').forEach(item => {
                const iconName = item.textContent.toLowerCase();
                if (iconName.includes(searchTerm)) {
                    item.parentElement.style.display = '';
                } else {
                    item.parentElement.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endpush
