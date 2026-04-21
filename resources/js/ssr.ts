import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createSSRApp, DefineComponent, h } from 'vue';
import { renderToString } from 'vue/server-renderer';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// 🔥 NUEVO: Forzar HTTPS en producción
const isProduction = process.env.APP_ENV === 'production';
const appUrl = process.env.APP_URL || 'http://localhost';

if (isProduction) {
    // Forzar que las URLs generadas en SSR usen HTTPS
    process.env.VITE_APP_URL = appUrl.replace('http://', 'https://');

    // Configurar el protocolo para Node.js
    (globalThis as any).location  = {
        protocol: 'https:',
        host: new URL(appUrl).host,
        href: appUrl
    };
}

createServer(
    (page) =>
        createInertiaApp({
            page,
            render: renderToString,
            title: (title) => (title ? `${title} - ${appName}` : appName),
            resolve: (name) =>
                resolvePageComponent(
                    `./pages/${name}.vue`,
                    import.meta.glob<DefineComponent>('./pages/**/*.vue'),
                ),
            setup: ({ App, props, plugin }) =>
                createSSRApp({ render: () => h(App, props) }).use(plugin),
        }),
    { cluster: true },
);
