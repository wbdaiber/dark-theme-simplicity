<?php
/**
 * The template for displaying all single posts
 */

get_header();

// Get post display options
$show_widgets = get_post_meta(get_the_ID(), '_show_sidebar_widgets', true);
$show_toc = get_post_meta(get_the_ID(), '_show_table_of_contents', true);
$show_share = get_post_meta(get_the_ID(), '_show_share_buttons', true);

// Get default settings from theme customizer
$default_show_widgets = get_theme_mod('dark_theme_simplicity_default_show_widgets', 'yes');
$default_show_toc = get_theme_mod('dark_theme_simplicity_default_show_toc', 'yes');
$default_show_share = get_theme_mod('dark_theme_simplicity_default_show_share', 'yes');

// Use defaults if not set on individual post
if ($show_widgets === '') $show_widgets = $default_show_widgets;
if ($show_toc === '') $show_toc = $default_show_toc;
if ($show_share === '') $show_share = $default_show_share;

// Set class based on sidebar visibility
$sidebar_class = ($show_widgets === 'yes') ? '' : 'no-sidebar';

// Add classes for TOC and share visibility
$toc_class = ($show_toc === 'yes') ? '' : 'no-toc';
$share_class = ($show_share === 'yes') ? '' : 'no-share';

// Combine all classes
$visibility_classes = trim("$sidebar_class $toc_class $share_class");

// When all elements are hidden, use a specific content class
if ($show_widgets !== 'yes' && $show_toc !== 'yes' && $show_share !== 'yes') {
    $content_class = 'full-width-content w-full max-w-4xl mx-auto';
} else {
    $content_class = '';
}

// Additional classes for more responsive layout when elements are hidden
$responsive_class = '';
$content_width_class = 'md:w-4/5 lg:w-5/6 xl:w-7/8'; // Wider content width by default

// Calculate how many elements are hidden (TOC, widgets, share)
$hidden_elements = 0;
if ($show_toc !== 'yes') $hidden_elements++;
if ($show_widgets !== 'yes') $hidden_elements++;
if ($show_share !== 'yes') $hidden_elements++;

// Apply responsive classes based on hidden elements
if ($hidden_elements === 3) {
    // All elements are hidden - full width content
    $responsive_class = 'full-content';
    $content_width_class = 'md:w-full lg:w-full xl:w-full';
} elseif ($hidden_elements === 2) {
    // Two elements are hidden - extra wide content
    $responsive_class = 'wide-content';
    $content_width_class = 'md:w-11/12 lg:w-11/12 xl:w-11/12';
} elseif ($hidden_elements === 1) {
    // One element is hidden - slightly wider content
    $responsive_class = 'wider-content';
    $content_width_class = 'md:w-4/5 lg:w-5/6 xl:w-7/8';
}

// Calculate sidebar width class based on visible elements
$sidebar_width_class = 'md:w-1/5 lg:w-1/6 xl:w-1/8'; // Updated sidebar width - narrower on larger screens

if ($show_toc !== 'yes' && $show_share !== 'yes') {
    // If both TOC and share are hidden but widgets are shown
    $sidebar_width_class = 'md:w-1/6 lg:w-1/7 xl:w-1/9';
}

// Calculate additional classes for layout when all elements are hidden
$centered_layout = '';
if ($show_widgets !== 'yes' && $show_toc !== 'yes' && $show_share !== 'yes') {
    $centered_layout = 'flex flex-col items-center';
}
?>

