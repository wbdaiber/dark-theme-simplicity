<?php
/**
 * The template for displaying all single posts - Mobile Optimized with Fixed Hero Section
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
	<!-- IMPROVED: Container with proper desktop spacing and mobile-optimized padding -->
	<div class="container mx-auto px-2 sm:px-4 lg:px-6 mobile-optimized-container">
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

        	<!-- IMPROVED HERO SECTION - Fixed container, z-index, and mobile spacing -->
        	<div class="hero-main-container">
            	<div class="hero-wrapper max-w-7xl mx-auto mb-6 md:mb-8 px-2 sm:px-4">
                	<div class="hero-card bg-dark-300 rounded-xl overflow-hidden shadow-xl">
                    	<!-- Content Grid with proper constraints and flexible height -->
                    	<div class="hero-grid grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 min-h-[400px] auto-rows-max">
                        	
                        	<!-- Content Column - Left Side -->
                        	<div class="hero-content md:col-span-2 lg:col-span-3 p-4 sm:p-6 md:p-8 lg:p-10 flex flex-col justify-center relative z-10">
                            	<div class="content-overlay bg-black/70 p-4 sm:p-6 rounded-lg backdrop-blur-sm">
                                	
                                	<!-- Breadcrumbs -->
                                	<nav class="breadcrumbs flex items-center gap-2 text-sm mb-4 text-light-100/70">
                                    	<a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-blue-400 transition-colors">Home</a>
                                    	<span class="text-light-100/50">›</span>
                                    	<?php
                                    	$posts_page_id = get_option('page_for_posts');
                                    	if ($posts_page_id) {
                                        	$posts_page_title = get_the_title($posts_page_id);
                                        	$posts_page_url = get_permalink($posts_page_id);
                                        	?>
                                        	<a href="<?php echo esc_url($posts_page_url); ?>" class="hover:text-blue-400 transition-colors"><?php echo esc_html($posts_page_title); ?></a>
                                        	<?php
                                    	} else {
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
                                    	echo '<a href="' . esc_url(get_category_link($first_category->term_id)) . '" class="category-badge inline-flex items-center rounded-full border px-3 py-1 text-sm font-semibold mb-4 bg-blue-300/20 text-blue-300 hover:bg-blue-300/30 border-blue-300/40 backdrop-blur-sm">' . esc_html($first_category->name) . '</a>';
                                	}
                                	?>
                                	
                                	<!-- Title -->
                                	<h1 class="hero-title text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-bold mb-4 text-white leading-tight">
                                    	<?php the_title(); ?>
                                	</h1>

                                	<!-- Excerpt -->
                                	<?php if (has_excerpt() || get_the_content()) : ?>
                                    	<div class="hero-excerpt text-base sm:text-lg text-light-100/90 mb-6 leading-relaxed">
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
                                	<div class="hero-meta flex flex-wrap items-center gap-4 text-sm text-light-100/80 pt-4 border-t border-white/10">
                                    	<time datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>" class="flex items-center gap-2">
                                        	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-300 flex-shrink-0">
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
                        	
                        	<!-- Featured Image Column - Right Side -->
                        	<?php if (has_post_thumbnail()) : ?>
                            	<div class="hero-image hidden md:flex md:col-span-1 lg:col-span-2 p-4 md:p-6 items-center justify-center">
                                	<div class="image-container w-full h-full flex items-center justify-center">
                                    	<div class="image-wrapper w-full h-full relative bg-gradient-to-tr from-blue-300/20 to-purple-300/20 rounded-lg overflow-hidden min-h-[300px]">
                                        	<?php 
                                        	the_post_thumbnail('large', [
                                            	'class' => 'hero-featured-image w-full h-full object-cover opacity-90 hover:opacity-100 transition-all duration-300',
                                            	'loading' => 'eager' // Since this is above the fold
                                        	]); 
                                        	?>
                                    	</div>
                                	</div>
                            	</div>
                        	<?php endif; ?>
                        	
                        	<!-- Mobile Background Image (hidden on desktop) -->
                        	<?php if (has_post_thumbnail()) : ?>
                            	<div class="mobile-bg absolute inset-0 md:hidden z-0" style="max-height: 60vh;">
                                	<?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                                	<div class="absolute inset-0 bg-black opacity-75"></div>
                            	</div>
                        	<?php endif; ?>
                        	
                    	</div>
                	</div>
            	</div>
        	</div>

        	<!-- MOBILE OPTIMIZED: Content Section Card with improved mobile width -->
        	<article class="max-w-7xl mx-auto bg-dark-300 mobile-article-container px-2 sm:px-4 <?php echo $visibility_classes . ' ' . $centered_layout . ' ' . $responsive_class; ?>">
            	<!-- MOBILE OPTIMIZED: Better responsive padding -->
            	<div class="p-3 sm:p-6 md:p-8 lg:p-12 mobile-content-padding">
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

                	<!-- MOBILE OPTIMIZED: Mobile TOC with improved positioning and z-index -->
                	<?php if ($has_toc) : ?>
                	<div class="md:hidden sticky top-[70px] z-30 mb-3 mobile-toc-container">
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
                                    	<path d="M18.244 2.25h3.308l-7.227 8.259 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.080l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
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

                	<!-- MOBILE OPTIMIZED: Two-column layout with mobile-content-layout class -->
                	<div class="flex flex-col md:flex-row gap-3 md:gap-4 mobile-content-layout <?php echo ($show_widgets !== 'yes' && $show_toc !== 'yes' && $show_share !== 'yes') ? 'justify-center' : ''; ?>">
                    	<!-- MOBILE OPTIMIZED: Main content column with mobile-main-content class -->
                    	<div class="flex-1 content-container mobile-main-content <?php echo $content_width_class; ?> <?php echo $content_class; ?>">
                        	<div class="entry-content prose prose-invert max-w-none text-light-100/80 prose-p:leading-relaxed prose-headings:mt-8 prose-headings:mb-4">
                            	<?php the_content(); ?>
                        	</div>

                        	<footer class="entry-footer mt-8 md:mt-12 pt-6 md:pt-8 border-t border-white/10">
                            	<!-- Post navigation removed as requested -->
                        	</footer>
                    	</div>
                   	 
                    	<!-- Desktop TOC, Sharing, and Widgets - Using dynamic width class -->
                    	<?php if ($show_toc === 'yes' || $show_share === 'yes' || $show_widgets === 'yes') : ?>
                    	<div class="hidden md:block sidebar-container <?php echo $sidebar_width_class; ?> flex-shrink-0">
                        	<div class="sticky top-24 space-y-2 z-20">
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
                                        	<div class="hidden absolute top-full mt-2 right-0 bg-dark-400 rounded-lg shadow-2xl py-2 min-w-[180px] z-[100] max-h-[400px] overflow-y-auto" id="share-dropdown">
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
                                                        	<path d="M18.244 2.25h3.308l-7.227 8.259 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.80l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
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

        	<!-- MOBILE OPTIMIZED: Related Posts Section with mobile classes -->
        	<section class="bg-dark-300 py-8 md:py-16 mt-8 md:mt-16 mobile-section">
            	<div class="container mx-auto px-2 sm:px-4 lg:px-6">
                	<h2 class="text-xl md:text-3xl font-medium mb-6 md:mb-8 text-center text-white">Related Articles</h2>
               	 
                	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 max-w-7xl mx-auto">
                    	<?php
                    	$current_post_id = get_the_ID();
                   	 
                    	// First check if manually selected related posts exist
                    	$manual_related_posts = get_post_meta($current_post_id, '_related_posts', true);
                    	$has_manual_related = false;
                   	 
                    	if (!empty($manual_related_posts) && is_array($manual_related_posts)) {
                        	// Set up arguments for manually selected related posts
                        	$manual_args = array(
                            	'post__in'   	=> $manual_related_posts,
                            	'posts_per_page' => 3,
                            	'post_status'	=> 'publish',
                            	'orderby'    	=> 'post__in', // Preserve the order selected
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
                            	'category__in' 	=> $categories,
                            	'post__not_in' 	=> array($current_post_id),
                            	'posts_per_page'   => 3,
                            	'orderby'      	=> 'rand',
                            	'post_status'  	=> 'publish'
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
                                	'post__not_in' 	=> $posts_to_exclude,
                                	'posts_per_page'   => $posts_needed,
                                	'orderby'      	=> 'date',
                                	'order'        	=> 'DESC',
                                	'post_status'  	=> 'publish'
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
                                	<div class="p-4 md:p-5 flex flex-col flex-grow">
                                    	<div class="flex gap-2 mb-3 items-center">
                                        	<span class="text-xs text-light-100/50 flex items-center">
                                            	<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                	<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            	</svg>
                                            	Last Updated: <?php echo get_the_modified_date(); ?>
                                        	</span>
                                    	</div>
                                    	<h3 class="text-lg md:text-2xl font-bold mb-2 line-clamp-2 text-white hover:text-blue-300 transition-colors pl-0">
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

        	<!-- MOBILE OPTIMIZED: Contact Section with mobile classes -->
        	<section class="py-8 md:py-16 px-2 sm:px-4 lg:px-6 bg-dark-200 contact-section mt-8 md:mt-16 relative mobile-section">
            	<div class="absolute top-0 left-0 w-full h-4 bg-gradient-to-r from-blue-500/0 via-blue-500/20 to-blue-500/0"></div>
            	<div class="container mx-auto max-w-5xl">
                	<div class="text-center mb-8 md:mb-16">
                    	<span class="inline-block px-4 py-2 bg-blue-300/10 section-label rounded-full text-sm font-medium mb-4 border border-blue-300/20">
                        	Get in Touch
                    	</span>
                    	<h2 class="text-2xl md:text-4xl font-bold mb-4 text-light-100">
                        	<?php echo esc_html(get_theme_mod('dark_theme_simplicity_contact_title', 'Contact Me')); ?>
                    	</h2>
                    	<p class="text-lg md:text-xl text-light-100/70 max-w-2xl mx-auto">
                        	<?php echo esc_html(get_theme_mod('dark_theme_simplicity_contact_description', 'Let\'s discuss how we can elevate your online presence.')); ?>
                    	</p>
                	</div>

                	<div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 max-w-3xl mx-auto">
                    	<a href="mailto:<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_contact_email', 'hello@braddaiber.com')); ?>" class="glass-card p-4 md:p-6 rounded-xl hover:border-blue-500 hover:border-2 hover:bg-blue-500/10 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20">
                        	<div class="flex items-center space-x-4">
                            	<div class="bg-blue-300/20 p-3 rounded-lg">
                                	<svg class="w-6 h-6 contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    	<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    	<polyline points="22,6 12,13 2,6"></polyline>
                                	</svg>
                            	</div>
                            	<h3 class="text-xl md:text-2xl font-bold text-white">Email</h3>
                        	</div>
                    	</a>

                    	<a href="https://<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_contact_linkedin', 'linkedin.com/in/braddaiber')); ?>" target="_blank" rel="noopener noreferrer" class="glass-card p-4 md:p-6 rounded-xl hover:border-blue-500 hover:border-2 hover:bg-blue-500/10 hover:translate-y-[-5px] transition-all duration-300 shadow-md hover:shadow-blue-500/20">
                        	<div class="flex items-center space-x-4">
                            	<div class="bg-blue-300/20 p-3 rounded-lg">
                                	<svg class="w-6 h-6 contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    	<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                    	<rect x="2" y="9" width="4" height="12"></rect>
                                    	<circle cx="4" cy="4" r="2"></circle>
                                	</svg>
                            	</div>
                            	<h3 class="text-xl md:text-2xl font-bold text-white">LinkedIn</h3>
                        	</div>
                    	</a>
                	</div>
            	</div>
        	</section>
	<?php endwhile; ?>
</div>
</main>

<?php get_footer(); ?>

<!-- Add hero-specific styles -->
<style>
/* Hero Section Specific Styles - Fixed desktop layout and z-index issues */
.hero-main-container {
    margin-top: 60px; /* Reduced space from header on mobile */
    margin-bottom: 1.5rem; /* Reduced mobile spacing */
    position: relative;
    z-index: 5; /* Lower than header */
}

