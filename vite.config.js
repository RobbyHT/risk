import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import inject from '@rollup/plugin-inject';
import commonjs from '@rollup/plugin-commonjs';

//export default defineConfig({
export default ({ command }) => ({
    base: command === 'serve' ? '' : '/build/',
    plugins: [
        commonjs(),
        laravel({
            input: [
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        inject({
            $: 'jquery',
            jQuery: 'jquery',
        }),
    ],
    resolve: {
        extensions: ['.vue', '.js', '.ts', '.json', '.mjs'],
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
    build: {
        chunkSizeWarningLimit: 1500,
        commonjsOptions: {
            include: ['/node_modules/datatables.net-dt/']
        }
        /*rollupOptions: {
            output: {
                manualChunks(id) {
                    if(id.includes('node_modules')) {
                        return id.toString().split('node_modules/')[1].split('/')[0].toString();
                    }
                }
            }
        }*/
    },
});
