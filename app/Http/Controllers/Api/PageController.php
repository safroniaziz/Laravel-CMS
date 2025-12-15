<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::published()->with('user', 'template')->latest()->paginate(15);
        return response()->json($pages);
    }

    public function show($slug)
    {
        $page = Page::published()
            ->where('slug', $slug)
            ->with('user', 'template')
            ->firstOrFail();

        return response()->json($page);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'template_id' => 'nullable|exists:page_templates,id',
            'featured_image' => 'nullable',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'page_builder_data' => 'nullable|array',
        ]);

        $validated['user_id'] = $request->user()->id;

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $page = Page::create($validated);

        return response()->json($page->load('template'), 201);
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'template_id' => 'nullable|exists:page_templates,id',
            'featured_image' => 'nullable',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'page_builder_data' => 'nullable|array',
        ]);

        if ($validated['status'] === 'published' && empty($page->published_at)) {
            $validated['published_at'] = now();
        }

        $page->update($validated);

        return response()->json($page->load('template'));
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return response()->json([
            'message' => 'Page deleted successfully'
        ]);
    }
}

