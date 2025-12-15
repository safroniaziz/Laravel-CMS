{{-- Menu Item Preview Partial --}}
<div class="menu-item-preview-row {{ $level > 0 ? 'child-item' : '' }}" style="margin-left: {{ $level * 30 }}px;">
    <div class="menu-item-preview d-flex align-items-center p-3 mb-2 bg-light-hover border border-gray-300 rounded">
        {{-- Icon & Title --}}
        <div class="flex-grow-1 d-flex align-items-center gap-3">
            @if($item->icon_class)
                <div class="menu-item-icon">
                    <i class="{{ $item->icon_class }} text-primary fs-4"></i>
                </div>
            @else
                <div class="menu-item-icon">
                    <i class="fas fa-link text-gray-400 fs-6"></i>
                </div>
            @endif
            
            <div class="menu-item-info">
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-gray-800">{{ $item->title }}</span>
                    @if($item->children && $item->children->count() > 0)
                        <span class="badge badge-sm badge-light-info">
                            <i class="fas fa-chevron-down fs-8"></i>
                            {{ $item->children->count() }}
                        </span>
                    @endif
                </div>
                <div class="text-muted fs-7">{{ $item->url }}</div>
            </div>
        </div>
        
        {{-- Metadata --}}
        <div class="menu-item-meta d-flex align-items-center gap-2 me-3">
            @if($item->target === '_blank')
                <span class="badge badge-sm badge-light-primary" title="Opens in new window">
                    <i class="fas fa-external-link-alt"></i>
                </span>
            @endif
            <span class="badge badge-sm badge-light">{{ ucfirst($item->type) }}</span>
        </div>
    </div>
</div>

{{-- Render Children Recursively --}}
@if($item->children && $item->children->count() > 0)
    @foreach($item->children as $child)
        @include('admin.menus.partials.menu-item-preview', ['item' => $child, 'level' => $level + 1])
    @endforeach
@endif
