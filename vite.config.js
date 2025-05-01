import fs from 'fs-extra';
import path from 'path';
import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';

// Очищаем папку public/assets перед сборкой
const cleanAssetsDir = () => {
    const assetsPath = path.resolve(__dirname, 'public/assets');
    if (fs.existsSync(assetsPath)) fs.emptyDirSync(assetsPath);
};

// Возвращаем список целей для копирования статических файлов
const staticCopyTargets = [
    { src: 'images/static/**/*.*', dest: 'assets/images' },
    { src: 'fonts/static/**/*.*', dest: 'assets/fonts' },
    { src: 'svg/static/**/*.*', dest: 'assets/svg' }
];

export default defineConfig({
    root: 'resources',
    base: '/assets/',
    build: {
        outDir: path.resolve(__dirname, 'public'),
        emptyOutDir: false,
        rollupOptions: {
            input: {
                main: path.resolve(__dirname, 'resources/js/application.js'),
                application: path.resolve(__dirname, 'resources/scss/application.scss')
            },
            output: {
                entryFileNames: ({ name }) => (name === 'main' ? 'assets/js/application.js' : 'assets/js/[name].js'),
                assetFileNames: ({ name }) => {
                    if (!name) return 'assets/[name].[ext]';
                    if (/\.(woff2?|eot|ttf|otf)$/.test(name)) return 'assets/fonts/[name].[ext]';
                    if (/\.svg$/.test(name)) return 'assets/svg/[name].[ext]';
                    if (/\.(png|jpe?g|gif|webp)$/.test(name)) return 'assets/images/[name].[ext]';
                    if (/\.css$/.test(name)) return 'assets/css/application.css'; // Исправлено имя для CSS
                    return 'assets/[name].[ext]';
                }
            }
        }
    },
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@use '@scss/bootstrap/scss/bootstrap' as *;`,
                quietDeps: true
            }
        }
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources'),
            '@scss': path.resolve(__dirname, 'node_modules')
        }
    },
    plugins: [
        {
            name: 'clean-public-assets',
            buildStart() {
                cleanAssetsDir();
            }
        },
        viteStaticCopy({ targets: staticCopyTargets })
    ]
});
