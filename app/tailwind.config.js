// tailwind.config.js
module.exports = {
  content: [
    './assets/**/*.{js,ts,vue}',
    './templates/**/*.html.twig',
  ],
  theme: {
    extend: {},
  },
  plugins: [require('daisyui')],
}
