<?php

namespace App\Http\Controllers\Admin;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SocialMediaController extends Controller
{
    public function index(): View
    {
        $socialMedia = SocialMedia::all();
        return view('admin.social-media.index', compact('socialMedia'));
    }

    public function update(Request $request, SocialMedia $socialMedia): RedirectResponse
    {
        $validated = $request->validate([
            'url' => 'nullable|url',
            'icon' => 'nullable|string|max:100',
        ]);

        $socialMedia->update($validated);

        return redirect()->route('admin.social-media.index')
            ->with('success', 'Social media link updated successfully.');
    }
}
