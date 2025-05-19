
// This file contains helper functions that will aid in converting React components to WordPress
// It will be used to map React patterns to WordPress equivalents

/**
 * Maps React props to WordPress template tags
 * In the WordPress theme, you would replace these functions with actual WordPress functions
 */

/**
 * Gets the site name - would be replaced with get_bloginfo('name')
 */
export const getSiteName = () => {
  return 'Brad Daiber';
};

/**
 * Gets the site description - would be replaced with get_bloginfo('description')
 */
export const getSiteDescription = () => {
  return 'Digital Marketing Specialist';
};

/**
 * Gets the current year - useful for copyright notices
 */
export const getCurrentYear = () => {
  return new Date().getFullYear();
};

/**
 * Format a date string - would be replaced with WordPress date formatting functions
 */
export const formatDate = (dateString: string) => {
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
};

/**
 * Convert React Router links to WordPress URLs
 * This helps when translating between React Router and WordPress URL structure
 */
export const getWordPressUrl = (path: string) => {
  // In WordPress, URLs might need to be constructed differently
  // This is a placeholder for that logic
  return path;
};

/**
 * Helper to sanitize HTML content
 * In WordPress, content is often already sanitized by WordPress core
 */
export const sanitizeContent = (content: string) => {
  // In React, we need to sanitize HTML before using dangerouslySetInnerHTML
  // In WordPress, the_content() handles this automatically
  return content;
};

/**
 * ACF field helper - mimics getting ACF fields in WordPress
 */
export const getAcfField = (fieldName: string, defaultValue: any = null) => {
  // In WordPress, this would use get_field() from ACF
  return defaultValue;
};

/**
 * Navigation menu helper - mimics wp_nav_menu()
 */
export const getNavigationMenu = (location: string) => {
  // In WordPress, this would use wp_nav_menu()
  return [];
};

/**
 * Example of how to convert React component props to WordPress template tags
 */
export const reactPropsToWordPress = {
  // Post data
  title: "the_title()",
  content: "the_content()",
  excerpt: "the_excerpt()",
  date: "the_date()",
  author: "the_author()",
  featuredImage: "the_post_thumbnail()",
  permalink: "the_permalink()",
  
  // Query/loop
  posts: "WP_Query and the WordPress Loop",
  
  // Navigation
  navLinks: "wp_nav_menu()",
  
  // Site info
  siteName: "get_bloginfo('name')",
  siteDescription: "get_bloginfo('description')",
};
