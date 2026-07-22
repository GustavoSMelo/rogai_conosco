import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.ts',
                'resources/css/welcome.css',
                'resources/js/welcome.ts',
                'resources/css/result.css',
            ],
            refresh: true,
        }),
    ],
});
