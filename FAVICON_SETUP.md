# Setup Favicon - Tokabe.id

## ✅ Yang Sudah Dilakukan:

1. **Favicon sudah ditambahkan ke 2 layout utama:**
   - `resources/views/layouts/frontend.blade.php` ✅
   - `resources/views/layouts/admin.blade.php` ✅

2. **Folder `public/images` sudah dibuat** ✅

## 📋 Yang Perlu Anda Lakukan:

### Langkah 1: Upload File Logo
Letakkan file logo Anda dengan nama **`logo.png`** ke dalam folder:
```
public/images/logo.png
```

### Langkah 2: Selesai!
Setelah file logo diupload, favicon akan otomatis muncul di:
- ✅ Semua halaman **Frontend** (welcome, apply, cek-status, privacy, dll)
- ✅ Semua halaman **Admin** (dashboard, jobs, categories, applications, dll)

## 🔄 Cara Mengubah Favicon di Kemudian Hari:

### Opsi 1: Ganti File Logo
Cukup replace file `public/images/logo.png` dengan logo baru (nama file harus tetap sama)

### Opsi 2: Ganti Path di Layout
Jika ingin menggunakan nama file berbeda atau lokasi berbeda:

1. Buka file layout:
   - `resources/views/layouts/frontend.blade.php`
   - `resources/views/layouts/admin.blade.php`

2. Cari baris:
   ```html
   <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
   ```

3. Ubah path sesuai kebutuhan, contoh:
   ```html
   <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
   <link rel="icon" href="{{ asset('images/favicon-32x32.png') }}" type="image/png">
   ```

## 📝 Catatan:

- **Format yang didukung**: PNG, ICO, SVG, JPG
- **Ukuran yang direkomendasikan**: 
  - 16x16px (minimum)
  - 32x32px (standar)
  - 192x192px (untuk PWA)
- **Satu tempat, semua halaman**: Karena favicon ada di layout, semua halaman yang menggunakan layout tersebut otomatis akan memiliki favicon yang sama

## 🎯 Keuntungan Sistem Ini:

✅ **Centralized**: Hanya perlu edit di 2 file layout (frontend & admin)
✅ **Efficient**: Tidak perlu copy-paste ke setiap halaman
✅ **Easy to Update**: Ganti logo sekali, semua halaman terupdate
✅ **Maintainable**: Mudah di-maintain dan di-manage

---

**Status**: ✅ Setup selesai, tinggal upload file logo.png