<main id="content" class="site-main pt-0 pb-16">
    <div class="container mx-auto px-4" style="margin-top: 2rem;">
    <?php while (have_posts()) : the_post(); 
        // Get post display options
        $show_toc = get_post_meta(get_the_ID(), '_show_table_of_contents', true);
        $show_share = get_post_meta(get_the_ID(), '_show_share_buttons', true);
        
        // Get default settings from theme customizer
        $default_show_toc = get_theme_mod('dark_theme_simplicity_default_show_toc', 'yes');
        $default_show_share = get_theme_mod('dark_theme_simplicity_default_show_share', 'yes');
        
        // Use defaults if not set on individual post
        if ($show_toc === '') $show_toc = $default_show_toc;
        if ($show_share === '') $show_share = $default_show_share;
    ?>
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
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 min-h-[400px] relative z-10">
                        <!-- Background Image Layer for Medium Screens (860px or less) -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="absolute inset-0 hidden small-medium:block md:hidden z-0">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-contain']); ?>
                                <div class="absolute inset-0 bg-black opacity-75"></div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Content Column - Takes up 2/3 on medium screens, 3/5 on large screens -->
                        <div class="md:col-span-2 lg:col-span-3 p-8 md:p-10 flex flex-col justify-center relative z-20" style="overflow: visible;">
                            <div class="relative z-10 bg-black/60 small-medium:bg-black/60 md:bg-transparent p-4 small-medium:p-4 md:p-0 rounded-lg small-medium:rounded-lg md:rounded-none" style="overflow: visible;">
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
                        
                        <!-- Featured Image Column - Takes up 1/3 on medium screens, 2/5 on large screens -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="hidden md:flex md:col-span-1 lg:col-span-2 p-4 md:p-5 items-center justify-center">
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="w-full h-full relative bg-gradient-to-tr from-blue-300/20 to-purple-300/20 rounded-lg overflow-hidden shadow-lg">
                                        <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-contain opacity-90 hover:opacity-100 transition-all duration-300']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Content Section Card -->
            <article <?php post_class('max-w-6xl mx-auto bg-dark-300 rounded-xl shadow-xl overflow-hidden ' . $visibility_classes . ' ' . $centered_layout . ' ' . $responsive_class); ?>>
                <div class="p-8 md:p-12">
                <?php
                    // Extract headings for table of contents - improved version
                    $content = get_the_content();
                    $pattern = '/<h2.*?>(.*?)<\/h2>/i';
                    $h2_found = preg_match_all($pattern, $content, $headings);
                    
                    // Only process TOC if we have H2 headings and TOC is enabled
                    $has_toc = $h2_found && count($headings[1]) > 0 && $show_toc === 'yes';
                    $toc_content = '';
                    
                    if ($has_toc) {
                        // Build TOC HTML with consistent styling
                        $toc_content .= '<div class="table-of-contents p-6 bg-dark-400 rounded-lg mt-4">';
                        $toc_content .= '<div class="toc-heading text-xl font-bold mb-4 text-white" role="heading" aria-level="2">Table of Contents</div>';
                        $toc_content .= '<ul class="space-y-2 toc-list">';
                        
                        foreach ($headings[1] as $index => $heading) {
                            // Strip any HTML tags
                            $clean_heading = strip_tags($heading);
                            // Use the same sanitize_title function as in the functions.php
                            $heading_id = sanitize_title($clean_heading);
                            
                            $toc_content .= '<li class="toc-item text-light-100/80 hover:text-blue-300">';
                            $toc_content .= '<a href="#' . $heading_id . '" class="toc-link flex items-start gap-1 transition-colors">';
                            $toc_content .= '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300 toc-caret mt-1 flex-shrink-0"><polyline points="9 18 15 12 9 6"></polyline></svg>';
                            $toc_content .= '<span class="toc-text break-words">' . $clean_heading . '</span>';
                            $toc_content .= '</a></li>';
                        }
                        
                        $toc_content .= '</ul>';
                        $toc_content .= '</div>';
                    }
                    ?>

                    <!-- Mobile TOC (shows only on mobile) -->
                    <?php if ($has_toc) : ?>
                    <div class="md:hidden sticky top-[70px] z-40 mb-4">
                        <!-- Mobile Sticky Navigation Bar -->
                        <div class="mobile-sticky-nav bg-dark-200/95 backdrop-blur-md shadow-lg rounded-lg p-1.5 flex items-center justify-between">
                            <?php if ($show_share === 'yes') : ?>
                            <!-- Mobile Share Button -->
                            <button class="mobile-share-toggle flex items-center gap-1.5 px-2 py-1 rounded-md hover:bg-dark-300/80 text-white text-xs transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300">
                                    <circle cx="18" cy="5" r="3"></circle>
                                    <circle cx="6" cy="12" r="3"></circle>
                                    <circle cx="18" cy="19" r="3"></circle>
                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                </svg>
                                <span>Share</span>
                            </button>
                            <?php endif; ?>
                            
                            <?php if ($has_toc) : ?>
                            <!-- Mobile TOC Button -->
                            <button class="mobile-toc-toggle flex items-center gap-1.5 px-2 py-1 rounded-md hover:bg-dark-300/80 text-white text-xs transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300">
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <line x1="3" y1="12" x2="21" y2="12"></line>
                                    <line x1="3" y1="18" x2="21" y2="18"></line>
                                </svg>
                                <span>Contents</span>
                            </button>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Mobile Share Dropdown (hidden by default) -->
                        <?php if ($show_share === 'yes') : ?>
                        <div class="mobile-share-dropdown hidden mt-2 bg-dark-200/95 backdrop-blur-md rounded-lg shadow-lg p-3">
                            <div class="share-heading text-xs font-medium mb-2 text-white" role="heading" aria-level="3">Share this article</div>
                            <div class="grid grid-cols-2 gap-2">
                                <!-- Facebook Share -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="flex items-center gap-1.5 p-1.5 hover:bg-dark-300/80 text-white text-xs transition-colors rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-[#1877F2] flex-shrink-0">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    <span>Facebook</span>
                                </a>
                                
                                <!-- X (Twitter) Share -->
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="flex items-center gap-1.5 p-1.5 hover:bg-dark-300/80 text-white text-xs transition-colors rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-white flex-shrink-0">
                                        <path d="M18.244 2.25h3.308l-7.227 8.259 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                    <span>X</span>
                                </a>
                                
                                <!-- LinkedIn Share -->
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="flex items-center gap-1.5 p-1.5 hover:bg-dark-300/80 text-white text-xs transition-colors rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-[#0A66C2] flex-shrink-0">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                    <span>LinkedIn</span>
                                </a>
                                
                                <!-- Copy Link Option -->
                                <button onclick="copyToClipboard('<?php echo esc_js(get_permalink()); ?>')" 
                                        class="flex items-center gap-1.5 p-1.5 hover:bg-dark-300/80 text-white text-xs transition-colors rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-300 flex-shrink-0">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                    </svg>
                                    <span>Copy Link</span>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Mobile TOC Dropdown (hidden by default) -->
                        <?php if ($has_toc) : ?>
                        <div class="mobile-toc-dropdown hidden mt-2 bg-dark-200/95 backdrop-blur-md rounded-lg shadow-lg p-3">
                            <div class="toc-heading text-xs font-medium mb-2 text-white" role="heading" aria-level="2">Contents</div>
                            <ul class="space-y-0.5 mobile-toc-list max-h-[40vh] overflow-y-auto">
                                <?php
                                foreach ($headings[1] as $index => $heading) {
                                    // Strip any HTML tags
                                    $clean_heading = strip_tags($heading);
                                    // Use the same sanitize_title function as in the functions.php
                                    $heading_id = sanitize_title($clean_heading);
                                    
                                    echo '<li class="toc-item text-light-100/80 hover:text-blue-300 text-xs">';
                                    echo '<a href="#' . $heading_id . '" class="toc-link flex items-start gap-1 transition-colors p-1 rounded-md hover:bg-dark-300/50">';
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300 toc-caret mt-0.5 flex-shrink-0"><polyline points="9 18 15 12 9 6"></polyline></svg>';
                                    echo '<span class="toc-text break-words">' . $clean_heading . '</span>';
                                    echo '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Two-column layout for content and TOC on desktop -->
                    <div class="flex flex-col md:flex-row gap-4 <?php echo ($show_widgets !== 'yes' && $show_toc !== 'yes' && $show_share !== 'yes') ? 'justify-center' : ''; ?>">
                        <!-- Main content column - Using dynamic width class -->
                        <div class="flex-1 content-container <?php echo $content_width_class; ?> <?php echo $content_class; ?>">
                            <div class="entry-content prose prose-invert max-w-none text-light-100/80 prose-p:leading-relaxed prose-headings:mt-8 prose-headings:mb-4">
                                <?php the_content(); ?>
                            </div>

                            <footer class="entry-footer mt-12 pt-8 border-t border-white/10">
                                <!-- Post navigation removed as requested -->
                            </footer>
                        </div>
                        
                        <!-- Desktop TOC, Sharing, and Widgets - Using dynamic width class -->
                        <?php if ($show_toc === 'yes' || $show_share === 'yes' || $show_widgets === 'yes') : ?>
                        <div class="hidden md:block <?php echo $sidebar_width_class; ?> flex-shrink-0">
                            <div class="sticky top-24 space-y-2">
                                <!-- Desktop Sharing Buttons -->
                                <?php if ($show_share === 'yes') : ?>
                                <div class="p-1.5 bg-dark-400 rounded-lg">
                                    <div class="share-heading share-label text-xs font-medium mb-1 px-1" role="heading" aria-level="3">Share</div>
                                    <div class="flex flex-col gap-1">
                                        <!-- Share Dropdown -->
                                        <div class="relative w-full" id="share-container">
                                            <button class="flex items-center gap-2 bg-dark-300/80 hover:bg-dark-300 border border-white/5 rounded-lg px-2 py-1 text-xs text-white transition-all w-full" id="share-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300">
                                                    <circle cx="18" cy="5" r="3"></circle>
                                                    <circle cx="6" cy="12" r="3"></circle>
                                                    <circle cx="18" cy="19" r="3"></circle>
                                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                                </svg>
                                                <span>Share</span>
                                            </button>
                                            
                                            <!-- Desktop Share Dropdown -->
                                            <div class="hidden absolute top-full mt-2 right-0 bg-dark-400 rounded-lg shadow-2xl py-2 min-w-[180px] z-[9999] max-h-[400px] overflow-y-auto" id="share-dropdown">
                                                <div class="flex flex-col">
                                                    <!-- Facebook Share -->
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer"
                                                       class="flex items-center gap-2 px-3 py-2 hover:bg-dark-300/80 text-white text-xs transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-[#1877F2] flex-shrink-0">
                                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                        </svg>
                                                        <span>Facebook</span>
                                                    </a>
                                                    
                                                    <!-- X (Twitter) Share -->
                                                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer"
                                                       class="flex items-center gap-2 px-3 py-2 hover:bg-dark-300/80 text-white text-xs transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-white flex-shrink-0">
                                                            <path d="M18.244 2.25h3.308l-7.227 8.259 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                                        </svg>
                                                        <span>X</span>
                                                    </a>
                                                    
                                                    <!-- LinkedIn Share -->
                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer"
                                                       class="flex items-center gap-2 px-3 py-2 hover:bg-dark-300/80 text-white text-xs transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-[#0A66C2] flex-shrink-0">
                                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                        </svg>
                                                        <span>LinkedIn</span>
                                                    </a>
                                                    
                                                    <!-- Copy Link Option -->
                                                    <button onclick="copyToClipboard('<?php echo esc_js(get_permalink()); ?>')" 
                                                            class="flex items-center gap-2 px-3 py-2 hover:bg-dark-300/80 text-white text-xs transition-colors w-full text-left">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-300 flex-shrink-0">
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
                                <?php endif; ?>
                                
                                <!-- Table of Contents -->
                                <?php if ($has_toc && $show_toc === 'yes') : ?>
                                    <div class="toc-desktop p-1.5 bg-dark-400 rounded-lg">
                                     <div class="toc-label toc-heading text-xs font-medium mb-1 px-1" role="heading" aria-level="2">Contents</div>
                                        <ul class="space-y-0.5 toc-list text-xs">
                                            <?php foreach ($headings[1] as $index => $heading) : 
                                                // Strip any HTML tags
                                                $clean_heading = strip_tags($heading);
                                                // Use the same sanitize_title function as in the functions.php
                                                $heading_id = sanitize_title($clean_heading);
                                            ?>
                                            <li class="toc-item text-light-100/80 hover:text-blue-300">
                                                <a href="#<?php echo $heading_id; ?>" class="toc-link flex items-start gap-1 transition-colors py-0.5 px-1 hover:bg-dark-300/30 rounded-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300 toc-caret mt-1 flex-shrink-0"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                    <span class="toc-text break-words"><?php echo $clean_heading; ?></span>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- Sidebar Widgets -->
                                <?php if ($show_widgets === 'yes') : ?>
                                    <div class="mt-3 sidebar-widgets">
                                        <?php 
                                        // Include sidebar directly to debug and fix widget display
                                        if (is_active_sidebar('sidebar-post')) {
                                            echo '<div class="widget-area bg-dark-400 p-4 rounded-lg text-sm">';
                                            dynamic_sidebar('sidebar-post');
                                            echo '</div>';
                                        } elseif (is_active_sidebar('sidebar-1')) {
                                            echo '<div class="widget-area bg-dark-400 p-4 rounded-lg text-sm">';
                                            dynamic_sidebar('sidebar-1');
                                            echo '</div>';
                                        } else {
                                            echo '<div class="widget-area bg-dark-400 p-4 rounded-lg text-sm">';
                                            echo '<div class="widget">';
                                            echo '<div class="widget-title text-sm font-bold mb-2 text-white">No Widgets Found</div>';
                                            echo '<p class="text-light-100/70 text-xs">Add widgets to the Post Sidebar area in the WordPress dashboard.</p>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
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
                                <div class="overflow-hidden backdrop-blur-lg bg-dark-100/50 rounded-xl transition-all duration-300 hover:bg-dark-100 h-full flex flex-col">
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
    
    /* Main content area takes priority on mobile */
    .entry-content {
        font-size: 1rem !important;
    }
    
    /* Make mobile TOC more compact */
    .mobile-toc-dropdown {
        max-height: 40vh !important;
        overflow-y: auto !important;
    }
    
    .mobile-toc-list {
        max-height: 35vh !important;
        overflow-y: auto !important;
        padding-right: 10px !important;
    }
    
    /* Smaller mobile share buttons */
    .mobile-share-dropdown .grid {
        gap: 0.375rem !important;
    }
    
    .mobile-share-dropdown a,
    .mobile-share-dropdown button {
        padding: 0.375rem 0.5rem !important;
    }
    
    /* Mobile sticky nav bar styling */
    .mobile-sticky-nav {
        background-color: rgba(17, 24, 39, 0.9) !important;
        backdrop-filter: blur(8px) !important;
    }
    
    .mobile-sticky-nav button {
        font-size: 0.75rem !important;
    }
    
    /* Reduce space around TOC items */
    .toc-item {
        margin-bottom: 0.25rem !important;
    }
    
    .toc-link {
        padding: 0.25rem 0.5rem !important;
    }
    
    .toc-caret {
        margin-top: 0.125rem !important;
        width: 10px !important;
        height: 10px !important;
    }
    
    .toc-text {
        font-size: 0.75rem !important;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .site-main .container {
        margin-top: 2rem !important;
    }
    
    /* More compact sidebar on tablets */
    .toc-desktop, 
    .toc-desktop .toc-list {
        padding-right: 0.5rem !important;
    }
    
    .toc-desktop .toc-text {
        font-size: 0.7rem !important;
        line-height: 1.2 !important;
    }
    
    .toc-desktop .toc-caret {
        width: 8px !important;
        height: 8px !important;
    }
    
    /* Make sure content gets enough space */
    .content-container {
        width: 75% !important;
        flex: 0 0 75% !important;
    }
    
    /* Keep sidebar elements narrow */
    .md\:w-1\/5, .lg\:w-1\/6, .xl\:w-1\/8 {
        width: 25% !important;
        flex: 0 0 25% !important;
    }
}

@media (min-width: 1025px) {
    .site-main .container {
        margin-top: 2rem !important;
    }
    
    /* Ensure sidebar is properly sized on large screens */
    .xl\:w-1\/8 {
        width: 15% !important;
        flex: 0 0 15% !important;
    }
    
    .xl\:w-7\/8 {
        width: 85% !important;
        flex: 0 0 85% !important;
    }
}

/* Consistently style Table of Contents */
.table-of-contents {
    overflow-wrap: break-word !important;
    word-wrap: break-word !important;
    max-width: 100% !important;
}

.toc-list {
    list-style: none !important;
    padding-left: 0 !important;
    margin-left: 0 !important;
    width: 100% !important;
}

.toc-item {
    margin-bottom: 0.125rem !important;
    width: 100% !important;
}

.toc-link {
    display: flex !important;
    align-items: flex-start !important;
    text-decoration: none !important;
    width: 100% !important;
}

.toc-caret {
    color: #60a5fa !important;
    flex-shrink: 0 !important;
    margin-right: 0.25rem !important;
    display: inline-block !important;
}

.toc-text {
    font-size: 0.75rem !important;
    line-height: 1.2 !important;
    overflow-wrap: break-word !important;
    word-wrap: break-word !important;
    word-break: break-word !important;
    max-width: calc(100% - 15px) !important;
}

/* Enhanced hover states for TOC items */
.toc-link:hover {
    color: #60a5fa !important;
    text-decoration: none !important;
    background-color: rgba(31, 41, 55, 0.3) !important;
    border-radius: 0.25rem !important;
}

.toc-link:hover .toc-caret {
    transform: translateX(2px);
    transition: transform 0.2s ease;
}

/* Enhanced share dropdown styling */
#share-dropdown,
#share-dropdown-mobile {
    min-width: 180px !important;
    max-width: 220px !important;
    z-index: 99999 !important;
    background: rgba(31, 41, 55, 0.95) !important;
    backdrop-filter: blur(10px) !important;
}

#share-dropdown a,
#share-dropdown button,
#share-dropdown-mobile a,
#share-dropdown-mobile button {
    white-space: nowrap;
    font-size: 0.75rem !important;
}

