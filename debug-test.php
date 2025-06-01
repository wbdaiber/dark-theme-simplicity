<?php
/**
 * Dark Theme Simplicity Debug Test
 * This file tests each include to identify fatal errors
 */

define('WP_DEBUG', true);

// Bootstrap WordPress
require_once dirname(__FILE__) . '/../../../wp-load.php';

echo "<h1>Dark Theme Simplicity Debug Test</h1>";
echo "<pre style='background:#f5f5f5; padding:15px; border:1px solid #ddd;'>";
echo "Testing includes...\n\n";

try {
    require_once get_template_directory() . '/inc/enqueue.php';
    echo "✓ enqueue.php loaded successfully\n";
} catch (Throwable $e) {
    echo "✗ Error in enqueue.php: " . $e->getMessage() . "\n";
}

try {
    require_once get_template_directory() . '/inc/admin.php';
    echo "✓ admin.php loaded successfully\n";
} catch (Throwable $e) {
    echo "✗ Error in admin.php: " . $e->getMessage() . "\n";
}

try {
    require_once get_template_directory() . '/inc/customizer-setup.php';
    echo "✓ customizer-setup.php loaded successfully\n";
} catch (Throwable $e) {
    echo "✗ Error in customizer-setup.php: " . $e->getMessage() . "\n";
}

try {
    require_once get_template_directory() . '/inc/customizer.php';
    echo "✓ customizer.php loaded successfully\n";
} catch (Throwable $e) {
    echo "✗ Error in customizer.php: " . $e->getMessage() . "\n";
}

try {
    require_once get_template_directory() . '/inc/accessibility.php';
    echo "✓ accessibility.php loaded successfully\n";
} catch (Throwable $e) {
    echo "✗ Error in accessibility.php: " . $e->getMessage() . "\n";
}

echo "\nChecking for duplicate function definitions...\n\n";

$functions_to_check = [
    'dark_theme_simplicity_customize_register',
    'dark_theme_simplicity_default_show_widgets',
    'dark_theme_simplicity_sanitize_checkbox',
    'dark_theme_simplicity_sanitize_yes_no',
    'dark_theme_simplicity_add_post_settings_meta_box',
    'dark_theme_simplicity_save_post_settings_meta'
];

foreach ($functions_to_check as $function) {
    if (function_exists($function)) {
        echo "Function '$function' exists\n";
        
        // Try to find all files where this function is defined
        $search_result = shell_exec('grep -l "function ' . $function . '" ' . get_template_directory() . '/*.php ' . get_template_directory() . '/inc/*.php 2>/dev/null');
        if ($search_result) {
            echo "  Found in files:\n  " . str_replace("\n", "\n  ", $search_result) . "\n";
        }
    } else {
        echo "Function '$function' does not exist\n";
    }
}

echo "</pre>"; 