<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class TeacherSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('key', [
            'teacher_page_layout',
            'teacher_page_title',
            'teacher_page_subtitle',
            'teacher_page_per_page',
            'teacher_hero_enabled',
            'teacher_hero_gradient_start',
            'teacher_hero_gradient_end',
            'teacher_card_bg_color',
            'teacher_card_border_radius',
            'teacher_card_shadow',
            'teacher_card_hover_shadow',
            'teacher_card_primary_color',
        ])->pluck('value', 'key');

        return view('admin.teacher-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'teacher_page_layout' => 'required|in:grid,stats_cards,featured_grid',
            'teacher_page_title' => 'required|string|max:255',
            'teacher_page_subtitle' => 'nullable|string',
            'teacher_page_per_page' => 'required|integer|min:1|max:50',
            'teacher_hero_enabled' => 'required|in:0,1',
            'teacher_hero_gradient_start' => 'required|string',
            'teacher_hero_gradient_end' => 'required|string',
            'teacher_card_bg_color' => 'required|string',
            'teacher_card_border_radius' => 'required|integer|min:0|max:50',
            'teacher_card_shadow' => 'nullable|string',
            'teacher_card_hover_shadow' => 'nullable|string',
            'teacher_card_primary_color' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => $this->getSettingType($key)]
            );
        }

        // Clear cache
        \Artisan::call('optimize:clear');

        return response()->json([
            'success' => true,
            'message' => 'Teacher settings updated successfully'
        ]);
    }

    private function getSettingType($key)
    {
        $types = [
            'teacher_page_layout' => 'select',
            'teacher_page_title' => 'text',
            'teacher_page_subtitle' => 'textarea',
            'teacher_page_per_page' => 'number',
            'teacher_hero_enabled' => 'boolean',
            'teacher_hero_gradient_start' => 'color',
            'teacher_hero_gradient_end' => 'color',
            'teacher_card_bg_color' => 'color',
            'teacher_card_border_radius' => 'number',
            'teacher_card_shadow' => 'text',
            'teacher_card_hover_shadow' => 'text',
            'teacher_card_primary_color' => 'color',
        ];

        return $types[$key] ?? 'text';
    }
}
