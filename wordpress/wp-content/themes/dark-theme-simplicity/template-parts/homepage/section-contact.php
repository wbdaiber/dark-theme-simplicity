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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <a href="mailto:<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_contact_email', 'hello@braddaiber.com')); ?>" class="glass-card p-6 rounded-xl hover:border-blue-500 hover:border-2 hover:bg-blue-500/10 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-300/20 p-3 rounded-lg">
                        <svg class="w-6 h-6 contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Email</h3>
                </div>
            </a>

            <a href="https://<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_contact_linkedin', 'linkedin.com/in/braddaiber')); ?>" target="_blank" rel="noopener noreferrer" class="glass-card p-6 rounded-xl hover:border-blue-500 hover:border-2 hover:bg-blue-500/10 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-300/20 p-3 rounded-lg">
                        <svg class="w-6 h-6 contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                            <rect x="2" y="9" width="4" height="12"></rect>
                            <circle cx="4" cy="4" r="2"></circle>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white">LinkedIn</h3>
                </div>
            </a>
        </div>
    </div>
</section> 