@media (min-width: 768px) {
    .hero-main-container {
        margin-top: 80px; /* Normal desktop spacing */
        margin-bottom: 2rem;
        z-index: 5; /* Still lower than header */
    }
}

.hero-wrapper {
    max-width: 1400px; /* Increased max width */
    margin-left: auto;
    margin-right: auto;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
}

@media (min-width: 640px) {
    .hero-wrapper {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

.hero-card {
    position: relative;
    overflow: hidden;
    border-radius: 0.75rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    background-color: rgb(55 65 81); /* bg-dark-300 */
    z-index: 5; /* Lower than header */
}

.hero-grid {
    position: relative;
    min-height: 400px; /* Keep original desktop height */
    overflow: visible; /* Changed from hidden to visible */
    display: grid;
    align-items: stretch; /* Ensure columns stretch to match content */
}

/* Mobile: Limit hero height to prevent image from being too tall */
@media (max-width: 767px) {
    .hero-grid {
        min-height: 300px; /* Reduced mobile height */
        max-height: 60vh; /* Limit maximum height on mobile */
    }
}

.hero-content {
    position: relative;
    z-index: 10;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 1rem;
    min-height: 400px; /* Keep original desktop height */
}

/* Mobile: Adjust content height to match grid */
@media (max-width: 767px) {
    .hero-content {
        min-height: 300px; /* Match mobile grid height */
        max-height: 60vh; /* Match mobile grid max height */
    }
}

@media (min-width: 640px) {
    .hero-content {
        padding: 1.5rem;
    }
}

@media (min-width: 768px) {
    .hero-content {
        padding: 2rem;
    }
}

@media (min-width: 1024px) {
    .hero-content {
        padding: 2.5rem;
    }
}

.content-overlay {
    background: rgba(0, 0, 0, 0.7);
    padding: 1rem;
    border-radius: 0.5rem;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

@media (min-width: 640px) {
    .content-overlay {
        padding: 1.5rem;
    }
}

@media (min-width: 768px) {
    .content-overlay {
        padding: 2rem;
    }
}

.hero-image {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    min-height: 250px; /* Reduced mobile minimum height */
}

/* Desktop minimum height for image */
@media (min-width: 768px) {
    .hero-image {
        min-height: 400px; /* Normal desktop height */
        padding: 1.5rem;
    }
}

.image-container {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 0.5rem;
}

.image-wrapper {
    width: 100%;
    height: 100%;
    position: relative;
    overflow: hidden;
    border-radius: 0.5rem;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(139, 92, 246, 0.2));
    min-height: 200px; /* Reduced mobile minimum height */
}

/* Desktop minimum height for image wrapper */
@media (min-width: 768px) {
    .image-wrapper {
        min-height: 300px; /* Normal desktop height */
    }
}

.hero-featured-image {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    object-position: center !important;
    transition: all 0.3s ease;
    opacity: 0.9;
}

.hero-featured-image:hover {
    opacity: 1;
    transform: scale(1.02);
}

.mobile-bg {
    display: none;
}

/* Mobile styles - Focus on limiting image height */
@media (max-width: 767px) {
    .hero-main-container {
        margin-top: 50px; /* Keep original mobile spacing */
    }
    
    .hero-content {
        padding: 1rem; /* Keep original mobile padding */
    }
    
    .content-overlay {
        background: rgba(0, 0, 0, 0.8);
        padding: 1rem; /* Keep original mobile padding */
    }
    
    .mobile-bg {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        max-height: 60vh; /* Limit background image height */
        overflow: hidden;
    }
    
    .mobile-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top; /* Focus on top of image when cropping */
    }
    
    .mobile-bg .absolute.inset-0.bg-black {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.75);
    }
}

