<?php
/**
 * Accessibility improvements for Dark Theme Simplicity
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Add skip to content link
 */
function dark_theme_simplicity_skip_link() {
    echo '<a class="skip-link screen-reader-text" href="#content">' . esc_html__('Skip to content', 'dark-theme-simplicity') . '</a>';
}
add_action('wp_body_open', 'dark_theme_simplicity_skip_link', 5);

/**
 * Add screen reader text styles
 */
function dark_theme_simplicity_accessibility_styles() {
    $styles = '
        /* Accessibility styles */
        .screen-reader-text {
            border: 0;
            clip: rect(1px, 1px, 1px, 1px);
            clip-path: inset(50%);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute !important;
            width: 1px;
            word-wrap: normal !important;
        }
        
        .screen-reader-text:focus {
            background-color: #0085ff;
            clip: auto !important;
            clip-path: none;
            color: #ffffff;
            display: block;
            font-size: 1rem;
            font-weight: 600;
            height: auto;
            left: 5px;
            line-height: normal;
            padding: 15px 23px 14px;
            text-decoration: none;
            top: 5px;
            width: auto;
            z-index: 100000;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        /* Focus styles for keyboard navigation */
        a:focus,
        button:focus,
        input:focus,
        textarea:focus,
        select:focus,
        [tabindex="0"]:focus {
            outline: 2px solid #0085ff;
            outline-offset: 2px;
        }
        
        /* Skip link styling when focused */
        .skip-link.screen-reader-text:focus {
            margin: 0;
        }
    ';
    
    wp_add_inline_style('dark-theme-simplicity-style', $styles);
}
add_action('wp_enqueue_scripts', 'dark_theme_simplicity_accessibility_styles', 20);

/**
 * Add aria-label to read more links
 */
function dark_theme_simplicity_accessible_read_more_link($link) {
    // Get the post title
    $post_title = get_the_title();
    
    // Replace the default "Read more" text with an accessible version
    return str_replace(
        'Read more',
        sprintf(
            '<span class="screen-reader-text">%s </span>%s<span class="screen-reader-text"> %s</span>',
            __('Read more about', 'dark-theme-simplicity'),
            __('Read more', 'dark-theme-simplicity'),
            $post_title
        ),
        $link
    );
}
add_filter('the_content_more_link', 'dark_theme_simplicity_accessible_read_more_link');

/**
 * Add focus handling for keyboard navigation
 */
function dark_theme_simplicity_keyboard_navigation_js() {
    // Only load the script if user is not on a touch device
    $script = "
        (function() {
            // Add a class to indicate keyboard navigation
            var isUsingKeyboard = false;
            
            window.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    isUsingKeyboard = true;
                    document.body.classList.add('is-using-keyboard');
                }
            });
            
            window.addEventListener('mousedown', function() {
                isUsingKeyboard = false;
                document.body.classList.remove('is-using-keyboard');
            });
            
            // Make dropdown menus accessible via keyboard
            var menuItems = document.querySelectorAll('.menu-item-has-children > a');
            
            menuItems.forEach(function(menuItem) {
                menuItem.setAttribute('aria-expanded', 'false');
                
                menuItem.addEventListener('click', function(event) {
                    var expanded = this.getAttribute('aria-expanded') === 'true';
                    this.setAttribute('aria-expanded', !expanded);
                });
            });
        })();
    ";
    
    wp_add_inline_script('dark-theme-simplicity-script', $script);
}
add_action('wp_enqueue_scripts', 'dark_theme_simplicity_keyboard_navigation_js');

/**
 * Add language attributes to HTML tag
 */
function dark_theme_simplicity_language_attributes() {
    add_filter('language_attributes', function($output) {
        return $output . ' class="no-js"';
    });
}
add_action('after_setup_theme', 'dark_theme_simplicity_language_attributes');

/**
 * Remove 'no-js' class from HTML element when JavaScript is available
 */
function dark_theme_simplicity_js_detection() {
    $script = "document.documentElement.className = document.documentElement.className.replace('no-js', 'js');";
    wp_add_inline_script('dark-theme-simplicity-script', $script, 'before');
}
add_action('wp_enqueue_scripts', 'dark_theme_simplicity_js_detection', 5); 