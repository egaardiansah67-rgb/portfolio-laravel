<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SkillController extends Controller
{
    public function index(): View
    {
        $skills = Skill::with('category')->paginate(20);
        $categories = SkillCategory::all();
        return view('admin.skills.index', compact('skills', 'categories'));
    }

    public function create(): View
    {
        $categories = SkillCategory::ordered()->get();
        return view('admin.skills.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'skill_category_id' => 'required|exists:skill_categories,id',
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
        ]);

        Skill::create($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill created successfully.');
    }

    public function edit(Skill $skill): View
    {
        $categories = SkillCategory::ordered()->get();
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'skill_category_id' => 'required|exists:skill_categories,id',
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
        ]);

        $skill->update($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully.');
    }
}
