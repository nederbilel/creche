import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'dist',  // <- add this line
        rollupOptions: {
            input: [
                path.resolve(__dirname, 'resources/js/app.js'),
                path.resolve(__dirname, 'resources/sass/app.scss'),
            ],
        },
    },
});
