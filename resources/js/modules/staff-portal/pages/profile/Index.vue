<script setup>
import { router } from "@inertiajs/vue3";
const apps = [
  { label: "PPDB", icon: "school", url: route("ppdb.index") },
  { label: "System", icon: "settings", url: "dummy-route" },
  { label: "Akademik", icon: "menu_book", url: "dummy-route" },
  { label: "Kesiswaan", icon: "group", url: "dummy-route" },
  { label: "Absensi", icon: "event_available", url: "dummy-route" },
  { label: "Keuangan", icon: "payments", url: "dummy-route" },
];
</script>

<template>
  <authenticated-layout>
    <template #title>Profil Saya</template>
    <template #left-button>
      <q-btn
        icon="arrow_back"
        flat
        dense
        rounded
        @click="router.visit(route('staff-portal.index'))"
      />
    </template>
    <q-page>
      <div class="text-subtitle q-pa-md">Ini adalah halaman profile</div>
    </q-page>
  </authenticated-layout>
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
