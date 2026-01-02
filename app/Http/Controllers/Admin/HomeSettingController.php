<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\KenaliSetting;
use App\Models\AlumniSetting;
use Illuminate\Http\Request;

class HomeSettingController extends Controller
{
    /**
     * Hero Slider Settings
     */
    public function hero()
    {
        $settings = Setting::where('group', 'homepage')
            ->whereIn('key', [
                'hero_show',
                'hero_layout_style',
                'hero_badge_text',
                'hero_badge_subtext',
                'hero_badge_show',
                'hero_primary_color',
                'hero_accent_color',
                'hero_secondary_color',
                'hero_gradient_start',
                'hero_gradient_mid',
                'hero_gradient_end',
                'hero_secondary_button_text',
                'hero_secondary_button_link',
                'hero_secondary_button_show',
                'home_hero_title',
                'home_hero_subtitle',
            ])
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.home-settings.hero', compact('settings'));
    }

    /**
     * Kenali Lebih Dekat Settings
     */
    public function kenali()
    {
        $settings = KenaliSetting::pluck('value', 'key')->toArray();
        
        // Also get video settings from Settings table
        $videoSettings = Setting::where('group', 'video')
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.home-settings.kenali', compact('settings', 'videoSettings'));
    }

    /**
     * Ikatan Alumni Settings
     */
    public function alumni()
    {
        $settings = AlumniSetting::pluck('value', 'key')->toArray();
        
        return view('admin.home-settings.alumni', compact('settings'));
    }

    /**
     * Call to Action Settings
     */
    public function cta()
    {
        $settings = Setting::where('group', 'homepage')
            ->where('key', 'like', 'cta_%')
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.home-settings.cta', compact('settings'));
    }

    /**
     * Category Sections Settings
     */
    public function category()
    {
        $settings = Setting::where('group', 'homepage')
            ->where('key', 'like', 'category_%')
            ->pluck('value', 'key')
            ->toArray();
            
        $categories = \App\Models\Category::all();

        return view('admin.home-settings.category', compact('settings', 'categories'));
    }

    /**
     * Berita Terbaru Settings
     */
    public function news()
    {
        $settings = Setting::where('group', 'homepage')
            ->whereIn('key', [
                'news_section_show',
                'news_section_title',
                'news_section_subtitle',
                'news_section_show_subtitle',
                'news_section_primary_color',
                'news_section_accent_color',
                'news_layout_style',
                'news_empty_text',
            ])
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.home-settings.news', compact('settings'));
    }

    /**
     * General Homepage Settings
     */
    public function general()
    {
        $settings = Setting::where('group', 'homepage')
            ->whereIn('key', [
                // Section Show Toggles
                'academic_section_show',
                'dosen_section_show',
                // Section Titles (legacy keys still used in frontend)
                'home_alumni_title',
                'home_dosen_title',
                'home_video_title',
                'home_program_title',
                'home_requirements_title',
                'home_testimonial_title',
                // Academic Section
                'academic_section_title',
                'academic_section_subtitle',
                'academic_section_badge_text',
                'academic_section_icon',
                'academic_layout_style',
                'academic_section_primary_color',
                'academic_section_accent_color',
                'academic_section_bg_start',
                'academic_section_bg_end',
            ])
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.home-settings.general', compact('settings'));
    }

    /**
     * Info Card Settings
     */
    public function infoCard()
    {
        $settings = Setting::where('key', 'like', 'info_card_%')
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.home-settings.info-card', compact('settings'));
    }

    /**
     * Footer Settings
     */
    public function footer()
    {
        $settings = Setting::where('key', 'like', 'footer_%')
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.home-settings.footer', compact('settings'));
    }

    /**
     * Homepage Builder - Custom sections
     */
    public function homepageBuilder()
    {
        // Get existing homepage builder data
        $builderData = Setting::where('key', 'home_page_builder_data')->value('value');
        $sections = $builderData ? json_decode($builderData, true) : [];

        return view('admin.home-settings.homepage-builder', compact('sections'));
    }

    /**
     * Update Homepage Builder Data
     */
    public function updateHomepageBuilder(Request $request)
    {
        try {
            $builderData = $request->input('page_builder_data');
            
            Setting::updateOrCreate(
                ['key' => 'home_page_builder_data'],
                [
                    'value' => $builderData,
                    'group' => 'homepage',
                    'type' => 'json'
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Homepage sections saved successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update Settings
     */
    public function update(Request $request)
    {
        $type = $request->input('type');
        $settings = $request->input('settings', []);

        try {
            if ($type === 'kenali') {
                foreach ($settings as $key => $value) {
                    KenaliSetting::updateOrCreate(
                        ['key' => $key],
                        ['value' => $value]
                    );
                }
            } elseif ($type === 'alumni') {
                foreach ($settings as $key => $value) {
                    AlumniSetting::updateOrCreate(
                        ['key' => $key],
                        ['value' => $value]
                    );
                }
            } else {
                // Default: save to Settings table
                foreach ($settings as $key => $value) {
                    Setting::updateOrCreate(
                        ['key' => $key],
                        [
                            'value' => $value,
                            'group' => $request->input('group', 'homepage'),
                            'type' => 'string'
                        ]
                    );
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Settings saved successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save settings: ' . $e->getMessage()
            ], 500);
        }
    }
}
