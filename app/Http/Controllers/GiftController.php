<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Gift;
use App\Models\Event;

class GiftController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'guest_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'relation' => 'required|string|max:50',
            'type' => 'required|in:cash,item',
            'amount' => 'nullable|numeric',
            'item_name' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        $guest = Guest::create([
            'event_id' => $validated['event_id'],
            'name' => $validated['guest_name'],
            'phone' => $validated['phone'],
            'relation' => $validated['relation'],
        ]);

        $guest->gifts()->create([
            'event_id' => $validated['event_id'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'item_name' => $validated['item_name'],
            'note' => $validated['note'],
        ]);

        return back();
    }

    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'guest_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'relation' => 'required|string|max:50',
            'type' => 'required|in:cash,item',
            'amount' => 'nullable|numeric',
            'item_name' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        $guest->update([
            'event_id' => $validated['event_id'],
            'name' => $validated['guest_name'],
            'phone' => $validated['phone'],
            'relation' => $validated['relation'],
        ]);

        $guest->gifts()->update([
            'event_id' => $validated['event_id'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'item_name' => $validated['item_name'],
            'note' => $validated['note'],
        ]);

        return back();
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return back();
    }
}
