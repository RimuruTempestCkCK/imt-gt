# IMT-GT Business Marketplace & Directory

IMT-GT (Indonesia–Malaysia–Thailand Growth Triangle) Business Marketplace adalah sebuah platform direktori bisnis dan *business matching*. Website ini dirancang untuk menghubungkan para pelaku usaha (UMKM/Perusahaan) dengan calon mitra bisnis (*buyer*), memfasilitasi komunikasi B2B (Business to Business), serta mempromosikan produk lokal dari negara-negara kawasan IMT-GT ke tingkat internasional.

## 🚀 Fitur Utama

- **Katalog Produk & Direktori Perusahaan:** *Showcase* profil perusahaan dan katalog produk untuk pelaku usaha.
- **Business Matching (Inquiry System):** *Buyer* dapat mencari supplier dan mengirimkan penawaran/permintaan kerja sama bisnis.
- **Sistem Verifikasi:** Pendaftaran perusahaan diverifikasi oleh admin untuk menjaga kualitas direktori.
- **Portal Informasi:** Menyediakan berita, informasi program, dan peluang kerja sama IMT-GT.
- **Multi-Bahasa (Localization):** Mendukung Bahasa Indonesia dan Bahasa Inggris (serta dapat diperluas ke bahasa lain).
- **Dashboard Role-Based:** Area khusus dan hak akses untuk Admin, Pelaku Usaha (Supplier), dan Buyer.

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Frontend:** Blade Templating, Tailwind CSS
- **Database:** MySQL / MariaDB / PostgreSQL
- **Asset Bundler:** Vite

## ⚙️ Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & npm
- Database (MySQL/MariaDB/PostgreSQL)

## 📦 Panduan Instalasi

1. **Clone/Siapkan Repository**
   Buka terminal, dan arahkan ke folder proyek ini.

2. **Install dependensi PHP**
   ```bash
   composer install
   ```

3. **Install dependensi Node.js**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Atau untuk sistem Windows:
   ```cmd
   copy .env.example .env
   ```
   Lalu buka file `.env` dan sesuaikan konfigurasi database (bagian `DB_*`) dengan server lokal Anda.

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database & Seeding**
   Jalankan perintah ini untuk membuat struktur tabel di database Anda (tambahkan opsi `--seed` jika Anda memiliki data awal):
   ```bash
   php artisan migrate
   ```

7. **Kaitkan Storage (Symlink)**
   Agar gambar/file hasil *upload* dapat diakses oleh publik:
   ```bash
   php artisan storage:link
   ```

8. **Build Asset Frontend**
   Untuk tahap *development* (akan *auto-reload* jika ada perubahan):
   ```bash
   npm run dev
   ```
   Untuk *production* (kompilasi aset final):
   ```bash
   npm run build
   ```

9. **Jalankan Aplikasi**
   Buka tab terminal baru dan jalankan:
   ```bash
   php artisan serve
   ```
   Aplikasi sekarang dapat diakses melalui browser pada alamat `http://localhost:8000`

## 👥 Pengguna Sistem (Roles)

- **Admin:** Memiliki kontrol penuh mengelola CMS, menyetujui perusahaan baru, mengelola konten, dll.
- **Supplier (Pelaku Usaha):** Mendaftarkan profil perusahaannya, mengunggah katalog produk, dan merespons *inquiry*.
- **Buyer:** Pihak yang mencari produk atau perusahaan dan dapat mengirimkan *inquiry* kerja sama.
- **Guest / Publik:** Dapat mencari produk, melihat profil supplier publik, dan membaca berita tanpa perlu login.
