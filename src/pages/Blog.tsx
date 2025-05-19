
import { useEffect, useRef } from 'react';
import { ChevronRight } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import Layout from '@/components/Layout';

const Blog = () => {
  const headingRef = useRef<HTMLHeadingElement>(null);

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
      {/* Hero Section */}
      <section className="py-16 md:py-24 bg-dark-300">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
          <div className="max-w-5xl">
            <h1 
              ref={headingRef}
              className="text-4xl md:text-6xl font-display font-bold tracking-tight mb-6 reveal-text"
            >
              Insights & Resources
            </h1>
            <p className="text-xl md:text-2xl text-light-100/70 max-w-3xl reveal-text">
              The latest tools, trends, and strategies to elevate your digital presence and maximize your business growth.
            </p>
          </div>
        </div>
      </section>

      {/* Featured Articles */}
      <section className="py-16 bg-black">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center mb-10">
            <h2 className="text-3xl md:text-4xl font-bold">Featured Articles</h2>
            <Button variant="link" className="text-blue-300 flex items-center gap-1 group">
              View all featured
              <ChevronRight className="h-4 w-4 transition-transform group-hover:translate-x-1" />
            </Button>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {/* Featured article cards */}
            {[...Array(3)].map((_, index) => (
              <Card 
                key={index}
                className="overflow-hidden border-white/10 backdrop-blur-lg bg-dark-100 transition-all duration-300 hover:bg-dark-100/80"
              >
                <div className="aspect-video relative bg-gradient-to-tr from-blue-400/20 to-purple-400/20">
                  <img 
                    src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                    alt="Blog post thumbnail"
                    className="object-cover w-full h-full opacity-70"
                  />
                  <Badge className="absolute top-4 left-4 bg-blue-300/90 text-dark-300 border-none">
                    {index === 0 ? 'AI' : index === 1 ? 'AI' : 'Tools'}
                  </Badge>
                </div>
                <CardContent className="p-6">
                  <h3 className="text-xl font-bold mb-3 line-clamp-2">
                    <a href={`/blog/${index}`} className="hover:text-blue-300 transition-colors">
                      {index === 0 ? 'How AI is Transforming Digital Marketing' : 
                       index === 1 ? 'Top 10 AI Tools for Content Creation' : 
                       'Essential Analytics Tools for 2025'}
                    </a>
                  </h3>
                  <p className="text-light-100/70 line-clamp-3">
                    {index === 0 ? 'Discover how artificial intelligence is revolutionizing the digital marketing landscape and how you can leverage it.' : 
                     index === 1 ? 'Enhance your content strategy with these powerful AI-driven tools that are changing the game.' : 
                     'Stay ahead of the competition with these cutting-edge analytics tools designed for modern businesses.'}
                  </p>
                </CardContent>
              </Card>
            ))}
          </div>
        </div>
      </section>

      {/* All Articles section - kept from original implementation but with styling updates */}
      <section className="py-16">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
          <div className="mb-10">
            <h2 className="text-3xl md:text-4xl font-bold">All Articles</h2>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            {/* Blog post cards */}
            {[...Array(6)].map((_, index) => (
              <Card 
                key={index}
                className="overflow-hidden border-white/10 backdrop-blur-lg bg-dark-100/50 transition-all duration-300 hover:bg-dark-100"
              >
                <div className="aspect-video relative bg-gradient-to-tr from-blue-300/20 to-purple-300/20">
                  <img 
                    src={`https://picsum.photos/seed/${index}/800/450`}
                    alt="Blog post thumbnail"
                    className="object-cover w-full h-full opacity-60"
                  />
                </div>
                <CardContent className="p-6">
                  <div className="flex gap-2 mb-3">
                    <Badge variant="outline" className="bg-blue-300/10 text-blue-300 border-blue-300/20">
                      {index % 2 === 0 ? 'SEO' : 'Content Marketing'}
                    </Badge>
                    <span className="text-xs text-light-100/50 mt-0.5">May 12, 2024</span>
                  </div>
                  <h3 className="text-xl font-bold mb-2 line-clamp-2">
                    <a href={`/blog/${index}`} className="hover:text-blue-300 transition-colors">
                      The Ultimate Guide to Digital Marketing in {2024 + index}
                    </a>
                  </h3>
                  <p className="text-light-100/70 line-clamp-3 mb-4">
                    Learn the latest strategies and techniques to boost your online presence and drive more traffic to your website.
                  </p>
                  <div className="flex items-center">
                    <div className="w-8 h-8 rounded-full bg-blue-300/20 mr-2"></div>
                    <span className="text-sm font-medium">
                      Brad Daiber
                    </span>
                  </div>
                </CardContent>
              </Card>
            ))}
          </div>

          <div className="flex justify-center">
            <Button variant="outline" className="border-white/10 hover:bg-white/5 hover:border-white/20">
              Load More Articles
            </Button>
          </div>
        </div>
      </section>
    </Layout>
  );
};

export default Blog;
