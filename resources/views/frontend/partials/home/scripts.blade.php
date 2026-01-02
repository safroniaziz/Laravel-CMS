@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
// Maintain scroll position on page refresh
if ('scrollRestoration' in history) {
    history.scrollRestoration = 'auto';
}

// Store scroll position before page refresh
$(window).on('beforeunload', function() {
    sessionStorage.setItem('scrollPosition', $(window).scrollTop());
});

$(document).ready(function() {
    // Restore scroll position if available
    const scrollPosition = sessionStorage.getItem('scrollPosition');
    if (scrollPosition) {
        $(window).scrollTop(parseInt(scrollPosition));
        sessionStorage.removeItem('scrollPosition');
    }

    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Hero Slider
    let currentHeroSlide = 0;
    const heroSlides = $('.hero-slide');
    const heroDots = $('.hero-dot');
    const totalHeroSlides = heroSlides.length;

    function goToHeroSlide(index) {
        currentHeroSlide = index;
        $('.hero-slides').css('transform', `translateX(-${currentHeroSlide * 100}%)`);

        // Update dots
        heroDots.each(function(i) {
            if (i === currentHeroSlide) {
                $(this).css('background', '#fff');
            } else {
                $(this).css('background', 'transparent');
            }
        });
    }

    // Hero dots click
    heroDots.on('click', function() {
        goToHeroSlide($(this).data('slide'));
    });

    // Hero prev/next buttons
    $('.hero-prev').on('click', function() {
        currentHeroSlide = (currentHeroSlide - 1 + totalHeroSlides) % totalHeroSlides;
        goToHeroSlide(currentHeroSlide);
    });

    $('.hero-next').on('click', function() {
        currentHeroSlide = (currentHeroSlide + 1) % totalHeroSlides;
        goToHeroSlide(currentHeroSlide);
    });

    // Hero auto slide
    if (totalHeroSlides > 1) {
        setInterval(function() {
            currentHeroSlide = (currentHeroSlide + 1) % totalHeroSlides;
            goToHeroSlide(currentHeroSlide);
        }, 6000);
    }

    // Hero arrow hover
    $('.hero-prev, .hero-next').hover(
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.4)',
                'transform': 'translateY(-50%) scale(1.1)'
            });
        },
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.2)',
                'transform': 'translateY(-50%) scale(1)'
            });
        }
    );

    // News Slider functionality
    let currentSlide = 0;
    const slides = $('.news-slide');
    const dots = $('.slider-dot');
    const totalSlides = slides.length;

    function goToSlide(index) {
        currentSlide = index;
        $('.news-slides').css('transform', `translateX(-${currentSlide * 100}%)`);

        // Update dots
        dots.each(function(i) {
            if (i === currentSlide) {
                $(this).css({
                    'width': '40px',
                    'background': 'linear-gradient(to right, #1a246a, #f97316)'
                });
            } else {
                $(this).css({
                    'width': '12px',
                    'background': '#cbd5e1'
                });
            }
        });
    }

    dots.on('click', function() {
        goToSlide($(this).data('slide'));
    });

    // Auto slide
    if (totalSlides > 0) {
        setInterval(function() {
            currentSlide = (currentSlide + 1) % totalSlides;
            goToSlide(currentSlide);
        }, 5000);
    }

    // Academic Slider functionality
    let currentAcademicSlide = 0;
    const academicSlides = $('.academic-slide');
    const totalAcademicSlides = academicSlides.length;

    function goToAcademicSlide(index) {
        currentAcademicSlide = index;
        $('.academic-slides').css('transform', `translateX(-${currentAcademicSlide * 100}%)`);
    }

    $('.academic-prev').on('click', function() {
        currentAcademicSlide = (currentAcademicSlide - 1 + totalAcademicSlides) % totalAcademicSlides;
        goToAcademicSlide(currentAcademicSlide);
    });

    $('.academic-next').on('click', function() {
        currentAcademicSlide = (currentAcademicSlide + 1) % totalAcademicSlides;
        goToAcademicSlide(currentAcademicSlide);
    });

    // Auto slide for academic section
    if (totalAcademicSlides > 1) {
        setInterval(function() {
            currentAcademicSlide = (currentAcademicSlide + 1) % totalAcademicSlides;
            goToAcademicSlide(currentAcademicSlide);
        }, 8000);
    }

    // Academic arrow hover
    $('.academic-prev, .academic-next').hover(
        function() {
            $(this).css({
                'background': '#151945',
                'transform': 'translateY(-50%) scale(1.1)'
            });
        },
        function() {
            $(this).css({
                'background': '#1a246a',
                'transform': 'translateY(-50%) scale(1)'
            });
        }
    );

    // Dosen Slider functionality
    let currentDosenSlide = 0;
    const dosenSlides = $('.dosen-slide');
    const dosenDots = $('.dosen-dot');
    const totalDosenSlides = dosenSlides.length;

    function goToDosenSlide(index) {
        currentDosenSlide = index;
        $('.dosen-slides').css('transform', `translateX(-${currentDosenSlide * 100}%)`);

        // Update dots
        dosenDots.each(function(i) {
            if (i === currentDosenSlide) {
                $(this).css('background', '#1a246a');
            } else {
                $(this).css('background', 'transparent');
            }
        });
    }

    // Dosen dots click
    dosenDots.on('click', function() {
        goToDosenSlide($(this).data('slide'));
    });

    // Dosen arrows click
    $('.dosen-prev').on('click', function() {
        currentDosenSlide = (currentDosenSlide - 1 + totalDosenSlides) % totalDosenSlides;
        goToDosenSlide(currentDosenSlide);
    });

    $('.dosen-next').on('click', function() {
        currentDosenSlide = (currentDosenSlide + 1) % totalDosenSlides;
        goToDosenSlide(currentDosenSlide);
    });

    // Dosen arrow hover effects
    $('.dosen-prev, .dosen-next').hover(
        function() {
            $(this).css({
                'background': '#151945',
                'transform': 'translateY(-50%) scale(1.1)'
            });
        },
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.9)',
                'transform': 'translateY(-50%) scale(1)'
            });
        }
    );

    // Auto slide for dosen section
    if (totalDosenSlides > 1) {
        setInterval(function() {
            currentDosenSlide = (currentDosenSlide + 1) % totalDosenSlides;
            goToDosenSlide(currentDosenSlide);
        }, 6000);
    }

    // Card hover effects
    $('.news-card').hover(
        function() {
            $(this).css({
                'transform': 'translateY(-12px)',
                'box-shadow': '0 20px 40px rgba(0,0,0,0.15)'
            });
            $(this).find('img').css('transform', 'scale(1.1)');
            $(this).find('.card-overlay').css('opacity', '1');
            $(this).find('.arrow-icon').css({
                'transform': 'translateX(4px)',
                'background': 'linear-gradient(135deg, #f97316, #ea580c)'
            });
        },
        function() {
            $(this).css({
                'transform': 'translateY(0)',
                'box-shadow': '0 4px 20px rgba(0,0,0,0.08)'
            });
            $(this).find('img').css('transform', 'scale(1)');
            $(this).find('.card-overlay').css('opacity', '0');
            $(this).find('.arrow-icon').css({
                'transform': 'translateX(0)',
                'background': 'linear-gradient(135deg, #1a246a, #151945)'
            });
        }
    );

    // Button hover effects
    $('.btn-hover').hover(
        function() {
            $(this).css({
                'transform': 'translateY(-2px)',
                'box-shadow': '0 12px 32px rgba(251, 191, 36, 0.5)'
            });
        },
        function() {
            $(this).css({
                'transform': 'translateY(0)',
                'box-shadow': '0 8px 24px rgba(251, 191, 36, 0.4)'
            });
        }
    );

    $('.btn-hover-outline').hover(
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.2)',
                'transform': 'translateY(-2px)'
            });
        },
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.1)',
                'transform': 'translateY(0)'
            });
        }
    );

    $('.social-hover').hover(
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.2)',
                'transform': 'translateY(-3px)'
            });
        },
        function() {
            $(this).css({
                'background': 'rgba(255,255,255,0.1)',
                'transform': 'translateY(0)'
            });
        }
    );
    // Alumni Testimonials Scrollable Container (only if exists)
    const alumniContainer = $('#alumni-scroll-container');
    const scrollUpBtn = $('#alumni-scroll-up');
    const scrollDownBtn = $('#alumni-scroll-down');
    const scrollProgress = $('#scroll-progress');

    if (alumniContainer.length && alumniContainer[0]) {
        let isScrolling = false;

        // Update scroll progress indicator
        function updateScrollProgress() {
            if (!alumniContainer[0]) return;
            const scrollTop = alumniContainer.scrollTop();
            const scrollHeight = alumniContainer[0].scrollHeight - alumniContainer.height();
            const scrollPercentage = (scrollTop / scrollHeight) * 100;
            scrollProgress.css('height', Math.max(10, Math.min(100, scrollPercentage)) + '%');
        }

        // Scroll functions
        function scrollUp() {
            if (!isScrolling && alumniContainer[0]) {
                isScrolling = true;
                const currentScroll = alumniContainer.scrollTop();
                const newScroll = Math.max(0, currentScroll - 200);
                alumniContainer.animate({
                    scrollTop: newScroll
                }, 300, function() {
                    isScrolling = false;
                    updateScrollProgress();
                });
            }
        }

        function scrollDown() {
            if (!isScrolling && alumniContainer[0]) {
                isScrolling = true;
                const currentScroll = alumniContainer.scrollTop();
                const maxScroll = alumniContainer[0].scrollHeight - alumniContainer.height();
                const newScroll = Math.min(maxScroll, currentScroll + 200);
                alumniContainer.animate({
                    scrollTop: newScroll
                }, 300, function() {
                    isScrolling = false;
                    updateScrollProgress();
                });
            }
        }

        // Button click handlers
        scrollUpBtn.on('click', function(e) {
            e.preventDefault();
            scrollUp();
        });

        scrollDownBtn.on('click', function(e) {
            e.preventDefault();
            scrollDown();
        });

        // Scroll event handler
        alumniContainer.on('scroll', function() {
            if (!isScrolling) {
                updateScrollProgress();
            }
        });

        // Button hover effects
        scrollUpBtn.add(scrollDownBtn).hover(
            function() {
                $(this).css({
                    'transform': $(this).attr('id') === 'alumni-scroll-up'
                        ? 'translateX(-50%) translateY(-2px) scale(1.05)'
                        : 'translateX(-50%) translateY(2px) scale(1.05)',
                    'box-shadow': '0 6px 20px rgba(255, 107, 53, 0.4)'
                });
            },
            function() {
                $(this).css({
                    'transform': $(this).attr('id') === 'alumni-scroll-up'
                        ? 'translateX(-50%) translateY(0) scale(1)'
                        : 'translateX(-50%) translateY(0) scale(1)',
                    'box-shadow': '0 4px 15px rgba(255, 107, 53, 0.3)'
                });
            }
        );

        // Initialize
        updateScrollProgress();
    }

    // Alumni Carousel (for carousel layout)
    let currentAlumniSlide = 0;
    const alumniCarouselTrack = $('#alumni-carousel-track');
    const alumniCarouselSlides = $('.alumni-carousel-slide');
    const totalAlumniSlides = alumniCarouselSlides.length;
    const alumniIndicators = $('.alumni-carousel-indicator');
    const alumniIndicatorsContainer = alumniIndicators.parent();
    const alumniAccentColor = alumniIndicatorsContainer.length ? alumniIndicatorsContainer.data('accent-color') || '#ff6b35' : '#ff6b35';

    function updateAlumniCarousel() {
        if (alumniCarouselTrack.length && alumniCarouselSlides.length) {
            const translateX = -currentAlumniSlide * 100;
            alumniCarouselTrack.css('transform', `translateX(${translateX}%)`);

            // Update indicators
            alumniIndicators.each(function(index) {
                if (index === currentAlumniSlide) {
                    $(this).css('background', alumniAccentColor);
                } else {
                    $(this).css('background', 'rgba(255, 107, 53, 0.3)');
                }
            });
        }
    }

    function nextAlumniSlide() {
        if (totalAlumniSlides > 0) {
            currentAlumniSlide = (currentAlumniSlide + 1) % totalAlumniSlides;
            updateAlumniCarousel();
        }
    }

    function prevAlumniSlide() {
        if (totalAlumniSlides > 0) {
            currentAlumniSlide = (currentAlumniSlide - 1 + totalAlumniSlides) % totalAlumniSlides;
            updateAlumniCarousel();
        }
    }

    function goToAlumniSlide(index) {
        if (index >= 0 && index < totalAlumniSlides) {
            currentAlumniSlide = index;
            updateAlumniCarousel();
        }
    }

    // Carousel navigation
    $('#alumni-carousel-prev').on('click', function(e) {
        e.preventDefault();
        prevAlumniSlide();
    });

    $('#alumni-carousel-next').on('click', function(e) {
        e.preventDefault();
        nextAlumniSlide();
    });

    // Auto-play carousel (optional)
    if (totalAlumniSlides > 1) {
        setInterval(function() {
            if ($('#alumni-carousel').length && $('#alumni-carousel').is(':visible')) {
                nextAlumniSlide();
            }
        }, 5000); // Change slide every 5 seconds
    }

    // Make goToAlumniSlide available globally (for onclick handlers)
    window.goToSlide = goToAlumniSlide;

    // ============================================
    // NEW: Alumni Main Carousel (Full-Width Design)
    // ============================================
    let currentAlumniMainSlide = 0;
    const alumniMainTrack = $('#alumni-main-track');
    const alumniMainSlides = $('.alumni-main-slide');
    const totalAlumniMainSlides = alumniMainSlides.length;
    const alumniMainDots = $('.alumni-main-dot');
    const alumniMainDotsContainer = $('#alumni-main-dots');
    const alumniMainAccentColor = alumniMainDotsContainer.length ? alumniMainDotsContainer.data('accent-color') || '#ff6b35' : '#ff6b35';

    function updateAlumniMainCarousel() {
        if (alumniMainTrack.length && alumniMainSlides.length) {
            const translateX = -currentAlumniMainSlide * 100;
            alumniMainTrack.css('transform', `translateX(${translateX}%)`);

            // Update dots - active dot is wider
            alumniMainDots.each(function(index) {
                if (index === currentAlumniMainSlide) {
                    $(this).css({
                        'width': '32px',
                        'background': alumniMainAccentColor
                    });
                } else {
                    $(this).css({
                        'width': '12px',
                        'background': 'rgba(0,0,0,0.15)'
                    });
                }
            });
        }
    }

    function nextAlumniMainSlide() {
        if (totalAlumniMainSlides > 0) {
            currentAlumniMainSlide = (currentAlumniMainSlide + 1) % totalAlumniMainSlides;
            updateAlumniMainCarousel();
        }
    }

    function prevAlumniMainSlide() {
        if (totalAlumniMainSlides > 0) {
            currentAlumniMainSlide = (currentAlumniMainSlide - 1 + totalAlumniMainSlides) % totalAlumniMainSlides;
            updateAlumniMainCarousel();
        }
    }

    function goToAlumniMainSlide(index) {
        if (index >= 0 && index < totalAlumniMainSlides) {
            currentAlumniMainSlide = index;
            updateAlumniMainCarousel();
        }
    }

    // Navigation buttons
    $('#alumni-main-prev').on('click', function(e) {
        e.preventDefault();
        prevAlumniMainSlide();
    });

    $('#alumni-main-next').on('click', function(e) {
        e.preventDefault();
        nextAlumniMainSlide();
    });

    // Dots click handler
    alumniMainDots.on('click', function(e) {
        e.preventDefault();
        const index = $(this).data('index');
        goToAlumniMainSlide(index);
    });

    // Auto-rotate every 6 seconds
    let alumniMainAutoRotate;
    function startAlumniMainAutoRotate() {
        if (totalAlumniMainSlides > 1) {
            alumniMainAutoRotate = setInterval(function() {
                if ($('#alumni-main-carousel').length && $('#alumni-main-carousel').is(':visible')) {
                    nextAlumniMainSlide();
                }
            }, 6000);
        }
    }

    function stopAlumniMainAutoRotate() {
        if (alumniMainAutoRotate) {
            clearInterval(alumniMainAutoRotate);
        }
    }

    // Start auto-rotate
    startAlumniMainAutoRotate();

    // Pause on hover
    $('#alumni-main-carousel').hover(
        function() { stopAlumniMainAutoRotate(); },
        function() { startAlumniMainAutoRotate(); }
    );

    // Initialize
    updateAlumniMainCarousel();
});
</script>
@endpush
