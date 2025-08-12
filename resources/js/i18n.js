import { createI18n } from 'vue-i18n';

const messages = {
  id: {
    add: 'Tambah',
    filter: 'Penyaringan',
    search: 'Cari',
  },
};

const i18n = createI18n({
  locale: 'id',
  messages,
});

export default i18n;
