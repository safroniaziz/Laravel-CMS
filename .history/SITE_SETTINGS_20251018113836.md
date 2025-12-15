# 🎨 Site Settings - Nama, Logo, & Tagline

Semua informasi site (nama aplikasi, logo, tagline) disimpan di database dan bisa diubah kapan saja!

## 📝 Settings yang Tersedia

### 1. **Site Name** (Nama Aplikasi)
- **Key**: `site_name`
- **Value**: `Sistem Informasi`
- **Tampil di**: Header, title browser, footer

### 2. **Site Tagline** (Subtitle)
- **Key**: `site_tagline`
- **Value**: `Universitas Bengkulu`
- **Tampil di**: Header (di bawah nama)

### 3. **Site Logo** (Path Logo)
- **Key**: `site_logo`
- **Value**: Path ke file logo (contoh: `storage/logo.png`)
- **Tampil di**: Header (sebelah nama)
- **Note**: Jika kosong, akan tampil icon graduation cap

## 🔧 Cara Mengubah Settings

### Via Tinker (Recommended):

```bash
./vendor/bin/sail artisan tinker
```

**Ubah Nama Aplikasi:**
```php
Setting::where('key', 'site_name')->first()->update(['value' => 'Teknik Informatika']);
```

**Ubah Subtitle:**
```php
Setting::where('key', 'site_tagline')->first()->update(['value' => 'Fakultas Teknik UNIB']);
```

**Ubah Logo:**
```php
Setting::where('key', 'site_logo')->first()->update(['value' => 'storage/logo.png']);
```

**Ubah Semua Sekaligus:**
```php
$settings = [
    ['key' => 'site_name', 'value' => 'Teknik Informatika'],
    ['key' => 'site_tagline', 'value' => 'Fakultas Teknik UNIB'],
    ['key' => 'site_logo', 'value' => 'storage/logo.png'],
];

foreach ($settings as $data) {
    Setting::where('key', $data['key'])->first()->update(['value' => $data['value']]);
}
```

### Via Database (MySQL):

```sql
-- Ubah nama aplikasi
UPDATE settings SET value = 'Teknik Informatika' WHERE `key` = 'site_name';

-- Ubah subtitle
UPDATE settings SET value = 'Fakultas Teknik UNIB' WHERE `key` = 'site_tagline';

-- Ubah logo
UPDATE settings SET value = 'storage/logo.png' WHERE `key` = 'site_logo';
```

## 📸 Cara Upload & Gunakan Logo

### 1. Upload Logo ke Storage:

```bash
# Masuk ke container
./vendor/bin/sail shell

# Buat folder jika belum ada
mkdir -p storage/app/public/logos

# Copy logo dari local (dari host machine)
# Atau upload via FTP/admin panel
```

### 2. Buat Symbolic Link (Jika belum):

```bash
./vendor/bin/sail artisan storage:link
```

### 3. Update Setting Logo:

```php
Setting::where('key', 'site_logo')->first()->update([
    'value' => 'storage/logos/logo.png'
]);
```

### 4. Format Logo yang Disarankan:
- **Format**: PNG dengan background transparan
- **Size**: 200x200px atau 300x300px
- **Aspect Ratio**: 1:1 (square) atau 16:9 (landscape)
- **Max File Size**: 500KB

## 🎨 Tampilan Logo di Header

Logo akan ditampilkan dengan styling:
- **Width**: 60px
- **Height**: 60px
- **Border Radius**: 12px (jika tidak ada logo, tampil icon)
- **Shadow**: Box shadow biru

Jika `site_logo` kosong atau file tidak ditemukan:
- Akan tampil **icon graduation cap** (🎓)
- Background gradient biru
- Tetap terlihat profesional

## 📋 Contoh Penggunaan

### Contoh 1: Ganti Nama Program Studi
```bash
./vendor/bin/sail artisan tinker
```
```php
Setting::where('key', 'site_name')->first()->update(['value' => 'Sistem Komputer']);
Setting::where('key', 'site_tagline')->first()->update(['value' => 'Fakultas Ilmu Komputer']);
```

### Contoh 2: Tambah Logo
```php
// Setelah upload logo.png ke storage/app/public/logos/
Setting::where('key', 'site_logo')->first()->update(['value' => 'storage/logos/logo.png']);
```

### Contoh 3: Hapus Logo (Kembali ke Icon)
```php
Setting::where('key', 'site_logo')->first()->update(['value' => '']);
```

## 🔄 Settings Lainnya

Settings lain yang juga tersedia:
- `site_description` - Deskripsi site untuk SEO
- `site_favicon` - Path ke favicon
- `contact_email` - Email kontak
- `contact_phone` - Nomor telepon
- `contact_address` - Alamat lengkap
- `social_facebook` - URL Facebook
- `social_instagram` - URL Instagram
- `social_youtube` - URL YouTube
- `social_twitter` - URL Twitter

## 💡 Tips:

1. **Backup Settings**: Export settings sebelum ubah besar-besaran
   ```sql
   SELECT * FROM settings WHERE `group` = 'general';
   ```

2. **Clear Cache**: Setelah ubah settings, clear cache view
   ```bash
   ./vendor/bin/sail artisan view:clear
   ./vendor/bin/sail artisan cache:clear
   ```

3. **Logo Best Practices**:
   - Gunakan SVG untuk hasil terbaik (scalable)
   - Atau PNG dengan resolusi tinggi
   - Pastikan background transparan
   - Test di berbagai ukuran layar

4. **Nama & Tagline**:
   - Nama: Maksimal 30 karakter (agar tidak terlalu panjang)
   - Tagline: Maksimal 50 karakter
   - Hindari karakter spesial yang aneh

## 🚀 Admin Panel (Future Feature)

Nanti akan ada halaman admin untuk manage settings dengan UI:
- Form input untuk nama & tagline
- Upload logo dengan preview
- Live preview perubahan
- Reset to default button
- Export/import settings

---

**Current Settings:**
- Site Name: `Sistem Informasi`
- Site Tagline: `Universitas Bengkulu`
- Site Logo: (kosong - tampil icon)

Refresh browser setelah update settings!

