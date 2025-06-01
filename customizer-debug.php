<?php
/**
 * Customizer Debug Tool
 * 
 * This file helps diagnose issues with the WordPress customizer.
 * Upload to your theme directory and access via the browser.
 */

// Basic security check
if (!defined('ABSPATH')) {
    // Load WordPress
    define('WP_USE_THEMES', false);
    require_once('../../../wp-load.php');
}

// Check user capabilities
if (!current_user_can('manage_options')) {
    wp_die('Access denied');
}

// Check nonce if submitted
if (isset($_POST['action']) && $_POST['action'] == 'fix_theme_mods') {
    check_admin_referer('customizer_debug_fix');
    
    // Reset approach items if needed
    if (isset($_POST['reset_approach_items'])) {
        $default_approach_items = array(
            array(
                'title' => '1. Discovery',
                'description' => 'I start by understanding your business, audience, and goals to create a tailored strategy.'
            ),
            array(
                'title' => '2. Strategy Development',
                'description' => 'Based on research and your goals, I develop a content strategy aligned with your business objectives.'
            ),
            array(
                'title' => '3. Implementation',
                'description' => 'I create content that engages your audience and drives the results you\'re looking for.'
            ),
            array(
                'title' => '4. Analysis & Optimization',
                'description' => 'I continuously monitor performance and optimize your content strategy for better results.'
            )
        );
        
        update_option('theme_mods_dark-theme-simplicity', array_merge(
            get_option('theme_mods_dark-theme-simplicity', array()),
            array('dark_theme_simplicity_approach_items' => json_encode($default_approach_items))
        ));
        
        $message = 'Approach items have been reset to default values.';
    }
    
    // Reset section visibility if needed
    if (isset($_POST['reset_section_visibility'])) {
        update_option('theme_mods_dark-theme-simplicity', array_merge(
            get_option('theme_mods_dark-theme-simplicity', array()),
            array(
                'dark_theme_simplicity_show_default_hero' => true,
                'dark_theme_simplicity_show_default_services' => true,
                'dark_theme_simplicity_show_default_benefits' => true,
                'dark_theme_simplicity_show_default_approach' => true,
                'dark_theme_simplicity_show_default_about' => true,
                'dark_theme_simplicity_show_default_contact' => true
            )
        ));
        
        $message = 'Section visibility settings have been reset to default values.';
    }
}

// Get current theme mods
$theme_mods = get_option('theme_mods_dark-theme-simplicity', array());

// Start output
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customizer Debug Tool</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            color: #444;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
            line-height: 1.5;
        }
        h1 {
            color: #23282d;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        h2 {
            margin-top: 30px;
            color: #0073aa;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        th {
            background-color: #0073aa;
            color: white;
        }
        pre {
            background: #f5f5f5;
            padding: 15px;
            overflow: auto;
            max-height: 300px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .btn {
            background-color: #0073aa;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #006291;
        }
        .danger {
            background-color: #dc3545;
        }
        .danger:hover {
            background-color: #bd2130;
        }
    </style>
</head>
<body>
    <h1>Customizer Debug Tool</h1>
    
    <?php if (isset($message)) : ?>
    <div class="message">
        <?php echo esc_html($message); ?>
    </div>
    <?php endif; ?>
    
    <h2>Theme Mods Overview</h2>
    <table>
        <tr>
            <th>Setting</th>
            <th>Value</th>
        </tr>
        <?php 
        // Display section visibility settings
        $visibility_settings = array(
            'dark_theme_simplicity_show_default_hero',
            'dark_theme_simplicity_show_default_services',
            'dark_theme_simplicity_show_default_benefits',
            'dark_theme_simplicity_show_default_approach',
            'dark_theme_simplicity_show_default_about',
            'dark_theme_simplicity_show_default_contact'
        );
        
        foreach ($visibility_settings as $setting) {
            echo '<tr>';
            echo '<td>' . esc_html($setting) . '</td>';
            echo '<td>' . (isset($theme_mods[$setting]) ? var_export($theme_mods[$setting], true) : 'Not set (defaults to true)') . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    
    <h2>Repeater Controls</h2>
    <table>
        <tr>
            <th>Repeater</th>
            <th>Status</th>
        </tr>
        <?php
        $repeater_settings = array(
            'dark_theme_simplicity_service_items' => 'Services',
            'dark_theme_simplicity_benefit_items' => 'Benefits',
            'dark_theme_simplicity_approach_items' => 'Approach'
        );
        
        foreach ($repeater_settings as $setting => $label) {
            echo '<tr>';
            echo '<td>' . esc_html($label) . ' (' . esc_html($setting) . ')</td>';
            
            if (isset($theme_mods[$setting])) {
                $value = $theme_mods[$setting];
                $decoded = json_decode($value, true);
                
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    echo '<td>Valid JSON with ' . count($decoded) . ' items</td>';
                } else {
                    echo '<td style="color: red;">Invalid JSON format: ' . json_last_error_msg() . '</td>';
                }
            } else {
                echo '<td style="color: orange;">Not set (will use default)</td>';
            }
            
            echo '</tr>';
        }
        ?>
    </table>
    
    <h2>Approach Items JSON</h2>
    <pre><?php 
        if (isset($theme_mods['dark_theme_simplicity_approach_items'])) {
            echo htmlspecialchars($theme_mods['dark_theme_simplicity_approach_items']);
        } else {
            echo "Not set";
        }
    ?></pre>
    
    <h2>Fix Options</h2>
    <form method="post" action="">
        <?php wp_nonce_field('customizer_debug_fix'); ?>
        <input type="hidden" name="action" value="fix_theme_mods">
        
        <p>
            <button type="submit" name="reset_approach_items" class="btn">Reset Approach Items to Default</button>
            <button type="submit" name="reset_section_visibility" class="btn">Reset Section Visibility</button>
        </p>
    </form>
    
    <h2>Theme Functions Status</h2>
    <table>
        <tr>
            <th>Function</th>
            <th>Status</th>
        </tr>
        <?php
        $functions = array(
            'dark_theme_simplicity_sanitize_yes_no',
            'dark_theme_simplicity_sanitize_checkbox',
            'dark_theme_simplicity_sanitize_repeater',
            'dark_theme_simplicity_customize_register',
            'dark_theme_simplicity_customizer_css'
        );
        
        foreach ($functions as $function) {
            echo '<tr>';
            echo '<td>' . esc_html($function) . '</td>';
            echo '<td>' . (function_exists($function) ? '<span style="color: green;">Available</span>' : '<span style="color: red;">Not defined</span>') . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    
    <h2>Template Parts</h2>
    <table>
        <tr>
            <th>Template Part</th>
            <th>Status</th>
        </tr>
        <?php
        $template_parts = array(
            'section-services.php',
            'section-benefits.php',
            'section-approach.php',
            'section-about.php',
            'section-contact.php'
        );
        
        foreach ($template_parts as $part) {
            $file = get_template_directory() . '/template-parts/homepage/' . $part;
            echo '<tr>';
            echo '<td>' . esc_html($part) . '</td>';
            echo '<td>' . (file_exists($file) ? '<span style="color: green;">Exists</span>' : '<span style="color: red;">Missing</span>') . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    
    <p><a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="btn">Go to Customizer</a></p>
</body>
</html> 