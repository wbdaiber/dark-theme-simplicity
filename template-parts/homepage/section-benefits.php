<!-- Benefits Section -->
<section id="benefits" class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-300 mt-16 relative">
    <div class="absolute top-0 left-0 w-full h-4 bg-gradient-to-r from-blue-500/0 via-blue-500/20 to-blue-500/0"></div>
    <div class="container mx-auto max-w-5xl">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4 border border-blue-300/20">
                <?php esc_html_e( 'Why Choose Us', 'dark-theme-simplicity' ); ?>
            </span>
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-light-100">
                <?php echo esc_html(get_theme_mod('dark_theme_simplicity_benefits_title', 'Key Benefits')); ?>
            </h2>
            <p class="text-xl text-light-100/70 max-w-2xl mx-auto">
                <?php echo esc_html(get_theme_mod('dark_theme_simplicity_benefits_description', 'We deliver real results through strategic digital solutions tailored to your business goals.')); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <?php
            $benefit_items = json_decode(get_theme_mod('dark_theme_simplicity_benefit_items', ''), true);
            
            if (!empty($benefit_items) && is_array($benefit_items)) {
                foreach ($benefit_items as $index => $item) :
                    $animation_delay = $index * 200; // 0, 200, 400, etc.
                    $delay_class = $index > 0 ? "animation-delay-{$animation_delay}" : "";
                ?>
                    <div class="glass-card p-6 rounded-xl border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:bg-blue-500/10 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 animate-fade-in <?php echo esc_attr($delay_class); ?>">
                        <h3 class="text-2xl font-bold mb-3 text-white"><?php echo esc_html($item['title']); ?></h3>
                        <p class="text-xl text-light-100/70"><?php echo esc_html($item['description']); ?></p>
                    </div>
                <?php
                endforeach;
            } else {
                // Default benefits if none are set
                $default_benefits = array(
                    array(
                        'title' => 'Data-Driven',
                        'description' => 'Our strategies are backed by thorough research and analytics for measurable outcomes.'
                    ),
                    array(
                        'title' => 'Customized Approach',
                        'description' => 'Solutions are tailored to your specific industry, audience, and business objectives.'
                    ),
                    array(
                        'title' => 'Transparent Process',
                        'description' => 'Clear communication and regular reporting keep you informed every step of the way.'
                    ),
                    array(
                        'title' => 'Continuous Optimization',
                        'description' => 'We consistently refine strategies based on performance data to maximize ROI.'
                    )
                );
                
                foreach ($default_benefits as $index => $item) :
                    $animation_delay = $index * 200; // 0, 200, 400, etc.
                    $delay_class = $index > 0 ? "animation-delay-{$animation_delay}" : "";
                ?>
                    <div class="glass-card p-6 rounded-xl border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:bg-blue-500/10 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 animate-fade-in <?php echo esc_attr($delay_class); ?>">
                        <h3 class="text-2xl font-bold mb-3 text-white"><?php echo esc_html($item['title']); ?></h3>
                        <p class="text-xl text-light-100/70"><?php echo esc_html($item['description']); ?></p>
                    </div>
                <?php
                endforeach;
            }
            ?>
        </div>
    </div>
</section> 