/* Typography improvements */
.hero-title {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    line-height: 1.2;
}

.hero-excerpt {
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    line-height: 1.6;
}

.category-badge {
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
}

.breadcrumbs a:hover {
    color: rgb(96 165 250); /* blue-400 */
}

.hero-meta svg {
    color: rgb(96 165 250); /* blue-300 */
}

/* Z-index hierarchy - Header gets priority */
.site-header,
.main-navigation,
.header-container {
    z-index: 1000 !important;
}

.hero-main-container,
.hero-card,
.hero-grid {
    z-index: 5 !important;
}

/* Mobile width improvements */
.mobile-optimized-container {
    width: 95vw; /* More viewport width on mobile */
    max-width: none;
}

@media (min-width: 640px) {
    .mobile-optimized-container {
        width: 90vw;
    }
}

@media (min-width: 768px) {
    .mobile-optimized-container {
        width: auto;
        max-width: 1400px;
    }
}

.mobile-article-container {
    width: 95vw; /* More viewport width on mobile */
    max-width: none;
}

@media (min-width: 640px) {
    .mobile-article-container {
        width: 90vw;
    }
}

@media (min-width: 768px) {
    .mobile-article-container {
        width: auto;
        max-width: 1400px;
    }
}

/* Ensure containers align properly with improved responsive widths */
@media (min-width: 768px) {
    .container.mx-auto.px-2 {
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .max-w-7xl.mx-auto {
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
    }
}

/* Z-INDEX FIX FOR SHARE DROPDOWN - Ensure proper hierarchy */
#share-dropdown {
    background: rgba(31, 41, 55, 0.98) !important;
    backdrop-filter: blur(16px) !important;
    -webkit-backdrop-filter: blur(16px) !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 
                0 10px 20px -5px rgba(0, 0, 0, 0.4) !important;
    border-radius: 0.75rem !important;
    padding: 0.75rem !important;
    min-width: 200px !important;
    z-index: 500 !important; /* Lower than header but higher than content */
    position: fixed !important;
}

