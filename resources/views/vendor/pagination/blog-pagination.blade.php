@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" style="display: flex; justify-content: center; align-items: center; gap: 8px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 44px; height: 44px; padding: 0 16px; background: #f1f5f9; color: #cbd5e1; text-decoration: none; border-radius: {{ $blogSettings['pagination']['border_radius'] ?? 10 }}px; font-size: 14px; font-weight: 600; border: 2px solid #e2e8f0; cursor: not-allowed; opacity: 0.6;">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="display: inline-flex; align-items: center; justify-content: center; min-width: 44px; height: 44px; padding: 0 16px; background: {{ $blogSettings['cards']['bg_color'] ?? '#fff' }}; color: #475569; text-decoration: none; border-radius: {{ $blogSettings['pagination']['border_radius'] ?? 10 }}px; font-size: 14px; font-weight: 600; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 2px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04);" onmouseover="this.style.background='{{ $blogSettings['pagination']['hover_bg'] ?? 'linear-gradient(135deg, #3b82f6, #2563eb)' }}'; this.style.color='#fff'; this.style.borderColor='{{ $blogSettings['cards']['primary_color'] ?? '#3b82f6' }}'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px {{ $blogSettings['cards']['primary_color'] ?? '#3b82f6' }}4D';" onmouseout="this.style.background='{{ $blogSettings['cards']['bg_color'] ?? '#fff' }}'; this.style.color='#475569'; this.style.borderColor='#e2e8f0'; this.style.transform='none'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)';">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 44px; height: 44px; color: #94a3b8; font-weight: 700;">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" style="display: inline-flex; align-items: center; justify-content: center; min-width: 44px; height: 44px; padding: 0 16px; background: {{ $blogSettings['pagination']['active_bg'] ?? 'linear-gradient(135deg, #3b82f6, #2563eb)' }}; color: #fff; text-decoration: none; border-radius: {{ $blogSettings['pagination']['border_radius'] ?? 10 }}px; font-size: 14px; font-weight: 700; border: 2px solid {{ $blogSettings['cards']['primary_color'] ?? '#3b82f6' }}; box-shadow: 0 4px 16px {{ $blogSettings['cards']['primary_color'] ?? '#3b82f6' }}66;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" style="display: inline-flex; align-items: center; justify-content: center; min-width: 44px; height: 44px; padding: 0 16px; background: {{ $blogSettings['cards']['bg_color'] ?? '#fff' }}; color: #475569; text-decoration: none; border-radius: {{ $blogSettings['pagination']['border_radius'] ?? 10 }}px; font-size: 14px; font-weight: 600; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 2px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04);" onmouseover="this.style.background='{{ $blogSettings['pagination']['hover_bg'] ?? 'linear-gradient(135deg, #3b82f6, #2563eb)' }}'; this.style.color='#fff'; this.style.borderColor='{{ $blogSettings['cards']['primary_color'] ?? '#3b82f6' }}'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px {{ $blogSettings['cards']['primary_color'] ?? '#3b82f6' }}4D';" onmouseout="this.style.background='{{ $blogSettings['cards']['bg_color'] ?? '#fff' }}'; this.style.color='#475569'; this.style.borderColor='#e2e8f0'; this.style.transform='none'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)';">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" style="display: inline-flex; align-items: center; justify-content: center; min-width: 44px; height: 44px; padding: 0 16px; background: {{ $blogSettings['cards']['bg_color'] ?? '#fff' }}; color: #475569; text-decoration: none; border-radius: {{ $blogSettings['pagination']['border_radius'] ?? 10 }}px; font-size: 14px; font-weight: 600; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 2px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04);" onmouseover="this.style.background='{{ $blogSettings['pagination']['hover_bg'] ?? 'linear-gradient(135deg, #3b82f6, #2563eb)' }}'; this.style.color='#fff'; this.style.borderColor='{{ $blogSettings['cards']['primary_color'] ?? '#3b82f6' }}'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px {{ $blogSettings['cards']['primary_color'] ?? '#3b82f6' }}4D';" onmouseout="this.style.background='{{ $blogSettings['cards']['bg_color'] ?? '#fff' }}'; this.style.color='#475569'; this.style.borderColor='#e2e8f0'; this.style.transform='none'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)';">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 44px; height: 44px; padding: 0 16px; background: #f1f5f9; color: #cbd5e1; text-decoration: none; border-radius: {{ $blogSettings['pagination']['border_radius'] ?? 10 }}px; font-size: 14px; font-weight: 600; border: 2px solid #e2e8f0; cursor: not-allowed; opacity: 0.6;">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </nav>
@endif
