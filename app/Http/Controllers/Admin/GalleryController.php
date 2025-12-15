<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }
        
        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        $galleries = $query->latest()->paginate(20);
        $categories = \App\Models\Category::orderBy('name')->get();
        
        return view('galleries.index', compact('galleries', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'required|in:image,video',
            'file' => 'required_if:type,image|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'file_path' => 'required_if:type,video',
            'thumbnail' => 'nullable',
            'category' => 'nullable|max:100',
            'year' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Set defaults
        $validated['order'] = $validated['order'] ?? Gallery::max('order') + 1;
        $validated['is_active'] = $validated['is_active'] ?? true;
        
        // Handle file upload for images
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Create directory if not exists
            $galleryPath = public_path('gallery-images');
            if (!file_exists($galleryPath)) {
                mkdir($galleryPath, 0755, true);
            }
            
            // Move file to public/gallery-images
            $file->move($galleryPath, $filename);
            $validated['file_path'] = asset('gallery-images/' . $filename);
            unset($validated['file']);
        }

        $gallery = Gallery::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Gallery item created successfully',
            'gallery' => $gallery
        ]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'required|in:image,video',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'file_path' => 'required_if:type,video',
            'thumbnail' => 'nullable',
            'category' => 'nullable|max:100',
            'year' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        
        // Handle file upload for images (if new file provided)
        if ($request->hasFile('file')) {
            // Delete old file
            if ($gallery->file_path && strpos($gallery->file_path, 'gallery-images/') !== false) {
                $oldFilename = basename($gallery->file_path);
                $oldPath = public_path('gallery-images/' . $oldFilename);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Create directory if not exists
            $galleryPath = public_path('gallery-images');
            if (!file_exists($galleryPath)) {
                mkdir($galleryPath, 0755, true);
            }
            
            // Move file to public/gallery-images
            $file->move($galleryPath, $filename);
            $validated['file_path'] = asset('gallery-images/' . $filename);
            unset($validated['file']);
        }

        $gallery->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Gallery item updated successfully',
            'gallery' => $gallery
        ]);
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gallery item deleted successfully'
        ]);
    }

    public function toggleActive(Gallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'is_active' => $gallery->is_active
        ]);
    }

    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:galleries,id'
        ]);

        Gallery::whereIn('id', $validated['ids'])->delete();

        return response()->json([
            'success' => true,
            'message' => count($validated['ids']) . ' gallery items deleted successfully'
        ]);
    }
}
