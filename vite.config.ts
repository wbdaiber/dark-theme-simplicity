
import { defineConfig } from "vite";
import react from "@vitejs/plugin-react-swc";
import path from "path";
import { componentTagger } from "lovable-tagger";

// https://vitejs.dev/config/
export default defineConfig(({ mode }) => ({
  server: {
    host: "::",
    port: 8080,
  },
  plugins: [
    react(),
    mode === 'development' &&
    componentTagger(),
  ].filter(Boolean),
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "./src"),
    },
  },
  build: {
    lib: mode === 'wordpress' ? {
      entry: path.resolve(__dirname, 'src/wordpress/ContactPageWP.tsx'),
      name: 'ContactPageWP',
      formats: ['iife'],
      fileName: () => 'contact-form.js'
    } : undefined,
    outDir: mode === 'wordpress' ? 'wp-content/plugins/oxygen/component-framework/components/dist' : 'dist',
    rollupOptions: {
      output: {
        // Ensure the CSS file is generated alongside the JS
        assetFileNames: (assetInfo) => {
          if (assetInfo.name.endsWith('.css')) return 'contact-form.css';
          return assetInfo.name;
        },
        // Externalize React and ReactDOM for WordPress
        globals: {
          'react': 'React',
          'react-dom': 'ReactDOM',
          'zod': 'z',
          '@hookform/resolvers/zod': 'ZodResolver'
        }
      },
      external: ['react', 'react-dom', 'zod', '@hookform/resolvers/zod']
    }
  }
}));
