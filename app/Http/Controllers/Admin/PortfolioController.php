<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $portfolios = $query->latest()->paginate(15);

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:portfolios,slug',
            'description' => 'required',
            'content' => 'nullable',
            'client' => 'nullable|max:255',
            'project_date' => 'nullable|date',
            'project_url' => 'nullable|url',
            'category' => 'nullable|max:255',
            'tags' => 'nullable|array',
            'featured_image' => 'nullable',
            'gallery' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_featured' => 'required|boolean',
            'is_active' => 'required|boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ]);

        $portfolio = Portfolio::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Portfolio created successfully',
            'redirect' => route('admin.portfolios.index')
        ]);
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:portfolios,slug,' . $portfolio->id,
            'description' => 'required',
            'content' => 'nullable',
            'client' => 'nullable|max:255',
            'project_date' => 'nullable|date',
            'project_url' => 'nullable|url',
            'category' => 'nullable|max:255',
            'tags' => 'nullable|array',
            'featured_image' => 'nullable',
            'gallery' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_featured' => 'required|boolean',
            'is_active' => 'required|boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ]);

        $portfolio->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Portfolio updated successfully',
            'redirect' => route('admin.portfolios.index')
        ]);
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return response()->json([
            'success' => true,
            'message' => 'Portfolio deleted successfully'
        ]);
    }
}

