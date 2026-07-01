<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Blog::where('is_published', true);

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%')
                ->orWhere('description', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->input('tag'));
            });
        }

        $blogs = $query->latest('published_at')->paginate(10);
        $categories = BlogCategory::all();
        $tags = Tag::all();
        $popularBlogs = Blog::where('is_published', true)
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
        $latestBlogs = Blog::where('is_published', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('frontend.blog.index', compact(
            'blogs',
            'categories',
            'tags',
            'popularBlogs',
            'latestBlogs'
        ));
    }

    public function show(Blog $blog): View
    {
        if (!$blog->is_published) {
            abort(404);
        }

        $blog->increment('views');

        $relatedBlogs = Blog::where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->where('is_published', true)
            ->take(3)
            ->get();

        return view('frontend.blog.show', compact('blog', 'relatedBlogs'));
    }
}
