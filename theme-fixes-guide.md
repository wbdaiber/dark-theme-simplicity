# Dark Theme Simplicity - Fix Guide

This guide explains the issues that were causing blank pages and customizer problems, and how they were fixed.

## IMPORTANT: Theme Must Be Installed in WordPress

Dark Theme Simplicity is a WordPress theme and must be installed in a proper WordPress environment to function. If you're seeing blank pages or PHP errors when accessing the theme files directly, this is expected behavior.

To install the theme properly:

1. **Use Docker (Recommended)**: 
   - Run `./start-wordpress.sh` to start a WordPress environment with Docker
   - Visit http://localhost:8000 to complete WordPress installation
   - Activate the theme from WordPress admin

2. **Manual WordPress Installation**:
   - Install WordPress on your server
   - Place this theme in the wp-content/themes/ directory
   - Activate the theme from WordPress admin

## Issues Fixed

1. **Blank Pages After Customizer Changes**
   - The homepage sections were using incorrect theme mod keys, causing sections to disappear
   - The front-page.php template had complex code that was breaking when customizer settings changed

2. **Customizer Repeater Control Issues**
   - The approach items repeater was using incorrect theme mod keys
   - CSS styling issues were causing repeater fields to be invisible in the customizer

3. **Front Page Sections Not Loading**
   - Template paths were incorrectly referenced
   - Section toggle settings were not working properly

## Fix Details

### 1. Fixed front-page.php

The front-page.php file was completely rewritten with a simpler and more reliable approach:
- Uses a straightforward array of section names
- Properly checks if each section is enabled via theme mods
- Uses correct get_template_part() calls with proper paths

### 2. Fixed Approach Section Template

The approach section template was updated to:
- Use the correct theme mod keys (approach_items instead of dark_theme_simplicity_approach_items)
- Use the helper function dt_get_approach_items() with a fallback mechanism
- Handle empty or missing data gracefully

### 3. Added CSS Fixes for Customizer

Added/updated customizer-fixes.css and customizer-repeater.css:
- Made repeater items fully visible in the customizer
- Fixed styling issues that were hiding content
- Added specific fixes for the approach section customizer controls

### 4. Added Emergency Recovery Tools

Created emergency recovery tools:
- emergency-fix.php: Diagnostic tool to find and fix theme issues
- Reset Theme Mods script: To reset customizer settings if they become corrupted

## How to Use the Emergency Fix Tool

1. If you experience blank pages again, visit `/emergency-fix.php` in your browser
2. Review the issues found and click "Apply Automatic Fixes"
3. After fixes are applied, visit your homepage to verify it's working
4. Delete the emergency-fix.php file when done

## Preventing Future Issues

1. **When making customizer changes:**
   - Make small changes at a time
   - Check your site after each major change
   - If things break, use the reset tool immediately

2. **If adding new homepage sections:**
   - Follow the naming pattern: section-[name].php
   - Add proper theme mod keys: [name]_section_enable
   - Make sure files are in template-parts/homepage/

3. **Customizer Best Practices:**
   - Don't leave the customizer open for extended periods
   - Save changes frequently
   - If the customizer becomes unresponsive, refresh the page

## Additional Resources

If you continue to experience issues:

1. You can reset all theme modifications with the reset-theme-mods.php script
2. You can temporarily switch to front-page-debug.php for detailed diagnostics
3. Check your PHP error log for specific error messages

## Technical Details

The theme uses the following structure for homepage sections:

- Template files: template-parts/homepage/section-*.php
- Theme mod keys:
  - [section]_section_enable: Boolean to toggle section visibility
  - approach_items: JSON array of approach items
  - approach_section_title: Section title text
  - approach_section_subtitle: Section subtitle text 