<?php get_header(); ?>

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Main content column -->
        <div class="flex-1">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('page-content bg-dark-300 p-6 rounded-lg border border-white/10'); ?>>
                    <header class="entry-header mb-8">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="page-thumbnail mb-6">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg']); ?>
                            </div>
                        <?php endif; ?>

                        <h1 class="entry-title text-3xl md:text-4xl font-bold mb-4 text-white">
                            <?php the_title(); ?>
                        </h1>
                    </header>

                    <div class="entry-content prose prose-invert max-w-none text-light-100/80">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                </article>
            <?php endwhile; ?>
        </div>
        
        <!-- Sidebar column -->
        <div class="md:w-64 lg:w-80 flex-shrink-0">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 