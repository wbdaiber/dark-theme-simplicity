<?php
/**
 * Enhanced WordPress Debug Configuration
 * 
 * Include this file in your wp-config.php before the "That's all, stop editing!" line:
 * 
 * // Include debug settings
 * if (file_exists(dirname(__FILE__) . '/wp-config-debug.php')) {
 *     require_once dirname(__FILE__) . '/wp-config-debug.php';
 * }
 */

// Enable debugging
define('WP_DEBUG', true);

// Enable debug logging to /wp-content/debug.log
define('WP_DEBUG_LOG', true);

// Disable display of errors on the site (log only)
define('WP_DEBUG_DISPLAY', false);

// Disable the fatal error handler to show actual errors
define('WP_DISABLE_FATAL_ERROR_HANDLER', true);

// Enable script debugging (use dev versions of core JS/CSS)
define('SCRIPT_DEBUG', true);

// Save database queries to debug.log
define('SAVEQUERIES', true);

// Disable concatenating scripts
define('CONCATENATE_SCRIPTS', false);

// Log PHP errors to debug.log
@ini_set('log_errors', 1);
@ini_set('error_log', dirname(__FILE__) . '/wp-content/debug.log');

// Disable display_errors in production, but enable for debugging
@ini_set('display_errors', 0);
@ini_set('display_startup_errors', 0);

// Set error reporting level to catch everything except notices and deprecated
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

// Increase memory limits for debugging
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// Increase PHP memory limit
@ini_set('memory_limit', '256M');

// Increase max execution time
@ini_set('max_execution_time', 300);

// Disable post revisions to reduce database clutter during debugging
define('WP_POST_REVISIONS', false);

// Disable automatic updates while debugging
define('AUTOMATIC_UPDATER_DISABLED', true);

// Disable file editing for security
define('DISALLOW_FILE_EDIT', true);

// Enable direct filesystem method for plugins/themes installation
define('FS_METHOD', 'direct');

// Set debug mode for WordPress database class
global $wpdb;
if (isset($wpdb)) {
    $wpdb->show_errors();
    $wpdb->suppress_errors = false;
}

// For local development/debugging environment only
if (isset($_SERVER['REMOTE_ADDR']) && in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    // Set development domain for proper URL handling
    if (!defined('WP_SITEURL') && isset($_SERVER['HTTP_HOST'])) {
        define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);
        define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
    }
    
    // Enable error display for local development only
    @ini_set('display_errors', 1);
    @ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} 