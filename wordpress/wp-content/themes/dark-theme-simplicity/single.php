<?php get_header(); ?>

<main id="content" class="site-main pt-0 pb-16">
    <div class="container mx-auto px-4" style="margin-top: 2rem;">
    <?php while (have_posts()) : the_post(); ?>
            <!-- Title/Hero Section Card -->
            <div class="max-w-6xl mx-auto mb-8" style="overflow: visible;">
                <div class="page-header bg-dark-300 rounded-xl shadow-xl relative" style="overflow: visible;">
                    <!-- Mobile Background Image ONLY -->
                <?php if (has_post_thumbnail()) : ?>
                        <div class="absolute inset-0 md:hidden z-0">
                            <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                            <div class="absolute inset-0 bg-black opacity-75"></div>
                    </div>
                <?php endif; ?>

                    <!-- Content Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 min-h-[400px] relative z-10">
                        <!-- Content Column - Takes up 2/3 on desktop -->
                        <div class="md:col-span-2 p-8 md:p-12 flex flex-col justify-center relative z-20" style="overflow: visible;">
                            <div class="relative z-10 bg-black/60 md:bg-transparent p-4 md:p-0 rounded-lg md:rounded-none" style="overflow: visible;">
                                <!-- Breadcrumbs -->
                                <nav class="flex items-center gap-2 text-sm mb-6 text-light-100/70">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-blue-400 transition-colors">Home</a>
                                    <span class="text-light-100/50">›</span>
                                    <?php
                                    // Get the page ID that's set as the "Posts page" in Settings > Reading
                                    $posts_page_id = get_option('page_for_posts');
                                    
                                    if ($posts_page_id) {
                                        // If a static page is set as the posts page
                                        $posts_page_title = get_the_title($posts_page_id);
                                        $posts_page_url = get_permalink($posts_page_id);
                                        ?>
                                        <a href="<?php echo esc_url($posts_page_url); ?>" class="hover:text-blue-400 transition-colors"><?php echo esc_html($posts_page_title); ?></a>
                                        <?php
                                    } else {
                                        // If no static page is set (default behavior)
                                        ?>
                                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-blue-400 transition-colors">Blog</a>
                                        <?php
                                    }
                                    ?>
                                </nav>
                                
                                <!-- Category Badge -->
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $first_category = $categories[0];
                                    echo '<a href="' . esc_url(get_category_link($first_category->term_id)) . '" class="inline-flex items-center rounded-full border px-3 py-1 text-sm font-semibold mb-6 bg-blue-300/10 text-blue-300 hover:bg-blue-300/20 border-blue-300/20">' . esc_html($first_category->name) . '</a>';
                                }
                                ?>
                                
                                <!-- Title -->
                                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 text-white leading-tight drop-shadow-lg">
                    <?php the_title(); ?>
                </h1>

                                <!-- Excerpt -->
                                <?php if (has_excerpt() || get_the_content()) : ?>
                                    <div class="text-lg text-light-100/90 mb-6 leading-relaxed drop-shadow-md">
                        <?php
                                        if (has_excerpt()) {
                                            the_excerpt();
                                        } else {
                                            echo wp_trim_words(get_the_content(), 25, '...');
                                        }
                                        ?>
                                    </div>
                    <?php endif; ?>

                                <!-- Meta Information -->
                                <div class="flex flex-wrap items-center gap-4 text-sm text-light-100/80 drop-shadow-md">
                                    <time datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>" class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-300">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <span>Last Updated: <?php echo esc_html(get_the_modified_date()); ?></span>
                                    </time>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Featured Image Column - Takes up 1/3 on desktop, hidden on mobile -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="hidden md:flex md:col-span-1 p-4 items-center justify-center">
                                <div class="w-full h-full flex items-center justify-center max-h-96">
                                    <div class="aspect-video relative bg-gradient-to-tr from-blue-300/20 to-purple-300/20">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover opacity-60']); ?>
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-tr from-blue-300/20 to-purple-300/20"></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Content Section Card -->
            <article <?php post_class('max-w-6xl mx-auto bg-dark-300 rounded-xl shadow-xl overflow-hidden'); ?>>
                <div class="p-8 md:p-12">
                <?php
                    // Extract headings for table of contents - improved version
                    $content = get_the_content();
                    $pattern = '/<h2.*?>(.*?)<\/h2>/i';
                    $h2_found = preg_match_all($pattern, $content, $headings);
                    
                    // Only process TOC if we have H2 headings
                    $has_toc = $h2_found && count($headings[1]) > 0;
                    $toc_content = '';
                    
                    if ($has_toc) {
                        // Build TOC HTML with consistent styling
                        $toc_content .= '<div class="table-of-contents p-6 bg-dark-400 rounded-lg border border-white/10 mt-4">';
                        $toc_content .= '<h2 class="text-xl font-bold mb-4 text-white">Table of Contents</h2>';
                        $toc_content .= '<ul class="space-y-2 toc-list">';
                        
                        foreach ($headings[1] as $index => $heading) {
                            // Strip any HTML tags
                            $clean_heading = strip_tags($heading);
                            // Use the same sanitize_title function as in the functions.php
                            $heading_id = sanitize_title($clean_heading);
                            
                            $toc_content .= '<li class="toc-item text-light-100/80 hover:text-blue-300">';
                            $toc_content .= '<a href="#' . $heading_id . '" class="toc-link flex items-center gap-2 transition-colors">';
                            $toc_content .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300 toc-caret"><polyline points="9 18 15 12 9 6"></polyline></svg>';
                            $toc_content .= '<span class="toc-text">' . $clean_heading . '</span>';
                            $toc_content .= '</a></li>';
                        }
                        
                        $toc_content .= '</ul>';
                        $toc_content .= '</div>';
                    }
                    ?>

                    <!-- Mobile TOC (shows only on mobile) -->
                    <?php if ($has_toc) : ?>
                    <div class="md:hidden mb-6">
                        <!-- Mobile Sharing Buttons -->
                        <div class="flex justify-between items-center p-3 bg-dark-400 rounded-lg border border-white/10 mb-3">
                            <div class="font-medium text-white text-sm">Share this article</div>
                            <div class="flex gap-2">
                                <div class="relative" id="share-container-mobile">
                                    <button class="flex items-center justify-center w-10 h-10 bg-dark-300/80 hover:bg-dark-300 rounded-full transition-colors" id="share-btn-mobile">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300">
                                            <circle cx="18" cy="5" r="3"></circle>
                                            <circle cx="6" cy="12" r="3"></circle>
                                            <circle cx="18" cy="19" r="3"></circle>
                                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                        </svg>
                                    </button>
                                    <!-- Mobile Share Dropdown -->
                                    <div class="hidden absolute top-full mt-2 right-0 bg-dark-400 border border-white/10 rounded-lg shadow-2xl py-2 min-w-[220px] z-[9999] max-h-[400px] overflow-y-auto" id="share-dropdown-mobile">
                                        <div class="flex flex-col">
                                            <!-- Facebook Share -->
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                               target="_blank" 
                                               rel="noopener noreferrer"
                                               class="flex items-center gap-3 px-4 py-3 hover:bg-dark-300/80 text-white text-sm transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-[#1877F2] flex-shrink-0">
                                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                </svg>
                                                <span>Facebook</span>
                                            </a>
                                            
                                            <!-- X (Twitter) Share -->
                                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                               target="_blank" 
                                               rel="noopener noreferrer"
                                               class="flex items-center gap-3 px-4 py-3 hover:bg-dark-300/80 text-white text-sm transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-white flex-shrink-0">
                                                    <path d="M18.244 2.25h3.308l-7.227 8.259 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                                </svg>
                                                <span>X</span>
                                            </a>
                                            
                                            <!-- LinkedIn Share -->
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                               target="_blank" 
                                               rel="noopener noreferrer"
                                               class="flex items-center gap-3 px-4 py-3 hover:bg-dark-300/80 text-white text-sm transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-[#0A66C2] flex-shrink-0">
                                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                </svg>
                                                <span>LinkedIn</span>
                                            </a>
                                            
                                            <!-- Reddit Share -->
                                            <a href="https://www.reddit.com/submit?url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                               target="_blank" 
                                               rel="noopener noreferrer"
                                               class="flex items-center gap-3 px-4 py-3 hover:bg-dark-300/80 text-white text-sm transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-[#FF4500] flex-shrink-0">
                                                    <path d="M12 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0zm5.01 4.744c.688 0 1.25.561 1.25 1.249a1.25 1.25 0 0 1-2.498.056l-2.597-.547-.8 3.747c1.824.07 3.48.632 4.674 1.488.308-.309.73-.491 1.207-.491.968 0 1.754.786 1.754 1.754 0 .716-.435 1.333-1.01 1.614a3.111 3.111 0 0 1 .042.52c0 2.694-3.13 4.87-7.004 4.87-3.874 0-7.004-2.176-7.004-4.87 0-.183.015-.366.043-.534A1.748 1.748 0 0 1 4.028 12c0-.968.786-1.754 1.754-1.754.463 0 .898.196 1.207.49 1.207-.883 2.878-1.43 4.744-1.487l.885-4.182a.342.342 0 0 1 .14-.197.35.35 0 0 1 .238-.042l2.906.617a1.214 1.214 0 0 1 1.108-.701zM9.25 12C8.561 12 8 12.562 8 13.25c0 .687.561 1.248 1.25 1.248.687 0 1.248-.561 1.248-1.249 0-.688-.561-1.249-1.249-1.249zm5.5 0c-.687 0-1.248.561-1.248 1.25 0 .687.561 1.248 1.249 1.248.688 0 1.249-.561 1.249-1.249 0-.687-.562-1.249-1.25-1.249zm-5.466 3.99a.327.327 0 0 0-.231.094.33.33 0 0 0 0 .463c.842.842 2.484.913 2.961.913.477 0 2.105-.056 2.961-.913a.361.361 0 0 0 .029-.463.33.33 0 0 0-.464 0c-.547.533-1.684.73-2.512.73-.828 0-1.979-.196-2.526-.73a.326.326 0 0 0-.218-.094z"/>
                                                </svg>
                                                <span>Reddit</span>
                                            </a>
                                            
                                            <!-- Copy Link Option -->
                                            <button onclick="copyToClipboard('<?php echo esc_js(get_permalink()); ?>')" 
                                                    class="flex items-center gap-3 px-4 py-3 hover:bg-dark-300/80 text-white text-sm transition-colors w-full text-left">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-300 flex-shrink-0">
                                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                                </svg>
                                                <span>Copy Link</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Compact mobile TOC -->
                        <div class="table-of-contents p-4 bg-dark-400 rounded-lg border border-white/10">
                            <h2 class="text-lg font-medium mb-3 text-white">Contents</h2>
                            <ul class="space-y-1 toc-list">
                            <?php 
                            foreach ($headings[1] as $index => $heading) {
                                // Strip any HTML tags
                                $clean_heading = strip_tags($heading);
                                // Use the same sanitize_title function as in the functions.php
                                $heading_id = sanitize_title($clean_heading);
                                
                                echo '<li class="toc-item text-light-100/80 hover:text-blue-300 text-sm">';
                                echo '<a href="#' . $heading_id . '" class="toc-link flex items-center gap-1 transition-colors">';
                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300 toc-caret"><polyline points="9 18 15 12 9 6"></polyline></svg>';
                                echo '<span class="toc-text">' . $clean_heading . '</span>';
                                echo '</a></li>';
                            }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Two-column layout for content and TOC on desktop -->
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Main content column - Further increase width -->
                        <div class="flex-1 md:w-4/5 lg:w-5/6">
                            <div class="entry-content prose prose-invert prose-lg max-w-none text-light-100/80 prose-p:leading-relaxed prose-headings:mt-8 prose-headings:mb-4">
                                <?php the_content(); ?>
                            </div>

                            <footer class="entry-footer mt-12 pt-8 border-t border-white/10">
                                <!-- Post navigation removed as requested -->
                            </footer>
                        </div>
                        
                        <!-- Desktop TOC, Sharing, and Widgets - Further decrease width -->
                        <div class="hidden md:block md:w-1/5 lg:w-1/6 flex-shrink-0">
                            <div class="sticky top-24 space-y-4">
                                <!-- Desktop Sharing Buttons - Make even more compact -->
                                <div class="p-3 bg-dark-400 rounded-lg border border-white/10">
                                    <h2 class="text-base font-medium mb-2 text-white">Share Article</h2>
                                    <div class="flex flex-col gap-2">
                                        <!-- Share Dropdown -->
                                        <div class="relative w-full" id="share-container">
                                            <button class="flex items-center gap-2 bg-dark-300/80 hover:bg-dark-300 border border-white/5 rounded-lg px-4 py-2 text-sm text-white transition-all w-full" id="share-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300">
                                                    <circle cx="18" cy="5" r="3"></circle>
                                                    <circle cx="6" cy="12" r="3"></circle>
                                                    <circle cx="18" cy="19" r="3"></circle>
                                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                                </svg>
                                                <span>Share</span>
                                            </button>
                                            
                                            <!-- Desktop Share Dropdown -->
                                            <div class="hidden absolute top-full mt-2 right-0 bg-dark-400 border border-white/10 rounded-lg shadow-2xl py-2 min-w-[220px] z-[9999] max-h-[400px] overflow-y-auto" id="share-dropdown">
                                                <div class="flex flex-col">
                                                    <!-- Facebook Share -->
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer"
                                                       class="flex items-center gap-3 px-4 py-3 hover:bg-dark-300/80 text-white text-sm transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-[#1877F2] flex-shrink-0">
                                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                        </svg>
                                                        <span>Facebook</span>
                                                    </a>
                                                    
                                                    <!-- X (Twitter) Share -->
                                                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer"
                                                       class="flex items-center gap-3 px-4 py-3 hover:bg-dark-300/80 text-white text-sm transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-white flex-shrink-0">
                                                            <path d="M18.244 2.25h3.308l-7.227 8.259 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                                        </svg>
                                                        <span>X</span>
                                                    </a>
                                                    
                                                    <!-- LinkedIn Share -->
                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer"
                                                       class="flex items-center gap-3 px-4 py-3 hover:bg-dark-300/80 text-white text-sm transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-[#0A66C2] flex-shrink-0">
                                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                        </svg>
                                                        <span>LinkedIn</span>
                                                    </a>
                                                    
                                                    <!-- Reddit Share -->
                                                    <a href="https://www.reddit.com/submit?url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer"
                                                       class="flex items-center gap-3 px-4 py-3 hover:bg-dark-300/80 text-white text-sm transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-[#FF4500] flex-shrink-0">
                                                            <path d="M12 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0zm5.01 4.744c.688 0 1.25.561 1.25 1.249a1.25 1.25 0 0 1-2.498.056l-2.597-.547-.8 3.747c1.824.07 3.48.632 4.674 1.488.308-.309.73-.491 1.207-.491.968 0 1.754.786 1.754 1.754 0 .716-.435 1.333-1.01 1.614a3.111 3.111 0 0 1 .042.52c0 2.694-3.13 4.87-7.004 4.87-3.874 0-7.004-2.176-7.004-4.87 0-.183.015-.366.043-.534A1.748 1.748 0 0 1 4.028 12c0-.968.786-1.754 1.754-1.754.463 0 .898.196 1.207.49 1.207-.883 2.878-1.43 4.744-1.487l.885-4.182a.342.342 0 0 1 .14-.197.35.35 0 0 1 .238-.042l2.906.617a1.214 1.214 0 0 1 1.108-.701zM9.25 12C8.561 12 8 12.562 8 13.25c0 .687.561 1.248 1.25 1.248.687 0 1.248-.561 1.248-1.249 0-.688-.561-1.249-1.249-1.249zm5.5 0c-.687 0-1.248.561-1.248 1.25 0 .687.561 1.248 1.249 1.248.688 0 1.249-.561 1.249-1.249 0-.687-.562-1.249-1.25-1.249zm-5.466 3.99a.327.327 0 0 0-.231.094.33.33 0 0 0 0 .463c.842.842 2.484.913 2.961.913.477 0 2.105-.056 2.961-.913a.361.361 0 0 0 .029-.463.33.33 0 0 0-.464 0c-.547.533-1.684.73-2.512.73-.828 0-1.979-.196-2.526-.73a.326.326 0 0 0-.218-.094z"/>
                                                        </svg>
                                                        <span>Reddit</span>
                                                    </a>
                                                    
                                                    <!-- Copy Link Option -->
                                                    <button onclick="copyToClipboard('<?php echo esc_js(get_permalink()); ?>')" 
                                                            class="flex items-center gap-3 px-4 py-3 hover:bg-dark-300/80 text-white text-sm transition-colors w-full text-left">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-300 flex-shrink-0">
                                                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                                        </svg>
                                                        <span>Copy Link</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Table of Contents - Make even more compact -->
                                <?php if ($has_toc) : ?>
                                    <?php 
                                    // Instead of string replacement, which might be unreliable,
                                    // Let's manually create the desktop TOC with our consistent styling
                                    ?>
                                    <div class="table-of-contents p-3 bg-dark-400 rounded-lg border border-white/10">
                                        <h2 class="text-base font-medium mb-2 text-light-100">Table of Contents</h2>
                                        <ul class="space-y-1 toc-list">
                                            <?php
                                            foreach ($headings[1] as $index => $heading) {
                                                // Strip any HTML tags
                                                $clean_heading = strip_tags($heading);
                                                // Use the same sanitize_title function as in the functions.php
                                                $heading_id = sanitize_title($clean_heading);
                                                
                                                echo '<li class="toc-item text-light-100/80 hover:text-blue-300">';
                                                echo '<a href="#' . $heading_id . '" class="toc-link flex items-center gap-1 transition-colors">';
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300 toc-caret"><polyline points="9 18 15 12 9 6"></polyline></svg>';
                                                echo '<span class="toc-text">' . $clean_heading . '</span>';
                                                echo '</a></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- Sidebar Widgets - Make more compact -->
                                <?php if (is_active_sidebar('sidebar-post') || is_active_sidebar('sidebar-1')) : ?>
                                    <div class="mt-4 text-sm">
                                        <?php get_sidebar(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related Posts Section -->
            <section class="bg-dark-300 py-16 mt-16 rounded-xl shadow-xl">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-2xl md:text-3xl font-medium mb-8 text-center text-white">Related Articles</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                        <?php
                        $current_post_id = get_the_ID();
                        
                        // First check if manually selected related posts exist
                        $manual_related_posts = get_post_meta($current_post_id, '_related_posts', true);
                        $has_manual_related = false;
                        
                        if (!empty($manual_related_posts) && is_array($manual_related_posts)) {
                            // Set up arguments for manually selected related posts
                            $manual_args = array(
                                'post__in'       => $manual_related_posts,
                                'posts_per_page' => 3,
                                'post_status'    => 'publish',
                                'orderby'        => 'post__in', // Preserve the order selected
                            );
                            
                            $related_posts_query = new WP_Query($manual_args);
                            
                            // If we have manually selected related posts, set flag to true
                            if ($related_posts_query->have_posts()) {
                                $has_manual_related = true;
                            }
                        }
                        
                        // If no manual related posts, use category-based selection (existing code)
                        if (!$has_manual_related) {
                            // Get the categories of the current post
                            $categories = wp_get_post_categories($current_post_id);
                            
                            // Set up arguments for the related posts query
                            $args = array(
                                'category__in'     => $categories,
                                'post__not_in'     => array($current_post_id),
                                'posts_per_page'   => 3,
                                'orderby'          => 'rand',
                                'post_status'      => 'publish'
                            );
                            
                            $related_posts_query = new WP_Query($args);
                            
                            // If we don't have enough related posts by category, add recent posts as a fallback
                            if ($related_posts_query->post_count < 3) {
                                // Store the posts we already have
                                $existing_posts = wp_list_pluck($related_posts_query->posts, 'ID');
                                $posts_to_exclude = array_merge(array($current_post_id), $existing_posts);
                                
                                // How many more posts do we need?
                                $posts_needed = 3 - $related_posts_query->post_count;
                                
                                // Get recent posts excluding the current post and already displayed related posts
                                $recent_args = array(
                                    'post__not_in'     => $posts_to_exclude,
                                    'posts_per_page'   => $posts_needed,
                                    'orderby'          => 'date',
                                    'order'            => 'DESC',
                                    'post_status'      => 'publish'
                                );
                                
                                $recent_query = new WP_Query($recent_args);
                                
                                // Merge the results
                                if ($recent_query->have_posts()) {
                                    $related_posts_query->posts = array_merge($related_posts_query->posts, $recent_query->posts);
                                    $related_posts_query->post_count = count($related_posts_query->posts);
                                }
                            }
                        }
                        
                        if ($related_posts_query->have_posts()) :
                            while ($related_posts_query->have_posts()) : $related_posts_query->the_post();
                                // Get the first category
                                $post_categories = get_the_category();
                                $first_category = !empty($post_categories) ? $post_categories[0] : null;
                        ?>
                            <a href="<?php the_permalink(); ?>" class="block h-full">
                                <div class="overflow-hidden border border-white/10 backdrop-blur-lg bg-dark-100/50 rounded-xl transition-all duration-300 hover:bg-dark-100 h-full flex flex-col">
                                    <div class="aspect-video relative bg-gradient-to-tr from-blue-300/20 to-purple-300/20">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover opacity-60']); ?>
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-tr from-blue-300/20 to-purple-300/20"></div>
                                        <?php endif; ?>
                                        <?php if ($first_category) : ?>
                                            <span class="absolute top-4 left-4 bg-blue-300/90 text-dark-300 px-2 py-1 rounded-full text-xs font-medium z-10">
                                                <?php echo esc_html($first_category->name); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="p-5 flex flex-col flex-grow">
                                        <div class="flex gap-2 mb-3 items-center">
                                            <span class="text-xs text-light-100/50 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Last Updated: <?php echo get_the_modified_date(); ?>
                                            </span>
                                        </div>
                                        <h3 class="text-xl md:text-2xl font-bold mb-2 line-clamp-2 text-white hover:text-blue-300 transition-colors pl-0">
                                            <?php the_title(); ?>
                                        </h3>
                                        <p class="text-light-100/70 line-clamp-3 mb-4 text-sm">
                                            <?php 
                                            if (has_excerpt()) {
                                                echo get_the_excerpt();
                                            } else {
                                                echo wp_trim_words(get_the_content(), 20, '...');
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        <?php
                            endwhile;
                        else :
                            echo '<div class="col-span-3 text-center text-light-100/70">No related posts found.</div>';
                        endif;
                        
                        // Reset post data to restore the main query & post
                        wp_reset_postdata();
                ?>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section class="py-16 px-4 sm:px-6 lg:px-8 bg-dark-200 contact-section mt-16 relative rounded-xl shadow-xl">
                <div class="absolute top-0 left-0 w-full h-4 bg-gradient-to-r from-blue-500/0 via-blue-500/20 to-blue-500/0"></div>
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
    <?php endwhile; ?>
</div>
</main>

<style>
/* Additional CSS to ensure proper spacing */
@media (max-width: 768px) {
    .site-main .container {
        margin-top: 2rem !important;
    }
    
    /* Ensure mobile content is optimized */
    .entry-content {
        font-size: 1rem !important;
    }
    
    /* Make mobile TOC more compact */
    .table-of-contents {
        padding: 0.75rem !important;
    }
    
    .table-of-contents h2 {
        font-size: 1rem !important;
        margin-bottom: 0.5rem !important;
    }
    
    .table-of-contents ul {
        margin: 0 !important;
        padding-left: 0.5rem !important;
    }
    
    .table-of-contents li {
        margin-bottom: 0.25rem !important;
        font-size: 0.875rem !important;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .site-main .container {
        margin-top: 2rem !important;
    }
    
    /* Ensure tablet content is optimized */
    .entry-content {
        font-size: 1.05rem !important;
    }
}

@media (min-width: 1025px) {
    .site-main .container {
        margin-top: 2rem !important;
    }
    
    /* Ensure desktop content has proper width */
    .flex-1.md\:w-4\/5.lg\:w-5\/6 {
        width: 82% !important;
    }
    
    .md\:w-1\/5.lg\:w-1\/6 {
        width: 18% !important;
    }
}

/* Line clamp utilities */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Make TOC text smaller and with proper spacing */
.table-of-contents li a {
    font-size: 0.9rem;
    line-height: 1.3;
    padding: 0.25rem 0;
}

/* Make content wider by limiting right sidebar width */
.md\:w-1\/5.lg\:w-1\/6 {
    max-width: 220px;
}

/* Enhanced hover states for sidebar elements */
.table-of-contents a:hover {
    color: #60a5fa !important;
    text-decoration: none !important;
}

/* Enhanced related articles styling */
.related-article-title {
    font-size: 1.25rem;
    line-height: 1.75rem;
}

@media (min-width: 768px) {
    .related-article-title {
        font-size: 1.5rem;
        line-height: 2rem;
    }
}

/* Related posts typography enhancements */
.bg-dark-300 .text-xl.md\:text-2xl {
    letter-spacing: -0.01em;
    line-height: 1.3;
}

.bg-dark-300 .text-light-100\/70.line-clamp-3 {
    font-size: 0.95rem;
    line-height: 1.6;
    color: rgba(248, 250, 252, 0.7);
}

/* Enhanced hover states for related posts */
.bg-dark-300 .overflow-hidden:hover h3 {
    color: #60a5fa;
}

/* Related article thumbnail hover effects */
.aspect-video {
    position: relative;
    overflow: hidden;
}

.aspect-video img {
    transition: transform 0.3s ease, opacity 0.3s ease;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.overflow-hidden:hover .aspect-video img {
    transform: scale(1.05);
    opacity: 0.9;
}

/* Gradient background hover effect for posts without thumbnails */
.aspect-video div {
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.overflow-hidden:hover .aspect-video div {
    transform: scale(1.05);
    opacity: 0.9;
    background-image: linear-gradient(to top right, rgba(96, 165, 250, 0.3), rgba(192, 132, 252, 0.3));
}

/* Glass card styling for contact section */
.glass-card {
    background-color: rgba(30, 30, 36, 0.4);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.contact-icon {
    color: #60a5fa;
}

/* Enhanced share dropdown styling - Always opens downward */
#share-dropdown,
#share-dropdown-mobile {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(255, 255, 255, 0.1);
    position: absolute !important;
    top: 100% !important;
    right: 0 !important;
    left: auto !important;
    transform: none !important;
    margin-top: 8px !important;
    z-index: 99999 !important;
    min-width: 220px !important;
    max-width: 300px !important;
    width: max-content !important;
    background: rgba(31, 41, 55, 0.95) !important;
    backdrop-filter: blur(10px) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
}

#share-dropdown a,
#share-dropdown button,
#share-dropdown-mobile a,
#share-dropdown-mobile button {
    white-space: nowrap;
    width: 100%;
    display: flex !important;
    align-items: center !important;
    background: transparent !important;
}

#share-dropdown a:hover,
#share-dropdown button:hover,
#share-dropdown-mobile a:hover,
#share-dropdown-mobile button:hover {
    background: rgba(55, 65, 81, 0.8) !important;
}

#share-dropdown svg,
#share-dropdown-mobile svg {
    flex-shrink: 0;
}

/* Ensure dropdown appears above other elements */
.relative {
    position: relative;
}

#share-container,
#share-container-mobile {
    z-index: 50;
    position: relative !important;
}

/* Override any conflicting styles */
#share-container .absolute,
#share-container-mobile .absolute {
    position: absolute !important;
}

/* Ensure proper spacing and visibility */
.site-main {
    overflow: visible !important;
}

.page-header {
    overflow: visible !important;
}

/* Ensure parent containers don't clip dropdowns */
.sticky {
    overflow: visible !important;
}

.relative {
    overflow: visible !important;
}

/* Specifically ensure the article and content containers don't clip */
article,
.bg-dark-300,
.rounded-xl,
.shadow-xl {
    overflow: visible !important;
}

/* Force visibility for all potential clipping containers */
.container,
.max-w-6xl,
.mx-auto {
    overflow: visible !important;
}

/* Ensure flex containers don't clip */
.flex,
.flex-col,
.md\\:flex-row {
    overflow: visible !important;
}

/* Media query for mobile adjustments */
@media (max-width: 768px) {
    #share-dropdown,
    #share-dropdown-mobile {
        right: 0 !important;
        left: auto !important;
        min-width: 200px !important;
    }
    
    /* On mobile, always show above to avoid content overlap */
    #share-dropdown-mobile {
        top: auto !important;
        bottom: 100% !important;
        margin-top: 0 !important;
        margin-bottom: 8px !important;
    }
}

