<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::with('user');

        if ($request->filled('type')) {
            $query->where('mime_type', 'like', $request->type . '%');
        }

        $media = $query->latest()->paginate(20);

        return response()->json($media);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:10240',
            'title' => 'nullable|max:255',
            'alt_text' => 'nullable|max:255',
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
            'user_id' => $request->user()->id,
        ]);

        return response()->json($media, 201);
    }

    public function destroy(Media $media)
    {
        Storage::disk('public')->delete($media->path);
        $media->delete();

        return response()->json([
            'message' => 'Media deleted successfully'
        ]);
    }
}

