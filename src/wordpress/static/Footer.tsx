
import { X, Linkedin } from 'lucide-react';

// In WordPress, this would be converted to footer.php
// Links and content would be replaced with WordPress functions and widgets
const Footer = () => {
  const currentYear = new Date().getFullYear();
  
  return (
    <footer className="bg-dark-300 border-t border-white/5">
      <div className="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
          {/* Logo and Description - In WordPress, this could be a widget area */}
          <div className="md:col-span-2">
            <a href="/" className="flex items-center space-x-2 mb-4">
              <svg
                viewBox="0 0 100 100"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                className="w-8 h-8"
              >
                <path
                  d="M50 5L95 27.5V72.5L50 95L5 72.5V27.5L50 5Z"
                  stroke="currentColor"
                  strokeWidth="2"
                  className="text-blue-300"
                />
                <path
                  d="M50 20L85 37.5V70L50 87.5L15 70V37.5L50 20Z"
                  stroke="currentColor"
                  strokeWidth="2"
                  className="text-white"
                />
                <path
                  d="M15 37.5L50 55L85 37.5"
                  stroke="currentColor"
                  strokeWidth="2"
                  className="text-white"
                />
                <path
                  d="M50 55V87.5"
                  stroke="currentColor"
                  strokeWidth="2"
                  className="text-white"
                />
              </svg>
              <span className="text-lg font-display font-medium">
                {/* In WordPress, this would use get_bloginfo('name') */}
                Brad Daiber
              </span>
            </a>
            <p className="text-light-100/60 max-w-md">
              {/* In WordPress, this could be editable via a theme option */}
              Providing the best content, SEO strategy, and web design services to grow your business online.
            </p>
          </div>
          
          {/* Navigation Links - Would be replaced with wp_nav_menu() */}
          <div>
            <h4 className="text-sm font-medium uppercase tracking-wider mb-4 text-light-100/40">Navigation</h4>
            <ul className="space-y-2">
              {['Blog', 'About'].map((item) => (
                <li key={item}>
                  <a
                    href={item === 'Blog' ? '/blog' : `/${item.toLowerCase()}`}
                    className="text-light-100/70 hover:text-light-100 transition-colors duration-200"
                  >
                    {item}
                  </a>
                </li>
              ))}
            </ul>
          </div>
          
          {/* Social Links - In WordPress, this could be a widget or theme options */}
          <div>
            <h4 className="text-sm font-medium uppercase tracking-wider mb-4 text-light-100/40">Connect</h4>
            <div className="flex space-x-4">
              <a
                href="https://twitter.com"
                target="_blank"
                rel="noopener noreferrer"
                className="text-light-100/70 hover:text-blue-300 transition-colors duration-200"
                aria-label="X (formerly Twitter)"
              >
                <X size={20} />
              </a>
              <a
                href="https://linkedin.com"
                target="_blank"
                rel="noopener noreferrer"
                className="text-light-100/70 hover:text-blue-300 transition-colors duration-200"
                aria-label="LinkedIn"
              >
                <Linkedin size={20} />
              </a>
            </div>
          </div>
        </div>
        
        <div className="mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center">
          <p className="text-sm text-light-100/40">
            &copy; {currentYear} {/* In WordPress, this would use get_bloginfo('name') */} Brad Daiber. All rights reserved.
          </p>
          <div className="mt-4 md:mt-0 flex space-x-6">
            <a href="/privacy" className="text-sm text-light-100/40 hover:text-light-100/70 transition-colors duration-200">
              Privacy Policy
            </a>
            <a href="/terms" className="text-sm text-light-100/40 hover:text-light-100/70 transition-colors duration-200">
              Terms of Service
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
