/**
 * Blog Functionality Fixes for Dark Theme Simplicity
 * Handles mobile TOC, share buttons, and other blog-specific functionality
 */

jQuery(document).ready(function($) {
    // Mobile TOC and Share button functionality
    const mobileShareToggle = $('.mobile-share-toggle');
    const mobileShareDropdown = $('.mobile-share-dropdown');
    const mobileTocToggle = $('.mobile-toc-toggle');
    const mobileTocDropdown = $('.mobile-toc-dropdown');

    // Share button toggle
    mobileShareToggle.on('click', function() {
        mobileShareDropdown.toggleClass('hidden');
        // Hide TOC dropdown if open
        mobileTocDropdown.addClass('hidden');
        // Toggle active state for styling
        mobileShareToggle.toggleClass('active');
        mobileTocToggle.removeClass('active');
    });

    // TOC toggle
    mobileTocToggle.on('click', function() {
        mobileTocDropdown.toggleClass('hidden');
        // Hide share dropdown if open
        mobileShareDropdown.addClass('hidden');
        // Toggle active state for styling
        mobileTocToggle.toggleClass('active');
        mobileShareToggle.removeClass('active');
    });

    // Close dropdowns when clicking outside
    $(document).on('click', function(e) {
        if (!mobileShareToggle.is(e.target) && 
            !mobileShareToggle.has(e.target).length &&
            !mobileShareDropdown.is(e.target) && 
            !mobileShareDropdown.has(e.target).length) {
            
            mobileShareDropdown.addClass('hidden');
            mobileShareToggle.removeClass('active');
        }

        if (!mobileTocToggle.is(e.target) && 
            !mobileTocToggle.has(e.target).length &&
            !mobileTocDropdown.is(e.target) && 
            !mobileTocDropdown.has(e.target).length) {
            
            mobileTocDropdown.addClass('hidden');
            mobileTocToggle.removeClass('active');
        }
    });

    // Close dropdowns when pressing Escape
    $(document).keydown(function(e) {
        if (e.key === "Escape") {
            mobileShareDropdown.addClass('hidden');
            mobileTocDropdown.addClass('hidden');
            mobileShareToggle.removeClass('active');
            mobileTocToggle.removeClass('active');
        }
    });

    // Add scroll event for enhancing sticky behavior
    const mobileStickyContainer = $('.mobile-sticky-nav').parent();
    
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 100) {
            mobileStickyContainer.addClass('scrolled');
        } else {
            mobileStickyContainer.removeClass('scrolled');
        }
    });

    // Copy to clipboard functionality
    window.copyToClipboard = function(text) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(function() {
                showCopyFeedback('Link copied!');
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
                fallbackCopyTextToClipboard(text);
            });
        } else {
            fallbackCopyTextToClipboard(text);
        }
    };

    function fallbackCopyTextToClipboard(text) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.opacity = "0";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showCopyFeedback('Link copied!');
        } catch (err) {
            console.error('Fallback: Could not copy text: ', err);
            showCopyFeedback('Failed to copy link');
        }
        
        document.body.removeChild(textArea);
    }

    function showCopyFeedback(message) {
        // Create or update feedback element
        let feedback = document.getElementById('copy-feedback');
        if (!feedback) {
            feedback = document.createElement('div');
            feedback.id = 'copy-feedback';
            feedback.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #10B981;
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 500;
                z-index: 10000;
                transform: translateY(-100px);
                opacity: 0;
                transition: all 0.3s ease;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            `;
            document.body.appendChild(feedback);
        }
        
        feedback.textContent = message;
        
        // Animate in
        setTimeout(() => {
            feedback.style.transform = 'translateY(0)';
            feedback.style.opacity = '1';
        }, 10);
        
        // Animate out
        setTimeout(() => {
            feedback.style.transform = 'translateY(-100px)';
            feedback.style.opacity = '0';
        }, 2000);
        
        // Remove element
        setTimeout(() => {
            if (feedback && feedback.parentNode) {
                feedback.parentNode.removeChild(feedback);
            }
        }, 2300);
    }

    // Auto-close mobile TOC after clicking a link
    $('.mobile-toc-list a').on('click', function() {
        setTimeout(function() {
            mobileTocDropdown.addClass('hidden');
            mobileTocToggle.removeClass('active');
        }, 100);
    });

    // Fix video embeds by wrapping them in responsive containers
    function fixVideoEmbeds() {
        // Find all iframes and videos that might need wrapping
        $('.entry-content iframe, .entry-content video').each(function() {
            var $media = $(this);
            
            // Skip if already in a responsive wrapper
            if (!$media.parent().hasClass('responsive-video-wrapper') && 
                !$media.parent().hasClass('wp-block-embed__wrapper')) {
                $media.wrap('<div class="responsive-video-wrapper"></div>');
            }
        });
        
        // Fix WordPress embed wrappers that don't have proper aspect ratio
        $('.wp-block-embed__wrapper').each(function() {
            var $wrapper = $(this);
            
            // Only fix if it doesn't have padding-bottom style
            if (!$wrapper.attr('style') || $wrapper.attr('style').indexOf('padding-bottom') === -1) {
                $wrapper.css({
                    'position': 'relative',
                    'padding-bottom': '56.25%',
                    'height': '0',
                    'overflow': 'hidden',
                    'max-width': '100%',
                    'width': '100%'
                });
                
                $wrapper.find('iframe').css({
                    'position': 'absolute',
                    'top': '0',
                    'left': '0',
                    'width': '100%',
                    'height': '100%'
                });
            }
        });
        
        // Handle any video containers that are direct children of entry-content
        $('.entry-content > video, .entry-content > iframe').each(function() {
            var $media = $(this);
            
            // Skip if already in a responsive wrapper
            if (!$media.parent().hasClass('responsive-video-wrapper') && 
                !$media.parent().hasClass('wp-block-embed__wrapper')) {
                $media.wrap('<div class="responsive-video-wrapper"></div>');
            }
        });
    }

    // Ensure proper video size based on screen size
    function resizeVideos() {
        // Set appropriate max-width based on screen size
        var screenWidth = $(window).width();
        var maxWidth, widthPercent;
        
        if (screenWidth < 768) {
            // Mobile
            maxWidth = '450px';
            widthPercent = '100%';
        } else if (screenWidth < 1024) {
            // Tablet
            maxWidth = '600px';
            widthPercent = '95%';
        } else {
            // Desktop
            maxWidth = '854px';
            widthPercent = '100%';
        }
        
        // Apply to all video containers
        $('.responsive-video-wrapper, .wp-block-embed, .wp-block-video').css({
            'max-width': maxWidth,
            'width': widthPercent,
            'margin-left': 'auto',
            'margin-right': 'auto'
        });
    }

    // Add prose class to entry-content if not already present
    if ($('.entry-content').length && !$('.entry-content').hasClass('prose')) {
        $('.entry-content').addClass('prose');
    }

    // Fix video embeds on initial load
    fixVideoEmbeds();

    // Fix video size on initial load and window resize
    resizeVideos();
    $(window).on('resize', resizeVideos);

    // Re-check for videos after content updates (like AJAX loads)
    $(document).ajaxComplete(function() {
        setTimeout(function() {
            fixVideoEmbeds();
            resizeVideos();
        }, 300);
    });

    // Enhanced table of contents - make sure links scroll smoothly
    $('.table-of-contents a, a[href^="#"]').on('click', function(e) {
        var target = $(this.hash);
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100 // Account for fixed header
            }, 600);
            
            // Set focus to the target heading for accessibility
            target.attr('tabindex', '-1');
            target.focus();
            
            // Remove tabindex after focus
            setTimeout(function() {
                target.removeAttr('tabindex');
            }, 1000);
        }
    });
    
    // If URL has a hash on page load, scroll properly accounting for fixed header
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

    // Add ID attributes to headings without IDs for TOC
    $('.entry-content h2, .entry-content h3, .entry-content h4').each(function() {
        if (!this.id) {
            var text = $(this).text();
            var id = text.toLowerCase().replace(/[^a-z0-9]+/g, '-');
            $(this).attr('id', id);
        }
    });

    // Enhance tables in blog content
    function enhanceTables() {
        // Find all tables in the content (but not in TOC)
        $('.entry-content table').each(function() {
            var $table = $(this);
            
            // Skip if table is already in a table container
            if ($table.parent().hasClass('table-container')) {
                return;
            }
            
            // Skip if table is in the table of contents
            if ($table.closest('.table-of-contents').length) {
                return;
            }
            
            // Wrap table in a container for horizontal scrolling
            $table.wrap('<div class="table-container"></div>');
            
            // Check table width to see if scrolling is needed
            var tableWidth = $table.width();
            var containerWidth = $table.parent().width();
            
            if (tableWidth > containerWidth) {
                // Add a subtle indicator that table can be scrolled
                var $scrollIndicator = $('<div class="table-scroll-indicator" style="text-align: right; font-size: 0.8rem; color: #60a5fa; padding: 0.5rem 0;">Scroll →</div>');
                $table.before($scrollIndicator);
                
                // Hide the indicator after 5 seconds
                setTimeout(function() {
                    $scrollIndicator.fadeOut();
                }, 5000);
            }
        });
    }

    // Add the table enhancement
    enhanceTables();
    
    // Re-apply on window resize
    $(window).on('resize', function() {
        // Use a debounce to avoid calling too frequently
        clearTimeout(window.resizeTablesTimer);
        window.resizeTablesTimer = setTimeout(function() {
            enhanceTables();
        }, 250);
    });
}); 