<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryFrontendController extends Controller
{
    public function index(Request $request)
    {
        // If AJAX request, return JSON
        if ($request->ajax()) {
            return $this->getGalleryData($request);
        }

        $categories = Gallery::active()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        return view('frontend.gallery.index', compact('categories'));
    }

    public function getGalleryData(Request $request)
    {
        $query = Gallery::active();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $perPage = $request->input('per_page', 12);
        $galleries = $query->latest('created_at')->paginate($perPage);

        $html = '';
        foreach ($galleries as $gallery) {
            // file_path is already full URL or asset path
            $imageSrc = $gallery->file_path;
            
            $html .= view('frontend.gallery.partials.gallery-item', [
                'gallery' => $gallery,
                'imageSrc' => $imageSrc
            ])->render();
        }

        return response()->json([
            'html' => $html,
            'pagination' => [
                'current_page' => $galleries->currentPage(),
                'last_page' => $galleries->lastPage(),
                'per_page' => $galleries->perPage(),
                'total' => $galleries->total(),
                'from' => $galleries->firstItem(),
                'to' => $galleries->lastItem(),
            ],
            'has_more' => $galleries->hasMorePages(),
            'empty' => $galleries->isEmpty(),
        ]);
    }
}
