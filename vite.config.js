import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            detectTls: false,
            devServer: {
                host: '0.0.0.0',
                port: 5173,
            },
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        allowedHosts: [
            'php.aaateammm.online', // Thêm domain của bạn
            'www.php.aaateammm.online', // Thêm nếu dùng www
        ],
    },
});