#share-container {
    position: relative !important;
    z-index: 25 !important;
}

#share-btn {
    position: relative !important;
    z-index: 26 !important;
    background: rgba(55, 65, 81, 0.8) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    backdrop-filter: blur(4px) !important;
    -webkit-backdrop-filter: blur(4px) !important;
    padding: 0.75rem 1rem !important;
    border-radius: 0.5rem !important;
    transition: all 0.2s ease !important;
    color: rgba(248, 250, 252, 0.9) !important;
    font-weight: 500 !important;
}

/* Ensure sidebar container doesn't interfere but stays below header */
.sidebar-container {
    overflow: visible !important;
    z-index: 20 !important; /* Lower than dropdown */
}

.sticky.top-24 {
    overflow: visible !important;
    z-index: 20 !important;
}

/* Ensure main content sections have appropriate z-index */
.mobile-hero-card,
.hero-container,
.mobile-article-container,
.mobile-content-layout,
.entry-content,
.table-of-contents,
.toc-desktop {
    z-index: 1 !important;
}

/* Mobile TOC improvements with proper z-index */
.mobile-toc-container {
    z-index: 30 !important; /* Below header but above content */
}

.mobile-sticky-nav {
    z-index: 30 !important;
}

.mobile-share-dropdown,
.mobile-toc-dropdown {
    z-index: 35 !important;
}

/* Ensure the entire sidebar has appropriate z-index hierarchy */
.hidden.md\:block {
    z-index: 20 !important;
}

/* Ensure any backdrop or overlay elements don't interfere with header */
.backdrop-blur-md,
.bg-dark-300,
.bg-dark-400 {
    z-index: auto !important;
}

