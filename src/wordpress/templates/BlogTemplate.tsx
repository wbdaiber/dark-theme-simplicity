
import React from 'react';
import Layout from '../static/Layout';
import PostList from '../dynamic/PostList';
import { Badge } from '@/components/ui/badge';

// This component would map to index.php or archive.php in WordPress
interface BlogTemplateProps {
  // In WordPress, these would come from WordPress functions
  title?: string;
  description?: string;
  posts: Array<{
    id: string;
    title: string;
    excerpt: string;
    date: string;
    imageUrl?: string;
    categories?: string[];
    slug: string;
  }>;
}

const BlogTemplate: React.FC<BlogTemplateProps> = ({ 
  title = "Blog", 
  description = "Latest insights and updates from our team",
  posts = [] 
}) => {
  return (
    <Layout>
      <div className="pt-24 md:pt-32">
        {/* Blog Header */}
        <div className="container mx-auto px-4 py-12 text-center">
          <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
            Our Blog
          </Badge>
          <h1 className="text-4xl md:text-5xl font-bold mb-4">{title}</h1>
          <p className="text-xl text-light-100/70 max-w-2xl mx-auto">
            {description}
          </p>
        </div>
        
        {/* Post List - In WordPress, this would be populated by the loop */}
        <PostList posts={posts} />
      </div>
    </Layout>
  );
};

export default BlogTemplate;
