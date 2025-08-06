# 🕌 SiPontren
**Sistem Informasi Pondok Pesantren** — platform digitalisasi untuk manajemen data pesantren dan lembaga pendidikan Islam seperti MTs, MA, SMK, dan madrasah tahfidz.

---

## 📌 Tujuan
SiPontren dikembangkan untuk mendukung:
- Digitalisasi akademik dan pondok secara terpadu
- Efisiensi pengelolaan administrasi, absensi, nilai, hafalan, dan keuangan
- Peningkatan transparansi kepada wali santri dan pengajar
- Sistem ini bersifat **non-multi-tenant** dan dikembangkan **custom untuk setiap lembaga**, agar fleksibel dengan kebutuhan lokal dan tidak membebani lembaga dengan sistem berbayar bulanan.

---

## ⚙️ Teknologi
- **Backend**: Laravel 11
- **Frontend**: Quasar + Inertia.js + Vue 3 (SPA dengan Laravel rendering)
- **Database**: MySQL
- **Deployment**: Shared Hosting atau VPS ringan (tanpa SSH)

---

## 🧱 Arsitektur & Struktur Modul
SiPontren dikembangkan dalam bentuk **monolith modular**, artinya:
- Semua fitur dalam satu aplikasi
- Setiap domain (akademik, pondok, keuangan) dipisah dalam struktur modul

### Struktur Direktori
app/
└── Modules/
    ├── Akademik/
    ├── Pondok/
    ├── Keuangan/
    ├── Shared/
resources/js/
└── pages/
    ├── akademik/
    ├── pondok/
    ├── keuangan/
    └── dashboard.vue
routes/
└── modules/
    ├── akademik.php
    ├── pondok.php
    └── keuangan.php
config/
└── instansi.php


## 🚀 Instalasi Lokal
### Persyaratan:
- PHP >= 8.2
- Node.js >= 18
- Composer
- MySQL/MariaDB

### Langkah-langkah:
```bash
git clone https://github.com/shiftech-my-id/sipontren.git
cd sipontren

# Install backend
composer install

# Copy environment
cp .env.example .env
php artisan key:generate

# Konfigurasi database di .env, lalu:
php artisan migrate --seed

# Install frontend
npm install
npm run dev
```

## 👥 Role & Akses

Admin: Semua modul
Guru: Akademik, Pondok
Santri: Dashboard, Hafalan
Wali Santri: Monitoring anak, tagihan
TU: Absensi, Akademik
Keuangan: Pembayaran, laporan

Sistem akan mendeteksi role setelah login dan mengarahkan ke dashboard sesuai peran.

## 🎯 Modul MVP (Tahap Pertama)
- Login multi role
- Dashboard dinamis
- Manajemen santri & pengajar
- Absensi
- Nilai & Raport
- Hafidz Monitor

## ☁️ Deployment ke Shared Hosting
- Upload folder public ke public_html/
- Upload sisa aplikasi ke folder laravel/
- Edit index.php agar path-nya menuju ke folder laravel/bootstrap/...
- Jalankan composer install, php artisan migrate via terminal lokal lalu upload hasilnya

## 📄 Lisensi
Proyek ini dikembangkan secara private/custom. Tidak diperuntukkan sebagai SaaS publik, dan hanya boleh didistribusikan dalam bentuk project yang disepakati bersama.

## 🙏 Kontribusi
Jika Anda adalah bagian dari tim pengembangan instansi terkait, silakan gunakan Git untuk versioning dan koordinasi update modul melalui branch.

## 📬 Kontak
Developer: Fahmi Fauzi Rahman
Email: [fahmifauzirahman@gmail.com]
WhatsApp: +62853-1740-4760