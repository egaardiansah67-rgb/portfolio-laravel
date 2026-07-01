<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::with('author', 'category')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        $categories = BlogCategory::all();
        $tags = Tag::all();
        return view('admin.blogs.create', compact('categories', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_published' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('blogs', 'public');
            $validated['thumbnail'] = $path;
        }

        $validated['user_id'] = auth()->id();

        $blog = Blog::create($validated);

        if ($request->has('tags')) {
            $blog->tags()->sync($request->input('tags', []));
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog): View
    {
        $categories = BlogCategory::all();
        $tags = Tag::all();
        $selectedTags = $blog->tags->pluck('id')->toArray();
        return view('admin.blogs.edit', compact('blog', 'categories', 'tags', 'selectedTags'));
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $validated = $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_published' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('blogs', 'public');
            $validated['thumbnail'] = $path;
        }

        $blog->update($validated);

        if ($request->has('tags')) {
            $blog->tags()->sync($request->input('tags', []));
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
