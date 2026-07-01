<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Message::create($validated);

        return back()
            ->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
