<?php

namespace App\Http\Controllers\Admin;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AchievementController extends Controller
{
    public function index(): View
    {
        $achievements = Achievement::ordered()->paginate(10);
        return view('admin.achievements.index', compact('achievements'));
    }

    public function create(): View
    {
        return view('admin.achievements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'count' => 'required|integer',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
        ]);

        Achievement::create($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Achievement created successfully.');
    }

    public function edit(Achievement $achievement): View
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'count' => 'required|integer',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
        ]);

        $achievement->update($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Achievement updated successfully.');
    }

    public function destroy(Achievement $achievement): RedirectResponse
    {
        $achievement->delete();

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Achievement deleted successfully.');
    }
}
