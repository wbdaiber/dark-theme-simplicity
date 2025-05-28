<?php get_header(); ?>

<main id="content" class="site-main bg-dark-200">
    <!-- Hero Section -->
    <section class="py-16 md:py-24 bg-dark-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl">
                <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6 text-white reveal-text">
                    <?php 
                    if (is_home() && !is_front_page()) {
                        single_post_title();
                    } elseif (is_archive()) {
                        the_archive_title();
                    } elseif (is_search()) {
                        printf(esc_html__('Search Results for: %s', 'dark-theme-simplicity'), '<span>' . get_search_query() . '</span>');
                    } else {
                        esc_html_e('Insights & Resources', 'dark-theme-simplicity');
                    }
                    ?>
                </h1>
                <p class="text-xl md:text-2xl text-light-100/70 max-w-3xl reveal-text">
                    The latest tools, trends, and strategies to elevate your digital presence and maximize your business growth.
                </p>
                <?php if (is_archive() && get_the_archive_description()) : ?>
                    <div class="archive-description text-xl text-light-100/70 mt-4 reveal-text">
                        <?php the_archive_description(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php 
    // Featured Posts Section
    // Only display on main blog page, not on archives or search results
    if (is_home() && !is_paged()) : 
        // Get sticky posts or recent posts if no sticky posts
        $featured_posts = get_option('sticky_posts');
        
        // Show admin notice if no featured posts are set and user can edit posts
        if (empty($featured_posts) && current_user_can('edit_posts')) : 
    ?>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="bg-blue-300/20 border-l-4 border-blue-300 text-light-100 p-4 rounded admin-notice">
                <p>
                    <strong><?php _e('Admin Notice:', 'dark-theme-simplicity'); ?></strong> 
                    <?php _e('No posts are currently set as featured. The section below shows recent posts instead. To feature posts, go to the', 'dark-theme-simplicity'); ?>
                    <a href="<?php echo admin_url('edit.php'); ?>" class="text-blue-300 hover:underline"><?php _e('Posts screen', 'dark-theme-simplicity'); ?></a>
                    <?php _e('and click "Edit" on a post. Check the "Stick this post to the front page" option in the "Visibility" section under "Publish" settings.', 'dark-theme-simplicity'); ?>
                </p>
            </div>
        </div>
    <?php
        endif;
        
        // Feature query setup
        if (empty($featured_posts)) {
            // If no sticky posts, get the 3 most recent
            $featured_query = new WP_Query(array(
                'posts_per_page' => 3,
                'ignore_sticky_posts' => 1
            ));
        } else {
            // If sticky posts exist, get up to 3 of them
            $featured_query = new WP_Query(array(
                'posts_per_page' => 3,
                'post__in' => $featured_posts,
                'ignore_sticky_posts' => 1
            ));
            
            // If we don't have enough sticky posts, get additional recent posts
            if ($featured_query->post_count < 3) {
                $additional_count = 3 - $featured_query->post_count;
                $additional_query = new WP_Query(array(
                    'posts_per_page' => $additional_count,
                    'post__not_in' => $featured_posts,
                    'ignore_sticky_posts' => 1
                ));
                
                // Merge the queries
                $featured_query->posts = array_merge($featured_query->posts, $additional_query->posts);
                $featured_query->post_count = count($featured_query->posts);
            }
        }
        
        if ($featured_query->have_posts()) : 
    ?>
    <!-- Featured Articles Section -->
    <section class="py-16 bg-black">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-white">
                    <?php echo empty($featured_posts) ? esc_html__('Recent Articles', 'dark-theme-simplicity') : esc_html__('Featured Articles', 'dark-theme-simplicity'); ?>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php while ($featured_query->have_posts()) : $featured_query->the_post(); 
                    // Get the first category
                    $categories = get_the_category();
                    $category_name = !empty($categories) ? esc_html($categories[0]->name) : '';
                    
                    // Check if this post is sticky/featured
                    $is_sticky = is_array($featured_posts) && in_array(get_the_ID(), $featured_posts);
                ?>
                    <div class="overflow-hidden border border-white/10 backdrop-blur-lg bg-dark-100 rounded-xl transition-all duration-300 hover:bg-dark-100/80">
                        <?php if ($is_sticky && current_user_can('edit_posts')) : ?>
                            <div class="px-4 py-2 bg-blue-300 text-dark-300 text-xs font-medium flex items-center justify-center admin-notice">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                                <?php _e('Featured Article', 'dark-theme-simplicity'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="aspect-video relative bg-gradient-to-tr from-blue-400/20 to-purple-400/20">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'object-cover w-full h-full opacity-70']); ?>
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-tr from-blue-400/20 to-purple-400/20"></div>
                            <?php endif; ?>
                            
                            <?php if (!empty($category_name)) : ?>
                                <span class="absolute top-4 left-4 bg-blue-300/90 text-dark-300 px-2 py-1 rounded-full text-xs font-medium">
                                    <?php echo $category_name; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl md:text-2xl font-bold mb-3 line-clamp-2">
                                <a href="<?php the_permalink(); ?>" class="text-white hover:text-blue-300 transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <p class="text-light-100/70 line-clamp-3">
                                <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php 
        endif; 
        wp_reset_postdata(); 
    endif; 
    ?>

    <!-- All Articles Section -->
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-white">All Articles</h2>
            </div>

            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    <?php 
                    // Get sticky posts to avoid duplicating featured posts in the main listing
                    $sticky_ids = get_option('sticky_posts', array());
                    
                    while (have_posts()) : the_post(); 
                        // Skip this post if it's a sticky post and we're on the first page
                        if (is_home() && !is_paged() && is_array($sticky_ids) && in_array(get_the_ID(), $sticky_ids)) {
                            continue;
                        }
                        
                        // Get the first category
                        $categories = get_the_category();
                        $category_name = !empty($categories) ? esc_html($categories[0]->name) : '';
                    ?>
                        <div class="overflow-hidden border border-white/10 backdrop-blur-lg bg-dark-100/50 rounded-xl transition-all duration-300 hover:bg-dark-100">
                            <div class="aspect-video relative bg-gradient-to-tr from-blue-300/20 to-purple-300/20">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', ['class' => 'object-cover w-full h-full opacity-60']); ?>
                                <?php else: ?>
                                    <div class="w-full h-full bg-gradient-to-tr from-blue-300/20 to-purple-300/20"></div>
                                <?php endif; ?>
                            </div>
                            <div class="p-6">
                                <div class="flex gap-2 mb-3 items-center">
                                    <?php if (!empty($category_name)) : ?>
                                        <span class="bg-blue-300/10 text-blue-300 border border-blue-300/20 px-2 py-0.5 rounded-full text-xs font-medium">
                                            <?php echo $category_name; ?>
                                        </span>
                                    <?php endif; ?>
                                    <span class="text-xs text-light-100/50 mt-0.5">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                </div>
                                <h3 class="text-xl md:text-2xl font-bold mb-2 line-clamp-2">
                                    <a href="<?php the_permalink(); ?>" class="text-white hover:text-blue-300 transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <p class="text-light-100/70 line-clamp-3 mb-4">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="pagination flex justify-center items-center space-x-3 mt-12">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => '<span class="text-blue-300">&larr; Previous</span>',
                        'next_text' => '<span class="text-blue-300">Next &rarr;</span>',
                        'class' => 'pagination',
                        'before_page_number' => '<span class="px-3 py-2 bg-dark-300 text-blue-300 rounded-lg hover:bg-dark-400 transition-colors">',
                        'after_page_number' => '</span>',
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="bg-dark-300 p-8 rounded-xl border border-white/10">
                    <p class="text-center text-light-100/70 text-lg">No posts found.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<!-- Add animation JavaScript for reveal effects -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1 }
    );

    const elements = document.querySelectorAll('.reveal-text');
    elements.forEach((el) => observer.observe(el));
});
</script>

