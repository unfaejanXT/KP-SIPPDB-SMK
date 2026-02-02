# 🎓 SIPPDB - SMKS Solusi Bangun Indonesia

**Sistem Informasi Penerimaan Peserta Didik Baru Berbasis Web**

![Status Beta](https://img.shields.io/badge/Status-Beta-orange?style=for-the-badge&logo=statuspage&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel_11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![PHP 8.2](https://img.shields.io/badge/PHP_8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)

> ⚠️ **INFORMATION: BETA PHASE**
>
> Project ini saat ini sedang dalam **Fase Beta**. Semua fitur inti telah diimplementasikan namun masih dalam tahap pengujian dan penyempurnaan. Mohon laporkan jika Anda menemukan _bug_ atau kendala teknis. Masukan Anda sangat berharga untuk pengembangan sistem ini.

## 📖 Tentang Aplikasi

**SIPPDB SMKS Solusi Bangun Indonesia** adalah aplikasi berbasis web yang dirancang untuk mendigitalkan dan mempermudah proses Penerimaan Peserta Didik Baru (PPDB). Sistem ini menangani seluruh alur penerimaan mulai dari pendaftaran online calon siswa, verifikasi berkas oleh admin, pengelolaan gelombang pendaftaran, hingga pengumuman hasil seleksi.

Dibangun dengan **Laravel 11** dan **Tailwind CSS**, aplikasi ini menawarkan antarmuka yang modern, responsif, dan mudah digunakan baik oleh pengelola sekolah maupun calon siswa.

## ✨ Fitur Unggulan

### 👨‍🎓 Portal Calon Siswa

- **Pendaftaran Online**: Formulir pendaftaran _multi-step_ yang intuitif dan validasi real-time.
- **Upload Berkas**: Unggah dokumen persyaratan (KK, Ijazah, Foto) dengan aman.
- **Cetak Bukti**: Generate otomatis Kartu Ujian dan Bukti Pendaftaran (PDF).
- **Cek Status**: Pantau status kelulusan dan pengumuman secara mandiri.

### 👨‍🏫 Panel Admin & Operator

- **Dashboard Statistik**: Ringkasan data pendaftar, kuota, dan status gelombang secara visual.
- **Manajemen Gelombang**: Kontrol penuh pembukaan/penutupan gelombang dan kuota.
- **Verifikasi Online**: Validasi data dan berkas calon siswa tanpa perlu tatap muka.
- **Seleksi Otomatis/Manual**: Proses penentuan kelulusan siswa.
- **Laporan & Export**: Unduh data pendaftar dalam format Excel dan PDF.
- **Role Management**: Hak akses bertingkat (Admin, Operator, Siswa) menggunakan _Spatie Permission_.

## 🛠️ Teknologi (Tech Stack)

Project ini dibangun menggunakan _stack_ teknologi modern untuk performa dan keamanan maksimal:

- **Backend**: [Laravel 11](https://laravel.com)
- **Frontend**: [Blade Templates](https://laravel.com/docs/blade), [Tailwind CSS](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev)
- **Database**: MySQL
- **Testing**: PHPUnit (Feature Testing), Playwright (E2E)
- **Dependencies Utama**:
    - `spatie/laravel-permission`: Manajemen Hak Akses (RBAC).
    - `yajra/laravel-datatables`: Tabel data interaktif server-side.
    - `barryvdh/laravel-dompdf`: Cetak dokumen PDF.
    - `maatwebsite/excel`: Export dan Import data Excel.
    - `sweetalert2`: Notifikasi popup yang interaktif.
    - `chart.js`: Visualisasi grafik statistik.

## ⚙️ Instalasi & Penggunaan

Ikuti langkah berikut untuk menjalankan project di komputer lokal:

1.  **Clone Repositori**

    ```bash
    git clone https://github.com/unfaejanXT/KP-SIPPDB-SMK.git
    cd KP-SIPPDB-SMK
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` ke `.env`:

    ```bash
    cp .env.example .env
    ```

    Sesuaikan konfigurasi database di file `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=si_ppdb_smk  # Sesuaikan dengan nama database Anda
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate Key & Storage Link**

    ```bash
    php artisan key:generate
    php artisan storage:link
    ```

5.  **Migrasi Database & Seeding**
    Pastikan database sudah dibuat, lalu jalankan:

    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Aplikasi**
    Buka dua terminal terpisah:

    ```bash
    # Terminal 1: Laravel Server
    php artisan serve

    # Terminal 2: Vite (Frontend Assets)
    npm run dev
    ```

7.  **Akses Aplikasi**
    Buka browser dan kunjungi: `http://localhost:8000`

## 🧪 Testing

Untuk memastikan semua fitur berjalan dengan baik, Anda dapat menjalankan _feature test_ yang telah disediakan:

```bash
php artisan test
```

## 📚 Dokumentasi

Dokumentasi teknis lengkap seperti diagram UML (Activity, Sequence, Class Diagram) dapat ditemukan di direktori `docs/`.

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---

_Dibuat oleh [unfaejanXT] untuk Kerja Praktek di SMKS Solusi Bangun Indonesia._
