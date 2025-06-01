<?php
/**
 * Theme Debug Test
 * Place this file in your theme's root directory and access via browser
 */

// Basic PHP error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Dark Theme Simplicity Debug Test</h1>";

// Test 1: Check if WordPress is available
if (!function_exists('add_action')) {
    echo "<p style='color: red;'>❌ WordPress not loaded. Run this from within WordPress.</p>";
    exit;
}

echo "<p style='color: green;'>✅ WordPress is loaded</p>";

// Test 2: Check theme files exist
$theme_files = [
    'functions.php',
    'index.php',
    'style.css',
    'inc/customizer.php',
    'inc/customizer-setup.php',
    'inc/admin.php',
    'inc/enqueue.php',
    'page.php',
    'sidebar.php'
];

foreach ($theme_files as $file) {
    $path = get_template_directory() . '/' . $file;
    if (file_exists($path)) {
        echo "<p style='color: green;'>✅ {$file} exists</p>";
    } else {
        echo "<p style='color: red;'>❌ {$file} missing</p>";
    }
}

// Test 3: Check for function conflicts
$functions_to_check = [
    'dark_theme_simplicity_sanitize_yes_no',
    'dark_theme_simplicity_customize_register',
    'dark_theme_simplicity_add_page_meta_boxes',
    'dark_theme_simplicity_save_page_settings',
    'dark_theme_simplicity_default_show_widgets'
];

foreach ($functions_to_check as $func) {
    if (function_exists($func)) {
        echo "<p style='color: green;'>✅ Function {$func} exists</p>";
        
        // Check for duplicate function declarations
        try {
            // Get reflection for the function to find file location
            $reflection = new ReflectionFunction($func);
            $file_location = $reflection->getFileName();
            $start_line = $reflection->getStartLine();
            echo "<p>📍 Function {$func} defined in {$file_location}:{$start_line}</p>";
            
            // Check if function is defined in multiple files
            $grep_command = "grep -l 'function {$func}' " . get_template_directory() . "/*.php " . get_template_directory() . "/inc/*.php 2>/dev/null";
            $files_with_function = shell_exec($grep_command);
            
            if ($files_with_function) {
                $files_array = explode("\n", trim($files_with_function));
                if (count($files_array) > 1) {
                    echo "<p style='color: red;'>❌ WARNING: Function {$func} appears to be defined in multiple files:</p><ul>";
                    foreach ($files_array as $file) {
                        if (!empty($file)) {
                            echo "<li style='color: red;'>{$file}</li>";
                        }
                    }
                    echo "</ul>";
                }
            }
        } catch (Exception $e) {
            echo "<p style='color: orange;'>⚠️ Could not analyze function {$func}: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color: orange;'>⚠️ Function {$func} not found</p>";
    }
}

// Test 4: Memory usage
$memory_usage = memory_get_usage(true);
$memory_limit = ini_get('memory_limit');
echo "<p>💾 Memory Usage: " . number_format($memory_usage / 1024 / 1024, 2) . " MB</p>";
echo "<p>💾 Memory Limit: {$memory_limit}</p>";

// Test 5: Check PHP and WordPress versions
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>WordPress Version: " . get_bloginfo('version') . "</p>";

// Test 6: Check theme hooks
echo "<h2>Theme Hook Tests:</h2>";

// Test customizer hooks
$customize_hooks = [
    'customize_register',
    'customize_controls_enqueue_scripts',
    'wp_head'
];

echo "<p>Testing active hooks...</p>";
foreach ($customize_hooks as $hook) {
    $has_callbacks = has_action($hook);
    if ($has_callbacks !== false) {
        echo "<p style='color: green;'>✅ Hook '{$hook}' has callbacks attached</p>";
    } else {
        echo "<p style='color: orange;'>⚠️ Hook '{$hook}' has no callbacks</p>";
    }
}

// Theme directory contents
echo "<h2>Theme Directory Structure:</h2>";
$theme_dir = get_template_directory();

// Define the function before using it
if (!function_exists('list_directory_contents')) {
    function list_directory_contents($dir, $indent = 0) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $path = $dir . '/' . $file;
                echo str_repeat('&nbsp;', $indent * 4) . "├── {$file}";
                
                if (is_dir($path)) {
                    echo " (Directory)<br>";
                    list_directory_contents($path, $indent + 1);
                } else {
                    echo "<br>";
                }
            }
        }
    }
}

// Now call the function
list_directory_contents($theme_dir);

// Check for file encoding issues
echo "<h2>File Encoding Checks:</h2>";

// Define the function before using it
function check_file_encoding($path) {
    $content = file_get_contents($path);
    
    // Check for BOM
    if (substr($content, 0, 3) === "\xEF\xBB\xBF") {
        echo "<p style='color: red;'>❌ BOM detected in {$path} - remove UTF-8 BOM</p>";
    }
    
    // Check for whitespace before <?php
    if (preg_match('/^\s+<\?php/', $content)) {
        echo "<p style='color: red;'>❌ Whitespace before opening PHP tag in {$path}</p>";
    }
    
    // Check for whitespace after ?>
    if (preg_match('/\?>\s+$/', $content)) {
        echo "<p style='color: red;'>❌ Whitespace after closing PHP tag in {$path}</p>";
    }
}

// Check main PHP files
$files_to_check = [
    'functions.php',
    'inc/customizer.php',
    'inc/customizer-setup.php',
    'inc/admin.php'
];

foreach ($files_to_check as $file) {
    $path = $theme_dir . '/' . $file;
    if (file_exists($path)) {
        check_file_encoding($path);
    }
}

// Final summary
echo "<h2>Debug Summary:</h2>";
echo "<p>If you're seeing 'WordPress not loaded' errors, make sure to access this file through WordPress.</p>";
echo "<p>Check for any red ❌ items above - these need attention.</p>";
echo "<p>Pay special attention to duplicate function definitions - these often cause fatal errors.</p>";
echo "<p>Review file encoding issues, especially in customizer files.</p>"; 