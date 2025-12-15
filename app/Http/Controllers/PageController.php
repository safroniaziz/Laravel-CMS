<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('status', 'published')
            ->firstOr(function() use ($slug) {
                // If page not found, return empty page view instead of 404
                return null;
            });

        if (!$page) {
            // Show friendly "content not available yet" page
            return view('frontend.empty-page', [
                'pageUrl' => '/' . $slug,
                'siteSettings' => $this->getSiteSettings()
            ]);
        }

        return view('frontend.page', [
            'page' => $page,
            'seoTitle' => $page->meta_title ?? $page->title,
            'seoDescription' => $page->meta_description ?? $page->excerpt,
            'seoKeywords' => $page->meta_keywords ?? '',
            'siteSettings' => $this->getSiteSettings()
        ]);
    }

    private function getSiteSettings()
    {
        return [
            'name' => \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'Website',
            'logo' => \App\Models\Setting::where('key', 'site_logo')->value('value'),
            'favicon' => \App\Models\Setting::where('key', 'site_favicon')->value('value'),
            'tagline' => \App\Models\Setting::where('key', 'site_tagline')->value('value') ?? '',
        ];
    }
}
