import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import { quasar, transformAssetUrls } from "@quasar/vite-plugin";

export default defineConfig({
  server: {
    port: 8002, // Or your desired port
  },
  build: {
    rollupOptions: {
      output: {
        manualChunks: {
          vendor1: ['vue', 'quasar', 'dayjs', 'material-design-icons-iconfont', 'vue-i18n'],
          vendor2: ['vue-echarts'],
          vendor3: ['echarts'],
          // components: [
          //   '/resources/js/pages/admin/auth/Login.vue',
          //   '/resources/js/pages/admin/auth/Register.vue',
          // ],
        },
      },
    },
  },
  plugins: [
    vue({
      template: { transformAssetUrls },
    }),
    // @quasar/plugin-vite options list:
    // https://github.com/quasarframework/quasar/blob/dev/vite-plugin/index.d.ts
    quasar({
      sassVariables: "/resources/css/quasar-variables.sass",
    }),
    laravel({
      input: [
        "resources/css/app.css",
        "resources/js/app.js",
        'resources/js/modules/staff-portal/app.js',
        'resources/js/modules/sys-admin/app.js',
        'resources/js/modules/ppdb/app.js',
        'resources/js/modules/student-registry/app.js',
      ],
      refresh: true,
    }),
  ],
});
