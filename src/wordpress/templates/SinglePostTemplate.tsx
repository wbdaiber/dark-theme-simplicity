
import React from 'react';
import Layout from '../static/Layout';
import { Badge } from '@/components/ui/badge';
import { ArrowLeft } from 'lucide-react';
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbPage,
  BreadcrumbSeparator
} from "@/components/ui/breadcrumb";

// This component would map to single.php in WordPress
// It displays a single blog post
interface SinglePostTemplateProps {
  // In WordPress, these would come from WordPress functions like the_title(), the_content(), etc.
  title: string;
  content: string;
  date: string;
  featuredImage?: string;
  categories?: string[];
}

const SinglePostTemplate: React.FC<SinglePostTemplateProps> = ({
  title,
  content,
  date,
  featuredImage,
  categories = []
}) => {
  return (
    <Layout>
      <article className="pt-24 md:pt-32">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
          {/* Breadcrumbs - added with proper spacing */}
          <div className="mb-8">
            <Breadcrumb>
              <BreadcrumbList>
                <BreadcrumbItem>
                  <BreadcrumbLink href="/">Home</BreadcrumbLink>
                </BreadcrumbItem>
                <BreadcrumbSeparator />
                <BreadcrumbItem>
                  <BreadcrumbLink href="/blog">Blog</BreadcrumbLink>
                </BreadcrumbItem>
                <BreadcrumbSeparator />
                <BreadcrumbItem>
                  <BreadcrumbPage>{title}</BreadcrumbPage>
                </BreadcrumbItem>
              </BreadcrumbList>
            </Breadcrumb>
          </div>
          
          {/* Back button */}
          <div className="mb-8">
            <a
              href="/blog"
              className="inline-flex items-center text-blue-300 hover:text-blue-200 font-medium transition-colors"
            >
              <ArrowLeft className="mr-2 w-4 h-4" /> Back to Blog
            </a>
          </div>
          
          <div className="max-w-4xl mx-auto">
            {/* Post Header with Featured Image on right */}
            <header className="mb-12 flex flex-col md:flex-row justify-between items-start gap-8">
              <div className="flex-1">
                {categories.length > 0 && (
                  <div className="flex flex-wrap gap-2 mb-4">
                    {categories.map((category, index) => (
                      <Badge key={index} variant="outline" className="bg-blue-300/10 text-blue-300">
                        {category}
                      </Badge>
                    ))}
                  </div>
                )}
                
                <h1 className="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                  {title}
                </h1>
                
                <div className="text-light-100/60 text-sm">
                  <time>{date}</time>
                </div>
              </div>
              
              {/* Featured Image as Thumbnail */}
              {featuredImage && (
                <div className="w-full md:w-48 lg:w-64 flex-shrink-0 rounded-lg overflow-hidden">
                  <img 
                    src={featuredImage} 
                    alt={title} 
                    className="w-full h-auto object-cover"
                  />
                </div>
              )}
            </header>
            
            {/* Post Content */}
            <div 
              className="prose prose-lg prose-invert max-w-none"
              dangerouslySetInnerHTML={{ __html: content }}
            />
          </div>
        </div>
      </article>
    </Layout>
  );
};

export default SinglePostTemplate;
