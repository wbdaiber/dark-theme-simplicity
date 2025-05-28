<?php
/**
 * Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue scripts and styles
 */
function dark_theme_simplicity_scripts() {
    // Enqueue the main stylesheet with a timestamp to prevent caching
    wp_enqueue_style('dark-theme-simplicity-style', get_stylesheet_uri(), array(), time());
    
    // Enqueue WCAG accessibility styles for blog posts
    if (is_single() || is_home() || is_archive() || is_search()) {
        wp_enqueue_style('blog-accessibility', get_template_directory_uri() . '/css/blog-accessibility.css', array(), time());
    }
    
    // Enqueue widget styles
    wp_enqueue_style('widget-styles', get_template_directory_uri() . '/css/widget-styles.css', array(), time());

    // Enqueue theme JavaScript
    wp_enqueue_script('dark-theme-simplicity-script', get_template_directory_uri() . '/src/js/theme.js', array(), time(), true);

    // Add dark mode class to body if user preference is dark
    if (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') {
        add_filter('body_class', function($classes) {
            $classes[] = 'dark';
            return $classes;
        });
    }
}
add_action('wp_enqueue_scripts', 'dark_theme_simplicity_scripts');

/**
 * Theme setup
 */
function dark_theme_simplicity_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'dark-theme-simplicity'),
        'footer' => esc_html__('Footer Menu', 'dark-theme-simplicity'),
        'social' => esc_html__('Social Menu', 'dark-theme-simplicity'),
        'legal' => esc_html__('Legal Menu', 'dark-theme-simplicity'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'dark_theme_simplicity_setup');

/**
 * Register widget area
 */
function dark_theme_simplicity_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'dark-theme-simplicity'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar on all pages.', 'dark-theme-simplicity'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-xl font-bold mb-4 text-white">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Post Sidebar', 'dark-theme-simplicity'),
        'id'            => 'sidebar-post',
        'description'   => esc_html__('Add widgets here to appear in your sidebar on single posts.', 'dark-theme-simplicity'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-xl font-bold mb-4 text-white">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Page Sidebar', 'dark-theme-simplicity'),
        'id'            => 'sidebar-page',
        'description'   => esc_html__('Add widgets here to appear in your sidebar on pages.', 'dark-theme-simplicity'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-xl font-bold mb-4 text-white">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'dark_theme_simplicity_widgets_init');

/**
 * Automatically add IDs to H2 headings in post content
 * This enables the Table of Contents to work without requiring JavaScript
 */
function add_heading_ids($content) {
    // Only process on single posts/pages
    if (!is_singular()) {
        return $content;
    }
    
    $pattern = '/<h2([^>]*)>(.*?)<\/h2>/i';
    $content = preg_replace_callback($pattern, function($matches) {
        $attributes = $matches[1];
        $heading_text = strip_tags($matches[2]);
        
        // Generate ID from heading text
        $id = sanitize_title($heading_text);
        
        // Check if ID attribute already exists
        if (strpos($attributes, 'id=') === false) {
            $attributes .= ' id="' . $id . '"';
        }
        
        return '<h2' . $attributes . '>' . $matches[2] . '</h2>';
    }, $content);
    
    return $content;
}
add_filter('the_content', 'add_heading_ids');

/**
 * Add custom column to Posts table in admin to show Featured status
 */
function dark_theme_simplicity_custom_posts_columns($columns) {
    $new_columns = array();
    
    // Add columns up to 'title'
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key == 'title') {
            // Add 'Featured' column after 'title'
            $new_columns['featured'] = __('Featured', 'dark-theme-simplicity');
        }
    }
    
    return $new_columns;
}
add_filter('manage_posts_columns', 'dark_theme_simplicity_custom_posts_columns');

/**
 * Add content to the custom column
 */
function dark_theme_simplicity_custom_posts_column_content($column_name, $post_id) {
    if ($column_name == 'featured') {
        $sticky_posts = get_option('sticky_posts');
        if (is_array($sticky_posts) && in_array($post_id, $sticky_posts)) {
            echo '<span style="color:#2271b1;"><span class="dashicons dashicons-star-filled"></span> ' . __('Featured', 'dark-theme-simplicity') . '</span>';
        } else {
            echo '—';
        }
    }
}
add_action('manage_posts_custom_column', 'dark_theme_simplicity_custom_posts_column_content', 10, 2);

/**
 * Add admin notices for features
 */
