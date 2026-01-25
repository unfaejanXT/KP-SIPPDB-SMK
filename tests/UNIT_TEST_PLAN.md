# Urutan Pengerjaan & Eksekusi Unit Test

Berikut adalah tabel sistematis urutan unit test yang harus dilengkapi dan dijalankan. Urutan ini disusun berdasarkan dependensi antar modul (dari yang paling dasar/independen ke yang paling kompleks/dependen).

| No | Kategori | Komponen / Class | Lokasi File Test | Prioritas | Status | Keterangan |
|:--:|:--- |:--- |:--- |:--:|:--:|:--- |
| **1** | **Core Identity & ACL** | | | **High** | | **Fondasi awal (User & Role)** |
| 1.1 | Model | `Role` | `tests/Unit/Models/RoleTest.php` | 1 | ⬜ | Tes relasi ke Permission & User |
| 1.2 | Model | `Permission` | `tests/Unit/Models/PermissionTest.php` | 1 | ⬜ | Tes role assignment |
| 1.3 | Model | `User` | `tests/Unit/Models/UserTest.php` | 1 | ⬜ | Tes factory, auth functions, relations |
| **2** | **Master Data** | | | **High** | | **Data referensi dasar** |
| 2.1 | Model | `Periode` | `tests/Unit/Models/PeriodeTest.php` | 2 | ⬜ | Tes scope aktif/tidak aktif, validasi tanggal |
| 2.2 | Model | `Jurusan` | `tests/Unit/Models/JurusanTest.php` | 2 | ⬜ | Tes kuota, kode jurusan |
| 2.3 | Model | `JenisBerkas` | `tests/Unit/Models/JenisBerkasTest.php` | 2 | ⬜ | Tes atribut file requirements |
| **3** | **Proses Bisnis Utama** | | | **Critical** | | **Inti aplikasi PPDB** |
| 3.1 | Model | `Gelombang` | `tests/Unit/Models/GelombangTest.php` | 3 | ⬜ | Dependensi ke Periode. Tes status buka/tutup |
| 3.2 | Model | `Pendaftaran` | `tests/Unit/Models/PendaftaranTest.php` | 4 | ⬜ | **Kompleks**. Dependensi User, Gelombang, Jurusan. Tes status flow, nomor pendaftaran check |
| 3.3 | Model | `OrangTuaSiswa` | `tests/Unit/Models/OrangTuaSiswaTest.php` | 4 | ⬜ | Dependensi ke Pendaftaran/User |
| 3.4 | Model | `Berkas` | `tests/Unit/Models/BerkasTest.php` | 4 | ⬜ | Dependensi ke Pendaftaran & JenisBerkas. Tes path storage |
| 3.5 | Model | `Pengumuman` | `tests/Unit/Models/PengumumanTest.php` | 3 | ⬜ | Tes scope publish |
| 3.6 | Model | `Operator` | `tests/Unit/Models/OperatorTest.php` | 3 | ⬜ | Jika ada logic khusus operator |
| **4** | **Fitur Pendukung** | | | **Medium** | | |
| 4.1 | Exports | `RekapPPDBExport` | `tests/Unit/Exports/RekapPPDBExportTest.php` | 5 | ⬜ | Tes struktur export excel |
| 4.2 | Listeners | `LogSuccessfulLogin` | `tests/Unit/Listeners/LogSuccessfulLoginTest.php` | 5 | ⬜ | Tes event recording |
| **5** | **Http Logic (Unit)** | | | **Low** | | *Sebaiknya dicover juga via Feature Test* |
| 5.1 | Middleware | `EnsureUserIsActive` | `tests/Unit/Http/Middleware/EnsureUserIsActiveTest.php` | 6 | ⬜ | |
| 5.2 | Middleware | `RoleRedirect` | `tests/Unit/Http/Middleware/RoleRedirectTest.php` | 6 | ⬜ | |
| 5.3 | Middleware | `UpdateLastActivity` | `tests/Unit/Http/Middleware/UpdateLastActivityTest.php` | 6 | ⬜ | |
| **6** | **View Components** | | | **Low** | | |
| 6.1 | View | `AppLayout` | `tests/Unit/View/Components/AppLayoutTest.php` | 7 | ⬜ | |
| 6.2 | View | `GuestLayout` | `tests/Unit/View/Components/GuestLayoutTest.php` | 7 | ⬜ | |
