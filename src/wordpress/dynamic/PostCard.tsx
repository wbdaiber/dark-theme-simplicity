
import React from 'react';
import { ArrowRight } from 'lucide-react';
import { Badge } from '@/components/ui/badge';

// This component represents a single post card that will display WordPress post data
// In WordPress, this would be used within the loop
interface PostCardProps {
  id: string;
  title: string;
  excerpt: string;
  date: string;
  imageUrl?: string;
  categories?: string[];
  slug: string;
}

const PostCard: React.FC<PostCardProps> = ({
  title,
  excerpt,
  date,
  imageUrl,
  categories = [],
  slug,
}) => {
  return (
    <article className="glass-card rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg">
      {imageUrl && (
        <div className="relative h-48 overflow-hidden">
          <img 
            src={imageUrl} 
            alt={title} 
            className="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
          />
        </div>
      )}
      <div className="p-6">
        {categories.length > 0 && (
          <div className="flex flex-wrap gap-2 mb-3">
            {categories.map((category, index) => (
              <Badge key={index} variant="outline" className="bg-blue-300/10 text-blue-300">
                {category}
              </Badge>
            ))}
          </div>
        )}
        <time className="text-sm text-light-100/60 mb-2 block">{date}</time>
        <h3 className="text-xl font-medium mb-3 line-clamp-2">
          <a href={`/blog/${slug}`} className="text-white hover:text-blue-300 transition-colors">
            {title}
          </a>
        </h3>
        <p className="text-light-100/70 mb-4 line-clamp-3">{excerpt}</p>
        <a
          href={`/blog/${slug}`}
          className="inline-flex items-center text-blue-300 hover:text-blue-200 font-medium transition-colors"
        >
          Read More <ArrowRight className="ml-1 w-4 h-4" />
        </a>
      </div>
    </article>
  );
};

export default PostCard;
