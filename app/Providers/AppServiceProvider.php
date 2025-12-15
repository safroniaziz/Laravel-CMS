<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\ThemeService;
use App\Services\ModuleService;
use App\Helpers\SeoHelper;
use App\Helpers\BreadcrumbHelper;
use App\Helpers\LanguageHelper;
use App\Models\Setting;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register Theme Service
        $this->app->singleton(ThemeService::class, function ($app) {
            return new ThemeService();
        });

        // Register Module Service
        $this->app->singleton(ModuleService::class, function ($app) {
            return new ModuleService();
        });

        // Register SEO Helper
        $this->app->singleton(SeoHelper::class, function ($app) {
            return new SeoHelper();
        });

        // Register Breadcrumb Helper
        $this->app->bind(BreadcrumbHelper::class, function ($app) {
            return new BreadcrumbHelper();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            // Set locale from session
            if (session()->has('locale')) {
                app()->setLocale(session('locale'));
            }

            // Share common data with all views
            View::composer('*', function ($view) {
                try {
                    $view->with([
                        'currentLanguage' => LanguageHelper::getCurrentLanguage(),
                        'availableLanguages' => LanguageHelper::getAvailableLanguages(),
                        'siteSettings' => [
                            'name' => Setting::get('site_name', 'CMS'),
                            'tagline' => Setting::get('site_tagline', ''),
                            'logo' => Setting::get('site_logo', ''),
                            'favicon' => Setting::get('site_favicon', ''),
                        ],
                        'socialLinks' => [
                            'facebook' => Setting::get('social_facebook', ''),
                            'twitter' => Setting::get('social_twitter', ''),
                            'instagram' => Setting::get('social_instagram', ''),
                            'linkedin' => Setting::get('social_linkedin', ''),
                            'youtube' => Setting::get('social_youtube', ''),
                        ],
                        'contactInfo' => [
                            'email' => Setting::get('contact_email', ''),
                            'phone' => Setting::get('contact_phone', ''),
                            'address' => Setting::get('contact_address', ''),
                        ],
                    ]);
                } catch (\Exception $e) {
                    // Database not ready, skip view composer
                }
            });

            // Boot Module Service (only if database is ready)
            if (\Illuminate\Support\Facades\Schema::hasTable('modules')) {
                $this->app->make(ModuleService::class);
            }
        } catch (\Exception $e) {
            // Database not ready, skip boot operations
        }
    }
}
