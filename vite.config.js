import fs from 'fs-extra';
import path from 'path';
import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';

// 🧹 Функція очищення папки public/assets перед збіркою
const cleanAssetsDir = () => {
    const assetsPath = path.resolve(__dirname, 'public/assets');
    if (fs.existsSync(assetsPath)) {
        fs.emptyDirSync(assetsPath);
    }
};

// 📦 Повертає список цілей для копіювання статичних файлів
const getStaticCopyTargets = () => {
    return [
        // 🖼 Картинки (без дублирования previews)
        { src: 'images/static/**/*.*', dest: 'assets/images' },
        // { src: ['images/static/**/*.*', '!images/static/previews/**/*.*'], dest: 'assets/images' },
        // { src: 'images/static/previews/**/*.*', dest: 'assets/images/previews' },




        // 🅰️ Шрифти (без исключений — пока нет вложений)
        { src: 'fonts/static/**/*.*', dest: 'assets/fonts' },

        // 🧩 SVG (без исключений — пока нет вложений)
        { src: 'svg/static/**/*.*', dest: 'assets/svg' }
    ];
};


// ⚙️ Основна конфігурація Vite
export default defineConfig(async () => {
    const staticCopyTargets = await getStaticCopyTargets();

    return {
        root: 'resources',
        base: '/assets/',

        build: {
            outDir: path.resolve(__dirname, 'public'),
            emptyOutDir: false,

            rollupOptions: {
                input: {
                    app: path.resolve(__dirname, 'resources/js/application.js'),
                },
                output: {
                    entryFileNames: 'assets/js/[name].js',
                    chunkFileNames: 'assets/js/[name].js',
                    assetFileNames: ({ name }) => {
                        if (!name) return 'assets/[name].[ext]';
                        if (/\.css$/.test(name)) return 'assets/css/[name].[ext]';
                        if (/\.(woff2?|eot|ttf|otf)$/.test(name)) return 'assets/fonts/[name].[ext]';
                        if (/\.svg$/.test(name)) return 'assets/svg/[name].[ext]';
                        if (/\.(png|jpe?g|gif|webp)$/.test(name)) return 'assets/images/[name].[ext]';
                        return 'assets/[name].[ext]';
                    }
                }
            }
        },

        css: {
            preprocessorOptions: {
                scss: {},
            },
        },

        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources'),
            },
        },

        plugins: [
            {
                name: 'clean-public-assets',
                buildStart() {
                    cleanAssetsDir();
                }
            },
            viteStaticCopy({
                targets: staticCopyTargets
            })
        ]
    };
});