/* Ensure parent containers don't clip dropdowns */
.sticky, .relative, article, .container {
    overflow: visible !important;
}

/* Mobile specific dropdown adjustments */
@media (max-width: 768px) {
    .mobile-share-dropdown, 
    .mobile-toc-dropdown {
        width: 100% !important;
    }
    
    /* Better sticky positioning on mobile */
    .md\:hidden.sticky {
        top: 65px !important;
        z-index: 50 !important;
    }
}

/* Additional CSS for blog post hero section */
@media (min-width: 768px) {
    /* Main content should be the priority */
    .flex-1.content-container {
        flex: 1 0 80% !important;
    }
    
    /* Sidebar should be narrower */
    .md\:block.md\:w-1\/5,
    .md\:block.lg\:w-1\/6,
    .md\:block.xl\:w-1\/8 {
        flex: 0 0 20% !important;
        max-width: 20% !important;
    }
}

/* Make the sidebar widgets compact */
.widget {
    font-size: 0.75rem !important;
    margin-bottom: 1rem !important;
}

.widget-title {
    font-size: 0.875rem !important;
    margin-bottom: 0.5rem !important;
}
</style>

<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Desktop share button functionality
    const shareBtn = document.getElementById('share-btn');
    const shareDropdown = document.getElementById('share-dropdown');
    
    if (shareBtn && shareDropdown) {
        shareBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            if (shareDropdown.classList.contains('hidden')) {
                shareDropdown.classList.remove('hidden');
                console.log('Desktop share shown');
            } else {
                shareDropdown.classList.add('hidden');
                console.log('Desktop share hidden');
            }
        });
        
        // Close dropdown after clicking a share link
        const shareLinks = shareDropdown.querySelectorAll('a[target="_blank"]');
        shareLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                setTimeout(function() {
                    shareDropdown.classList.add('hidden');
                }, 100);
            });
        });
    }
    
    // Mobile share toggle (using direct style manipulation)
    const shareToggle = document.querySelector('.mobile-share-toggle');
    const mobileShareDropdown = document.querySelector('.mobile-share-dropdown');
    
    if (shareToggle && mobileShareDropdown) {
        shareToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (mobileShareDropdown.style.display === 'none' || mobileShareDropdown.style.display === '') {
                mobileShareDropdown.style.display = 'block';
                console.log('Mobile share shown via style');
                
                // Close mobile TOC if open
                const mobileTocDropdown = document.querySelector('.mobile-toc-dropdown');
                if (mobileTocDropdown) {
                    mobileTocDropdown.style.display = 'none';
                }
            } else {
                mobileShareDropdown.style.display = 'none';
                console.log('Mobile share hidden via style');
            }
        });
        
        // Close mobile share when clicking a link
        const mobileShareLinks = mobileShareDropdown.querySelectorAll('a, button');
        mobileShareLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                setTimeout(function() {
                    mobileShareDropdown.style.display = 'none';
                }, 100);
            });
        });
    }
    
    // Mobile TOC toggle (using direct style manipulation)
    const tocToggle = document.querySelector('.mobile-toc-toggle');
    const mobileTocDropdown = document.querySelector('.mobile-toc-dropdown');
    
    if (tocToggle && mobileTocDropdown) {
        tocToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (mobileTocDropdown.style.display === 'none' || mobileTocDropdown.style.display === '') {
                mobileTocDropdown.style.display = 'block';
                console.log('Mobile TOC shown via style');
                
                // Close mobile share if open
                if (mobileShareDropdown) {
                    mobileShareDropdown.style.display = 'none';
                }
            } else {
                mobileTocDropdown.style.display = 'none';
                console.log('Mobile TOC hidden via style');
            }
        });
        
        // Close TOC when clicking a link
        const tocLinks = mobileTocDropdown.querySelectorAll('a');
        tocLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                setTimeout(function() {
                    mobileTocDropdown.style.display = 'none';
                }, 100);
            });
        });
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        // Desktop share dropdown
        if (shareBtn && shareDropdown && !shareBtn.contains(e.target) && !shareDropdown.contains(e.target)) {
            shareDropdown.classList.add('hidden');
        }
        
        // Mobile dropdowns
        if (mobileShareDropdown && shareToggle && 
            !shareToggle.contains(e.target) && !mobileShareDropdown.contains(e.target)) {
            mobileShareDropdown.style.display = 'none';
        }
        
        if (mobileTocDropdown && tocToggle && 
            !tocToggle.contains(e.target) && !mobileTocDropdown.contains(e.target)) {
            mobileTocDropdown.style.display = 'none';
        }
    });
    
    // Close dropdowns when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (shareDropdown) shareDropdown.classList.add('hidden');
            if (mobileShareDropdown) mobileShareDropdown.style.display = 'none';
            if (mobileTocDropdown) mobileTocDropdown.style.display = 'none';
        }
    });
});

// Copy to clipboard function (keep existing)
function copyToClipboard(url) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(url).then(function() {
            showCopyFeedback('Link copied to clipboard!');
        }).catch(function(err) {
            console.error('Failed to copy: ', err);
            fallbackCopyTextToClipboard(url);
        });
    } else {
        fallbackCopyTextToClipboard(url);
    }
    
    // Close all dropdowns
    const shareDropdown = document.getElementById('share-dropdown');
    const mobileShareDropdown = document.querySelector('.mobile-share-dropdown');
    
    if (shareDropdown) shareDropdown.classList.add('hidden');
    if (mobileShareDropdown) mobileShareDropdown.style.display = 'none';
}

// Keep existing fallback and feedback functions
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

function showCopyFeedback(message) {
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
