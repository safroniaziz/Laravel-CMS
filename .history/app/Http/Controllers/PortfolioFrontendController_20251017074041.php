<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioFrontendController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::active();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $portfolios = $query->orderBy('order')->paginate(12);
        $categories = Portfolio::active()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        return view('frontend.portfolio.index', compact('portfolios', 'categories'));
    }

    public function show($slug)
    {
        $portfolio = Portfolio::active()->where('slug', $slug)->firstOrFail();
        $relatedPortfolios = Portfolio::active()
            ->where('id', '!=', $portfolio->id)
            ->where('category', $portfolio->category)
            ->take(3)
            ->get();

        return view('frontend.portfolio.show', compact('portfolio', 'relatedPortfolios'));
    }
}

