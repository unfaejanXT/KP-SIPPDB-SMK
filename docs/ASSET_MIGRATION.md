# Perubahan Asset dari CDN ke Lokal

## Ringkasan Perubahan

Semua asset yang sebelumnya dimuat dari CDN sekarang dimuat secara lokal menggunakan Vite bundle untuk meningkatkan performa, keandalan, dan kontrol terhadap dependensi.

## Library yang Telah Dimigrasikan

### 1. **Tailwind CSS** ✅

- **Sebelumnya**: `https://cdn.tailwindcss.com`
- **Sekarang**: Diload via Vite dari `node_modules/tailwindcss`
- **File konfigurasi**: `tailwind.config.js`, `resources/css/app.css`

### 2. **Alpine.js** ✅

- **Sebelumnya**: `https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js`
- **Sekarang**: Diload via Vite dari `node_modules/alpinejs`
- **File**: `resources/js/app.js`

### 3. **Chart.js** ✅

- **Sebelumnya**: `https://cdn.jsdelivr.net/npm/chart.js`
- **Sekarang**: Diload via Vite dari `node_modules/chart.js`
- **File**: `resources/js/app.js`
- **Global variable**: `window.Chart`

### 4. **Font Awesome** ✅

- **Sebelumnya**: `https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css`
- **Sekarang**: Diload via Vite dari `node_modules/@fortawesome/fontawesome-free`
- **File**: `resources/css/app.css`

### 5. **Bootstrap Icons** ✅

- **Sebelumnya**: `https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css`
- **Sekarang**: Diload via Vite dari `node_modules/bootstrap-icons`
- **File**: `resources/css/app.css`

### 6. **SweetAlert2** ✅

- **Sebelumnya**: `https://cdn.jsdelivr.net/npm/sweetalert2@11`
- **Sekarang**: Diload via Vite dari `node_modules/sweetalert2`
- **File**: `resources/js/app.js`, `resources/css/app.css`
- **Global variable**: `window.Swal`

### 7. **Google Fonts (Inter)** ⚠️

- **Status**: Tetap menggunakan CDN Google Fonts
- **Alasan**: Google Fonts CDN sudah optimal dengan cache global dan font loading strategy
- **URL**: `https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap`

## File yang Diubah

### Layout Files

1. `resources/views/layouts/admin.blade.php` - Admin dashboard layout
2. `resources/views/layouts/student.blade.php` - Student dashboard layout
3. `resources/views/layouts/app.blade.php` - Main application layout
4. `resources/views/layouts/atomic.blade.php` - Atomic design layout
5. `resources/views/breeze/auth/install-admin.blade.php` - Install admin page

### Page Files

1. `resources/views/admin/periode/index.blade.php` - Removed Alpine.js CDN
2. `resources/views/admin/jurusan/index.blade.php` - Removed Alpine.js CDN
3. `resources/views/admin/gelombang/index.blade.php` - Removed Alpine.js CDN
4. `resources/views/public/profilsekolah.blade.php` - Removed Font Awesome CDN

### Core Files

1. `resources/js/app.js` - Import Chart.js dan SweetAlert2
2. `resources/css/app.css` - Import Font Awesome, Bootstrap Icons, SweetAlert2 CSS
3. `package.json` - Added dependencies

## Package yang Ditambahkan

```json
{
    "dependencies": {
        "chart.js": "latest",
        "@fortawesome/fontawesome-free": "latest",
        "bootstrap-icons": "latest",
        "sweetalert2": "latest"
    }
}
```

## Cara Menggunakan

### Development

```bash
npm run dev
```

### Production Build

```bash
npm run build
```

## Keuntungan Migrasi ke Lokal

1. **Performa Lebih Baik**
    - Asset di-bundle dan di-minify oleh Vite
    - Mengurangi HTTP requests
    - Lebih cepat karena tidak perlu fetch dari CDN eksternal

2. **Offline Development**
    - Tidak bergantung pada koneksi internet
    - Development bisa dilakukan offline

3. **Version Control**
    - Versi library terkontrol di `package.json`
    - Tidak ada breaking changes mendadak dari CDN

4. **Security**
    - Mengurangi risiko MITM attack
    - Tidak bergantung pada keamanan CDN pihak ketiga

5. **Customization**
    - Bisa customize library sesuai kebutuhan
    - Tree-shaking untuk mengurangi ukuran bundle

## Global Variables

Beberapa library tersedia sebagai global variable untuk digunakan di Blade templates:

```javascript
// Tersedia secara global
window.Alpine; // Alpine.js
window.Chart; // Chart.js
window.Swal; // SweetAlert2
```

## Catatan Penting

- Pastikan `npm install` sudah dijalankan sebelum development
- Jalankan `npm run dev` untuk development dengan hot-reload
- Jalankan `npm run build` untuk production build
- Font Awesome icons tetap menggunakan class `fa-*` seperti biasa
- Bootstrap Icons tetap menggunakan class `bi-*` seperti biasa

## Testing

Setelah migrasi, pastikan untuk test:

- [ ] Admin dashboard (Chart.js)
- [ ] Student dashboard (Alpine.js, Font Awesome)
- [ ] Forms dengan SweetAlert2
- [ ] Icons (Font Awesome & Bootstrap Icons)
- [ ] Responsive layout (Tailwind CSS)

## Rollback Plan

Jika terjadi masalah, rollback bisa dilakukan dengan:

1. Restore file layouts dengan CDN links
2. Atau menambahkan CDN sebagai fallback di `<head>` section
