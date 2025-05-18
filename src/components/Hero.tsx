
import { useEffect, useRef } from 'react';

const Hero = () => {
  const headingRef = useRef<HTMLHeadingElement>(null);
  const subheadingRef = useRef<HTMLParagraphElement>(null);

  useEffect(() => {
    const observers: IntersectionObserver[] = [];
    
    const createObserver = (element: HTMLElement, delay: string = '0s') => {
      if (!element) return;
      
      element.style.opacity = '0';
      element.style.transform = 'translateY(20px)';
      element.style.transition = `opacity 0.8s ease ${delay}, transform 0.8s ease ${delay}`;
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
            observer.unobserve(element);
          }
        });
      }, { threshold: 0.1 });
      
      observer.observe(element);
      observers.push(observer);
    };
    
    if (headingRef.current) createObserver(headingRef.current);
    if (subheadingRef.current) createObserver(subheadingRef.current, '0.2s');
    
    return () => {
      observers.forEach(observer => observer.disconnect());
    };
  }, []);

  return (
    <section className="relative min-h-screen flex items-center justify-center pt-16 overflow-hidden">
      {/* Background Image with Overlay */}
      <div className="absolute inset-0 bg-cover bg-center bg-no-repeat" style={{ backgroundImage: 'url("/lovable-uploads/8244d6b5-8fc6-455a-b22e-469f57c70874.png")' }}>
        <div className="absolute inset-0 bg-gradient-to-b from-dark-200/80 via-dark-200/70 to-dark-200"></div>
      </div>
      
      {/* Text Content */}
      <div className="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20 pb-32">
        <div className="max-w-4xl mx-auto text-center">
          <h1 
            ref={headingRef}
            className="text-4xl md:text-5xl lg:text-6xl font-display font-bold tracking-tight mb-6 leading-tight"
          >
            <span className="block">No fluff, just results.</span>
          </h1>
          <p 
            ref={subheadingRef}
            className="text-xl md:text-2xl text-light-100/80 max-w-3xl mx-auto leading-relaxed mb-10"
          >
            Digital assets that drive outsized return on investment.
          </p>
          
          {/* Scroll Indicator */}
          <div className="absolute bottom-16 left-1/2 transform -translate-x-1/2 flex flex-col items-center animate-pulse-subtle">
            <span className="text-sm text-light-100/60 mb-2">Scroll to explore</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" className="animate-float">
              <path d="M12 5L12 19M12 19L19 12M12 19L5 12" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
            </svg>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Hero;
