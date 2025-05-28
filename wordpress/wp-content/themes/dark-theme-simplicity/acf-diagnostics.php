<?php
/**
 * Template Name: ACF Diagnostics
 * 
 * This template provides diagnostic information about ACF and options pages.
 */

// Secure direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header(); 
?>

<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6 text-white">ACF Diagnostics</h1>
    
    <div class="bg-dark-300 p-6 rounded-lg mb-8">
        <h2 class="text-2xl font-bold mb-4 text-white">ACF Status</h2>
        
        <div class="grid grid-cols-1 gap-4">
            <div class="p-4 bg-dark-400 rounded-lg">
                <h3 class="text-xl font-semibold mb-2 text-white">ACF Plugin</h3>
                <p class="text-light-100">
                    <strong>ACF Function Exists:</strong> 
                    <?php echo function_exists('acf_add_options_page') ? '<span class="text-green-500">Yes</span>' : '<span class="text-red-500">No</span>'; ?>
                </p>
                <p class="text-light-100">
                    <strong>ACF Version:</strong> 
                    <?php echo function_exists('acf') ? acf()->version : 'Not detected'; ?>
                </p>
                <p class="text-light-100">
                    <strong>ACF Plugin Active:</strong>
                    <?php 
                    if (!function_exists('is_plugin_active')) {
                        include_once ABSPATH . 'wp-admin/includes/plugin.php';
                    }
                    echo is_plugin_active('advanced-custom-fields/acf.php') ? '<span class="text-green-500">Yes (Free)</span>' : '<span>No</span>'; 
                    echo is_plugin_active('advanced-custom-fields-pro/acf.php') ? '<span class="text-green-500">Yes (Pro)</span>' : ''; 
                    ?>
                </p>
            </div>
            
            <div class="p-4 bg-dark-400 rounded-lg">
                <h3 class="text-xl font-semibold mb-2 text-white">Options Pages</h3>
                <?php 
                if (function_exists('acf_get_options_pages')) {
                    $options_pages = acf_get_options_pages();
                    if (!empty($options_pages)) {
                        echo '<ul class="list-disc pl-5 text-light-100">';
                        foreach ($options_pages as $page) {
                            echo '<li><strong>' . $page['menu_title'] . '</strong> (slug: ' . $page['menu_slug'] . ')</li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<p class="text-red-500">No options pages registered.</p>';
                    }
                } else {
                    echo '<p class="text-red-500">acf_get_options_pages() function not available.</p>';
                }
                ?>
            </div>
            
            <div class="p-4 bg-dark-400 rounded-lg">
                <h3 class="text-xl font-semibold mb-2 text-white">Field Groups</h3>
                <?php 
                $field_groups = function_exists('acf_get_field_groups') ? acf_get_field_groups() : array();
                if (!empty($field_groups)) {
                    echo '<ul class="list-disc pl-5 text-light-100">';
                    foreach ($field_groups as $group) {
                        echo '<li><strong>' . $group['title'] . '</strong> (key: ' . $group['key'] . ')</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p class="text-red-500">No field groups found.</p>';
                }
                ?>
            </div>
        </div>
    </div>
    
    <div class="bg-dark-300 p-6 rounded-lg mb-8">
        <h2 class="text-2xl font-bold mb-4 text-white">WordPress Environment</h2>
        
        <div class="grid grid-cols-1 gap-4">
            <div class="p-4 bg-dark-400 rounded-lg">
                <h3 class="text-xl font-semibold mb-2 text-white">Current User</h3>
                <?php 
                $current_user = wp_get_current_user();
                $roles = ( array ) $current_user->roles;
                ?>
                <p class="text-light-100"><strong>Username:</strong> <?php echo $current_user->user_login; ?></p>
                <p class="text-light-100"><strong>Roles:</strong> <?php echo implode(', ', $roles); ?></p>
                <p class="text-light-100">
                    <strong>Can edit_posts:</strong> 
                    <?php echo current_user_can('edit_posts') ? '<span class="text-green-500">Yes</span>' : '<span class="text-red-500">No</span>'; ?>
                </p>
            </div>
            
            <div class="p-4 bg-dark-400 rounded-lg">
                <h3 class="text-xl font-semibold mb-2 text-white">Hooks Status</h3>
                <p class="text-light-100">
                    <strong>Admin Menu Already Fired:</strong> 
                    <?php echo did_action('admin_menu') ? '<span class="text-green-500">Yes</span>' : '<span class="text-yellow-500">No</span>'; ?>
                </p>
                <p class="text-light-100">
                    <strong>Admin Init Already Fired:</strong> 
                    <?php echo did_action('admin_init') ? '<span class="text-green-500">Yes</span>' : '<span class="text-yellow-500">No</span>'; ?>
                </p>
                <p class="text-light-100">
                    <strong>ACF Init Already Fired:</strong> 
                    <?php echo did_action('acf/init') ? '<span class="text-green-500">Yes</span>' : '<span class="text-yellow-500">No</span>'; ?>
                </p>
            </div>
        </div>
    </div>
    
    <div class="bg-dark-300 p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-4 text-white">Force ACF Registration</h2>
        <p class="text-light-100 mb-4">Click the button below to manually try registering the ACF options page:</p>
        
        <?php
        // Register options page immediately if button is clicked
        if (isset($_GET['register_acf']) && $_GET['register_acf'] == '1') {
            if (function_exists('acf_add_options_page')) {
                acf_add_options_page(array(
                    'page_title'    => 'Home Page Settings',
                    'menu_title'    => 'Home Page',
                    'menu_slug'     => 'home-page-settings',
                    'capability'    => 'edit_posts',
                    'icon_url'      => 'dashicons-admin-home',
                    'position'      => 59,
                    'redirect'      => false
                ));
                echo '<div class="bg-green-500/20 border-l-4 border-green-500 p-4 mb-4 text-white">Options page registration attempted. Please check the WordPress admin menu.</div>';
            } else {
                echo '<div class="bg-red-500/20 border-l-4 border-red-500 p-4 mb-4 text-white">Error: ACF functions not available. Make sure the ACF plugin is activated.</div>';
            }
        }
        ?>
        
        <a href="?register_acf=1" class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Force Register Options Page</a>
    </div>
</div>

<?php get_footer(); ?> 