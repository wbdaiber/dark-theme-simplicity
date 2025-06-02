<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Dark_Theme_Simplicity
 */

// Use direct value for debugging
$show_widgets = true;

if (is_singular()) {
    // Get the direct value without conversion for debugging
    $raw_setting = get_post_meta(get_the_ID(), '_show_sidebar_widgets', true);
    
    // For debugging, let's add a comment
    // error_log('Dark Theme: Sidebar widget setting: ' . $raw_setting);
    
    if ($raw_setting === '') {
        // Use theme default
        $show_sidebar_widgets = get_theme_mod('dark_theme_simplicity_default_show_widgets', 'yes');
        $show_widgets = ($show_sidebar_widgets === 'yes');
    } else {
        // Don't convert from '1'/'0' - use direct string comparison with 'yes'
        $show_widgets = ($raw_setting === 'yes');
    }
}

// Always show for debugging
$show_widgets = true;

// If widgets are disabled, don't show anything
// if (!$show_widgets) {
//     return;
// }

if (is_single() && is_active_sidebar('sidebar-post')) {
    // Single post sidebar
    ?>
    <aside id="secondary" class="widget-area bg-dark-400 p-6 rounded-lg border border-white/10">
        <?php dynamic_sidebar('sidebar-post'); ?>
    </aside>
    <?php
} elseif (is_page() && is_active_sidebar('sidebar-page')) {
    // Page sidebar
    ?>
    <aside id="secondary" class="widget-area bg-dark-400 p-6 rounded-lg border border-white/10">
        <?php dynamic_sidebar('sidebar-page'); ?>
    </aside>
    <?php
} elseif (is_active_sidebar('sidebar-1')) {
    // Default sidebar
    ?>
    <aside id="secondary" class="widget-area bg-dark-400 p-6 rounded-lg border border-white/10">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </aside>
    <?php
}

// For debugging purposes, let's always show the widget areas
?>
<aside id="secondary" class="widget-area bg-dark-400 p-4 rounded-lg border border-white/10 text-sm">
    <?php if (is_single() && is_active_sidebar('sidebar-post')) : ?>
        <?php dynamic_sidebar('sidebar-post'); ?>
    <?php elseif (is_page() && is_active_sidebar('sidebar-page')) : ?>
        <?php dynamic_sidebar('sidebar-page'); ?>
    <?php elseif (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        <div class="widget">
            <div class="widget-title text-sm font-bold mb-2 text-white">No Widgets Found</div>
            <p class="text-light-100/70">Add widgets to the Post Sidebar or Sidebar area in the WordPress dashboard.</p>
        </div>
    <?php endif; ?>
</aside>
?> 