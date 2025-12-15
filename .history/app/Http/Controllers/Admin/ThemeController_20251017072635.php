<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        $activeTheme = Theme::active();
        return view('admin.themes.index', compact('themes', 'activeTheme'));
    }

    public function activate(Theme $theme)
    {
        $theme->activate();

        return response()->json([
            'success' => true,
            'message' => 'Theme activated successfully'
        ]);
    }

    public function settings(Theme $theme)
    {
        return view('admin.themes.settings', compact('theme'));
    }

    public function updateSettings(Request $request, Theme $theme)
    {
        $settings = $request->input('settings', []);
        
        $theme->update([
            'settings' => $settings
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Theme settings updated successfully'
        ]);
    }
}

