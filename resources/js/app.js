import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { useI18n } from './composables/useI18n';
import { useDarkMode } from './composables/useDarkMode';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const { setLanguage, t } = useI18n();
        const { initializeDarkMode } = useDarkMode();
        
        // Initialize language and dark mode on app load
        setLanguage(localStorage.getItem('language') || 'en');
        initializeDarkMode();

        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue);

        app.config.globalProperties.$t = t;

        return app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
