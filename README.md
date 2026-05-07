# Sistem Informasi Fungsional Jabatan BKPSDM

Sistem Informasi ini adalah platform manajemen jabatan fungsional untuk BKPSDM yang menangani siklus usulan pegawai, mencakup **Promosi, Mutasi, Demosi, dan Pemberhentian**.

Sistem ini menggunakan alur verifikasi 2 tahap (Berkas dan Substansi) untuk memproses usulan, serta dilengkapi dengan fitur pelaporan dan penonaktifan otomatis pegawai.

## Kebutuhan Sistem (System Requirements)
- **PHP**: >= 8.2 (Sangat penting karena dependensi Laravel 11 membutuhkan versi PHP ini)
- **Composer**: >= 2.0
- **Database**: MySQL / MariaDB
- **Web Server**: Apache / Nginx (Atau Laragon, XAMPP dengan PHP 8.2)

## Panduan Instalasi (Installation Guide)

1. **Clone/Download Repository**
   Pastikan folder proyek berada di direktori web server Anda (misal: `c:\laragon\www\Sistem_Fungsional_Jabatan`).

2. **Konfigurasi Lingkungan (Environment)**
   Salin file `.env.example` menjadi `.env`.
   ```bash
   copy .env.example .env
   ```
   Buka file `.env` dan atur koneksi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=si_jabfung_bkpsdm
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Install Dependensi**
   Jalankan composer install:
   ```bash
   composer install
   ```

4. **Generate App Key**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi dan Seeding Database**
   Jalankan perintah berikut untuk mengupdate skema database sesuai dengan revisi terbaru (penambahan enum status usulan, status_aktif pegawai, dan log integrasi), sekaligus memasukkan data dummy pengguna (Admin, Verifikator, dll):
   ```bash
   php artisan migrate --seed
   ```
   *Jika sebelumnya sudah ter-migrate, jalankan:* `php artisan db:seed`

6. **Storage Link**
   Untuk memastikan file upload dapat diakses publik:
   ```bash
   php artisan storage:link
   ```

7. **Jalankan Aplikasi**
   Jika menggunakan Laragon, akses melalui `http://sistem_fungsional_jabatan.test`.
   Jika menggunakan perintah Artisan:
   ```bash
   php artisan serve
   ```
   Buka browser dan akses `http://localhost:8000`.

## Kredensial Login Pengguna (Role User)

Berikut adalah daftar pengguna yang bisa digunakan untuk mencoba masing-masing akses peran (semua password default adalah `password`):

| Role / Peran | Username | Password | Deskripsi Akses |
| :--- | :--- | :--- | :--- |
| **Admin Sistem** | `admin_sistem` | `password` | Mengelola data master (OPD, User, Besetting) |
| **Admin OPD 1** | `admin_opd2` | `password` | Mengelola data pegawai dan mengajukan usulan (Dinas Pendidikan) |
| **Admin OPD 2** | `admin_opd` | `password` | Mengelola data pegawai dan mengajukan usulan (Dinas Kesehatan) |
| **Verifikator** | `verifikator` | `password` | Melakukan verifikasi usulan 2 tahap (Berkas & Substansi) |
| **Admin Administrasi**| `admin_administrasi` | `password` | Mengelola SK, Persetujuan Bahan Rapat, dan Laporan Ekspor CSV |

## Alur Singkat
1. **Admin OPD** menambahkan pegawai dan mengajukan usulan (Promosi/Mutasi/Demosi/Pemberhentian). Jika pegawai di-*resign*-kan (dinonaktifkan), semua usulannya otomatis dibatalkan.
2. **Verifikator** memeriksa usulan. Tahap 1: Verifikasi kelengkapan berkas (Bisa direvisi). Tahap 2: Verifikasi substansi (Bisa disetujui, ditolak, atau dibatalkan). Jika disetujui, Bahan Rapat akan digenerate otomatis.
3. **Admin Administrasi** dapat melihat rekapitulasi usulan (dengan filter bulan & tahun) dan mengekspor datanya menjadi file CSV.
