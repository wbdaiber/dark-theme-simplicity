# Dark Theme Simplicity - Accessibility Guidelines

This document outlines the accessibility features implemented in the Dark Theme Simplicity WordPress theme and provides guidelines for maintaining accessibility when customizing the theme.

## Implemented Accessibility Features

### Navigation
- The main navigation menu is keyboard navigable
- Skip links are provided to jump to main content
- Mobile navigation is accessible via keyboard and screen readers
- Current page/section is clearly indicated in navigation

### Colors and Contrast
- All text meets WCAG 2.1 AA contrast requirements
- Focus states are clearly visible with high contrast outlines
- Interactive elements have distinct hover and focus states
- Background/foreground color combinations have been tested for accessibility

### Structure and Semantics
- Proper heading hierarchy (H1-H6) is implemented throughout
- ARIA landmarks are used for major page sections
- Lists are properly structured with semantic markup
- Tables include proper headers and captions when used

### Forms and Interactive Elements
- All form fields have associated labels
- Error messages are clear and programmatically associated with inputs
- Required fields are clearly indicated
- Interactive elements have appropriate focus management

### Images and Media
- All images include alt text
- Decorative images use empty alt attributes
- Videos include captions when appropriate
- No content relies solely on color to convey information

### Responsive Design
- Content is accessible at all viewport sizes
- No content is lost when zooming up to 200%
- Text remains readable at different screen sizes
- Touch targets are appropriately sized on mobile

## Maintaining Accessibility When Customizing

### When Adding Content
- Maintain proper heading hierarchy
- Add alt text to all images
- Ensure text has sufficient contrast against backgrounds
- Avoid using color alone to convey information

### When Adding Custom CSS
- Test color contrast when changing colors
- Ensure focus states remain visible
- Maintain text readability when changing font sizes
- Test responsive layouts at multiple viewport sizes

### When Adding Custom JavaScript
- Ensure custom widgets are keyboard accessible
- Maintain focus management for modal dialogs
- Test with screen readers
- Ensure any dynamically added content is accessible

## Testing Accessibility

We recommend testing your site's accessibility regularly using:

1. Keyboard navigation (try navigating without a mouse)
2. Screen readers (NVDA, VoiceOver, JAWS)
3. Automated tools like WAVE, axe, or Lighthouse
4. Color contrast checkers

## Resources

- [Web Content Accessibility Guidelines (WCAG)](https://www.w3.org/WAI/standards-guidelines/wcag/)
- [WordPress Accessibility Handbook](https://make.wordpress.org/accessibility/handbook/)
- [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/)
- [The A11Y Project](https://www.a11yproject.com/)

For specific accessibility questions about this theme, please contact [support@example.com](mailto:support@example.com). 