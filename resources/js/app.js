import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import BaseLayout from './Layouts/Layout.vue';

import lodash from 'lodash';
import { initFlowbite } from 'flowbite';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// Make lodash globally available
window._ = lodash;

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = BaseLayout
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(initFlowbite)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