<!-- Add animation CSS for reveal effects -->
<style>
.reveal-text {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.8s ease, transform 0.8s ease;
}

.reveal-text.revealed {
    opacity: 1;
    transform: translateY(0);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Enhanced typography for better visual hierarchy */
h3.text-xl.md\:text-2xl {
    letter-spacing: -0.01em;
    line-height: 1.3;
    margin-bottom: 0.75rem;
}

.text-light-100\/70.line-clamp-3 {
    font-size: 0.95rem;
    line-height: 1.6;
    color: rgba(248, 250, 252, 0.7);
}

/* Enhance hover states */
.overflow-hidden:hover h3 a {
    color: #60a5fa;
}

/* Admin notice styling */
.admin-notice {
    display: block;
}

@media print {
    .admin-notice {
        display: none;
    }
}

/* Enhanced pagination styling */
.pagination .page-numbers {
    color: #60a5fa;
    font-weight: 500;
    transition: all 0.2s ease;
}

.pagination .page-numbers.current {
    background-color: #60a5fa;
    color: #1e1e24;
    border-radius: 0.5rem;
    padding: 0.5rem 1rem;
}

.pagination .page-numbers:hover:not(.current) {
    color: #93c5fd;
}

.pagination .dots {
    color: rgba(255, 255, 255, 0.5);
    margin: 0 0.5rem;
}
</style>

<?php get_footer(); ?> 