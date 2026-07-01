<?php

namespace App\Http\Controllers\Admin;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EducationController extends Controller
{
    public function index(): View
    {
        $educations = Education::ordered()->paginate(10);
        return view('admin.educations.index', compact('educations'));
    }

    public function create(): View
    {
        return view('admin.educations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'university_name' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'order' => 'nullable|integer',
        ]);

        Education::create($validated);

        return redirect()->route('admin.educations.index')
            ->with('success', 'Education created successfully.');
    }

    public function edit(Education $education): View
    {
        return view('admin.educations.edit', compact('education'));
    }

    public function update(Request $request, Education $education): RedirectResponse
    {
        $validated = $request->validate([
            'university_name' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'order' => 'nullable|integer',
        ]);

        $education->update($validated);

        return redirect()->route('admin.educations.index')
            ->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education): RedirectResponse
    {
        $education->delete();

        return redirect()->route('admin.educations.index')
            ->with('success', 'Education deleted successfully.');
    }
}
