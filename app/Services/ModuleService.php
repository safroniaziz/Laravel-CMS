<?php

namespace App\Services;

use App\Models\Module;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class ModuleService
{
    protected $modules;

    public function __construct()
    {
        $this->loadActiveModules();
    }

    public function loadActiveModules()
    {
        $this->modules = Module::where('is_active', true)->get();

        foreach ($this->modules as $module) {
            $this->bootModule($module);
        }
    }

    public function bootModule(Module $module)
    {
        $modulePath = base_path("modules/{$module->slug}");

        if (!File::exists($modulePath)) {
            return false;
        }

        // Load module routes
        $routesFile = $modulePath . '/routes.php';
        if (File::exists($routesFile)) {
            Route::prefix($module->slug)
                ->middleware('web')
                ->group($routesFile);
        }

        // Load module views
        $viewsPath = $modulePath . '/views';
        if (File::exists($viewsPath)) {
            view()->addNamespace($module->slug, $viewsPath);
        }

        // Load module service provider if exists
        $providerFile = $modulePath . '/ServiceProvider.php';
        if (File::exists($providerFile)) {
            require_once $providerFile;
            $providerClass = "Modules\\{$module->slug}\\ServiceProvider";
            if (class_exists($providerClass)) {
                app()->register($providerClass);
            }
        }

        return true;
    }

    public function activate($moduleSlug)
    {
        $module = Module::where('slug', $moduleSlug)->first();

        if (!$module) {
            return false;
        }

        // Check requirements
        if ($module->requirements) {
            foreach ($module->requirements as $requirement => $version) {
                // Check if requirement is met
                // Implementation depends on your requirements structure
            }
        }

        $module->activate();
        $this->bootModule($module);

        return true;
    }

    public function deactivate($moduleSlug)
    {
        $module = Module::where('slug', $moduleSlug)->first();

        if (!$module) {
            return false;
        }

        $module->deactivate();

        return true;
    }

    public function scanModules()
    {
        $modulesPath = base_path('modules');

        if (!File::exists($modulesPath)) {
            File::makeDirectory($modulesPath, 0755, true);
            return [];
        }

        $directories = File::directories($modulesPath);
        $modules = [];

        foreach ($directories as $directory) {
            $slug = basename($directory);
            $configFile = $directory . '/module.json';

            if (File::exists($configFile)) {
                $config = json_decode(File::get($configFile), true);

                $modules[] = [
                    'slug' => $slug,
                    'name' => $config['name'] ?? $slug,
                    'description' => $config['description'] ?? '',
                    'version' => $config['version'] ?? '1.0.0',
                    'author' => $config['author'] ?? '',
                    'author_url' => $config['author_url'] ?? '',
                    'path' => $directory,
                    'requirements' => $config['requirements'] ?? [],
                ];
            }
        }

        return $modules;
    }

    public function installModule($modulePath)
    {
        // Extract and install module from uploaded file
        // Implementation depends on your module package structure
        return true;
    }

    public function getActiveModules()
    {
        return $this->modules;
    }
}

