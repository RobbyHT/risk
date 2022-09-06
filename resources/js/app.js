import './bootstrap'

import '../sass/app.scss'

import $ from "jquery"
import 'jquery-ui-dist/jquery-ui';
import * as bootstrap from 'bootstrap';
import VueSweetalert2 from 'vue-sweetalert2';
import DataTable from "datatables.net-dt";

import { Modal } from 'bootstrap';
import { createApp, h, onMounted, onUpdated, onUnmounted, ref, nextTick } from 'vue/dist/vue.esm-bundler';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
    //resolve: async (name) => {return (await import(`./components/${name}.vue`)).default},
    resolve: (name) => resolvePageComponent(`./components/${name}.vue`, import.meta.glob('./components/**/*.vue')),
    setup({ el, app, props, plugin }) {
      let new_app = createApp({ render: () => h(app, props) })
        .use(plugin)
        .use(VueSweetalert2)
        .use(DataTable)
        .component('InertiaHead', Head)
        .component('InertiaLink', Link)
      new_app.mount(el)
    }
})

window.onMounted = onMounted;
window.onUpdated = onUpdated;
window.onUnmounted = onUnmounted;
window.ref = ref;
window.nextTick = nextTick;
window.Modal = Modal;
