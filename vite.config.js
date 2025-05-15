import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            hot: true,
            detectTls: false,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'php.aaateammm.online',
            port: 5173,
        },
        allowedHosts: [
            'php.aaateammm.online',
        ],
    },
});
