# Urutan Pengerjaan & Eksekusi Unit Test

Berikut adalah tabel sistematis urutan unit test yang harus dilengkapi dan dijalankan. Urutan ini disusun berdasarkan dependensi antar modul (dari yang paling dasar/independen ke yang paling kompleks/dependen).

|  No   | Kategori                | Komponen / Class     | Lokasi File Test                                        |  Prioritas   | Status | Keterangan                                               |
| :---: | :---------------------- | :------------------- | :------------------------------------------------------ | :----------: | :----: | :------------------------------------------------------- |
| **1** | **Core Identity & ACL** |                      |                                                         |   **High**   |        | **Fondasi awal (User & Role)**                           |
|  1.1  | Model                   | `Role`               | `tests/Unit/Models/RoleTest.php`                        |      1       |   ✅   | Test relasi ke Permission & User, role assignment        |
|  1.2  | Model                   | `Permission`         | `tests/Unit/Models/PermissionTest.php`                  |      1       |   ✅   | Test role assignment, multiple permissions               |
|  1.3  | Model                   | `User`               | `tests/Unit/Models/UserTest.php`                        |      1       |   ✅   | Test factory, auth functions, relations, online check    |
| **2** | **Master Data**         |                      |                                                         |   **High**   |        | **Data referensi dasar**                                 |
|  2.1  | Model                   | `Periode`            | `tests/Unit/Models/PeriodeTest.php`                     |      2       |   ✅   | Test scope aktif/tidak aktif, validasi tanggal, relasi   |
|  2.2  | Model                   | `Jurusan`            | `tests/Unit/Models/JurusanTest.php`                     |      2       |   ✅   | Test kuota, kode jurusan, scope aktif/tersedia           |
|  2.3  | Model                   | `JenisBerkas`        | `tests/Unit/Models/JenisBerkasTest.php`                 |      2       |   ✅   | Test atribut file requirements                           |
| **3** | **Proses Bisnis Utama** |                      |                                                         | **Critical** |        | **Inti aplikasi PPDB**                                   |
|  3.1  | Model                   | `Gelombang`          | `tests/Unit/Models/GelombangTest.php`                   |      3       |   ✅   | Dependensi ke Periode. Test status buka/tutup            |
|  3.2  | Model                   | `Pendaftaran`        | `tests/Unit/Models/PendaftaranTest.php`                 |      4       |   ✅   | **Kompleks**. Test semua relasi, scope aktif, accessor   |
|  3.3  | Model                   | `OrangTuaSiswa`      | `tests/Unit/Models/OrangTuaSiswaTest.php`               |      4       |   ✅   | Dependensi ke Pendaftaran, test accessor                 |
|  3.4  | Model                   | `Berkas`             | `tests/Unit/Models/BerkasTest.php`                      |      4       |   ✅   | Dependensi ke Pendaftaran & JenisBerkas. Test verifikasi |
|  3.5  | Model                   | `Pengumuman`         | `tests/Unit/Models/PengumumanTest.php`                  |      3       |   ✅   | Test scope forUser dengan role filtering                 |
|  3.6  | Model                   | `Operator`           | `tests/Unit/Models/OperatorTest.php`                    |      3       |   ✅   | Test basic CRUD                                          |
| **4** | **Fitur Pendukung**     |                      |                                                         |  **Medium**  |        |                                                          |
|  4.1  | Exports                 | `RekapPPDBExport`    | `tests/Unit/Exports/RekapPPDBExportTest.php`            |      5       |   ✅   | Test filter jurusan, gelombang, status                   |
|  4.2  | Listeners               | `LogSuccessfulLogin` | `tests/Unit/Listeners/LogSuccessfulLoginTest.php`       |      5       |   ✅   | Test event recording, IP tracking                        |
| **5** | **Http Logic (Unit)**   |                      |                                                         |  **Medium**  |        | _Dicover juga via Feature Test_                          |
|  5.1  | Middleware              | `EnsureUserIsActive` | `tests/Unit/Http/Middleware/EnsureUserIsActiveTest.php` |      6       |   ✅   | Test active/inactive user, guest                         |
|  5.2  | Middleware              | `RoleRedirect`       | `tests/Unit/Http/Middleware/RoleRedirectTest.php`       |      6       |   ✅   | Test admin/user redirect logic                           |
|  5.3  | Middleware              | `UpdateLastActivity` | `tests/Unit/Http/Middleware/UpdateLastActivityTest.php` |      6       |   ✅   | Test activity tracking dengan timing                     |

## Summary

**Status Keseluruhan**: ✅ **SELESAI**

**Total Test Cases**: 16 komponen

- ✅ Selesai: 16
- ⬜ Belum: 0

**Coverage**:

- Models: 12/12 ✅
- Middleware: 3/3 ✅
- Exports: 1/1 ✅
- Listeners: 1/1 ✅

## Catatan

### Kualitas Test yang Telah Diterapkan:

1. **Comprehensive Coverage**: Setiap test mencakup happy path dan edge cases
2. **Isolation**: Menggunakan RefreshDatabase untuk memastikan setiap test independen
3. **Real World Scenarios**: Test mencerminkan use case nyata aplikasi PPDB
4. **Relationship Testing**: Semua relasi model di-test dengan benar
5. **Business Logic**: Scope, accessor, dan method bisnis telah di-test

### Cara Menjalankan Test:

```bash
# Jalankan semua unit test
php artisan test --testsuite=Unit

# Jalankan test spesifik berdasarkan kategori
php artisan test tests/Unit/Models
php artisan test tests/Unit/Http/Middleware
php artisan test tests/Unit/Exports
php artisan test tests/Unit/Listeners

# Jalankan dengan coverage report
php artisan test --coverage

# Jalankan test paralel untuk speed
php artisan test --parallel
```

### Next Steps (Opsional):

1. Feature Tests untuk flow end-to-end
2. Browser Tests dengan Dusk untuk UI testing
3. Integration Tests untuk external services
4. Performance Tests untuk load testing
