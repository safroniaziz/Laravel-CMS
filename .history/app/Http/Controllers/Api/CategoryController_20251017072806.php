<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->get();
        return response()->json($categories);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->withCount('posts')->firstOrFail();
        return response()->json($category);
    }
}

