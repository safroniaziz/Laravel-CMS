<?php

use Illuminate\Support\Facades\Route;

// Frontend Routes
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController as FrontendPageController;
use App\Http\Controllers\ServiceFrontendController;
use App\Http\Controllers\PortfolioFrontendController;
use App\Http\Controllers\CareerFrontendController;
use App\Http\Controllers\ContactFrontendController;
use App\Http\Controllers\GalleryFrontendController;
use App\Http\Controllers\SearchController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TeacherSettingController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');


// Admin Blog Settings (must come BEFORE frontend blog/{slug} wildcard)
Route::middleware(['auth'])->prefix('blog/settings')->name('blog.settings.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\BlogSettingController::class, 'index'])->name('index');
    Route::post('/', [\App\Http\Controllers\Admin\BlogSettingController::class, 'update'])->name('update');
    Route::get('/detail', [\App\Http\Controllers\Admin\BlogSettingController::class, 'detail'])->name('detail');
    Route::post('/detail', [\App\Http\Controllers\Admin\BlogSettingController::class, 'updateDetail'])->name('detail.update');
});

// Blog (Frontend - must come AFTER admin blog/settings routes)
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/category/{slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{slug}', [BlogController::class, 'tag'])->name('tag');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show'); // Wildcard LAST
});

// Services
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceFrontendController::class, 'index'])->name('index');
    Route::get('/{slug}', [ServiceFrontendController::class, 'show'])->name('show');
});

// Portfolio
Route::prefix('portfolio')->name('portfolio.')->group(function () {
    Route::get('/', [PortfolioFrontendController::class, 'index'])->name('index');
    Route::get('/{slug}', [PortfolioFrontendController::class, 'show'])->name('show');
});

// Careers
Route::prefix('careers')->name('careers.')->group(function () {
    Route::get('/', [CareerFrontendController::class, 'index'])->name('index');
    Route::get('/{slug}', [CareerFrontendController::class, 'show'])->name('show');
    Route::post('/{career}/apply', [CareerFrontendController::class, 'apply'])->name('apply');
});

// Teachers/Faculty
Route::prefix('profil/dosen')->name('teachers.')->group(function () {
    Route::get('/', [\App\Http\Controllers\TeacherController::class, 'index'])->name('index');
    Route::get('/{id}', [\App\Http\Controllers\TeacherController::class, 'show'])->name('show');
});

// Contact & FAQ
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactFrontendController::class, 'index'])->name('index');
    Route::post('/', [ContactFrontendController::class, 'store'])->name('store');
});
Route::get('/faq', [ContactFrontendController::class, 'faq'])->name('faq');

// Gallery
Route::get('/gallery', [GalleryFrontendController::class, 'index'])->name('gallery');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Language Switcher
Route::get('/language/{code}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');

