
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
        <PageContent 
          title={title} 
          content={content} 
          featuredImage={featuredImage}
        />
      </div>
    </Layout>
  );
};

export default PageTemplate;
