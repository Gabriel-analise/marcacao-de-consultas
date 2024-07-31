import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        port: 3000, // porta para o front
        proxy: {
            '/': {
                target: 'http://localhost:8001', // Porta do servidor Laravel
                changeOrigin: true, // Se true, altera o cabeçalho Origin da solicitação para o destino do proxy. Útil para evitar problemas com CORS.
                secure: false, // Define se o proxy deve ser seguro (usar HTTPS). Geralmente, false é adequado para desenvolvimento local.
                ws: true, // Define se o proxy deve lidar com WebSockets. Pode ser útil dependendo da configuração do seu aplicativo.
            },
        },
    },
});
