import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/main.js',
                'resources/js/showChart.js'
            ],
            refresh: true,
        }),
    ],
    // build: {
    //     outDir: 'public',
    // },
    // resolve: {
    //     alias: {
    //         '@': '/resources/js',
    //     },
    // },
});
