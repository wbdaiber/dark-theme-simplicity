/**
 * Mobile Menu Functionality
 * Simple, reliable implementation for WordPress theme
 */

(function() {
    'use strict';
    
    function initMobileMenu() {
        // Get elements
        const toggleButton = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-menu-overlay');
        
        // Exit if required elements don't exist
        if (!toggleButton || !mobileMenu) {
            return;
        }
        
        // Simple toggle function
        function toggleMenu() {
            const isHidden = mobileMenu.classList.contains('hidden');
            
            if (isHidden) {
                // Open menu
                mobileMenu.classList.remove('hidden');
                if (overlay) overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                // Close menu
                mobileMenu.classList.add('hidden');
                if (overlay) overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
        
        // Main toggle button click
        toggleButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMenu();
        });
        
        // Close on overlay click
        if (overlay) {
            overlay.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            });
        }
        
        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                if (overlay) overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
        
        // Close when clicking outside menu
        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && 
                !toggleButton.contains(e.target) && 
                !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                if (overlay) overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
        
        // Close menu when clicking menu links
        const menuLinks = mobileMenu.querySelectorAll('a');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                if (overlay) overlay.classList.add('hidden');
                document.body.style.overflow = '';
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileMenu);
    } else {
        initMobileMenu();
    }
})();