/**
 * Main JavaScript file for Educentrals theme
 */
(function($) {
    'use strict';

    // Document Ready
    $(document).ready(function() {
        // Mobile Menu Toggle
        $('.menu-toggle').on('click', function() {
            $('.main-navigation').toggleClass('active');
            $(this).attr('aria-expanded', $('.main-navigation').hasClass('active'));
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.main-navigation').length && 
                !$(event.target).closest('.menu-toggle').length && 
                $('.main-navigation').hasClass('active')) {
                $('.main-navigation').removeClass('active');
                $('.menu-toggle').attr('aria-expanded', 'false');
            }
        });

        // Add dropdown toggle to menu items with children
        $('.main-menu .menu-item-has-children > a').after('<button class="dropdown-toggle" aria-expanded="false"><i class="fas fa-chevron-down"></i></button>');

        // Toggle submenu on dropdown toggle click
        $('.dropdown-toggle').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('active');
            $(this).attr('aria-expanded', $(this).hasClass('active'));
            $(this).next('.sub-menu').slideToggle(200);
        });

        // Hero Slider
        initSlider();

        // Smooth scroll for anchor links
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                    return false;
                }
            }
        });

        // Back to top button
        var backToTop = $('.back-to-top');
        
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                backToTop.addClass('show');
            } else {
                backToTop.removeClass('show');
            }
        });

        backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 800);
        });

        // Add responsive table class
        $('table').wrap('<div class="table-responsive"></div>');

        // Add lightbox to gallery images
        if ($.fn.magnificPopup) {
            $('.gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        }

        // Initialize tooltips
        if ($.fn.tooltip) {
            $('[data-toggle="tooltip"]').tooltip();
        }

        // Lazy load images
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.dataset.src;
            });
        } else {
            // Fallback for browsers that don't support lazy loading
            if ($.fn.lazyload) {
                $('img.lazy').lazyload({
                    effect: 'fadeIn',
                    threshold: 200
                });
            }
        }

        // Newsletter form submission
        $('.newsletter-form form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var email = form.find('input[type="email"]').val();
            
            if (isValidEmail(email)) {
                // Here you would typically send the form data to your server
                // For demo purposes, we'll just show a success message
                form.html('<div class="alert alert-success">Terima kasih telah berlangganan newsletter kami!</div>');
            } else {
                form.find('.newsletter-error').remove();
                form.append('<div class="newsletter-error">Silakan masukkan alamat email yang valid.</div>');
            }
        });

        // Comment form validation
        $('#commentform').on('submit', function() {
            var commentForm = $(this);
            var commentText = commentForm.find('#comment').val();
            var authorText = commentForm.find('#author').val();
            var emailText = commentForm.find('#email').val();
            
            if (commentText === '') {
                alert('Silakan masukkan komentar Anda.');
                return false;
            }
            
            if (commentForm.find('#author').length && authorText === '') {
                alert('Silakan masukkan nama Anda.');
                return false;
            }
            
            if (commentForm.find('#email').length && (emailText === '' || !isValidEmail(emailText))) {
                alert('Silakan masukkan alamat email yang valid.');
                return false;
            }
            
            return true;
        });

        // Search form toggle
        $('.search-toggle').on('click', function(e) {
            e.preventDefault();
            $('.header-search').toggleClass('active');
            if ($('.header-search').hasClass('active')) {
                $('.header-search input[type="search"]').focus();
            }
        });

        // Close search form when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.header-search').length && 
                !$(event.target).closest('.search-toggle').length && 
                $('.header-search').hasClass('active')) {
                $('.header-search').removeClass('active');
            }
        });

        // Responsive video embeds
        $('.post-content iframe[src*="youtube.com"], .post-content iframe[src*="vimeo.com"]').wrap('<div class="video-container"></div>');
    });

    // Window Load
    $(window).on('load', function() {
        // Hide page loader
        $('.page-loader').fadeOut(500);
    });

    // Window Resize
    $(window).on('resize', function() {
        // Reset mobile menu on window resize
        if ($(window).width() > 768) {
            $('.main-navigation').removeClass('active');
            $('.menu-toggle').attr('aria-expanded', 'false');
        }
    });

    // Helper Functions
    function initSlider() {
        var sliderItems = $('.slider-item');
        var sliderDots = $('.slider-dot');
        var currentSlide = 0;
        var slideCount = sliderItems.length;
        var slideInterval;

        // Don't initialize if there are no slides
        if (slideCount === 0) {
            return;
        }

        // Start auto rotation
        startSlideInterval();

        // Click on slider dots
        sliderDots.on('click', function() {
            var slideIndex = $(this).data('slide') - 1;
            goToSlide(slideIndex);
            resetSlideInterval();
        });

        // Function to go to a specific slide
        function goToSlide(index) {
            sliderItems.removeClass('active');
            sliderDots.removeClass('active');
            
            sliderItems.eq(index).addClass('active');
            sliderDots.eq(index).addClass('active');
            
            currentSlide = index;
        }

        // Function to go to the next slide
        function nextSlide() {
            var nextIndex = (currentSlide + 1) % slideCount;
            goToSlide(nextIndex);
        }

        // Start auto rotation
        function startSlideInterval() {
            slideInterval = setInterval(function() {
                nextSlide();
            }, 5000);
        }

        // Reset auto rotation
        function resetSlideInterval() {
            clearInterval(slideInterval);
            startSlideInterval();
        }
    }

    // Email validation function
    function isValidEmail(email) {
        var pattern = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return pattern.test(email);
    }

})(jQuery);