/* Mobile responsive improvements - Keep original content sizing */
@media (max-width: 767px) {
    .hero-wrapper {
        padding-left: 0.25rem;
        padding-right: 0.25rem;
    }
    
    .mobile-content-padding {
        padding: 0.75rem;
    }
    
    /* Keep original mobile title sizing */
    .hero-title {
        font-size: 1.25rem;
        line-height: 1.3;
    }
    
    .hero-excerpt {
        font-size: 0.875rem;
        line-height: 1.5;
    }
}

@media (min-width: 480px) and (max-width: 767px) {
    .hero-title {
        font-size: 1.5rem;
    }
    
    .hero-excerpt {
        font-size: 1rem;
    }
}

/* Enhanced content width on mobile */
.mobile-main-content {
    width: 100% !important;
}

@media (max-width: 767px) {
    .mobile-content-layout {
        padding-left: 0;
        padding-right: 0;
    }
    
    .flex-1.content-container {
        width: 100% !important;
        max-width: 100% !important;
    }
}

/* Ensure related posts and contact sections use full mobile width */
.mobile-section .container {
    width: 95vw;
    max-width: none;
}

@media (min-width: 640px) {
    .mobile-section .container {
        width: 90vw;
    }
}

@media (min-width: 768px) {
    .mobile-section .container {
        width: auto;
        max-width: 1400px;
    }
}
/* ==========================================================================
   HEADER Z-INDEX AND MOBILE SPACING FIXES
   ========================================================================== */

/* 1. HEADER PRIORITY - Highest z-index hierarchy */
.site-header,
.main-navigation,
.header-container {
    z-index: 1000 !important;
}

/* Mobile menu and dropdowns - Second highest priority */
#mobile-menu,
#mobile-menu-overlay,
.mobile-menu,
.mobile-navigation {
    z-index: 999 !important;
}

/* Mobile menu toggle button */
#mobile-menu-toggle {
    z-index: 1001 !important; /* Above header for proper interaction */
}

/* 2. POST CONTENT ELEMENTS - Lower priority than header/mobile menu */
/* Share dropdowns - Below mobile menu but above content */
#share-dropdown,
.mobile-share-dropdown,
.mobile-toc-dropdown {
    z-index: 950 !important; /* Below mobile menu */
}

/* Fix for desktop share dropdown positioning */
#share-dropdown {
    position: fixed !important;
    background: rgba(31, 41, 55, 0.98) !important;
    backdrop-filter: blur(16px) !important;
    -webkit-backdrop-filter: blur(16px) !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 
                0 10px 20px -5px rgba(0, 0, 0, 0.4) !important;
    border-radius: 0.75rem !important;
    padding: 0.75rem !important;
    min-width: 200px !important;
    z-index: 950 !important;
}

.mobile-toc-container,
.mobile-sticky-nav {
    z-index: 940 !important;
}

/* Desktop share container and button */
#share-container,
#share-btn {
    z-index: 935 !important;
}

/* Sidebar elements */
.sidebar-container,
.sticky.top-24,
.toc-desktop {
    z-index: 920 !important;
}

/* Hero section - Lower than all interactive elements */
.hero-main-container,
.hero-card,
.hero-grid,
.hero-wrapper {
    z-index: 10 !important; /* Much lower than header */
}

/* Main content areas */
.mobile-article-container,
.mobile-content-layout,
.entry-content,
.table-of-contents {
    z-index: 5 !important;
}

/* Background elements */
.mobile-bg,
.backdrop-blur-md,
.bg-dark-300,
.bg-dark-400 {
    z-index: 1 !important;
}

/* 3. MOBILE SPACING FIXES - Hero content FUCKING CLOSE to header */
@media (max-width: 767px) {
    /* MINIMAL gap - hero practically touching header */
    .hero-main-container {
        margin-top: 5px !important; /* TINY 5px gap - practically touching */
        margin-bottom: 1rem !important;
    }
    
    /* Ensure hero wrapper has minimal padding */
    .hero-wrapper {
        margin-bottom: 1rem !important;
        padding-left: 0.5rem !important;
        padding-right: 0.5rem !important;
    }
    
    /* Keep existing hero grid height */
    .hero-grid {
        min-height: 300px !important; /* Keep original mobile height */
        max-height: 60vh !important; /* Keep original mobile max height */
    }
    
    /* Keep existing hero content height */
    .hero-content {
        min-height: 300px !important;
        max-height: 60vh !important;
        padding: 1rem !important;
    }
    
    /* Keep existing content overlay */
    .content-overlay {
        padding: 1rem !important;
    }
    
    /* Keep existing mobile background image height */
    .mobile-bg {
        max-height: 60vh !important;
    }
}

