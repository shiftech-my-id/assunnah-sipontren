<script setup>
import { formatDateTime, formatDateTimeFromNow } from "@/helpers/formatter";
import { router, usePage } from "@inertiajs/vue3";

const page = usePage();
const title = "Rincian Pengguna";
</script>

<template>
  <i-head :title="title" />
  <authenticated-layout>
    <template #title>{{ title }}</template>
    <template #left-button>
      <div class="q-gutter-sm">
        <q-btn
          icon="arrow_back"
          dense
          color="grey-7"
          flat
          rounded
          @click="router.get(route('sys-admin.user.index'))"
        />
      </div>
    </template>
    <template #right-button>
      <div class="q-gutter-sm">
        <q-btn
          v-if="$can('admin.user.edit')"
          icon="edit"
          dense
          color="primary"
          @click="
            router.get(route('sys-admin.user.edit', { id: page.props.data.id }))
          "
        />
      </div>
    </template>
    <div class="row justify-center">
      <div class="col col-lg-6 q-pa-sm">
        <div class="row">
          <q-card square flat bordered class="col">
            <q-card-section>
              <div class="text-subtitle1 text-bold text-grey-9">
                Profil Pengguna
              </div>
              <table class="detail">
                <tbody>
                  <tr>
                    <td style="width: 125px">Username</td>
                    <td style="width: 1px">:</td>
                    <td>{{ page.props.data.username }}</td>
                  </tr>
                  <tr>
                    <td>Nama Pengguna</td>
                    <td>:</td>
                    <td>{{ page.props.data.name }}</td>
                  </tr>
                  <tr>
                    <td>Jenis Akun</td>
                    <td>:</td>
                    <td>
                      {{
                        page.props.data.is_root
                          ? "Super Administrator"
                          : "Standar"
                      }}
                    </td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>
                      {{ page.props.data.active ? "Aktif" : "Non Aktif" }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="text-subtitle1 text-bold text-grey-9">
                        Info Rekaman
                      </div>
                    </td>
                  </tr>
                  <tr v-if="page.props.data.created_at">
                    <td>Dibuat</td>
                    <td>:</td>
                    <td>
                      {{ formatDateTimeFromNow(page.props.data.created_at) }} -
                      {{ formatDateTime(page.props.data.created_at) }}
                    </td>
                  </tr>
                  <tr v-if="page.props.data.updated_at">
                    <td>Diperbarui</td>
                    <td>:</td>
                    <td>
                      {{ formatDateTimeFromNow(page.props.data.updated_at) }} -
                      {{ formatDateTime(page.props.data.updated_at) }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="text-subtitle1 text-bold text-grey-9">
                        Info Aktifitas
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Terakhir login</td>
                    <td>:</td>
                    <td>
                      <template v-if="page.props.data.last_login_datetime">
                        {{
                          formatDateTimeFromNow(
                            page.props.data.last_login_datetime
                          )
                        }}
                        -
                        {{
                          formatDateTime(page.props.data.last_login_datetime)
                        }}
                      </template>
                      <template v-else> Belum pernah login </template>
                    </td>
                  </tr>
                  <tr v-if="page.props.data.last_activity_datetime">
                    <td>Aktifitas Terakhir</td>
                    <td>:</td>
                    <td>
                      {{
                        formatDateTimeFromNow(
                          page.props.data.last_activity_datetime
                        )
                      }}
                      -
                      {{
                        formatDateTime(page.props.data.last_activity_datetime)
                      }}
                      <br />Jenis aktifitas:
                      {{ page.props.data.last_activity_description }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </q-card-section>
          </q-card>
        </div>
      </div>
    </div>
  </authenticated-layout>
</template>
