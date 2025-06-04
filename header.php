<!DOCTYPE html>
<html <?php language_attributes(); ?> class="h-full">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    
	<?php if (is_front_page()): ?>
	<!-- Homepage section styles - only loaded on front page -->
	<style>
    	.services-section .bg-\[\#1e1e24\] {
        	background-color: #1e1e24 !important;
        	border-radius: 0.5rem !important;
    	}
   	 
    	.services-section .bg-\[\#1e1e24\]:hover {
        	border: 2px solid #3b82f6 !important;
        	transform: translateY(-5px) !important;
        	box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2) !important;
        	transition: all 0.3s ease !important;
    	}
   	 
    	.services-section .w-10 {
        	width: 2.5rem !important;
        	height: 2.5rem !important;
    	}
   	 
    	.services-section .text-2xl {
        	font-size: 1.5rem !important;
        	line-height: 2rem !important;
    	}
   	 
    	/* Benefits section card styles */
    	.benefits-section .bg-\[\#1e1e24\] {
        	background-color: #1e1e24 !important;
        	border-radius: 0.5rem !important;
    	}
   	 
    	.benefits-section .bg-\[\#1e1e24\]:hover {
        	border: 2px solid #3b82f6 !important;
        	transform: translateY(-5px) !important;
        	box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2) !important;
        	transition: all 0.3s ease !important;
    	}
   	 
    	/* Global paragraph styling */
    	p {
        	color: hsla(0,0%,100%,.7) !important;
        	font-size: 1.25rem !important;
        	line-height: 1.75rem !important;
    	}
   	 
    	/* Ensure all service and benefit card paragraphs have consistent color */
    	.services-section p,
    	.benefits-section p {
        	color: hsla(0,0%,100%,.7) !important;
        	font-size: 1.25rem !important;
        	line-height: 1.75rem !important;
    	}
   	 
    	/* Custom styles */
    	.services-section .service-card {
        	background-color: #1e1e24 !important;
        	border-radius: 0.5rem !important;
    	}
   	 
    	.services-section .service-card:hover {
        	border: 2px solid #3b82f6 !important;
        	transform: translateY(-5px) !important;
        	box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.2) !important;
        	transition: all 0.3s ease !important;
    	}
   	 
    	.benefits-section .bg-\[\#1e1e24\] {
        	background-color: #1e1e24 !important;
        	border-radius: 0.5rem !important;
    	}
   	 
    	.benefits-section .bg-\[\#1e1e24\]:hover {
        	border: 2px solid #3b82f6 !important;
        	transform: translateY(-5px) !important;
        	box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.2) !important;
        	transition: all 0.3s ease !important;
    	}
   	 
    	.approach-section .bg-\[\#1e1e24\] {
        	background-color: #1e1e24 !important;
        	border-radius: 0.5rem !important;
    	}
   	 
    	.approach-section .bg-\[\#1e1e24\]:hover {
        	border: 2px solid #3b82f6 !important;
        	transform: translateY(-5px) !important;
        	box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.2) !important;
        	transition: all 0.3s ease !important;
    	}
   	 
    	/* Ensure consistent paragraph styling */
    	p {
        	color: hsla(0,0%,100%,.7) !important;
        	font-size: 1.25rem !important; /* text-xl equivalent */
        	line-height: 1.75rem !important;
    	}
   	 
    	.services-section p,
    	.benefits-section p,
    	.approach-section p {
        	color: hsla(0,0%,100%,.7) !important;
        	font-size: 1.25rem !important; /* text-xl equivalent */
        	line-height: 1.75rem !important;
    	}
   	 
    	/* Tailwind utilities that might not be compiled yet */
    	.w-10 {
        	width: 2.5rem !important;
    	}
   	 
    	.h-10 {
        	height: 2.5rem !important;
    	}
   	 
    	.text-2xl {
        	font-size: 1.5rem !important;
        	line-height: 2rem !important;
    	}
	</style>
	<?php endif; ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class('min-h-full bg-dark-200 text-light-100'); ?>>
