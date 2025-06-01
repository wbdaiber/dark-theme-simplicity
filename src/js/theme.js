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
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent click from immediately closing
            
            // Set initial position for animation
            if (mobileMenu.classList.contains('hidden')) {
                // Show the menu and overlay but position menu off-screen first
                mobileMenu.classList.remove('hidden');
                if (mobileMenuOverlay) mobileMenuOverlay.classList.remove('hidden');
                mobileMenu.style.transform = 'translateX(100%)';
                mobileMenu.style.opacity = '0';
                
                // Force browser reflow to ensure transition happens
                void mobileMenu.offsetWidth;
                
                // Animate the menu in
                mobileMenu.style.transform = 'translateX(0)';
                mobileMenu.style.opacity = '1';
            } else {
                // Animate the menu out
                mobileMenu.style.transform = 'translateX(100%)';
                mobileMenu.style.opacity = '0';
                
                // Hide the menu and overlay after animation completes
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    if (mobileMenuOverlay) mobileMenuOverlay.classList.add('hidden');
                }, 300);
            }
        });
        
        // Close menu when clicking outside or on overlay
        document.addEventListener('click', function(event) {
            if (!mobileMenu.classList.contains('hidden') && 
                !mobileMenu.contains(event.target) && 
                !mobileMenuToggle.contains(event.target)) {
                // Animate out
                mobileMenu.style.transform = 'translateX(100%)';
                mobileMenu.style.opacity = '0';
                
                // After animation completes, hide the menu and overlay
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    if (mobileMenuOverlay) mobileMenuOverlay.classList.add('hidden');
                }, 300);
            }
        });
        
        // Add click event to overlay specifically
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', function() {
                if (!mobileMenu.classList.contains('hidden')) {
                    // Animate out
                    mobileMenu.style.transform = 'translateX(100%)';
                    mobileMenu.style.opacity = '0';
                    
                    // After animation completes, hide the menu and overlay
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileMenuOverlay.classList.add('hidden');
                    }, 300);
                }
            });
        }
        
        // Close menu when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                // Animate out
                mobileMenu.style.transform = 'translateX(100%)';
                mobileMenu.style.opacity = '0';
                
                // After animation completes, hide the menu and overlay
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    if (mobileMenuOverlay) mobileMenuOverlay.classList.add('hidden');
                }, 300);
            }
        });
        
        // Close menu when clicking a menu item (for better mobile experience)
        const menuLinks = mobileMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Animate out
                mobileMenu.style.transform = 'translateX(100%)';
                mobileMenu.style.opacity = '0';
                
                // After animation completes, hide the menu and overlay
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    if (mobileMenuOverlay) mobileMenuOverlay.classList.add('hidden');
                }, 300);
            });
        });
    }
}); 