/* Consistently style Table of Contents */
.toc-list {
    list-style: none !important;
    padding-left: 0 !important;
    margin-left: 0 !important;
}

.toc-item {
    margin-bottom: 0.25rem !important;
}

.toc-link {
    display: flex !important;
    align-items: center !important;
    text-decoration: none !important;
}

.toc-caret {
    color: #60a5fa !important;
    flex-shrink: 0 !important;
    margin-right: 0.5rem !important;
    display: inline-block !important;
}

.toc-text {
    font-size: 0.9rem;
    line-height: 1.3;
}

/* Make content wider by limiting right sidebar width */
.md\:w-1\/5.lg\:w-1\/6 {
    max-width: 220px;
}

/* Enhanced hover states for TOC items */
.toc-link:hover {
    color: #60a5fa !important;
    text-decoration: none !important;
}

.toc-link:hover .toc-caret {
    transform: translateX(2px);
    transition: transform 0.2s ease;
}
</style>

<?php get_footer(); ?> 

<script>
// Enhanced share button functionality with copy to clipboard
document.addEventListener('DOMContentLoaded', function() {
    const shareBtn = document.getElementById('share-btn');
    const shareDropdown = document.getElementById('share-dropdown');
    const shareBtnMobile = document.getElementById('share-btn-mobile');
    const shareDropdownMobile = document.getElementById('share-dropdown-mobile');
    
    // Helper function to handle share dropdown
    function handleShareDropdown(btn, dropdown) {
        if (!btn || !dropdown) return;
        
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            if (dropdown.classList.contains('hidden')) {
                // Always show dropdown below the button
                dropdown.classList.remove('hidden');
                dropdown.classList.remove('dropdown-up'); // Always remove the up class
            } else {
                // Hide dropdown
                dropdown.classList.add('hidden');
                dropdown.classList.remove('dropdown-up');
            }
        });
        
        // Close dropdown after clicking a share link
        const shareLinks = dropdown.querySelectorAll('a[target="_blank"]');
        shareLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                setTimeout(function() {
                    dropdown.classList.add('hidden');
                    dropdown.classList.remove('dropdown-up');
                }, 100);
            });
        });
    }
    
    // Desktop Share button
    handleShareDropdown(shareBtn, shareDropdown);
    
    // Mobile share button
    handleShareDropdown(shareBtnMobile, shareDropdownMobile);
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (shareBtn && shareDropdown && !shareBtn.contains(e.target) && !shareDropdown.contains(e.target)) {
            shareDropdown.classList.add('hidden');
            shareDropdown.classList.remove('dropdown-up');
        }
        if (shareBtnMobile && shareDropdownMobile && !shareBtnMobile.contains(e.target) && !shareDropdownMobile.contains(e.target)) {
            shareDropdownMobile.classList.add('hidden');
            shareDropdownMobile.classList.remove('dropdown-up');
        }
    });
    
    // Close dropdown when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (shareDropdown) {
                shareDropdown.classList.add('hidden');
                shareDropdown.classList.remove('dropdown-up');
            }
            if (shareDropdownMobile) {
                shareDropdownMobile.classList.add('hidden');
                shareDropdownMobile.classList.remove('dropdown-up');
            }
        }
    });
});

