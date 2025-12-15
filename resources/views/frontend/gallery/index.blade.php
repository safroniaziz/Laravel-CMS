@extends('layouts.frontend')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #1a246a 0%, #2d3a8c 50%, #4a5fcf 100%); padding: 80px 0; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -80px; left: -80px; width: 300px; height: 300px; background: rgba(255,255,255,0.03); border-radius: 50%;"></div>
    
    <div class="container" style="max-width: 1300px; margin: 0 auto; padding: 0 15px; position: relative; z-index: 2;">
        <div style="text-align: center;">
            <span style="display: inline-block; padding: 8px 24px; background: rgba(255,255,255,0.15); border-radius: 30px; color: #fff; font-size: 14px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px; backdrop-filter: blur(10px);">
                📸 Galeri Foto
            </span>
            <h1 style="font-size: 48px; font-weight: 800; color: #fff; margin-bottom: 20px; line-height: 1.2;">
                Gallery <span style="color: #f97316;">Dokumentasi</span>
            </h1>
            <p style="font-size: 18px; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto; line-height: 1.7;">
                Koleksi foto kegiatan akademik, prestasi mahasiswa, dan momen berharga di lingkungan kampus
            </p>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section style="background: #f8fafc; padding: 30px 0; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 100;">
    <div class="container" style="max-width: 1300px; margin: 0 auto; padding: 0 15px;">
        <!-- Search Bar -->
        <div style="max-width: 500px; margin: 0 auto 20px;">
            <div style="position: relative;">
                <input type="text" id="searchInput" placeholder="Cari foto..." 
                       style="width: 100%; padding: 15px 50px 15px 20px; border: 2px solid #e2e8f0; border-radius: 30px; font-size: 16px; transition: all 0.3s; outline: none;"
                       onfocus="this.style.borderColor='#1a246a'; this.style.boxShadow='0 0 0 3px rgba(26,36,106,0.1)';"
                       onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                <button onclick="loadGallery()" style="position: absolute; right: 5px; top: 5px; width: 45px; height: 45px; background: linear-gradient(135deg, #1a246a, #4a5fcf); border: none; border-radius: 50%; cursor: pointer; color: #fff;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        
        <!-- Category Filters -->
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 10px;">
            <button class="category-btn active" data-category="" onclick="filterCategory('')"
                    style="padding: 10px 24px; border-radius: 30px; font-size: 14px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s;">
                Semua
            </button>
            @foreach($categories as $category)
            <button class="category-btn" data-category="{{ $category }}" onclick="filterCategory('{{ $category }}')"
                    style="padding: 10px 24px; border-radius: 30px; font-size: 14px; font-weight: 600; border: 2px solid #e2e8f0; cursor: pointer; transition: all 0.3s; background: #fff; color: #1a246a;">
                {{ $category }}
            </button>
            @endforeach
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section style="padding: 60px 0; background: #fff; min-height: 400px;">
    <div class="container" style="max-width: 1300px; margin: 0 auto; padding: 0 15px;">
        <!-- Loading Indicator -->
        <div id="loadingIndicator" style="display: none; text-align: center; padding: 60px;">
            <div style="display: inline-block; width: 50px; height: 50px; border: 4px solid #e2e8f0; border-top-color: #1a246a; border-radius: 50%; animation: spin 1s linear infinite;"></div>
            <p style="margin-top: 20px; color: #64748b;">Memuat gallery...</p>
        </div>
        
        <!-- Gallery Container -->
        <div id="galleryContainer" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px;">
            <!-- Gallery items will be loaded here -->
        </div>
        
        <!-- Empty State -->
        <div id="emptyState" style="display: none; text-align: center; padding: 80px 20px;">
            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                <i class="fas fa-images" style="font-size: 40px; color: #94a3b8;"></i>
            </div>
            <h3 style="font-size: 22px; font-weight: 700; color: #1a246a; margin-bottom: 10px;">Tidak Ada Hasil</h3>
            <p style="font-size: 15px; color: #64748b;">Coba gunakan kata kunci atau filter yang berbeda.</p>
        </div>
        
        <!-- Pagination Info -->
        <div id="paginationInfo" style="text-align: center; margin-top: 40px; color: #64748b; font-size: 14px;"></div>
        
        <!-- Load More Button -->
        <div id="loadMoreContainer" style="text-align: center; margin-top: 30px;">
            <button id="loadMoreBtn" onclick="loadMore()" style="display: none; padding: 15px 50px; background: linear-gradient(135deg, #1a246a, #4a5fcf); color: #fff; border: none; border-radius: 30px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(26,36,106,0.3);"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(26,36,106,0.4)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(26,36,106,0.3)';">
                <i class="fas fa-plus me-2"></i> Muat Lebih Banyak
            </button>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.95); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <button onclick="closeLightbox()" style="position: absolute; top: 30px; right: 30px; width: 50px; height: 50px; background: rgba(255,255,255,0.1); border: none; border-radius: 50%; cursor: pointer; color: #fff; font-size: 24px; transition: background 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
        <i class="fas fa-times"></i>
    </button>
    <div style="max-width: 1000px; text-align: center;">
        <img id="lightbox-image" src="" alt="" style="max-width: 100%; max-height: 70vh; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
        <h4 id="lightbox-title" style="color: #fff; font-size: 24px; font-weight: 700; margin-top: 25px;"></h4>
        <p id="lightbox-desc" style="color: rgba(255,255,255,0.7); font-size: 16px; margin-top: 10px;"></p>
    </div>
