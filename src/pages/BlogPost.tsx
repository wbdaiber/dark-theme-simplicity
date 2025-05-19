
import React, { useEffect, useRef } from 'react';
import { Link, useParams } from 'react-router-dom';
import { ArrowLeft, Calendar, Clock, Share2, BookmarkPlus, Facebook, Twitter, Linkedin } from 'lucide-react';
import Layout from '@/components/Layout';
import { Separator } from '@/components/ui/separator';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Badge } from '@/components/ui/badge';
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbPage,
  BreadcrumbSeparator
} from "@/components/ui/breadcrumb";

const BlogPost = () => {
  const { id } = useParams<{ id: string }>();
  const contentRef = useRef<HTMLDivElement>(null);
  
  // Mock blog post data (in a real app, you would fetch this based on the ID)
  const post = {
    id: parseInt(id || '1'),
    title: 'Optimizing Content Structure for Maximum SEO Impact',
    excerpt: 'Learn how to structure your content to improve search engine visibility and drive more organic traffic.',
    content: `
      <h2>Introduction</h2>
      <p>In today's digital landscape, having well-structured content is crucial for both users and search engines. When your content is properly organized, it becomes easier for search engines to understand and index, leading to better rankings and increased visibility.</p>
      
      <p>This comprehensive guide explores the key principles of content structuring for SEO and provides actionable strategies that you can implement immediately.</p>
      
      <h2>Why Content Structure Matters for SEO</h2>
      <p>Proper content structure serves multiple purposes:</p>
      <ul>
        <li>It helps search engines understand your content's hierarchy and importance</li>
        <li>It improves user experience, reducing bounce rates</li>
        <li>It increases the likelihood of featured snippets and rich results</li>
        <li>It makes your content more accessible to all users</li>
      </ul>
      
      <h2>Key Elements of SEO-Friendly Content Structure</h2>
      <h3>1. Effective Use of Headings</h3>
      <p>Headings (H1, H2, H3, etc.) create a hierarchical structure that both users and search engines can follow. Your H1 should contain your primary keyword and clearly describe what the page is about. Subsequent headings should break down topics into logical sections.</p>
      
      <h3>2. Short, Focused Paragraphs</h3>
      <p>Keep paragraphs brief and focused on a single idea. This makes your content more scannable for users and helps search engines better understand each section's focus.</p>
      
      <h3>3. Strategic Use of Lists</h3>
      <p>Bullet points and numbered lists organize information in a digestible format. They're particularly effective for:</p>
      <ul>
        <li>Step-by-step instructions</li>
        <li>Features and benefits</li>
        <li>Tips and best practices</li>
        <li>Resources and tools</li>
      </ul>
      
      <h3>4. Relevant Internal and External Links</h3>
      <p>Thoughtful linking enhances your content by providing additional context and building topical authority. Internal links guide users through your site while helping search engines discover and understand your content relationships.</p>
      
      <h2>Advanced Strategies for Content Structuring</h2>
      <p>Once you've mastered the basics, consider these advanced techniques:</p>
      
      <h3>Implementing Schema Markup</h3>
      <p>Schema markup helps search engines understand the context of your content, potentially leading to rich snippets in search results. For articles, Article, NewsArticle, or BlogPosting schemas are particularly valuable.</p>
      
      <h3>Creating Topic Clusters</h3>
      <p>Develop a content strategy around pillar content and supporting articles. This structure signals to search engines that you have deep expertise in specific topics.</p>
      
      <h2>Measuring the Impact of Your Content Structure</h2>
      <p>After implementing these strategies, track metrics such as:</p>
      <ul>
        <li>Organic traffic changes</li>
        <li>Search ranking improvements</li>
        <li>Bounce rate reductions</li>
        <li>Average time on page increases</li>
        <li>Featured snippet acquisitions</li>
      </ul>
      
      <h2>Conclusion</h2>
      <p>Effective content structure is not just about pleasing search engines—it's about creating a better experience for your users. By following these principles, you'll create content that ranks well and resonates with your audience.</p>
      
      <p>Remember that content structure should evolve with your SEO strategy. Regularly audit your content to ensure it maintains optimal structure for both users and search engines.</p>
    `,
    category: 'SEO',
    date: 'May 15, 2023',
    readTime: '8 min',
    imageUrl: '/placeholder.svg',
    featured: true,
    tags: ['SEO', 'Content Marketing', 'Digital Strategy'],
    relatedPosts: [
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
        id: 6,
        title: 'Effective Email Marketing Campaigns for B2B Businesses',
        excerpt: 'Discover strategies to create engaging email campaigns that generate qualified B2B leads and conversions.',
        category: 'Email Marketing',
        date: 'June 28, 2023',
        readTime: '9 min',
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
    ]
  };
  
  useEffect(() => {
    // Animation for content sections
    const observeElements = () => {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
          }
        });
      }, { threshold: 0.1 });
      
      if (contentRef.current) {
        const elements = contentRef.current.querySelectorAll('h2, h3, p, ul');
        elements.forEach(el => {
          el.classList.add('reveal-text');
          observer.observe(el);
        });
      }
      
      return observer;
    };
    
    const observer = observeElements();
    
    return () => {
      observer.disconnect();
    };
  }, []);
  
  return (
    <Layout>
      {/* Breadcrumbs - positioned with proper spacing */}
      <div className="container mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-4">
        <Breadcrumb>
          <BreadcrumbList>
            <BreadcrumbItem>
              <BreadcrumbLink asChild>
                <Link to="/">Home</Link>
              </BreadcrumbLink>
            </BreadcrumbItem>
            <BreadcrumbSeparator />
            <BreadcrumbItem>
              <BreadcrumbLink asChild>
                <Link to="/blog">Blog</Link>
              </BreadcrumbLink>
            </BreadcrumbItem>
            <BreadcrumbSeparator />
            <BreadcrumbItem>
              <BreadcrumbPage>{post.title}</BreadcrumbPage>
            </BreadcrumbItem>
          </BreadcrumbList>
        </Breadcrumb>
      </div>
      
      {/* Back Button - moved below breadcrumbs */}
      <div className="container mx-auto px-4 sm:px-6 lg:px-8">
        <Link to="/blog" className="inline-flex items-center text-blue-300 hover:text-blue-400 transition-colors gap-1 mb-6">
          <ArrowLeft size={18} />
          <span>Back to All Articles</span>
        </Link>
      </div>
      
      {/* Post Header */}
      <header className="container mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div className="max-w-4xl mx-auto">
          <div className="flex flex-col md:flex-row justify-between items-start gap-8">
            <div className="flex-1">
              <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 hover:bg-blue-300/20 border-blue-300/20">
                {post.category}
              </Badge>
              
              <h1 className="text-3xl md:text-4xl lg:text-5xl font-display font-bold mb-6 leading-tight">
                {post.title}
              </h1>
              
              <div className="flex flex-wrap items-center text-sm text-light-100/70 mb-8 gap-6">
                <span className="flex items-center gap-1">
                  <Calendar size={16} />
                  {post.date}
                </span>
                <span className="flex items-center gap-1">
                  <Clock size={16} />
                  {post.readTime} read
                </span>
              </div>
            </div>
            
            {/* Featured Image as Thumbnail - Display on the right */}
            <div className="w-full md:w-48 lg:w-64 flex-shrink-0 rounded-lg overflow-hidden">
              <img 
                src={post.imageUrl} 
                alt={post.title} 
                className="w-full h-auto object-cover"
              />
            </div>
          </div>
          
          <div className="flex justify-end mt-6">
            <div className="flex items-center gap-3">
              <Button variant="outline" size="sm" className="text-light-100/70 border-white/10 hover:bg-dark-100/50">
                <BookmarkPlus size={16} className="mr-1" />
                Save
              </Button>
              <Button variant="outline" size="sm" className="text-light-100/70 border-white/10 hover:bg-dark-100/50">
                <Share2 size={16} className="mr-1" />
                Share
              </Button>
            </div>
          </div>
        </div>
      </header>
      
      {/* Remove the large featured image section since we already have it in the header */}
      
      {/* Post Content */}
      <article className="container mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div className="max-w-3xl mx-auto">
          <div 
            ref={contentRef}
            className="prose prose-invert prose-lg max-w-none prose-headings:font-display prose-headings:font-medium prose-headings:text-light-100 prose-h2:text-2xl prose-h2:mt-12 prose-h2:mb-4 prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3 prose-p:text-light-100/80 prose-p:my-4 prose-a:text-blue-300 prose-a:no-underline hover:prose-a:underline prose-strong:text-light-100 prose-strong:font-medium prose-ul:my-4 prose-ul:list-disc prose-ul:pl-5 prose-li:text-light-100/80 prose-li:my-1"
            dangerouslySetInnerHTML={{ __html: post.content }}
          />
          
          {/* Tags */}
          <div className="mt-12 mb-8">
            <h4 className="text-lg font-medium mb-3">Tags:</h4>
            <div className="flex flex-wrap gap-2">
              {post.tags.map((tag, index) => (
                <Link key={index} to={`/blog/tag/${tag.toLowerCase()}`}>
                  <Badge variant="outline" className="bg-dark-100/20 hover:bg-dark-100/40 border-white/10">
                    {tag}
                  </Badge>
                </Link>
              ))}
            </div>
          </div>
          
          {/* Share Buttons */}
          <div className="border-t border-b border-white/10 py-6 mt-8 mb-12">
            <div className="flex justify-between items-center">
              <span className="text-light-100/70">Share this article:</span>
              <div className="flex gap-3">
                <Button variant="outline" size="icon" className="rounded-full h-10 w-10">
                  <Twitter size={18} />
                </Button>
                <Button variant="outline" size="icon" className="rounded-full h-10 w-10">
                  <Facebook size={18} />
                </Button>
                <Button variant="outline" size="icon" className="rounded-full h-10 w-10">
                  <Linkedin size={18} />
                </Button>
              </div>
            </div>
          </div>
        </div>
      </article>
      
      {/* Related Posts */}
      <section className="bg-dark-300 py-16">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
          <h2 className="text-2xl md:text-3xl font-display font-medium mb-8 text-center">Related Articles</h2>
          
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            {post.relatedPosts.map((relatedPost) => (
              <Link key={relatedPost.id} to={`/blog/${relatedPost.id}`}>
                <Card className="bg-dark-100/20 border-white/5 overflow-hidden group hover:border-blue-300/30 transition-colors h-full flex flex-col">
                  <div className="relative aspect-[16/9]">
                    <img 
                      src={relatedPost.imageUrl} 
                      alt={relatedPost.title} 
                      className="w-full h-full object-cover"
                    />
                    <div className="absolute top-3 left-3 bg-blue-300/80 text-dark-300 text-xs font-medium py-1 px-2 rounded">
                      {relatedPost.category}
                    </div>
                  </div>
                  <CardContent className="pt-5 flex flex-col flex-grow">
                    <div className="flex items-center text-xs text-light-100/60 mb-3 gap-4">
                      <span className="flex items-center gap-1">
                        <Calendar size={12} />
                        {relatedPost.date}
                      </span>
                      <span className="flex items-center gap-1">
                        <Clock size={12} />
                        {relatedPost.readTime} read
                      </span>
                    </div>
                    <h3 className="text-lg font-display font-medium mb-2 group-hover:text-blue-300 transition-colors line-clamp-2">
                      {relatedPost.title}
                    </h3>
                    <p className="text-light-100/70 text-sm mb-3 line-clamp-2">
                      {relatedPost.excerpt}
                    </p>
                  </CardContent>
                </Card>
              </Link>
            ))}
          </div>
        </div>
      </section>
      
      {/* Newsletter Sign-up */}
      <section className="py-16">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
          <div className="glass-card rounded-2xl p-8 md:p-12 bg-gradient-to-br from-blue-400/10 to-dark-300/50 max-w-4xl mx-auto">
            <div className="text-center mb-8">
              <h2 className="text-2xl md:text-3xl font-display font-medium mb-4">
                Enjoy this article?
              </h2>
              <p className="text-light-100/80 max-w-2xl mx-auto">
                Subscribe to our newsletter to receive exclusive content, actionable tips, and industry updates directly to your inbox.
              </p>
            </div>
            
            <form className="max-w-md mx-auto">
              <div className="flex flex-col sm:flex-row gap-3">
                <input 
                  type="email" 
                  placeholder="Enter your email address" 
                  className="flex-grow px-4 py-3 rounded-lg bg-dark-100/50 border border-white/10 text-light-100 placeholder:text-light-100/40 focus:outline-none focus:ring-2 focus:ring-blue-300/50"
                  required
                />
                <Button type="submit" className="py-3 px-6 bg-blue-300 hover:bg-blue-400 text-dark-300 font-medium rounded-lg transition-colors duration-200">
                  Subscribe
                </Button>
              </div>
              <p className="text-xs text-light-100/60 text-center mt-3">
                By subscribing, you agree to our Privacy Policy. You can unsubscribe at any time.
              </p>
            </form>
          </div>
        </div>
      </section>
    </Layout>
  );
};

export default BlogPost;
