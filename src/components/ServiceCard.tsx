
import { FC, HTMLAttributes, useState } from 'react';
import { cn } from '@/lib/utils';

interface ServiceCardProps extends HTMLAttributes<HTMLDivElement> {
  title: string;
  description: string;
  icon: JSX.Element;
  ctaText?: string;
  ctaLink?: string;
}

const ServiceCard: FC<ServiceCardProps> = ({
  title,
  description,
  icon,
  ctaText,
  ctaLink,
  className,
  ...props
}) => {
  const [isHovered, setIsHovered] = useState(false);
  
  return (
    <div
      className={cn(
        'glass-card relative rounded-2xl p-6 md:p-8 transition-all duration-300 ease-out transform',
        isHovered ? 'scale-[1.02] shadow-neon' : '',
        className
      )}
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
      {...props}
    >
      <div className="mb-5">
        <div className="w-16 h-16 rounded-full flex items-center justify-center bg-dark-100 mb-6 group-hover:bg-blue-400/10 transition-colors duration-300">
          {icon}
        </div>
        <h3 className="text-2xl font-display font-semibold mb-2">{title}</h3>
        <p className="text-light-100/70 mb-6">{description}</p>
      </div>
      
      {ctaText && ctaLink && (
        <a
          href={ctaLink}
          className="inline-block text-blue-300 hover:text-blue-200 font-medium transition-colors duration-200 hover-underline"
        >
          {ctaText}
        </a>
      )}
      
      {isHovered && (
        <div className="absolute inset-0 rounded-2xl pointer-events-none ring-1 ring-blue-300/30 transition-opacity duration-300" />
      )}
    </div>
  );
};

export default ServiceCard;
