<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Page;
use App\Models\User;
use App\Models\Media;
use App\Models\Contact;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::published()->count(),
            'draft_posts' => Post::draft()->count(),
            'total_pages' => Page::count(),
            'total_users' => User::count(),
            'total_media' => Media::count(),
            'pending_contacts' => Contact::pending()->count(),
            'pending_applications' => JobApplication::pending()->count(),
        ];

        $recent_posts = Post::with('user', 'category')
            ->latest()
            ->take(5)
            ->get();

        $recent_contacts = Contact::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_posts', 'recent_contacts'));
    }
}

