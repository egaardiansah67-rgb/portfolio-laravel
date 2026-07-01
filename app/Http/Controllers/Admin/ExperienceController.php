<?php

namespace App\Http\Controllers\Admin;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ExperienceController extends Controller
{
    public function index(): View
    {
        $experiences = Experience::ordered()->paginate(10);
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create(): View
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience created successfully.');
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience deleted successfully.');
    }
}
