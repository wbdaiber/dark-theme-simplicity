
import React from 'react';
import PostCard from './PostCard';

// This component would map to the WordPress loop in index.php/archive.php
// It will display multiple posts
interface Post {
  id: string;
  title: string;
  excerpt: string;
  date: string;
  imageUrl?: string;
  categories?: string[];
  slug: string;
}

interface PostListProps {
  posts: Post[];
  title?: string;
  description?: string;
}

const PostList: React.FC<PostListProps> = ({ posts, title, description }) => {
  return (
    <section className="py-16">
      <div className="container mx-auto px-4 sm:px-6 lg:px-8">
        {title && (
          <h2 className="text-3xl md:text-4xl font-bold mb-4 text-center">{title}</h2>
        )}
        {description && (
          <p className="text-xl text-light-100/70 mb-12 text-center max-w-3xl mx-auto">
            {description}
          </p>
        )}
        
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {posts.map((post) => (
            <PostCard key={post.id} {...post} />
          ))}
        </div>
      </div>
    </section>
  );
};

export default PostList;
