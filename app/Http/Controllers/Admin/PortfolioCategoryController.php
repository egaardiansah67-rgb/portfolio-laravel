<?php

namespace App\Http\Controllers\Admin;

use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PortfolioCategoryController extends Controller
{
    public function index(): View
    {
        $categories = PortfolioCategory::ordered()->paginate(10);
        return view('admin.portfolio-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.portfolio-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories',
            'order' => 'nullable|integer',
        ]);

        PortfolioCategory::create($validated);

        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Portfolio category created successfully.');
    }

    public function edit(PortfolioCategory $portfolioCategory): View
    {
        return view('admin.portfolio-categories.edit', compact('portfolioCategory'));
    }

    public function update(Request $request, PortfolioCategory $portfolioCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories,name,' . $portfolioCategory->id,
            'order' => 'nullable|integer',
        ]);

        $portfolioCategory->update($validated);

        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Portfolio category updated successfully.');
    }

    public function destroy(PortfolioCategory $portfolioCategory): RedirectResponse
    {
        $portfolioCategory->delete();

        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Portfolio category deleted successfully.');
    }
}
