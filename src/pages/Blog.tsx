import { useEffect, useRef } from 'react';
import { Search } from 'lucide-react';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { HoverCard, HoverCardContent, HoverCardTrigger } from '@/components/ui/hover-card';
import { Card, CardContent } from '@/components/ui/card';
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationNext, PaginationPrevious } from '@/components/ui/pagination';
import Layout from '@/components/Layout';
import { Badge } from '@/components/ui/badge';

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

    if (headingRef.current) {
      headingRef.current.classList.add('reveal-text');
      observer.observe(headingRef.current);
    }

    return () => observer.disconnect();
  }, []);

  return (
    <Layout>
      <div className="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="max-w-4xl mx-auto mb-12">
          <h1 
            ref={headingRef}
            className="text-4xl md:text-5xl font-display font-bold tracking-tight mb-4"
          >
            Blog
          </h1>
          <div className="flex flex-col md:flex-row gap-4 md:items-center justify-between">
            <p className="text-xl text-light-100/70">
              Insights, tutorials, and updates from our team.
            </p>
            <div className="relative">
              <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-light-100/40" size={18} />
              <Input 
                placeholder="Search posts..." 
                className="pl-10 w-full md:w-64"
              />
            </div>
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
          {/* Blog post cards */}
          {[...Array(6)].map((_, index) => (
            <Card 
              key={index}
              className="overflow-hidden border-white/10 backdrop-blur-lg bg-white/5 transition-all duration-300 hover:bg-white/10"
            >
              <div className="aspect-video relative bg-gradient-to-tr from-blue-300/20 to-purple-300/20 flex items-center justify-center">
                <span className="text-3xl opacity-50">📝</span>
              </div>
              <CardContent className="p-6">
                <div className="flex gap-2 mb-3">
                  <Badge variant="outline" className="bg-blue-300/10 text-blue-300 border-blue-300/20">
                    Category
                  </Badge>
                  <span className="text-xs text-light-100/50 mt-0.5">May 12, 2024</span>
                </div>
                <h2 className="text-xl font-bold mb-2 line-clamp-2">
                  <a href={`/blog/${index}`} className="hover:text-blue-300 transition-colors">
                    The Ultimate Guide to Digital Marketing in {2024 + index}
                  </a>
                </h2>
                <p className="text-light-100/70 line-clamp-3 mb-4">
                  Learn the latest strategies and techniques to boost your online presence and drive more traffic to your website.
                </p>
                <div className="flex items-center">
                  <div className="w-8 h-8 rounded-full bg-blue-300/20 mr-2"></div>
                  <HoverCard>
                    <HoverCardTrigger>
                      <span className="text-sm font-medium hover:text-blue-300 cursor-pointer">
                        Brad Daiber
                      </span>
                    </HoverCardTrigger>
                    <HoverCardContent className="w-64">
                      <div className="flex flex-col space-y-2">
                        <p className="text-sm font-medium">Brad Daiber</p>
                        <p className="text-xs text-light-100/70">
                          Digital Marketing Specialist with over 10 years of experience in SEO and content strategy.
                        </p>
                      </div>
                    </HoverCardContent>
                  </HoverCard>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>

        <Pagination>
          <PaginationContent>
            <PaginationItem>
              <PaginationPrevious href="#" />
            </PaginationItem>
            <PaginationItem>
              <PaginationLink href="#">1</PaginationLink>
            </PaginationItem>
            <PaginationItem>
              <PaginationLink href="#" isActive>2</PaginationLink>
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
    </Layout>
  );
};

export default Blog;
