
import { useEffect, useRef } from 'react';
import Layout from '@/components/Layout';
import Hero from '@/components/Hero';
import ServiceCard from '@/components/ServiceCard';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import { Badge } from '@/components/ui/badge';
import { Send, Mail, Phone, MapPin } from 'lucide-react';

const Index = () => {
  const sectionRef = useRef<HTMLDivElement>(null);

  // Function to handle element reveal animations
  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.1 }
    );

    const elements = document.querySelectorAll('.reveal-text');
    elements.forEach((el) => observer.observe(el));

    return () => observer.disconnect();
  }, []);

  return (
    <Layout>
      <Hero />
      
      {/* Services Section - Reduced top padding from py-24 to py-12 */}
      <section
        ref={sectionRef}
        id="services"
        className="py-12 px-4 sm:px-6 lg:px-8 relative"
      >
        <div className="container mx-auto">
          <div className="max-w-3xl mx-auto text-center mb-16">
            <h2 className="text-3xl md:text-4xl font-display font-bold mb-4 reveal-text">
              Expert Services
            </h2>
            <p className="text-xl text-light-100/70 reveal-text">
              Specialized solutions designed to help your business succeed online.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <ServiceCard
              title="SEO Consulting"
              description="Tailored strategies that will actually get results."
              icon={
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  className="w-8 h-8 text-blue-300"
                >
                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                  <circle cx="12" cy="12" r="3" />
                </svg>
              }
              className="animate-fade-in"
            />
            
            <ServiceCard
              title="Copywriting"
              description="Engaging content for any audience and brand voice."
              icon={
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  className="w-8 h-8 text-blue-300"
                >
                  <path d="M12 19l7-7 3 3-7 7-3-3z" />
                  <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z" />
                  <path d="M2 2l7.586 7.586" />
                  <circle cx="11" cy="11" r="2" />
                </svg>
              }
              className="animate-fade-in animation-delay-200"
            />
            
            <ServiceCard
              title="Web Design"
              description="I built this website. I'll build yours."
              icon={
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  className="w-8 h-8 text-blue-300"
                >
                  <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                  <path d="M3 9h18" />
                  <path d="M9 21V9" />
                </svg>
              }
              className="animate-fade-in animation-delay-400"
            />
          </div>
        </div>
      </section>
      
      {/* About Me Section */}
      <section className="py-16 px-4 sm:px-6 lg:px-8 bg-dark-300">
        <div className="container mx-auto">
          <div className="max-w-5xl mx-auto">
            <div className="text-center mb-12">
              <Badge variant="outline" className="mb-3 py-1.5 px-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
                About Me
              </Badge>
              <h2 className="text-3xl md:text-4xl font-display font-bold mb-4 reveal-text">
                Digital Marketing Specialist
              </h2>
              <p className="text-xl text-light-100/70 max-w-2xl mx-auto reveal-text">
                With over a decade of experience helping businesses thrive online.
              </p>
            </div>
            
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
              <div className="space-y-6 reveal-text">
                <p className="text-lg text-light-100/90">
                  I'm Brad Daiber, a seasoned digital marketing consultant with a passion for helping businesses establish a powerful online presence. With a background in SEO, content creation, and web design, I provide comprehensive solutions tailored to your specific needs.
                </p>
                <p className="text-lg text-light-100/90">
                  My approach combines data-driven strategies with creative thinking to deliver measurable results. Whether you're looking to increase website traffic, improve conversion rates, or establish your brand voice, I'm here to help you achieve your goals.
                </p>
                <div className="pt-4">
                  <a
                    href="/about"
                    className="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-dark-300 bg-light-100 hover:bg-light-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-dark-100 focus:ring-blue-300 transition-all duration-200 transform hover:-translate-y-1"
                  >
                    Learn More About Me
                  </a>
                </div>
              </div>
              <div className="relative h-[400px] w-full rounded-xl overflow-hidden glass-card reveal-text">
                <div className="absolute inset-0 bg-gradient-to-tr from-blue-300/20 to-transparent"></div>
                <img
                  src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2340&q=80"
                  alt="Professional working at desk"
                  className="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>
        </div>
      </section>
      
      {/* Contact Section */}
      <section className="py-16 px-4 sm:px-6 lg:px-8">
        <div className="container mx-auto max-w-5xl">
          <div className="text-center mb-12">
            <Badge variant="outline" className="mb-3 py-1.5 px-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
              Get in Touch
            </Badge>
            <h2 className="text-3xl md:text-4xl font-display font-bold mb-4 reveal-text">
              Contact Me
            </h2>
            <p className="text-xl text-light-100/70 max-w-2xl mx-auto reveal-text">
              Have a question or want to work together? Reach out below.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {/* Contact Info Cards */}
            <div className="glass-card p-6 rounded-xl animate-fade-in">
              <div className="flex items-start space-x-4">
                <div className="bg-blue-300/20 p-3 rounded-lg">
                  <Mail className="h-6 w-6 text-blue-300" />
                </div>
                <div>
                  <h3 className="text-lg font-medium mb-1">Email</h3>
                  <p className="text-light-100/70">hello@braddaiber.com</p>
                </div>
              </div>
            </div>
              
            <div className="glass-card p-6 rounded-xl animate-fade-in animation-delay-200">
              <div className="flex items-start space-x-4">
                <div className="bg-blue-300/20 p-3 rounded-lg">
                  <Phone className="h-6 w-6 text-blue-300" />
                </div>
                <div>
                  <h3 className="text-lg font-medium mb-1">Phone</h3>
                  <p className="text-light-100/70">(555) 123-4567</p>
                </div>
              </div>
            </div>
              
            <div className="glass-card p-6 rounded-xl animate-fade-in animation-delay-400">
              <div className="flex items-start space-x-4">
                <div className="bg-blue-300/20 p-3 rounded-lg">
                  <MapPin className="h-6 w-6 text-blue-300" />
                </div>
                <div>
                  <h3 className="text-lg font-medium mb-1">Location</h3>
                  <p className="text-light-100/70">New York, NY</p>
                </div>
              </div>
            </div>
          </div>

          {/* Contact Form */}
          <div className="mt-12 glass-card p-8 rounded-xl reveal-text">
            <form className="space-y-6">
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                  <label htmlFor="name" className="block text-sm font-medium text-light-100 mb-1">Name</label>
                  <Input id="name" placeholder="Your name" />
                </div>
                <div>
                  <label htmlFor="email" className="block text-sm font-medium text-light-100 mb-1">Email</label>
                  <Input id="email" placeholder="Your email" />
                </div>
              </div>
              
              <div>
                <label htmlFor="subject" className="block text-sm font-medium text-light-100 mb-1">Subject</label>
                <Input id="subject" placeholder="Subject of your message" />
              </div>
              
              <div>
                <label htmlFor="message" className="block text-sm font-medium text-light-100 mb-1">Message</label>
                <Textarea id="message" placeholder="Your message" className="min-h-[150px]" />
              </div>
              
              <Button className="w-full sm:w-auto">
                <span className="flex items-center">
                  <Send className="mr-2 h-4 w-4" />
                  Send Message
                </span>
              </Button>
            </form>
          </div>
          
          <div className="text-center mt-8">
            <a href="/contact" className="text-blue-300 hover:underline font-medium">
              Visit the contact page for more ways to connect →
            </a>
          </div>
        </div>
      </section>
      
      {/* CTA Section */}
      <section className="py-16 px-4 sm:px-6 lg:px-8 bg-dark-100">
        <div className="container mx-auto">
          <div className="max-w-4xl mx-auto text-center">
            <h2 className="text-3xl md:text-4xl font-display font-bold mb-6 reveal-text">
              Your customers are looking for you, are you ready to be found?
            </h2>
            <p className="text-xl text-light-100/70 mb-8 max-w-2xl mx-auto reveal-text">
              Let's discuss how we can elevate your online presence.
            </p>
            <a
              href="/contact"
              className="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-dark-300 bg-light-100 hover:bg-light-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-dark-100 focus:ring-blue-300 transition-all duration-200 transform hover:-translate-y-1"
            >
              Get in Touch
            </a>
          </div>
        </div>
      </section>
    </Layout>
  );
};

export default Index;
