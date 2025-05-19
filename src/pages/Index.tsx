
import { useEffect, useRef } from 'react';
import Layout from '@/components/Layout';
import Hero from '@/components/Hero';
import ServiceCard from '@/components/ServiceCard';
import { Badge } from '@/components/ui/badge';
import { Mail, Phone, MapPin } from 'lucide-react';

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
      
      {/* Key Benefits Section - Added new section above Expert Services */}
      <section id="benefits" className="container mx-auto px-4 py-16 scroll-mt-16">
        <div className="text-center mb-12">
          <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
            Why Choose Us
          </Badge>
          <h2 className="text-3xl md:text-4xl font-display font-bold mb-4 tracking-tight reveal-text">
            Key Benefits
          </h2>
          <p className="text-light-100/70 mb-6 max-w-2xl mx-auto reveal-text">
            We deliver real results through strategic digital solutions tailored to your business goals.
          </p>
        </div>
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {[
            {
              title: "Data-Driven",
              description: "Our strategies are backed by thorough research and analytics for measurable outcomes."
            },
            {
              title: "Customized Approach",
              description: "Solutions are tailored to your specific industry, audience, and business objectives."
            },
            {
              title: "Transparent Process",
              description: "Clear communication and regular reporting keep you informed every step of the way."
            },
            {
              title: "Continuous Optimization",
              description: "We consistently refine strategies based on performance data to maximize ROI."
            }
          ].map((benefit, index) => (
            <div 
              key={index} 
              className="glass-card p-6 rounded-xl transition-all duration-300 hover:bg-blue-300/10 hover:translate-y-[-5px] hover:shadow-lg"
            >
              <h3 className="text-xl font-bold mb-3">{benefit.title}</h3>
              <p className="text-light-100/70">{benefit.description}</p>
            </div>
          ))}
        </div>
      </section>
      
      {/* What We Do Section - New section added above Expert Services */}
      <section id="what-we-do" className="container mx-auto px-4 py-16 scroll-mt-16">
        <div className="text-center mb-12">
          <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
            What We Do
          </Badge>
          <h2 className="text-3xl md:text-4xl font-display font-bold mb-4 tracking-tight reveal-text">
            Our Services
          </h2>
          <p className="text-light-100/70 mb-6 max-w-2xl mx-auto reveal-text">
            We provide comprehensive digital marketing solutions to elevate your online presence.
          </p>
        </div>
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {[
            {
              title: "Strategic SEO",
              description: "Boost your visibility with search engine optimization that drives organic traffic."
            },
            {
              title: "Content Creation",
              description: "Engaging, on-brand content that resonates with your target audience."
            },
            {
              title: "Website Development",
              description: "Custom websites designed for user experience and conversion optimization."
            },
            {
              title: "Brand Strategy",
              description: "Cohesive visual identity and messaging that distinguishes your business."
            }
          ].map((service, index) => (
            <div 
              key={index} 
              className="glass-card p-6 rounded-xl transition-all duration-300 hover:bg-blue-300/10 hover:translate-y-[-5px] hover:shadow-lg"
            >
              <h3 className="text-xl font-bold mb-3">{service.title}</h3>
              <p className="text-light-100/70">{service.description}</p>
            </div>
          ))}
        </div>
      </section>
      
      {/* Services Section */}
      <section
        ref={sectionRef}
        id="services"
        className="py-12 px-4 sm:px-6 lg:px-8 relative scroll-mt-16"
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
      
      {/* My Approach Section - Added from About page */}
      <section id="approach" className="container mx-auto px-4 py-16 scroll-mt-16">
        <div className="text-center mb-12">
          <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
            My Approach
          </Badge>
          <h2 className="text-3xl md:text-4xl font-display font-bold mb-6 tracking-tight reveal-text">
            How I work with clients
          </h2>
          <p className="text-light-100/70 mb-6 max-w-2xl mx-auto reveal-text">
            I believe in a collaborative approach to content strategy. Your business is unique, and your content strategy should be too.
          </p>
        </div>
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {[
            {
              title: "1. Discovery",
              description: "I start by understanding your business, audience, and goals to create a tailored strategy."
            },
            {
              title: "2. Strategy Development",
              description: "Based on research and your goals, I develop a content strategy aligned with your business objectives."
            },
            {
              title: "3. Implementation",
              description: "I create content that engages your audience and drives the results you're looking for."
            },
            {
              title: "4. Analysis & Optimization",
              description: "I continuously monitor performance and optimize your content strategy for better results."
            }
          ].map((step, index) => (
            <div 
              key={index} 
              className="glass-card p-6 rounded-xl transition-all duration-300 hover:bg-blue-300/10 hover:translate-y-[-5px] hover:shadow-lg"
            >
              <h3 className="text-xl font-bold mb-3">{step.title}</h3>
              <p className="text-light-100/70">{step.description}</p>
            </div>
          ))}
        </div>
      </section>
      
      {/* About Me Section - Removed the "Learn More" button */}
      <section id="about" className="py-16 px-4 sm:px-6 lg:px-8 bg-dark-300 scroll-mt-16">
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
      
      {/* Contact Section - Removed the contact form and contact page link */}
      <section id="contact" className="py-16 px-4 sm:px-6 lg:px-8 scroll-mt-16">
        <div className="container mx-auto max-w-5xl">
          <div className="text-center mb-12">
            <Badge variant="outline" className="mb-3 py-1.5 px-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
              Get in Touch
            </Badge>
            <h2 className="text-3xl md:text-4xl font-display font-bold mb-4 reveal-text">
              Contact Me
            </h2>
            <p className="text-xl text-light-100/70 max-w-2xl mx-auto reveal-text">
              Have a question or want to work together? Reach out directly.
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
          </div>
        </div>
      </section>
    </Layout>
  );
};

export default Index;
