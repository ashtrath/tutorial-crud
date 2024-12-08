import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/simplefolio/main.css',
                'resources/css/simplefolio/media.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
