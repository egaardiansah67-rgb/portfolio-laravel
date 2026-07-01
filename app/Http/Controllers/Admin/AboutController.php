<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AboutController extends Controller
{
    public function index(): View
    {
        $about = About::first() ?? new About();
        return view('admin.about.index', compact('about'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cta_button_text' => 'nullable|string|max:100',
            'cta_button_url' => 'nullable|url',
        ]);

        $about = About::first() ?? new About();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('about', 'public');
            $validated['image'] = $path;
        }

        $about->fill($validated)->save();

        return redirect()->route('admin.about.index')
            ->with('success', 'About section updated successfully.');
    }
}
