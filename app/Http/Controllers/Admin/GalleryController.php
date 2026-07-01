<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::ordered()->paginate(20);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create(): View
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('galleries', 'public');
                Gallery::create([
                    'image_path' => $path,
                    'title' => $validated['title'] ?? null,
                    'description' => $validated['description'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery images uploaded successfully.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery deleted successfully.');
    }
}
