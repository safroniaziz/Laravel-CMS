<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogSetting;
use Illuminate\Http\Request;

class BlogSettingController extends Controller
{
    /**
     * Display blog index page settings
     */
    public function index()
    {
        $settings = BlogSetting::all()->groupBy('group');
        
        return view('admin.blog-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'settings' => 'required|array',
        ]);

        // Get all settings for this group to handle unchecked checkboxes
        $allSettings = BlogSetting::whereIn('group', ['layout', 'hero', 'cards', 'sidebar', 'typography', 'pagination', 'general'])->get();
        
        foreach ($allSettings as $setting) {
            if ($setting->type === 'boolean') {
                // For checkboxes: if not in request, set to 0 (unchecked)
                $value = isset($validatedData['settings'][$setting->key]) ? '1' : '0';
                $setting->update(['value' => $value]);
            } elseif (isset($validatedData['settings'][$setting->key])) {
                // For other fields: update only if present in request
                $setting->update(['value' => $validatedData['settings'][$setting->key]]);
            }
        }

        return redirect()->route('blog.settings.index')
            ->with('success', 'Blog settings updated successfully!');
    }

    /**
     * Display blog detail page settings
     */
    public function detail()
    {
        $settings = BlogSetting::all()->groupBy('group');
        
        //Filter only detail page settings
        $detailSettings = $settings->filter(function ($group,  $key) {
            return str_starts_with($key, 'detail_');
        });
        
        return view('admin.blog-settings.detail', compact('detailSettings'));
    }

    public function updateDetail(Request $request)
    {
        $validatedData = $request->validate([
            'settings' => 'required|array',
        ]);

        // Get all detail settings
        $allSettings = BlogSetting::whereIn('group', ['detail_hero', 'detail_content', 'detail_author', 'detail_social'])->get();
        
        foreach ($allSettings as $setting) {
            if ($setting->type === 'boolean') {
                $value = isset($validatedData['settings'][$setting->key]) ? '1' : '0';
                $setting->update(['value' => $value]);
            } elseif (isset($validatedData['settings'][$setting->key])) {
                $setting->update(['value' => $validatedData['settings'][$setting->key]]);
            }
        }

        return redirect()->route('blog.settings.detail')
            ->with('success', 'Blog detail page settings updated successfully!');
    }
}
