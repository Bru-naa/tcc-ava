/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/livewire/flux/**/*.blade.php",
      './node_modules/preline/dist/*.js',
  ],
  theme: {
    extend: {
      colors: {
        accent: "var(--color-accent)",
        "accent-content": "var(--color-accent-content)",
        "accent-foreground": "var(--color-accent-foreground)",
      },
      fontFamily: {
        sans: ["Instrument Sans", "ui-sans-serif", "system-ui"],
      },
    },
  },
  plugins: [
    require("fluxui"),
    require('@tailwindcss/typography'),
    require('preline/plugin'),
  
  ],
};
