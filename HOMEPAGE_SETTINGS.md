# 🎨 Homepage Dynamic Settings

Semua title dan subtitle di homepage bisa diubah dari database tanpa perlu edit code!

## 📝 Cara Mengubah Settings

### Via Tinker (Quick):
```bash
./vendor/bin/sail artisan tinker

# Update title berita
Setting::where('key', 'home_news_title')->first()->update(['value' => 'BERITA TERBARU']);

# Update subtitle berita
Setting::where('key', 'home_news_subtitle')->first()->update(['value' => 'Informasi terkini untuk Anda']);

# Hide subtitle
Setting::where('key', 'home_news_show_subtitle')->first()->update(['value' => '0']);
```

### Via Database (MySQL):
```sql
-- Update title
UPDATE settings SET value = 'BERITA TERBARU' WHERE `key` = 'home_news_title';

-- Update subtitle
UPDATE settings SET value = 'Informasi terkini untuk Anda' WHERE `key` = 'home_news_subtitle';

-- Show/hide subtitle (1 = show, 0 = hide)
UPDATE settings SET value = '1' WHERE `key` = 'home_news_show_subtitle';
```

## 🎯 Available Homepage Settings

### Berita Section:
- `home_news_title` - Title section berita (default: "📰 BERITA TERKINI")
- `home_news_subtitle` - Subtitle section berita
- `home_news_show_subtitle` - Show/hide subtitle (1 atau 0)

### Hero Section:
- `home_hero_title` - Title hero (default: "PROFIL LULUSAN")
- `home_hero_subtitle` - Subtitle hero

### Other Sections:
- `home_academic_title` - Title informasi akademik
- `home_alumni_title` - Title alumni section
- `home_dosen_title` - Title dosen section
- `home_video_title` - Title video profile
- `home_program_title` - Title program studi
- `home_requirements_title` - Title persyaratan
- `home_testimonial_title` - Title testimoni
- `home_cta_title` - Title CTA section
- `home_cta_subtitle` - Subtitle CTA section

## 🎨 Design Features

### Title dengan Underline Gradient:
- Underline gradient biru ke orange
- Posisi center di bawah title
- Width 80px, height 4px
- Border radius 2px

### Subtitle:
- Max-width 600px (centered)
- Font size 16px
- Color abu-abu (#64748b)
- Line height 1.6
- Bisa di-toggle on/off

## 💡 Tips:

1. **Gunakan Emoji**: Tambahkan emoji di title untuk lebih menarik (📰, 🎓, 🏆, dll)
2. **Keep it Short**: Subtitle maksimal 2 baris (±100 karakter)
3. **Konsisten**: Gunakan style yang sama untuk semua sections
4. **Test Responsive**: Pastikan text tidak terlalu panjang di mobile

## 🔧 Extend Settings:

Untuk menambah setting baru:

1. Tambahkan di `SettingSeeder.php`:
```php
['key' => 'home_custom_title', 'value' => 'My Title', 'type' => 'string', 'group' => 'homepage'],
```

2. Run seeder:
```bash
./vendor/bin/sail artisan db:seed --class=SettingSeeder --force
```

3. Gunakan di view:
```blade
{{ $homeSettings['home_custom_title'] ?? 'Default Title' }}
```

## 📱 Admin Panel (Future):

Nanti bisa dibuat halaman admin untuk manage settings dengan UI yang user-friendly:
- Form input untuk setiap setting
- Preview real-time
- Color picker untuk warna
- Toggle switches untuk boolean
- Rich text editor untuk content

---

**Note**: Setelah update settings, tidak perlu clear cache. Settings langsung ter-update!

