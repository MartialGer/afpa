import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/evenements.css',
                'resources/js/app.js',
                'resources/js/evenementFormulaire.js',
                'resources/js/evenementModification.js',
                'resources/js/evenementIndexUser.js',
                'resources/js/evenement.js',
            ],
            refresh: true,
        }),
    ],
});
