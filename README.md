# Dark Theme Simplicity

A clean, modern dark theme for WordPress focused on readability and performance.

## IMPORTANT: WordPress Theme

This is a WordPress theme and must be installed in a WordPress environment to function correctly. 

## Quick Start (Using Docker)

1. Run the included setup script:
   ```bash
   ./start-wordpress.sh
   ```

2. Visit http://localhost:8000 to complete the WordPress installation

3. Go to Appearance > Themes and activate "Dark Theme Simplicity"

## Manual Installation

1. Install WordPress on your server
2. Copy this entire directory to: `wp-content/themes/dark-theme-simplicity`
3. Activate the theme from WordPress admin

## Recent Fixes

The theme has been updated to fix several critical issues:

1. **Fixed blank pages after customizer changes**
   - Corrected theme mod keys
   - Simplified front-page.php template

2. **Fixed customizer repeater control issues**
   - Updated CSS to ensure repeater fields are visible
   - Fixed approach items functionality

See [Theme Fixes Guide](theme-fixes-guide.md) for complete details.

## Emergency Recovery Tools

If you experience blank pages or other issues after making customizer changes:

1. Visit `/emergency-fix.php` in your browser
2. Review the issues found and click "Apply Automatic Fixes"
3. Delete emergency-fix.php after use

## Features

- Dark mode optimized design
- Clean, minimalist aesthetic
- Modern typography
- Responsive layout
- Customizable homepage sections
- Performance optimized
- Accessibility focused

## Customization

Use the WordPress Customizer to modify:

- Homepage sections visibility and order
- Approach items and other repeater fields
- Colors and typography settings
- Header and footer options

## Development

This theme uses:
- Tailwind CSS for styling
- Vanilla JavaScript for interactivity
- PHP 7.4+ compatible code

## Support

For assistance, please see the [Theme Fixes Guide](theme-fixes-guide.md) or open an issue on the repository.

## License

This theme is licensed under the GNU General Public License v2 or later.

## Credits

- Built with Tailwind CSS
- SVG icons included



