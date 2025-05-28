/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './src/**/*.{js,ts,jsx,tsx}',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        'dark-100': {
        DEFAULT: 'var(--color-dark-100)',
        },
        'dark-200': {
        DEFAULT: 'var(--color-dark-200)',
        },
        'dark-300': {
        DEFAULT: 'var(--color-dark-300)',
        },
        'light-100': {
        DEFAULT: 'var(--color-light-100)',
        },
        'light-200': {
        DEFAULT: 'var(--color-light-200)',
        },
        'blue-300': {
        DEFAULT: 'var(--color-blue-300)',
        },
        'blue-400': {
        DEFAULT: '#0057A7', // Add this
        },
        'blue-600': {
        DEFAULT: 'var(--color-blue-600)',
        },
        'purple-300': {
        DEFAULT: '#D8B4FE', // Add this
        },
        'teal-300': {
        DEFAULT: '#5EEAD4', // Add this
        },
      },      
      fontFamily: {
        'display': ['Inter', 'system-ui', 'sans-serif'],
        'sans': ['Inter', 'system-ui', 'sans-serif'],
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-out forwards',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0', transform: 'translateY(10px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      },
      container: {
        center: true,
        padding: '1rem',
      },
      typography: {
        DEFAULT: {
          css: {
            maxWidth: 'none',
            color: 'inherit',
            a: {
              color: 'inherit',
              textDecoration: 'none',
              fontWeight: '500',
              '&:hover': {
                color: '#3B82F6',
              },
            },
            strong: {
              color: 'inherit',
            },
            code: {
              color: 'inherit',
            },
            h1: {
              color: 'inherit',
            },
            h2: {
              color: 'inherit',
            },
            h3: {
              color: 'inherit',
            },
            h4: {
              color: 'inherit',
            },
            blockquote: {
              color: 'inherit',
            },
          },
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
} 