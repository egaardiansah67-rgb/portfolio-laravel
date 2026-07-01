<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $portfolios = Portfolio::with('category')->paginate(10);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create(): View
    {
        $categories = PortfolioCategory::all();
        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'client_name' => 'nullable|string|max:255',
            'technologies' => 'nullable|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'project_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('portfolios', 'public');
            $validated['thumbnail'] = $path;
        }

        $portfolio = Portfolio::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('portfolio-images', 'public');
                PortfolioImage::create([
                    'portfolio_id' => $portfolio->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio created successfully.');
    }

    public function edit(Portfolio $portfolio): View
    {
        $categories = PortfolioCategory::all();
        $images = $portfolio->images;
        return view('admin.portfolios.edit', compact('portfolio', 'categories', 'images'));
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $validated = $request->validate([
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'client_name' => 'nullable|string|max:255',
            'technologies' => 'nullable|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'project_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('portfolios', 'public');
            $validated['thumbnail'] = $path;
        }

        $portfolio->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('portfolio-images', 'public');
                PortfolioImage::create([
                    'portfolio_id' => $portfolio->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio updated successfully.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio deleted successfully.');
    }
}