function dark_theme_simplicity_admin_notices() {
    // Only show to editors and admins
    if (!current_user_can('edit_others_posts')) {
        return;
    }
    
    // Check if the notice has been dismissed
    $dismissed = get_option('dark_theme_simplicity_featured_notice_dismissed', false);
    if (!$dismissed) {
        ?>
        <div class="notice notice-info is-dismissible" id="dark-theme-featured-notice">
            <p><strong><?php _e('Dark Theme Simplicity Tip:', 'dark-theme-simplicity'); ?></strong> 
            <?php _e('You can mark posts as "Featured" to highlight them on your blog homepage. Look for the "Feature" action in the quick edit menu or post edit screen.', 'dark-theme-simplicity'); ?></p>
            <button type="button" class="notice-dismiss-permanent" data-notice="featured">
                <span class="screen-reader-text"><?php _e('Dismiss this notice forever.', 'dark-theme-simplicity'); ?></span>
            </button>
        </div>
        <script>
            jQuery(document).ready(function($) {
                $(document).on('click', '.notice-dismiss-permanent', function() {
                    var notice = $(this).data('notice');
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'dark_theme_simplicity_dismiss_notice',
                            notice: notice,
                            nonce: '<?php echo wp_create_nonce('dark_theme_simplicity_dismiss_notice'); ?>'
                        }
                    });
                    $('#dark-theme-featured-notice').hide();
                });
            });
        </script>
        <?php
    }
}
add_action('admin_notices', 'dark_theme_simplicity_admin_notices');

/**
 * Handle AJAX request to dismiss notices
 */
function dark_theme_simplicity_dismiss_featured_notice() {
    check_ajax_referer('dark_theme_simplicity_dismiss_notice', 'nonce');
    update_option('dark_theme_simplicity_featured_notice_dismissed', true);
    wp_die();
}
add_action('wp_ajax_dark_theme_simplicity_dismiss_notice', 'dark_theme_simplicity_dismiss_featured_notice');

/**
 * Add JavaScript to admin for Quick Edit actions
 */
function dark_theme_simplicity_quick_edit_javascript() {
    // Only add to the posts screen
    $screen = get_current_screen();
    if ($screen->base != 'edit' || $screen->post_type != 'post') {
        return;
    }

    // Add quick edit JavaScript
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Add a button to the row actions
        $('.wp-list-table tbody tr').each(function() {
            var post_id = $(this).attr('id').replace('post-', '');
            var is_featured = $(this).find('td.column-featured .dashicons-star-filled').length > 0;
            
            var feature_action = is_featured ? 
                '<span class="unfeature"><a href="#" data-post-id="' + post_id + '" class="unfeature-post"><?php _e('Unfeature', 'dark-theme-simplicity'); ?></a> | </span>' : 
                '<span class="feature"><a href="#" data-post-id="' + post_id + '" class="feature-post"><?php _e('Feature', 'dark-theme-simplicity'); ?></a> | </span>';
            
            $(this).find('.row-actions .edit').before(feature_action);
        });
        
        // Handle feature/unfeature click
        $(document).on('click', '.feature-post, .unfeature-post', function(e) {
            e.preventDefault();
            var post_id = $(this).data('post-id');
            var action = $(this).hasClass('feature-post') ? 'feature' : 'unfeature';
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'dark_theme_simplicity_toggle_featured',
                    post_id: post_id,
                    feature_action: action,
                    nonce: '<?php echo wp_create_nonce('dark_theme_simplicity_toggle_featured'); ?>'
                },
                success: function(response) {
                    if (response.success) {
                        // Reload the page to show changes
                        location.reload();
                    }
                }
            });
        });
    });
    </script>
    <?php
}
add_action('admin_footer', 'dark_theme_simplicity_quick_edit_javascript');

/**
 * Handle AJAX request to toggle featured status
 */
function dark_theme_simplicity_toggle_featured() {
    // Check nonce and permissions
    check_ajax_referer('dark_theme_simplicity_toggle_featured', 'nonce');
    
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(array('message' => __('You do not have permission to do this.', 'dark-theme-simplicity')));
        return;
    }
    
    // Get data from request
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $action = isset($_POST['feature_action']) ? sanitize_text_field($_POST['feature_action']) : '';
    
    if (!$post_id || !in_array($action, array('feature', 'unfeature'))) {
        wp_send_json_error(array('message' => __('Invalid request.', 'dark-theme-simplicity')));
        return;
    }
    
    // Get current sticky posts
    $sticky_posts = get_option('sticky_posts', array());
    $sticky_posts = is_array($sticky_posts) ? $sticky_posts : array();
    
    // Feature or unfeature the post
    if ($action === 'feature') {
        // Add the post to sticky posts if not already there
        if (!in_array($post_id, $sticky_posts)) {
            $sticky_posts[] = $post_id;
        }
    } else {
        // Remove the post from sticky posts
        $sticky_posts = array_diff($sticky_posts, array($post_id));
    }
    
    // Update the sticky posts option
    update_option('sticky_posts', $sticky_posts);
    
    // Send success response
    wp_send_json_success(array(
        'message' => $action === 'feature' ? 
            __('Post featured successfully.', 'dark-theme-simplicity') : 
            __('Post unfeatured successfully.', 'dark-theme-simplicity'),
        'post_id' => $post_id,
        'action' => $action
    ));
}
add_action('wp_ajax_dark_theme_simplicity_toggle_featured', 'dark_theme_simplicity_toggle_featured');