<?php wp_body_open(); ?>

<header class="site-header fixed w-full top-0 left-0 z-50 bg-dark-200/95 backdrop-blur-md border-b border-white/10 h-16">
	<div class="container mx-auto px-4 py-4 flex items-center justify-between">
    	<!-- Logo + Site Title -->
    	<a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3">
        	<!-- 3D Cube SVG -->
        	<span class="inline-block">
            	<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-blue-400">
                	<!-- Top face -->
                	<path d="M16 8L4 14L16 20L28 14L16 8Z" stroke="#60a5fa" stroke-width="2" fill="none" />
                	<!-- Front face -->
                	<path d="M4 14V22L16 28V20L4 14Z" stroke="#60a5fa" stroke-width="2" fill="none" />
                	<!-- Right face -->
                	<path d="M16 20V28L28 22V14L16 20Z" stroke="#60a5fa" stroke-width="2" fill="none" />
                	<!-- Inner lines for 3D effect -->
                	<path d="M16 8V20" stroke="#60a5fa" stroke-width="1.5" opacity="0.8" />
            	</svg>
        	</span>
        	<span class="site-title text-xl font-bold text-white"><?php echo esc_html(get_theme_mod('dark_theme_simplicity_site_title', 'Brad Daiber')); ?></span>
    	</a>
    	<!-- Desktop Nav -->
    	<nav class="hidden md:flex items-center gap-8">
        	<?php
        	if (has_nav_menu('primary')) {
            	wp_nav_menu(array(
                	'theme_location' => 'primary',
                	'container'  	=> false,
                	'menu_class' 	=> 'flex items-center gap-8',
                	'fallback_cb'	=> false,
                	'items_wrap' 	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
                	'depth'      	=> 1,
                	'walker'     	=> new Dark_Theme_Simplicity_Walker_Nav_Menu(),
            	));
        	} else {
            	// Fallback to default menu items if no menu is set
            	?>
            	<a href="<?php echo esc_url(home_url('/blog')); ?>" class="text-white hover:text-blue-400 transition-colors duration-200 font-medium">Blog</a>
            	<a href="<?php echo esc_url(home_url('/about')); ?>" class="text-white hover:text-blue-400 transition-colors duration-200 font-medium">About</a>
            	<?php
        	}
        	?>
    	</nav>
    	<!-- Hamburger (Mobile Only) -->
    	<button id="mobile-menu-toggle" class="md:hidden p-2 rounded-lg hover:bg-blue-300/10 transition-all duration-200" aria-label="Open menu">
        	<svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            	<line x1="4" y1="6" x2="20" y2="6" />
            	<line x1="4" y1="12" x2="20" y2="12" />
            	<line x1="4" y1="18" x2="20" y2="18" />
        	</svg>
    	</button>
	</div>
	<!-- Mobile Menu (hidden by default, JS can toggle) -->
	<div id="mobile-menu-overlay" class="hidden fixed inset-0 bg-black/40 z-40"></div>
	<nav id="mobile-menu" class="md:hidden hidden absolute right-0 top-16 w-64 flex-col bg-dark-200/98 backdrop-blur-lg px-4 pb-6 pt-2 border-t border-l border-white/15 shadow-xl rounded-bl-lg z-50">
    	<?php
    	if (has_nav_menu('primary')) {
        	wp_nav_menu(array(
            	'theme_location' => 'primary',
            	'container'  	=> false,
            	'menu_class' 	=> 'w-full',
            	'fallback_cb'	=> false,
            	'items_wrap' 	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
            	'depth'      	=> 1,
            	'walker'     	=> new Dark_Theme_Simplicity_Walker_Nav_Menu_Mobile(),
        	));
    	} else {
        	// Fallback to default menu items if no menu is set
        	?>
        	<a href="<?php echo esc_url(home_url('/blog')); ?>" class="block w-full py-3 text-white hover:text-blue-400 transition-colors duration-200 font-medium border-b border-white/10 text-right pr-3">Blog</a>
        	<a href="<?php echo esc_url(home_url('/about')); ?>" class="block w-full py-3 text-white hover:text-blue-400 transition-colors duration-200 font-medium border-b border-white/10 text-right pr-3">About</a>
        	<?php
    	}
    	?>
	</nav>
