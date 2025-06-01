# Dark Theme Simplicity - Debugging Guide

This document provides step-by-step instructions for troubleshooting fatal errors and functionality issues in the Dark Theme Simplicity WordPress theme.

## Common Fatal Error Causes

1. **Duplicate Function Definitions**: Two files defining the same function
2. **Missing Required Files**: Referenced files not found in expected locations
3. **Customizer Settings Conflicts**: Duplicate theme mods or settings
4. **Syntax Errors**: Missing semicolons, brackets, or quotes
5. **PHP Version Compatibility**: Using functions not available in the host's PHP version

## Troubleshooting Process

### 1. Enable WordPress Debug Mode

Add the following to your `wp-config.php` file (before the "That's all, stop editing!" comment):

```php
// For full debugging (with display)
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
define('SCRIPT_DEBUG', true);

// OR copy the included wp-config-debug.php file to your WordPress root
// and add this line to wp-config.php:
// require_once dirname(__FILE__) . '/wp-config-debug.php';
```

### 2. Check Debug Log

After enabling debug mode, check for errors in:
- `/wp-content/debug.log`
- Your server's error log (in cPanel or hosting control panel)

### 3. Use the Debug Test Script

Upload the included `debug-test.php` file to your theme directory and access it via browser:
`https://your-site.com/wp-content/themes/dark-theme-simplicity/debug-test.php`

This script will:
- Test each include file individually
- Report any errors encountered
- Check for duplicate function definitions

### 4. Common Issues and Fixes

#### Meta Box Display Issues

If the page meta boxes aren't appearing:
1. Ensure `inc/admin.php` is being loaded
2. Check that the meta box functions have unique names
3. Verify the meta box is registered for the correct post type

#### Sidebar Widget Visibility Issues

If sidebar widgets aren't toggling correctly:
1. Check that the theme mod `dark_theme_simplicity_default_show_widgets` exists
2. Verify the meta values are being properly saved and retrieved
3. Ensure the sidebar is properly registered in `functions.php`

#### Customizer Settings Issues

If customizer settings aren't working or causing errors:
1. Check for duplicate setting definitions in `customizer.php`
2. Verify proper sanitization callbacks are in place
3. Ensure the setting is being properly referenced in templates

### 5. File-by-File Troubleshooting

If you're still encountering issues, try this systematic approach:

1. Rename `functions.php` to `functions.php.bak`
2. Create a minimal `functions.php`:
   ```php
   <?php
   // Minimal functions file
   function dark_theme_simplicity_setup() {
       add_theme_support('title-tag');
       add_theme_support('post-thumbnails');
   }
   add_action('after_setup_theme', 'dark_theme_simplicity_setup');
   ```

3. Verify the theme loads without errors
4. Incrementally add back functionality, testing after each addition:
   - Add widget registration
   - Add one include file at a time
   - Add custom walkers
   - Add helper functions

### 6. Key Files and Their Purpose

- **functions.php**: Core theme setup and includes
- **inc/admin.php**: Admin screens, meta boxes, notices
- **inc/customizer-setup.php**: Customizer configuration
- **inc/customizer.php**: Customizer settings and controls
- **inc/enqueue.php**: Script/style registration and enqueuing
- **inc/accessibility.php**: Accessibility enhancements

## Advanced Debugging Techniques

### Using Debug Bar Plugin

Install and activate the Debug Bar plugin to gain insights into:
- Database queries
- Hook usage
- Template parts
- PHP warnings not visible in the UI

### Using Query Monitor

Install and activate Query Monitor for deeper insights into:
- Slow queries
- Hook execution order
- Template loading hierarchy
- Conditional function usage

## Recovery Procedure

If you're unable to resolve the issues, you can:

1. Activate a default WordPress theme (Twenty Twenty-Three)
2. Make a backup of your current theme
3. Download a fresh copy of Dark Theme Simplicity
4. Upload it to your themes directory with a different folder name
5. Activate the fresh copy
6. Gradually port your customizations to the fresh copy

## Support Resources

- WordPress Debugging Documentation: https://wordpress.org/documentation/article/debugging-in-wordpress/
- WordPress Theme Handbook: https://developer.wordpress.org/themes/
- WordPress Function Reference: https://developer.wordpress.org/reference/
- WordPress Support Forums: https://wordpress.org/support/ 