<!-- About Section -->
<section id="about" class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-300">
    <div class="container mx-auto">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4 border border-blue-300/20">
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