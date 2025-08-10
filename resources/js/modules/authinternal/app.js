import "@/bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp, Head, Link, router } from "@inertiajs/vue3";
import { Dialog, Loading, Notify, Quasar } from "quasar";
import "@quasar/extras/material-icons/material-icons.css";
import "quasar/src/css/index.sass";
import { ZiggyVue } from '../../../../../vendor/tightenco/ziggy';
import processFlashMessage from "@/helpers/flash-message";
import MyLink from "@/components/MyLink.vue";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
import "dayjs/locale/id";
import i18n from "@/i18n";
import GlobalPlugin from "@/plugins";

dayjs.extend(relativeTime);
dayjs.locale("id");

// Ambil nama modul dari Laravel
const moduleName = window?.page?.props?.currentModule || 'app';

// Resolve pages hanya untuk modul ini
createInertiaApp({
  title: (title) => window.CONFIG.APP_NAME + (title ? " - " + title : ""),
  resolve: (name) => {
    const pages = import.meta.glob(`./pages/**/*.vue`, { eager: true });
    console.log(name);
    const page = pages[`./pages/${name}.vue`];
    if (!page) {
      throw new Error(`Halaman Vue tidak ditemukan: ./pages/${name}.vue`);
    }
    return page;
  },

  setup({ el, App, props, plugin }) {
    const VueApp = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(Quasar, {
        plugins: { Notify, Loading, Dialog },
        config: { iconSet: "material-symbols-outlined" },
      })
      .use(i18n)
      .component("i-head", Head)
      .component("i-link", Link)
      .component("my-link", MyLink);

    VueApp.use(GlobalPlugin);
    VueApp.mount(el);
  },
  progress: { color: "#4B5563" },
});

router.on("success", processFlashMessage);
