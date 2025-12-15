<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Page;
use App\Models\Service;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return view('frontend.search.index', [
                'query' => '',
                'results' => []
            ]);
        }

        $results = [];

        // Search posts
        $posts = Post::published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('content', 'like', '%' . $query . '%')
                  ->orWhere('excerpt', 'like', '%' . $query . '%');
            })
            ->take(10)
            ->get();

        foreach ($posts as $post) {
            $results[] = [
                'type' => 'Post',
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'url' => route('blog.show', $post->slug),
                'date' => $post->published_at
            ];
        }

        // Search pages
        $pages = Page::published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('content', 'like', '%' . $query . '%');
            })
            ->take(10)
            ->get();

        foreach ($pages as $page) {
            $results[] = [
                'type' => 'Page',
                'title' => $page->title,
                'excerpt' => \Illuminate\Support\Str::limit(strip_tags($page->content), 150),
                'url' => route('page.show', $page->slug),
                'date' => $page->published_at
            ];
        }

        // Search services
        $services = Service::active()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%')
                  ->orWhere('content', 'like', '%' . $query . '%');
            })
            ->take(10)
            ->get();

        foreach ($services as $service) {
            $results[] = [
                'type' => 'Service',
                'title' => $service->title,
                'excerpt' => $service->description,
                'url' => route('services.show', $service->slug),
                'date' => $service->created_at
            ];
        }

        // Search portfolio
        $portfolios = Portfolio::active()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%');
            })
            ->take(10)
            ->get();

        foreach ($portfolios as $portfolio) {
            $results[] = [
                'type' => 'Portfolio',
                'title' => $portfolio->title,
                'excerpt' => $portfolio->description,
                'url' => route('portfolio.show', $portfolio->slug),
                'date' => $portfolio->created_at
            ];
        }

        return view('frontend.search.index', [
            'query' => $query,
            'results' => collect($results)->sortByDesc('date')->values()
        ]);
    }
}

