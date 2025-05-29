<!-- Contact Section -->
<section id="contact" class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-200 contact-section">
    <div class="container mx-auto max-w-5xl">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4 border border-blue-300/20">
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