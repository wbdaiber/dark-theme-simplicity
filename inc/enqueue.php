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
    // Enqueue the main stylesheet with a static version number
    wp_enqueue_style('dark-theme-simplicity-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue homepage styles and animations only on front page
    if (is_front_page()) {
        wp_enqueue_style('homepage-styles', get_template_directory_uri() . '/assets/css/homepage.css', array(), '1.0.1');
    }
    
    // Enqueue common content styles for both posts and pages
    if (is_single() || is_page()) {
        wp_enqueue_style('common-content', get_template_directory_uri() . '/css/common-content.css', array(), '1.0.0');
    }
    
    // Enqueue WCAG accessibility styles for blog posts
    if (is_single() || is_home() || is_archive() || is_search()) {
        wp_enqueue_style('blog-accessibility', get_template_directory_uri() . '/css/blog-accessibility.css', array(), '1.0.13');
    }
    
    // Enqueue custom page styles for regular pages and child pages of Tools template
    if (is_page()) {
        wp_enqueue_style('page-styles', get_template_directory_uri() . '/css/page-styles.css', array(), '1.0.6');
        
        // Add tools child page styles for child pages of tool template pages
        if (is_tools_child_page()) {
            wp_enqueue_style('tools-child-styles', get_template_directory_uri() . '/css/tools-child-styles.css', array('page-styles'), '1.0.0');
        }
    }
    
    // Enqueue widget styles
    wp_enqueue_style('widget-styles', get_template_directory_uri() . '/css/widget-styles.css', array(), '1.0.0');
    
    // Add SEO optimization styles (ensure it loads after other styles)
    wp_enqueue_style('seo-optimization', get_template_directory_uri() . '/css/seo-optimization.css', array('blog-accessibility', 'widget-styles'), '1.0.1');

    // Enqueue theme JavaScript
    wp_enqueue_script('dark-theme-simplicity-script', get_template_directory_uri() . '/src/js/theme.js', array(), '1.0.0', true);

    // Enqueue blog fixes script for single posts
    if (is_single()) {
        wp_enqueue_script('blog-fixes', get_template_directory_uri() . '/js/blog-fixes.js', array('jquery'), '1.0.0', true);
    }

    // Add dark mode class to body if user preference is dark
    wp_add_inline_script('dark-theme-simplicity-script', '
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
        if (prefersDarkScheme.matches) {
            document.body.classList.add("dark-mode");
        }
    ');
}
add_action('wp_enqueue_scripts', 'dark_theme_simplicity_scripts');

/**
 * Function to check if current page is a child of a page using the Tools template
 */
function is_tools_child_page() {
    if (!is_page()) {
        return false;
    }
    
    $page_id = get_the_ID();
    $parent_id = wp_get_post_parent_id($page_id);
    
    // If no parent, it's not a child page
    if (!$parent_id) {
        return false;
    }
    
    // Check if parent page uses the Tools template
    $template = get_page_template_slug($parent_id);
    return $template === 'page-templates/tools-template.php';
}

/**
 * Add a special body class for tools child pages
 */
function dark_theme_simplicity_body_classes($classes) {
    if (is_tools_child_page()) {
        $classes[] = 'tools-child-page';
    }
    return $classes;
}
add_filter('body_class', 'dark_theme_simplicity_body_classes');

/**
 * Enqueue admin scripts and styles
 */
function dark_theme_simplicity_customize_controls_enqueue_scripts() {
    wp_enqueue_style('dark-theme-simplicity-customizer-style', get_template_directory_uri() . '/css/customizer.css', array(), '1.0.0');
    wp_enqueue_script('dark-theme-simplicity-customizer-script', get_template_directory_uri() . '/js/customizer.js', array('jquery', 'customize-controls'), '1.0.0', true);
    
    // Add customizer repeater assets
    wp_enqueue_style('dark-theme-customizer-repeater', get_template_directory_uri() . '/css/customizer-repeater.css', array(), '1.0.1');
    wp_enqueue_script('dark-theme-customizer-repeater', get_template_directory_uri() . '/js/customizer-repeater.js', array('jquery', 'customize-controls', 'jquery-ui-sortable'), '1.0.1', true);
    
    // Add customizer safety script
    wp_enqueue_script('dark-theme-customizer-safety', get_template_directory_uri() . '/js/customizer-safety.js', array('jquery', 'customize-controls', 'dark-theme-customizer-repeater'), '1.0.0', true);
    
    // Add emergency customizer fixes
    wp_enqueue_style('dark-theme-customizer-fixes', get_template_directory_uri() . '/css/customizer-fixes.css', array(), '1.0.0');
    
    // Add custom JS to fix repeater controls
    wp_add_inline_script('dark-theme-customizer-repeater', '
        jQuery(document).ready(function($) {
            // Debug message
            console.log("Dark Theme Simplicity: Customizer repeater scripts loaded");
            
            // Add safety mechanism to catch corrupted JSON
            window.addEventListener("error", function(e) {
                if (e.message && e.message.indexOf("JSON") !== -1) {
                    console.error("JSON error detected:", e.message);
                    alert("Warning: There was an issue with the customizer data. A backup will be attempted.");
                    
                    // Try to restore from localStorage backup
                    $(".customizer-repeater-collector").each(function() {
                        var id = $(this).attr("id") || "repeater";
                        var backup = localStorage.getItem("dt_backup_" + id);
                        
                        if (backup) {
                            try {
                                // Verify backup is valid JSON
                                JSON.parse(backup);
                                $(this).val(backup).trigger("change");
                                console.log("Restored backup for", id);
                            } catch (e) {
                                console.error("Backup for " + id + " is invalid", e);
                            }
                        }
                    });
                }
            });
        });
    ');
}
add_action('customize_controls_enqueue_scripts', 'dark_theme_simplicity_customize_controls_enqueue_scripts'); 