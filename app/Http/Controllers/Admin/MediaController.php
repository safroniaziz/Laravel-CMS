<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::with('user')->latest();
        
        if ($request->filled('search')) {
            $query->where('filename', 'like', '%' . $request->search . '%');
        }
        
        $media = $query->paginate(24);
        
        return view('media.index', compact('media'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB
        ]);
        
        try {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            
            // Generate unique filename
            $filename = Str::uuid() . '.jpg'; // Always convert to JPG
            
            // Get original dimensions
            $image = Image::read($file);
            $originalWidth = $image->width();
            $originalHeight = $image->height();
            
            // Create directories if not exist
            Storage::makeDirectory('public/media/large');
            Storage::makeDirectory('public/media/medium');
            Storage::makeDirectory('public/media/thumb');
            
            // 1. LARGE - 3:2 ratio, max width 1600px (maintain aspect ratio)
            $large = Image::read($file)
                ->scale(width: 1600);
            $largePath = storage_path('app/public/media/large/' . $filename);
            $large->save($largePath, quality: 85);
            $largeDimensions = $large->width() . 'x' . $large->height();
            
            // 2. MEDIUM - 16:9 ratio, 800x450, crop center
            $medium = Image::read($file)
                ->cover(800, 450);
            $mediumPath = storage_path('app/public/media/medium/' . $filename);
            $medium->save($mediumPath, quality: 80);
            
            // 3. THUMB - 1:1 ratio, 400x400, crop center
            $thumb = Image::read($file)
                ->cover(400, 400);
            $thumbPath = storage_path('app/public/media/thumb/' . $filename);
            $thumb->save($thumbPath, quality: 75);
            
            // Calculate file size (large version)
            $fileSize = filesize($largePath);
            
            // Store dimension info in responsive_images JSON field
            $dimensionsData = [
                'original' => $originalWidth . 'x' . $originalHeight,
                'large' => $largeDimensions,
                'medium' => '800x450',
                'thumb' => '400x400'
            ];
            
            // Save to database using existing schema
            $media = Media::create([
                'name' => pathinfo($originalName, PATHINFO_FILENAME),
                'file_name' => $filename,
                'mime_type' => 'image/jpeg',
                'path' => 'media/large/' . $filename,
                'disk' => 'public',
                'collection_name' => 'featured_images',
                'size' => $fileSize,
                'custom_properties' => json_encode(['original_name' => $originalName]),
                'responsive_images' => json_encode($dimensionsData),
                'user_id' => Auth::id(),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'media' => $media,
                'preview' => [
                    'large' => asset('storage/media/large/' . $filename),
                    'medium' => asset('storage/media/medium/' . $filename),
                    'thumb' => asset('storage/media/thumb/' . $filename),
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function destroy(Media $medium)
    {
        try {
            \Log::info('MediaController destroy called', ['media_id' => $medium->id, 'filename' => $medium->file_name]);
            
            // Extract filename from path
            $filename = $medium->file_name;
            
            // Delete all 3 sizes (Storage facade uses 'public' disk by default)
            $deleted = Storage::disk('public')->delete([
                'media/large/' . $filename,
                'media/medium/' . $filename,
                'media/thumb/' . $filename,
            ]);
            
            \Log::info('Files deletion result', ['deleted' => $deleted]);
            
            // Delete from database
            $dbDeleted = $medium->delete();
            
            \Log::info('Database deletion result', ['deleted' => $dbDeleted]);
            
            return response()->json([
                'success' => true,
                'message' => 'Media deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Media deletion failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete media: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function picker(Request $request)
    {
        $query = Media::latest();
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('file_name', 'like', '%' . $request->search . '%');
        }
        
        $media = $query->paginate(12);
        
        // Transform for picker
        $media->getCollection()->transform(function ($item) {
            $filename = $item->file_name;
            $dimensions = json_decode($item->responsive_images, true);
            
            return [
                'id' => $item->id,
                'filename' => $item->name,
                'thumb' => asset('storage/media/thumb/' . $filename),
                'medium' => asset('storage/media/medium/' . $filename),
                'large' => asset('storage/media/large/' . $filename),
                'dimensions' => $dimensions,
                'size' => $this->formatBytes($item->size),
                'created_at' => $item->created_at->format('d M Y'),
            ];
        });
        
        return response()->json([
            'success' => true,
            'media' => $media
        ]);
    }
    
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
