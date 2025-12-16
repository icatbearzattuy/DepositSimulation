# 💰 Deposito Larapel

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Flowbite](https://img.shields.io/badge/Flowbite-1A56DB?style=for-the-badge&logo=flowbite&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

**Deposito Larapel** adalah aplikasi simulasi perhitungan bunga deposito berbasis web yang dibangun menggunakan Laravel 11. Aplikasi ini memungkinkan pengguna untuk menghitung estimasi pendapatan bunga dari berbagai bank dan membandingkan penawaran terbaik.

## 🚀 Fitur Utama

### 👥 User (Pengguna)
- **Simulasi Deposito**: Hitung estimasi pendapatan bunga berdasarkan nominal, jangka waktu, dan pilihan bank.
- **Komparasi Bank**: Bandingkan keuntungan deposito dari semua bank yang tersedia secara otomatis (diurutkan dari keuntungan tertinggi).
- **Riwayat Simulasi**: Simpan dan lihat kembali riwayat simulasi yang pernah dilakukan.
- **Export PDF**: Unduh hasil simulasi dan riwayat dalam format PDF.
- **Dashboard User**: Ringkasan statistik simulasi pribadi (Total Simulasi, Total Potensi Bunga, dll).
- **Profil Pengguna**: Manajemen profil akun.

### 🛡️ Admin
- **Dashboard Admin**: Ringkasan data sistem.
- **Manajemen Bank**: Tambah, edit, dan hapus data bank beserta suku bunga dasarnya.
- **Monitoring Simulasi**: Melihat seluruh aktivitas simulasi yang dilakukan oleh pengguna.
- **Manajemen Akun Admin**: Login terpisah untuk keamanan.

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11, PHP 8.2+
- **Frontend**: Blade Templates, Tailwind CSS, Flowbite, Alpine.js
- **Database**: MySQL (Menggunakan Stored Procedure untuk logika penyimpanan simulasi)
- **PDF Generation**: DomPDF (via library terkait)

## 📦 Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di lokal komputer Anda:

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/deposito-larapel.git
    cd deposito-larapel
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    Salin file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
    Sesuaikan konfigurasi database di file `.env`:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate Key**
    ```bash
    php artisan key:generate
    ```

5.  **Migrasi Database**
    Jalankan migrasi untuk membuat tabel yang diperlukan:
    ```bash
    php artisan migrate
    ```
    *(Catatan: Pastikan Stored Procedure `sp_simuldep` juga dibuat di database Anda jika tidak termasuk dalam migrasi standar)*

6.  **Jalankan Server**
    Jalankan server Laravel dan Vite (untuk aset frontend) secara bersamaan (di terminal terpisah):
    ```bash
    php artisan serve
    npm run dev
    ```

7.  **Akses Aplikasi**
    Buka browser dan kunjungi: `http://127.0.0.1:8000`

## 🔒 Akun Default (Opsional)

Jika Anda menjalankan seeder, berikut adalah akun default yang mungkin tersedia (sesuaikan dengan seeder Anda):

-   **Admin**: `admin@example.com` / `password`
-   **User**: `user@example.com` / `password`

## 📝 Lisensi

Project ini dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).
