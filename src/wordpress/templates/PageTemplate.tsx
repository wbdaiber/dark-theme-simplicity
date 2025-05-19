
import React from 'react';
import Layout from '../static/Layout';
import PageContent from '../dynamic/PageContent';

// This component would map to page.php in WordPress
// It displays a single WordPress page
interface PageTemplateProps {
  // In WordPress, these would come from WordPress functions like the_title(), the_content(), etc.
  title: string;
  content: string;
  featuredImage?: string;
}

const PageTemplate: React.FC<PageTemplateProps> = ({
  title,
  content,
  featuredImage
}) => {
  return (
    <Layout>
      <div className="pt-24 md:pt-32">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8">
          <div className="max-w-4xl mx-auto">
            {/* Page Header with Featured Image on right */}
            <header className="mb-12 flex flex-col md:flex-row justify-between items-start gap-8">
              <div className="flex-1">
                <h1 className="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                  {title}
                </h1>
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
            
            {/* Page Content */}
            <PageContent 
              title={title} 
              content={content} 
              featuredImage={featuredImage}
            />
          </div>
        </div>
      </div>
    </Layout>
  );
};

export default PageTemplate;
