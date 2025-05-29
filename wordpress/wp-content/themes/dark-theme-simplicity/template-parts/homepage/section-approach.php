<!-- Approach Section -->
<section id="approach" class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-200">
    <div class="container mx-auto max-w-6xl">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4 border border-blue-300/20">
                Approach
            </span>
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-light-100">
                <?php echo get_theme_mod('dark_theme_simplicity_approach_title', __('How I work with clients', 'dark-theme-simplicity')); ?>
            </h2>
            <p class="text-xl text-light-100/70 mb-6 max-w-2xl mx-auto">
                <?php echo get_theme_mod('dark_theme_simplicity_approach_description', __('I believe in a collaborative approach to content strategy. Your business is unique, and your content strategy should be too.', 'dark-theme-simplicity')); ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            // Get approach items from theme customizer
            $approach_items_json = get_theme_mod('dark_theme_simplicity_approach_items', '[]');
            $approach_items = json_decode($approach_items_json, true);
            
            // Use default items if no items are set
            if (empty($approach_items)) {
                $approach_items = array(
                    array(
                        'title' => __('1. Discovery', 'dark-theme-simplicity'),
                        'description' => __('I start by understanding your business, audience, and goals to create a tailored strategy.', 'dark-theme-simplicity'),
                    ),
                    array(
                        'title' => __('2. Strategy Development', 'dark-theme-simplicity'),
                        'description' => __('Based on research and your goals, I develop a content strategy aligned with your business objectives.', 'dark-theme-simplicity'),
                    ),
                    array(
                        'title' => __('3. Implementation', 'dark-theme-simplicity'),
                        'description' => __('I create content that engages your audience and drives the results you\'re looking for.', 'dark-theme-simplicity'),
                    ),
                    array(
                        'title' => __('4. Analysis & Optimization', 'dark-theme-simplicity'),
                        'description' => __('I continuously monitor performance and optimize your content strategy for better results.', 'dark-theme-simplicity'),
                    ),
                );
            }
            
            // Display approach items
            foreach ($approach_items as $item) {
            ?>
                <div class="bg-[#1e1e24] p-6 rounded-lg border border-zinc-700/30 hover:border-blue-500 hover:border-2 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20 group">
                    <h3 class="text-xl font-bold mb-3 text-white"><?php echo esc_html($item['title']); ?></h3>
                    <p class="text-xl text-light-100/70"><?php echo esc_html($item['description']); ?></p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section> 