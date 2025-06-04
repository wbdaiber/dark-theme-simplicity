<?php
/**
 * Enqueue scripts and styles for Dark Theme Simplicity
 * FINAL VERSION - All conflicts resolved
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue scripts and styles
 */
function dark_theme_simplicity_scripts() {
    // Enqueue the main stylesheet
    wp_enqueue_style('dark-theme-simplicity-style', get_stylesheet_uri(), array(), '1.2.0');
    
    // Enqueue homepage styles only on front page
    if (is_front_page()) {
        wp_enqueue_style('homepage-styles', get_template_directory_uri() . '/assets/css/homepage.css', array(), '1.2.0');
    }
    
    // Enqueue common content styles for posts and pages
    if (is_single() || is_page()) {
        wp_enqueue_style('common-content', get_template_directory_uri() . '/assets/css/common-content.css', array(), '1.2.0');
    }
    
    // Enqueue blog accessibility styles
    if (is_single() || is_home() || is_archive() || is_search()) {
        wp_enqueue_style('blog-accessibility', get_template_directory_uri() . '/assets/css/blog-accessibility.css', array(), '1.2.0');
    }
    
    // Enqueue page styles
    if (is_page()) {
        wp_enqueue_style('page-styles', get_template_directory_uri() . '/assets/css/page-styles.css', array(), '1.2.0');
        
        // Tools child page styles
        if (function_exists('is_tools_child_page') && is_tools_child_page()) {
            wp_enqueue_style('tools-child-styles', get_template_directory_uri() . '/assets/css/tools-child-styles.css', array('page-styles'), '1.2.0');
        }
    }
    
    // Enqueue widget styles
    wp_enqueue_style('widget-styles', get_template_directory_uri() . '/assets/css/widget-styles.css', array(), '1.2.0');
    
    // Enqueue SEO optimization styles
    wp_enqueue_style('seo-optimization', get_template_directory_uri() . '/assets/css/seo-optimization.css', array(), '1.2.0');

    // === JAVASCRIPT FILES ===
    
    // Main consolidated theme JavaScript (includes mobile menu, responsive videos, etc.)
    wp_enqueue_script(
        'dark-theme-consolidated',
        get_template_directory_uri() . '/assets/js/consolidated-theme.js',
        array('jquery'),
        '1.2.0',
        true
    );

    // Blog fixes for single posts (updated version)
    if (is_single()) {
        wp_enqueue_script(
            'dark-theme-blog-fixes',
            get_template_directory_uri() . '/assets/js/blog-fixes.js',
            array('jquery'),
            '1.2.0',
            true
        );
    }
    
    // Editor customizations (only in admin/editor)
    if (is_admin()) {
        wp_enqueue_script(
            'dark-theme-editor-customizations',
            get_template_directory_uri() . '/assets/js/editor-customizations.js',
            array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
            '1.2.0',
            true
        );
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
 * Enqueue customizer scripts (CONSOLIDATED VERSION)
 */
function dark_theme_simplicity_customize_controls_enqueue_scripts() {
    // Customizer styles (only if files exist)
    if (file_exists(get_template_directory() . '/assets/css/customizer.css')) {
        wp_enqueue_style(
            'dark-theme-customizer-style',
            get_template_directory_uri() . '/assets/css/customizer.css',
            array(),
            '1.2.0'
        );
    }
    
    if (file_exists(get_template_directory() . '/assets/css/customizer-repeater.css')) {
        wp_enqueue_style(
            'dark-theme-customizer-repeater',
            get_template_directory_uri() . '/assets/css/customizer-repeater.css',
            array(),
            '1.2.0'
        );
    }
    
    if (file_exists(get_template_directory() . '/assets/css/customizer-fixes.css')) {
        wp_enqueue_style(
            'dark-theme-customizer-fixes',
            get_template_directory_uri() . '/assets/css/customizer-fixes.css',
            array(),
            '1.2.0'
        );
    }
    
    // Consolidated customizer JavaScript
    wp_enqueue_script(
        'dark-theme-customizer-consolidated',
        get_template_directory_uri() . '/assets/js/customizer-consolidated.js',
        array('jquery', 'customize-controls', 'jquery-ui-sortable'),
        '1.2.0',
        true
    );
}
add_action('customize_controls_enqueue_scripts', 'dark_theme_simplicity_customize_controls_enqueue_scripts');