/**
 * Include the Theme Customizer
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Walker Classes for Navigation Menus
 */

/**
 * Primary Menu Walker
 */
class Dark_Theme_Simplicity_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= '<li' . $id . $class_names .'>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        $atts['class']  = 'text-white hover:text-blue-400 transition-colors duration-200 font-medium';
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Mobile Menu Walker
 */
class Dark_Theme_Simplicity_Walker_Nav_Menu_Mobile extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= '<li' . $id . $class_names .'>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        $atts['class']  = 'block w-full text-center py-3 text-white hover:text-blue-400 transition-colors duration-200 font-medium';
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Footer Menu Walker
 */
class Dark_Theme_Simplicity_Walker_Footer_Menu extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= '<li' . $id . $class_names .'>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        $atts['class']  = 'text-light-100/70 hover:text-blue-400 transition-colors';
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Social Menu Walker
 */
class Dark_Theme_Simplicity_Walker_Social_Menu extends Walker_Nav_Menu {
    /**
     * Social icon mapping - add more icons as needed
     */
    private $social_icons = array(
        'linkedin.com' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
        'twitter.com' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4l11.5 11.5"></path><path d="M20 4L8.5 15.5"></path><path d="M4 20l7.5-7.5"></path><path d="M12.5 15.5L20 20"></path></svg>',
        'facebook.com' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
        'instagram.com' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>',
        'youtube.com' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>',
        'github.com' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>',
    );
    
    /**
     * Get icon for social link
     */
    private function get_social_icon($url) {
        foreach ($this->social_icons as $domain => $icon) {
            if (strpos($url, $domain) !== false) {
                return $icon;
            }
        }
        // Default icon if no match found
        return '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>';
    }
    
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $url = $item->url;
        $icon = $this->get_social_icon($url);
        
        $item_output = '<a href="' . esc_url($url) . '" class="flex items-center gap-3 text-light-100/70 hover:text-blue-400 transition-colors">';
        $item_output .= $icon;
        $item_output .= '<span>' . esc_html($item->title) . '</span>';
        $item_output .= '</a>';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * Overriding to remove <li> elements
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        // No sub-menu support for social menu
    }
    
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        // No sub-menu support for social menu
    }
    
    public function end_el(&$output, $item, $depth = 0, $args = array()) {
        // No closing </li> needed
    }
}

/**
 * Legal Menu Walker
 */
class Dark_Theme_Simplicity_Walker_Legal_Menu extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        $atts['class']  = 'text-light-100/50 hover:text-light-100 text-sm';
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * Overriding parent methods to remove <li> elements
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        // No sub-menu support for legal menu
    }
    
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        // No sub-menu support for legal menu
    }
    
    public function end_el(&$output, $item, $depth = 0, $args = array()) {
        // No closing </li> needed
    }
}

/**
 * Helper function to get SVG icon for service cards
 */
function dark_theme_simplicity_get_service_icon($icon_name) {
    $icons = array(
        'globe' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>',
        'file-text' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>',
        'monitor' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>',
        'database' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                    </svg>',
        'bar-chart' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="20" x2="12" y2="10"></line>
                        <line x1="18" y1="20" x2="18" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="16"></line>
                    </svg>',
        'users' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>',
        'search' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>',
        'mail' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>',
        'image' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>',
        'layout' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>',
        'code' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="16 18 22 12 16 6"></polyline>
                <polyline points="8 6 2 12 8 18"></polyline>
            </svg>',
        'trending-up' => '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                <polyline points="17 6 23 6 23 12"></polyline>
            </svg>',
    );
    
    // Return the selected icon or a default one if not found
    if (isset($icons[$icon_name])) {
        return $icons[$icon_name];
    } else {
        return $icons['globe']; // Default icon
    }
} 