// Copy to clipboard function
function copyToClipboard(url) {
    if (navigator.clipboard && window.isSecureContext) {
        // Use modern clipboard API
        navigator.clipboard.writeText(url).then(function() {
            showCopyFeedback('Link copied to clipboard!');
        }).catch(function(err) {
            console.error('Failed to copy: ', err);
            fallbackCopyTextToClipboard(url);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyTextToClipboard(url);
    }
    
    // Close the dropdowns
    const shareDropdown = document.getElementById('share-dropdown');
    const shareDropdownMobile = document.getElementById('share-dropdown-mobile');
    if (shareDropdown) {
        shareDropdown.classList.add('hidden');
        shareDropdown.classList.remove('dropdown-up');
    }
    if (shareDropdownMobile) {
        shareDropdownMobile.classList.add('hidden');
        shareDropdownMobile.classList.remove('dropdown-up');
    }
}

// Fallback copy function for older browsers
function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";
    textArea.style.opacity = "0";
    
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        showCopyFeedback('Link copied to clipboard!');
    } catch (err) {
        console.error('Fallback: Could not copy text: ', err);
        showCopyFeedback('Failed to copy link');
    }
    
    document.body.removeChild(textArea);
}

// Show copy feedback
function showCopyFeedback(message) {
    // Create or update feedback element
    let feedback = document.getElementById('copy-feedback');
    if (!feedback) {
        feedback = document.createElement('div');
        feedback.id = 'copy-feedback';
        feedback.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #10B981;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            z-index: 10000;
            transform: translateY(-100px);
            opacity: 0;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        `;
        document.body.appendChild(feedback);
    }
    
    feedback.textContent = message;
    
    // Animate in
    setTimeout(() => {
        feedback.style.transform = 'translateY(0)';
        feedback.style.opacity = '1';
    }, 10);
    
    // Animate out
    setTimeout(() => {
        feedback.style.transform = 'translateY(-100px)';
        feedback.style.opacity = '0';
    }, 2000);
    
    // Remove element
    setTimeout(() => {
        if (feedback && feedback.parentNode) {
            feedback.parentNode.removeChild(feedback);
        }
    }, 2300);
}
</script>