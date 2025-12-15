# Laravel CMS - Custom Content Management System

Sebuah CMS custom yang powerful seperti WordPress, dibangun dengan Laravel untuk memberikan fleksibilitas dan performa tinggi.

## 🚀 Fitur Utama

### ✅ Manajemen Konten Lengkap
- **Posts & Pages**: Sistem artikel/berita dan halaman statis dengan editor yang powerful
- **Media Library**: Upload dan kelola gambar, dokumen, dan file media lainnya
- **Categories & Tags**: Organisasi konten dengan kategori dan tag
- **SEO Optimization**: Meta title, description, keywords untuk setiap halaman/post
- **Views Counter**: Tracking jumlah views untuk setiap artikel

### 👥 User Role & Permission
- **5 Role Default**: Superadmin, Admin, Editor, Author, Viewer
- **Granular Permissions**: Kontrol akses yang detail untuk setiap fitur
- **User Management**: Kelola user dengan mudah dari admin panel

### 🎨 Modular Theme System
- **Theme Management**: Ganti tampilan website dari admin panel
- **Custom Settings**: Konfigurasi theme dengan mudah
- **Blade Template Engine**: Menggunakan template engine Laravel yang powerful

### 🧩 Plugin/Module Support
- **Dynamic Loading**: Module dapat diaktifkan/nonaktifkan tanpa mengubah code
- **Custom Routes & Controllers**: Module bisa menambahkan route sendiri
- **Isolated Views**: Setiap module memiliki view terpisah

### 🌍 Multi-Language Support
- **Dual Language**: Support Bahasa Indonesia dan English (dapat ditambah)
- **Language Switcher**: UI untuk ganti bahasa dengan mudah
- **Translation Management**: Kelola terjemahan dari admin panel

### 🏢 Company Profile Features
- **Services**: Showcase layanan/produk perusahaan
- **Portfolio**: Galeri proyek yang telah dikerjakan
- **Testimonials**: Ulasan dari klien
- **Partners**: Logo partner/client
- **Careers**: Posting lowongan kerja dengan form aplikasi
- **Job Applications**: Kelola lamaran kerja
- **Gallery**: Galeri foto dan video
- **FAQ**: Frequently Asked Questions
- **Contact Form**: Form kontak dengan AJAX submission
- **Slider/Hero Section**: Banner dinamis untuk homepage

### 📱 REST API
- **Authentication**: Login dengan Laravel Sanctum
- **Public Endpoints**: List posts, detail post, categories, dll
- **Protected Endpoints**: CRUD operations untuk authenticated users
- **JSON Responses**: Format response standar REST API

### 🛠️ Admin Panel
- **Modern Dashboard**: UI yang bersih dan responsif
- **jQuery AJAX**: Form submission tanpa reload halaman
- **Statistics**: Overview statistik website
- **Media Manager**: Upload dan kelola file dengan drag & drop
- **Menu Builder**: Buat menu dinamis dengan drag & drop
- **Settings Manager**: Konfigurasi website terpusat

### 🔒 Backup & Restore
- **Database Backup**: Backup database SQLite
- **Media Backup**: Backup semua file media
- **Full Backup**: Backup lengkap (database + media)
- **Download**: Download backup file
- **Auto Management**: Kelola backup files dengan mudah

### 🔍 Advanced Features
- **Global Search**: Pencarian di posts, pages, services, portfolio
- **Dynamic Menu**: Menu yang dikelola dari admin panel
- **Breadcrumbs**: Navigasi breadcrumb dengan schema markup
- **SEO Helper**: Helper untuk meta tags dan schema markup
- **Mobile Responsive**: Optimized untuk semua device

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL

## 🔧 Installation

### 1. Clone Repository
```bash
git clone <repository-url>
cd laravel-cms
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
Edit `.env` file untuk konfigurasi database:
```env
DB_CONNECTION=sqlite
# atau untuk MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel_cms
# DB_USERNAME=root
# DB_PASSWORD=
```

Untuk SQLite, buat file database:
```bash
touch database/database.sqlite
```

### 5. Run Migrations & Seeders
```bash
php artisan migrate --seed
```

Ini akan membuat:
- Role: Superadmin, Admin, Editor, Author, Viewer
- User default:
  - **superadmin@cms.com** / password
  - **admin@cms.com** / password
- Languages: English & Indonesia
- Settings default
- Sample categories & posts

### 6. Storage Link
```bash
php artisan storage:link
```

### 7. Install Sanctum
```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### 8. Build Assets
```bash
npm run build
# atau untuk development:
npm run dev
```

### 9. Serve Application
```bash
php artisan serve
```

Website akan berjalan di: http://localhost:8000

## 🎯 Default Credentials

### Admin Panel
- URL: http://localhost:8000/admin
- **Superadmin**: superadmin@cms.com / password
- **Admin**: admin@cms.com / password