/* Small mobile devices - PRACTICALLY NO GAP */
@media (max-width: 480px) {
    .hero-main-container {
        margin-top: 3px !important; /* PRACTICALLY NO GAP - 3px only */
        margin-bottom: 0.75rem !important;
    }
    
    .hero-wrapper {
        margin-bottom: 0.75rem !important;
        padding-left: 0.25rem !important;
        padding-right: 0.25rem !important;
    }
}

/* 4. ENHANCED MOBILE MENU Z-INDEX HANDLING */
/* Ensure mobile menu appears above all post content */
#mobile-menu {
    position: fixed !important;
    top: 64px !important; /* Header height */
    right: 0 !important;
    z-index: 999 !important; /* Below header but above all content */
    background-color: rgba(17, 24, 39, 0.98) !important;
    backdrop-filter: blur(16px) !important;
    -webkit-backdrop-filter: blur(16px) !important;
    box-shadow: -5px 5px 25px rgba(0, 0, 0, 0.5) !important; /* Stronger shadow */
}

#mobile-menu-overlay {
    z-index: 998 !important; /* Just below mobile menu */
    background-color: rgba(0, 0, 0, 0.4) !important;
    backdrop-filter: blur(3px) !important;
    -webkit-backdrop-filter: blur(3px) !important;
}

/* 5. DESKTOP SPACING - Keep existing spacing */
@media (min-width: 768px) {
    .hero-main-container {
        margin-top: 80px !important; /* Normal desktop spacing */
        margin-bottom: 2rem !important;
    }
    
    .hero-wrapper {
        margin-bottom: 2rem !important;
    }
    
    .hero-grid {
        min-height: 400px !important; /* Normal desktop height */
        max-height: none !important;
    }
    
    .hero-content {
        min-height: 400px !important;
        max-height: none !important;
    }
}

/* 6. PREVENT CONTENT OVERLAP WITH ENHANCED SPECIFICITY */
/* Ensure no post content can appear above header level */
.entry-content *,
.page-content *,
.widget *,
.sidebar *,
article *,
section *:not(.site-header):not(.site-header *) {
    z-index: auto !important;
    position: relative !important;
}

/* Exception for specifically positioned elements that need higher z-index */
.sticky,
.fixed,
[class*="dropdown"]:not(.site-header [class*="dropdown"]),
[class*="modal"]:not(.site-header [class*="modal"]),
[class*="popup"]:not(.site-header [class*="popup"]) {
    z-index: 500 !important; /* Still below header hierarchy */
}

/* 7. SMOOTH TRANSITIONS FOR MOBILE ELEMENTS */
.hero-main-container,
.hero-wrapper,
.hero-grid {
    transition: margin 0.3s ease, padding 0.3s ease !important;
}

/* 8. ACCESSIBILITY AND INTERACTION IMPROVEMENTS */
/* Ensure mobile menu toggle is always accessible */
#mobile-menu-toggle {
    position: relative !important;
    z-index: 1001 !important;
    pointer-events: auto !important;
}

/* Ensure mobile menu links are accessible */
#mobile-menu a {
    position: relative !important;
    z-index: 1000 !important;
    pointer-events: auto !important;
}

/* 9. FAILSAFE FOR CONTENT STACKING */
/* Force header to always be on top regardless of other styles */
.site-header {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    z-index: 1000 !important;
    transform: translateZ(0) !important; /* Force hardware acceleration */
}

/* Force mobile menu to be just below header */
#mobile-menu {
    transform: translateZ(0) !important; /* Force hardware acceleration */
}

