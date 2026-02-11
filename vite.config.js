import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/home.css', 'resources/css/admin.css', 'resources/css/auth.css', 'resources/js/admin.js', 'resources/js/auth.js', 'resources/js/edit_profil.js', 'resources/js/home.js', 'resources/js/image_previewer.js'],
            refresh: true,
        }),
    ],
});