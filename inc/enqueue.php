<?php
/**
 * Enqueue scripts and styles for Dark Theme Simplicity
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue scripts and styles
 */
function dark_theme_simplicity_scripts() {
    // Enqueue the main stylesheet
    wp_enqueue_style('dark-theme-simplicity-style', get_stylesheet_uri(), array(), '1.1.1');
    
    // Enqueue homepage styles only on front page
    if (is_front_page()) {
        wp_enqueue_style('homepage-styles', get_template_directory_uri() . '/assets/css/homepage.css', array(), '1.1.1');
    }
    
    // Enqueue common content styles for posts and pages
    if (is_single() || is_page()) {
        wp_enqueue_style('common-content', get_template_directory_uri() . '/assets/css/common-content.css', array(), '1.1.1');
    }
    
    // Enqueue blog accessibility styles
    if (is_single() || is_home() || is_archive() || is_search()) {
        wp_enqueue_style('blog-accessibility', get_template_directory_uri() . '/assets/css/blog-accessibility.css', array(), '1.1.1');
    }
    
    // Enqueue page styles
    if (is_page()) {
        wp_enqueue_style('page-styles', get_template_directory_uri() . '/assets/css/page-styles.css', array(), '1.1.1');
        
        // Tools child page styles
        if (function_exists('is_tools_child_page') && is_tools_child_page()) {
            wp_enqueue_style('tools-child-styles', get_template_directory_uri() . '/assets/css/tools-child-styles.css', array('page-styles'), '1.1.1');
        }
    }
    
    // Enqueue widget styles
    wp_enqueue_style('widget-styles', get_template_directory_uri() . '/assets/css/widget-styles.css', array(), '1.1.1');
    
    // Enqueue SEO optimization styles
    wp_enqueue_style('seo-optimization', get_template_directory_uri() . '/assets/css/seo-optimization.css', array(), '1.1.1');

    // === JAVASCRIPT FILES ===
    
    // Main theme JavaScript
    if (file_exists(get_template_directory() . '/assets/js/theme.js')) {
        wp_enqueue_script('dark-theme-simplicity-script', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.1.1', true);
    }
    
    // Mobile menu JavaScript - ENHANCED WITH DEBUGGING
    $mobile_menu_file_path = get_template_directory() . '/assets/js/mobile-menu.js';
    $mobile_menu_url = get_template_directory_uri() . '/assets/js/mobile-menu.js';
    
    // Debug information
    error_log('=== MOBILE MENU DEBUG ===');
    error_log('Theme directory: ' . get_template_directory());
    error_log('Theme directory URI: ' . get_template_directory_uri());
    error_log('Mobile menu file path: ' . $mobile_menu_file_path);
    error_log('Mobile menu URL: ' . $mobile_menu_url);
    error_log('File exists: ' . (file_exists($mobile_menu_file_path) ? 'YES' : 'NO'));
    
    if (file_exists($mobile_menu_file_path)) {
        wp_enqueue_script(
            'mobile-menu-script',
            $mobile_menu_url,
            array(),
            '1.2.2', // Bumped version number
            true
        );
        
        // Enhanced debug message
        wp_add_inline_script('mobile-menu-script', '
            console.log("=== MOBILE MENU EXTERNAL FILE ===");
            console.log("✅ Mobile menu script loaded successfully!");
            console.log("📁 Loaded from: ' . esc_js($mobile_menu_url) . '");
            console.log("🔧 Theme directory: ' . esc_js(get_template_directory()) . '");
        ');
    } else {
        // File doesn't exist - provide fallback and detailed error
        error_log('ERROR: Mobile menu file not found at: ' . $mobile_menu_file_path);
        
        // Add fallback inline script
        wp_add_inline_script('jquery', '
            console.error("❌ Mobile menu file not found!");
            console.error("Expected location: ' . esc_js($mobile_menu_file_path) . '");
            console.log("🔄 Loading fallback inline mobile menu...");
            
            jQuery(document).ready(function($) {
                console.log("📱 Fallback mobile menu initialized");
                
                $("#mobile-menu-toggle").on("click", function(e) {
                    e.preventDefault();
                    console.log("🔘 Mobile menu toggle clicked (fallback)");
                    
                    const menu = $("#mobile-menu");
                    const overlay = $("#mobile-menu-overlay");
                    
                    if (menu.hasClass("hidden")) {
                        menu.removeClass("hidden");
                        overlay.removeClass("hidden");
                        console.log("📖 Menu opened");
                    } else {
                        menu.addClass("hidden");
                        overlay.addClass("hidden");
                        console.log("📕 Menu closed");
                    }
                });
                
                // Close on overlay click
                $("#mobile-menu-overlay").on("click", function() {
                    $("#mobile-menu").addClass("hidden");
                    $("#mobile-menu-overlay").addClass("hidden");
                    console.log("📕 Menu closed via overlay");
                });
            });
        ');
    }

    // Blog fixes for single posts
    if (is_single() && file_exists(get_template_directory() . '/js/blog-fixes.js')) {
        wp_enqueue_script('blog-fixes', get_template_directory_uri() . '/js/blog-fixes.js', array('jquery'), '1.1.1', true);
    }
}
add_action('wp_enqueue_scripts', 'dark_theme_simplicity_scripts');

/**
 * Function to check if current page is a child of Tools template
 */
function is_tools_child_page() {
    if (!is_page()) {
        return false;
    }
    
    $page_id = get_the_ID();
    $parent_id = wp_get_post_parent_id($page_id);
    
    if (!$parent_id) {
        return false;
    }
    
    $template = get_page_template_slug($parent_id);
    return $template === 'page-templates/tools-template.php';
}

/**
 * Add body class for tools child pages
 */
function dark_theme_simplicity_body_classes($classes) {
    if (function_exists('is_tools_child_page') && is_tools_child_page()) {
        $classes[] = 'tools-child-page';
    }
    return $classes;
}
add_filter('body_class', 'dark_theme_simplicity_body_classes');

/**
 * Enqueue customizer scripts (only load files that exist)
 */
function dark_theme_simplicity_customize_controls_enqueue_scripts() {
    // Only enqueue files that actually exist
    if (file_exists(get_template_directory() . '/assets/css/customizer.css')) {
        wp_enqueue_style('dark-theme-customizer-style', get_template_directory_uri() . '/assets/css/customizer.css', array(), '1.1.1');
    }
    
    if (file_exists(get_template_directory() . '/js/customizer.js')) {
        wp_enqueue_script('dark-theme-customizer-script', get_template_directory_uri() . '/js/customizer.js', array('jquery', 'customize-controls'), '1.1.1', true);
    }
    
    // Check for customizer repeater assets
    if (file_exists(get_template_directory() . '/assets/css/customizer-repeater.css')) {
        wp_enqueue_style('dark-theme-customizer-repeater', get_template_directory_uri() . '/assets/css/customizer-repeater.css', array(), '1.1.1');
    }
    
    if (file_exists(get_template_directory() . '/js/customizer-repeater.js')) {
        wp_enqueue_script('dark-theme-customizer-repeater', get_template_directory_uri() . '/js/customizer-repeater.js', array('jquery', 'customize-controls', 'jquery-ui-sortable'), '1.1.1', true);
    }
    
    if (file_exists(get_template_directory() . '/js/customizer-safety.js')) {
        wp_enqueue_script('dark-theme-customizer-safety', get_template_directory_uri() . '/js/customizer-safety.js', array('jquery', 'customize-controls'), '1.1.1', true);
    }
    
    if (file_exists(get_template_directory() . '/assets/css/customizer-fixes.css')) {
        wp_enqueue_style('dark-theme-customizer-fixes', get_template_directory_uri() . '/assets/css/customizer-fixes.css', array(), '1.1.1');
    }
}
add_action('customize_controls_enqueue_scripts', 'dark_theme_simplicity_customize_controls_enqueue_scripts');