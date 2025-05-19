
import React from 'react';

// This component represents content from a WordPress page
// It would be used to display the_content() from WordPress
interface PageContentProps {
  title: string;
  content: string | React.ReactNode;
  featuredImage?: string;
}

const PageContent: React.FC<PageContentProps> = ({ title, content, featuredImage }) => {
  return (
    <div className="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <article className="max-w-4xl mx-auto">
        {featuredImage && (
          <div className="mb-8 rounded-xl overflow-hidden">
            <img 
              src={featuredImage} 
              alt={typeof title === 'string' ? title : 'Featured image'} 
              className="w-full h-auto"
            />
          </div>
        )}
        
        {title && (
          <h1 className="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
            {title}
          </h1>
        )}
        
        <div className="prose prose-lg prose-invert max-w-none">
          {typeof content === 'string' ? (
            <div dangerouslySetInnerHTML={{ __html: content }} />
          ) : (
            content
          )}
        </div>
      </article>
    </div>
  );
};

export default PageContent;
