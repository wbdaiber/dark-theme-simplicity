
// Static components - Will be used as WordPress template parts
export { default as Header } from './static/Header';
export { default as Footer } from './static/Footer';
export { default as Layout } from './static/Layout';

// Dynamic components - Will be used within WordPress templates
export { default as PostCard } from './dynamic/PostCard';
export { default as PostList } from './dynamic/PostList';
export { default as PageContent } from './dynamic/PageContent';

// Template components - Will map to WordPress template files
export { default as Homepage } from './templates/Homepage';
export { default as BlogTemplate } from './templates/BlogTemplate';
export { default as SinglePostTemplate } from './templates/SinglePostTemplate';
export { default as PageTemplate } from './templates/PageTemplate';

// Utils
export * from './utils/wordpress-helpers';
