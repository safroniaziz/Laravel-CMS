@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    /* Pulse Animation for Background Shapes */
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
    }

    /* Fun Campus Animations */
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-8px);
        }
        60% {
            transform: translateY(-4px);
        }
    }

    @keyframes sparkle {
        0%, 100% {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
        50% {
            transform: scale(1.2) rotate(180deg);
            opacity: 0.8;
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        33% {
            transform: translateY(-10px) rotate(5deg);
        }
        66% {
            transform: translateY(-5px) rotate(-3deg);
        }
    }

    /* Professional Dosen Card Hover Effects */
    .dosen-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .dosen-card:hover {
        transform: translateY(-12px);
    }

    .dosen-card:hover > div {
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        border-color: #d1d5db;
    }

    .dosen-card .photo-area {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .dosen-card:hover .photo-area {
        transform: scale(1.05);
    }

    .dosen-card .photo-area::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.6s ease;
    }

    .dosen-card:hover .photo-area::after {
        left: 100%;
    }

    /* Shine Effect Animation */
    @keyframes shine {
        0% {
            left: -100%;
        }
        50%, 100% {
            left: 150%;
        }
    }

    /* Hero Image Hover Effect */
    .hero-image:hover {
        transform: rotate(2deg) scale(1.02) !important;
    }

    .hero-image:hover img {
        transform: scale(1.05);
    }

    /* CTA Button Hover */
    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(251, 191, 36, 0.6) !important;
    }

    .cta-button:hover > div {
        opacity: 1 !important;
    }

    .cta-button:hover i {
        transform: translateX(5px) !important;
    }

    /* Enhanced News Card Hover Effects */
    .news-card-clean:hover {
        transform: translateY(-12px) scale(1.02) !important;
        box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important;
        border-color: #1a246a !important;
    }

    /* Image Container Hover Effects */
    .news-card-clean:hover .news-image-container img {
        transform: scale(1.1) rotate(1deg) !important;
        filter: brightness(1.1) !important;
    }

    .news-card-clean:hover .news-image-container div {
        transform: scale(1.05) !important;
        background: linear-gradient(135deg, #151945, #1a246a) !important;
    }

    .news-card-clean:hover .news-image-container i {
        color: rgba(255,255,255,0.5) !important;
        transform: scale(1.1) rotate(5deg) !important;
    }

    /* Overlay Effects */
    .news-card-clean:hover .news-image-overlay {
        opacity: 1 !important;
    }

    .news-card-clean:hover .news-image-overlay div {
        transform: translateY(0) !important;
    }

    .news-card-clean:hover .news-image-overlay i {
        transform: translateX(5px) !important;
        color: #fbbf24 !important;
    }

    /* Date Badge Effects */
    .news-card-clean:hover .news-date-badge {
        transform: translateY(-3px) scale(1.05) !important;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        background: rgba(255, 255, 255, 1) !important;
        border-color: #1a246a !important;
    }

    /* Category Badge Effects */
    .news-card-clean:hover .news-category-badge {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }

    /* Content Line Effects */
    .news-card-clean:hover .news-content-line {
        transform: scaleX(1) !important;
    }

    /* Text Content Effects */
    .news-card-clean:hover .news-title {
        color: #1a246a !important;
        transform: translateX(2px) !important;
    }

    .news-card-clean:hover .news-excerpt {
        color: #475569 !important;
    }

    /* Author Section Effects */
    .news-card-clean:hover .author-avatar {
        transform: scale(1.1) rotate(5deg) !important;
        box-shadow: 0 4px 15px rgba(26, 36, 106, 0.4) !important;
        background: linear-gradient(135deg, #8b5cf6, #1a246a) !important;
    }

    .news-card-clean:hover .author-name {
        color: #1e293b !important;
        transform: translateX(2px) !important;
    }

    .news-card-clean:hover .author-role {
        color: #1a246a !important;
    }

    /* Read More Button Effects */
    .news-card-clean:hover .read-more-btn {
        background: linear-gradient(135deg, #151945, #8b5cf6) !important;
        transform: translateY(-2px) scale(1.05) !important;
        box-shadow: 0 8px 25px rgba(30, 64, 175, 0.3) !important;
    }

    .news-card-clean:hover .read-more-btn i {
        transform: translateX(3px) !important;
        color: #fbbf24 !important;
    }

    /* Card Border Effects */
    .news-card-clean {
        position: relative !important;
    }

    .news-card-clean::before {
        content: '' !important;
        position: absolute !important;
        inset: -2px !important;
        background: linear-gradient(135deg, #1a246a, #8b5cf6, #1a246a) !important;
        border-radius: 16px !important;
        opacity: 0 !important;
        z-index: -1 !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
        background-size: 200% 200% !important;
        animation: gradientShift 3s ease infinite !important;
    }

    .news-card-clean:hover::before {
        opacity: 1 !important;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50% !important; }
        50% { background-position: 100% 50% !important; }
    }

    /* Stagger Animation for Multiple Cards */
    .news-slide {
        animation: slideInUp 0.6s ease-out !important;
    }

    @keyframes slideInUp {
        from {
            opacity: 0 !important;
            transform: translateY(30px) !important;
        }
        to {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    }

    /* Academic Card Hover */
    .academic-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        border-color: #d1d5db !important;
    }

    /* Alumni Card Hover */
    .alumni-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        border-color: #d1d5db !important;
    }

    /* Arrow Icon Animation */
    .arrow-icon:hover {
        transform: translateX(4px) !important;
        background: linear-gradient(135deg, #f97316, #ea580c) !important;
    }

    /* Clean Button Hover Effects */
    .clean-btn:hover {
        background: #151945 !important;
        border-color: #151945 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(26, 36, 106, 0.3) !important;
    }

    .clean-btn-outline:hover {
        background: #f8fafc !important;
        border-color: #1a246a !important;
        color: #151945 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1) !important;
    }

    .social-hover:hover {
        background: rgba(255,255,255,0.2) !important;
        transform: translateY(-3px) !important;
    }

    /* New Section Hover Effects */
    .academic-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
    }

    .info-card:hover {
        transform: translateY(-5px) !important;
        background: rgba(255,255,255,0.15) !important;
    }

    .alumni-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.12) !important;
    }

    .dosen-card:hover {
        transform: translateY(-10px) !important;
        background: rgba(255,255,255,0.2) !important;
        box-shadow: 0 20px 50px rgba(0,0,0,0.3) !important;
    }

    /* Clean Dosen Card Hover Effects */
    .dosen-card-clean {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .dosen-card-clean:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border-color: #d1d5db;
    }

    .dosen-card-clean:hover .contact-link {
        background: #e2e8f0;
        color: #1e293b;
        transform: scale(1.05);
    }

    .dosen-card-clean:hover .profile-btn {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }

    /* Contact Links Hover */
    .contact-link {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .contact-link:hover {
        background: #e2e8f0 !important;
        color: #1e293b !important;
        transform: scale(1.1) !important;
    }

    /* Profile Button Hover */
    .profile-btn {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .profile-btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 16px rgba(0,0,0,0.15) !important;
    }

    /* Shimmer Animation for Badge */
    @keyframes shimmer {
        0% {
            left: -100%;
        }
        50%, 100% {
            left: 150%;
        }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        [style*="grid-template-columns: repeat(3"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }

        [style*="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr))"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        [style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }

        h1 {
            font-size: 36px !important;
        }

        h2 {
            font-size: 36px !important;
        }

        /* Mobile dosen slider - show 1 card at a time */
        .dosen-slide[style*="grid-template-columns: repeat(3, 1fr)"] {
            grid-template-columns: 1fr !important;
        }

        /* Mobile academic slider - show 1 card at a time */
        .academic-slide[style*="grid-template-columns: repeat(2, 1fr)"] {
            grid-template-columns: 1fr !important;
        }
    }

    /* Custom scrollbar for alumni testimonials */
    #alumni-scroll-container {
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 107, 53, 0.3) transparent;
    }

    #alumni-scroll-container::-webkit-scrollbar {
        width: 6px;
    }

    #alumni-scroll-container::-webkit-scrollbar-track {
        background: rgba(255, 107, 53, 0.1);
        border-radius: 3px;
    }

    #alumni-scroll-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #ff6b35, #f7931e);
        border-radius: 3px;
        transition: background 0.3s;
    }

    #alumni-scroll-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #ff6b35, #ea580c);
    }

    /* Footer Styles */
    footer a:hover {
        color: {{ $footerColors['accent_color'] ?? '#4c5db5' }} !important;
        transform: translateX(5px);
        transition: all 0.3s ease;
    }

    footer a:hover span {
        background: linear-gradient(135deg, {{ $footerColors['bg_gradient_mid'] ?? '#1a246a' }}, {{ $footerColors['accent_color'] ?? '#4c5db5' }});
        box-shadow: 0 0 10px rgba(96, 165, 250, 0.5);
        transform: scale(1.2);
    }

    footer a[style*="rgba"]:hover {
        background: rgba(255,255,255,0.2) !important;
        transform: translateY(-5px) scale(1.1);
        transition: all 0.3s ease;
    }

    footer button:hover {
        background: linear-gradient(135deg, {{ $footerColors['accent_color'] ?? '#4c5db5' }}, {{ $footerColors['bg_gradient_mid'] ?? '#1a246a' }}) !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(26, 36, 106, 0.4);
        transition: all 0.3s ease;
    }

    footer input:focus {
        border-color: {{ $footerColors['accent_color'] ?? '#4c5db5' }} !important;
        background: rgba(255,255,255,0.2) !important;
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
        transition: all 0.3s ease;
    }

    footer input::placeholder {
        color: rgba(255,255,255,0.6);
    }

    /* Navigation Effects */
    .hero-prev:hover, .hero-next:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-50%) scale(1.1);
    }

    .hero-dot:hover {
        transform: scale(1.2);
    }

    /* Academic Navigation Effects */
    .academic-prev:hover, .academic-next:hover {
        background: #fff;
        border-color: #1a246a;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .academic-dot:hover {
        transform: scale(1.2);
        box-shadow: 0 0 15px rgba(26, 36, 106, 0.3);
    }

    /* Super Simple Article Card Hover */
    .article-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    }

    .article-card:hover img {
        opacity: 0.9 !important;
    }
</style>
@endpush
