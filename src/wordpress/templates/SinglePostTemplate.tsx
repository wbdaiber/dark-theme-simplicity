
import React from 'react';
import Layout from '../static/Layout';
import { Badge } from '@/components/ui/badge';
import { ArrowLeft } from 'lucide-react';

// This component would map to single.php in WordPress
// It displays a single blog post
interface SinglePostTemplateProps {
  // In WordPress, these would come from WordPress functions like the_title(), the_content(), etc.
  title: string;
  content: string;
  date: string;
  author: string;
  featuredImage?: string;
  categories?: string[];
}

const SinglePostTemplate: React.FC<SinglePostTemplateProps> = ({
  title,
  content,
  date,
  author,
  featuredImage,
  categories = []
}) => {
  return (
    <Layout>
      <article className="pt-24 md:pt-32">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
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
            {/* Post Header */}
            <header className="mb-8">
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
              
              <div className="flex items-center text-light-100/60 text-sm">
                <time>{date}</time>
                <span className="mx-2">•</span>
                <span>By {author}</span>
              </div>
            </header>
            
            {/* Featured Image */}
            {featuredImage && (
              <div className="mb-8 rounded-xl overflow-hidden">
                <img 
                  src={featuredImage} 
                  alt={title} 
                  className="w-full h-auto"
                />
              </div>
            )}
            
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
