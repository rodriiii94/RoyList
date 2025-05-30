import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    // server: {
    //     host: '0.0.0.0',
    //     port: 5173, // o el puerto que quieras
    //     strictPort: true,
    //     hmr: {
    //         host: '192.168.4.104', // <- Cambiar esto dependiendo del dispositivo
    //     },
    // },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
