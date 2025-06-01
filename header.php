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
                    'container'      => false,
                    'menu_class'     => 'flex items-center gap-8',
                    'fallback_cb'    => false,
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'          => 1,
                    'walker'         => new Dark_Theme_Simplicity_Walker_Nav_Menu(),
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
                'container'      => false,
                'menu_class'     => 'w-full',
                'fallback_cb'    => false,
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'          => 1,
                'walker'         => new Dark_Theme_Simplicity_Walker_Nav_Menu_Mobile(),
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
/* Mobile menu styles */
#mobile-menu {
    transition: transform 0.3s ease, opacity 0.3s ease;
    box-shadow: -5px 5px 15px rgba(0, 0, 0, 0.3);
    max-height: calc(100vh - 64px);
    overflow-y: auto;
    background-color: rgba(17, 24, 39, 0.98); /* dark-200 with higher opacity */
    backdrop-filter: blur(10px);
}

#mobile-menu a {
    padding: 12px 16px;
    display: block;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    text-align: right;
    font-weight: 500;
}

#mobile-menu a:last-child {
    border-bottom: none;
}

#mobile-menu a:hover {
    background-color: rgba(96, 165, 250, 0.15);
    padding-right: 20px;
}

#mobile-menu.hidden {
    display: none;
}

/* Active menu item */
#mobile-menu .current-menu-item a {
    color: #60a5fa;
    border-right: 3px solid #60a5fa;
    background-color: rgba(96, 165, 250, 0.15);
}

/* Mobile menu toggle button animation */
#mobile-menu-toggle:hover svg {
    transform: scale(1.1);
    transition: transform 0.2s ease;
}

/* Mobile menu scroll enhancement */
#mobile-menu::-webkit-scrollbar {
    width: 4px;
}

#mobile-menu::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
}

#mobile-menu::-webkit-scrollbar-thumb {
    background: rgba(96, 165, 250, 0.5);
    border-radius: 2px;
}
</style>

<main> 