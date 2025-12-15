<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::published()
            ->where('slug', $slug)
            ->with('template')
            ->firstOrFail();

        // Determine view based on template
        $view = 'frontend.pages.default';
        
        if ($page->template && $page->template->view_path) {
            $view = $page->template->view_path;
        }

        return view($view, compact('page'));
    }
}
