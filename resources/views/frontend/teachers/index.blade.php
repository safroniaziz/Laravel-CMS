@extends('layouts.frontend')

@section('content')
{{-- Hero Section --}}
@if($teacherSettings['hero']['enabled'])
<section style="padding: 100px 0 80px; background: linear-gradient(135deg, {{ $teacherSettings['hero']['gradient_start'] }} 0%, {{ $teacherSettings['hero']['gradient_end'] }} 100%); position: relative; overflow: hidden;">
    {{-- Animated Background --}}
    <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
    <div style="position: absolute; bottom: -150px; left: -150px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite reverse;"></div>
    
    <div class="container" style="position: relative; z-index: 2; text-align: center;">
        <h1 style="font-size: 56px; font-weight: 900; color: #fff; margin: 0 0 20px 0; line-height: 1.1;">
            {{ $teacherSettings['hero']['title'] }}
        </h1>
        <p style="font-size: 20px; color: rgba(255,255,255,0.9); max-width: 600px; margin: 0 auto; line-height: 1.6;">
            {{ $teacherSettings['hero']['subtitle'] }}
        </p>
    </div>
</section>
@endif

{{-- Teachers Content --}}
<section style="padding: 80px 0; background: linear-gradient(180deg, #f8fafc 0%, #fff 100%);">
    <div class="container">
        {{-- Layout Content --}}
        @if(isset($layoutView))
            @include($layoutView, ['teachers' => $teachers])
        @endif


        {{-- AJAX Load More Button --}}
        @if($teachers->hasMorePages())
            <div style="margin-top: 60px; text-align: center;">
                <button id="load-more-btn" data-page="1" style="padding: 16px 48px; background: linear-gradient(135deg, #1a246a, #151945); color: #fff; border: none; border-radius: 12px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 6px 20px rgba(26, 36, 106, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 30px rgba(26, 36, 106, 0.4)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 6px 20px rgba(26, 36, 106, 0.3)';">
                    <span class="btn-text">Muat Lebih Banyak</span>
                    <span class="btn-loading" style="display: none;">
                        <i class="fas fa-spinner fa-spin"></i> Memuat...
                    </span>
                </button>
            </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (!loadMoreBtn) return;

    let currentPage = 1;
    let isLoading = false;

    loadMoreBtn.addEventListener('click', function() {
        if (isLoading) return;
        
        isLoading = true;
        const btnText = this.querySelector('.btn-text');
        const btnLoading = this.querySelector('.btn-loading');
        
        // Show loading state
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline';
        this.style.cursor = 'wait';
        
        // Fetch next page
        fetch(`{{ route('teachers.index') }}?page=${currentPage + 1}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Insert new content
            const container = document.getElementById('teachers-grid-container') || document.querySelector('[data-aos="fade-up"]');
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = data.html;
            
            // Append each card smoothly
            Array.from(tempDiv.children).forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    container.appendChild(card);
                    
                    // Animate in
                    requestAnimationFrame(() => {
                        card.style.transition = 'all 0.5s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    });
                }, index * 50);
            });
            
            currentPage = data.current_page;
            
            // Hide button if no more pages
            if (!data.has_more) {
                setTimeout(() => {
                    loadMoreBtn.style.transition = 'all 0.3s';
                    loadMoreBtn.style.opacity = '0';
                    loadMoreBtn.style.transform = 'scale(0.9)';
                    setTimeout(() => loadMoreBtn.remove(), 300);
                }, 500);
            } else {
                // Reset button state
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
                loadMoreBtn.style.cursor = 'pointer';
            }
            
            isLoading = false;
        })
        .catch(error => {
            console.error('Error loading more teachers:', error);
            alert('Gagal memuat data. Silakan coba lagi.');
            btnText.style.display = 'inline';
            btnLoading.style.display = 'none';
            loadMoreBtn.style.cursor = 'pointer';
            isLoading = false;
        });
    });
});
</script>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
</style>
@endsection
