import { defineConfig } from 'astro/config';

// https://astro.build/config
export default defineConfig({
    site: 'https://old.atlantisdesign.nl',
    compressHTML: false,
    trailingSlash: 'never',
    markdown: {
        shikiConfig: {
            theme: 'dracula',
            wrap: true
        }
    }
});
