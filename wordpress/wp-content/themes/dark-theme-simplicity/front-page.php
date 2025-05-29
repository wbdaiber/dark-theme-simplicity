<?php 
// Get homepage settings
$show_default_hero = get_theme_mod('dark_theme_simplicity_show_default_hero', true);
$show_default_services = get_theme_mod('dark_theme_simplicity_show_default_services', true);
$show_default_benefits = get_theme_mod('dark_theme_simplicity_show_default_benefits', true);
$show_default_approach = get_theme_mod('dark_theme_simplicity_show_default_approach', true);
$show_default_about = get_theme_mod('dark_theme_simplicity_show_default_about', true);
$show_default_contact = get_theme_mod('dark_theme_simplicity_show_default_contact', true);

get_header(); 
?>

<main class="site-main">
    <?php 
    // Display each section if enabled
    
    // Hero Section
    if ($show_default_hero) {
    ?>
    <!-- Hero Section -->
    <section class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden -mt-16">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('<?php echo esc_url(get_theme_mod('dark_theme_simplicity_hero_bg_image', 'https://braddaiber.com/wp-content/uploads/2024/03/shutterstock_134653565-1-scaled.webp')); ?>');">
            <div class="absolute inset-0 bg-gradient-to-b from-dark-200/80 via-dark-200/70 to-dark-200"></div>
        </div>
        
        <div class="relative z-10 flex flex-col items-center w-full text-center px-4 max-w-7xl mx-auto pt-40">
            <h1 class="text-7xl md:text-8xl lg:text-9xl font-extrabold mb-10 text-white animate-fade-in-up leading-none tracking-tight">
                <?php echo esc_html(get_theme_mod('dark_theme_simplicity_hero_heading', 'No fluff, just results.')); ?>
            </h1>
            <p class="text-3xl md:text-4xl text-gray-200 mb-16 font-light max-w-4xl mx-auto animate-fade-in-up animation-delay-200">
                <?php echo esc_html(get_theme_mod('dark_theme_simplicity_hero_subheading', 'Digital assets that drive outsized return on investment.')); ?>
            </p>
            <div class="flex flex-wrap justify-center gap-6 mt-8 animate-fade-in-up animation-delay-300">
                <a href="#what-we-do" class="hero-btn flex items-center gap-3 text-white shadow-md hover:shadow-lg transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.29 7 12 12 20.71 7"></polyline>
                        <line x1="12" y1="22" x2="12" y2="12"></line>
                    </svg>
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_hero_button_services_text', 'Services')); ?>
                </a>
                <a href="#benefits" class="hero-btn flex items-center gap-3 text-white shadow-md hover:shadow-lg transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_hero_button_benefits_text', 'Benefits')); ?>
                </a>
                <a href="#approach" class="hero-btn flex items-center gap-3 text-white shadow-md hover:shadow-lg transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_hero_button_approach_text', 'Approach')); ?>
                </a>
                <a href="#about" class="hero-btn flex items-center gap-3 text-white shadow-md hover:shadow-lg transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_hero_button_about_text', 'About')); ?>
                </a>
                <a href="#contact" class="hero-btn flex items-center gap-3 text-white shadow-md hover:shadow-lg transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_hero_button_contact_text', 'Contact')); ?>
                </a>
            </div>
        </div>
    </section>
    <?php
    }
    
    // Services Section
    if ($show_default_services) {
        include(get_template_directory() . '/template-parts/homepage/section-services.php');
    }
    
    // Benefits Section
    if ($show_default_benefits) {
        include(get_template_directory() . '/template-parts/homepage/section-benefits.php');
    }
    
    // Approach Section
    if ($show_default_approach) {
        include(get_template_directory() . '/template-parts/homepage/section-approach.php');
    }
    
    // About Section
    if ($show_default_about) {
        include(get_template_directory() . '/template-parts/homepage/section-about.php');
    }
    
    // Contact Section
    if ($show_default_contact) {
        include(get_template_directory() . '/template-parts/homepage/section-contact.php');
    }
    ?>
</main>

<?php get_footer(); ?>