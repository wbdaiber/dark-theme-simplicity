
import React, { useEffect, useState } from 'react';
import { TableOfContents as TableOfContentsIcon } from 'lucide-react';
import { cn } from '@/lib/utils';
import { ScrollArea } from '@/components/ui/scroll-area';

interface Heading {
  id: string;
  text: string;
  level: number;
}

interface TableOfContentsProps {
  contentRef: React.RefObject<HTMLDivElement>;
  className?: string;
}

export const TableOfContents: React.FC<TableOfContentsProps> = ({ contentRef, className }) => {
  const [headings, setHeadings] = useState<Heading[]>([]);
  const [activeId, setActiveId] = useState<string>('');

  useEffect(() => {
    // Extract headings from content
    const extractHeadings = () => {
      if (!contentRef.current) return;
      
      const elements = contentRef.current.querySelectorAll('h2, h3, h4');
      const headingElements: Heading[] = Array.from(elements).map((element) => {
        // Create id for headings that don't have one
        if (!element.id) {
          const id = element.textContent?.toLowerCase().replace(/[^\w]+/g, '-') || '';
          element.id = id;
        }
        
        return {
          id: element.id,
          text: element.textContent || '',
          level: Number(element.tagName.charAt(1))
        };
      });
      
      setHeadings(headingElements);
    };
    
    extractHeadings();
    
    // Set up intersection observer to track active heading
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            setActiveId(entry.target.id);
          }
        });
      },
      { rootMargin: '0px 0px -80% 0px', threshold: 0.1 }
    );
    
    // Observe all heading elements
    const elements = contentRef.current?.querySelectorAll('h2, h3, h4');
    if (elements) {
      elements.forEach((elem) => observer.observe(elem));
    }
    
    return () => observer.disconnect();
  }, [contentRef]);
  
  if (headings.length === 0) {
    return null;
  }
  
  return (
    <div className={cn("w-64 flex-shrink-0 hidden xl:block", className)}>
      <div className="sticky top-24 space-y-4">
        <div className="flex items-center gap-2 font-medium text-blue-300">
          <TableOfContentsIcon size={18} />
          <h3>Table of Contents</h3>
        </div>
        
        <ScrollArea className="h-[calc(100vh-200px)] pr-4">
          <nav className="flex flex-col space-y-1">
            {headings.map((heading) => (
              <a
                key={heading.id}
                href={`#${heading.id}`}
                className={cn(
                  "text-sm py-1 hover:text-blue-300 transition-colors",
                  heading.level === 2 ? "font-medium" : "pl-3 text-xs",
                  heading.level === 4 ? "pl-6 text-xs" : "",
                  activeId === heading.id ? "text-blue-300" : "text-light-100/70"
                )}
                onClick={(e) => {
                  e.preventDefault();
                  document.getElementById(heading.id)?.scrollIntoView({
                    behavior: 'smooth'
                  });
                }}
              >
                {heading.text}
              </a>
            ))}
          </nav>
        </ScrollArea>
      </div>
    </div>
  );
};
