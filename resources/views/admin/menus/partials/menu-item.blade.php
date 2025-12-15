<div class="editable-menu-item @if($level > 0) child-item @endif" 
     data-id="{{ $item->id }}" 
     data-parent-id="{{ $item->parent_id }}"
     data-level="{{ $level }}">
    <div class="editable-menu-item-info">
        <div class="editable-menu-item-title">
            @if($item->icon)
                <i class="{{ $item->icon }} me-2"></i>
            @endif
            {{ $item->title }}
            @if($item->target === '_blank')
                <i class="fas fa-external-link-alt text-muted ms-1" style="font-size: 10px;"></i>
            @endif
        </div>
        <div class="editable-menu-item-url">
            <code>{{ $item->url }}</code>
            <span class="text-muted ms-2">• {{ ucfirst($item->type) }}</span>
        </div>
    </div>
    <div class="editable-menu-item-actions">
        <button class="btn btn-sm btn-icon btn-light-primary" onclick='editItem(@json($item))' title="Edit">
            <i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-icon btn-light-danger" onclick="deleteItem({{ $item->id }})" title="Delete">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</div>

@if($item->children->count() > 0)
    @foreach($item->children as $child)
        @include('admin.menus.partials.menu-item', ['item' => $child, 'level' => $level + 1])
    @endforeach
@endif
