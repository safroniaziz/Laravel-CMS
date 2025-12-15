<?php

namespace App\Helpers;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Support\Facades\Session;

class LanguageHelper
{
    public static function getCurrentLanguage()
    {
        $code = Session::get('locale', config('app.locale'));
        return Language::where('code', $code)->first() ?? Language::default();
    }

    public static function getAvailableLanguages()
    {
        return Language::getActive();
    }

    public static function setLanguage($code)
    {
        $language = Language::where('code', $code)->where('is_active', true)->first();

        if ($language) {
            Session::put('locale', $code);
            app()->setLocale($code);
            return true;
        }

        return false;
    }

    public static function translate($key, $default = null, $languageCode = null)
    {
        return Translation::get($key, $default, $languageCode);
    }

    public static function renderLanguageSwitcher($class = 'language-switcher')
    {
        $languages = self::getAvailableLanguages();
        $current = self::getCurrentLanguage();

        if ($languages->count() <= 1) {
            return '';
        }

        $html = '<div class="' . $class . '">';
        $html .= '<button class="language-current" data-toggle="dropdown">';
        $html .= '<span class="flag">' . $current->flag . '</span> ';
        $html .= '<span class="name">' . $current->name . '</span>';
        $html .= '</button>';
        $html .= '<ul class="language-dropdown">';

        foreach ($languages as $language) {
            $active = $language->id === $current->id ? 'active' : '';
            $html .= '<li class="' . $active . '">';
            $html .= '<a href="' . route('language.switch', $language->code) . '">';
            $html .= '<span class="flag">' . $language->flag . '</span> ';
            $html .= '<span class="name">' . $language->name . '</span>';
            $html .= '</a>';
            $html .= '</li>';
        }

        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }
}