## 📚 Directory Structure

```
laravel-cms/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin panel controllers
│   │   │   ├── Api/            # API controllers
│   │   │   └── ...             # Frontend controllers
│   │   └── Middleware/
│   ├── Models/                 # Eloquent models
│   ├── Services/               # Business logic services
│   │   ├── ThemeService.php
│   │   └── ModuleService.php
│   └── Helpers/                # Helper classes
│       ├── SeoHelper.php
│       ├── MenuHelper.php
│       ├── BreadcrumbHelper.php
│       └── LanguageHelper.php
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Database seeders
├── resources/
│   └── views/
│       ├── admin/              # Admin panel views
│       ├── frontend/           # Frontend views
│       ├── layouts/            # Layout templates
│       └── auth/               # Authentication views
├── routes/
│   ├── web.php                 # Web routes
│   ├── api.php                 # API routes
│   └── auth.php                # Authentication routes
└── modules/                    # Custom modules (to be created)
```

## 🎨 Theme Development

### Create New Theme

1. Buat folder di `resources/views/themes/[theme-name]`
2. Buat file `theme.json`:
```json
{
    "name": "My Theme",
    "description": "A beautiful theme",
    "version": "1.0.0",
    "author": "Your Name",
    "author_url": "https://yoursite.com",
    "screenshot": "screenshot.jpg"
}
```
3. Buat layout dan views sesuai kebutuhan
4. Aktivasi dari Admin Panel > Themes

## 🧩 Module Development

### Create New Module

1. Buat folder di `modules/[module-name]`
2. Buat file `module.json`:
```json
{
    "name": "My Module",
    "description": "A custom module",
    "version": "1.0.0",
    "author": "Your Name",
    "requirements": {
        "php": ">=8.2",
        "laravel": ">=12.0"
    }
}
```
3. Buat structure:
```
modules/my-module/
├── module.json
├── routes.php
├── ServiceProvider.php
└── views/
```
4. Aktivasi dari Admin Panel > Modules

## 🌐 API Documentation

### Authentication

**Login**
```bash
POST /api/v1/login
{
    "email": "user@example.com",
    "password": "password"
}
```

Response:
```json
{
    "token": "...",
    "user": {...}
}
```

### Public Endpoints

**Get Posts**
```bash
GET /api/v1/posts
GET /api/v1/posts?category=technology&search=laravel
GET /api/v1/posts/{slug}
```

**Get Pages**
```bash
GET /api/v1/pages
GET /api/v1/pages/{slug}
```

**Get Categories**
```bash
GET /api/v1/categories
GET /api/v1/categories/{slug}
```

### Protected Endpoints

Gunakan Bearer Token di header:
```bash
Authorization: Bearer {your-token}
```

**Create Post**
```bash
POST /api/v1/posts
{
    "title": "Post Title",
    "content": "Content here...",
    "status": "published",
    "category_id": 1
}
```

## 🛡️ Security

- **CSRF Protection**: Semua form menggunakan CSRF token
- **XSS Protection**: Input di-sanitize otomatis
- **SQL Injection**: Menggunakan Eloquent ORM dengan prepared statements
- **Authentication**: Laravel Sanctum untuk API
- **Authorization**: Role-based permissions

## 🎯 Helper Functions

```php
// SEO
seo()->setTitle('Page Title');
seo()->setDescription('Description');
seo()->renderTags();

// Menu
menu('header', 'nav-class');

// Breadcrumb
breadcrumb()->add('Home', '/')->add('Page')->render();

// Settings
setting('site_name', 'Default');

// Language
language('translation_key', 'default');
```

## 📱 Responsive Design

Website menggunakan Bootstrap 5 yang sudah mobile-responsive:
- Mobile First Approach
- Breakpoints: xs, sm, md, lg, xl, xxl
- Touch-friendly navigation
- Optimized images

## 🚀 Performance Optimization

- **Caching**: Settings dan translations di-cache
- **Lazy Loading**: Image lazy loading
- **Asset Optimization**: Minified CSS & JS
- **Database Indexing**: Index pada foreign keys dan slug
- **Query Optimization**: Eager loading relationships

## 📝 TODO / Roadmap

- [ ] Page Builder (Drag & Drop)
- [ ] Advanced Media Manager dengan crop & resize
- [ ] Email Templates
- [ ] Newsletter Management
- [ ] Advanced Analytics & Reports
- [ ] Import/Export Content
- [ ] Multi-site Management
- [ ] Advanced Cache Management
- [ ] Comment System
- [ ] Social Media Integration

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

Developed with ❤️ by Juru Sankoding

## 📞 Support

Untuk bantuan dan support:
- Email: support@example.com
- Documentation: [Link to docs]
- Issues: [GitHub Issues]

---

**Happy Coding! 🎉**
