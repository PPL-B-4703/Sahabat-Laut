/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.html",
    "./resources/**/*.blade.php", // kalau Laravel
    "./src/**/*.{js,ts,jsx,tsx}", // kalau pakai JS
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}