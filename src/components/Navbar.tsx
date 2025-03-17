
import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { Menu, X } from 'lucide-react';

const Navbar = () => {
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };
    
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <header
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${
        isScrolled ? 'bg-dark-100/90 backdrop-blur-md shadow-md' : 'bg-transparent'
      }`}
    >
      <div className="container mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16 md:h-20">
          {/* Logo */}
          <div className="flex items-center">
            <Link to="/" className="flex items-center space-x-2 group">
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
                Brad Daiber
              </span>
            </Link>
          </div>

          {/* Desktop Navigation */}
          <nav className="hidden md:flex items-center space-x-8">
            {['Blog', 'Services', 'Portfolio', 'Contact', 'About'].map((item) => (
              <Link
                key={item}
                to={item === 'Blog' ? '/blog' : `/${item.toLowerCase()}`}
                className="text-sm font-medium text-light-100/80 hover:text-light-100 transition-colors duration-200 hover-underline"
              >
                {item}
              </Link>
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
              <X className="h-6 w-6" aria-hidden="true" />
            ) : (
              <Menu className="h-6 w-6" aria-hidden="true" />
            )}
          </button>
        </div>
      </div>

      {/* Mobile Menu */}
      <div
        className={`md:hidden transition-all duration-300 ease-in-out ${
          mobileMenuOpen
            ? 'opacity-100 translate-x-0 pointer-events-auto'
            : 'opacity-0 translate-x-full pointer-events-none'
        }`}
      >
        <div className="bg-dark-100 backdrop-blur-lg shadow-lg px-4 py-6 space-y-1">
          {['Blog', 'Services', 'Portfolio', 'Contact', 'About'].map((item) => (
            <Link
              key={item}
              to={item === 'Blog' ? '/blog' : `/${item.toLowerCase()}`}
              className="block py-3 px-4 text-base font-medium rounded-md hover:bg-dark-300 transition-colors"
              onClick={() => setMobileMenuOpen(false)}
            >
              {item}
            </Link>
          ))}
        </div>
      </div>
    </header>
  );
};

export default Navbar;
