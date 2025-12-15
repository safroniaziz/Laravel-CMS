<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        return view('admin.modules.index', compact('modules'));
    }

    public function activate(Module $module)
    {
        $module->activate();

        return response()->json([
            'success' => true,
            'message' => 'Module activated successfully'
        ]);
    }

    public function deactivate(Module $module)
    {
        $module->deactivate();

        return response()->json([
            'success' => true,
            'message' => 'Module deactivated successfully'
        ]);
    }

    public function settings(Module $module)
    {
        return view('admin.modules.settings', compact('module'));
    }

    public function updateSettings(Request $request, Module $module)
    {
        $settings = $request->input('settings', []);
        
        $module->update([
            'settings' => $settings
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Module settings updated successfully'
        ]);
    }
}

