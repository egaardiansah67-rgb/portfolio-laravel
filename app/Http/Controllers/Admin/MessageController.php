<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    public function index(): View
    {
        $messages = Message::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message): View
    {
        $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function reply(Request $request, Message $message): RedirectResponse
    {
        $validated = $request->validate([
            'reply' => 'required|string',
        ]);

        $message->update([
            'reply' => $validated['reply'],
            'is_replied' => true,
            'replied_at' => now(),
        ]);

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message replied successfully.');
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
