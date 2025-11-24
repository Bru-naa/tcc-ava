/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/livewire/flux/**/*.blade.php",
    './node_modules/preline/dist/*.js',
    './app/Livewire/**/*Table.php',
    './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
    './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php',
  ],

  
  presets: [
    require('./vendor/power-components/livewire-powergrid/tailwind.config.js'),
    require('./vendor/livewire/flux/tailwind.config.js'),
   
  ],

  theme: {
    extend: {
      colors: {
        "pg-primary": colors.gray,
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