</header>

<style>
/* Mobile menu styles - Updated for scrollable background page */
#mobile-menu {
    position: fixed; /* Changed from absolute to fixed */
    top: 64px; /* Header height */
    right: 0;
    width: 256px; /* 16rem */
    max-height: calc(100vh - 64px);
    overflow-y: auto;
    background-color: rgba(17, 24, 39, 0.98);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    box-shadow: -5px 5px 20px rgba(0, 0, 0, 0.4);
    z-index: 50;
    border-left: 1px solid rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    border-bottom-left-radius: 8px;
    /* Smooth transition for menu appearance */
    transition: transform 0.3s ease-out, opacity 0.3s ease-out;
    transform: translateX(0);
    opacity: 1;
}

/* Hidden state with slide animation */
#mobile-menu.hidden {
    transform: translateX(100%);
    opacity: 0;
    /* Use visibility instead of display: none to maintain transitions */
    visibility: hidden;
    pointer-events: none;
}

/* Mobile menu overlay - Updated for better behavior */
#mobile-menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.3);
    z-index: 40;
    /* Allow page content to be scrollable behind overlay */
    pointer-events: auto;
    transition: opacity 0.3s ease-out;
    opacity: 1;
}

#mobile-menu-overlay.hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

/* Menu item styles */
#mobile-menu a {
    padding: 14px 20px;
    display: block;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    text-align: right;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.9);
    transition: all 0.2s ease;
    position: relative;
}

#mobile-menu a:last-child {
    border-bottom: none;
}

#mobile-menu a:hover {
    background-color: rgba(96, 165, 250, 0.15);
    color: #60a5fa;
    padding-right: 24px;
    /* Add subtle border effect */
    border-right: 3px solid #60a5fa;
}

/* Active menu item */
#mobile-menu .current-menu-item a {
    color: #60a5fa;
    background-color: rgba(96, 165, 250, 0.1);
    border-right: 3px solid #60a5fa;
}

/* Mobile menu toggle button */
#mobile-menu-toggle {
    cursor: pointer;
    transition: all 0.2s ease;
    border-radius: 6px;
    padding: 8px;
}

#mobile-menu-toggle:hover {
    background-color: rgba(96, 165, 250, 0.15);
    transform: scale(1.05);
}

#mobile-menu-toggle:active {
    transform: scale(0.95);
}

#mobile-menu-toggle svg {
    transition: all 0.2s ease;
}

#mobile-menu-toggle:hover svg {
    color: #60a5fa;
    transform: scale(1.1);
}

/* Enhanced scrollbar for mobile menu */
#mobile-menu::-webkit-scrollbar {
    width: 6px;
}

#mobile-menu::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 3px;
}

#mobile-menu::-webkit-scrollbar-thumb {
    background: rgba(96, 165, 250, 0.6);
    border-radius: 3px;
    transition: background 0.2s ease;
}

#mobile-menu::-webkit-scrollbar-thumb:hover {
    background: rgba(96, 165, 250, 0.8);
}

/* Ensure mobile elements are hidden on desktop */
@media (min-width: 768px) {
    #mobile-menu,
    #mobile-menu-overlay,
    #mobile-menu-toggle {
        display: none !important;
    }
}

/* Enhanced mobile responsiveness */
@media (max-width: 480px) {
    #mobile-menu {
        width: 100%;
        right: 0;
        left: 0;
        border-radius: 0;
        border-left: none;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 -2px 20px rgba(0, 0, 0, 0.4);
    }
    
    #mobile-menu a {
        text-align: center;
        padding: 16px 20px;
    }
    
    #mobile-menu a:hover {
        padding-right: 20px; /* Reset padding on very small screens */
        border-right: none;
        border-bottom: 3px solid #60a5fa;
    }
}

