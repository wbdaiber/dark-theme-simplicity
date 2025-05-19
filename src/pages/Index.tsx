import { useEffect, useRef } from 'react';
import Layout from '@/components/Layout';
import Hero from '@/components/Hero';
import ServiceCard from '@/components/ServiceCard';
import { Badge } from '@/components/ui/badge';
import { Mail, Phone, MapPin, Globe, FileText, Database, Monitor } from 'lucide-react';

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
      
      {/* What We Do Section - Enhanced with the visual style of Expert Services */}
      <section
        ref={sectionRef}
        id="what-we-do"
        className="py-12 px-4 sm:px-6 lg:px-8 relative scroll-mt-16"
      >
        <div className="container mx-auto">
          <div className="max-w-3xl mx-auto text-center mb-16">
            <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
              What We Do
            </Badge>
            <h2 className="text-3xl md:text-4xl font-display font-bold mb-4 tracking-tight reveal-text">
              Our Services
            </h2>
            <p className="text-xl text-light-100/70 max-w-2xl mx-auto reveal-text">
              Comprehensive digital marketing solutions to elevate your online presence.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <ServiceCard
              title="Strategic SEO"
              description="Boost your visibility with search engine optimization that drives organic traffic."
              icon={
                <Globe
                  className="w-8 h-8 text-blue-300"
                />
              }
              className="animate-fade-in"
            />
            
            <ServiceCard
              title="Content Creation"
              description="Engaging, on-brand content that resonates with your target audience."
              icon={
                <FileText
                  className="w-8 h-8 text-blue-300"
                />
              }
              className="animate-fade-in animation-delay-200"
            />
            
            <ServiceCard
              title="Website Development"
              description="Custom websites designed for user experience and conversion optimization."
              icon={
                <Monitor
                  className="w-8 h-8 text-blue-300"
                />
              }
              className="animate-fade-in animation-delay-400"
            />

            <ServiceCard
              title="Brand Strategy"
              description="Cohesive visual identity and messaging that distinguishes your business."
              icon={
                <Database
                  className="w-8 h-8 text-blue-300"
                />
              }
              className="animate-fade-in"
            />
          </div>
        </div>
      </section>
      
      {/* Key Benefits Section */}
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
      
      {/* My Approach Section */}
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
      
      {/* About Me Section */}
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
      
      {/* Contact Section */}
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
              Let's discuss how we can elevate your online presence.
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
    </Layout>
  );
};

export default Index;
