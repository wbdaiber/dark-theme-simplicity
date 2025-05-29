<!-- Benefits Section -->
<section id="benefits" class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-200 benefits-section">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4 border border-blue-300/20">
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