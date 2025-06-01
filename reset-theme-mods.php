<?php
/**
 * Dark Theme Simplicity - Theme Mods Reset Script
 *
 * This file resets theme mods to default values to recover from critical issues.
 * IMPORTANT: Delete this file after use for security reasons.
 */

// Define ABSPATH if not defined (when running directly)
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
    require_once(ABSPATH . 'wp-load.php');
}

// Only allow admin access
if (!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
}

// Check for reset action
$message = '';
if (isset($_POST['action']) && $_POST['action'] === 'reset_theme_mods') {
    if (isset($_POST['reset_all'])) {
        // Delete all theme mods
        remove_theme_mods();
        $message = 'All theme mods have been reset.';
    } elseif (isset($_POST['reset_sections'])) {
        // Reset only section visibility settings
        $theme_mods = get_theme_mods();
        
        // Reset section visibility
        $sections = ['about', 'approach', 'benefits', 'services', 'contact'];
        foreach ($sections as $section) {
            set_theme_mod($section . '_section_enable', true);
        }
        
        // Set default approach items
        $default_approach_items = array(
            array(
                'title' => '1. Discovery',
                'description' => 'We start by understanding your business, audience, and goals to create a tailored strategy.'
            ),
            array(
                'title' => '2. Strategy Development',
                'description' => 'Based on research and your goals, we develop a content strategy aligned with your business objectives.'
            ),
            array(
                'title' => '3. Implementation',
                'description' => 'We create content that engages your audience and drives the results you\'re looking for.'
            ),
            array(
                'title' => '4. Analysis & Optimization',
                'description' => 'We continuously monitor performance and optimize your content strategy for better results.'
            )
        );
        
        set_theme_mod('approach_items', json_encode($default_approach_items));
        
        $message = 'Homepage section settings have been reset.';
    }
}

// Get current theme mods
$theme_mods = get_theme_mods();

// Display the page
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dark Theme Simplicity - Reset Theme Mods</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            color: #444;
            max-width: 800px;
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
        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .warning {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
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
        .btn {
            background-color: #0073aa;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }
        .btn:hover {
            background-color: #006291;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #bd2130;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>
    <h1>Dark Theme Simplicity - Reset Theme Mods</h1>
    
    <div class="warning">
        <strong>Warning:</strong> This tool will reset your theme customizations. Please use with caution.
        <br><strong>Important:</strong> Delete this file after use for security reasons.
    </div>
    
    <?php if (!empty($message)): ?>
    <div class="message">
        <?php echo esc_html($message); ?>
    </div>
    <?php endif; ?>
    
    <h2>Reset Options</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="reset_theme_mods">
        
        <p>
            <button type="submit" name="reset_sections" class="btn btn-warning">Reset Homepage Sections</button>
            <button type="submit" name="reset_all" class="btn btn-danger" onclick="return confirm('Are you sure you want to reset ALL theme customizations? This cannot be undone.');">Reset ALL Theme Mods</button>
        </p>
    </form>
    
    <h2>Current Homepage Section Settings</h2>
    <table>
        <tr>
            <th>Setting</th>
            <th>Value</th>
        </tr>
        <?php
        $sections = ['about', 'approach', 'benefits', 'services', 'contact'];
        
        foreach ($sections as $section) {
            $key = $section . '_section_enable';
            echo '<tr>';
            echo '<td>' . esc_html($key) . '</td>';
            echo '<td>' . (isset($theme_mods[$key]) ? var_export($theme_mods[$key], true) : 'Not set (defaults to true)') . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    
    <h2>Approach Items Setting</h2>
    <pre style="background: #f5f5f5; padding: 15px; overflow: auto; max-height: 200px;"><?php 
        if (isset($theme_mods['approach_items'])) {
            echo htmlspecialchars($theme_mods['approach_items']);
        } else {
            echo "Not set";
        }
    ?></pre>
    
    <p><a href="<?php echo esc_url(admin_url()); ?>" class="btn">Return to Dashboard</a></p>
    
    <div class="warning" style="margin-top: 20px;">
        <strong>Remember:</strong> Delete this file after use for security reasons.
    </div>
</body>
</html> 