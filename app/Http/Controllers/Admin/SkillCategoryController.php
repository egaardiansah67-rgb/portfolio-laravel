<?php

namespace App\Http\Controllers\Admin;

use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SkillCategoryController extends Controller
{
    public function index(): View
    {
        $categories = SkillCategory::ordered()->paginate(10);
        return view('admin.skill-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.skill-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skill_categories',
            'order' => 'nullable|integer',
        ]);

        SkillCategory::create($validated);

        return redirect()->route('admin.skill-categories.index')
            ->with('success', 'Skill category created successfully.');
    }

    public function edit(SkillCategory $skillCategory): View
    {
        return view('admin.skill-categories.edit', compact('skillCategory'));
    }

    public function update(Request $request, SkillCategory $skillCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skill_categories,name,' . $skillCategory->id,
            'order' => 'nullable|integer',
        ]);

        $skillCategory->update($validated);

        return redirect()->route('admin.skill-categories.index')
            ->with('success', 'Skill category updated successfully.');
    }

    public function destroy(SkillCategory $skillCategory): RedirectResponse
    {
        $skillCategory->delete();

        return redirect()->route('admin.skill-categories.index')
            ->with('success', 'Skill category deleted successfully.');
    }
}
