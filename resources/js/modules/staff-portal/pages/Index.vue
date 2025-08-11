<script setup>
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
    <q-page>
      <div style="max-width: 800px; margin: auto" class="q-pt-md">
        <div class="text-center q-py-md">
          Halo, {{ $page.props.auth.user.name }}
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
        </div>
      </div>
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
