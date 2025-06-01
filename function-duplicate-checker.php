<?php
/**
 * Function Duplicate Checker
 * 
 * This script helps identify duplicate function definitions in WordPress themes.
 * Place it in your theme directory and run it from the browser.
 */

// Only run in development environment
if (!WP_DEBUG || php_sapi_name() !== 'cli-server') {
    die('This script should only be run in a development environment with WP_DEBUG enabled');
}

// Directory to scan (current directory)
$directory = __DIR__;

// Functions to look for
$functions_to_check = [
    'dark_theme_simplicity_sanitize_yes_no',
    'dark_theme_simplicity_sanitize_checkbox',
    'dark_theme_simplicity_sanitize_repeater',
    'dark_theme_simplicity_customize_register',
    'dark_theme_simplicity_customizer_css',
    'dark_theme_simplicity_sanitize_font_weight',
    'dark_theme_simplicity_sanitize_rgba'
];

// Store found functions
$found_functions = [];

// Helper function to scan PHP files for function definitions
function scan_file_for_functions($file, $functions_to_check) {
    $results = [];
    $content = file_get_contents($file);
    
    foreach ($functions_to_check as $function) {
        // Look for function definition
        if (preg_match('/function\s+' . preg_quote($function) . '\s*\(/i', $content)) {
            $results[] = $function;
        }
    }
    
    return $results;
}

// Recursive directory iterator
$directory_iterator = new RecursiveDirectoryIterator($directory);
$iterator = new RecursiveIteratorIterator($directory_iterator);
$regex = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

// Scan all PHP files
foreach ($regex as $file) {
    $file_path = $file[0];
    
    // Skip the checker script itself
    if (basename($file_path) === basename(__FILE__)) {
        continue;
    }
    
    $file_functions = scan_file_for_functions($file_path, $functions_to_check);
    
    if (!empty($file_functions)) {
        foreach ($file_functions as $function) {
            if (!isset($found_functions[$function])) {
                $found_functions[$function] = [];
            }
            $found_functions[$function][] = str_replace($directory, '', $file_path);
        }
    }
}

// Output results
echo '<h1>Function Duplicate Checker Results</h1>';
echo '<table style="border-collapse: collapse; width: 100%;">';
echo '<tr style="background-color: #f2f2f2;">';
echo '<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Function Name</th>';
echo '<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Found In</th>';
echo '<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Status</th>';
echo '</tr>';

foreach ($functions_to_check as $function) {
    echo '<tr>';
    echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($function) . '</td>';
    
    if (isset($found_functions[$function])) {
        $files = $found_functions[$function];
        echo '<td style="border: 1px solid #ddd; padding: 8px;">' . implode('<br>', array_map('htmlspecialchars', $files)) . '</td>';
        
        // Highlight duplicates
        if (count($files) > 1) {
            echo '<td style="border: 1px solid #ddd; padding: 8px; background-color: #ffdddd;"><strong>DUPLICATE</strong></td>';
        } else {
            echo '<td style="border: 1px solid #ddd; padding: 8px; background-color: #ddffdd;">OK</td>';
        }
    } else {
        echo '<td style="border: 1px solid #ddd; padding: 8px;">Not found</td>';
        echo '<td style="border: 1px solid #ddd; padding: 8px; background-color: #ffffdd;">MISSING</td>';
    }
    
    echo '</tr>';
}

echo '</table>';

// Provide fix suggestions
echo '<h2>Fix Suggestions</h2>';

foreach ($found_functions as $function => $files) {
    if (count($files) > 1) {
        echo '<div style="margin-bottom: 20px;">';
        echo '<h3>Fix for ' . htmlspecialchars($function) . '</h3>';
        echo '<p>This function is defined in multiple files:</p>';
        echo '<ul>';
        
        foreach ($files as $file) {
            echo '<li>' . htmlspecialchars($file) . '</li>';
        }
        
        echo '</ul>';
        echo '<p>Suggested fix:</p>';
        echo '<ol>';
        echo '<li>Keep the definition in ONE file (preferably in inc/customizer-setup.php)</li>';
        echo '<li>In all other files, wrap the function with:<br>';
        echo '<pre>if (!function_exists(\'' . htmlspecialchars($function) . '\')) {
    function ' . htmlspecialchars($function) . '(...) {
        // Function code
    }
}</pre></li>';
        echo '</ol>';
        echo '</div>';
    }
}
?> 