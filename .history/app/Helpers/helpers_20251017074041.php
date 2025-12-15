<?php

use App\Helpers\SeoHelper;
use App\Helpers\MenuHelper;
use App\Helpers\BreadcrumbHelper;
use App\Helpers\LanguageHelper;
use App\Models\Setting;

if (!function_exists('seo')) {
    function seo()
    {
        return app(SeoHelper::class);
    }
}

if (!function_exists('menu')) {
    function menu($location, $cssClass = 'menu')
    {
        return MenuHelper::render($location, $cssClass);
    }
}

if (!function_exists('breadcrumb')) {
    function breadcrumb()
    {
        return app(BreadcrumbHelper::class);
    }
}

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return Setting::get($key, $default);
    }
}

if (!function_exists('language')) {
    function language($key = null, $default = null)
    {
        if ($key === null) {
            return LanguageHelper::getCurrentLanguage();
        }

        return LanguageHelper::translate($key, $default);
    }
}

if (!function_exists('active_route')) {
    function active_route($route, $class = 'active')
    {
        return request()->routeIs($route) ? $class : '';
    }
}

if (!function_exists('format_date')) {
    function format_date($date, $format = 'd M Y')
    {
        if (!$date) {
            return '';
        }

        return \Carbon\Carbon::parse($date)->format($format);
    }
}

if (!function_exists('truncate')) {
    function truncate($text, $length = 150, $suffix = '...')
    {
        return \Illuminate\Support\Str::limit($text, $length, $suffix);
    }
}

if (!function_exists('asset_url')) {
    function asset_url($path)
    {
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        return asset($path);
    }
}

if (!function_exists('user_avatar')) {
    function user_avatar($user, $size = 50)
    {
        if ($user && $user->avatar) {
            return asset('storage/' . $user->avatar);
        }

        // Generate default avatar using UI Avatars
        $name = $user ? urlencode($user->name) : 'User';
        return "https://ui-avatars.com/api/?name={$name}&size={$size}&background=random";
    }
}

