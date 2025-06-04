<?php
/**
 * Custom Walker for Footer Menu
 */
class Dark_Theme_Simplicity_Walker_Footer_Menu extends Walker_Nav_Menu {
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= '<li' . $id . $class_names .'>';
        
        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';
        
        $link_classes = 'text-light-100/70 hover:text-blue-400 transition-colors duration-200';
        
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a class="' . $link_classes . '"' . $attributes . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Custom Walker for Social Menu
 */
class Dark_Theme_Simplicity_Walker_Social_Menu extends Walker_Nav_Menu {
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= '<li' . $id . $class_names .'>';
        
        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';
        
        $link_classes = 'text-light-100/70 hover:text-blue-400 transition-colors duration-200';
        
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a class="' . $link_classes . '"' . $attributes . ' rel="noopener noreferrer">';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Emergency fix for blank pages - Prevent fatal errors and auto-recover
 */
if (!function_exists('dt_prevent_fatal_errors')) {
    function dt_prevent_fatal_errors() {
        // Catch any fatal errors during customizer operations
        if (isset($_POST['wp_customize']) && $_POST['wp_customize'] === 'on') {
            ini_set('memory_limit', '512M');
            set_time_limit(300);
        }
    }
    add_action('init', 'dt_prevent_fatal_errors', 1);
}

/**
 * Auto-recover from blank pages by detecting broken theme mods
 */
function dt_auto_recover_from_blank_pages() {
    // Only check on front-end requests and not AJAX
    if (is_admin() || wp_doing_ajax()) {
        return;
    }

    // Check if customizer has been used recently
    $last_customized = get_option('dt_last_customizer_use', 0);
    $check_period = 300; // 5 minutes
    
    if (time() - $last_customized > $check_period) {
        return;
    }
    
    // Get theme mods
    $theme_mods = get_theme_mods();
    
    // Check for approach items specifically - this was the source of the problem
    if (isset($theme_mods['approach_items'])) {
        $approach_items = json_decode($theme_mods['approach_items'], true);
        
        // If approach_items is corrupt, reset it
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($approach_items)) {
            // Reset to default approach items
            $default_approach_items = array(
                array(
                    'title' => 'Discover',
                    'description' => 'We start by understanding your needs and goals.',
                    'icon' => 'search'
                ),
                array(
                    'title' => 'Design', 
                    'description' => 'We create solutions tailored to your requirements.',
                    'icon' => 'design'
                ),
                array(
                    'title' => 'Deliver',
                    'description' => 'We implement and deliver results that exceed expectations.',
                    'icon' => 'delivery'
                )
            );
            
            set_theme_mod('approach_items', json_encode($default_approach_items));
            
            // Log the recovery
            error_log('Dark Theme Simplicity: Auto-recovered from corrupted approach_items');
        }
    }
}
add_action('wp', 'dt_auto_recover_from_blank_pages');

/**
 * Track customizer usage to know when to check for recovery
 */
function dt_track_customizer_usage() {
    if (isset($_POST['wp_customize']) && $_POST['wp_customize'] === 'on') {
        update_option('dt_last_customizer_use', time());
    }
}
add_action('customize_save_after', 'dt_track_customizer_usage');

// Function to safely get approach items in your template
if (!function_exists('dt_get_approach_items')) {
    function dt_get_approach_items() {
        $items = get_theme_mod('approach_items', '');
        
        if (empty($items)) {
            // Return default items if none set
            return array(
                array(
                    'title' => 'Discover',
                    'description' => 'We start by understanding your needs and goals.',
                    'icon' => 'search'
                ),
                array(
                    'title' => 'Design', 
                    'description' => 'We create solutions tailored to your requirements.',
                    'icon' => 'design'
                ),
                array(
                    'title' => 'Deliver',
                    'description' => 'We implement and deliver results that exceed expectations.',
                    'icon' => 'delivery'
                )
            );
        }
        
        $decoded = json_decode($items, true);
        
        // If JSON is corrupted, return defaults
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            // Log the error
            error_log('Dark Theme Simplicity: Corrupt JSON in approach_items: ' . json_last_error_msg());
            
            // Return default items
            return array(
                array(
                    'title' => 'Discover',
                    'description' => 'We start by understanding your needs and goals.',
                    'icon' => 'search'
                ),
                array(
                    'title' => 'Design', 
                    'description' => 'We create solutions tailored to your requirements.',
                    'icon' => 'design'
                ),
                array(
                    'title' => 'Deliver',
                    'description' => 'We implement and deliver results that exceed expectations.',
                    'icon' => 'delivery'
                )
            );
        }
        
        return $decoded;
    }
}

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
 * Register widget areas
 */
