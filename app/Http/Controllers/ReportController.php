<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Gift;
use App\Models\Guest;

class ReportController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalCash = Gift::whereHas('event', fn($q) => $q->where('user_id', $userId))
            ->where('type', 'cash')->sum('amount');

        $totalItems = Gift::whereHas('event', fn($q) => $q->where('user_id', $userId))
            ->where('type', 'item')->count();

        $totalGuests = Guest::whereHas('event', fn($q) => $q->where('user_id', $userId))->count();

        // Cash by relation
        $byRelation = [];
        $relations = ['Family', 'Relative', 'Friend', 'Colleague'];
        foreach ($relations as $rel) {
            $byRelation[$rel] = Gift::whereHas('guest', fn($q) => $q->where('relation', $rel))
                ->whereHas('event', fn($q) => $q->where('user_id', $userId))
                ->where('type', 'cash')
                ->sum('amount');
        }

        return Inertia::render('Reports', [
            'stats' => [
                'total_cash' => $totalCash,
                'total_items' => $totalItems,
                'total_guests' => $totalGuests,
            ],
            'by_relation' => $byRelation,
        ]);
    }
}
