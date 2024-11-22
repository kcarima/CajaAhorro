import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/common/captcha.js',
                'resources/js/common/delete.js',
                'resources/js/modules/seguridad/usuarios/registro.js',
                'resources/js/modules/seguridad/usuarios/editar.js',
                'resources/js/modules/sca/configuraciones/configuraciones.js',
                'resources/js/modules/uneg/uneg.js',
                'resources/js/modules/seguridad/usuarios/editar-user.js',
                'resources/assets/vendor/libs/jquery/jquery-3.6.0.min.js'
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
});
