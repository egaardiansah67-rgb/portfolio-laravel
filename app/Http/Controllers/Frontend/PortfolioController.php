<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $categories = PortfolioCategory::all();
        $query = Portfolio::query();

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        $portfolios = $query->paginate(12);

        return view('frontend.portfolio.index', compact('portfolios', 'categories'));
    }

    public function show(Portfolio $portfolio): View
    {
        $relatedPortfolios = Portfolio::where('portfolio_category_id', $portfolio->portfolio_category_id)
            ->where('id', '!=', $portfolio->id)
            ->take(3)
            ->get();

        return view('frontend.portfolio.show', compact('portfolio', 'relatedPortfolios'));
    }
}
