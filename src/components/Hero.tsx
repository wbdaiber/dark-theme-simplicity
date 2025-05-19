
import { useEffect, useRef } from 'react';
import { Button } from '@/components/ui/button';
import { Briefcase, Award, Settings, User, Mail } from 'lucide-react';

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
      <div className="absolute inset-0 bg-cover bg-center bg-no-repeat" style={{ backgroundImage: 'url("https://braddaiber.com/wp-content/uploads/2024/03/shutterstock_134653565-1-scaled.webp")' }}>
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
          
          {/* Navigation Buttons - updated text and icon colors to white for better legibility */}
          <div className="flex flex-wrap justify-center gap-4 mt-12 animate-fade-in">
            <Button 
              variant="outline" 
              className="bg-blue-300 text-white hover:bg-blue-400 border-blue-400"
              onClick={() => document.getElementById('what-we-do')?.scrollIntoView({ behavior: 'smooth' })}
            >
              <Briefcase className="mr-2 text-white" size={18} />
              Services
            </Button>
            
            <Button 
              variant="outline" 
              className="bg-blue-300 text-white hover:bg-blue-400 border-blue-400"
              onClick={() => document.getElementById('benefits')?.scrollIntoView({ behavior: 'smooth' })}
            >
              <Award className="mr-2 text-white" size={18} />
              Benefits
            </Button>
            
            <Button 
              variant="outline" 
              className="bg-blue-300 text-white hover:bg-blue-400 border-blue-400"
              onClick={() => document.getElementById('approach')?.scrollIntoView({ behavior: 'smooth' })}
            >
              <Settings className="mr-2 text-white" size={18} />
              Approach
            </Button>
            
            <Button 
              variant="outline" 
              className="bg-blue-300 text-white hover:bg-blue-400 border-blue-400"
              onClick={() => document.getElementById('about')?.scrollIntoView({ behavior: 'smooth' })}
            >
              <User className="mr-2 text-white" size={18} />
              About
            </Button>
            
            <Button 
              variant="outline" 
              className="bg-blue-300 text-white hover:bg-blue-400 border-blue-400"
              onClick={() => document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' })}
            >
              <Mail className="mr-2 text-white" size={18} />
              Contact
            </Button>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Hero;
