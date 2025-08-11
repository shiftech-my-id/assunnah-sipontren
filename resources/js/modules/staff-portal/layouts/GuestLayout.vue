<script setup>
import { defineComponent } from "vue";

defineComponent({
  name: "AuthLayout",
});
</script>

<template>
  <q-layout view="hHh lpR fff" style="background: #f5f5f5">
    <!-- Header -->
    <q-header elevated class="bg-primary text-white">
      <q-toolbar style="max-width: 980px; margin: 0 auto">
        <q-toolbar-title align="center">
          <q-avatar>
            <img src="/assets/img/app-logo-light.png" />
          </q-avatar>
          <a class="q-pl-md text-white" :href="route('dummy-route')">
            {{ $config.APP_NAME }}
          </a>
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <!-- Page Container -->
    <q-page-container class="fit page-container-adjust">
      <slot></slot>
    </q-page-container>

    <!-- Footer -->
    <q-footer class="transparent" reveal>
      <div class="q-mt-lg q-mb-md justify-center items-center flex text-grey-6">
        &copy; 2025 - {{ $config.APP_NAME }} v{{ $config.APP_VERSION_STR }}
      </div>
    </q-footer>
  </q-layout>
</template>

<style scoped>
.q-toolbar a {
  color: #eee;
}
.q-toolbar a:hover {
  color: #fff;
}
</style>

<style>
.page-container-adjust {
  padding-top: 56px; /* desktop */
  max-width: 1024px;
  margin: auto;
}

@media (max-width: 599px) {
  .page-container-adjust {
    padding-top: 50px; /* mobile */
  }
}
</style>
