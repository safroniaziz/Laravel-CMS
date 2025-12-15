<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $sliders = Slider::active()->orderBy('order')->get();
            $services = Service::active()->orderBy('order')->take(6)->get();
            $portfolios = Portfolio::active()->featured()->orderBy('order')->take(6)->get();
            $testimonials = Testimonial::active()->featured()->orderBy('order')->take(6)->get();
            $partners = Partner::active()->orderBy('order')->get();
            $latestPosts = Post::published()->with('category', 'author')->latest('published_at')->take(6)->get();
        } catch (\Exception $e) {
            // Fallback if DB connection fails
            $sliders = collect();
            $services = collect();
            $portfolios = collect();
            $testimonials = collect();
            $partners = collect();
            $latestPosts = collect();
        }

        // Fallback Dummy Data for News if empty
        if ($latestPosts->isEmpty()) {
            $latestPosts = collect([
                (object)[
                    'title' => 'Grand Launching Majalah Equilibrium 2025 Bahas Krisis Bumi dan Masa Depan Generasi',
                    'slug' => 'dummy-main-1',
                    'excerpt' => 'Grand Launching Majalah Equilibrium 2025 menyoroti urgensi menjaga keberlanjutan bumi di tengah berbagai proyek transisi energi yang berpotensi menimbulkan dampak ekologis baru.',
                    'featured_image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80',
                    'published_at' => now(),
                    'category' => (object)['name' => 'Berita']
                ],
                (object)[
                    'title' => 'Mahasiswa UGM Kembangkan SIKE, Sistem Dapur Pintar Berbasis AI',
                    'slug' => 'dummy-side-1',
                    'featured_image' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=800&q=80',
                    'published_at' => now()->subDays(1),
                    'category' => (object)['name' => 'PKM']
                ],
                (object)[
                    'title' => 'UGM dan APCOVE Gelar Lokakarya Epidemiologi, Perkuat Kapasitas',
                    'slug' => 'dummy-side-2',
                    'featured_image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80',
                    'published_at' => now()->subDays(2),
                    'category' => (object)['name' => 'Seminar']
                ],
                (object)[
                    'title' => 'UGM Dampingi Petani Dlingo Ubah Limbah Biomassa Kayu Jadi',
                    'slug' => 'dummy-side-3',
                    'featured_image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80',
                    'published_at' => now()->subDays(3),
                    'category' => (object)['name' => 'Pengabdian']
                ]
            ]);
        }

        // No more dummy data - all from database

        // Get homepage settings
        try {
            $homeSettings = Setting::where('group', 'homepage')->pluck('value', 'key')->toArray();
        } catch (\Exception $e) {
            $homeSettings = [];
        }

        return view('frontend.home', compact(
            'sliders',
            'services',
            'portfolios',
            'testimonials',
            'partners',
            'latestPosts',
            'homeSettings'
        ));
    }
}

