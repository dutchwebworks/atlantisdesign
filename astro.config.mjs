import { defineConfig } from "astro/config";

import tailwindcss from "@tailwindcss/vite";

// https://astro.build/config
export default defineConfig({
  site: "https://old.atlantisdesign.nl",
  compressHTML: false,
  trailingSlash: "never",

  markdown: {
    shikiConfig: {
      theme: "dracula",
      wrap: true,
    },
  },

  vite: {
    plugins: [tailwindcss()],
  },
});