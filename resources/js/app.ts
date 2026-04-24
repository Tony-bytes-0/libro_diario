import 'material-design-icons-iconfont/dist/material-design-icons.css';
import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import { aliases, md } from 'vuetify/iconsets/md';
import { createRulesPlugin } from 'vuetify/labs/rules';
import 'vuetify/styles';

const appName = import.meta.env.VITE_APP_NAME || 'Libro Diario';

const customDark = {
    dark: true,
    colors: {
        background: '#3c3c3cff',
        surface: '#2e2e2e',
        primary: '#6200ee',
        'primary-dark': '#3700b3',
        secondary: '#03dac6',
        'secondary-dark': '#018786',
        error: '#b00020',
        'error-dark': '#cf6679',
        onPrimary: '#ffffff',
        onSurface: '#ffffff',
        onSecondary: '#000000',
        onError: '#ffffff',
    },
};

const vuetify = createVuetify({
    components,
    theme: {
        defaultTheme: 'custom-dark',
        themes: {
            'custom-dark': customDark,
        },
        //defaultTheme: 'dark', //por defecto anterior
    },
    directives,
    defaults: {
        global: {
            density: 'compact',
        },
        VBtn: {
            density: 'default',
        },
    },
    icons: {
        defaultSet: 'md',
        aliases,
        sets: {
            md,
        },
    },
});

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(createRulesPlugin({}, vuetify.locale))
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
//initializeTheme();
