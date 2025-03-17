
import { useLocation } from "react-router-dom";
import { useEffect } from "react";
import Layout from "@/components/Layout";
import { ArrowLeft } from "lucide-react";

const NotFound = () => {
  const location = useLocation();

  useEffect(() => {
    console.error(
      "404 Error: User attempted to access non-existent route:",
      location.pathname
    );
  }, [location.pathname]);

  return (
    <Layout>
      <div className="min-h-screen flex items-center justify-center px-4 py-32">
        <div className="text-center">
          <h1 className="text-7xl font-display font-bold mb-4 text-blue-300">404</h1>
          <p className="text-2xl text-light-100 mb-8">Oops! Page not found</p>
          <p className="text-lg text-light-100/70 mb-8 max-w-md mx-auto">
            The page you're looking for doesn't exist or has been moved.
          </p>
          <a 
            href="/" 
            className="inline-flex items-center px-6 py-3 border border-white/20 rounded-md text-base font-medium bg-dark-100 hover:bg-dark-300 transition-colors duration-300"
          >
            <ArrowLeft className="mr-2 h-5 w-5" />
            Return to Home
          </a>
        </div>
      </div>
    </Layout>
  );
};

export default NotFound;
