# Dark Theme Simplicity - Fixes & Troubleshooting

This document explains the fixes applied to the Dark Theme Simplicity WordPress theme and provides instructions for setting up and troubleshooting.

## Overview of Fixes

We've made several critical fixes to resolve fatal errors and improve the theme's functionality:

1. **Meta Box System Rewrite**: Completely rewrote the page settings meta box system to fix duplicate function issues
2. **Customizer Settings Fix**: Fixed duplicate theme mod settings that were causing conflicts
3. **Template Updates**: Updated page.php and sidebar.php to properly handle widget visibility toggles
4. **Functions Cleanup**: Simplified functions.php and removed redundant code
5. **Data Format Standardization**: Standardized how meta values are stored and retrieved

For a detailed breakdown of all changes, see [theme-fixes-summary.md](theme-fixes-summary.md).

## Quick Setup

### Option 1: Local Docker Setup

The easiest way to test the theme is using Docker:

```bash
# Start the Docker containers
docker-compose up -d

# Access WordPress at http://localhost:8000
# Access phpMyAdmin at http://localhost:8080 (username: wordpress, password: wordpress)
```

### Option 2: Traditional WordPress Installation

1. Copy the theme to your WordPress themes directory: `/wp-content/themes/dark-theme-simplicity`
2. Enable debugging by copying `wp-config-debug.php` content to your `wp-config.php`
3. Activate the theme through the WordPress admin panel

## Troubleshooting Guide

If you encounter issues, follow these steps:

1. **Enable Debugging**: 
   - Add the debugging code from `wp-config-debug.php` to your `wp-config.php`
   - Check `/wp-content/debug.log` for error messages

2. **Run the Test Script**:
   ```bash
   cd /path/to/dark-theme-simplicity
   chmod +x test-theme.sh
   ./test-theme.sh
   ```

3. **Test Individual Files**:
   - Access `debug-test.php` via your browser
   - The script will test each include file and report errors

4. **Check for File Conflicts**:
   - Look for duplicate function definitions
   - Verify file permissions (should be 644 for files and 755 for directories)

5. **Theme Structure Verification**:
   - Main theme files: functions.php, page.php, sidebar.php, etc.
   - Include files in `/inc/`: admin.php, customizer.php, etc.
   - Style files in `/css/`: blog-accessibility.css, etc.

For a comprehensive troubleshooting guide, see [debugging-guide.md](debugging-guide.md).

## Key Files and Their Purpose

- **page.php**: Main page template with widget visibility logic
- **sidebar.php**: Sidebar template that respects meta box settings
- **functions.php**: Core theme setup and includes
- **inc/admin.php**: Admin screens, meta boxes, and notices
- **inc/customizer-setup.php**: Customizer configuration with fixed hooks
- **inc/customizer.php**: Customizer settings and controls
- **debug-test.php**: Tool to test each include file individually
- **wp-config-debug.php**: Debugging settings for WordPress
- **test-theme.sh**: Bash script to verify theme integrity

## Meta Box Functionality

The theme now supports three toggles for each page:

1. **Show Sidebar Widgets**: Controls sidebar visibility
2. **Show Table of Contents**: Enables/disables auto-generated TOC
3. **Show Share Buttons**: Shows/hides social sharing options

These settings are stored as post meta with the following keys:
- `_show_sidebar_widgets`: '1' (show) or '0' (hide)
- `_show_table_of_contents`: '1' (show) or '0' (hide)
- `_show_share_buttons`: '1' (show) or '0' (hide)

## Theme Customizer Settings

The theme includes a customizer setting for default widget visibility:
- Setting ID: `dark_theme_simplicity_default_show_widgets`
- Default Value: 'yes'
- Possible Values: 'yes' or 'no'

## Recovery Instructions

If the theme still encounters fatal errors:

1. Activate a default WordPress theme (e.g., Twenty Twenty-Three)
2. Rename the theme directory to `dark-theme-simplicity-backup`
3. Create a fresh installation using the fixed files
4. Gradually port your customizations to the new installation

## Support Resources

- WordPress Debugging: https://wordpress.org/documentation/article/debugging-in-wordpress/
- Theme Handbook: https://developer.wordpress.org/themes/
- Function Reference: https://developer.wordpress.org/reference/

## Credits

These fixes were applied by [Your Name] to resolve critical issues in the Dark Theme Simplicity WordPress theme.

For questions or assistance, please open an issue in the theme's repository. 