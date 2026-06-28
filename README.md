# Platform PANDU (Pantau Alokasi Naker & Distribusi Unit) 🚜👷‍♂️

PANDU adalah sistem informasi manajemen lapangan berbasis *web* dan PWA (Progressive Web App) yang dirancang khusus untuk **Dinas Pekerjaan Umum dan Penataan Ruang (PUPR) Kota Depok**. Aplikasi ini memudahkan pelacakan absensi pekerja lapangan (Mandor) dan memantau status alat berat di berbagai lokasi proyek secara *real-time*.

## ✨ Fitur Utama
* **Dashboard Pimpinan (Admin):** Pemantauan komprehensif seluruh lokasi proyek, alat berat yang beroperasi/menganggur (*idle*), dan rekapitulasi laporan harian.
* **Dashboard Mandor (Pekerja):** Antarmuka responsif (*mobile-first*) berbasis PWA yang elegan.
* **Absensi GPS (Geofencing):** Pekerja hanya bisa melakukan absensi (Masuk/Pulang) jika berada di dalam radius proyek yang telah ditentukan.
* **Manajemen Perangkat Tunggal:** Satu akun Mandor hanya dapat *login* di satu perangkat (*smartphone*) untuk mencegah kecurangan.
* **Progressive Web App (PWA):** Dapat diinstal langsung ke layar utama *smartphone* layaknya aplikasi *native* dan dapat digunakan dengan jaringan minimum.

---

## 🚀 Cara Menjalankan Aplikasi (Lokal)

Jika Anda ingin mencoba menjalankan aplikasi ini di komputer Anda, ikuti langkah-langkah berikut:

### Persyaratan Sistem
* PHP >= 8.2
* Composer
* Node.js & NPM (Opsional untuk *build assets*)

### Instalasi
1. Buka terminal (Command Prompt / PowerShell / Git Bash) di *folder* proyek.
2. Salin *file* konfigurasi `.env`:
   ```bash
   cp .env.example .env
   ```
   *(Pastikan `DB_CONNECTION=sqlite` di dalam file `.env`)*
3. Install semua *dependency* PHP menggunakan Composer:
   ```bash
   composer install
   ```
4. Buat kunci (*key*) aplikasi Laravel:
   ```bash
   php artisan key:generate
   ```
5. Siapkan *database* dan isi dengan data percobaan (*dummy data*):
   ```bash
   php artisan migrate:fresh --seed
   ```
6. Jalankan server lokal:
   ```bash
   php artisan serve
   ```
7. Buka *browser* dan kunjungi tautan: **`http://localhost:8000`**

---

## 🔑 Akses Akun Percobaan (Demo)

Gunakan akun berikut untuk mencoba masuk ke dalam aplikasi:

**1. Akun Pimpinan (Dashboard Desktop)**
* **Email:** `admin@pupr-depok.go.id`
* **Password:** `admin123`

**2. Akun Mandor (Tampilan Mobile/Smartphone)**
* **Email:** `budi@pupr.go.id`
* **Password:** `password123`

> **Tips Pengujian Mandor:** Fitur absensi Mandor akan mendeteksi lokasi GPS. Untuk bisa menekan tombol **Absen Masuk**, Anda harus mengizinkan akses lokasi di *browser*. (Pada mode uji coba lokal, pastikan lokasi GPS Anda di-set menyerupai koordinat proyek yang ada di *database* atau sesuaikan di menu Pimpinan).

---
*Dibuat menggunakan Laravel 11, Bootstrap 5, dan SQLite.*
