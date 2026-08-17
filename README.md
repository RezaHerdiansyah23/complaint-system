# Sistem Informasi Keluhan Pelanggan

Platform manajemen keluhan pelanggan berbasis web yang dibangun dengan Laravel. Memungkinkan pelanggan menyampaikan keluhan, admin memverifikasi dan mendistribusikan, serta tim NOC menangani setiap tiket hingga selesai.

---

## Fitur Utama

- **3 Role Pengguna** — Customer, Admin, dan NOC dengan dashboard masing-masing
- **Alur Keluhan** — Customer buat keluhan → Admin verifikasi & assign → NOC tangani → Customer beri feedback
- **Manajemen Pengguna** — Admin dapat membuat, mengedit, dan menghapus akun
- **Statistik** — Grafik keluhan per bulan/tahun untuk Admin
- **Dark / Light Mode** — Toggle tema tersimpan di browser
- **Sidebar Collapsible** — Sidebar bisa diperkecil untuk ruang kerja yang lebih luas

---

## Kebutuhan Sistem

Pastikan perangkat Anda sudah terinstall:

| Kebutuhan | Versi Minimum |
|-----------|---------------|
| PHP | 8.2 |
| Composer | 2.x |
| Node.js | 18.x |
| NPM | 9.x |
| Database | SQLite (default) atau MySQL 8.x |

---

## Langkah Instalasi

### 1. Clone atau Ekstrak Project

Jika menggunakan Git:
```bash
git clone <url-repository> complaint-system
cd complaint-system
```

Jika menerima file ZIP, ekstrak lalu masuk ke folder project.

---

### 2. Install Dependency PHP

```bash
composer install
```

---

### 3. Salin File Konfigurasi

```bash
cp .env.example .env
```

Kemudian buka file `.env` dan sesuaikan konfigurasi berikut:

```env
APP_NAME="Sistem Keluhan Pelanggan"
APP_URL=http://localhost:8000
```

**Jika menggunakan MySQL** (opsional, default sudah SQLite):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=password_anda
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Jalankan Migrasi Database

```bash
php artisan migrate
```

---

### 6. Isi Data Awal (Akun Admin & NOC)

```bash
php artisan db:seed
```

Perintah ini akan membuat dua akun default:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@mail.com | password |
| NOC | noc@mail.com | password |

> **Penting:** Ganti password akun-akun ini setelah pertama kali login melalui menu **Profil Akun**.

---

### 7. Buat Link Storage (untuk Upload Lampiran)

```bash
php artisan storage:link
```

---

### 8. Install Dependency Frontend

```bash
npm install
```

---

### 9. Build Asset Frontend

Untuk **production**:
```bash
npm run build
```

Untuk **development** (dengan hot reload):
```bash
npm run dev
```

---

### 10. Jalankan Server

```bash
php artisan serve
```

Aplikasi dapat diakses di: **http://localhost:8000**

---

## Cara Login

1. Buka **http://localhost:8000**
2. Klik **Masuk Ke Aplikasi**
3. Gunakan akun sesuai role yang diinginkan (lihat tabel di langkah 6)
4. Untuk mendaftar sebagai **Customer**, klik **Daftar Akun Baru** di halaman login

---

## Struktur Role & Akses

```
Customer  →  /dashboard         (buat keluhan, lihat riwayat, beri feedback)
Admin     →  /admin             (verifikasi keluhan, assign ke NOC, kelola user, statistik)
NOC       →  /noc               (lihat & tangani keluhan yang ditugaskan)
```

---

## Perintah Berguna

| Perintah | Fungsi |
|----------|--------|
| `php artisan migrate:fresh --seed` | Reset database dan isi ulang data awal |
| `php artisan view:clear` | Hapus cache view Blade |
| `php artisan optimize:clear` | Hapus semua cache aplikasi |
| `php artisan storage:link` | Buat symlink untuk file upload |

---

## Troubleshooting

**Halaman error 500 setelah install**
- Pastikan file `.env` sudah ada dan `APP_KEY` sudah terisi
- Jalankan `php artisan optimize:clear`

**Upload lampiran tidak muncul**
- Jalankan `php artisan storage:link`

**CSS/tampilan tidak muncul atau berantakan**
- Jalankan `npm run build` ulang

**Tidak bisa login padahal password benar**
- Pastikan migrasi dan seeder sudah dijalankan
- Coba `php artisan migrate:fresh --seed`

---

## Tech Stack

- **Backend** — Laravel 12, PHP 8.2
- **Frontend** — Blade, Tailwind CSS, Alpine.js
- **Build Tool** — Vite
- **Database** — SQLite (default) / MySQL