function dark_theme_simplicity_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'dark-theme-simplicity'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar on all pages.', 'dark-theme-simplicity'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title text-xl font-bold mb-4 text-white" role="heading" aria-level="2">',
        'after_title'   => '</div>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Post Sidebar', 'dark-theme-simplicity'),
        'id'            => 'sidebar-post',
        'description'   => esc_html__('Add widgets here to appear in your sidebar on single posts.', 'dark-theme-simplicity'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title text-xl font-bold mb-4 text-white" role="heading" aria-level="2">',
        'after_title'   => '</div>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Page Sidebar', 'dark-theme-simplicity'),
        'id'            => 'sidebar-page',
        'description'   => esc_html__('Add widgets here to appear in your sidebar on pages.', 'dark-theme-simplicity'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title text-xl font-bold mb-4 text-white" role="heading" aria-level="2">',
        'after_title'   => '</div>',
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
 * Get service icon SVG based on icon name
 * 
 * @param string $icon Icon identifier
 * @return string SVG markup for the requested icon
 */
function dark_theme_simplicity_get_service_icon($icon) {
    $svg = '';
    
    switch ($icon) {
        case 'globe':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
            </svg>';
            break;
        case 'file-text':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>';
            break;
        case 'monitor':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                <line x1="8" y1="21" x2="16" y2="21"></line>
                <line x1="12" y1="17" x2="12" y2="21"></line>
            </svg>';
            break;
        case 'database':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
            </svg>';
            break;
        case 'bar-chart':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="20" x2="12" y2="10"></line>
                <line x1="18" y1="20" x2="18" y2="4"></line>
                <line x1="6" y1="20" x2="6" y2="16"></line>
            </svg>';
            break;
        case 'users':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>';
            break;
        case 'search':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>';
            break;
        case 'mail':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
            </svg>';
            break;
        case 'image':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                <polyline points="21 15 16 10 5 21"></polyline>
            </svg>';
            break;
        case 'layout':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="3" y1="9" x2="21" y2="9"></line>
                <line x1="9" y1="21" x2="9" y2="9"></line>
            </svg>';
            break;
        case 'code':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="16 18 22 12 16 6"></polyline>
                <polyline points="8 6 2 12 8 18"></polyline>
            </svg>';
            break;
        case 'trending-up':
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                <polyline points="17 6 23 6 23 12"></polyline>
            </svg>';
            break;
        default:
            // Default icon if the requested one doesn't exist
            $svg = '<svg class="w-10 h-10 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
            </svg>';
    }
    
    return $svg;
}

/**
 * Navigation Menu Walker Classes
 */
class Dark_Theme_Simplicity_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Add active class for current menu item
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
        }
        
        // Add standard and Tailwind classes
        $classes[] = 'relative';
        
        // For top-level items
        if ($depth === 0) {
            $classes[] = 'group';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        // Add Tailwind classes for links
        $atts['class'] = 'menu-link block py-2 px-4 text-white hover:text-blue-300 transition-colors duration-200';
        
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
 * Mobile Navigation Menu Walker Class
 */
class Dark_Theme_Simplicity_Walker_Nav_Menu_Mobile extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Add active class for current menu item
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
        }
        
        // Add standard and Tailwind classes
        $classes[] = 'relative';
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        // Right-aligned styling for mobile menu
        $atts['class'] = 'block w-full py-3 text-white hover:text-blue-400 transition-colors duration-200 font-medium border-b border-white/10 text-right pr-3';
        
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

// Include other files
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/admin.php';
require_once get_template_directory() . '/inc/customizer-setup.php';
// Load customizer-repeater-control.php before customizer.php
if (!class_exists('Dark_Theme_Simplicity_Customizer_Repeater_Control')) {
    require_once get_template_directory() . '/inc/customizer-repeater-control.php';
}
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/accessibility.php';
require_once get_template_directory() . '/inc/homepage-sections-customizer.php'; 
require_once get_template_directory() . '/inc/shortcodes.php';
