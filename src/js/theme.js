// Dark mode functionality
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    const html = document.documentElement;
    
    // Always start in dark mode
    html.classList.add('dark');
    localStorage.setItem('theme', 'dark');

    // Toggle theme
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    }
    
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    
    if (mobileMenuToggle && mobileMenu) {
        // Add transition styles to the menu
        mobileMenu.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
        
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent click from immediately closing
            
            if (mobileMenu.classList.contains('hidden')) {
                // Show menu
                mobileMenu.classList.remove('hidden');
                if (mobileMenuOverlay) mobileMenuOverlay.classList.remove('hidden');
                
                // Set initial state (off-screen)
                mobileMenu.style.transform = 'translateX(100%)';
                mobileMenu.style.opacity = '0';
                
                // Force browser reflow
                mobileMenu.offsetHeight;
                
                // Animate in
                requestAnimationFrame(() => {
                    mobileMenu.style.transform = 'translateX(0)';
                    mobileMenu.style.opacity = '1';
                });
            } else {
                // Hide menu
                closeMenu();
            }
        });
        
        function closeMenu() {
            if (!mobileMenu.classList.contains('hidden')) {
                // Animate out
                mobileMenu.style.transform = 'translateX(100%)';
                mobileMenu.style.opacity = '0';
                
                // Wait for animation then hide
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    if (mobileMenuOverlay) mobileMenuOverlay.classList.add('hidden');
                }, 300);
            }
        }
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenu.classList.contains('hidden') && 
                !mobileMenu.contains(event.target) && 
                !mobileMenuToggle.contains(event.target)) {
                closeMenu();
            }
        });
        
        // Add click event to overlay
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', function() {
                closeMenu();
            });
        }
        
        // Close menu when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMenu();
            }
        });
        
        // Close menu when clicking a menu item
        const menuLinks = mobileMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                closeMenu();
            });
        });
    }
}); 