/* Prevent body scroll on very small devices if needed (optional) */
@media (max-width: 480px) and (max-height: 600px) {
    /* Only apply on very small screens where menu might take up most of the viewport */
    body.mobile-menu-open {
        overflow: hidden;
    }
}

/* Animation keyframes for smooth menu appearance */
@keyframes slideInFromRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutToRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

/* Apply animations when menu state changes */
#mobile-menu:not(.hidden) {
    animation: slideInFromRight 0.3s ease-out;
}

/* Focus styles for accessibility */
#mobile-menu a:focus {
    outline: 2px solid #60a5fa;
    outline-offset: -2px;
    background-color: rgba(96, 165, 250, 0.2);
}

/* Improved visual hierarchy */
#mobile-menu {
    font-family: inherit;
}

#mobile-menu a {
    font-size: 16px;
    line-height: 1.5;
    letter-spacing: 0.01em;
}

/* Add subtle backdrop blur effect */
#mobile-menu-overlay {
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
}

/* FIXED: Sticky header with mobile-specific padding */
.site-header {
    position: fixed !important;
    top: 0;
    left: 0;
    width: 100%;
    height: 64px; /* 4rem */
    background-color: rgba(18, 18, 20, 0.95) !important; /* dark-200/95 */
    backdrop-filter: blur(12px) !important;
    -webkit-backdrop-filter: blur(12px) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    z-index: 100; /* Higher than menu */
    transition: all 0.3s ease;
}

/* Enhanced backdrop effect when scrolling */
.site-header.scrolled {
    background-color: rgba(18, 18, 20, 0.98) !important;
    backdrop-filter: blur(16px) !important;
    -webkit-backdrop-filter: blur(16px) !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

/* Mobile-specific padding for better readability */
@media (max-width: 767px) {
    /* Add padding only on mobile for readability - but exclude homepage */
    body:not(.home) main > :first-child,
    body:not(.home) main .container > :first-child,
    body:not(.front-page) main > :first-child,
    body:not(.front-page) main .container > :first-child,
    .entry-content:not(.home .entry-content):not(.front-page .entry-content),
    .page-content:not(.home .page-content):not(.front-page .page-content) {
        padding-top: 38px; /* Enough space for header + breathing room */
    }
    
    /* Hero sections on mobile - only apply container-level padding, not to child elements */
    .hero-section > .container,
    .homepage-hero > .container,
    [class*="hero"] > .container {
        padding-top: 38px !important;
    }
    
    /* Ensure hero sections themselves don't get extra padding */
    .hero-section,
    .homepage-hero,
    [class*="hero"] {
        margin-top: 0 !important;
    }
    
    /* Reset any padding on hero child elements that might be affected */
    .hero-section .btn,
    .hero-section button,
    .homepage-hero .btn,
    .homepage-hero button,
    [class*="hero"] .btn,
    [class*="hero"] button,
    .hero-section .hero-buttons,
    .homepage-hero .hero-buttons,
    [class*="hero"] .hero-buttons {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
}
/* Desktop - let content flow naturally under header */
@media (min-width: 768px) {
    /* No extra padding on desktop - content flows naturally */
    main,
    .entry-content,
    .page-content {
        padding-top: 0;
    }
}

/* Handle potential content shifting */
body {
    transition: none; /* Prevent any unwanted body transitions */
}

/* Add scroll enhancement for sticky header */
@media (min-width: 768px) {
    .site-header {
        background-color: rgba(18, 18, 20, 0.92) !important;
        backdrop-filter: blur(14px) !important;
        -webkit-backdrop-filter: blur(14px) !important;
    }
    
    .site-header.scrolled {
        background-color: rgba(18, 18, 20, 0.96) !important;
        backdrop-filter: blur(18px) !important;
        -webkit-backdrop-filter: blur(18px) !important;
    }
}
</style>
<main>
