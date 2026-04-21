<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::where('user_id', auth()->id())
            ->orderBy('due_date', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return inertia('Reminders', ['reminders' => $reminders]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:500',
            'due_date' => 'nullable|date',
        ]);

        Reminder::create([
            'user_id' => auth()->id(),
            'text' => $validated['text'],
            'due_date' => $validated['due_date'] ?? null,
        ]);

        return back();
    }

    public function destroy(Reminder $reminder)
    {
        abort_if($reminder->user_id !== auth()->id(), 403);
        $reminder->delete();
        return back();
    }
}
