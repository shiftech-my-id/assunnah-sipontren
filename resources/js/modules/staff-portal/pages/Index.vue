<script setup>
const apps = [
  { label: "PPDB", icon: "school", route: "dummy-route" },
  { label: "System", icon: "settings", route: "dummy-route" },
  { label: "Akademik", icon: "menu_book", route: "dummy-route" },
  { label: "Kesiswaan", icon: "group", route: "dummy-route" },
  { label: "Absensi", icon: "event_available", route: "dummy-route" },
  { label: "Keuangan", icon: "payments", route: "dummy-route" },
];
</script>

<template>
  <guest-layout>
    <q-page padding class="q-pa-md">
      <div
        class="row q-col-gutter-md q-row-gutter-md justify-center"
        style="max-width: 800px; margin: auto"
      >
        <my-link
          v-for="app in apps"
          :key="app.label"
          :href="route(app.route)"
          class="col-3 app-icon-btn"
        >
          <q-icon :name="app.icon" size="48px" class="q-mb-sm" />
          <div class="text-subtitle2">{{ app.label }}</div>
        </my-link>
      </div>
    </q-page>
  </guest-layout>
</template>

<style scoped>
.app-icon-btn {
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
  transition: background-color 0.2s;
}

.app-icon-btn:hover {
  background-color: #f5f5f5;
}

.app-icon-btn > div.text-subtitle2 {
  width: 100%;
  text-align: center;
}
</style>
