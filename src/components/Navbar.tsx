
import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { Menu, X, Briefcase, Award, Settings, User } from 'lucide-react';

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

  // Define navigation links to match homepage sections
  const navLinks = [
    { name: 'Services', path: '/#what-we-do', icon: <Briefcase className="w-4 h-4" /> },
    { name: 'Benefits', path: '/#benefits', icon: <Award className="w-4 h-4" /> },
    { name: 'Approach', path: '/#approach', icon: <Settings className="w-4 h-4" /> },
    { name: 'About', path: '/#about', icon: <User className="w-4 h-4" /> },
    { name: 'Blog', path: '/blog' },
  ];

  return (
    <header
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${
        isScrolled ? 'bg-dark-100/90 backdrop-blur-md shadow-md' : 'bg-transparent py-2 md:py-4'
      }`}
    >
      <div className="container mx-auto px-4 sm:px-6 lg:px-8">
        <div className={`flex items-center justify-between ${isScrolled ? 'h-16' : 'h-16 md:h-20'}`}>
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
          <nav className="hidden md:flex items-center space-x-6">
            {navLinks.map((link) => (
              <Link
                key={link.name}
                to={link.path}
                className="flex items-center gap-1.5 text-base md:text-lg font-medium text-light-100 hover:text-blue-300 transition-colors duration-200 hover-underline"
              >
                {link.icon}
                {link.name}
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
              <X className="h-6 w-6 text-light-100" aria-hidden="true" />
            ) : (
              <Menu className="h-6 w-6 text-light-100" aria-hidden="true" />
            )}
          </button>
        </div>
      </div>

      {/* Mobile Menu */}
      <div
        className={`md:hidden absolute top-[64px] right-4 w-44 bg-dark-100/95 backdrop-blur-md shadow-lg rounded-md transition-all duration-300 ${
          mobileMenuOpen
            ? 'opacity-100 scale-100'
            : 'opacity-0 scale-95 pointer-events-none'
        }`}
      >
        <div className="px-2 py-2 space-y-1">
          {navLinks.map((link) => (
            <Link
              key={link.name}
              to={link.path}
              className="flex items-center gap-2 py-2 px-3 text-sm font-medium rounded-md hover:bg-dark-300 transition-colors text-light-100"
              onClick={() => setMobileMenuOpen(false)}
            >
              {link.icon}
              {link.name}
            </Link>
          ))}
        </div>
      </div>
    </header>
  );
};

export default Navbar;
