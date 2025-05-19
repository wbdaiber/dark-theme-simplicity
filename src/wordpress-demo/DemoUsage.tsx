
import React from 'react';
import { 
  Layout, 
  SinglePostTemplate,
  BlogTemplate,
  PageTemplate,
  Homepage
} from '../wordpress';

const DemoUsage = () => {
  // Demo data
  const singlePostData = {
    title: "How to Setup a WordPress Theme",
    content: "<p>This is a sample blog post content. In a real WordPress site, this would be the actual content of the post.</p><p>You can include any HTML here.</p>",
    date: "May 18, 2023",
    featuredImage: "/placeholder.svg",
    categories: ["WordPress", "Development", "Themes"]
  };

  const blogData = {
    title: "Our WordPress Blog",
    description: "Latest insights and tutorials about WordPress development",
    posts: [
      {
        id: "1",
        title: "Getting Started with WordPress",
        excerpt: "Learn how to set up your first WordPress site from scratch.",
        date: "May 20, 2023",
        imageUrl: "/placeholder.svg",
        categories: ["WordPress", "Beginner"],
        slug: "getting-started-wordpress"
      },
      {
        id: "2",
        title: "Advanced Theme Development",
        excerpt: "Take your WordPress themes to the next level with these advanced techniques.",
        date: "May 15, 2023",
        imageUrl: "/placeholder.svg",
        categories: ["Development", "Themes"],
        slug: "advanced-theme-development"
      }
    ]
  };

  const pageData = {
    title: "About Our Company",
    content: "<p>This is a sample page content. In a real WordPress site, this would be the actual content of the page.</p><p>You can include any HTML here.</p>",
    featuredImage: "/placeholder.svg"
  };

  return (
    <div className="space-y-8 py-8">
      <div>
        <h2 className="text-2xl font-bold mb-4">Single Post Template Demo</h2>
        <SinglePostTemplate {...singlePostData} />
      </div>
      
      <div>
        <h2 className="text-2xl font-bold mb-4">Blog Template Demo</h2>
        <BlogTemplate {...blogData} />
      </div>
      
      <div>
        <h2 className="text-2xl font-bold mb-4">Page Template Demo</h2>
        <PageTemplate {...pageData} />
      </div>
      
      <div>
        <h2 className="text-2xl font-bold mb-4">Homepage Template Demo</h2>
        <Homepage />
      </div>
    </div>
  );
};

export default DemoUsage;
