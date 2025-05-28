<?php get_header(); ?>

<main class="site-main">
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

    <!-- Services Section -->
    <section id="what-we-do" class="py-20 px-4 md:px-0">
        <div class="container mx-auto max-w-6xl">
            <div class="text-center mb-16">
                <p class="text-blue-300 uppercase font-bold tracking-wide mb-2 section-label">
                    <?php esc_html_e( 'What we do', 'dark-theme-simplicity' ); ?>
                </p>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <?php echo esc_html( get_theme_mod( 'dark_theme_simplicity_services_title', __( 'Our Services', 'dark-theme-simplicity' ) ) ); ?>
                </h2>
                <p class="text-xl text-light-100/80 max-w-3xl mx-auto">
                    <?php echo esc_html( get_theme_mod( 'dark_theme_simplicity_services_description', __( 'Comprehensive digital marketing solutions to elevate your online presence.', 'dark-theme-simplicity' ) ) ); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service Cards -->
                <?php
                $service_items = get_theme_mod('dark_theme_simplicity_service_items');
                $service_items = json_decode($service_items, true);
                
                if (!empty($service_items) && is_array($service_items)) {
                    foreach ($service_items as $index => $service) {
                        $animation_delay = $index * 200; // 0, 200, 400, etc.
                        $delay_class = $index > 0 ? "animation-delay-{$animation_delay}" : "";
                        $icon = isset($service['icon']) ? $service['icon'] : 'globe';
                        $title = isset($service['title']) ? $service['title'] : 'Service Title';
                        $description = isset($service['description']) ? $service['description'] : 'Service description goes here.';
                        
                        // Get SVG icon based on the selected icon name
                        $svg_icon = dark_theme_simplicity_get_service_icon($icon);
                        ?>
                        <div class="bg-[#1e1e24] p-8 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group animate-fade-in <?php echo esc_attr($delay_class); ?>">
                            <div class="bg-blue-900/40 p-4 rounded-lg w-18 h-18 mb-6 flex items-center justify-center group-hover:bg-blue-800/60 transition-all">
                                <?php echo $svg_icon; ?>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-white"><?php echo esc_html($title); ?></h3>
                            <p class="text-xl text-light-100/70"><?php echo esc_html($description); ?></p>
                        </div>
                        <?php
                    }
                } else {
                    // Fallback if no service items are defined
                    ?>
                    <div class="bg-[#1e1e24] p-8 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group animate-fade-in">
                        <div class="bg-blue-900/40 p-4 rounded-lg w-18 h-18 mb-6 flex items-center justify-center group-hover:bg-blue-800/60 transition-all">
                            <svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-white">Strategic SEO</h3>
                        <p class="text-xl text-light-100/70">Boost your visibility with search engine optimization that drives organic traffic.</p>
                    </div>
                    <div class="bg-[#1e1e24] p-8 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group animate-fade-in animation-delay-200">
                        <div class="bg-blue-900/40 p-4 rounded-lg w-18 h-18 mb-6 flex items-center justify-center group-hover:bg-blue-800/60 transition-all">
                            <svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-white">Content Creation</h3>
                        <p class="text-xl text-light-100/70">Engaging, on-brand content that resonates with your target audience.</p>
                    </div>
                    <div class="bg-[#1e1e24] p-8 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group animate-fade-in animation-delay-400">
                        <div class="bg-blue-900/40 p-4 rounded-lg w-18 h-18 mb-6 flex items-center justify-center group-hover:bg-blue-800/60 transition-all">
                            <svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                <line x1="8" y1="21" x2="16" y2="21"></line>
                                <line x1="12" y1="17" x2="12" y2="21"></line>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-white">Website Development</h3>
                        <p class="text-xl text-light-100/70">Custom websites designed for user experience and conversion optimization.</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!-- Benefits Section -->
    <section id="benefits" class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-200 benefits-section">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4">
                    Why Choose Us
                </span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-light-100">
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_benefits_title', 'Key Benefits')); ?>
                </h2>
                <p class="text-xl text-light-100/70 mb-6 max-w-2xl mx-auto">
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_benefits_description', 'We deliver real results through strategic digital solutions tailored to your business goals.')); ?>
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php
                $benefit_items = get_theme_mod('dark_theme_simplicity_benefit_items');
                $benefit_items = json_decode($benefit_items, true);
                
                if (!empty($benefit_items) && is_array($benefit_items)) {
                    foreach ($benefit_items as $index => $benefit) {
                        $animation_delay = $index * 200; // 0, 200, 400, etc.
                        $delay_class = $index > 0 ? "animation-delay-{$animation_delay}" : "";
                        $title = isset($benefit['title']) ? $benefit['title'] : 'Benefit Title';
                        $description = isset($benefit['description']) ? $benefit['description'] : 'Benefit description goes here.';
                        ?>
                        <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group animate-fade-in <?php echo esc_attr($delay_class); ?>">
                            <h3 class="text-xl font-bold mb-3 text-white"><?php echo esc_html($title); ?></h3>
                            <p class="text-xl text-light-100/70"><?php echo esc_html($description); ?></p>
                        </div>
                        <?php
                    }
                } else {
                    // Fallback if no benefit items are defined
                    ?>
                    <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group">
                        <h3 class="text-xl font-bold mb-3 text-white">Data-Driven</h3>
                        <p class="text-xl text-light-100/70">Our strategies are backed by thorough research and analytics for measurable outcomes.</p>
                    </div>
                    <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group">
                        <h3 class="text-xl font-bold mb-3 text-white">Customized Approach</h3>
                        <p class="text-xl text-light-100/70">Solutions are tailored to your specific industry, audience, and business objectives.</p>
                    </div>
                    <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group">
                        <h3 class="text-xl font-bold mb-3 text-white">Transparent Process</h3>
                        <p class="text-xl text-light-100/70">Clear communication and regular reporting keep you informed every step of the way.</p>
                    </div>
                    <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group">
                        <h3 class="text-xl font-bold mb-3 text-white">Continuous Optimization</h3>
                        <p class="text-xl text-light-100/70">We consistently refine strategies based on performance data to maximize ROI.</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!-- Approach Section -->
    <section id="approach" class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-200 approach-section">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4 border border-blue-300/20">
                    My Approach
                </span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-light-100">
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_approach_title', 'How I work with clients')); ?>
                </h2>
                <p class="text-xl text-light-100/70 mb-6 max-w-2xl mx-auto">
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_approach_description', 'I believe in a collaborative approach to content strategy. Your business is unique, and your content strategy should be too.')); ?>
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $approach_items = get_theme_mod('dark_theme_simplicity_approach_items');
                $approach_items = json_decode($approach_items, true);
                
                if (!empty($approach_items) && is_array($approach_items)) {
                    foreach ($approach_items as $index => $approach) {
                        $animation_delay = $index * 200; // 0, 200, 400, etc.
                        $delay_class = $index > 0 ? "animation-delay-{$animation_delay}" : "";
                        $title = isset($approach['title']) ? $approach['title'] : 'Approach Step';
                        $description = isset($approach['description']) ? $approach['description'] : 'Description goes here.';
                        ?>
                        <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group animate-fade-in <?php echo esc_attr($delay_class); ?>">
                            <h3 class="text-xl font-bold mb-3 text-white"><?php echo esc_html($title); ?></h3>
                            <p class="text-xl text-light-100/70"><?php echo esc_html($description); ?></p>
                        </div>
                        <?php
                    }
                } else {
                    // Fallback if no approach items are defined
                    ?>
                    <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group">
                        <h3 class="text-xl font-bold mb-3 text-white">1. Discovery</h3>
                        <p class="text-xl text-light-100/70">I start by understanding your business, audience, and goals to create a tailored strategy.</p>
                    </div>
                    <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group">
                        <h3 class="text-xl font-bold mb-3 text-white">2. Strategy Development</h3>
                        <p class="text-xl text-light-100/70">Based on research and your goals, I develop a content strategy aligned with your business objectives.</p>
                    </div>
                    <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group">
                        <h3 class="text-xl font-bold mb-3 text-white">3. Implementation</h3>
                        <p class="text-xl text-light-100/70">I create content that engages your audience and drives the results you're looking for.</p>
                    </div>
                    <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group">
                        <h3 class="text-xl font-bold mb-3 text-white">4. Analysis & Optimization</h3>
                        <p class="text-xl text-light-100/70">I continuously monitor performance and optimize your content strategy for better results.</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!-- About Section -->
    <section id="about" class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-300">
        <div class="container mx-auto">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-16">
                    <span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4">
                        About Me
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-light-100">
                        <?php echo esc_html(get_theme_mod('dark_theme_simplicity_about_title', 'Digital Marketing Specialist')); ?>
                    </h2>
                    <p class="text-xl text-light-100/70 max-w-2xl mx-auto">
                        <?php echo esc_html(get_theme_mod('dark_theme_simplicity_about_subtitle', 'With over a decade of experience helping businesses thrive online.')); ?>
                    </p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <p class="text-xl text-light-100/70">
                            <?php echo esc_html(get_theme_mod('dark_theme_simplicity_about_content_1', 'I\'m Brad Daiber, a seasoned digital marketing consultant with a passion for helping businesses establish a powerful online presence. With a background in SEO, content creation, and web design, I provide comprehensive solutions tailored to your specific needs.')); ?>
                        </p>
                        <p class="text-xl text-light-100/70">
                            <?php echo esc_html(get_theme_mod('dark_theme_simplicity_about_content_2', 'My approach combines data-driven strategies with creative thinking to deliver measurable results. Whether you\'re looking to increase website traffic, improve conversion rates, or establish your brand voice, I\'m here to help you achieve your goals.')); ?>
                        </p>
                    </div>
                    <div class="relative h-[400px] w-full rounded-xl overflow-hidden glass-card">
                        <div class="absolute inset-0 bg-gradient-to-tr from-blue-300/20 to-transparent"></div>
                        <img
                            src="<?php echo esc_url(get_theme_mod('dark_theme_simplicity_about_image', get_template_directory_uri() . '/assets/images/about-image.jpg')); ?>"
                            alt="Professional headshot"
                            class="w-full h-full object-cover"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-200 contact-section">
        <div class="container mx-auto max-w-5xl">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4">
                    Get in Touch
                </span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-light-100">
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_contact_title', 'Contact Me')); ?>
                </h2>
                <p class="text-xl text-light-100/70 max-w-2xl mx-auto">
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_contact_description', 'Let\'s discuss how we can elevate your online presence.')); ?>
                </p>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass-card p-6 rounded-xl">
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-300/20 p-3 rounded-lg">
                            <svg class="w-6 h-6 contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-1 text-light-100">Email</h3>
                            <p class="text-light-100/70"><?php echo esc_html(get_theme_mod('dark_theme_simplicity_contact_email', 'hello@braddaiber.com')); ?></p>
                        </div>
                    </div>
                </div>


                <div class="glass-card p-6 rounded-xl">
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-300/20 p-3 rounded-lg">
                            <svg class="w-6 h-6 contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-1 text-light-100">Phone</h3>
                            <p class="text-light-100/70"><?php echo esc_html(get_theme_mod('dark_theme_simplicity_contact_phone', '(555) 123-4567')); ?></p>
                        </div>
                    </div>
                </div>


                <div class="glass-card p-6 rounded-xl">
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-300/20 p-3 rounded-lg">
                            <svg class="w-6 h-6 contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-1 text-light-100">Location</h3>
                            <p class="text-light-100/70"><?php echo esc_html(get_theme_mod('dark_theme_simplicity_contact_location', 'New York, NY')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>