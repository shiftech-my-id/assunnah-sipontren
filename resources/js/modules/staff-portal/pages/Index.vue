<script setup>
import { router } from "@inertiajs/vue3";
import BaseLayout from "@/layouts/BaseLayout.vue";
import { formatDatetime } from "@/helpers/formatter";

const apps = [
  { label: "PPDB", icon: "school", url: route("ppdb.index") },
  { label: "System", icon: "settings", url: route("sys-admin.index") },
  { label: "Akademik", icon: "menu_book", url: "dummy-route" },
  { label: "Santri", icon: "group", url: "dummy-route" },
  { label: "Presensi Santri", icon: "event_available", url: "dummy-route" },
  { label: "Presensi Staff", icon: "event_available", url: "dummy-route" },
  { label: "e-SPP", icon: "payments", url: "dummy-route" },
  { label: "Keuangan", icon: "payments", url: "dummy-route" },
];
</script>

<template>
  <base-layout>
    <q-page>
      <div style="max-width: 800px; margin: auto">
        <div class="row q-mb-lg q-pa-md">
          <q-card class="col q-pa-sm">
            <q-card-section>
              <div class="text-center text-grey-8">
                Halo, <b>{{ $page.props.auth.user.name }}</b
                >. Selamat datang di <b>Portal {{ $config.APP_NAME }}</b
                >. <br />Portal digitalisasi Pondok Pesantren <br />Hari ini
                {{ formatDatetime(new Date(), "dddd") }},
                {{ formatDatetime(new Date(), "DD MMMM YYYY - HH:mm:ss") }}
              </div>
            </q-card-section>
          </q-card>
        </div>

        <div class="row q-col-gutter-md justify-center">
          <a
            v-for="app in apps"
            :key="app.label"
            :href="app.url"
            class="col col-xs-4 col-sm-3 col-md-2 app-icon-btn"
          >
            <q-icon :name="app.icon" size="32px" class="q-mb-sm" />
            <div class="text-subtitle2">{{ app.label }}</div>
          </a>
          <a
            @click="
              router.visit(route('staff-portal.profile.index'), {
                method: 'get',
              })
            "
            class="col col-xs-4 col-sm-3 col-md-2 app-icon-btn"
          >
            <q-icon name="person" size="32px" class="q-mb-sm" />
            <div class="text-subtitle2">Profil</div>
          </a>
          <a
            @click="
              router.visit(route('staff-portal.auth.logout'), {
                method: 'post',
              })
            "
            class="col col-xs-4 col-sm-3 col-md-2 app-icon-btn"
          >
            <q-icon name="logout" size="32px" class="q-mb-sm" />
            <div class="text-subtitle2">Logout</div>
          </a>
        </div>
      </div>
    </q-page>
  </base-layout>
</template>

<style scoped>
.app-icon-btn {
  color: #555 !important;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 140px;
  text-align: center;
  color: inherit;
  text-decoration: none;
  cursor: pointer;
  user-select: none;
  border-radius: 8px;
  transition: background-color 0.5s, color 0.5s;
  padding: 12px; /* untuk memberi jarak internal agar seimbang */
}

.app-icon-btn:hover {
  background-color: #eee;
  color: rgb(54, 158, 255) !important;
  transition: background-color 0.5s, color 0.5s;
}

.app-icon-btn > div.text-subtitle2 {
  width: 100%;
  text-align: center;
}
</style>
