<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Setting;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        // Get settings
        $perPage = 8; // Fixed at 8 per page for AJAX
        $layout = Setting::get('teacher_page_layout', 'grid');
        $page = $request->get('page', 1);
        
        // Get teachers with pagination - active and ordered like homepage
        $teachers = Teacher::active()->ordered()->paginate($perPage);
        
        // If AJAX request, return only the cards HTML (no grid wrapper)
        if ($request->ajax()) {
            $html = view('frontend.teachers.partials.card', compact('teachers'))->render();
            
            return response()->json([
                'html' => $html,
                'current_page' => $teachers->currentPage(),
                'last_page' => $teachers->lastPage(),
                'has_more' => $teachers->hasMorePages(),
            ]);
        }
        
        // Build settings array for initial load
        $teacherSettings = [
            'layout' => $layout,
            'hero' => [
                'enabled' => Setting::get('teacher_hero_enabled', '1') === '1',
                'gradient_start' => Setting::get('teacher_hero_gradient_start', '#1e3a8a'),
                'gradient_end' => Setting::get('teacher_hero_gradient_end', '#60a5fa'),
                'title' => Setting::get('teacher_page_title', 'Tim Pengajar Kami'),
                'subtitle' => Setting::get('teacher_page_subtitle', 'Dosen berpengalaman dan berkualitas'),
            ],
            'card' => [
                'bg_color' => Setting::get('teacher_card_bg_color', '#ffffff'),
                'border_radius' => Setting::get('teacher_card_border_radius', '16'),
                'shadow' => Setting::get('teacher_card_shadow', '0 4px 20px rgba(0,0,0,0.1)'),
                'hover_shadow' => Setting::get('teacher_card_hover_shadow', '0 12px 35px rgba(0,0,0,0.15)'),
                'primary_color' => Setting::get('teacher_card_primary_color', '#3b82f6'),
            ],
            'show_filters' => Setting::get('teacher_page_show_filters', '1') === '1',
        ];
        
        // Determine layout view
        $layoutView = 'frontend.teachers.layouts.' . $layout;
        
        return view('frontend.teachers.index', compact('teachers', 'teacherSettings', 'layoutView'));
    }
    
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        
        return view('frontend.teachers.show', compact('teacher'));
    }
}
