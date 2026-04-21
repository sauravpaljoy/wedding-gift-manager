<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Gift;
use App\Models\Event;

class GiftController extends Controller
{
    /**
     * Get or auto-create the user's default event.
     */
    private function getOrCreateDefaultEvent(): Event
    {
        $user = auth()->user();

        // Try to get existing event
        $event = Event::first();

        if (!$event) {
            // Auto-create a default event for this user
            $event = Event::create([
                'user_id'    => $user->id,
                'event_name' => $user->wedding_name ?: ($user->name . "'s Wedding"),
                'event_date' => $user->wedding_date ?: now()->toDateString(),
                'location'   => null,
            ]);
        }

        return $event;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_name' => 'required|string|max:255',
            'address'    => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'relation'   => 'required|string|max:50',
            'type'       => 'required|in:cash,item',
            'amount'     => 'nullable|numeric|min:0',
            'item_name'  => 'nullable|string|max:255',
            'note'       => 'nullable|string',
        ]);

        $event = $this->getOrCreateDefaultEvent();

        $guest = Guest::create([
            'event_id' => $event->id,
            'name'     => $validated['guest_name'],
            'address'  => $validated['address'] ?? null,
            'phone'    => $validated['phone'] ?? null,
            'relation' => $validated['relation'],
        ]);

        $guest->gifts()->create([
            'event_id'  => $event->id,
            'type'      => $validated['type'],
            'amount'    => $validated['amount'] ?? null,
            'item_name' => $validated['item_name'] ?? null,
            'note'      => $validated['note'] ?? null,
        ]);

        return back();
    }

    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'guest_name' => 'required|string|max:255',
            'address'    => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'relation'   => 'required|string|max:50',
            'type'       => 'required|in:cash,item',
            'amount'     => 'nullable|numeric|min:0',
            'item_name'  => 'nullable|string|max:255',
            'note'       => 'nullable|string',
        ]);

        $guest->update([
            'name'     => $validated['guest_name'],
            'address'  => $validated['address'] ?? null,
            'phone'    => $validated['phone'] ?? null,
            'relation' => $validated['relation'],
        ]);

        $gift = $guest->gifts()->first();
        if ($gift) {
            $gift->update([
                'type'      => $validated['type'],
                'amount'    => $validated['amount'] ?? null,
                'item_name' => $validated['item_name'] ?? null,
                'note'      => $validated['note'] ?? null,
            ]);
        } else {
            $guest->gifts()->create([
                'event_id'  => $guest->event_id,
                'type'      => $validated['type'],
                'amount'    => $validated['amount'] ?? null,
                'item_name' => $validated['item_name'] ?? null,
                'note'      => $validated['note'] ?? null,
            ]);
        }

        return back();
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return back();
    }
}
