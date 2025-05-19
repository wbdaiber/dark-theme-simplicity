
import { useState, useEffect } from 'react';
import { Menu, X } from 'lucide-react';

// In WordPress, this would be converted to header.php
// Links would be replaced with WordPress menu functions
const Header = () => {
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };
    
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  // WordPress would use wp_nav_menu() to dynamically generate these links
  const navLinks = [
    { name: 'Blog', path: '/blog' },
    { name: 'About', path: '/about' },
  ];

  return (
    <header
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${
        isScrolled ? 'bg-dark-100/90 backdrop-blur-md shadow-md' : 'bg-transparent py-2 md:py-4'
      }`}
    >
      <div className="container mx-auto px-4 sm:px-6 lg:px-8">
        <div className={`flex items-center justify-between ${isScrolled ? 'h-16' : 'h-16 md:h-20'}`}>
          {/* Logo - In WordPress, this would use get_custom_logo() */}
          <div className="flex items-center">
            <a href="/" className="flex items-center space-x-2 group">
              <div className="w-8 h-8 md:w-10 md:h-10 relative flex items-center justify-center">
                <svg
                  viewBox="0 0 100 100"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  className="w-full h-full transition-transform duration-300 ease-out group-hover:scale-110"
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
              </div>
              <span className="text-lg md:text-xl font-display font-medium tracking-tight">
                {/* In WordPress, this would use get_bloginfo('name') */}
                Brad Daiber
              </span>
            </a>
          </div>

          {/* Desktop Navigation - Would be replaced with wp_nav_menu() */}
          <nav className="hidden md:flex items-center space-x-6">
            {navLinks.map((link) => (
              <a
                key={link.name}
                href={link.path}
                className="text-base md:text-lg font-medium text-light-100 hover:text-blue-300 transition-colors duration-200 hover-underline"
              >
                {link.name}
              </a>
            ))}
          </nav>

          {/* Mobile Menu Button */}
          <button
            type="button"
            className="inline-flex items-center justify-center md:hidden"
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
            aria-expanded={mobileMenuOpen}
          >
            <span className="sr-only">Open main menu</span>
            {mobileMenuOpen ? (
              <X className="h-6 w-6 text-light-100" aria-hidden="true" />
            ) : (
              <Menu className="h-6 w-6 text-light-100" aria-hidden="true" />
            )}
          </button>
        </div>
      </div>

      {/* Mobile Menu - Would be replaced with wp_nav_menu() with different args */}
      <div
        className={`md:hidden absolute top-[64px] right-4 w-44 bg-dark-100/95 backdrop-blur-md shadow-lg rounded-md transition-all duration-300 ${
          mobileMenuOpen
            ? 'opacity-100 scale-100'
            : 'opacity-0 scale-95 pointer-events-none'
        }`}
      >
        <div className="px-2 py-2 space-y-1">
          {navLinks.map((link) => (
            <a
              key={link.name}
              href={link.path}
              className="block py-2 px-3 text-sm font-medium rounded-md hover:bg-dark-300 transition-colors text-light-100"
              onClick={() => setMobileMenuOpen(false)}
            >
              {link.name}
            </a>
          ))}
        </div>
      </div>
    </header>
  );
};

export default Header;
