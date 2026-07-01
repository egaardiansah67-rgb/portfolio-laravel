<?php

namespace App\Http\Controllers\Admin;

use App\Models\WebsiteSetting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = WebsiteSetting::all()->pluck('value', 'key');
        $socialMedia = SocialMedia::all();
        return view('admin.settings.index', compact('settings', 'socialMedia'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'website_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:512',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'keywords' => 'nullable|string',
            'google_analytics_id' => 'nullable|string',
            'facebook_pixel_id' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            if ($key !== 'logo' && $key !== 'favicon') {
                WebsiteSetting::set($key, $value);
            }
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            WebsiteSetting::set('logo', $path);
        }

        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('settings', 'public');
            WebsiteSetting::set('favicon', $path);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Website settings updated successfully.');
    }
}
