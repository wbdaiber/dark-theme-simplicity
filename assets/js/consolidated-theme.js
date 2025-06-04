/**
 * Dark Theme Simplicity - Final Consolidated Theme JavaScript
 * Includes: Mobile Menu + Responsive Videos + Theme Functions
 * Version: 1.2.0 - All conflicts resolved
 */
(function($) {
    'use strict';

    // === MOBILE MENU FUNCTIONALITY ===
    function initializeMobileMenu() {
        console.log('📱 Initializing mobile menu...');
        
        const $toggle = $('#mobile-menu-toggle');
        const $menu = $('#mobile-menu');
        const $overlay = $('#mobile-menu-overlay');
        const $body = $('body');

        if (!$toggle.length || !$menu.length) {
            console.log('⚠️ Mobile menu elements not found');
            return;
        }

        // Toggle menu
        $toggle.on('click', function(e) {
            e.preventDefault();
            
            const isHidden = $menu.hasClass('hidden');
            
            if (isHidden) {
                $menu.removeClass('hidden');
                $overlay.removeClass('hidden');
                $body.css('overflow', 'hidden');
                console.log('📖 Mobile menu opened');
            } else {
                $menu.addClass('hidden');
                $overlay.addClass('hidden');
                $body.css('overflow', '');
                console.log('📕 Mobile menu closed');
            }
        });

        // Close on overlay click
        $overlay.on('click', function() {
            $menu.addClass('hidden');
            $overlay.addClass('hidden');
            $body.css('overflow', '');
            console.log('📕 Mobile menu closed via overlay');
        });

        // Close on escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && !$menu.hasClass('hidden')) {
                $menu.addClass('hidden');
                $overlay.addClass('hidden');
                $body.css('overflow', '');
                console.log('📕 Mobile menu closed via escape');
            }
        });

        console.log('✅ Mobile menu initialized successfully');
    }

    // === RESPONSIVE VIDEOS FUNCTIONALITY ===
    function initializeResponsiveVideos() {
        console.log('🎥 Initializing responsive videos...');
        
        // Fix WordPress default video embeds
        $('.wp-block-embed iframe, .wp-block-video video').each(function() {
            var $this = $(this);
            
            if (!$this.parent().hasClass('responsive-video-wrapper') && 
                !$this.parent().hasClass('wp-block-embed__wrapper')) {
                $this.wrap('<div class="responsive-video-wrapper"></div>');
            }
        });
        
        // Find all video elements and make them responsive
        $('iframe[src*="youtube.com"], iframe[src*="youtu.be"], iframe[src*="vimeo.com"], iframe[src*="dailymotion.com"], iframe[src*="videopress.com"]').each(function() {
            var $iframe = $(this);
            
            if (!$iframe.parent().hasClass('responsive-video-wrapper') && 
                !$iframe.parent().hasClass('wp-block-embed__wrapper')) {
                $iframe.wrap('<div class="responsive-video-wrapper"></div>');
            }
        });
        
        // Add appropriate margins to video wrappers
        setTimeout(function() {
            $('.responsive-video-wrapper').each(function() {
                var $wrapper = $(this);
                
                if (!$wrapper.hasClass('margin-applied')) {
                    $wrapper.addClass('margin-applied');
                    
                    var screenWidth = $(window).width();
                    
                    if (screenWidth >= 1024) {
                        $wrapper.css({
                            'margin-top': '1.5rem',
                            'margin-bottom': '1.5rem'
                        });
                    } else if (screenWidth >= 768) {
                        $wrapper.css({
                            'margin-top': '1.5rem',
                            'margin-bottom': '1.5rem'
                        });
                    } else {
                        $wrapper.css({
                            'margin-top': '1rem',
                            'margin-bottom': '1rem',
                            'max-width': '100%',
                            'width': '100%'
                        });
                    }
                }
            });
        }, 500);
        
        console.log('✅ Responsive videos initialized');
    }

    // === WINDOW RESIZE HANDLER ===
    function handleWindowResize() {
        var resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Recalculate iframe heights
                $('.responsive-video-wrapper iframe').each(function() {
                    var $iframe = $(this);
                    var width = $iframe.width();
                    var aspectRatio = $iframe.attr('height') / $iframe.attr('width');
                    
                    if (width && aspectRatio) {
                        $iframe.css('height', width * aspectRatio + 'px');
                    }
                });
                
                // Update video wrapper margins based on new screen size
                $('.responsive-video-wrapper').each(function() {
                    var $wrapper = $(this);
                    var screenWidth = $(window).width();
                    
                    if (screenWidth >= 1024) {
                        $wrapper.css({
                            'margin-top': '1.5rem',
                            'margin-bottom': '1.5rem',
                            'max-width': '',
                            'width': ''
                        });
                    } else if (screenWidth >= 768) {
                        $wrapper.css({
                            'margin-top': '1.5rem',
                            'margin-bottom': '1.5rem',
                            'max-width': '',
                            'width': ''
                        });
                    } else {
                        $wrapper.css({
                            'margin-top': '1rem',
                            'margin-bottom': '1rem',
                            'max-width': '100%',
                            'width': '100%'
                        });
                    }
                });
            }, 250);
        }).trigger('resize');
    }

    // === SMOOTH SCROLLING FOR ANCHOR LINKS ===
    function initializeSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            var target = $(this.hash);
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 600);
                
                // Set focus for accessibility
                target.attr('tabindex', '-1');
                target.focus();
                
                setTimeout(function() {
                    target.removeAttr('tabindex');
                }, 1000);
            }
        });
        
        // Handle hash on page load
        if (window.location.hash) {
            setTimeout(function() {
                var target = $(window.location.hash);
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 300);
                }
            }, 500);
        }
    }

    // === AJAX CONTENT HANDLER ===
    function handleAjaxContent() {
        $(document).ajaxComplete(function() {
            setTimeout(function() {
                // Re-initialize responsive videos for new content
                $('iframe[src*="youtube.com"], iframe[src*="youtu.be"], iframe[src*="vimeo.com"], iframe[src*="dailymotion.com"], iframe[src*="videopress.com"]').each(function() {
                    var $iframe = $(this);
                    
                    if (!$iframe.parent().hasClass('responsive-video-wrapper') && 
                        !$iframe.parent().hasClass('wp-block-embed__wrapper')) {
                        $iframe.wrap('<div class="responsive-video-wrapper"></div>');
                        
                        var $wrapper = $iframe.parent('.responsive-video-wrapper');
                        var screenWidth = $(window).width();
                        
                        if (screenWidth >= 1024) {
                            $wrapper.css({
                                'margin-top': '1.5rem',
                                'margin-bottom': '1.5rem'
                            });
                        } else if (screenWidth >= 768) {
                            $wrapper.css({
                                'margin-top': '1.5rem',
                                'margin-bottom': '1.5rem'
                            });
                        } else {
                            $wrapper.css({
                                'margin-top': '1rem',
                                'margin-bottom': '1rem',
                                'max-width': '100%',
                                'width': '100%'
                            });
                        }
                    }
                });
            }, 500);
        });
    }

    // === ADD HEADING IDS FOR TOC ===
    function addHeadingIds() {
        $('.entry-content h2, .entry-content h3, .entry-content h4').each(function() {
            if (!this.id) {
                var text = $(this).text();
                var id = text.toLowerCase().replace(/[^a-z0-9]+/g, '-');
                $(this).attr('id', id);
            }
        });
    }

    // === MAIN INITIALIZATION ===
    $(document).ready(function() {
        console.log('🚀 Dark Theme Simplicity - Final Consolidated Script Loading...');
        
        // Initialize all functionality
        initializeMobileMenu();
        initializeResponsiveVideos();
        handleWindowResize();
        initializeSmoothScrolling();
        handleAjaxContent();
        addHeadingIds();
        
        // Add prose class to entry-content if not present
        if ($('.entry-content').length && !$('.entry-content').hasClass('prose')) {
            $('.entry-content').addClass('prose');
        }
        
        console.log('🎉 Dark Theme Simplicity - All functionality loaded successfully!');
    });

    // === GLOBAL ERROR HANDLER ===
    window.addEventListener('error', function(e) {
        console.error('🚨 Theme JavaScript Error:', e.message, e.filename, e.lineno);
    });

})(jQuery);