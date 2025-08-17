import { usePage } from "@inertiajs/vue3";

export const getQueryParams = (...args) => {
  const page = usePage();
  let queryString = page.url;
  if (queryString.indexOf("?") === -1) {
    return {};
  }
  queryString = queryString.substring(queryString.indexOf("?") + 1);
  return Object.assign(Object.fromEntries(new URLSearchParams(queryString)), ...args);
}

export function waSendUrl(phone, country_code = '62') {
  if (!phone) return '';

  // Hapus semua karakter non-digit (kecuali + di awal)
  const cleaned = phone.replace(/[^0-9]/g, '');

  // Validasi dasar: minimal 10 digit, diawali dengan 08 atau 62
  const isValid = /^(\+?62|08)[0-9]{8,}$/g.test(phone);

  if (!isValid) return '';

  // Normalisasi nomor ke format internasional (62)
  let waNumber = cleaned;
  if (waNumber.startsWith('08')) {
    waNumber = country_code + waNumber.slice(1);
  }

  return `https://wa.me/${waNumber}`;
}

export async function scrollToFirstErrorField(ref) {
  const element = ref.getNativeElement();
  if (element) {
    element.scrollIntoView({ behavior: 'smooth', block: 'center' });
    element.focus();
  }
}

