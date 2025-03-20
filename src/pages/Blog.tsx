
import React, { useEffect, useRef } from 'react';
import { Link } from 'react-router-dom';
import { ChevronRight, Clock, Calendar, ArrowRight, BookOpen } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationNext, PaginationPrevious } from '@/components/ui/pagination';
import Layout from '@/components/Layout';

const Blog = () => {
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
  
  // Mock blog post data
  const featuredPosts = [
    {
      id: 1,
      title: 'Optimizing Content Structure for Maximum SEO Impact',
      excerpt: 'Learn how to structure your content to improve search engine visibility and drive more organic traffic.',
      category: 'SEO',
      date: 'May 15, 2023',
      readTime: '8 min',
      imageUrl: '/placeholder.svg',
      featured: true,
    },
    {
      id: 2,
      title: 'The Ultimate Guide to Conversion-Focused Web Design',
      excerpt: 'Discover the key design principles that turn visitors into customers and boost your conversion rates.',
      category: 'Web Design',
      date: 'June 2, 2023',
      readTime: '12 min',
      imageUrl: '/placeholder.svg',
      featured: true,
    },
    {
      id: 3,
      title: 'Content Marketing Strategies That Actually Drive Results',
      excerpt: 'Cut through the noise with content marketing approaches proven to generate leads and build brand authority.',
      category: 'Content Marketing',
      date: 'April 28, 2023',
      readTime: '10 min',
      imageUrl: '/placeholder.svg',
      featured: true,
    }
  ];
  
  const recentPosts = [
    {
      id: 4,
      title: 'How to Perform a Technical SEO Audit in 2023',
      excerpt: 'A step-by-step guide to identifying and fixing technical SEO issues that could be hurting your rankings.',
      category: 'SEO',
      date: 'July 10, 2023',
      readTime: '15 min',
      imageUrl: '/placeholder.svg',
    },
    {
      id: 5,
      title: 'Building Brand Identity Through Consistent Visual Design',
      excerpt: 'Learn how to develop and maintain a consistent visual language that strengthens your brand recognition.',
      category: 'Branding',
      date: 'July 5, 2023',
      readTime: '7 min',
      imageUrl: '/placeholder.svg',
    },
    {
      id: 6,
      title: 'Effective Email Marketing Campaigns for B2B Businesses',
      excerpt: 'Discover strategies to create engaging email campaigns that generate qualified B2B leads and conversions.',
      category: 'Email Marketing',
      date: 'June 28, 2023',
      readTime: '9 min',
      imageUrl: '/placeholder.svg',
    },
    {
      id: 7,
      title: 'The Role of AI in Modern Content Creation',
      excerpt: 'Explore how artificial intelligence is transforming content creation and what it means for marketers.',
      category: 'Technology',
      date: 'June 20, 2023',
      readTime: '11 min',
      imageUrl: '/placeholder.svg',
    },
    {
      id: 8,
      title: 'Mobile-First Design: Best Practices for 2023',
      excerpt: 'Learn why mobile-first design is crucial and how to implement it effectively for better user experience.',
      category: 'Web Design',
      date: 'June 15, 2023',
      readTime: '8 min',
      imageUrl: '/placeholder.svg',
    },
    {
      id: 9,
      title: 'Measuring ROI on Your Digital Marketing Efforts',
      excerpt: 'A comprehensive guide to tracking and analyzing the return on investment for your digital marketing campaigns.',
      category: 'Analytics',
      date: 'June 8, 2023',
      readTime: '14 min',
      imageUrl: '/placeholder.svg',
    }
  ];

  return (
    <Layout>
      {/* Hero Section */}
      <section className="relative py-24 mb-16 overflow-hidden">
        <div className="absolute inset-0 bg-dark-300">
          <div className="absolute inset-0 bg-gradient-to-br from-blue-400/10 via-dark-300 to-dark-300"></div>
        </div>
        
        <div className="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <div className="max-w-3xl">
            <h1 
              ref={headingRef}
              className="text-4xl md:text-5xl lg:text-6xl font-display font-bold tracking-tight mb-6 leading-tight"
            >
              Insights & Resources
            </h1>
            <p 
              ref={subheadingRef}
              className="text-xl md:text-2xl text-light-100/80 max-w-2xl leading-relaxed mb-8"
            >
              The latest tools, trends, and strategies to elevate your digital presence and maximize your business growth.
            </p>
            
            <div className="flex flex-wrap gap-4">
              <Link to="/blog/category/seo" className="px-4 py-2 rounded-full bg-dark-100/60 hover:bg-dark-100/80 text-light-100/80 hover:text-light-100 transition-colors">
                SEO
              </Link>
              <Link to="/blog/category/content" className="px-4 py-2 rounded-full bg-dark-100/60 hover:bg-dark-100/80 text-light-100/80 hover:text-light-100 transition-colors">
                Content Marketing
              </Link>
              <Link to="/blog/category/web-design" className="px-4 py-2 rounded-full bg-dark-100/60 hover:bg-dark-100/80 text-light-100/80 hover:text-light-100 transition-colors">
                Web Design
              </Link>
              <Link to="/blog/category/analytics" className="px-4 py-2 rounded-full bg-dark-100/60 hover:bg-dark-100/80 text-light-100/80 hover:text-light-100 transition-colors">
                Analytics
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Featured Posts */}
      <section className="mb-24">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center mb-12">
            <h2 className="text-3xl font-display font-medium">Featured Articles</h2>
            <Link to="/blog/featured" className="text-blue-300 hover:text-blue-400 transition-colors group flex items-center gap-1">
              View all featured 
              <ChevronRight size={16} className="group-hover:translate-x-1 transition-transform" />
            </Link>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {featuredPosts.map((post) => (
              <Link key={post.id} to={`/blog/${post.id}`} className="group block">
                <div className="glass-card rounded-2xl overflow-hidden transition-all duration-300 group-hover:shadow-neon h-full flex flex-col">
                  <div className="relative aspect-[16/9]">
                    <img 
                      src={post.imageUrl} 
                      alt={post.title} 
                      className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    />
                    <div className="absolute top-4 left-4 bg-blue-300 text-dark-300 text-xs font-medium py-1 px-2 rounded">
                      {post.category}
                    </div>
                  </div>
                  <div className="p-6 flex flex-col flex-grow">
                    <div className="flex items-center text-sm text-light-100/60 mb-3 gap-4">
                      <span className="flex items-center gap-1">
                        <Calendar size={14} />
                        {post.date}
                      </span>
                      <span className="flex items-center gap-1">
                        <Clock size={14} />
                        {post.readTime} read
                      </span>
                    </div>
                    <h3 className="text-xl font-display font-medium mb-3 group-hover:text-blue-300 transition-colors">
                      {post.title}
                    </h3>
                    <p className="text-light-100/70 mb-4 line-clamp-3">
                      {post.excerpt}
                    </p>
                    <div className="mt-auto">
                      <span className="inline-flex items-center text-blue-300 group-hover:text-blue-400 transition-colors gap-2">
                        Read article
                        <ArrowRight size={16} className="group-hover:translate-x-1 transition-transform" />
                      </span>
                    </div>
                  </div>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>
      
      {/* Recent Posts */}
      <section className="mb-24">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center mb-12">
            <h2 className="text-3xl font-display font-medium">Recent Articles</h2>
            <div className="flex items-center gap-6">
              <div className="hidden md:flex gap-2">
                <Link to="/blog/category/seo" className="text-light-100/70 hover:text-blue-300 transition-colors">
                  SEO
                </Link>
                <span className="text-light-100/30">•</span>
                <Link to="/blog/category/design" className="text-light-100/70 hover:text-blue-300 transition-colors">
                  Design
                </Link>
                <span className="text-light-100/30">•</span>
                <Link to="/blog/category/content" className="text-light-100/70 hover:text-blue-300 transition-colors">
                  Content
                </Link>
              </div>
              <Link to="/blog/all" className="text-blue-300 hover:text-blue-400 transition-colors group flex items-center gap-1">
                View all articles 
                <ChevronRight size={16} className="group-hover:translate-x-1 transition-transform" />
              </Link>
            </div>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {recentPosts.map((post) => (
              <Card key={post.id} className="bg-dark-100/20 border-white/5 overflow-hidden group hover:border-blue-300/30 transition-colors">
                <Link to={`/blog/${post.id}`} className="block">
                  <div className="relative aspect-[16/9]">
                    <img 
                      src={post.imageUrl} 
                      alt={post.title} 
                      className="w-full h-full object-cover"
                    />
                    <div className="absolute top-3 left-3 bg-blue-300/80 text-dark-300 text-xs font-medium py-1 px-2 rounded">
                      {post.category}
                    </div>
                  </div>
                  <CardContent className="pt-5">
                    <div className="flex items-center text-xs text-light-100/60 mb-3 gap-4">
                      <span className="flex items-center gap-1">
                        <Calendar size={12} />
                        {post.date}
                      </span>
                      <span className="flex items-center gap-1">
                        <Clock size={12} />
                        {post.readTime} read
                      </span>
                    </div>
                    <h3 className="text-lg font-display font-medium mb-2 group-hover:text-blue-300 transition-colors line-clamp-2">
                      {post.title}
                    </h3>
                    <p className="text-light-100/70 text-sm mb-3 line-clamp-2">
                      {post.excerpt}
                    </p>
                    <span className="inline-flex items-center text-sm text-blue-300 group-hover:text-blue-400 transition-colors gap-1">
                      Read more
                      <ArrowRight size={14} className="group-hover:translate-x-1 transition-transform" />
                    </span>
                  </CardContent>
                </Link>
              </Card>
            ))}
          </div>
          
          {/* Pagination */}
          <div className="mt-16">
            <Pagination>
              <PaginationContent>
                <PaginationItem>
                  <PaginationPrevious href="#" />
                </PaginationItem>
                <PaginationItem>
                  <PaginationLink href="#" isActive>1</PaginationLink>
                </PaginationItem>
                <PaginationItem>
                  <PaginationLink href="#">2</PaginationLink>
                </PaginationItem>
                <PaginationItem>
                  <PaginationLink href="#">3</PaginationLink>
                </PaginationItem>
                <PaginationItem>
                  <PaginationNext href="#" />
                </PaginationItem>
              </PaginationContent>
            </Pagination>
          </div>
        </div>
      </section>
      
      {/* Newsletter Sign-up */}
      <section className="mb-24">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
          <div className="glass-card rounded-2xl p-8 md:p-12 bg-gradient-to-br from-blue-400/10 to-dark-300/50">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
              <div>
                <h2 className="text-3xl font-display font-medium mb-4">
                  Stay Updated with the Latest Insights
                </h2>
                <p className="text-light-100/80 mb-6">
                  Subscribe to our newsletter to receive exclusive content, actionable tips, and industry updates directly to your inbox.
                </p>
                <div className="flex items-center gap-3">
                  <BookOpen className="text-blue-300" size={32} />
                  <div>
                    <p className="text-sm text-light-100/60">Join over 4,500 subscribers</p>
                    <p className="text-sm text-light-100/60">New content delivered weekly</p>
                  </div>
                </div>
              </div>
              <div>
                <form className="space-y-4">
                  <div>
                    <input 
                      type="email" 
                      placeholder="Enter your email address" 
                      className="w-full px-4 py-3 rounded-lg bg-dark-100/50 border border-white/10 text-light-100 placeholder:text-light-100/40 focus:outline-none focus:ring-2 focus:ring-blue-300/50"
                      required
                    />
                  </div>
                  <button type="submit" className="w-full py-3 px-4 bg-blue-300 hover:bg-blue-400 text-dark-300 font-medium rounded-lg transition-colors duration-200">
                    Subscribe Now
                  </button>
                  <p className="text-xs text-light-100/60 text-center">
                    By subscribing, you agree to our Privacy Policy. You can unsubscribe at any time.
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </Layout>
  );
};

export default Blog;
