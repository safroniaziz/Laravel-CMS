<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::with('user');

        if ($request->filled('type')) {
            $query->where('mime_type', 'like', $request->type . '%');
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('filename', 'like', '%' . $request->search . '%');
            });
        }

        $media = $query->latest()->paginate(20);

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'title' => 'nullable|max:255',
            'alt_text' => 'nullable|max:255',
            'caption' => 'nullable',
            'description' => 'nullable',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('media', $filename, 'public');

        $media = Media::create([
            'title' => $validated['title'] ?? $file->getClientOriginalName(),
            'filename' => $filename,
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'alt_text' => $validated['alt_text'] ?? '',
            'caption' => $validated['caption'] ?? '',
            'description' => $validated['description'] ?? '',
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Media uploaded successfully',
            'media' => $media
        ]);
    }

    public function update(Request $request, Media $media)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'alt_text' => 'nullable|max:255',
            'caption' => 'nullable',
            'description' => 'nullable',
        ]);

        $media->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Media updated successfully',
            'media' => $media
        ]);
    }

    public function destroy(Media $media)
    {
        Storage::disk('public')->delete($media->path);
        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media deleted successfully'
        ]);
    }
}

