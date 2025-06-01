/**
 * Responsive Video Script for Dark Theme Simplicity
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        // Fix WordPress default video embeds
        $('.wp-block-embed iframe, .wp-block-video video').each(function() {
            var $this = $(this);
            
            // If not already wrapped by responsive wrapper
            if (!$this.parent().hasClass('responsive-video-wrapper') && 
                !$this.parent().hasClass('wp-block-embed__wrapper')) {
                $this.wrap('<div class="responsive-video-wrapper"></div>');
            }
        });
        
        // Fix for iframes that might be added after page load
        var resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Recalculate iframe heights to maintain aspect ratio
                $('.responsive-video-wrapper iframe').each(function() {
                    var $iframe = $(this);
                    var width = $iframe.width();
                    var aspectRatio = $iframe.attr('height') / $iframe.attr('width');
                    
                    // If we have dimensions, calculate the height
                    if (width && aspectRatio) {
                        $iframe.css('height', width * aspectRatio + 'px');
                    }
                });
            }, 250);
        }).trigger('resize');
        
        // Find all video elements and make them responsive
        $('iframe[src*="youtube.com"], iframe[src*="youtu.be"], iframe[src*="vimeo.com"], iframe[src*="dailymotion.com"], iframe[src*="videopress.com"]').each(function() {
            var $iframe = $(this);
            
            // If not already wrapped
            if (!$iframe.parent().hasClass('responsive-video-wrapper') && 
                !$iframe.parent().hasClass('wp-block-embed__wrapper')) {
                $iframe.wrap('<div class="responsive-video-wrapper"></div>');
            }
        });
        
        // Add extra padding/margin to elements before and after videos
        setTimeout(function() {
            $('.responsive-video-wrapper').each(function() {
                var $wrapper = $(this);
                
                // Apply margin to the wrapper
                if (!$wrapper.hasClass('margin-applied')) {
                    $wrapper.addClass('margin-applied');
                    
                    // Get screen size to determine appropriate margins
                    var screenWidth = $(window).width();
                    
                    if (screenWidth >= 1024) {
                        // Desktop
                        $wrapper.css({
                            'margin-top': '1.5rem',
                            'margin-bottom': '1.5rem'
                        });
                    } else if (screenWidth >= 768) {
                        // Tablet
                        $wrapper.css({
                            'margin-top': '1.5rem',
                            'margin-bottom': '1.5rem'
                        });
                    } else {
                        // Mobile
                        $wrapper.css({
                            'margin-top': '1rem',
                            'margin-bottom': '1rem'
                        });
                    }
                }
            });
        }, 500); // Small delay to ensure all videos are processed
    });
    
    // Handle videos loaded after initial page load (e.g., AJAX content)
    $(document).ajaxComplete(function() {
        setTimeout(function() {
            // Find all newly added videos and make them responsive
            $('iframe[src*="youtube.com"], iframe[src*="youtu.be"], iframe[src*="vimeo.com"], iframe[src*="dailymotion.com"], iframe[src*="videopress.com"]').each(function() {
                var $iframe = $(this);
                
                // If not already wrapped
                if (!$iframe.parent().hasClass('responsive-video-wrapper') && 
                    !$iframe.parent().hasClass('wp-block-embed__wrapper')) {
                    $iframe.wrap('<div class="responsive-video-wrapper"></div>');
                    
                    // Apply margin to the wrapper
                    var $wrapper = $iframe.parent('.responsive-video-wrapper');
                    var screenWidth = $(window).width();
                    
                    if (screenWidth >= 1024) {
                        // Desktop
                        $wrapper.css({
                            'margin-top': '1.5rem',
                            'margin-bottom': '1.5rem'
                        });
                    } else if (screenWidth >= 768) {
                        // Tablet
                        $wrapper.css({
                            'margin-top': '1.5rem',
                            'margin-bottom': '1.5rem'
                        });
                    } else {
                        // Mobile
                        $wrapper.css({
                            'margin-top': '1rem',
                            'margin-bottom': '1rem'
                        });
                    }
                    
                    // For mobile, make videos wider
                    if (screenWidth < 768) {
                        $wrapper.css({
                            'max-width': '100%',
                            'width': '100%'
                        });
                    }
                }
            });
        }, 500);
    });
})(jQuery); 