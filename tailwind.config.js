/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#FF6B35',
        secondary: '#2ECC71',
        accent: '#FF9F1C',
      },
    },
  },
  plugins: [],
} 