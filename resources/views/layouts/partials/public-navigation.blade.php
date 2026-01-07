<!-- Simple Public Navigation -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-sm">
    <div class="w-full lg:w-[80%] max-w-none mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-lg flex items-center justify-center">
                        <i class="fas fa-building text-white text-lg"></i>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-lg font-bold text-gray-900">Smart Village</h1>
                        <p class="text-xs text-gray-600">Ketapang Baru</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            @php
                $headerMenu = \App\Models\Menu::where('location', 'header')
                    ->with(['items' => function($q) {
                        $q->whereNull('parent_id')->orderBy('order');
                    }, 'items.children' => function($q) {
                        $q->orderBy('order');
                    }])
                    ->first();
                    
                // DEBUG
                \Log::info('Header Menu Check', [
                    'exists' => $headerMenu ? 'yes' : 'no',
                    'items_count' => $headerMenu ? $headerMenu->items->count() : 0
                ]);
            @endphp
            
            <!-- DEBUG OUTPUT -->
            {{-- Menu: {{ $headerMenu ? $headerMenu->name : 'NULL' }} | Items: {{ $headerMenu ? $headerMenu->items->count() : 0 }} --}}
            
            <div class="hidden lg:flex items-center gap-x-6">
                @if($headerMenu && $headerMenu->items->count())
                    @foreach($headerMenu->items as $item)
                        @if($item->children->count())
                            <!-- Dropdown Menu -->
                            <div class="relative group">
                                <button class="text-gray-700 hover:text-blue-600 font-medium transition-colors inline-flex items-center group/dropdown">
                                    @if($item->icon_class)
                                        <i class="{{ $item->icon_class }} mr-2"></i>
                                    @endif
                                    <span class="inline-block">{{ $item->title }}</span>
                                    <i class="fas fa-chevron-down text-xs ml-1.5 inline-block w-3 transition-transform duration-200 group-hover/dropdown:rotate-180"></i>
                                </button>
                                <div class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 -translate-y-2 z-50 overflow-hidden">
                                    <div class="py-1">
                                        @foreach($item->children as $child
                                            <a href="{{ $child->full_url }}" 
                                               target="{{ $child->target }}"
                                               class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-600 transition-all duration-150 group/item">
                                                @if($child->icon_class)
                                                    <i class="{{ $child->icon_class }} w-4 text-center"></i>
                                                @endif
                                                <span class="flex-1">{{ $child->title }}</span>
                                                <i class="fas fa-chevron-right text-xs opacity-0 group-hover/item:opacity-100 transition-opacity duration-150"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Regular Link -->
                            <a href="{{ $item->full_url }}" 
                               target="{{ $item->target }}"
                               class="text-gray-700 hover:text-blue-600 font-medium transition-colors {{ request()->is(trim($item->url, '/')) ? 'text-blue-600 font-semibold' : '' }}">
                                @if($item->icon_class)
                                    <i class="{{ $item->icon_class }} mr-2"></i>
                                @endif
                                {{ $item->title }}
                            </a>
                        @endif
                    @endforeach
                @else
                    <!-- Fallback jika menu belum diatur -->
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 font-medium">Beranda FALLBACK</a>
                    <a href="{{ url('about') }}" class="text-gray-700 hover:text-blue-600 font-medium">Tentang FALLBACK</a>
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600 focus:outline-none focus:text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @if($headerMenu && $headerMenu->items->count())
                    @foreach($headerMenu->items as $item)
                        <a href="{{ $item->full_url }}" 
                           target="{{ $item->target }}"
                           class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors {{ request()->is(trim($item->url, '/')) ? 'text-blue-600 bg-blue-50' : '' }}">
                            @if($item->icon_class)
                                <i class="{{ $item->icon_class }} mr-2"></i>
                            @endif
                            {{ $item->title }}
                        </a>
                        @if($item->children->count())
                            @foreach($item->children as $child)
                                <a href="{{ $child->full_url }}" 
                                   target="{{ $child->target }}"
                                   class="block px-3 py-2 pl-8 text-sm text-gray-600 hover:text-blue-600 transition-colors {{ request()->is(trim($child->url, '/')) ? 'text-blue-600 bg-blue-50' : '' }}">
                                    @if($child->icon_class)
                                        <i class="{{ $child->icon_class }} mr-2"></i>
                                    @endif
                                    {{ $child->title }}
                                </a>
                            @endforeach
                        @endif
                    @endforeach
                @else
                    <a href="{{ url('/') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">Beranda</a>
                    <a href="{{ url('about') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">Tentang</a>
                @endif
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script>
