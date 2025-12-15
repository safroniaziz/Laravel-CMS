<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryFrontendController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::active();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->orderBy('order')->paginate(12);
        
        $categories = Gallery::active()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        return view('frontend.gallery.index', compact('galleries', 'categories'));
    }
}

