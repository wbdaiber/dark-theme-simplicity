<?php
/**
 * WordPress Debug Configuration
 * 
 * Instructions:
 * 1. Copy this file to your WordPress root directory
 * 2. Add the following code to your wp-config.php before "That's all, stop editing!" line:
 *    require_once(__DIR__ . '/wp-debug-config.php');
 */

// Enable WordPress debug mode
define('WP_DEBUG', true);

// Log errors to a file (wp-content/debug.log)
define('WP_DEBUG_LOG', true);

// Display errors on the website (set to true for development, false for production)
define('WP_DEBUG_DISPLAY', true);

// Disable WordPress fatal error handler to show the actual PHP fatal error
define('WP_DISABLE_FATAL_ERROR_HANDLER', true);

// Enable script debugging
define('SCRIPT_DEBUG', true);

// Save database queries to debug.log
define('SAVEQUERIES', true);

// Disable concatenating scripts
define('CONCATENATE_SCRIPTS', false);

// Increase memory limits
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// PHP error settings
@ini_set('display_errors', 1);
@ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log PHP errors to debug.log
@ini_set('log_errors', 1);
@ini_set('error_log', dirname(__FILE__) . '/wp-content/debug.log');

// Increase max execution time
@ini_set('max_execution_time', 300);

// Provide clear information on screen if errors occur
echo "<!-- WordPress Debug Mode Enabled -->"; 