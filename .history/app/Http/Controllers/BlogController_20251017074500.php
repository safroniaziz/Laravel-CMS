<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with('category', 'user', 'tags');

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by tag
        if ($request->filled('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->latest('published_at')->paginate(12);
        $categories = Category::withCount('posts')->get();
        $popularPosts = Post::published()->orderBy('views', 'desc')->take(5)->get();
        $tags = Tag::withCount('posts')->get();

        return view('frontend.blog.index', compact('posts', 'categories', 'popularPosts', 'tags'));
    }

    public function show($slug)
    {
        $post = Post::published()->where('slug', $slug)->with('category', 'user', 'tags')->firstOrFail();

        // Increment views
        $post->incrementViews();

        // Related posts
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->take(3)
            ->get();

        $categories = Category::withCount('posts')->get();
        $popularPosts = Post::published()->orderBy('views', 'desc')->take(5)->get();

        return view('frontend.blog.show', compact('post', 'relatedPosts', 'categories', 'popularPosts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::published()
            ->where('category_id', $category->id)
            ->with('user', 'tags')
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount('posts')->get();
        $popularPosts = Post::published()->orderBy('views', 'desc')->take(5)->get();

        return view('frontend.blog.category', compact('category', 'posts', 'categories', 'popularPosts'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()
            ->published()
            ->with('category', 'user')
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount('posts')->get();
        $popularPosts = Post::published()->orderBy('views', 'desc')->take(5)->get();

        return view('frontend.blog.tag', compact('tag', 'posts', 'categories', 'popularPosts'));
    }
}

