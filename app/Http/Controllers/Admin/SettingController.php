<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Settings yang BENAR-BENAR dipakai di frontend
    private $frontendSettings = [
        'site' => [
            'title' => 'Informasi Website',
            'description' => 'Nama, tagline, dan logo website',
            'icon' => 'fas fa-globe',
            'keys' => [
                'site_name' => 'Nama Website',
                'site_tagline' => 'Tagline / Slogan',
                'site_logo' => 'Logo Website',
            ]
        ],
        'seo' => [
            'title' => 'SEO (Google Search)',
            'description' => 'Pengaturan agar website muncul di Google',
            'icon' => 'fas fa-search',
            'keys' => [
                'seo_meta_title' => 'Judul di Google',
                'seo_meta_description' => 'Deskripsi di Google',
                'seo_meta_keywords' => 'Kata Kunci',
            ]
        ],
        'contact' => [
            'title' => 'Informasi Kontak',
            'description' => 'Ditampilkan di footer dan halaman kontak',
            'icon' => 'fas fa-address-card',
            'keys' => [
                'contact_phone' => 'Nomor Telepon',
                'contact_email' => 'Email',
                'contact_address' => 'Alamat',
            ]
        ],
        'social' => [
            'title' => 'Media Sosial',
            'description' => 'Link sosial media di footer',
            'icon' => 'fas fa-share-alt',
            'keys' => [
                'social_facebook' => 'Facebook',
                'social_instagram' => 'Instagram',
                'social_youtube' => 'YouTube',
                'social_linkedin' => 'LinkedIn',
                'social_twitter' => 'Twitter/X',
            ]
        ],
    ];

    public function index()
    {
        $allSettings = Setting::all()->keyBy('key');
        
        $settings = [];
        foreach ($this->frontendSettings as $group => $config) {
            $groupSettings = [];
            foreach ($config['keys'] as $key => $label) {
                $setting = $allSettings->get($key);
                if ($setting) {
                    $setting->label = $label;
                } else {
                    // Create placeholder if not exists
                    $setting = (object)[
                        'key' => $key,
                        'value' => '',
                        'label' => $label,
                    ];
                }
                $groupSettings[] = $setting;
            }
            $settings[$group] = [
                'title' => $config['title'],
                'description' => $config['description'],
                'icon' => $config['icon'],
                'items' => $groupSettings,
            ];
        }
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->input('settings', []);

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '']
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings berhasil disimpan!');
    }
}
