<script setup>
import { router } from "@inertiajs/vue3";
import UpdatePasswordForm from "./partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./partials/UpdateProfileInformationForm.vue";

const title = "Profil Saya";
</script>

<template>
  <i-head :title="title" />
  <authenticated-layout>
    <template #left-button>
      <q-btn
        flat
        rounded
        dense
        icon="arrow_back"
        @click="router.visit(route('staff-portal.index'))"
      />
    </template>
    <template #title>{{ title }}</template>
    <div class="q-pa-sm">
      <div class="row justify-center">
        <div class="col col-md-6">
          <UpdateProfileInformationForm class="q-mb-md" />
          <UpdatePasswordForm />
        </div>
      </div>
    </div>
  </authenticated-layout>
</template>
