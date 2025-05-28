<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Dark_Theme_Simplicity
 */

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