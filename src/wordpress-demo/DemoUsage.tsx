
import React from 'react';
import { 
  Homepage,
  BlogTemplate, 
  SinglePostTemplate, 
  PageTemplate
} from '../wordpress';

const WordPressDemo = () => {
  // Sample post data - In WordPress, this would come from the database
  const samplePosts = [
    {
      id: '1',
      title: 'Boost Your SEO Rankings with These 10 Tips',
      excerpt: 'Learn how to improve your website's search engine visibility with these proven strategies.',
      date: '2024-05-15',
      imageUrl: 'https://images.unsplash.com/photo-1432821596592-e2c18b78144f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2340&q=80',
      categories: ['SEO', 'Digital Marketing'],
      slug: 'boost-your-seo-rankings'
    },
    {
      id: '2',
      title: 'Content Creation Strategies for 2024',
      excerpt: 'Discover the latest trends and techniques for creating engaging content that resonates with your audience.',
      date: '2024-05-10',
      imageUrl: 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2340&q=80',
      categories: ['Content Strategy', 'Marketing'],
      slug: 'content-creation-strategies-2024'
    },
    {
      id: '3',
      title: 'Why Your Business Needs a Website Redesign',
      excerpt: 'Is your website outdated? Here's how a redesign can improve user experience and drive more conversions.',
      date: '2024-05-05',
      imageUrl: 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2340&q=80',
      categories: ['Web Design', 'UX'],
      slug: 'business-website-redesign'
    }
  ];

  // Sample single post - In WordPress, this would come from the database
  const sampleSinglePost = {
    title: 'Boost Your SEO Rankings with These 10 Tips',
    content: `
      <p>Search engine optimization (SEO) is crucial for any business looking to increase online visibility. Here are 10 actionable tips to improve your rankings:</p>
      
      <h2>1. Focus on User Experience</h2>
      <p>Google's algorithms prioritize websites that provide excellent user experiences. Ensure your site loads quickly, is mobile-friendly, and easy to navigate.</p>
      
      <h2>2. Create High-Quality Content</h2>
      <p>Content is still king. Develop comprehensive, valuable content that addresses your audience's needs and questions.</p>
      
      <h2>3. Optimize for Keywords</h2>
      <p>Research relevant keywords for your industry and incorporate them naturally into your content, meta descriptions, and headings.</p>
      
      <h2>4. Build Quality Backlinks</h2>
      <p>Earn links from reputable websites in your industry through guest posting, creating shareable content, and networking.</p>
      
      <h2>5. Leverage Local SEO</h2>
      <p>If you have a local business, claim and optimize your Google Business Profile and ensure NAP (name, address, phone) consistency across the web.</p>
    `,
    date: 'May 15, 2024',
    author: 'Brad Daiber',
    featuredImage: 'https://images.unsplash.com/photo-1432821596592-e2c18b78144f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2340&q=80',
    categories: ['SEO', 'Digital Marketing']
  };

  // Sample page content - In WordPress, this would come from the database
  const samplePage = {
    title: 'About Us',
    content: `
      <p>Welcome to Brad Daiber Digital Marketing. We are a team of passionate marketers dedicated to helping businesses grow their online presence.</p>
      
      <h2>Our Mission</h2>
      <p>Our mission is to provide strategic digital marketing solutions that deliver tangible results for our clients. We believe in data-driven strategies combined with creative thinking.</p>
      
      <h2>Our Approach</h2>
      <p>We take a collaborative approach, working closely with clients to understand their unique needs and goals. Every strategy we develop is customized to align with our clients' specific business objectives.</p>
      
      <h2>Our Expertise</h2>
      <p>With over a decade of experience in digital marketing, we specialize in SEO, content creation, website development, and brand strategy. Our team stays up-to-date with the latest industry trends to ensure we're always offering cutting-edge solutions.</p>
    `,
    featuredImage: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2340&q=80'
  };

  // In a real application, you would render only one template based on the current route
  // For this demo, we're showing all templates
  return (
    <div>
      <h1 className="text-2xl font-bold p-4 bg-dark-300 text-white">WordPress Theme Templates Preview</h1>
      
      <div className="border-b border-gray-700 py-4">
        <h2 className="text-xl font-bold p-4">Homepage Template (front-page.php)</h2>
        <Homepage />
      </div>
      
      <div className="border-b border-gray-700 py-4">
        <h2 className="text-xl font-bold p-4">Blog Template (index.php / archive.php)</h2>
        <BlogTemplate posts={samplePosts} />
      </div>
      
      <div className="border-b border-gray-700 py-4">
        <h2 className="text-xl font-bold p-4">Single Post Template (single.php)</h2>
        <SinglePostTemplate 
          title={sampleSinglePost.title}
          content={sampleSinglePost.content}
          date={sampleSinglePost.date}
          author={sampleSinglePost.author}
          featuredImage={sampleSinglePost.featuredImage}
          categories={sampleSinglePost.categories}
        />
      </div>
      
      <div className="py-4">
        <h2 className="text-xl font-bold p-4">Page Template (page.php)</h2>
        <PageTemplate 
          title={samplePage.title}
          content={samplePage.content}
          featuredImage={samplePage.featuredImage}
        />
      </div>
    </div>
  );
};

export default WordPressDemo;