/*
|--------------------------------------------------------------------------
| Auth Routes (must be before catch-all route)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Dashboard Routes (for admin and editor) - MUST BE BEFORE CATCH-ALL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard - accessible by all authenticated users
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Posts - require posts permissions
    Route::middleware('permission:posts.view')->group(function () {
        Route::get('posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    });
    Route::middleware('permission:posts.create')->group(function () {
        Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('posts', [PostController::class, 'store'])->name('posts.store');
        Route::post('/posts/check-slug', [PostController::class, 'checkSlug'])->name('posts.check-slug');
    });
    Route::middleware('permission:posts.edit')->group(function () {
        Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    });
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('permission:posts.delete');

    // Pages - require pages permissions
    Route::middleware('permission:pages.view')->group(function () {
        Route::get('pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('pages/{page}', [PageController::class, 'show'])->name('pages.show');
    });
    Route::middleware('permission:pages.create')->group(function () {
        Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('pages', [PageController::class, 'store'])->name('pages.store');
    });
    Route::middleware('permission:pages.edit')->group(function () {
        Route::get('pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('pages/{page}', [PageController::class, 'update'])->name('pages.update');
    });
    Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy')->middleware('permission:pages.delete');

    // Media - require media permissions
    Route::get('/media/picker', [MediaController::class, 'picker'])->name('media.picker'); // Allow for all auth users
    Route::middleware('permission:media.view')->get('media', [MediaController::class, 'index'])->name('media.index');
    Route::middleware('permission:media.upload')->post('media', [MediaController::class, 'store'])->name('media.store');
    Route::middleware('permission:media.delete')->delete('media/{medium}', [MediaController::class, 'destroy'])->name('media.destroy');

    // Categories - require categories.manage permission
    Route::middleware('permission:categories.manage')->group(function () {
        Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);
    });

    // Tags - require tags.manage permission
    Route::middleware('permission:tags.manage')->group(function () {
        Route::resource('tags', TagController::class)->except(['create', 'edit', 'show']);
    });
    
    // Galleries - require gallery.manage permission
    Route::middleware('permission:gallery.manage')->group(function () {
        Route::resource('galleries', GalleryController::class)->except(['create', 'edit', 'show']);
        Route::post('galleries/{gallery}/toggle-active', [GalleryController::class, 'toggleActive'])->name('galleries.toggle-active');
        Route::post('galleries/bulk-destroy', [GalleryController::class, 'bulkDestroy'])->name('galleries.bulk-destroy');
    });

    // Menus - require menus.manage permission
    Route::middleware('permission:menus.manage')->group(function () {
        Route::resource('menus', MenuController::class);
        Route::post('menus/{menu}/items', [MenuController::class, 'storeItem'])->name('menus.items.store');
        Route::put('menu-items/{menuItem}', [MenuController::class, 'updateItem'])->name('menu-items.update');
        Route::delete('menu-items/{menuItem}', [MenuController::class, 'destroyItem'])->name('menu-items.destroy');
        Route::post('menus/{menu}/order', [MenuController::class, 'updateOrder'])->name('menus.order');
    });

    // Users - require users permissions
    Route::middleware('permission:users.view')->get('users', [UserController::class, 'index'])->name('users.index');
    Route::middleware('permission:users.create')->group(function () {
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
    });
    Route::middleware('permission:users.edit')->group(function () {
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    });
    Route::middleware('permission:users.delete')->delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Roles - require roles.manage permission
    Route::middleware('permission:roles.manage')->group(function () {
        Route::resource('roles', RoleController::class);
    });

    // Permissions - require permissions.manage permission (Superadmin only)
    Route::middleware('permission:permissions.manage')->group(function () {
        Route::resource('permissions', PermissionController::class);
    });

    // Settings - require settings.manage permission
    Route::middleware('permission:settings.manage')->group(function () {
        Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('admin.settings.update');
    });

    // Services - require services.manage permission
    Route::middleware('permission:services.manage')->group(function () {
        Route::resource('services', ServiceController::class);
    });

    // Portfolio - require portfolio.manage permission
    Route::middleware('permission:portfolio.manage')->group(function () {
        Route::resource('portfolios', PortfolioController::class);
    });

    // Careers - require careers.manage permission
    Route::middleware('permission:careers.manage')->group(function () {
        Route::resource('careers', CareerController::class);
        Route::get('careers/{career}/applications', [CareerController::class, 'applications'])->name('careers.applications');
        Route::put('applications/{application}/status', [CareerController::class, 'updateApplicationStatus'])->name('applications.status');
    });

    // Testimonials - require testimonials.manage permission
    Route::middleware('permission:testimonials.manage')->group(function () {
        Route::resource('testimonials', TestimonialController::class)->except(['create', 'edit', 'show']);
    });

    // Contacts - require contacts.view permission
    Route::middleware('permission:contacts.view')->group(function () {
        Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
        Route::put('contacts/{contact}/status', [ContactController::class, 'updateStatus'])->name('contacts.status');
    });

    // Themes - require themes.manage permission
    Route::middleware('permission:themes.manage')->group(function () {
        Route::get('themes', [ThemeController::class, 'index'])->name('themes.index');
        Route::post('themes/{theme}/activate', [ThemeController::class, 'activate'])->name('themes.activate');
        Route::get('themes/{theme}/settings', [ThemeController::class, 'settings'])->name('themes.settings');
        Route::post('themes/{theme}/settings', [ThemeController::class, 'updateSettings'])->name('themes.settings.update');
    });

    // Modules - require modules.manage permission
    Route::middleware('permission:modules.manage')->group(function () {
        Route::get('modules', [ModuleController::class, 'index'])->name('modules.index');
        Route::post('modules/{module}/activate', [ModuleController::class, 'activate'])->name('modules.activate');
        Route::post('modules/{module}/deactivate', [ModuleController::class, 'deactivate'])->name('modules.deactivate');
        Route::get('modules/{module}/settings', [ModuleController::class, 'settings'])->name('modules.settings');
        Route::post('modules/{module}/settings', [ModuleController::class, 'updateSettings'])->name('modules.settings.update');
    });

    // Backup - require backup.manage permission
    Route::middleware('permission:backup.manage')->group(function () {
        Route::get('backup', [BackupController::class, 'index'])->name('backup.index');
        Route::post('backup/create', [BackupController::class, 'create'])->name('backup.create');
        Route::get('backup/{backup}/download', [BackupController::class, 'download'])->name('backup.download');
        Route::delete('backup/{backup}', [BackupController::class, 'destroy'])->name('backup.destroy');
    });

    // Teachers - require settings.manage (part of admin settings)
    Route::middleware('permission:settings.manage')->group(function () {
        Route::resource('teachers', TeacherController::class)->names('admin.teachers');
        Route::patch('teachers/{teacher}/toggle', [TeacherController::class, 'toggle'])->name('admin.teachers.toggle');
        Route::post('teachers/reorder', [TeacherController::class, 'reorder'])->name('admin.teachers.reorder');
        
        // Teacher Settings
        Route::get('teacher-settings', [TeacherSettingController::class, 'index'])->name('admin.teacher-settings.index');
        Route::post('teacher-settings', [TeacherSettingController::class, 'update'])->name('admin.teacher-settings.update');

        // Home Settings
        Route::prefix('home-settings')->name('home-settings.')->group(function () {
            Route::get('/hero', [\App\Http\Controllers\Admin\HomeSettingController::class, 'hero'])->name('hero');
            Route::get('/kenali', [\App\Http\Controllers\Admin\HomeSettingController::class, 'kenali'])->name('kenali');
            Route::get('/alumni', [\App\Http\Controllers\Admin\HomeSettingController::class, 'alumni'])->name('alumni');
            Route::get('/cta', [\App\Http\Controllers\Admin\HomeSettingController::class, 'cta'])->name('cta');
            Route::get('/category', [\App\Http\Controllers\Admin\HomeSettingController::class, 'category'])->name('category');
            Route::get('/news', [\App\Http\Controllers\Admin\HomeSettingController::class, 'news'])->name('news');
            Route::get('/general', [\App\Http\Controllers\Admin\HomeSettingController::class, 'general'])->name('general');
            Route::get('/info-card', [\App\Http\Controllers\Admin\HomeSettingController::class, 'infoCard'])->name('info-card');
            Route::get('/footer', [\App\Http\Controllers\Admin\HomeSettingController::class, 'footer'])->name('footer');
            Route::get('/homepage-builder', [\App\Http\Controllers\Admin\HomeSettingController::class, 'homepageBuilder'])->name('homepage-builder');
            Route::post('/homepage-builder', [\App\Http\Controllers\Admin\HomeSettingController::class, 'updateHomepageBuilder'])->name('homepage-builder.update');
            Route::post('/update', [\App\Http\Controllers\Admin\HomeSettingController::class, 'update'])->name('update');
        });

        // Sliders (Hero)
        Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class)->names('admin.sliders');
        Route::patch('sliders/{slider}/toggle', [\App\Http\Controllers\Admin\SliderController::class, 'toggle'])->name('admin.sliders.toggle');
        Route::post('sliders/reorder', [\App\Http\Controllers\Admin\SliderController::class, 'reorder'])->name('admin.sliders.reorder');
    });
});

/*
|--------------------------------------------------------------------------
| Dynamic Pages Route (MUST BE LAST!)
|--------------------------------------------------------------------------
*/
// Pages (Dynamic - should be last)
Route::get('/{slug}', [FrontendPageController::class, 'show'])->name('page.show');
