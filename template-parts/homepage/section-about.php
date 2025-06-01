<!-- About Section -->
<section id="about" class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-300 mt-16 relative">
    <div class="absolute top-0 left-0 w-full h-4 bg-gradient-to-r from-blue-500/0 via-blue-500/20 to-blue-500/0"></div>
    <div class="container mx-auto max-w-5xl">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4 border border-blue-300/20">
                <?php esc_html_e( 'About Me', 'dark-theme-simplicity' ); ?>
            </span>
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-light-100">
                <?php echo esc_html(get_theme_mod('dark_theme_simplicity_about_title', 'Digital Marketing Specialist')); ?>
            </h2>
            <p class="text-xl text-light-100/70 max-w-2xl mx-auto">
                <?php echo esc_html(get_theme_mod('dark_theme_simplicity_about_subtitle', 'With over a decade of experience helping businesses thrive online.')); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="order-2 md:order-1 animate-fade-in">
                <p class="text-light-100/80 mb-6">
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_about_content_1', 'I\'m Brad Daiber, a seasoned digital marketing consultant with a passion for helping businesses establish a powerful online presence. With a background in SEO, content creation, and web design, I provide comprehensive solutions tailored to your specific needs.')); ?>
                </p>
                <p class="text-light-100/80">
                    <?php echo esc_html(get_theme_mod('dark_theme_simplicity_about_content_2', 'My approach combines data-driven strategies with creative thinking to deliver measurable results. Whether you\'re looking to increase website traffic, improve conversion rates, or establish your brand voice, I\'m here to help you achieve your goals.')); ?>
                </p>
            </div>
            <div class="order-1 md:order-2 flex justify-center animate-fade-in animation-delay-300">
                <div class="glass-card p-6 rounded-xl border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:bg-blue-500/10 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20">
                    <img src="<?php echo esc_url(get_theme_mod('dark_theme_simplicity_about_image', get_template_directory_uri() . '/assets/images/about-image.svg')); ?>" alt="<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_about_title', 'Digital Marketing Specialist')); ?>" class="max-w-full h-auto rounded-lg">
                </div>
            </div>
        </div>
    </div>
</section> 