</div>

<style>
@keyframes spin {
    to { transform: rotate(360deg); }
}

.category-btn.active {
    background: linear-gradient(135deg, #1a246a, #4a5fcf) !important;
    color: #fff !important;
    border-color: transparent !important;
    box-shadow: 0 4px 15px rgba(26,36,106,0.3);
}

.category-btn:hover:not(.active) {
    border-color: #1a246a !important;
    background: #f8fafc !important;
}

@media (max-width: 768px) {
    #galleryContainer {
        grid-template-columns: 1fr !important;
    }
}
</style>

<script>
let currentPage = 1;
let currentCategory = '';
let currentSearch = '';
let isLoading = false;
let hasMore = true;
let totalLoaded = 0;

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    loadGallery();
    
    // Search on Enter key
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            loadGallery();
        }
    });
    
    // Debounced search on typing
    let searchTimeout;
    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => loadGallery(), 500);
    });
});

function loadGallery(append = false) {
    if (isLoading) return;
    
    if (!append) {
        currentPage = 1;
        currentSearch = document.getElementById('searchInput').value;
        totalLoaded = 0;
    }
    
    isLoading = true;
    
    const container = document.getElementById('galleryContainer');
    const loading = document.getElementById('loadingIndicator');
    const empty = document.getElementById('emptyState');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const paginationInfo = document.getElementById('paginationInfo');
    
    if (!append) {
        container.innerHTML = '';
        container.style.display = 'none';
    }
    loading.style.display = 'block';
    empty.style.display = 'none';
    loadMoreBtn.style.display = 'none';
    
    const params = new URLSearchParams({
        page: currentPage,
        per_page: 12,
        search: currentSearch,
        category: currentCategory
    });
    
    fetch(`{{ route('gallery') }}?${params.toString()}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        loading.style.display = 'none';
        
        if (data.empty && currentPage === 1) {
            empty.style.display = 'block';
            paginationInfo.innerHTML = '';
            totalLoaded = 0;
        } else {
            container.style.display = 'grid';
            
            if (append) {
                container.insertAdjacentHTML('beforeend', data.html);
            } else {
                container.innerHTML = data.html;
            }
            
            // Update total loaded count
            const p = data.pagination;
            totalLoaded = append ? totalLoaded + (p.to - p.from + 1) : p.to;
            
            // Update pagination info - show 1 to totalLoaded of total
            paginationInfo.innerHTML = `Menampilkan 1 - ${totalLoaded} dari ${p.total} foto`;
            
            // Show/hide load more button
            hasMore = data.has_more;
            loadMoreBtn.style.display = hasMore ? 'inline-block' : 'none';
        }
        
        isLoading = false;
    })
    .catch(error => {
        console.error('Error:', error);
        loading.style.display = 'none';
        isLoading = false;
    });
}

function loadMore() {
    currentPage++;
    loadGallery(true);
}

function filterCategory(category) {
    currentCategory = category;
    
    // Update active button
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.category === category) {
            btn.classList.add('active');
        }
    });
    
    loadGallery();
}

function openLightbox(src, title, desc) {
    document.getElementById('lightbox-image').src = src;
    document.getElementById('lightbox-title').textContent = title;
    document.getElementById('lightbox-desc').textContent = desc;
    document.getElementById('lightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = 'auto';
}

document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
});
</script>
@endsection
