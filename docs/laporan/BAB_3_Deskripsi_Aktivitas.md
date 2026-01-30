**3.2 Deskripsi Aktivitas**

Deskripsi aktivitas ini menjelaskan tentang metode yang dilakukan saat melakukan pelaksanaan kerja praktik di SMK untuk membangun Sistem Informasi Penerimaan Peserta Didik Baru (SIPPDB). Aktivitas-aktivitas ini merupakan aktivitas yang dideskripsikan pada metode _Waterfall_. Metode _Waterfall_ adalah model pengembangan sistem yang bersifat sekuensial dan sistematis. Tahapan yang dilakukan meliputi komunikasi (_Communication_), perencanaan (_Planning_), pemodelan (_Modeling_), konstruksi (_Construction_), dan penyerahan (_Deployment_).

**3.2.1 Komunikasi (_Communication_)**

Tahap ini merupakan langkah awal pengumpulan data dengan pihak sekolah untuk mengidentifikasi kebutuhan penelitian melalui teknik wawancara dan observasi. Hal ini dilakukan untuk memahami proses bisnis yang sedang berjalan serta menentukan kebutuhan sistem yang akan dibangun.

**3.2.1.1 _Project Initiation_**

Penulis melakukan inisiasi proyek dengan mengidentifikasikan kebutuhan proyek, penilaian masalah, serta langkah apa yang akan dikerjakan selanjutnya. Berikut ringkasan dari inisiasi proyek tersebut:

a. _Project Description and Goals_

Aplikasi Sistem Informasi Penerimaan Peserta Didik Baru (SIPPDB) pada SMK berbasis _web_ adalah aplikasi yang melibatkan penggunaan teknologi _web_ untuk mengelola data pendaftaran, memberikan informasi terkait jadwal dan pengumuman, serta memudahkan panitia dalam verifikasi berkas dan pembuatan laporan. Tujuan sistem ini adalah untuk mendigitalkan proses pendaftaran yang sebelumnya manual, meminimalkan kesalahan pencatatan, serta memudahkan calon siswa dalam mendaftar tanpa harus datang langsung ke sekolah.

b. _Project Requirements_

1. Fungsional
    - Sistem dapat memvalidasi _login_ pengguna (Admin dan Calon Siswa).
    - Calon Siswa dapat mengisi biodata dan data orang tua.
    - Calon Siswa dapat mengunggah (_upload_) dokumen persyaratan.
    - Calon Siswa dapat mencetak bukti pendaftaran.
    - Calon Siswa dapat melihat pengumuman hasil seleksi.
    - Admin dapat mengelola data jurusan dan gelombang pendaftaran.
    - Admin dapat memverifikasi berkas pendaftaran calon siswa.
    - Admin dapat mengelola akun pengguna.
    - Admin dapat mencetak laporan rekapitulasi data pendaftaran.

2. Nonfungsional
    - Sistem Operasi: Windows 10/11.
    - Bahasa Pemrograman: PHP (menggunakan _Framework_ Laravel).
    - Basis Data: MySQL.
    - _Web Server_: Apache (XAMPP/Laragon).
    - _Text Editor_: Visual Studio Code.
    - Peramban (_Browser_): Google Chrome atau Mozilla Firefox.

**3.2.2 Perencanaan (_Planning_)**

Pada tahap ini penulis membuat penjadwalan kerja praktik yang bertujuan untuk mengelola setiap tahapan agar dapat terlaksana sesuai waktu yang telah ditentukan. Estimasi waktu pengerjaan alur kerja disesuaikan dengan kebutuhan pengembangan sistem mulai dari analisis, desain, pengkodean, hingga pengujian.

**3.2.3 Pemodelan (_Modeling_)**

Tahap pemodelan dilakukan untuk merancang struktur dan logika sistem sebelum tahap implementasi. Penulis menggunakan _Unified Modeling Language_ (UML) untuk memvisualisasikan rancangan sistem.

- _Activity Diagram_: Menggambarkan alur aktivitas dalam sistem, seperti alur pendaftaran dan verifikasi.
- _Use Case Diagram_: Menggambarkan fungsionalitas sistem dari sudut pandang aktor (Calon Siswa dan Admin).
- _Sequence Diagram_: Menggambarkan interaksi antar objek dalam urutan waktu.
- _Class Diagram_: Menggambarkan struktur kelas dan relasi antar kelas dalam sistem.
- _Entity Relationship Diagram_ (ERD): Menggambarkan struktur basis data dan hubungan antar entitas.

**3.2.4 Konstruksi (_Construction_)**

Tahap ini adalah tahap penerjemahan hasil perancangan ke dalam kode program.

- Implementasi Basis Data: Pembuatan tabel dan relasi pada MySQL.
- Implementasi Kode: Penulisan kode program menggunakan bahasa PHP dengan kerangka kerja Laravel yang menerapkan konsep _Model-View-Controller_ (MVC). Halaman antarmuka (_frontend_) dibangun menggunakan HTML, CSS, dan _JavaScript_.

**3.2.5 Penyerahan (_Deployment_)**

Tahap terakhir adalah pengujian dan penerapan sistem.

- Pengujian (_Testing_): Dilakukan untuk memastikan fungsi-fungsi sistem berjalan dengan benar dan bebas dari kesalahan (_bug_).
- Penerapan: Sistem dijalankan pada peladen (_server_) lokal atau _hosting_ agar dapat diakses oleh pengguna untuk simulasi atau penggunaan nyata.
