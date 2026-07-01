<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BlogCategoryController extends Controller
{
    public function index(): View
    {
        $categories = BlogCategory::paginate(10);
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.blog-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories',
        ]);

        BlogCategory::create($validated);

        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category created successfully.');
    }

    public function edit(BlogCategory $blogCategory): View
    {
        return view('admin.blog-categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $blogCategory->id,
        ]);

        $blogCategory->update($validated);

        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory): RedirectResponse
    {
        $blogCategory->delete();

        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category deleted successfully.');
    }
}
