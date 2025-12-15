<?php

namespace App\Services;

use App\Models\Theme;
use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class ThemeService
{
    protected $activeTheme;

    public function __construct()
    {
        $this->activeTheme = $this->getActiveTheme();
    }

    public function getActiveTheme()
    {
        if ($this->activeTheme) {
            return $this->activeTheme;
        }

        $themeSlug = Setting::get('active_theme', 'default');
        return Theme::where('slug', $themeSlug)->first();
    }

    public function activate($themeSlug)
    {
        $theme = Theme::where('slug', $themeSlug)->first();

        if (!$theme) {
            return false;
        }

        $theme->activate();
        $this->activeTheme = $theme;

        return true;
    }

    public function getViewPath($view)
    {
        if (!$this->activeTheme) {
            return $view;
        }

        $themePath = "themes.{$this->activeTheme->slug}.{$view}";

        if (View::exists($themePath)) {
            return $themePath;
        }

        return $view;
    }

    public function getSetting($key, $default = null)
    {
        if (!$this->activeTheme || !$this->activeTheme->settings) {
            return $default;
        }

        return $this->activeTheme->settings[$key] ?? $default;
    }

    public function updateSettings($settings)
    {
        if (!$this->activeTheme) {
            return false;
        }

        $this->activeTheme->update([
            'settings' => array_merge($this->activeTheme->settings ?? [], $settings)
        ]);

        return true;
    }

    public function scanThemes()
    {
        $themesPath = resource_path('views/themes');

        if (!File::exists($themesPath)) {
            File::makeDirectory($themesPath, 0755, true);
            return [];
        }

        $directories = File::directories($themesPath);
        $themes = [];

        foreach ($directories as $directory) {
            $slug = basename($directory);
            $configFile = $directory . '/theme.json';

            if (File::exists($configFile)) {
                $config = json_decode(File::get($configFile), true);

                $themes[] = [
                    'slug' => $slug,
                    'name' => $config['name'] ?? $slug,
                    'description' => $config['description'] ?? '',
                    'version' => $config['version'] ?? '1.0.0',
                    'author' => $config['author'] ?? '',
                    'author_url' => $config['author_url'] ?? '',
                    'screenshot' => $config['screenshot'] ?? '',
                    'path' => $directory,
                ];
            }
        }

        return $themes;
    }

    public function installTheme($themePath)
    {
        // Extract and install theme from uploaded file
        // Implementation depends on your theme package structure
        return true;
    }
}

