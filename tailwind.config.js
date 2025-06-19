/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class', // Enable dark mode support
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  safelist: [
    'bg-green-100 text-green-800',
    'bg-orange-100 text-orange-800',
    'bg-yellow-100 text-yellow-800',
    'bg-indigo-100 text-indigo-800',
    'bg-red-100 text-red-800',
    'bg-purple-100 text-purple-800',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
