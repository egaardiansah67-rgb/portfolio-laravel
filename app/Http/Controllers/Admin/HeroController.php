<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HeroController extends Controller
{
    public function index(): View
    {
        $hero = Hero::first() ?? new Hero();
        return view('admin.hero.index', compact('hero'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'description' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv_file' => 'nullable|mimes:pdf|max:5120',
            'button_hire_text' => 'nullable|string|max:100',
            'button_cv_text' => 'nullable|string|max:100',
        ]);

        $hero = Hero::first() ?? new Hero();

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('heroes', 'public');
            $validated['profile_image'] = $path;
        }

        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->store('heroes', 'public');
            $validated['background_image'] = $path;
        }

        if ($request->hasFile('cv_file')) {
            $path = $request->file('cv_file')->store('cv', 'public');
            $validated['cv_file'] = $path;
        }

        $hero->fill($validated)->save();

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero section updated successfully.');
    }
}