/* 10. CONTENT PADDING ADJUSTMENTS FOR BETTER MOBILE EXPERIENCE */
@media (max-width: 767px) {
    /* Reduce padding in main content areas to compensate for tighter hero spacing */
    .mobile-article-container {
        margin-top: 0.5rem !important; /* Reduced spacing after hero */
    }
    
    .mobile-content-padding {
        padding-top: 0.75rem !important; /* Reduced from default */
        padding-bottom: 0.75rem !important;
    }
    
    /* Ensure mobile TOC doesn't interfere with header */
    .mobile-toc-container {
        top: 70px !important; /* Adjusted to match new hero spacing */
    }
}
</style>
<script>
// Enhanced Share Dropdown Functionality with improved z-index handling
document.addEventListener('DOMContentLoaded', function() {
    const shareBtn = document.getElementById('share-btn');
    const shareDropdown = document.getElementById('share-dropdown');
    const shareContainer = document.getElementById('share-container');
    
    if (shareBtn && shareDropdown) {
        
        // Function to position dropdown correctly with header awareness
        function positionDropdown() {
            const btnRect = shareBtn.getBoundingClientRect();
            const viewportWidth = window.innerWidth;
            const viewportHeight = window.innerHeight;
            const dropdownWidth = 220;
            const dropdownHeight = 200;
            const headerHeight = 80; // Account for header height
            
            // Since we're using position: fixed, we position relative to viewport
            shareDropdown.style.position = 'fixed';
            shareDropdown.style.zIndex = '500'; // Below header (1000) but above content
            
            // For very small screens, center at bottom
            if (viewportWidth <= 480) {
                shareDropdown.style.top = 'auto';
                shareDropdown.style.bottom = '20px';
                shareDropdown.style.left = '50%';
                shareDropdown.style.right = 'auto';
                shareDropdown.style.transform = 'translateX(-50%)';
                return;
            }
            
            // Reset transform for larger screens
            shareDropdown.style.transform = 'none';
            
            // Position dropdown below the button by default, but account for header
            let topPosition = Math.max(btnRect.bottom + 8, headerHeight + 10);
            
            // Check if dropdown would go off-screen vertically
            if (topPosition + dropdownHeight > viewportHeight && btnRect.top > dropdownHeight + headerHeight) {
                // Position above the button if there's room
                topPosition = Math.max(btnRect.top - dropdownHeight - 8, headerHeight + 10);
            }
            
            shareDropdown.style.top = topPosition + 'px';
            shareDropdown.style.bottom = 'auto';
            
            // Check if dropdown would go off-screen horizontally
            const spaceOnRight = viewportWidth - btnRect.right;
            const spaceOnLeft = btnRect.left;
            
            if (spaceOnRight < dropdownWidth && spaceOnLeft > dropdownWidth) {
                // Position to the left of the button
                shareDropdown.style.right = (viewportWidth - btnRect.left) + 'px';
                shareDropdown.style.left = 'auto';
            } else {
                // Default position to the right edge of button
                shareDropdown.style.left = (btnRect.right - dropdownWidth) + 'px';
                shareDropdown.style.right = 'auto';
            }
            
            // Ensure minimum distance from viewport edges
            const minMargin = 10;
            const leftPos = parseInt(shareDropdown.style.left) || 0;
            const rightEdge = leftPos + dropdownWidth;
            
            if (leftPos < minMargin) {
                shareDropdown.style.left = minMargin + 'px';
                shareDropdown.style.right = 'auto';
            } else if (rightEdge > viewportWidth - minMargin) {
                shareDropdown.style.right = minMargin + 'px';
                shareDropdown.style.left = 'auto';
            }
        }
        
        // Show/hide dropdown with enhanced positioning
        shareBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isHidden = shareDropdown.classList.contains('hidden');
            
            if (isHidden) {
                // Position dropdown before showing
                positionDropdown();
                
                // Show dropdown
                shareDropdown.classList.remove('hidden');
                shareDropdown.style.display = 'block';
                
                // Add active state to button
                shareBtn.classList.add('active');
                
                console.log('Desktop share dropdown shown');
            } else {
                // Hide dropdown
                shareDropdown.classList.add('hidden');
                shareDropdown.style.display = 'none';
                
                // Remove active state from button
                shareBtn.classList.remove('active');
                
                console.log('Desktop share dropdown hidden');
            }
        });
        
        // Close dropdown when clicking share links
        const shareLinks = shareDropdown.querySelectorAll('a[target="_blank"], button');
        shareLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                // Don't prevent default for external links
                if (this.tagName === 'A' && this.hasAttribute('target')) {
                    // Let the link open normally
                } else {
                    e.preventDefault();
                }
                
                // Close dropdown after a short delay
                setTimeout(function() {
                    shareDropdown.classList.add('hidden');
                    shareDropdown.style.display = 'none';
                    shareBtn.classList.remove('active');
                }, 100);
            });
        });
        
        // Reposition dropdown on window resize
        window.addEventListener('resize', function() {
            if (!shareDropdown.classList.contains('hidden')) {
                positionDropdown();
            }
        });
        
        // Reposition dropdown on scroll (for sticky elements)
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            if (!shareDropdown.classList.contains('hidden')) {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(function() {
                    positionDropdown();
                }, 10);
            }
        });
    }
    
    // Mobile share functionality (keeping existing code)
    const shareToggle = document.querySelector('.mobile-share-toggle');
    const mobileShareDropdown = document.querySelector('.mobile-share-dropdown');
    
    if (shareToggle && mobileShareDropdown) {
        shareToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isHidden = mobileShareDropdown.style.display === 'none' ||
                             mobileShareDropdown.style.display === '';
            
            if (isHidden) {
                mobileShareDropdown.style.display = 'block';
                shareToggle.classList.add('active');
                console.log('Mobile share shown');
                
                // Close mobile TOC if open
                const mobileTocDropdown = document.querySelector('.mobile-toc-dropdown');
                if (mobileTocDropdown) {
                    mobileTocDropdown.style.display = 'none';
                    const tocToggle = document.querySelector('.mobile-toc-toggle');
                    if (tocToggle) tocToggle.classList.remove('active');
                }
            } else {
                mobileShareDropdown.style.display = 'none';
                shareToggle.classList.remove('active');
                console.log('Mobile share hidden');
            }
        });
        
        // Close mobile share when clicking a link
        const mobileShareLinks = mobileShareDropdown.querySelectorAll('a, button');
        mobileShareLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                setTimeout(function() {
                    mobileShareDropdown.style.display = 'none';
                    shareToggle.classList.remove('active');
                }, 100);
            });
        });
    }
    
    // Mobile TOC functionality (keeping existing code)
    const tocToggle = document.querySelector('.mobile-toc-toggle');
    const mobileTocDropdown = document.querySelector('.mobile-toc-dropdown');
    
    if (tocToggle && mobileTocDropdown) {
        tocToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isHidden = mobileTocDropdown.style.display === 'none' ||
                             mobileTocDropdown.style.display === '';
            
            if (isHidden) {
                mobileTocDropdown.style.display = 'block';
                tocToggle.classList.add('active');
                console.log('Mobile TOC shown');
                
                // Close mobile share if open
                if (mobileShareDropdown) {
                    mobileShareDropdown.style.display = 'none';
                    if (shareToggle) shareToggle.classList.remove('active');
                }
            } else {
                mobileTocDropdown.style.display = 'none';
                tocToggle.classList.remove('active');
                console.log('Mobile TOC hidden');
            }
        });
        
        // Close TOC when clicking a link
        const tocLinks = mobileTocDropdown.querySelectorAll('a');
        tocLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                setTimeout(function() {
                    mobileTocDropdown.style.display = 'none';
                    tocToggle.classList.remove('active');
                }, 100);
            });
        });
    }
    
    // Enhanced outside click detection
    document.addEventListener('click', function(e) {
        // Desktop share dropdown
        if (shareBtn && shareDropdown &&
            !shareBtn.contains(e.target) &&
            !shareDropdown.contains(e.target) &&
            !shareContainer.contains(e.target)) {
            shareDropdown.classList.add('hidden');
            shareDropdown.style.display = 'none';
            shareBtn.classList.remove('active');
        }
        
        // Mobile dropdowns
        if (mobileShareDropdown && shareToggle &&
            !shareToggle.contains(e.target) &&
            !mobileShareDropdown.contains(e.target)) {
            mobileShareDropdown.style.display = 'none';
            shareToggle.classList.remove('active');
        }
        
        if (mobileTocDropdown && tocToggle &&
            !tocToggle.contains(e.target) &&
            !mobileTocDropdown.contains(e.target)) {
            mobileTocDropdown.style.display = 'none';
            tocToggle.classList.remove('active');
        }
    });
    
    // Enhanced keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Close all dropdowns
            if (shareDropdown) {
                shareDropdown.classList.add('hidden');
                shareDropdown.style.display = 'none';
                if (shareBtn) shareBtn.classList.remove('active');
            }
            if (mobileShareDropdown) {
                mobileShareDropdown.style.display = 'none';
                if (shareToggle) shareToggle.classList.remove('active');
            }
            if (mobileTocDropdown) {
                mobileTocDropdown.style.display = 'none';
                if (tocToggle) tocToggle.classList.remove('active');
            }
        }
    });
});

