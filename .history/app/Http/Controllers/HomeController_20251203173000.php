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

        // No dummy data - show empty state if no posts
        // if ($latestPosts->isEmpty()) {
        //     // Dummy data removed - will show empty state instead
        // }

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