// Copy to clipboard functionality (enhanced)
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
    
    // Close all dropdowns after copying
    setTimeout(function() {
        const shareDropdown = document.getElementById('share-dropdown');
        const mobileShareDropdown = document.querySelector('.mobile-share-dropdown');
        const shareBtn = document.getElementById('share-btn');
        const shareToggle = document.querySelector('.mobile-share-toggle');
        
        if (shareDropdown) {
            shareDropdown.classList.add('hidden');
            shareDropdown.style.display = 'none';
        }
        if (shareBtn) shareBtn.classList.remove('active');
        
        if (mobileShareDropdown) mobileShareDropdown.style.display = 'none';
        if (shareToggle) shareToggle.classList.remove('active');
    }, 100);
}

// Fallback copy function
function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.opacity = "0";
    textArea.style.width = "1px";
    textArea.style.height = "1px";
    
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

// Enhanced copy feedback with better positioning and z-index
function showCopyFeedback(message) {
    // Remove any existing feedback
    const existingFeedback = document.getElementById('copy-feedback');
    if (existingFeedback) {
        existingFeedback.remove();
    }
    
    const feedback = document.createElement('div');
    feedback.id = 'copy-feedback';
    feedback.textContent = message;
    
    // Enhanced styling with proper z-index
    feedback.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        z-index: 10000;
        transform: translateY(-100px) scale(0.9);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    `;
    
    document.body.appendChild(feedback);
    
    // Animate in
    requestAnimationFrame(() => {
        feedback.style.transform = 'translateY(0) scale(1)';
        feedback.style.opacity = '1';
    });
    
    // Animate out
    setTimeout(() => {
        feedback.style.transform = 'translateY(-100px) scale(0.9)';
        feedback.style.opacity = '0';
    }, 2500);
    
    // Remove element
    setTimeout(() => {
        if (feedback && feedback.parentNode) {
            feedback.remove();
        }
    }, 2800);
}
</script>
